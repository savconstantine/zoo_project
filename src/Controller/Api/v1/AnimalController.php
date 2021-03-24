<?php

namespace App\Controller\Api\v1;

use App\Entity\Animal;
use App\Entity\AnimalType;
use App\Service\AnimalService;
use App\Service\AnimalTypeService;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;

/**
 * @Annotations\Route("/api/v1/animal")
 */
class AnimalController
{
    /** @var AnimalService */
    private $animalService;

    /** @var AnimalTypeService */
    private $animalTypeService;

    public function __construct(AnimalService $animalService, AnimalTypeService $animalTypeService)
    {
        $this->animalService = $animalService;
        $this->animalTypeService = $animalTypeService;
    }

    /**
     * @Annotations\Post("/new")
     *
     * @Annotations\RequestParam(name="name", nullable=false)
     * @Annotations\RequestParam(name="type", nullable=false)
     *
     */
    public function saveAnimalAction(string $name, string $type): View
    {
        [ $animalType, $success, $errorText] = $this->animalTypeService->validateAnimalType($type);
        if (!$success) { return View::create(['success' => 'false', 'message' => $errorText], 404); }

        $animalID = $this->animalService->saveAnimal($name, $animalType);
        [$data, $code] = $animalID === null ?
            [['success' => false], 400] :
            [['success' => true, 'animalID' => $animalID], 200];

        return View::create($data, $code);
    }

    /**
     * @Annotations\Patch("/edit")
     *
     * @Annotations\RequestParam(name="animalID", requirements="\d+", nullable=false)
     * @Annotations\RequestParam(name="name", nullable=true)
     * @Annotations\RequestParam(name="type", nullable=true)
     *
     */
    public function updateAnimalAction(int $animalID, string $name, string $type): View
    {
        [ $animalType, $success, $errorText] = $this->animalTypeService->validateAnimalType($type);
        if (!$success) { return View::create(['success' => 'false', 'message' => $errorText], 404); }
        [ $success, $errorText] = $this->validateAnimalCage($animalID, $type);
        if (!$success) { return View::create(['success' => 'false', 'message' => $errorText], 404); }

        $result = $this->animalService->updateAnimal($animalID, $name, $animalType);
        $code = $result ? 200 : 404;

        return View::create(['success' => $result], $code);
    }

    /**
     * @Annotations\Delete("/delete")
     *
     * @Annotations\RequestParam(name="animalID", requirements="\d+", nullable=false)
     *
     */
    public function deleteAnimalAction(int $animalID): View
    {
        $result = $this->animalService->deleteAnimal($animalID);
        $code = $result ? 200 : 404;

        return View::create(['success' => $result], $code);
    }

    /**
     * @Annotations\Get("/list")
     *
     * @Annotations\QueryParam(name="page", requirements="\d+", nullable=true)
     * @Annotations\QueryParam(name="perPage", requirements="\d+", nullable=true)
     *
     */
    public function getAnimalsAction(?int $page = null, ?int $perPage = null): View
    {
        $animals = $this->animalService->getAnimals($page ?? 0, $perPage ?? 10);
        $code = empty($animals) ? 404 : 200;

        return View::create(['animals' => $animals], $code);
    }

    /**
     * @Annotations\Get("/info/{animalID}")
     *
     */
    public function getAnimalInfoByIDAction(?int $animalID = null): View
    {
        /** @var Animal $animal */
        $animal = $this->animalService->getAnimalByID($animalID);

        return is_null($animal)
            ? View::create(['success' => false], 404)
            : View::create(['success' => true, 'animal'=> $animal], 200);
    }

    private function validateAnimalCage($animalID, $type): ?array
    {
        /** @var Animal $animal */
        $animal = $this->animalService->getAnimalByID($animalID);
        if (!$animal) { return [false, 'Animal not found']; }
        if (!is_null($animal->getCage()) && $animal->getType()->getName() != $type) { return [false, 'Need to remove the animal from the cage first']; }

        return [ true, '' ];
    }
}
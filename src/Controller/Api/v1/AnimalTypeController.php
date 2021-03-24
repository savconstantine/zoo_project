<?php

namespace App\Controller\Api\v1;


use App\Entity\AnimalType;
use App\Service\AnimalTypeService;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;

/**
 * @Annotations\Route("/api/v1/animal-type")
 */
class AnimalTypeController
{

    /** @var AnimalTypeService */
    private $animalTypeService;

    public function __construct(AnimalTypeService $animalTypeService)
    {
        $this->animalTypeService = $animalTypeService;
    }

    /**
     * @Annotations\Post("/new")
     *
     * @Annotations\RequestParam(name="name", nullable=false)
     *
     */
    public function saveAnimalTypeAction(string $name): View
    {
        /** @var AnimalType $animalType */
        $animalType = $this->animalTypeService->getAnimalTypeByName($name);
        if (!is_null($animalType)) { return View::create(['success' => 'false', 'message' => 'Animal type already exist'], 404);}

        $animalTypeID = $this->animalTypeService->saveAnimalType($name);

        [$data, $code] = $animalTypeID === null ?
            [['success' => false], 400] :
            [['success' => true, 'animalTypeID' => $animalTypeID], 200];

        return View::create($data, $code);
    }

    /**
     * @Annotations\Delete("/delete")
     *
     * @Annotations\RequestParam(name="name", nullable=false)
     *
     */
    public function deleteAnimalTypeAction(string $name): View
    {
        /** @var AnimalType $animalType */
        $animalType = $this->animalTypeService->getAnimalTypeByName($name);
        if (is_null($animalType)) { return View::create(['success' => 'false', 'message' => 'Animal type not exist'], 404);}
        if (count($animalType->getAnimals())) { return View::create(['success' => 'false', 'message' => 'You have some animals of this type'], 404);}

        $result = $this->animalTypeService->deleteAnimalType($name);
        $code = $result ? 200 : 404;

        return View::create(['success' => $result], $code);
    }

    /**
     * @Annotations\Get("/list")
     *
     */
    public function getAnimalTypeListAction(): View
    {
        $result = $this->animalTypeService->getAnimalTypeList();

        [$data, $code] = !count($result) ?
            [['success' => false], 400] :
            [['success' => true, 'animalTypes' => $result], 200];

        return View::create($data, $code);
    }
}
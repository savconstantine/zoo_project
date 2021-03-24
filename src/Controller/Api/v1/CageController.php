<?php

namespace App\Controller\Api\v1;

use App\Entity\Cage;
use App\Entity\Animal;
use App\Service\AnimalService;
use App\Service\CageService;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;

/**
 * @Annotations\Route("/api/v1/cage")
 */
class CageController
{
    /** @var CageService */
    private $cageService;

    /** @var AnimalService */
    private $animalService;

    public function __construct(CageService $cageService, AnimalService $animalService)
    {
        $this->cageService = $cageService;
        $this->animalService = $animalService;
    }

    /**
     * @Annotations\Post("/new")
     *
     * @Annotations\RequestParam(name="name", nullable=false)
     */
    public function saveCageAction(string $name): View
    {
        $cageID = $this->cageService->saveCage($name);
        [$data, $code] = $cageID === null ?
            [['success' => false], 400] :
            [['success' => true, 'cageID' => $cageID], 200];

        return View::create($data, $code);
    }

    /**
     * @Annotations\Get("/list")
     *
     * @Annotations\QueryParam(name="page", requirements="\d+", nullable=true)
     * @Annotations\QueryParam(name="perPage", requirements="\d+", nullable=true)
     *
     */
    public function getCagesAction(?int $page = null, ?int $perPage = null): View
    {
        $cages = $this->cageService->getCages($page ?? 0, $perPage ?? 10);
        $code = empty($cages) ? 404 : 200;

        return View::create(['cages' => $cages], $code);
    }

    /**
     * @Annotations\Patch("/edit")
     *
     * @Annotations\RequestParam(name="cageID", requirements="\d+", nullable=false)
     * @Annotations\RequestParam(name="name", nullable=false)
     *
     */
    public function updateCageAction(int $cageID, string $name): View
    {
        $result = $this->cageService->updateCage($cageID, $name);
        $code = $result ? 200 : 404;

        return View::create(['success' => $result], $code);
    }

    /**
     * @Annotations\Delete("/delete")
     *
     * @Annotations\RequestParam(name="cageID", requirements="\d+", nullable=false)
     *
     */
    public function deleteCageAction(int $cageID): View
    {
        /** @var Cage $cage */
        $cage = $this->cageService->getCageByID($cageID);
        if (is_null($cage)) { return View::create(['success' => 'false', 'message' => 'Cage not found'], 404);}

        if (!$cage->getAnimals()->isEmpty()) { return View::create(['success' => 'false', 'message' => 'There are animals in the cage. Clean the cage first'], 404);}

        $result = $this->cageService->deleteCage($cageID);
        $code = $result ? 200 : 404;

        return View::create(['success' => $result], $code);
    }

    /**
     * @Annotations\Patch("/clean")
     *
     * @Annotations\RequestParam(name="cageID", requirements="\d+", nullable=false)
     *
     */
    public function cleanCageAction(int $cageID): View
    {
        /** @var Cage $cage */
        $cage = $this->cageService->getCageByID($cageID);
        if (is_null($cage)) { return View::create(['success' => 'false', 'message' => 'Cage not found'], 404);}

        $result = $this->cageService->cleanCage($cageID);
        $code = $result ? 200 : 404;

        return View::create(['success' => $result], $code);
    }


    /**
     * @Annotations\Get("/info/{cageID}")
     *
     */
    public function getCageByIDAction(?int $cageID = null): View
    {
        /** @var Cage $cage */
        $cage = $this->cageService->getCageByID($cageID);


        return is_null($cage)
            ? View::create(['success' => false], 404)
            : View::create(['success' => 'true', 'cage' => $cage], 200);

    }

    /**
     * @Annotations\Post("/add-animal")
     *
     * @Annotations\RequestParam(name="cageID", requirements="\d+", nullable=false)
     * @Annotations\RequestParam(name="animalID", requirements="\d+", nullable=false)
     */
    public function addAnimalToCageAction(?int $cageID , ?int $animalID): View
    {
        /** @var Cage $cage */
        $cage = $this->cageService->getCageByID($cageID);
        if (is_null($cage)) { return View::create(['success' => 'false', 'message' => 'Cage not found'], 404);}
        /** @var Animal $animal */
        $animal = $this->animalService->getAnimalByID($animalID);
        if (is_null($animal)) { return View::create(['success' => 'false', 'message' => 'Animal not found'], 404); }

        /** @var Animal $someAnimalAtCage */
        $someAnimalInCage = $cage->getAnimals()->first();

        if ($someAnimalInCage && $someAnimalInCage->getType() !== $animal->getType()) {
            return View::create(['success' => 'false', 'message' => "There are other types of animals in the cage ({$someAnimalInCage->getType()->getName()})"], 404);
        }

        $this->cageService->addAnimalToCage($cage, $animal);

        return View::create(['success' => 'true', 'cage' => $cage], 200);
    }

    /**
     * @Annotations\Delete("/remove-animal")
     *
     * @Annotations\RequestParam(name="cageID", requirements="\d+", nullable=false)
     * @Annotations\RequestParam(name="animalID", requirements="\d+", nullable=false)
     */
    public function removeAnimalFromCageAction(?int $cageID , ?int $animalID): View
    {
        /** @var Cage $cage */
        $cage = $this->cageService->getCageByID($cageID);
        if (is_null($cage)) { return View::create(['success' => 'false', 'message' => 'Cage not found'], 404);}
        /** @var Animal $animal */
        $animal = $this->animalService->getAnimalByID($animalID);
        if (is_null($animal)) { return View::create(['success' => 'false', 'message' => 'Animal not found'], 404); }

        if (!$cage->getAnimals()->contains($animal)) { return View::create(['success' => 'false', 'message' => 'No such animal in this cage'], 404); }
        $this->cageService->removeAnimalFromCage($cage, $animal);

        return View::create(['success' => 'true', 'cage' => $cage], 200);
    }
}
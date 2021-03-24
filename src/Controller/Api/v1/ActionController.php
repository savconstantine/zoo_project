<?php

namespace App\Controller\Api\v1;


use App\Entity\Action;
use App\Service\ActionService;
use App\Service\AnimalTypeService;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;

/**
 * @Annotations\Route("/api/v1/action")
 */
class ActionController
{

    /** @var ActionService */
    private $actionService;

    /** @var AnimalTypeService */
    private $animalTypeService;


    public function __construct(ActionService $actionService, AnimalTypeService $animalTypeService)
    {
        $this->actionService = $actionService;
        $this->animalTypeService = $animalTypeService;
    }

    /**
     * @Annotations\Post("/new")
     *
     * @Annotations\RequestParam(name="name", nullable=false)
     *
     */
    public function saveActionAction(string $name): View
    {
        /** @var Action $action */
        $action = $this->actionService->getActionByName($name);
        if (!is_null($action)) { return View::create(['success' => 'false', 'message' => 'Action already exist'], 404);}
        $actionID = $this->actionService->saveAction($name);
        [$data, $code] = $actionID === null ?
            [['success' => false], 400] :
            [['success' => true, 'actionID' => $actionID], 200];

        return View::create($data, $code);
    }

    /**
     * @Annotations\Delete("/delete")
     *
     * @Annotations\RequestParam(name="name", nullable=false)
     *
     */
    public function deleteActionAction(string $name): View
    {
        $result = $this->actionService->deleteAction($name);
        $code = $result ? 200 : 404;

        return View::create(['success' => $result], $code);
    }

    /**
     * @Annotations\Get("/list")
     *
     */
    public function getActionListAction(): View
    {
        $result = $this->actionService->getActionList();

        [$data, $code] = !count($result) ?
            [['success' => false], 400] :
            [['success' => true, 'actions list' => $result], 200];

        return View::create($data, $code);
    }

    /**
     * @Annotations\Post("/add-to-type")
     *
     * @Annotations\RequestParam(name="nameAction", nullable=false)
     * @Annotations\RequestParam(name="nameType", nullable=false)
     *
     */
    public function addActionTyAnimalTypeAction(string $nameAction, string $nameType): View
    {
        /** @var Action $action */
        $action = $this->actionService->getActionByName($nameAction);
        if (is_null($action)) { return View::create(['success' => 'false', 'message' => 'Action not exist'], 404);}
        [ $animalType, $success, $errorText] = $this->animalTypeService->validateAnimalType($nameType);
        if (!$success) { return View::create(['success' => 'false', 'message' => $errorText], 404); }

        $action = $this->actionService->addActionToType($action, $animalType);
        [$data, $code] = $action === null ?
            [['success' => false], 400] :
            [['success' => true, 'action' => $action], 200];

        return View::create($data, $code);
    }

    /**
     * @Annotations\Delete("/remove-from-type")
     *
     * @Annotations\RequestParam(name="nameAction", nullable=false)
     * @Annotations\RequestParam(name="nameType", nullable=false)
     *
     */
    public function removeActionFromAnimalTypeAction(string $nameAction, string $nameType): View
    {
        /** @var Action $action */
        $action = $this->actionService->getActionByName($nameAction);
        if (is_null($action)) { return View::create(['success' => 'false', 'message' => 'Action not exist'], 404);}

        [ $animalType, $success, $errorText] = $this->animalTypeService->validateAnimalType($nameType);
        if (!$success) { return View::create(['success' => 'false', 'message' => $errorText], 404); }

        $action = $this->actionService->removeActionFromType($action, $animalType);
        [$data, $code] = $action === null ?
            [['success' => false], 400] :
            [['success' => true, 'action' => $action], 200];

        return View::create($data, $code);
    }

}
<?php


namespace App\Service;

use App\Entity\Animal;
use App\Entity\Action;
use App\Entity\AnimalType;
use App\Repository\ActionRepository;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActionService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveAction(string $name): ?int
    {
        $action = new Action();
        $action->setName($name);
        $this->entityManager->persist($action);
        $this->entityManager->flush();

        return $action->getId();
    }

    public function deleteAction(string $name): bool
    {
        $action = $this->getActionByName($name);
        if ($action === null) { return false; }

        $this->entityManager->remove($action);
        $this->entityManager->flush();

        return true;
    }

    public function getActionList(): ?array
    {
        /** @var ActionRepository $actionRepository */
        $actionRepository = $this->entityManager->getRepository(Action::class);
        $actionList = $actionRepository->findAll();

        return $actionList;
    }

    public function addActionToType(Action $action, AnimalType $animalType): ?Action
    {
        $action->addAnimalType($animalType);
        $this->entityManager->flush();

        return $action;
    }

    public function removeActionFromType(Action $action, AnimalType $animalType): ?Action
    {
        $action->removeAnimalType($animalType);
        $this->entityManager->flush();

        return $action;
    }

    public function getActionByID(int $actionID): ?object
    {
        /** @var ActionRepository $cageRepository */
        $cageRepository = $this->entityManager->getRepository(Action::class);
        /** @var Action $action */
        $action = $cageRepository->find($actionID);

        return $action;
    }

    public function getActionByName(string $name): ?object
    {
        /** @var ActionRepository $actionRepository */
        $actionRepository = $this->entityManager->getRepository(Action::class);
        /** @var Action $action */
        $action = $actionRepository->findOneByNameField($name);

        return $action;
    }

}
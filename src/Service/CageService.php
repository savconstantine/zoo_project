<?php


namespace App\Service;

use App\Entity\Animal;
use App\Entity\Cage;
use App\Repository\CageRepository;
use Doctrine\ORM\EntityManagerInterface;

class CageService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveCage(string $name): ?int
    {
        $cage = new Cage();
        $cage->setName($name);
        $this->entityManager->persist($cage);
        $this->entityManager->flush();

        return $cage->getId();
    }

    public function updateCage(int $cageID, string $name): bool
    {
        /** @var CageRepository $cageRepository */
        $cageRepository = $this->entityManager->getRepository(Cage::class);
        /** @var Cage $cage */
        $cage = $cageRepository->find($cageID);
        if ($cage === null) { return false; }

        $cage->setName($name);
        $this->entityManager->flush();

        return true;
    }

    public function deleteCage(int $cageID): bool
    {
        /** @var CageRepository $cageRepository */
        $cageRepository = $this->entityManager->getRepository(Cage::class);
        /** @var Cage $cage */
        $cage = $cageRepository->find($cageID);
        if ($cage === null) { return false; }

        $this->entityManager->remove($cage);
        $this->entityManager->flush();

        return true;
    }

    public function cleanCage(int $cageID): bool
    {
        /** @var CageRepository $cageRepository */
        $cageRepository = $this->entityManager->getRepository(Cage::class);
        /** @var Cage $cage */
        $cage = $cageRepository->find($cageID);
        if ($cage === null) { return false; }

        foreach ($cage->getAnimals() as $animal)
            $cage->removeAnimal($animal);

        $this->entityManager->flush();

        return true;
    }

    public function getCages(int $page, int $perPage): array
    {
        /** @var CageRepository $cageRepository */
        $cageRepository = $this->entityManager->getRepository(Cage::class);

        return $cageRepository->getCages($page, $perPage);
    }

    public function getCageByID(int $cageID): ?object
    {
        /** @var CageRepository $cageRepository */
        $cageRepository = $this->entityManager->getRepository(Cage::class);
        /** @var Cage $cage */
        $cage = $cageRepository->find($cageID);

        return $cage;
    }

    public function addAnimalToCage(Cage $cage, Animal $animal): ?object
    {
        $cage->addAnimal($animal);
        $this->entityManager->flush();

        return $cage;
    }

    public function removeAnimalFromCage(Cage $cage, Animal $animal): ?object
    {
        $cage->removeAnimal($animal);
        $this->entityManager->flush();

        return $cage;
    }
}
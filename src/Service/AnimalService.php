<?php


namespace App\Service;

use App\Entity\Animal;
use App\Entity\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;

class AnimalService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveAnimal(string $name, AnimalType $type): ?int
    {
        $animal = new Animal();
        $animal->setName($name);
        $animal->setType($type);
        $this->entityManager->persist($animal);
        $this->entityManager->flush();

        return $animal->getId();
    }

    public function updateAnimal(int $animalID, string $name, AnimalType $type): bool
    {
        /** @var AnimalRepository $animalRepository */
        $animalRepository = $this->entityManager->getRepository(Animal::class);
        /** @var Animal $animal */
        $animal = $animalRepository->find($animalID);
        if ($animal === null) { return false; }

        if (!empty($name)) { $animal->setName($name); }
        if (!empty($type)) { $animal->setType($type); }

        $this->entityManager->flush();

        return true;
    }

    public function deleteAnimal(int $animalID): bool
    {
        /** @var AnimalRepository $animalRepository */
        $animalRepository = $this->entityManager->getRepository(Animal::class);
        /** @var Animal $animal */
        $animal = $animalRepository->find($animalID);
        if ($animal === null) { return false; }

        $this->entityManager->remove($animal);
        $this->entityManager->flush();

        return true;
    }

    public function getAnimals(int $page, int $perPage): array
    {
        /** @var AnimalRepository $animalRepository */
        $animalRepository = $this->entityManager->getRepository(Animal::class);

        return $animalRepository->getAnimals($page, $perPage);
    }

    public function getAnimalByID(int $animalID): ?object
    {
        /** @var AnimalRepository $cageRepository */
        $cageRepository = $this->entityManager->getRepository(Animal::class);
        /** @var Animal $animal */
        $animal = $cageRepository->find($animalID);

        return $animal;
    }

}
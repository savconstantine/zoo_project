<?php


namespace App\Service;

use App\Entity\AnimalType;
use App\Repository\AnimalTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class AnimalTypeService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveAnimalType(string $name): ?int
    {
        $animalType = new AnimalType();
        $animalType->setName($name);
        $this->entityManager->persist($animalType);
        $this->entityManager->flush();

        return $animalType->getId();
    }

    public function deleteAnimalType(string $name): bool
    {
        /** @var AnimalType $animalType */
        $animalType = $this->getAnimalTypeByName($name);
        if ($animalType === null) { return false; }

        $this->entityManager->remove($animalType);
        $this->entityManager->flush();

        return true;
    }

    public function getAnimalTypeByID(int $actionID): ?object
    {
        /** @var AnimalTypeRepository $animalTypeRepository */
        $animalTypeRepository = $this->entityManager->getRepository(AnimalType::class);
        /** @var AnimalType $animalType */
        $animalType = $animalTypeRepository->find($actionID);

        return $animalType;
    }

    public function getAnimalTypeByName(string $name): ?object
    {
        /** @var AnimalTypeRepository $animalTypeRepository */
        $animalTypeRepository = $this->entityManager->getRepository(AnimalType::class);
        /** @var AnimalType $animalType */
        $animalType = $animalTypeRepository->findOneByNameField($name);

        return $animalType;
    }

    public function getAnimalTypeList(): ?array
    {
        /** @var AnimalTypeRepository $animalTypeRepository */
        $animalTypeRepository = $this->entityManager->getRepository(AnimalType::class);
        $animalTypes = $animalTypeRepository->findAll();

        return $animalTypes;
    }

    public function validateAnimalType($type): ?array
    {
        /** @var AnimalType $animalType */
        $animalType = $this->getAnimalTypeByName($type);
        if (is_null($animalType)) {
            $animalTypes = $this->getAnimalTypeList();

            $errorText = 'You should create animal type first';
            if (count($animalTypes)) {
                $output = implode(
                    ', ',
                    array_map(function ($object) { return $object->getName(); }, $animalTypes)
                );
                $errorText = "There is no such type. List of types: {$output}";
            }

            return [ $animalType, false, $errorText];
        }

        return [ $animalType, true, ''];
    }

}
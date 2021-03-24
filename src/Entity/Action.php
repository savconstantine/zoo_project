<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 */
class Action
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=AnimalType::class, inversedBy="actions")
     */
    private $animal_type;



    public function __construct()
    {
        $this->type_animal = new ArrayCollection();
        $this->animal_type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|AnimalType[]
     */
    public function getAnimalType(): Collection
    {
        return $this->animal_type;
    }

    public function addAnimalType(AnimalType $animalType): self
    {
        if (!$this->animal_type->contains($animalType)) {
            $this->animal_type[] = $animalType;
        }

        return $this;
    }

    public function removeAnimalType(AnimalType $animalType): self
    {
        $this->animal_type->removeElement($animalType);

        return $this;
    }


}

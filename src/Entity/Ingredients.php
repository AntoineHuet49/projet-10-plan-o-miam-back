<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IngredientsRepository::class)
 */
class Ingredients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"recipe"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * 
     * @Assert\NotBlank
     * 
     * @Groups({"recipe"})
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     * 
     * @Assert\NotBlank
     * 
     * @Groups({"recipe"})
     */
    private $quantities;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * 
     * @Groups({"recipe"})
     */
    private $unit;

    /**
     * @ORM\ManyToMany(targetEntity=Recipes::class, mappedBy="ingredients")
     */
    private $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
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

    public function getQuantities(): ?float
    {
        return $this->quantities;
    }

    public function setQuantities(?float $quantities): self
    {
        $this->quantities = $quantities;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return Collection<int, Recipes>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipes $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->addIngredient($this);
        }

        return $this;
    }

    public function removeRecipe(Recipes $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            $recipe->removeIngredient($this);
        }

        return $this;
    }
}

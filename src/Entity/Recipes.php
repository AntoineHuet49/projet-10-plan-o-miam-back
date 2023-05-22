<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RecipesRepository::class)
 */
class Recipes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"list_recipes"})
     * @Groups({"recipe"})
     * @Groups({"new_lunch"})
     * @Groups({"reviews_add"})
     * @Groups({"week_lunch"})
     * @Groups({"day_lunchs"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     * 
     * @Groups({"list_recipes"})
     * @Groups({"recipe"})
     * @Groups({"new_lunch"})
     * @Groups({"reviews_add"})
     * @Groups({"week_lunch"})
     * @Groups({"day_lunchs"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"list_recipes"})
     * @Groups({"recipe"})
     */
    private $rating;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\NotBlank
     * 
     * @Groups({"list_recipes"})
     * @Groups({"recipe"})
     * @Groups({"new_lunch"})
     * @Groups({"week_lunch"})
     * @Groups({"day_lunchs"})
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity=Lunchs::class, mappedBy="recipes")
     */
    private $lunchs;

    /**
     * @ORM\OneToMany(targetEntity=Reviews::class, mappedBy="recipe")
     * 
     * @Groups({"recipe"})
     */
    private $reviews;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredients::class, inversedBy="recipes")
     * 
     * @Groups({"recipe"})
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity=Steps::class, mappedBy="recipe")
     * 
     * @Groups({"recipe"})
     */
    private $steps;

    public function __construct()
    {
        $this->lunchs = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
        $this->steps = new ArrayCollection();
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

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Lunchs>
     */
    public function getLunchs(): Collection
    {
        return $this->lunchs;
    }

    public function addLunch(Lunchs $lunch): self
    {
        if (!$this->lunchs->contains($lunch)) {
            $this->lunchs[] = $lunch;
            $lunch->addRecipe($this);
        }

        return $this;
    }

    public function removeLunch(Lunchs $lunch): self
    {
        if ($this->lunchs->removeElement($lunch)) {
            $lunch->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Reviews>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Reviews $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setRecipe($this);
        }

        return $this;
    }

    public function removeReview(Reviews $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getRecipe() === $this) {
                $review->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ingredients>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredients $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredients $ingredient): self
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }

    /**
     * @return Collection<int, Steps>
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Steps $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setRecipe($this);
        }

        return $this;
    }

    public function removeStep(Steps $step): self
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getRecipe() === $this) {
                $step->setRecipe(null);
            }
        }

        return $this;
    }
}

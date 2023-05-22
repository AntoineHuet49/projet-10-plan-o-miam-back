<?php

namespace App\Entity;

use App\Repository\LunchsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups as Group;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=LunchsRepository::class)
 */
class Lunchs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Group({"new_lunch"})
     * @Group({"edit_lunch"})
     * @Group({"week_lunch"})
     * @Group({"day_lunchs"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Assert\NotBlank
     * 
     * @Group({"new_lunch"})
     * @Group({"edit_lunch"})
     * @Group({"week_lunch"})
     * @Group({"day_lunchs"})
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=Recipes::class, inversedBy="lunchs")
     * 
     * @Group({"week_lunch"})
     * @Group({"day_lunchs"})
     */
    private $recipes;

    /**
     * @ORM\ManyToMany(targetEntity=Groups::class, inversedBy="lunchs")
     */
    private $groups;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * 
     * @Group({"new_lunch"})
     * @Group({"edit_lunch"})
     * @Group({"week_lunch"})
     * @Group({"day_lunchs"})
     */
    private $time;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->groups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
        }

        return $this;
    }

    public function removeRecipe(Recipes $recipe): self
    {
        $this->recipes->removeElement($recipe);

        return $this;
    }

    /**
     * @return Collection<int, Groups>
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Groups $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
        }

        return $this;
    }

    public function removeGroup(Groups $group): self
    {
        $this->groups->removeElement($group);

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): self
    {
        $this->time = $time;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\StepsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StepsRepository::class)
 */
class Steps
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
     * @ORM\Column(type="text")
     * 
     * @Assert\NotBlank
     * 
     * @Groups({"recipe"})
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Recipes::class, inversedBy="steps")
     */
    private $recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getRecipe(): ?Recipes
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipes $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }
}

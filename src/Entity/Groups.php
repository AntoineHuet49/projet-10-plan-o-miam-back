<?php

namespace App\Entity;

use App\Repository\GroupsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups as GroupAnnotations;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GroupsRepository::class)
 */
class Groups
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @GroupAnnotations({"new_lunch"})
     * @GroupAnnotations({"groups_read"})
     * @GroupAnnotations({"groups_edit"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=36)
     * 
     * @Assert\NotBlank
     * 
     * @GroupAnnotations({"new_lunch"})
     * @GroupAnnotations({"groups_read"})
     * @GroupAnnotations({"groups_edit"})
     * @GroupAnnotations({"user_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @GroupAnnotations({"groups_read"})
     * @GroupAnnotations({"groups_edit"})
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity=Lunchs::class, mappedBy="groups")
     */
    private $lunchs;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="groups")
     * 
     * @GroupAnnotations({"groups_read"})
     * @GroupAnnotations({"groups_edit"})
     */
    private $users;

    public function __construct()
    {
        $this->lunchs = new ArrayCollection();
        $this->users = new ArrayCollection();
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
            $lunch->addGroup($this);
        }

        return $this;
    }

    public function removeLunch(Lunchs $lunch): self
    {
        if ($this->lunchs->removeElement($lunch)) {
            $lunch->removeGroup($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $day;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="sessions")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RidingSchool", inversedBy="sessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ridingSchool;

    /**
     * @ORM\Column(type="time")
     */
    private $hour;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Level", inversedBy="sessions")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_places;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;


    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->level = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addSession($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeSession($this);
        }

        return $this;
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

    public function getRidingSchool(): ?RidingSchool
    {
        return $this->ridingSchool;
    }

    public function setRidingSchool(?RidingSchool $ridingSchool): self
    {
        $this->ridingSchool = $ridingSchool;

        return $this;
    }

    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(\DateTimeInterface $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * @return Collection|Level[]
     */
    public function getLevel(): Collection
    {
        return $this->level;
    }

    public function addLevel(Level $level): self
    {
        if (!$this->level->contains($level)) {
            $this->level[] = $level;
        }

        return $this;
    }

    public function removeLevel(Level $level): self
    {
        if ($this->level->contains($level)) {
            $this->level->removeElement($level);
        }

        return $this;
    }

    public function getNumberPlaces(): ?int
    {
        return $this->number_places;
    }

    public function setNumberPlaces(int $number_places): self
    {
        $this->number_places = $number_places;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

}

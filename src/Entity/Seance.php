<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeanceRepository")
 */
class Seance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Level")
     */
    private $level;

    public function __construct()
    {
        $this->level = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
}

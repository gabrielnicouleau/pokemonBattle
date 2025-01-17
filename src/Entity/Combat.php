<?php

namespace App\Entity;

use App\Repository\CombatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CombatRepository::class)]
class Combat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbrTour = null;

    #[ORM\ManyToOne]
    private ?Pokemon $Pokemon1 = null;

    #[ORM\ManyToOne]
    private ?Pokemon $Pokemon2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrTour(): ?int
    {
        return $this->nbrTour;
    }

    public function setNbrTour(int $nbrTour): static
    {
        $this->nbrTour = $nbrTour;

        return $this;
    }

    public function getPokemon1(): ?Pokemon
    {
        return $this->Pokemon1;
    }

    public function setPokemon1(?Pokemon $Pokemon1): static
    {
        $this->Pokemon1 = $Pokemon1;

        return $this;
    }

    public function getPokemon2(): ?Pokemon
    {
        return $this->Pokemon2;
    }

    public function setPokemon2(?Pokemon $Pokemon2): static
    {
        $this->Pokemon2 = $Pokemon2;

        return $this;
    }
}

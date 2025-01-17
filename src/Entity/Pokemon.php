<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $pointDeVie = null;

    #[ORM\Column]
    private ?int $pointAttaque = null;

    #[ORM\Column]
    private ?int $pointDefense = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPointDeVie(): ?int
    {
        return $this->pointDeVie;
    }

    public function setPointDeVie(int $pointDeVie): static
    {
        $this->pointDeVie = $pointDeVie;

        return $this;
    }

    public function getPointAttaque(): ?int
    {
        return $this->pointAttaque;
    }

    public function setPointAttaque(int $pointAttaque): static
    {
        $this->pointAttaque = $pointAttaque;

        return $this;
    }

    public function getPointDefense(): ?int
    {
        return $this->pointDefense;
    }

    public function setPointDefense(int $pointDefense): static
    {
        $this->pointDefense = $pointDefense;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}

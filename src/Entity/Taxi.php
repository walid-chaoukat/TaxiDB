<?php

namespace App\Entity;

use App\Repository\TaxiRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxiRepository::class)]
class Taxi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $plaque = null;

    #[ORM\Column(length: 200)]
    private ?string $chauffeur = null;

    #[ORM\Column]
    private ?bool $disponible = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $zone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_mise_circulation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaque(): ?string
    {
        return $this->plaque;
    }

    public function setPlaque(string $plaque): static
    {
        $this->plaque = $plaque;

        return $this; 
    }

    public function getChauffeur(): ?string
    {
        return $this->chauffeur;
    }

    public function setChauffeur(string $chauffeur): static
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }

    public function isDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): static
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(?string $zone): static
    {
        $this->zone = $zone;

        return $this;
    }

    public function getDateMiseCirculation(): ?\DateTime
    {
        return $this->date_mise_circulation;
    }

    public function setDateMiseCirculation(\DateTime $date_mise_circulation): static
    {
        $this->date_mise_circulation = $date_mise_circulation;

        return $this;
    }
}

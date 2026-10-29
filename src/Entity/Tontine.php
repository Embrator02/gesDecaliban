<?php

namespace App\Entity;

use App\Repository\TontineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TontineRepository::class)]
class Tontine extends Campagn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbrtours = null;

    #[ORM\Column]
    private ?int $tour = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrtours(): ?int
    {
        return $this->nbrtours;
    }

    public function setNbrtours(?int $nbrtours): static
    {
        $this->nbrtours = $nbrtours;

        return $this;
    }

    public function getTour(): ?int
    {
        return $this->tour;
    }

    public function setTour(int $tour): static
    {
        $this->tour = $tour;

        return $this;
    }
}

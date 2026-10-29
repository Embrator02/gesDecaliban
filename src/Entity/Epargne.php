<?php

namespace App\Entity;

use App\Repository\EpargneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpargneRepository::class)]
class Epargne extends Campagn
{

    #[ORM\Column]
    private ?int $periodicite = null;

    #[ORM\Column]
    private ?int $objectif = null; 

    public function getPeriodicite(): ?int
    {
        return $this->periodicite;
    }

    public function setPeriodicite(int $periodicite): static
    {
        $this->periodicite = $periodicite;

        return $this;
    }

    public function getObjectif(): ?int
    {
        return $this->objectif;
    }

    public function setObjectif(int $objectif): static
    {
        $this->objectif = $objectif;

        return $this;
    }
}

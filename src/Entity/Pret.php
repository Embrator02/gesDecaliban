<?php

namespace App\Entity;

use App\Enum\StatutPret;
use App\Repository\PretRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PretRepository::class)]
class Pret
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $datePret = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateRbrsmt = null;

    #[ORM\Column(nullable: true, enumType: StatutPret::class)]
    private ?StatutPret $pretStatut = null;

    #[ORM\Column(length: 255)]
    private ?string $membre = null;

    #[ORM\ManyToOne(inversedBy: 'prets')]
    private ?Membre $membres = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePret(): ?\DateTime
    {
        return $this->datePret;
    }

    public function setDatePret(\DateTime $datePret): static
    {
        $this->datePret = $datePret;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateRbrsmt(): ?\DateTime
    {
        return $this->dateRbrsmt;
    }

    public function setDateRbrsmt(\DateTime $dateRbrsmt): static
    {
        $this->dateRbrsmt = $dateRbrsmt;

        return $this;
    }

    public function getPretStatut(): ?StatutPret
    {
        return $this->pretStatut;
    }

    public function setPretStatut(?StatutPret $pretStatut): static
    {
        $this->pretStatut = $pretStatut;

        return $this;
    }

    public function getMembre(): ?string
    {
        return $this->membre;
    }

    public function setMembre(string $membre): static
    {
        $this->membre = $membre;

        return $this;
    }

    public function getMembres(): ?Membre
    {
        return $this->membres;
    }

    public function setMembres(?Membre $membres): static
    {
        $this->membres = $membres;

        return $this;
    }
}

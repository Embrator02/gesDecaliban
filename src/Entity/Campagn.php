<?php

namespace App\Entity;

use App\Enum\Statut;
use App\Enum\TypeCampagn;
use App\Repository\CampagnRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampagnRepository::class)]
class Campagn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateFin = null;

    #[ORM\Column(nullable: true)]
    private ?int $montant = null;

    #[ORM\Column(nullable: true, enumType: TypeCampagn::class)]
    private ?TypeCampagn $type = null;

    #[ORM\Column(enumType: Statut::class)]
    private ?Statut $satut = null;

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

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(?int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getType(): ?TypeCampagn
    {
        return $this->type;
    }

    public function setType(?TypeCampagn $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSatut(): ?Statut
    {
        return $this->satut;
    }

    public function setSatut(Statut $satut): static
    {
        $this->satut = $satut;

        return $this;
    }
}

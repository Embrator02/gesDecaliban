<?php

namespace App\Entity;

use App\Repository\ModeDeCotisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeDeCotisationRepository::class)]
class ModeDeCotisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $Islibre = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $montant = null;

    #[ORM\Column]
    private ?\DateTime $dateVrsmnt = null;

    #[ORM\ManyToOne(inversedBy: 'modeDeCotisations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membre $membre = null;

    #[ORM\ManyToOne(inversedBy: 'modeDeCotisations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Campagn $campagn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function islibre(): ?bool
    {
        return $this->Islibre;
    }

    public function setIslibre(bool $Islibre): static
    {
        $this->Islibre = $Islibre;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateVrsmnt(): ?\DateTime
    {
        return $this->dateVrsmnt;
    }

    public function setDateVrsmnt(\DateTime $dateVrsmnt): static
    {
        $this->dateVrsmnt = $dateVrsmnt;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): static
    {
        $this->membre = $membre;

        return $this;
    }

    public function getCampagn(): ?Campagn
    {
        return $this->campagn;
    }

    public function setCampagn(?Campagn $campagn): static
    {
        $this->campagn = $campagn;

        return $this;
    }
}

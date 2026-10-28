<?php

namespace App\Entity;

use App\Enum\StatutCampagn;
use App\Enum\TypeCampagn;
use App\Repository\CampagnRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateFinAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $montant = null;

    #[ORM\Column(nullable: true, enumType: TypeCampagn::class)]
    private ?TypeCampagn $type = null;

    #[ORM\Column(enumType: StatutCampagn::class)]
    private ?StatutCampagn $statut = null;

    /**
     * @var Collection<int, ModeDeCotisation>
     */
    #[ORM\OneToMany(targetEntity: ModeDeCotisation::class, mappedBy: 'campagn')]
    private Collection $modeDeCotisations;

    public function __construct()
    {
        $this->modeDeCotisations = new ArrayCollection();
    }

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

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getDateFinAt(): ?\DateTime
    {
        return $this->dateFinAt;
    }

    public function setDateFinAt(?\DateTime $dateFinAt): static
    {
        $this->dateFinAt = $dateFinAt;

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

    public function getStatut(): ?StatutCampagn
    {
        return $this->statut;
    }

    public function setStatut(StatutCampagn $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, ModeDeCotisation>
     */
    public function getModeDeCotisations(): Collection
    {
        return $this->modeDeCotisations;
    }

    public function addModeDeCotisation(ModeDeCotisation $modeDeCotisation): static
    {
        if (!$this->modeDeCotisations->contains($modeDeCotisation)) {
            $this->modeDeCotisations->add($modeDeCotisation);
            $modeDeCotisation->setCampagn($this);
        }

        return $this;
    }

    public function removeModeDeCotisation(ModeDeCotisation $modeDeCotisation): static
    {
        if ($this->modeDeCotisations->removeElement($modeDeCotisation)) {
            // set the owning side to null (unless already changed)
            if ($modeDeCotisation->getCampagn() === $this) {
                $modeDeCotisation->setCampagn(null);
            }
        }

        return $this;
    }
}

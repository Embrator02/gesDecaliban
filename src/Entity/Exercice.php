<?php

namespace App\Entity;

use App\Enum\StatutCampagn;
use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    use \App\Trait\TraitDate;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateDebutAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateFinAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateLimitPret = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateRetributionAt = null;

    #[ORM\Column(enumType: StatutCampagn::class)]
    private ?StatutCampagn $statutExercice = null;

    #[ORM\ManyToOne(inversedBy: 'exercies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Groupement $groupement = null;

    /**
     * @var Collection<int, Campagn>
     */
    #[ORM\OneToMany(targetEntity: Campagn::class, mappedBy: 'exercice')]
    private Collection $campagns;

    public function __construct()
    {
        $this->campagns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebutAt(): ?\DateTime
    {
        return $this->dateDebutAt;
    }

    public function setDateDebutAt(\DateTime $dateDebutAt): static
    {
        $this->dateDebutAt = $dateDebutAt;

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

    public function getDateLimitPret(): ?\DateTime
    {
        return $this->dateLimitPret;
    }

    public function setDateLimitPret(?\DateTime $dateLimitPret): static
    {
        $this->dateLimitPret = $dateLimitPret;

        return $this;
    }

    public function getDateRetributionAt(): ?\DateTime
    {
        return $this->dateRetributionAt;
    }

    public function setDateRetributionAt(?\DateTime $dateRetributionAt): static
    {
        $this->dateRetributionAt = $dateRetributionAt;

        return $this;
    }

    public function getStatutExercice(): ?StatutCampagn
    {
        return $this->statutExercice;
    }

    public function setStatutExercice(StatutCampagn $statutExercice): static
    {
        $this->statutExercice = $statutExercice;

        return $this;
    }

    public function getGroupement(): ?Groupement
    {
        return $this->groupement;
    }

    public function setGroupement(?Groupement $groupement): static
    {
        $this->groupement = $groupement;

        return $this;
    }

    /**
     * @return Collection<int, Campagn>
     */
    public function getCampagns(): Collection
    {
        return $this->campagns;
    }

    public function addCampagn(Campagn $campagn): static
    {
        if (!$this->campagns->contains($campagn)) {
            $this->campagns->add($campagn);
            $campagn->setExercice($this);
        }

        return $this;
    }

    public function removeCampagn(Campagn $campagn): static
    {
        if ($this->campagns->removeElement($campagn)) {
            // set the owning side to null (unless already changed)
            if ($campagn->getExercice() === $this) {
                $campagn->setExercice(null);
            }
        }

        return $this;
    }

}

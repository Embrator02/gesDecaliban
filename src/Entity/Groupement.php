<?php

namespace App\Entity;

use App\Repository\GroupementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupementRepository::class)]
class Groupement
{
    use \App\Trait\TraitDate;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 12)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $address = null;

    /**
     * @var Collection<int, Exercice>
     */
    #[ORM\OneToMany(targetEntity: Exercice::class, mappedBy: 'groupement', orphanRemoval: true)]
    private Collection $exercies;

    public function __construct()
    {
        $this->exercies = new ArrayCollection();
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercies;
    }

    public function addExercy(Exercice $exercy): static
    {
        if (!$this->exercies->contains($exercy)) {
            $this->exercies->add($exercy);
            $exercy->setGroupement($this);
        }

        return $this;
    }

    public function removeExercy(Exercice $exercy): static
    {
        if ($this->exercies->removeElement($exercy)) {
            // set the owning side to null (unless already changed)
            if ($exercy->getGroupement() === $this) {
                $exercy->setGroupement(null);
            }
        }

        return $this;
    }
}

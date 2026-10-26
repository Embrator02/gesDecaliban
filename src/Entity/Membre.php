<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 9)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateNaiss = null;

    #[ORM\Column(length: 100)]
    private ?string $fonctionnalite = null;

    #[ORM\OneToOne(inversedBy: 'membre', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    /**
     * @var Collection<int, ModeDeCotisation>
     */
    #[ORM\OneToMany(targetEntity: ModeDeCotisation::class, mappedBy: 'membre')]
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getDateNaiss(): ?\DateTime
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTime $dateNaiss): static
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getFonctionnalite(): ?string
    {
        return $this->fonctionnalite;
    }

    public function setFonctionnalite(string $fonctionnalite): static
    {
        $this->fonctionnalite = $fonctionnalite;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
            $modeDeCotisation->setMembre($this);
        }

        return $this;
    }

    public function removeModeDeCotisation(ModeDeCotisation $modeDeCotisation): static
    {
        if ($this->modeDeCotisations->removeElement($modeDeCotisation)) {
            // set the owning side to null (unless already changed)
            if ($modeDeCotisation->getMembre() === $this) {
                $modeDeCotisation->setMembre(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ParcelleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcelleRepository::class)]
class Parcelle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $coordonnees = null;

    /**
     * @var Collection<int, Culture>
     */
    #[ORM\OneToMany(targetEntity: Culture::class, mappedBy: 'parcelle', orphanRemoval: true)]
    private Collection $cultures;

    /**
     * @var Collection<int, Epandre>
     */
    #[ORM\OneToMany(targetEntity: Epandre::class, mappedBy: 'parcelle')]
    private Collection $epandres;

    public function __construct()
    {
        $this->cultures = new ArrayCollection();
        $this->epandres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): static
    {
        $this->surface = $surface;

        return $this;
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

    public function getCoordonnees(): ?string
    {
        return $this->coordonnees;
    }

    public function setCoordonnees(string $coordonnees): static
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    /**
     * @return Collection<int, Culture>
     */
    public function getCultures(): Collection
    {
        return $this->cultures;
    }

    public function addCulture(Culture $culture): static
    {
        if (!$this->cultures->contains($culture)) {
            $this->cultures->add($culture);
            $culture->setParcelle($this);
        }

        return $this;
    }

    public function removeCulture(Culture $culture): static
    {
        if ($this->cultures->removeElement($culture)) {
            // set the owning side to null (unless already changed)
            if ($culture->getParcelle() === $this) {
                $culture->setParcelle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Epandre>
     */
    public function getEpandres(): Collection
    {
        return $this->epandres;
    }

    public function addEpandre(Epandre $epandre): static
    {
        if (!$this->epandres->contains($epandre)) {
            $this->epandres->add($epandre);
            $epandre->setParcelle($this);
        }

        return $this;
    }

    public function removeEpandre(Epandre $epandre): static
    {
        if ($this->epandres->removeElement($epandre)) {
            // set the owning side to null (unless already changed)
            if ($epandre->getParcelle() === $this) {
                $epandre->setParcelle(null);
            }
        }

        return $this;
    }
}

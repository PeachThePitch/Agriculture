<?php

namespace App\Entity;

use App\Repository\ProductionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionRepository::class)]
class Production
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomProduction = null;

    #[ORM\ManyToOne(inversedBy: 'productions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unite $unite = null;

    /**
     * @var Collection<int, Culture>
     */
    #[ORM\OneToMany(targetEntity: Culture::class, mappedBy: 'production')]
    private Collection $cultures;

    public function __construct()
    {
        $this->cultures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduction(): ?string
    {
        return $this->nomProduction;
    }

    public function setNomProduction(string $nomProduction): static
    {
        $this->nomProduction = $nomProduction;

        return $this;
    }

    public function getUnite(): ?Unite
    {
        return $this->unite;
    }

    public function setUnite(?Unite $unite): static
    {
        $this->unite = $unite;

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
            $culture->setProduction($this);
        }

        return $this;
    }

    public function removeCulture(Culture $culture): static
    {
        if ($this->cultures->removeElement($culture)) {
            // set the owning side to null (unless already changed)
            if ($culture->getProduction() === $this) {
                $culture->setProduction(null);
            }
        }

        return $this;
    }
}

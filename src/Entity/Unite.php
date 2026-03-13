<?php

namespace App\Entity;

use App\Repository\UniteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniteRepository::class)]
class Unite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $unite = null;

    /**
     * @var Collection<int, ElementChimique>
     */
    #[ORM\OneToMany(targetEntity: ElementChimique::class, mappedBy: 'unite', orphanRemoval: true)]
    private Collection $elementChimiques;

    public function __construct()
    {
        $this->elementChimiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnite(): ?int
    {
        return $this->unite;
    }

    public function setUnite(int $unite): static
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * @return Collection<int, ElementChimique>
     */
    public function getElementChimiques(): Collection
    {
        return $this->elementChimiques;
    }

    public function addElementChimique(ElementChimique $elementChimique): static
    {
        if (!$this->elementChimiques->contains($elementChimique)) {
            $this->elementChimiques->add($elementChimique);
            $elementChimique->setUnite($this);
        }

        return $this;
    }

    public function removeElementChimique(ElementChimique $elementChimique): static
    {
        if ($this->elementChimiques->removeElement($elementChimique)) {
            // set the owning side to null (unless already changed)
            if ($elementChimique->getUnite() === $this) {
                $elementChimique->setUnite(null);
            }
        }

        return $this;
    }
}

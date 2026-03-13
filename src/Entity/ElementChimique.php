<?php

namespace App\Entity;

use App\Repository\ElementChimiqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementChimiqueRepository::class)]
class ElementChimique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelleElement = null;

    #[ORM\ManyToOne(inversedBy: 'elementChimiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unite $unite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleElement(): ?string
    {
        return $this->libelleElement;
    }

    public function setLibelleElement(string $libelleElement): static
    {
        $this->libelleElement = $libelleElement;

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
}

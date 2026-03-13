<?php

namespace App\Entity;

use App\Repository\PossederRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PossederRepository::class)]
class Posseder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ElementChimique $codeElement = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Engrais $idEngrais = null;

    #[ORM\Column]
    private ?int $valeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeElement(): ?ElementChimique
    {
        return $this->codeElement;
    }

    public function setCodeElement(?ElementChimique $codeElement): static
    {
        $this->codeElement = $codeElement;

        return $this;
    }

    public function getIdEngrais(): ?Engrais
    {
        return $this->idEngrais;
    }

    public function setIdEngrais(?Engrais $idEngrais): static
    {
        $this->idEngrais = $idEngrais;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }
}

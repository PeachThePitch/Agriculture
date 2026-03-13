<?php

namespace App\Entity;

use App\Repository\EngraisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EngraisRepository::class)]
class Engrais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomEngrais = null;

    #[ORM\ManyToOne(inversedBy: 'engrais')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unite $unite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEngrais(): ?string
    {
        return $this->NomEngrais;
    }

    public function setNomEngrais(string $NomEngrais): static
    {
        $this->NomEngrais = $NomEngrais;

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

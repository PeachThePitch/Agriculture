<?php

namespace App\Entity;

use App\Repository\EpandreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpandreRepository::class)]
class Epandre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'epandres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Engrais $engrais = null;

    #[ORM\ManyToOne(inversedBy: 'epandres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parcelle $parcelle = null;

    #[ORM\ManyToOne(inversedBy: 'epandres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Date $date = null;

    #[ORM\Column]
    private ?int $qteEpandue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEngrais(): ?Engrais
    {
        return $this->engrais;
    }

    public function setEngrais(?Engrais $engrais): static
    {
        $this->engrais = $engrais;

        return $this;
    }

    public function getParcelle(): ?Parcelle
    {
        return $this->parcelle;
    }

    public function setParcelle(?Parcelle $parcelle): static
    {
        $this->parcelle = $parcelle;

        return $this;
    }

    public function getDate(): ?Date
    {
        return $this->date;
    }

    public function setDate(?Date $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getQteEpandue(): ?int
    {
        return $this->qteEpandue;
    }

    public function setQteEpandue(int $qteEpandue): static
    {
        $this->qteEpandue = $qteEpandue;

        return $this;
    }
}

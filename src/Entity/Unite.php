<?php

namespace App\Entity;

use App\Repository\UniteRepository;
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
}

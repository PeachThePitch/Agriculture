<?php

namespace App\Entity;

use App\Repository\DateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DateRepository::class)]
class Date
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    /**
     * @var Collection<int, Epandre>
     */
    #[ORM\OneToMany(targetEntity: Epandre::class, mappedBy: 'date')]
    private Collection $epandres;

    public function __construct()
    {
        $this->epandres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

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
            $epandre->setDate($this);
        }

        return $this;
    }

    public function removeEpandre(Epandre $epandre): static
    {
        if ($this->epandres->removeElement($epandre)) {
            // set the owning side to null (unless already changed)
            if ($epandre->getDate() === $this) {
                $epandre->setDate(null);
            }
        }

        return $this;
    }
}

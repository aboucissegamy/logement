<?php

namespace App\Entity;

use App\Repository\EtatsDesLieuxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatsDesLieuxRepository::class)]
class EtatsDesLieux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    private ? string $dateentree = null;
    private ?\DateTimeInterface $datesortie = null;

    #[ORM\Column(length: 100)]
    private ?string $remarque = null;

    #[ORM\OneToMany(mappedBy: 'EtatsDesLieux', targetEntity: Appartement::class)]
    private Collection $appartements;

    public function __construct()
    {
        $this->appartements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateentree()
    {
        return $this->dateentree;
    }

    public function setDateentree(string $dateentree): self
    {
        $this->dateentree = $dateentree;

        return $this;
    }

    public function getDatesortie(): ?\DateTimeInterface
    {
        return $this->datesortie;
    }

    public function setDatesortie(\DateTimeInterface $datesortie): self
    {
        $this->datesortie = $datesortie;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * @return Collection<int, Appartement>
     */
    public function getAppartements(): Collection
    {
        return $this->appartements;
    }

    public function addAppartement(Appartement $appartement): self
    {
        if (!$this->appartements->contains($appartement)) {
            $this->appartements->add($appartement);
            $appartement->setEtatsDesLieux($this);
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): self
    {
        if ($this->appartements->removeElement($appartement)) {
            // set the owning side to null (unless already changed)
            if ($appartement->getEtatsDesLieux() === $this) {
                $appartement->setEtatsDesLieux(null);
            }
        }

        return $this;
    }
  
}

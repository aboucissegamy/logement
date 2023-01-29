<?php

namespace App\Entity;

use App\Repository\DepotDeGarantieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepotDeGarantieRepository::class)]
class DepotDeGarantie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $montant = null;

    #[ORM\Column(length: 100)]
    private ?string $datepaiement = null;

    #[ORM\ManyToOne(inversedBy: 'depotDeGaranties')]
    private ?Locataire $Locataire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDatepaiement(): ?string
    {
        return $this->datepaiement;
    }

    public function setDatepaiement(string $datepaiement): self
    {
        $this->datepaiement = $datepaiement;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->Locataire;
    }

    public function setLocataire(?Locataire $Locataire): self
    {
        $this->Locataire = $Locataire;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\LocataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocataireRepository::class)]
class Locataire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 100)]
    private ?string $adressse = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column(length: 100)]
    private ?string $solde = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'locataires')] // pour dire que c'est une relation avec une autre table 
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]// mappé qui veut dire quelle est reliée à la table parent
    private Collection $locataires;

    #[ORM\OneToMany(mappedBy: 'Locataire', targetEntity: DepotDeGarantie::class)]
    private Collection $depotDeGaranties;

    public function __construct()
    {
        $this->locataires = new ArrayCollection();// une collecttion de locataire 
        $this->depotDeGaranties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdressse(): ?string
    {
        return $this->adressse;
    }

    public function setAdressse(string $adressse): self
    {
        $this->adressse = $adressse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getLocataires(): Collection // pour recuperer les informations des locataires
    {
        return $this->locataires;
    }

    public function addLocataire(self $locataire): self // pour ajouter les differents locataires
    {
        if (!$this->locataires->contains($locataire)) 
        {
            $this->locataires->add($locataire);
            $locataire->setParent($this);
        }

        return $this;
    }

    public function removeLocataire(self $locataire): self
    {
        if ($this->locataires->removeElement($locataire)) {
            // set the owning side to null (unless already changed)
            if ($locataire->getParent() === $this) {
                $locataire->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DepotDeGarantie>
     */
    public function getDepotDeGaranties(): Collection
    {
        return $this->depotDeGaranties;
    }

    public function addDepotDeGaranty(DepotDeGarantie $depotDeGaranty): self
    {
        if (!$this->depotDeGaranties->contains($depotDeGaranty)) {
            $this->depotDeGaranties->add($depotDeGaranty);
            $depotDeGaranty->setLocataire($this);
        }

        return $this;
    }

    public function removeDepotDeGaranty(DepotDeGarantie $depotDeGaranty): self
    {
        if ($this->depotDeGaranties->removeElement($depotDeGaranty)) {
            // set the owning side to null (unless already changed)
            if ($depotDeGaranty->getLocataire() === $this) {
                $depotDeGaranty->setLocataire(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nom; // Remplacer champ par une propriété "string" de l'entité
    }
}

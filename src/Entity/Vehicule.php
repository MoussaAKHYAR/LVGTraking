<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string")
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $maintenance;

    /**
     * @ORM\Column(type="float")
     */
    private $consoKm;

    /**
     * @ORM\Column(type="float")
     */
    private $carburantActuel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheDeSortie", mappedBy="vehicule")
     */
    private $ficheDeSortie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Alert", mappedBy="vehicule")
     */
    private $alert;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="vehicules")
     */
    private $groupe;

    public function __construct()
    {
        $this->ficheDeSortie = new ArrayCollection();
        $this->alert = new ArrayCollection();
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

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getImmatriculation(): ?int
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(int $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getMaintenance(): ?bool
    {
        return $this->maintenance;
    }

    public function setMaintenance(bool $maintenance): self
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    public function getConsoKm(): ?float
    {
        return $this->consoKm;
    }

    public function setConsoKm(float $consoKm): self
    {
        $this->consoKm = $consoKm;

        return $this;
    }

    public function getCarburantActuel(): ?float
    {
        return $this->carburantActuel;
    }

    public function setCarburantActuel(float $carburantActuel): self
    {
        $this->carburantActuel = $carburantActuel;

        return $this;
    }

    /**
     * @return Collection|FicheDeSortie[]
     */
    public function getFicheDeSortie(): Collection
    {
        return $this->ficheDeSortie;
    }

    public function addFicheDeSortie(FicheDeSortie $ficheDeSortie): self
    {
        if (!$this->ficheDeSortie->contains($ficheDeSortie)) {
            $this->ficheDeSortie[] = $ficheDeSortie;
            $ficheDeSortie->setVehicule($this);
        }

        return $this;
    }

    public function removeFicheDeSortie(FicheDeSortie $ficheDeSortie): self
    {
        if ($this->ficheDeSortie->contains($ficheDeSortie)) {
            $this->ficheDeSortie->removeElement($ficheDeSortie);
            // set the owning side to null (unless already changed)
            if ($ficheDeSortie->getVehicule() === $this) {
                $ficheDeSortie->setVehicule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Alert[]
     */
    public function getAlert(): Collection
    {
        return $this->alert;
    }

    public function addAlert(Alert $alert): self
    {
        if (!$this->alert->contains($alert)) {
            $this->alert[] = $alert;
            $alert->setVehicule($this);
        }

        return $this;
    }

    public function removeAlert(Alert $alert): self
    {
        if ($this->alert->contains($alert)) {
            $this->alert->removeElement($alert);
            // set the owning side to null (unless already changed)
            if ($alert->getVehicule() === $this) {
                $alert->setVehicule(null);
            }
        }

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }
}

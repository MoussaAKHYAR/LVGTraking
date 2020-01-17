<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheDeSortieRepository")
 */
class FicheDeSortie
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
    private $lieuDepart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destination;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreLitre;

    /**
     * @ORM\Column(type="float")
     */
    private $latitudedestination;

    /**
     * @ORM\Column(type="float")
     */
    private $longitudeDestination;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombrePoint;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule", inversedBy="ficheDeSortie")
     */
    private $vehicule;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rapport", mappedBy="ficheDeSortie")
     */
    private $rapport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Historique", mappedBy="ficheDeSortie")
     */
    private $historique;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Position", mappedBy="ficheDeSortie")
     */
    private $positions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Accident", mappedBy="ficheDeSortie")
     */
    private $accidents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Conducteur", inversedBy="ficheDeSorties")
     */
    private $conducteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PointDinteret", inversedBy="ficheDeSorties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pointDinteret;

    public function __construct()
    {
        $this->pointDinterets = new ArrayCollection();
        $this->rapport = new ArrayCollection();
        $this->historique = new ArrayCollection();
        $this->positions = new ArrayCollection();
        $this->accidents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuDepart(): ?string
    {
        return $this->lieuDepart;
    }

    public function setLieuDepart(string $lieuDepart): self
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getNombreLitre(): ?int
    {
        return $this->nombreLitre;
    }

    public function setNombreLitre(int $nombreLitre): self
    {
        $this->nombreLitre = $nombreLitre;

        return $this;
    }

    public function getLatitudedestination(): ?float
    {
        return $this->latitudedestination;
    }

    public function setLatitudedestination(float $latitudedestination): self
    {
        $this->latitudedestination = $latitudedestination;

        return $this;
    }

    public function getLongitudeDestination(): ?float
    {
        return $this->longitudeDestination;
    }

    public function setLongitudeDestination(float $longitudeDestination): self
    {
        $this->longitudeDestination = $longitudeDestination;

        return $this;
    }

    public function getNombrePoint(): ?int
    {
        return $this->nombrePoint;
    }

    public function setNombrePoint(int $nombrePoint): self
    {
        $this->nombrePoint = $nombrePoint;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    
    public function getPointDinterets(): Collection
    {
        return $this->pointDinterets;
    }

    public function addPointDinteret(PointDinteret $pointDinteret): self
    {
        if (!$this->pointDinterets->contains($pointDinteret)) {
            $this->pointDinterets[] = $pointDinteret;
            $pointDinteret->setFicheDeSortie($this);
        }

        return $this;
    }

    public function removePointDinteret(PointDinteret $pointDinteret): self
    {
        if ($this->pointDinterets->contains($pointDinteret)) {
            $this->pointDinterets->removeElement($pointDinteret);
            // set the owning side to null (unless already changed)
            if ($pointDinteret->getFicheDeSortie() === $this) {
                $pointDinteret->setFicheDeSortie(null);
            }
        }

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * @return Collection|Rapport[]
     */
    public function getRapport(): Collection
    {
        return $this->rapport;
    }

    public function addRapport(Rapport $rapport): self
    {
        if (!$this->rapport->contains($rapport)) {
            $this->rapport[] = $rapport;
            $rapport->setFicheDeSortie($this);
        }

        return $this;
    }

    public function removeRapport(Rapport $rapport): self
    {
        if ($this->rapport->contains($rapport)) {
            $this->rapport->removeElement($rapport);
            // set the owning side to null (unless already changed)
            if ($rapport->getFicheDeSortie() === $this) {
                $rapport->setFicheDeSortie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Historique[]
     */
    public function getHistorique(): Collection
    {
        return $this->historique;
    }

    public function addHistorique(Historique $historique): self
    {
        if (!$this->historique->contains($historique)) {
            $this->historique[] = $historique;
            $historique->setFicheDeSortie($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historique->contains($historique)) {
            $this->historique->removeElement($historique);
            // set the owning side to null (unless already changed)
            if ($historique->getFicheDeSortie() === $this) {
                $historique->setFicheDeSortie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Position[]
     */
    public function getPositions(): Collection
    {
        return $this->positions;
    }

    public function addPosition(Position $position): self
    {
        if (!$this->positions->contains($position)) {
            $this->positions[] = $position;
            $position->setFicheDeSortie($this);
        }

        return $this;
    }

    public function removePosition(Position $position): self
    {
        if ($this->positions->contains($position)) {
            $this->positions->removeElement($position);
            // set the owning side to null (unless already changed)
            if ($position->getFicheDeSortie() === $this) {
                $position->setFicheDeSortie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Accident[]
     */
    public function getAccidents(): Collection
    {
        return $this->accidents;
    }

    public function addAccident(Accident $accident): self
    {
        if (!$this->accidents->contains($accident)) {
            $this->accidents[] = $accident;
            $accident->setFicheDeSortie($this);
        }

        return $this;
    }

    public function removeAccident(Accident $accident): self
    {
        if ($this->accidents->contains($accident)) {
            $this->accidents->removeElement($accident);
            // set the owning side to null (unless already changed)
            if ($accident->getFicheDeSortie() === $this) {
                $accident->setFicheDeSortie(null);
            }
        }

        return $this;
    }

    public function getConducteur(): ?Conducteur
    {
        return $this->conducteur;
    }

    public function setConducteur(?Conducteur $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    public function setPointDinterets(?PointDinteret $pointDinterets): self
    {
        $this->pointDinterets = $pointDinterets;

        return $this;
    }

    public function getPointDinteret(): ?PointDinteret
    {
        return $this->pointDinteret;
    }

    public function setPointDinteret(?PointDinteret $pointDinteret): self
    {
        $this->pointDinteret = $pointDinteret;

        return $this;
    }
}

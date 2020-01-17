<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PointDinteretRepository")
 */
class PointDinteret
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
    private $lieu;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheDeSortie", mappedBy="pointDinterets")
     */
    private $ficheDeSortie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheDeSortie", mappedBy="pointDinteret")
     */
    private $ficheDeSorties;

    public function __construct()
    {
        $this->ficheDeSorties = new ArrayCollection();
        $this->ficheDeSortie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getFicheDeSortie(): ?FicheDeSortie
    {
        return $this->ficheDeSortie;
    }

    public function setFicheDeSortie(?FicheDeSortie $ficheDeSortie): self
    {
        $this->ficheDeSortie = $ficheDeSortie;

        return $this;
    }

    /**
     * @return Collection|FicheDeSortie[]
     */
    public function getFicheDeSorties(): Collection
    {
        return $this->ficheDeSorties;
    }

    public function addFicheDeSorty(FicheDeSortie $ficheDeSorty): self
    {
        if (!$this->ficheDeSorties->contains($ficheDeSorty)) {
            $this->ficheDeSorties[] = $ficheDeSorty;
            $ficheDeSorty->setPointDinteret($this);
        }

        return $this;
    }

    public function removeFicheDeSorty(FicheDeSortie $ficheDeSorty): self
    {
        if ($this->ficheDeSorties->contains($ficheDeSorty)) {
            $this->ficheDeSorties->removeElement($ficheDeSorty);
            // set the owning side to null (unless already changed)
            if ($ficheDeSorty->getPointDinteret() === $this) {
                $ficheDeSorty->setPointDinteret(null);
            }
        }

        return $this;
    }

    public function addFicheDeSortie(FicheDeSortie $ficheDeSortie): self
    {
        if (!$this->ficheDeSortie->contains($ficheDeSortie)) {
            $this->ficheDeSortie[] = $ficheDeSortie;
            $ficheDeSortie->setPointDinterets($this);
        }

        return $this;
    }

    public function removeFicheDeSortie(FicheDeSortie $ficheDeSortie): self
    {
        if ($this->ficheDeSortie->contains($ficheDeSortie)) {
            $this->ficheDeSortie->removeElement($ficheDeSortie);
            // set the owning side to null (unless already changed)
            if ($ficheDeSortie->getPointDinterets() === $this) {
                $ficheDeSortie->setPointDinterets(null);
            }
        }

        return $this;
    }
}

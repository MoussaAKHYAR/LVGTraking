<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SimulationRepository")
 */
class Simulation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $latitudeDepart;

    /**
     * @ORM\Column(type="float")
     */
    private $longitudeDepart;

    /**
     * @ORM\Column(type="float")
     */
    private $latitudeDestination;

    /**
     * @ORM\Column(type="float")
     */
    private $longitudeDestination;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\FicheDeSortie", cascade={"persist", "remove"})
     */
    private $ficheDeSortie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitudeDepart(): ?float
    {
        return $this->latitudeDepart;
    }

    public function setLatitudeDepart(float $latitudeDepart): self
    {
        $this->latitudeDepart = $latitudeDepart;

        return $this;
    }

    public function getLongitudeDepart(): ?float
    {
        return $this->longitudeDepart;
    }

    public function setLongitudeDepart(float $longitudeDepart): self
    {
        $this->longitudeDepart = $longitudeDepart;

        return $this;
    }

    public function getLatitudeDestination(): ?float
    {
        return $this->latitudeDestination;
    }

    public function setLatitudeDestination(float $latitudeDestination): self
    {
        $this->latitudeDestination = $latitudeDestination;

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

    public function getFicheDeSortie(): ?FicheDeSortie
    {
        return $this->ficheDeSortie;
    }

    public function setFicheDeSortie(?FicheDeSortie $ficheDeSortie): self
    {
        $this->ficheDeSortie = $ficheDeSortie;

        return $this;
    }
}

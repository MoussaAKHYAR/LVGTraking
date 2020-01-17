<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipementRepository")
 */
class Equipement
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
    private $numeroSerie;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDacquisition;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vehicule", cascade={"persist"})
     */
    private $vehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroSerie(): ?string
    {
        return $this->numeroSerie;
    }

    public function setNumeroSerie(string $numeroSerie): self
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }

    public function getDateDacquisition(): ?\DateTimeInterface
    {
        return $this->dateDacquisition;
    }

    public function setDateDacquisition(\DateTimeInterface $dateDacquisition): self
    {
        $this->dateDacquisition = $dateDacquisition;

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
}

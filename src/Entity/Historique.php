<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoriqueRepository")
 */
class Historique
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
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FicheDeSortie", inversedBy="historique")
     */
    private $ficheDeSortie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

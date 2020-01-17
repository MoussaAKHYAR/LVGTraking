<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConducteurRepository")
 */
class Conducteur
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
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $DateNaissance;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheDeSortie", mappedBy="conducteur")
     */
    private $ficheDeSorties;

    public function __construct()
    {
        $this->ficheDeSorties = new ArrayCollection();
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

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $DateNaissance): self
    {
        $this->DateNaissance = $DateNaissance;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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
            $ficheDeSorty->setConducteur($this);
        }

        return $this;
    }

    public function removeFicheDeSorty(FicheDeSortie $ficheDeSorty): self
    {
        if ($this->ficheDeSorties->contains($ficheDeSorty)) {
            $this->ficheDeSorties->removeElement($ficheDeSorty);
            // set the owning side to null (unless already changed)
            if ($ficheDeSorty->getConducteur() === $this) {
                $ficheDeSorty->setConducteur(null);
            }
        }

        return $this;
    }
}

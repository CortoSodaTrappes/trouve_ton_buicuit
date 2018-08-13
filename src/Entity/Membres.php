<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembresRepository")
 */
class Membres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=80)
     */
    public $email;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recherches", mappedBy="id_membre")
     */
    private $recherches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Presentations", mappedBy="id_membre")
     */
    private $presentations;

    public function __construct()
    {
        $this->recherches = new ArrayCollection();
        $this->presentations = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Recherches[]
     */
    public function getRecherches(): Collection
    {
        return $this->recherches;
    }

    public function addRecherch(Recherches $recherch): self
    {
        if (!$this->recherches->contains($recherch)) {
            $this->recherches[] = $recherch;
            $recherch->setIdMembre($this);
        }

        return $this;
    }

    public function removeRecherch(Recherches $recherch): self
    {
        if ($this->recherches->contains($recherch)) {
            $this->recherches->removeElement($recherch);
            // set the owning side to null (unless already changed)
            if ($recherch->getIdMembre() === $this) {
                $recherch->setIdMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Presentations[]
     */
    public function getPresentations(): Collection
    {
        return $this->presentations;
    }

    public function addPresentation(Presentations $presentation): self
    {
        if (!$this->presentations->contains($presentation)) {
            $this->presentations[] = $presentation;
            $presentation->setIdMembre($this);
        }

        return $this;
    }

    public function removePresentation(Presentations $presentation): self
    {
        if ($this->presentations->contains($presentation)) {
            $this->presentations->removeElement($presentation);
            // set the owning side to null (unless already changed)
            if ($presentation->getIdMembre() === $this) {
                $presentation->setIdMembre(null);
            }
        }

        return $this;
    }
}

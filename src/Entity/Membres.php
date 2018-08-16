<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembresRepository")
 */
class Membres implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * 
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Messagerie", mappedBy="id_expediteur", orphanRemoval=true)
     */
    private $messageries;

    /**
     * @ORM\Column(type="string", length=48)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * //@Assert\NotBlank(message="Please, upload image.")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg", "image/jpg", "image/gif" })
     */
    private $mainimage;

    public function __construct()
    {
        $this->recherches = new ArrayCollection();
        $this->presentations = new ArrayCollection();
        $this->messageries = new ArrayCollection();
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

    /**
     * @return Collection|Messagerie[]
     */
    public function getMessageries(): Collection
    {
        return $this->messageries;
    }

    public function addMessagery(Messagerie $messagery): self
    {
        if (!$this->messageries->contains($messagery)) {
            $this->messageries[] = $messagery;
            $messagery->setIdExpediteur($this);
        }

        return $this;
    }

    public function removeMessagery(Messagerie $messagery): self
    {
        if ($this->messageries->contains($messagery)) {
            $this->messageries->removeElement($messagery);
            // set the owning side to null (unless already changed)
            if ($messagery->getIdExpediteur() === $this) {
                $messagery->setIdExpediteur(null);
            }
        }

        return $this;
    }

    public function getRoles(){
        return array("ROLE_USER") ;

    }

    public function getSalt(){}

    public function getUsername(){
        return $this->getEmail();
    }

    public function eraseCredentials(){}

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getMainimage(): ?string
    {
        return $this->mainimage;
    }

    public function setMainimage(?string $mainimage): self
    {
        $this->mainimage = $mainimage;

        return $this;
    }

}

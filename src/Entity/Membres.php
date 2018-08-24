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

    // /**
    //  * @ORM\OneToMany(targetEntity="App\Entity\Recherches", mappedBy="id_membre")
    //  */
    // private $recherches;

    // /**
    //  * @ORM\OneToMany(targetEntity="App\Entity\Presentations", mappedBy="id_membre")
    //  */
    // private $presentations;

    // /**
    //  * @ORM\OneToMany(targetEntity="App\Entity\Messagerie", mappedBy="id_expediteur", orphanRemoval=true)
    //  */
    //private $messageries;

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

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="date")
     */
    private $naissance;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $trait_caractere;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $type_relation;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $taille;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $silhouette;

    /**
     * @ORM\Column(type="string", length=48, nullable=true)
     */
    private $yeux;

    /**
     * @ORM\Column(type="string", length=48, nullable=true)
     */
    private $cheveux;

    /**
     * @ORM\Column(type="string", length=18, nullable=true)
     */
    private $fume;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $mange;

    /**
     * @ORM\Column(type="string", length=48)
     */
    private $jesuis;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $jeveux;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $punchline;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $animaux;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $hobby;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Messages", mappedBy="destinataire")
     */
    private $messages;

    public function __construct()
    {
        $this->recherches = new ArrayCollection();
        $this->presentations = new ArrayCollection();
        //$this->messageries = new ArrayCollection();

        $this->setTraitCaractere("Non renseigné");
        $this->setTypeRelation("Non renseigné");
        $this->setTaille("Non renseigné");
        $this->setCheveux("Non renseigné");
        $this->setFume("Non renseigné");
        $this->setJesuis("Non renseigné");
        $this->setJeveux("Non renseigné");
        $this->setMange("Non renseigné");
        $this->setSilhouette("Non renseigné");
        $this->setYeux("Non renseigné");
        $this->messages = new ArrayCollection();
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

    // /**
    //  * @return Collection|Recherches[]
    //  */
    // public function getRecherches(): Collection
    // {
    //     return $this->recherches;
    // }

    // public function addRecherche(Recherches $recherche): self
    // {
    //     if (!$this->recherches->contains($recherche)) {
    //         $this->recherches[] = $recherche;
    //         $recherche->setIdMembre($this);
    //     }

    //     return $this;
    // }

    // public function removeRecherche(Recherches $recherche): self
    // {
    //     if ($this->recherches->contains($recherche)) {
    //         $this->recherches->removeElement($recherche);
    //         // set the owning side to null (unless already changed)
    //         if ($recherche->getIdMembre() === $this) {
    //             $recherche->setIdMembre(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection|Presentations[]
    //  */
    // public function getPresentations(): Collection
    // {
    //     return $this->presentations;
    // }

    // public function addPresentation(Presentations $presentation): self
    // {
    //     if (!$this->presentations->contains($presentation)) {
    //         $this->presentations[] = $presentation;
    //         $presentation->setIdMembre($this);
    //     }

    //     return $this;
    // }

    // public function removePresentation(Presentations $presentation): self
    // {
    //     if ($this->presentations->contains($presentation)) {
    //         $this->presentations->removeElement($presentation);
    //         // set the owning side to null (unless already changed)
    //         if ($presentation->getIdMembre() === $this) {
    //             $presentation->setIdMembre(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection|Messagerie[]
    //  */
    // public function getMessageries(): Collection
    // {
    //     return $this->messageries;
    // }

    // public function addMessagery(Messagerie $messagery): self
    // {
    //     if (!$this->messageries->contains($messagery)) {
    //         $this->messageries[] = $messagery;
    //         $messagery->setIdExpediteur($this);
    //     }

    //     return $this;
    // }

    // public function removeMessagery(Messagerie $messagery): self
    // {
    //     if ($this->messageries->contains($messagery)) {
    //         $this->messageries->removeElement($messagery);
    //         // set the owning side to null (unless already changed)
    //         if ($messagery->getIdExpediteur() === $this) {
    //             $messagery->setIdExpediteur(null);
    //         }
    //     }

    //     return $this;
    // }

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


    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNaissance(): ?\DateTimeInterface
    {
        return $this->naissance;
    }

    public function setNaissance(\DateTimeInterface $naissance): self
    {
        $this->naissance = $naissance;

        return $this;
    }

    public function getTraitCaractere(): ?string
    {
        return $this->trait_caractere;
    }

    public function setTraitCaractere(?string $trait_caractere): self
    {
        $this->trait_caractere = $trait_caractere;

        return $this;
    }

    public function getTypeRelation(): ?string
    {
        return $this->type_relation;
    }

    public function setTypeRelation(?string $type_relation): self
    {
        $this->type_relation = $type_relation;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(?string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getSilhouette(): ?string
    {
        return $this->silhouette;
    }

    public function setSilhouette(?string $silhouette): self
    {
        $this->silhouette = $silhouette;

        return $this;
    }

    public function getYeux(): ?string
    {
        return $this->yeux;
    }

    public function setYeux(?string $yeux): self
    {
        $this->yeux = $yeux;

        return $this;
    }

    public function getCheveux(): ?string
    {
        return $this->cheveux;
    }

    public function setCheveux(?string $cheveux): self
    {
        $this->cheveux = $cheveux;

        return $this;
    }

    public function getFume(): ?string
    {
        return $this->fume;
    }

    public function setFume(?string $fume): self
    {
        $this->fume = $fume;

        return $this;
    }

    public function getMange(): ?string
    {
        return $this->mange;
    }

    public function setMange(?string $mange): self
    {
        $this->mange = $mange;

        return $this;
    }

    public function getJesuis(): ?string
    {
        return $this->jesuis;
    }

    public function setJesuis(?string $jesuis): self
    {
        $this->jesuis = $jesuis;

        return $this;
    }

    public function getJeveux(): ?string
    {
        return $this->jeveux;
    }

    public function setJeveux(?string $jeveux): self
    {
        $this->jeveux = $jeveux;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPunchline(): ?string
    {
        return $this->punchline;
    }

    public function setPunchline(?string $punchline): self
    {
        $this->punchline = $punchline;

        return $this;
    }

    public function getAnimaux(): ?string
    {
        return $this->animaux;
    }

    public function setAnimaux(?string $animaux): self
    {
        $this->animaux = $animaux;

        return $this;
    }

    public function getHobby(): ?string
    {
        return $this->hobby;
    }

    public function setHobby(?string $hobby): self
    {
        $this->hobby = $hobby;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Messages[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setDestinataire($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getDestinataire() === $this) {
                $message->setDestinataire(null);
            }
        }

        return $this;
    }
}


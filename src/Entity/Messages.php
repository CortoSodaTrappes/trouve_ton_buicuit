<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessagesRepository")
 */
class Messages
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $texte;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membres", inversedBy="messages")
     */
    private $destinataire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membres", inversedBy="messages")
     */
    private $expediteur;

    public function getId()
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDestinataire(): ?Membres
    {
        return $this->destinataire;
    }

    public function setDestinataire(?Membres $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getExpediteur(): ?Membres
    {
        return $this->expediteur;
    }

    public function setExpediteur(?Membres $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }
}

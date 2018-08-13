<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessagerieRepository")
 */
class Messagerie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membres", inversedBy="messageries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_expediteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membres", inversedBy="messageries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_destinataire;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    public function getId()
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(): self
    {
        $this->date =  new \DateTime() ;

        return $this;
    }

    public function getIdExpediteur(): ?Membres
    {
        return $this->id_expediteur;
    }

    public function setIdExpediteur(?Membres $id_expediteur): self
    {
        $this->id_expediteur = $id_expediteur;

        return $this;
    }

    public function getIdDestinataire(): ?Membres
    {
        return $this->id_destinataire;
    }

    public function setIdDestinataire(?Membres $id_destinataire): self
    {
        $this->id_destinataire = $id_destinataire;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(): self
    {
        $this->created =  new \DateTime() ;

        return $this;
    }
}

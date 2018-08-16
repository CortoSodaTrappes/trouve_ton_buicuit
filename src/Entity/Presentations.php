<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PresentationsRepository")
 */
class Presentations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type_personne;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type_relation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membres", inversedBy="presentations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_membre;

    public function __construct($id_membre){
        $this->setIdMembre($id_membre);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getTypePersonne(): ?string
    {
        return $this->type_personne;
    }

    public function setTypePersonne(string $type_personne): self
    {
        $this->type_personne = $type_personne;

        return $this;
    }

    public function getTypeRelation(): ?string
    {
        return $this->type_relation;
    }

    public function setTypeRelation(string $type_relation): self
    {
        $this->type_relation = $type_relation;

        return $this;
    }

    public function getIdMembre(): ?Membres
    {
        return $this->id_membre;
    }

    public function setIdMembre(?Membres $id_membre): self
    {
        $this->id_membre = $id_membre;

        return $this;
    }

    public function init(){
        $this->setPresentation("Présentation par défaut.");
        $this->setTypePersonne('h');
        $this->setTypeRelation("1");
    }
}

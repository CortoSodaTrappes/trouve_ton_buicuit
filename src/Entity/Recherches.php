<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecherchesRepository")
 */
class Recherches
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=48)
     */
    private $type_personne;

    /**
     * @ORM\Column(type="string", length=48)
     */
    private $type_relation;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $titre_recherche;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membres", inversedBy="recherches")
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

    public function getTitreRecherche(): ?string
    {
        return $this->titre_recherche;
    }

    public function setTitreRecherche(string $titre_recherche): self
    {
        $this->titre_recherche = $titre_recherche;

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
        $this->setTypePersonne('f');
        $this->setTypeRelation('2');
        $this->setTitreRecherche('Recherche type');
    }

    public function getAllElement(){
        return array(
            "id" => $this->getId(),
            "titre_recherche" => $this->getTitreRecherche(),
            "type_personne" => $this->getTypePersonne(),
            "type_relation" => $this->getTypeRelation(),
        );
    }    
}

<?php

namespace Model\Entity;

use App\AbstractEntity;

class Categorie extends AbstractEntity
{
    private $utilisateur;

    
    public function __construct($data)
    {
        $this->hydrate($data);// l'objet Se refere a ça propre methode ou à la methode du Pére(ici celle du pére etant donner que celle ci est declarer public) 
        
    }


    /**
     * Get the value of utilisateur
     */ 
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set the value of utilisateur
     *
     * @return  self
     */ 
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
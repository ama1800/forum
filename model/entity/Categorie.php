<?php

namespace Model\Entity;

use App\AbstractEntity;

class Categorie extends AbstractEntity
{
    private $id;
    private $nomcategorie;
    private $nb;
    private $verouillage;
    private $sujet;
    private $message;
    private $utilisateur;
    public function __construct($data)
    {
        $this->hydrate($data);// l'objet Se refere a ça propre methode ou à la methode du Pére(ici celle du pére etant donner que celle ci est declarer public) 
        
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id; // l'objet Se refere a ça propre proprieté
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nomCategorie
     */
    public function getNomcategorie()
    {
        return $this->nomcategorie;
    }

    /**
     * Set the value of nomCategorie
     *
     * @return  self
     */
    public function setNomcategorie($nomcategorie)
    {
        $this->nomcategorie = $nomcategorie;

        return $this;
    }

    /**
     * Get the value of nb
     */
    public function getNb()
    {
        return $this->nb;
    }

    /**
     * Set the value of nb
     *
     * @return  self
     */
    public function setNb($nb)
    {
        $this->nb = $nb;

        return $this;
    }

    /**
     * Get the value of verrouillage
     */
    public function getVerouillage()
    {
        return $this->verouillage;
    }

    /**
     * Set the value of verrouillage
     *
     * @return  self
     */
    public function setVerouillage($verouillage)
    {
        $this->verouillage = $verouillage;

        return $this;
    }

    /**
     * Get the value of sujet
     */ 
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set the value of sujet
     *
     * @return  self
     */ 
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
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

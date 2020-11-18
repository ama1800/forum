<?php
 namespace Model\Entity;
use App\AbstractEntity;

class Sujet extends AbstractEntity{
    private $id;
    private $titresujet;
    private $datecreation;
    private $contenu;
    private $verrouillage;
    private $resolut;
    private $utilisateur;
    private $sujet;
    private $message;
    private $nb;

     public function __construct($data){
         $this->hydrate($data);
    }
    public function __toString()
    {
        "<ol>";
        return "<span>".$this->getDatecreation()."</span><li>".$this->getTitresujet()."</li><p>".$this->getContenu()."</p>";
        "</ol>";
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
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
     * Get the value of titresujet
     */ 
    public function getTitresujet()
    {
        return $this->titresujet;
    }

    /**
     * Set the value of titresujet
     *
     * @return  self
     */ 
    public function setTitresujet($titresujet)
    {
        $this->titresujet = $titresujet;

        return $this;
    }

    /**
     * Get the value of datecreation
     */ 
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set the value of datecreation
     *
     * @return  self
     */ 
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get the value of contenu
     */ 
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return  self
     */ 
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of verouillage
     */ 
    public function getVerrouillage()
    {
        return $this->verrouillage;
    }

    /**
     * Set the value of verouillage
     *
     * @return  self
     */ 
    public function setVerrouillage($verrouillage)
    {
        $this->verrouillage = $verrouillage;

        return $this;
    }

    /**
     * Get the value of resolut
     */ 
    public function getResolut()
    {
        return $this->resolut;
    }

    /**
     * Set the value of resolut
     *
     * @return  self
     */ 
    public function setResolut($resolut)
    {
        $this->resolut = $resolut;

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
}
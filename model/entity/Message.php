<?php
 namespace Model\Entity;
use App\AbstractEntity;
use DateTime;

class Message extends AbstractEntity{
    private $id;
    private $titremessage;
    private $datecreation;
    private $reponse;
    private $utilisateur;
    private $nbm;
    private $categorie;
    private $sujet;
    private $verouillage;
    private $resolut;

     public function __construct($data){
         $this->hydrate($data);
    }
    public function __toString()
    {
        "<ol>";
        return "<span>".$this->getDatecreation()."</span><li>".$this->gettitremessage()."</li><p>".$this->getReponse()."</p>";
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
     * Get the value of titreMessage
     */ 
    public function getTitremessage()
    {
        return $this->titremessage;
    }

    /**
     * Set the value of titreMessage
     *
     * @return  self
     */ 
    public function setTitremessage($titremessage)
    {
        $this->titremessage = $titremessage;

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
     * Get the value of reponse
     */ 
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set the value of reponse
     *
     * @return  self
     */ 
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get the value of verouillage
     */ 
    public function getVerouillage()
    {
        return $this->verouillage;
    }

    /**
     * Set the value of verouillage
     *
     * @return  self
     */ 
    public function setVerouillage($verouillage)
    {
        $this->verouillage = $verouillage;

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
    
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @return  self
     */ 
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

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
     * Get the value of nbm
     */ 
    public function getNbm()
    {
        return $this->nbm;
    }

    /**
     * Set the value of nbm
     *
     * @return  self
     */ 
    public function setNbm($nbm)
    {
        $this->nbm = $nbm;

        return $this;
    }
}
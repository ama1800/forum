<?php
    namespace App;

    abstract class AbstractEntity {
            // création d'un hydrateur récursif! But: faire comprendre que notre clé étrangère récupère
            // lier la clé etrangere avec son entity pour acceder à ces donnees.
            protected function hydrate($data){
        
            foreach($data as $field => $value) {
                // ex : utilisateur_id => ["utilisateur","id"]
                $fieldArray = explode("_", $field);
                // cas d'une clé étrangère (ex : utilisateur_id)
                if(isset($fieldArray[1]) && $fieldArray[1] == "id") {
                    // UtilisateurManager (fieldArray[0] = "utilisateur", fieldArray[1] = "id") position zero est 
                    // de la colonne
                    $manName = ucfirst($fieldArray[0])."Manager";
                    // Model\Manager\UtilisateurManager
                    $FQCName = "Model\Manager".DS.$manName;
                    // $man = new Model\Manager\UtilisateurManager() 
                    $man = new $FQCName();
                    // $value = $man->findOneById($value)
                    $value = $man->findOneById($value);
                }
                // lier les donnees de l'objet avec leur setter de la classe 
                // fielArray = utilisateurName
                // method = setUtilisateurName
                $method = "set".ucfirst($fieldArray[0]);
                
                // utilisateur->setUtilisateurname("stephane");
                if(method_exists($this, $method)){
                    $this->$method($value);
                }
            }
        }
    }
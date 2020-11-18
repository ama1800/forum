<?php
    namespace App;

    session_start();

    abstract class Session 
    {
        //la méthode qui nous permet de récupérer l'utilisateur en session
        public static function getUtilisateur(){
            if(isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] !== null){
                return $_SESSION['utilisateur'];
            }
            return false;
        }

        public static function setUtilisateur($utilisateur){
            $_SESSION['utilisateur'] = $utilisateur;
        }
        // pour supprimer la session utilisateur
        public static function removeUtilisateur(){
            if(self::getutilisateur()){
                unset($_SESSION['utilisateur']);
            }
            return;
        }
        
        public static function authenticationRequired($roleToHave){
            if(!self::getUtilisateur()){
                Router::redirectTo("security", "login");
            }
        }
        //generer le token de la session pour le comparer à celui du formulaire
        public static function generateKey(){
            if(!isset($_SESSION['key']) || $_SESSION['key'] === null){
                $_SESSION['key'] = bin2hex(random_bytes(32));
            }
        }
        
        public static function getKey(){
            return $_SESSION['key'];
        }
        public static function herarchie()
        {
            $grades =[
                1 => "<span style='color:red;'>ADMIN</span>",
                2 => "<span style='color:green;'>MODERATEUR</span>",
                3 => "<span style='color:yellow;'>VIP</span>",
                4 => "<span style='color:steelblue;'>MEMBRE SENIOR</span>",
                5 => "<span style='color:gray;'>MEMBRE</span>"
            ];
            foreach($grades as $role=>$grade)
            {
                if($role == self::getUtilisateur()->getRole())
                {
                    return $grade;
                }
            }
        }
        public static function addMessage($type, $text)
        {
            if(!isset($_SESSION[$type]['msg']))
            {
                $_SESSION[$type]['msg']=[];
            }
            $_SESSION[$type]['msg']=$text;
        }
        public static function getMessage($type)
        {
            if($_SESSION[$type])
            {
                $msgs=$_SESSION[$type];
                unset($_SESSION[$type]);
                return $msgs;
            }
            else return [];
        }
        // public static function removeMessage()
        // {
        //     if(self::getMessage("")){
        //         unset($_SESSION['msg']);
        //     }
        // }
        public static function hasMessage()
        {
            if (isset($_SESSION['msg']))
            {
                return ($_SESSION['msg']);
            }
        }
        public static function getValuesOf($index)
        {
            return isset ($_SESSION[$index]) ? $_SESSION[$index] : false;
        }
    }
    // https://www.grafikart.fr/forum/topics/27159 messages flash d'erreurs.
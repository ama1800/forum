<?php
    namespace App;

    abstract class DAO
    {
        const DB_HOST = "ama18000.alwaysdata.net";
        const DB_NAME = "ama18000_forum";
        const DB_USER = "ama18000";
        const DB_PASS = "Ama31513151.";
        const DB_CHARSET = "utf8";
        const DNS = 'mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME .';charset='.self::DB_CHARSET;

        public static function getConnection(){

            //connexion à la BDD
            try{
                $pdo = new \PDO( // self permet d'acceder au constante et au static
                    self::DNS,
                    self::DB_USER,
                    self::DB_PASS,
                    
                    [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC //retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats 
                    ]
                );
                return $pdo;
            }
            catch(\Exception $e){
                echo $e->getMessage();
                die();
            }
        }
    }
<?php
    namespace App;

    abstract class DAO
    {
        const DB_HOST = "localhost:3306";
        const DB_NAME = "forum";
        const DB_USER = "root";
        const DB_PASS = "";
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
                var_dump("connected!");
                return $pdo;
            }
            catch(\Exception $e){
                echo $e->getMessage();
                die();
            }
        }
    }
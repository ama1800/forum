<?php
    namespace Model\Manager;
    
    use App\AbstractManager;
    
    class UtilisateurManager extends AbstractManager
    {
        private static $classname = "Model\Entity\Utilisateur";

        public function __construct(){
            self::connect(self::$classname);
        }
    

        public function findAll($pageActuel,$parPage){

            $sql = "SELECT *
            FROM Utilisateur u
            ORDER BY dateadhesion desc limit $pageActuel,$parPage";

            return self::getResults(
                self::select($sql,
                [$pageActuel,$parPage], 
                    true
                ), 
                self::$classname
            );
        }

        public function findOneById($id){
            $sql = "SELECT * 
                        FROM Utilisateur 
                        WHERE id = :id";
            return self::getOneOrNullResult(
                self::select($sql, 
                    ["id" => $id], 
                    false
                ), 
                self::$classname
            );
        }
        
        public function nbUtilisateurs(){

            $sql = "SELECT COUNT(id) AS nb 
                    FROM utilisateur s";
            return self::getOneOrNullResultInt(
                self::select($sql,
                    null, 
                    false
                ), 
                self::$classname
            );
        }
        public function findOneByEmail($email){
            $sql = "SELECT email FROM utilisateur where email= :email";
            return self::getOneOrNullResult(
                self::select($sql,
                ["email" => $email], 
                    false
                ), 
                self::$classname
            );
        } 
    public function findOneByPsuedo($psuedo){
        $sql = "SELECT id,psuedo, email, password, role FROM utilisateur where psuedo = :psuedo";
        return self::getOneOrNullResult(
            self::select(
                $sql,
            ["psuedo" => $psuedo], 
                false
            ), 
            self::$classname
        );
    }
    public function addUser($array){
        $sql = "INSERT INTO  utilisateur
                (psuedo, email, password, nom, prenom, datenaissance, avatar, cp, ville, adresse ) values (:psuedo, :email,:password, :nom, :prenom, :datenaissance, :avatar, :cp, :ville, :adresse )";
                self::create(
                    $sql,
                    $array,
                    false
                );
    }
    public function deleteUser($id){
        $sql =" DELETE FROM utilisateur WHERE id= :id ";
        return self::delete(
            $sql, 
            ['id' => $id]
        );
         
    }

    public function updateUser($array)
    {
        $sql= "UPDATE  utilisateur set 
        psuedo=:psuedo, email=:email, nom=:nom, prenom=:prenom, datenaissance=:datenaissance, avatar=:avatar
        where id= :id";
        return self::update(
            $sql,
            $array
        );
    }
    public function updatePass($array)
    {
        $sql= "UPDATE utilisateur set 
         password=:password where id= :id";
        return self::update(
            $sql,
            $array
        );
    }
}
<?php
    namespace Model\Manager;
    
    use App\AbstractManager;
    
    class CategorieManager extends AbstractManager
    {
        private static $classname = "Model\Entity\Categorie";

        public function __construct(){
            self::connect(self::$classname);
        }

        public function findAll(){

            $sql = "SELECT nomcategorie, c.id, verouillage, COUNT(s.id) AS nb 
            FROM  categorie c
            left join sujet s on s.categorie_id=c.id 
            GROUP BY nomcategorie,c.id ";

            return self::getResults(
                self::select($sql,
                    null, 
                    true
                ), 
                self::$classname
            );
        }

        public function findOneById($id){
            $sql = "SELECT * 
                        FROM categorie 
                        WHERE id = :id";
            return self::getOneOrNullResult(
                self::select($sql, 
                    ["id" => $id], 
                    false
                ), 
                self::$classname
            );
        }
        public function nbMessageByCategorie($id){
            $sql= "SELECT c.id, categorie_id, COUNT(m.id) AS nb
            FROM  sujet s
            LEFT JOIN message m
            on m.sujet_id=s.id 
            LEFT JOIN  categorie c
				on  s.categorie_id =c.id
				WHERE s.categorie_id = :id
            GROUP BY s.categorie_id";
            return self::getOneOrNullResult(
                self::select($sql,  
                ["id" => $id],
                    false
                ), 
                self::$classname
            );
        }
        
        public function deleteCategorie($id){
            $this->deletePostsOfTopics($id);
            $this->deleteTopicsOfCategorie($id);
            $sql = "DELETE FROM categorie WHERE id = :id";
            return self::delete(
                $sql, 
                ['id' => $id]
            );
             
        }
        public function deleteTopicsOfCategorie($id){
            $this->deletePostsOfTopics($id);
           $sql= "DELETE FROM sujet WHERE categorie_id = :id";
           return self::delete(
            $sql, 
            ['id' => $id]
            );
        }
        public function deletePostsOfTopics($id){
           $sql= "DELETE FROM message WHERE sujet_id = :id";
           return self::delete(
            $sql,
            ['id' => $id]
            );
        }
    }
<?php
    namespace Model\Manager;
    
    use App\AbstractManager;
    
    class MessageManager extends AbstractManager
    {
        private static $classname = "Model\Entity\Message";

        public function __construct(){
            self::connect(self::$classname);
        }

        public function findAll(){

            $sql = "SELECT m.id_message , u.psuedo, titremessage, m.datecreation, reponse, m.utilisateur_id, m.sujet_id
                    FROM message m, utilisateur u
                    WHERE m.utilisateur_id=u.id
                    ORDER BY datecreation DESC";

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
                    FROM message 
                    WHERE id_message = :id";
            return self::getOneOrNullResult(
                self::select($sql, 
                    ["id" => $id], 
                    false
                ), 
                self::$classname
            );
        }

        public function findAllBySujet($id){
            $sql = "SELECT m.id_message, titremessage, u.psuedo, reponse, datecreation ,m.utilisateur_id 
                    FROM message m, utilisateur u
                    WHERE m.utilisateur_id = u.id and m.sujet_id=:id";
            return self::getResults(
                self::select($sql, 
                    ["id" => $id], 
                    true
                ), 
                self::$classname
            );
        }
        public function LatestPosts($pageActuel,$parPage){

            $sql = "SELECT m.id_message, titremessage, m.datecreation, reponse, utilisateur_id, psuedo, m.sujet_id
            FROM message m
            left join utilisateur u
            on m.utilisateur_id=u.id
            order by datecreation desc limit $pageActuel,$parPage";

            return self::getResults(
                self::select($sql,
                [$pageActuel,$parPage], 
                    true
                ), 
                self::$classname
            );
        }
        public function LatestMessages(){

            $sql = "SELECT m.id_message, titremessage, m.datecreation, reponse, utilisateur_id, psuedo, m.sujet_id
            FROM message m
            left join utilisateur u
            on m.utilisateur_id=u.id
            order by datecreation desc";

            return self::getResults(
                self::select($sql,
                null, 
                    true
                ), 
                self::$classname
            );
        }

        public function LatestPostsByCat($id){

            $sql = "SELECT titremessage
            FROM message m, categorie c, sujet s
           where  m.sujet_id =s.id and s.categorie_id = c.id and c.id = :id
            ORDER BY m.datecreation desc ";

            return self::getResults(
                self::select($sql,
                ["id" => $id], 
                    true
                ), 
                self::$classname
            );
        }
        public function findAllMessageByUser($id){
            $sql = "SELECT psuedo, reponse 
            FROM utilisateur u, message m 
            WHERE m.Utilisateur_id=u.id and m.Utilisateur_id = :id";
            return self::getResults(
                self::select($sql, 
                    ["id" => $id],
                    true
                ), 
                self::$classname
            );
        }
        public function nbMessageBySujet($id){
            $sql= "SELECT  s.id, COUNT(m.id_message) AS nbm
            FROM sujet s 
            LEFT JOIN message m
            ON s.id= m.sujet_id WHERE  s.id= :id
            GROUP BY s.id";
            return self::getOneOrNullResult(
                self::select($sql, 
                ['id' => $id], 
                    false
                ), 
                self::$classname
            );
        }
        public function totalMessages(){
            $sql="SELECT COUNT(m.id_message) AS nbm
            FROM  message m";
            return self::getOneOrNullResultInt(
                self::select($sql, 
                    null, 
                    false
                ), 
                self::$classname
            );
        }
        public function deletePost($id){
            $sql = "DELETE FROM message WHERE id_message = :id";
            return self::delete(
                $sql, 
                ['id' => $id]
            );
             
        }
        public function sujetOfMessage($id){
            $sql="SELECT titresujet FROM sujet s
            LEFT JOIN message m
            ON m.sujet_id= s.id
            WHERE m.id_message =:id";
            return self::getOneOrNullResult(
                self::select($sql, 
                ['id' => $id], 
                    false
                ), 
                self::$classname
            );
        }
        
        public function addPost($array){
            $sql=" INSERT INTO  message 
            (titremessage, reponse, sujet_id, utilisateur_id) 
            values 
            (:titremessage, :reponse, :sujet_id, :utilisateur_id)";
            return self::create(
                $sql,
                $array,
                false
            );
        }
        
        public function messageOwner($id)
        {
            $sql="SELECT m.id_message, m.utilisateur_id FROM message m, utilisateur u
            WHERE u.id = m.utilisateur_id AND m.id_message = :id";
            return self::getOneOrNullResult(
                self::select($sql, 
                    ["id" => $id], 
                    false
                ), 
                self::$classname
            );
        }
        public function modPost($array){
            $sql=" UPDATE  message set  
            titremessage= :titremessage, reponse= :reponse, sujet_id= :sujet_id, utilisateur_id= :utilisateur_id
            where id_message= :id";
            return self::update(
                $sql,
                $array
            );
        }

        public function search($q)
        {
            $sql = $sql=" SELECT id_message, titremessage, reponse, datecreation, m.sujet_id
                    from message m";
                    $mots=explode(" ", $q);
                    $i=0;
                    foreach($mots as $val)
                    {
                        if(strlen($val)>2)
                        {
                            if($i==0)
                            {
                                $sql.=" WHERE ";
                            }
                            else
                            {
                                $sql.=" OR ";
                            }
                        $sql.=" titremessage LIKE '%$val%' ";
                        $sql.=" OR ";
                        $sql.=" reponse LIKE '%$val%' ";
                        $i++;
                        }
                    }
                    $sql.=" ORDER BY datecreation DESC";
                return self::getResults(
                    self::select($sql,
                    null, 
                        true
                    ), 
                    self::$classname
                );
        }
}
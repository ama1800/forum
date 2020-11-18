<?php
    namespace Model\Manager;
    
    use App\AbstractManager;
    
    class SujetManager extends AbstractManager
    {
        private static $classname = "Model\Entity\Sujet";

        public function __construct(){
            self::connect(self::$classname);
        }

        public function findAll(){

            $sql = "SELECT *                    
                    FROM sujet s";

            return self::getResults(
                self::select($sql,
                    null, 
                    true
                ), 
                self::$classname
            );
        }

        public function listSujets($pageActuel,$parPage){

            $sql = "SELECT s.id, titresujet, s.datecreation,contenu, verrouillage, s.utilisateur_id, psuedo, COUNT(m.id_message) AS nb
                    FROM sujet s
                    left join  utilisateur u
                    on s.utilisateur_id = u.id 
                    left join  message m
                    on m.sujet_id=s.id
                    GROUP BY s.id, titresujet, s.datecreation, contenu, verrouillage, s.utilisateur_id, psuedo
                    order by datecreation desc limit $pageActuel,$parPage";

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
                    FROM sujet 
                    WHERE id = :id";
            return self::getOneOrNullResult(
                self::select($sql, 
                    ["id" => $id], 
                    false
                ), 
                self::$classname
            );
        } 
        public function findByCategorie($id){
            $sql = "SELECT s.id, titresujet,s.utilisateur_id, psuedo, resolution,verrouillage,  datecreation 
            FROM sujet s, utilisateur u
            WHERE s.utilisateur_id = u.id AND s.categorie_id=:id
            ORDER BY datecreation DESC";
            return self::getResults(
                self::select($sql, 
                    ["id" => $id], 
                    true
                ), 
                self::$classname
            );
        }
        
        public function findAllSujetByUser($id){
            $sql = "SELECT titresujet, s.id 
            FROM utilisateur u, sujet s 
            WHERE s.Utilisateur_id=u.id and s.Utilisateur_id = :id";
            return self::getResults(
                self::select($sql, 
                    ["id" => $id], 
                    true
                ), 
                self::$classname
            );
        }
        public function nbSujetByCategorie($id){
            $sql= "SELECT nomcategorie, COUNT(titresujet) AS nb
            FROM categorie c, sujet s
            WHERE c.id=s.categorie_id AND s.categorie_id= :id";
            return self::getResults(
                self::select($sql, 
                    ["id" => $id], 
                    true
                ), 
                self::$classname
            );
        }
        public function deleteTopic($id){
            $this->deletePostsOfTopic($id);
            $sql = "DELETE FROM sujet WHERE id = :id";
            return self::delete(
                $sql, 
                ['id' => $id]
            );
             
        }
        public function deletePostsOfTopic($id){
           $sql= "DELETE FROM message WHERE sujet_id = :id";
           return self::delete(
            $sql, 
            ['id' => $id]
        );
        }
        public function addTopic($array){
            $sql=" INSERT INTO  sujet 
            (titresujet, contenu, categorie_id, utilisateur_id) 
            values 
            (:titresujet, :contenu, :categorie_id, :utilisateur_id)";
            return self::create(
                $sql,
                $array,
                false
            );
        }
        public function modTopic($array){
            $sql=" UPDATE  sujet set  
            titresujet= :titresujet, contenu= :contenu, categorie_id= :categorie_id, utilisateur_id= :utilisateur_id
            where id= :id";
            return self::update(
                $sql,
                $array
            );
        }
        public function topicOwner($id)
        {
            $sql="SELECT u.id, psuedo FROM utilisateur u, sujet s
            WHERE u.id=s.utilisateur_id AND s.id= :id";
            return self::getOneOrNullResult(
                self::select($sql, 
                    ["id" => $id], 
                    false
                ), 
                self::$classname
            );

        }
        public function nbSujets()
        {
            $sql="SELECT count(s.id) as nb
                from sujet s";
                return self::getOneOrNullResultInt(
                    self::select($sql, 
                        null, 
                        false
                    ), 
                    self::$classname
                );
        }
        public function search($q)
        {
            $sql = " SELECT id, titresujet, contenu, datecreation
                    from sujet ";
                    // les mots a chercher exploser la chaine de string et les mettre dans un tableau
                    $mots=explode(" ", $q);
                    // lancer un compteur
                    $i=0;
                    // parcourir le tableau de mots
                    foreach($mots as $val)
                    {
                        // accepter la recherche seulement si le mot a plus de 3 lettres
                        if(strlen($val)>2)
                        {
                            // si le compteur est a zero ajouter WHERE a la requete
                            if($i==0)
                            {
                                $sql.=" WHERE ";
                            }
                            else
                            {
                                //  sinon ajouter un OR a la requete
                                $sql.=" OR ";
                            }
                        // completer la requete a chaque fois que y a un autre mot
                        $sql.=" titresujet LIKE '%$val%' ";
                        $sql.=" OR ";
                        $sql.=" contenu LIKE '%$val%' ";
                        $i++;
                        }
                    }
                    // terminer la requete avec la partie qui ne se repete pas
                    $sql.=" ORDER BY datecreation DESC";
                return self::getResults(
                    self::select($sql,
                    // au cas d'une recherche avec un get
                    ["q" => $q], 
                        true
                    ), 
                    self::$classname
                );
        }
    } 
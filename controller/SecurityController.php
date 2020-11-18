<?php
    namespace Controller;
    
    use App\Router;
    use App\Session;
use Model\Entity\Utilisateur;
use Model\Manager\UtilisateurManager;

    class SecurityController {

        public function loginForm(){
            return [
                "view" => "forum\login.php", 
                "data" => [
                    "data" => null,
                ],
                "titrePage" => "SatForum | Connexion"
            ];
        } 
        public function registerForm(){
            return [
                "view" => "forum/register.php", 
                "data" => [
                    "data" => null,
                ],
                "titrePage" => "SatForum | Inscription"
            ];
        } 

         public function login()
        {
            if(!empty($_POST))
        {
                $psuedo = filter_input(INPUT_POST, "psuedo");
                $password = filter_input(INPUT_POST, "password"); 
                
                $manager= new UtilisateurManager();
                if($psuedoV= $manager->findOneByPsuedo($psuedo))
                {
                    if( password_verify($password, $psuedoV->getPassword()))
                    {
                        Session::setUtilisateur($psuedoV);
                        Router::redirectTo("forum","listSujets");
                    }
                    else var_dump("MAUVAIS MOT DE PASSE");
                    return Router::redirectTo("security","loginForm");
                }
                else var_dump("CET UTILISATEUR N'EXISTE PAS!!");
                return Router::redirectTo("security","loginForm");  
            }
            else
            return Router::redirectTo("security","loginForm");
        }

        public function register()
        {
            if(!empty($_POST))
            {
                $psuedo= filter_input(INPUT_POST, "psuedo", FILTER_SANITIZE_STRING); 
                $email= filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
                $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_STRING);
                $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING);
                $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING);
                $datenaissance = filter_input(INPUT_POST, "datenaissance");
                $avatar = filter_input(INPUT_POST, "avatar", FILTER_SANITIZE_STRING);
                $cp= filter_input(INPUT_POST, "cp", FILTER_SANITIZE_STRING); 
                $ville= filter_input(INPUT_POST, "ville", FILTER_SANITIZE_STRING);
                $adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_STRING);
                

                
                if($psuedo && $password && $password1)
                {
                    
                    if(($password == $password1) and strlen($password)>=8)
                    {
                        $manager = new UtilisateurManager();
                        $user=$manager->findOneByPsuedo($psuedo);
                        if(!$user)
                        {
                            $password = password_hash($password, PASSWORD_BCRYPT);
                            $array=["psuedo"=>$psuedo,"email"=>$email,"password"=>$password,"nom"=>$nom,"prenom"=>$prenom,"datenaissance"=>$datenaissance,"avatar"=>$avatar,"cp"=>$cp,"ville"=>$ville,"adresse"=>$adresse];

                            if($manager->addUser($array))
                            {
                            return  var_dump("Vous etes bien inscrit ".$manager->findOneByPsuedo($psuedo)->getPsuedo());
                                    
                            }
                        }
                            else Session::addMessage('error', "USER DEJA EXISTANT");
                    }
                        else Session::addMessage('error', "MOTS DE PASSE DIFFERENTS");
                        // var_dump(Session::addMessage('error', "MOTS DE PASSE DIFFERENTS")); die;
                }
                    else Session::addMessage('error', "CHAMPS MANQUANTS");   
            }
            return 
           Router::redirectTo("security","loginForm");
        //    var_dump($_POST['token'],Session::generateKey() ); die;
        }
        public function modPass()
        {
            if(!empty($_POST))
            {
                if(Session::getUtilisateur())
                {
                    $id = (isset($_GET['id'])) ? $_GET['id'] : null;

                    
                    $passActuel = filter_input(INPUT_POST, "passActuel"); 
                    $password= filter_input(INPUT_POST, "password");
                    $password1= filter_input(INPUT_POST, "password1");

                    if($password==$password1  and strlen($password)>=8)
                    {
                        $manager= new UtilisateurManager();
                        $psuedoV=$manager->findOneByPsuedo(Session::getUtilisateur()->getPsuedo());
                        if( password_verify($passActuel, $psuedoV->getPassword()))
                        {
                            $password = password_hash($password, PASSWORD_BCRYPT);
                            $array=['id'=>$id,"password"=>$password ];
                            $update=$manager->updatePass($array);
                            if($update)
                            {
                                echo "FELECITATION, VOTRE MOT DE PASSE A ETE MODIFIER AVEC SUCCEE.";
                            }
                            else var_dump("ERREUR");
                        }
                        else var_dump("ERREUR ENTREZ LE BON MOT DE PASSE");
                    }
                    else var_dump("Mots De Passes Non Identiques");
                }
                else var_dump("VOUS N'ETES PAS CONNECTER??!");
            }
            else var_dump("CHAMPS MANQUANTS");
        }

        public function logout(){
            Session::removeUtilisateur();
            Session::addMessage("success", "vous etes deconnectez, revenez quand vous voulez!");
            Router::redirectTo("forum","listSujets");
        
        }

        
    }

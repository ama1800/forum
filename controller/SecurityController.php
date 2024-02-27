<?php

namespace Controller;

use App\Router;
use App\Session;
use Model\Manager\UtilisateurManager;

class SecurityController
{

    /**
     * Formulaire de connexion
     */
    public function loginForm()
    {
        return [
            "view" => "forum\login.php",
            "data" => [
                "data" => null,
            ],
            "titrePage" => "SatForum | Connexion"
        ];
    }
    public function registerForm()
    {
        return [
            "view" => "forum/register.php",
            "data" => [
                "data" => null,
            ],
            "titrePage" => "SatForum | Inscription"
        ];
    }

    /**
     * Connexion
     */
    public function login()
    {
        if (!empty($_POST)) {
            $psuedo = filter_input(INPUT_POST, "psuedo");
            $password = filter_input(INPUT_POST, "password");

            $manager = new UtilisateurManager();
            if ($user = $manager->findOneByPsuedo($psuedo)) {
                if (password_verify($password, $user->getPassword())) {
                    $user->setPassword('');
                    Session::setUtilisateur($user);
                    Session::addMessage('success', "Bienvenue " . Session::getUtilisateur()->getPrenom() . ", Nous somme heureux de te revoir.", Session::FLASH_SUCCESS);
                    Router::redirectTo("forum", "listSujets");
                } else Session::addMessage('error', "données erronées", Session::FLASH_ERROR);
                return Router::redirectTo("security", "loginForm");
            } else {
                Session::addMessage('error', "données erronées", Session::FLASH_ERROR);
                return Router::redirectTo("security", "loginForm");
            }
        } else {
            Session::addMessage('error', "données erronées", Session::FLASH_ERROR);
            return Router::redirectTo("security", "loginForm");
        }
    }

    /**
     * Création de compte
     */
    public function register()
    {
        if (!empty($_POST)) {
            $psuedo = filter_input(INPUT_POST, "psuedo", FILTER_UNSAFE_RAW);
            $email = filter_input(INPUT_POST, "email", FILTER_UNSAFE_RAW);
            $password = filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW);
            $password1 = filter_input(INPUT_POST, "password1", FILTER_UNSAFE_RAW);
            $nom = filter_input(INPUT_POST, "nom", FILTER_UNSAFE_RAW);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_UNSAFE_RAW);
            $datenaissance = filter_input(INPUT_POST, "datenaissance");
            $avatar = filter_input(INPUT_POST, "avatar", FILTER_UNSAFE_RAW);
            $pays = filter_input(INPUT_POST, "pays", FILTER_UNSAFE_RAW);
            // $ville= filter_input(INPUT_POST, "ville", FILTER_UNSAFE_RAW);
            $adresse = filter_input(INPUT_POST, "adresse", FILTER_UNSAFE_RAW);

            if ($psuedo && $password && $password1) {

                if (($password == $password1) and strlen($password) >= 8) {
                    $manager = new UtilisateurManager();
                    $user = $manager->findOneByPsuedo($psuedo);
                    if (!$user) {
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $array = ["psuedo" => $psuedo, "email" => $email, "password" => $password, "nom" => $nom, "prenom" => $prenom, "datenaissance" => $datenaissance, "avatar" => $avatar, "adresse" => $adresse, "pays" => $pays, "role" => 5, "dateadhesion" => date('Y/m/d H:i')];

                        if ($manager->addUser($array)) {
                            return  Session::addMessage("success", "Vous etes bien inscrit " . $psuedo, Session::FLASH_ERROR);
                        }
                    } else Session::addMessage('error', "USER DEJA EXISTANT", Session::FLASH_ERROR);
                } else Session::addMessage('error', "MOTS DE PASSE DIFFERENTS", Session::FLASH_ERROR);
            } else Session::addMessage('error', "CHAMPS MANQUANTS", Session::FLASH_ERROR);
        }
        return
            Router::redirectTo("security", "loginForm");
    }
    /**
     * Modification du mot de passse
     */
    public function modPass()
    {
        if (!empty($_POST)) {
            if (Session::getUtilisateur()) {
                $id = (isset($_GET['id'])) ? $_GET['id'] : null;


                $passActuel = filter_input(INPUT_POST, "passActuel");
                $password = filter_input(INPUT_POST, "password");
                $password1 = filter_input(INPUT_POST, "password1");

                if ($password == $password1  and strlen($password) >= 8) {
                    $manager = new UtilisateurManager();
                    $psuedoV = $manager->findOneByPsuedo(Session::getUtilisateur()->getPsuedo());
                    if (password_verify($passActuel, $psuedoV->getPassword())) {
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $array = ['id' => $id, "password" => $password];
                        $update = $manager->updatePass($array);
                        if ($update) {
                            echo "FELECITATION, VOTRE MOT DE PASSE A ETE MODIFIER AVEC SUCCEE.";
                        } else var_dump("ERREUR");
                    } else {
                        Router::redirectTo("security", "modPass", Session::getUtilisateur()->getId());
                        Session::addMessage('error', "ERREUR ENTREZ LE BON MOT DE PASSE", Session::FLASH_ERROR);
                        die;
                    }
                } else {
                    Router::redirectTo("security", "modPass", Session::getUtilisateur()->getId());
                    Session::addMessage('error', "Mots De Passes Non Identiques", Session::FLASH_ERROR);
                }
            } else {
                Router::redirectTo("security", "loginForm");
                Session::addMessage('error', "VOUS N'ETES PAS CONNECTER??!", Session::FLASH_ERROR);
            }
        } else {
            Router::redirectTo("utilisateur", "userDetail", Session::getUtilisateur()->getId());
            Session::addMessage('error', "tous les champs sont requises!!", Session::FLASH_ERROR);
        }
    }

    public function logout()
    {
        Session::removeUtilisateur();
        Session::addMessage("success", "vous etes deconnectez, revenez quand vous voulez!", Session::FLASH_SUCCESS);
        Router::redirectTo("forum", "listSujets");
    }
}

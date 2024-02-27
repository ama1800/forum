<?php

namespace Controller;

use App\AbstractController;
use App\Session;
use App\Router;
use Model\Manager\utilisateurManager;
use Model\Manager\MessageManager;
use Model\Manager\SujetManager;

class UtilisateurController extends AbstractController
{

    /**
     * Afficher tous les Users
     */
    public function allUsers()
    {

        $manager = new utilisateurManager();

        $p = (isset($_GET['p'])) ? $_GET['p'] : 1;
        $parPage = 5;
        $pageActuel = $p;
        $page = ($pageActuel - 1) * $parPage;
        // $colors= $this->colors($pseudo);

        $users = $manager->findAll($page, $parPage);
        $grades = self::herarchie();
        $nbUsers = $manager->nbUtilisateurs();
        $users = $manager->findAll($pageActuel, $parPage);

        return [
            "view" => "User/listUsers.php",
            "data" => [
                "users" => $users
            ],
            "titrePage" => "user | " . $users
        ];
    }

    /**
     * Afficher les Messages d'un User
     */
    public function showUsersSujets()
    {

        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        $manager = new utilisateurManager();
        $manSujet = new SujetManager();

        $user = $manager->findOneById($id);
        $sujets = $manSujet->findAllSujetByUser($id);

        return [
            "view" => "User/Sujets.php",
            "data" => [
                "user" => $user,
                "Messages" => $sujets,
            ],
            "titrePage" => "user | " . $user
        ];
    }
    public function showUsersMessages()
    {

        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        $manager = new utilisateurManager();
        $manMessage = new MessageManager();

        $user = $manager->findOneById($id);
        $messages = $manMessage->findAllMessageByUser($id);

        return [
            "view" => "User/Messages.php",
            "data" => [
                "user" => $user,
                "messages" => $messages,
            ],
            "titrePage" => "user | " . $user
        ];
    }

    public function userDetail()
    {

        $id = (isset($_GET['id'])) ? $_GET['id'] : null;

        $manUser = new UtilisateurManager();
        $manUserSujet = new SujetManager();
        $manUserMessages = new MessageManager();

        $user = $manUser->findOneById($id);
        $sujets = $manUserSujet->findAllSujetByUser($id);
        $messages = $manUserMessages->findAllMessageByUser($id);
        $grades = $this->herarchie();

        return [
            "view" => "utilisateur/userDetail.php",
            "data" => [
                "user" => $user,
                "sujets" => $sujets,
                "grades" => $grades,
                "messages" => $messages
            ],
            "titrePage" => "user | " . $user
        ];
    }

    public function supUser()
    {
        if (Session::getUtilisateur()) {

            $id = (isset($_GET['id'])) ? $_GET['id'] : null;

            $manUser = new UtilisateurManager();
            $owner = $manUser->findOneById($id);

            if (($owner->getId() == Session::getUtilisateur()->getId()) or (Session::getUtilisateur()->getRole() < 2)) {
                $id = (isset($_GET['id'])) ? $_GET['id'] : null;

                $manager = new UtilisateurManager();
                $manager->deleteUser($id);
                Router::redirectTo("forum", "latestUsers");
            } else Session::addMessage('danger', "Vous ne pouvez supprimer un compte qui n'est pas le votre", Session::FLASH_ERROR);
        } else Session::addMessage('danger', "Veuillez vous connectez pour supprimer votre compte", Session::FLASH_ERROR);
    }

    public function modUserForm()
    {
        if (Session::getUtilisateur()) {

            $id = (isset($_GET['id'])) ? $_GET['id'] : null;

            $manUser = new UtilisateurManager();
            $owner = $manUser->findOneById($id);

            if (($owner->getId() == Session::getUtilisateur()->getId()) or (Session::getUtilisateur()->getRole() < 2)) {

                $id = (isset($_GET['id'])) ? $_GET['id'] : null;
                $manager = new UtilisateurManager();
                $user = $manager->findOneById($id);
                return [
                    "view" => "utilisateur/modUser.php",
                    "data" => [
                        "user" => $user
                    ],
                    "titrePage" => "user | " . $user->getPsuedo()
                ];
            } else Session::addMessage('danger', "Vous ne pouvez modifier que votre compte", Session::FLASH_ERROR);
        } else Session::addMessage('danger', "Veuillez vous connectez pour modifier votre profile", Session::FLASH_ERROR);
    }
    public function modUser()
    {
        if (!empty($_POST)) {

            if (Session::getUtilisateur()) {
                $id = (isset($_GET['id'])) ? $_GET['id'] : null;

                $manUser = new UtilisateurManager();
                $owner = $manUser->findOneById($id);

                if ($owner->getId() == Session::getUtilisateur()->getId() or (Session::getUtilisateur()->getRole() < 2)) {
                    $psuedo = filter_input(INPUT_POST, "psuedo", FILTER_UNSAFE_RAW);
                    $email = filter_input(INPUT_POST, "email", FILTER_UNSAFE_RAW);
                    $nom = filter_input(INPUT_POST, "nom", FILTER_UNSAFE_RAW);
                    $prenom = filter_input(INPUT_POST, "prenom", FILTER_UNSAFE_RAW);
                    $datenaissance = filter_input(INPUT_POST, "datenaissance");
                    $adresse = filter_input(INPUT_POST, "adresse", FILTER_UNSAFE_RAW);
                    $pays = filter_input(INPUT_POST, "pays", FILTER_UNSAFE_RAW);
                    if (isset($_FILES["avatar"]) and !empty($_FILES["avatar"]["name"])) {
                        $tailleMax = 2097250;
                        $extensionValid = ['jpg', 'jpeg', 'png', 'gif'];
                        if ($_FILES["avatar"]["size"] <= $tailleMax) {
                            //strrchr()permet renvoyer l'extension du fichier avec le point 
                            // sbstr() permet d'ignorer le 1ér( ,1) caractére de la chaine
                            $extensionUpload = strtolower(substr(strrchr($_FILES["avatar"]["name"], '.'), 1));
                            // in_array verfier si un element exist dans un tableau
                            if (in_array($extensionUpload, $extensionValid)) {
                                // le chemin de stockage de la photo et la nommer avec l'id du user(exemple 10.png qui veut dire que la photo est celle de le user 10)
                                $route = AVATAR_PATH . Session::getUtilisateur()->getId() . "." . $extensionUpload;
                                $enregistrement = move_uploaded_file($_FILES["avatar"]["tmp_name"], $route);
                                if ($enregistrement) {
                                    $avatar = Session::getUtilisateur()->getId() . "." . $extensionUpload;
                                } else var_dump("Il y a une erreur");
                            } else var_dump("seul les extension: 'jpg', 'jpeg', 'png', 'gif' sont autoriseés.");
                        } else
                            var_dump("votre photo ne doit pas depasser 2Mo!");
                    }
                    $role = filter_input(INPUT_POST, "role", FILTER_UNSAFE_RAW);
                    if (!empty($email)) {
                        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
                        $manager = new UtilisateurManager();
                        $array = ['id' => $id, "psuedo" => $psuedo, "email" => $email, "nom" => $nom, "prenom" => $prenom, "datenaissance" => $datenaissance, "avatar" => $avatar, "adresse" => $adresse, "pays" => $pays];
                        $manager->updateUser($array);
                        if ($manager->updateUser($array)) {
                            Session::addMessage("success", "Félicitation, Votre Profile est à jour", Session::FLASH_SUCCESS);
                            Router::redirectTo("utilisateur", "userDetail", Session::getUtilisateur()->getId());
                        }
                    } else Session::addMessage('danger', "tous les champs sont requis!!", Session::FLASH_ERROR);
                } else Session::addMessage('danger', "Vous ne pouvez modifier que votre compte", Session::FLASH_ERROR);
            } else Session::addMessage('danger', "Veuillez vous connectez pour modifier votre profile", Session::FLASH_ERROR);
        } else Session::addMessage('danger', "Champs manquants!!", Session::FLASH_ERROR);
    }
}

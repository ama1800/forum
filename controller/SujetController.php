<?php

namespace Controller;

use App\Session;
use App\Router;
use Model\Manager\UtilisateurManager;
use Model\Manager\SujetManager;
use Model\Manager\MessageManager;
use Model\Entity\Message;
use Model\Manager\CategorieManager;

class SujetController
{
    public function supsujet()
    {
        if (Session::getUtilisateur()) {
            $id = (isset($_GET['id'])) ? $_GET['id'] : null;

            $manUser = new SujetManager();
            $owner = $manUser->topicOwner($id);

            if (($owner->getId() == Session::getUtilisateur()->getId()) or (Session::getUtilisateur()->getRole() < 2)) {
                $id = (isset($_GET['id'])) ? $_GET['id'] : null;
                $manager = new SujetManager();
                $manager->deleteTopic($id);

                Router::redirectTo("forum", "listSujets");
            } else var_dump("Sauf erreur, Ce n'est pas votre sujet vous ne pouvez pas le supprimer");
        } else var_dump("Vous n'étes pas connecter!!");
    }

    public function addTopicForm()
    {
        if (Session::getUtilisateur()) {
            $manCat = new CategorieManager();
            $cat = $manCat->findAll();

            return [
                "view" => "sujet/nouveauSujet.php",
                "data" => [
                    "cat" => $cat
                ],
                "titrePage" => "SatForum | Nouveau Sujet"
            ];
        } else var_dump("Vous n'étes pas connecter!!");
    }
    public function modTopicForm()
    {
        if (Session::getUtilisateur()) {
            $id = (isset($_GET['id'])) ? $_GET['id'] : null;

            $manUser = new SujetManager();
            $owner = $manUser->topicOwner($id);

            if (($owner->getId() == Session::getUtilisateur()->getId()) or (Session::getUtilisateur()->getRole() < 3)) {
                $id = (isset($_GET['id'])) ? $_GET['id'] : null;

                $manCat = new CategorieManager();
                $manSujet = new SujetManager();
                $cat = $manCat->findAll();
                $sujet = $manSujet->findOneById($id);

                return [
                    "view" => "sujet/modSujet.php",
                    "data" => [
                        "cat" => $cat,
                        "sujet" => $sujet
                    ],
                    "titrePage" => "SatForum | Modification Sujet"
                ];
            } else var_dump("Sauf erreur, Ce n'est pas votre sujet vous ne pouvez pas le modifier");
        } else var_dump("Vous n'étes pas connecter!!");
    }



    public function addTopic()
    {
        if (Session::getUtilisateur()) {
            if (!empty($_POST)) {

                $titresujet = filter_input(INPUT_POST, "titresujet", FILTER_UNSAFE_RAW);
                $contenu = filter_input(INPUT_POST, "contenu", FILTER_UNSAFE_RAW);
                $categorie = filter_input(INPUT_POST, "categorie_id", FILTER_UNSAFE_RAW);


                $manSujet = new SujetManager();
                $manUser = new UtilisateurManager();
                $array = ["titresujet" => $titresujet, "contenu" => $contenu, "categorie_id" => $categorie, "utilisateur_id" => Session::getUtilisateur()->getId(), "datecreation" => date('Y/m/d H:i')];
                $addTopic = $manSujet->addTopic($array);
                Session::addMessage('success', "Sujet céer avec succés!", Session::FLASH_SUCCESS);
                Router::redirectTo("forum", "listSujets");
            } else {
                Session::addMessage('error', "Champs manquants", Session::FLASH_ERROR);
                Router::redirectTo("sujet", "addTopicForm");
            }
        } else {
            Session::addMessage('error', "Vous devez vous connectez pour creer un sujet.", Session::FLASH_ERROR);
            Router::redirectTo("security", "loginForm");;
        }
    }

    public function modTopic()
    {
        if (!empty($_POST)) {
            if (Session::getUtilisateur()->getId()) {

                $id = (isset($_GET['id'])) ? $_GET['id'] : null;

                $manUser = new SujetManager();
                $owner = $manUser->topicOwner($id);

                if (($owner->getId() == Session::getUtilisateur()->getId()) or (Session::getUtilisateur()->getRole() < 3)) {
                    $id = (isset($_GET['id'])) ? $_GET['id'] : null;

                    $titresujet = filter_input(INPUT_POST, "titresujet", FILTER_UNSAFE_RAW);
                    $contenu = filter_input(INPUT_POST, "contenu", FILTER_UNSAFE_RAW);
                    $categorie = filter_input(INPUT_POST, "categorie_id", FILTER_UNSAFE_RAW);


                    $manSujet = new SujetManager();
                    $array = ["id" => $id, "titresujet" => $titresujet, "contenu" => $contenu, "categorie_id" => $categorie, "utilisateur_id" => Session::getUtilisateur()->getId()];
                    $addTopic = $manSujet->modTopic($array);
                } else var_dump("Sauf erreur, Ce n'est pas votre sujet vous ne pouvez pas le modifier");
            } else
                var_dump("Vous devez vous connectez pour modifier un sujet.");
        } else
            var_dump(" Champs manquants");
    }
}

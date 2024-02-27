<?php

namespace Controller;

use App\Session;
use App\Router;
use Model\Manager\UtilisateurManager;
use Model\Manager\SujetManager;
use Model\Manager\MessageManager;
use Model\Entity\Message;
use PDOException;

class MessageController
{

    /**
     * Affiche le sujet au quel est lier un message
     */
    public function sujetOfMessage()
    {
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        $manager = new MessageManager();
        $sujet = $manager->sujetOfMessage($id);
    }

    /**
     * Dérniers messages
     */
    public function DerniersMessages()
    {

        $manMessage = new MessageManager();
        $nbMessages = $manMessage->totalMessages();
        $p = (isset($_GET['p'])) ? $_GET['p'] : 1;
        $parPage = 5;
        $pageActuel = $p;
        $page = ($pageActuel - 1) * $parPage;
        $messages = $manMessage->LatestPosts($page, $parPage);

        return [
            "view" => "message\listMessages.php",
            "data" => [
                "messages" => $messages,
                "nbMessages" => $nbMessages
            ],
            "titrePage" => "FORUM | Messages"
        ];
    }

    /**
     * Suppression d'un message
     */
    public function supMessage()
    {
        if (Session::getUtilisateur()) {
            $id = (isset($_GET['id'])) ? $_GET['id'] : null;

            $manUser = new MessageManager();
            $owner = $manUser->messageOwner($id);

            if (($owner->getUtilisateur()->getId() == Session::getUtilisateur()->getId()) or (Session::getUtilisateur()->getRole() < 2)) {
                $id = (isset($_GET['id'])) ? $_GET['id'] : null;
                $manager = new MessageManager();
                $manager->deletePost($id);
                Session::addMessage('success', "Le message à été supprimer.", Session::FLASH_WARNING);
                Router::redirectTo("message", "DerniersMessages");
            } else {
                Session::addMessage('error', "Ce n'est pas votre message vous ne pouvez pas le supprimer", Session::FLASH_ERROR);
                Router::redirectTo("message", "DerniersMessages");
            }
        } else {
            Session::addMessage('error', "Vous n'étes pas connecter", Session::FLASH_ERROR);
            Router::redirectTo("security", "loginForm");
        }
    }

    /**
     * Ajout d'un message
     */
    public function addPost()
    {
        if (Session::getUtilisateur()) {
            $id = (isset($_GET['id'])) ? $_GET['id'] : null;
            if (!empty($_POST) and $_POST['reponse']) {

                $titremessage = filter_input(INPUT_POST, "titremessage", FILTER_UNSAFE_RAW);
                $reponse = filter_input(INPUT_POST, "reponse", FILTER_UNSAFE_RAW);
                $manSujet = new SujetManager();
                $sujetActuel = $manSujet->findOneById($id);

                $sujetId = $sujetActuel->getId();
                $manMessage = new MessageManager();
                $array = ["titremessage" => $titremessage, "reponse" => $reponse, "sujet_id" => $sujetId, "utilisateur_id" => Session::getUtilisateur()->getId(), "datecreation" => date('Y/m/d H:i')];
                $addPost = $manMessage->addPost($array);
                Session::addMessage('success', "Vous venez de répondre. merci", Session::FLASH_SUCCESS);
                Router::redirectTo("forum", "showAllPostsByTopic", $id);
            } else {
                Session::addMessage('error', "Champs manquants", Session::FLASH_ERROR);
                Router::redirectTo("forum", "showAllPostsByTopic", $id);
            }
        } else {
            Session::addMessage('error', "Vous devez vous connectez pour repondre a ce sujet.", Session::FLASH_ERROR);
            Router::redirectTo("security", "loginForm");;
        }
    }
    public function modPostForm()
    {

        if (Session::getUtilisateur()) {
            $id = (isset($_GET['id'])) ? $_GET['id'] : null;

            $manUser = new MessageManager();
            $owner = $manUser->messageOwner($id);

            if (($owner->getUtilisateur()->getId() == Session::getUtilisateur()->getId()) or (Session::getUtilisateur()->getRole() < 3)) {
                $id = (isset($_GET['id'])) ? $_GET['id'] : null;

                $manMessage = new MessageManager();
                $message = $manMessage->findOneById($id);

                return [
                    "view" => "message/modMessage.php",
                    "data" => [
                        "message" => $message
                    ],
                    "titrePage" => "SatForum | Modification Message"
                ];
            } else var_dump("Sauf erreur, Ce n'est pas votre message vous ne pouvez pas le modifier");
        } else var_dump("Vous n'étes pas connecter!!");
    }

    public function modPost()
    {
        if (!empty($_POST)) {
            if (Session::getUtilisateur()) {

                $id = (isset($_GET['id'])) ? $_GET['id'] : null;

                $manUser = new MessageManager();
                $owner = $manUser->messageOwner($id);

                if (($owner->getUtilisateur()->getId() == Session::getUtilisateur()->getId()) or (Session::getUtilisateur()->getRole() < 3)) {
                    $id = (isset($_GET['id'])) ? $_GET['id'] : null;

                    $titremessage = filter_input(INPUT_POST, "titremessage", FILTER_UNSAFE_RAW);
                    $reponse = filter_input(INPUT_POST, "reponse", FILTER_UNSAFE_RAW);

                    $manMessage = new MessageManager();
                    $topicOfPost = $manMessage->LatestMessages();
                    foreach ($topicOfPost as $k => $sujet) {
                        $sujet = $sujet->getSujet()->getId();
                    }


                    $array = ["id" => $id, "titremessage" => $titremessage, "reponse" => $reponse, "sujet_id" => $sujet, "utilisateur_id" => Session::getUtilisateur()->getId()];

                    $addPost = $manMessage->modPost($array);
                } else var_dump("Sauf erreur, Ce n'est pas votre sujet vous ne pouvez pas le modifier");
            } else
                var_dump("Vous devez vous connectez pour modifier un sujet.");
        } else
            var_dump(" Champs manquants");
    }
}

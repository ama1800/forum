<?php

namespace Controller;

use App\AbstractController;
use App\Session;
use App\Router;
use Model\Manager\CategorieManager;
use Model\Manager\SujetManager;
use Model\Manager\MessageManager;
use Model\Manager\UtilisateurManager;

class ForumController extends AbstractController
{

    /**
     * Afficher tous les Sujets
     */
    public function listSujets()
    {

        $manSujet = new SujetManager();

        $pageActuel = (isset($_GET['p'])) ? $_GET['p'] : 1;
        $parPage = 5;
        $page = ($pageActuel - 1) * $parPage;

        $sujets = $manSujet->listSujets($page, $parPage);
        $nbSujets = $manSujet->nbSujets();

        return [
            "view" => "sujet\listSujets.php",
            "data" => [
                "sujets" => $sujets,
                "nbSujets" => $nbSujets
            ],
            "titrePage" => "FORUM | sujets"
        ];
    }

    /**
     * Afficher les Messages d'un Sujet
     */
    public function showAllPostsByTopic()
    {

        $id = (isset($_GET['id'])) ? $_GET['id'] : null;

        $manSujet = new SujetManager();
        $manMessage = new MessageManager();

        $sujet = $manSujet->findOneById($id);
        $messages = $manMessage->findAllBySujet($id);
        $nb = $manMessage->nbMessageBySujet($id);

        return [
            "view" => "message/messagesBySujet.php",
            "data" => [
                "sujet" => $sujet,
                "messages" => $messages,
                "nb" => $nb
            ],
            "titrePage" => "FORUM | sujet:"
        ];
    }

    /**
     * Sujets par categorie
     */
    public function showAllTopicsByCategorie()
    {

        $id = (isset($_GET['id'])) ? $_GET['id'] : null;

        $manCategorie = new CategorieManager();
        $manSujet = new SujetManager();
        $manmess = new MessageManager();

        $categorie = $manCategorie->findOneById($id);
        $sujets = $manSujet->findByCategorie($id);
        $nb = $manSujet->nbSujetByCategorie($id);
        $nbm = $manCategorie->nbMessageByCategorie($id);
        $message = $manmess->sujetOfMessage($id);

        return [
            "view" => "categorie/detailCategorie.php",
            "data" => [
                "categorie" => $categorie,
                "sujets" => $sujets,
                "nb" => $nb,
                "nbm" => $nbm,
                "topicOfPost" => $message
            ],
            "titrePage" => "FORUM | categorie:"
        ];
    }

    /**
     * Liste des utilisateurs
     */
    public function latestUsers()
    {

        $manager = new UtilisateurManager();
        // récuperer le numero de la page actuel
        $p = (isset($_GET['p'])) ? $_GET['p'] : 1;
        //  les valeurs par defaut
        $parPage = 5;
        $pageActuel = $p;
        // calculer quel page de la liste a afficher(exemple page = (2-1)*5 c'est l'equivalent de 5,5 dans la requete qui veut dire la 2éme page de la liste
        $page = ($pageActuel - 1) * $parPage;
        // $colors= $this->colors($pseudo);

        $users = $manager->findAll($page, $parPage);
        // Pour changer l'afficage des roles qui est en nombre par les grades en string
        $grades = self::herarchie();
        $nbUsers = $manager->nbUtilisateurs();



        return [
            "view" => "utilisateur\listusers.php",
            "data" => [
                "users" => $users,
                "nbUsers" => $nbUsers,
                "grades" => $grades,
                // "colors" =>$colors
            ],
            "titrePage" => "FORUM | utilisateurs"
        ];
    }

    /**
     * Recherche des sujets
     */
    public function search()
    {
        if (!empty($_POST['q'])) {
            //  verfier que l'user a bien saisie quelque chose
            if (Session::getUtilisateur()) {
                // verifie que l'user est connecter
                $q = filter_input(INPUT_POST, "q", FILTER_UNSAFE_RAW);

                $manMessage = new MessageManager();
                $resultsM = $manMessage->search($q);
                $manSujet = new SujetManager();
                $resultsS = $manSujet->search($q);
                $result = array_merge($resultsM, $resultsS);
                return [
                    "view" => "forum\search.php",
                    "data" => [
                        "result" => $result,
                        "resultsM" => $resultsM,
                        "resultsS" => $resultsS
                    ],
                    "titrePage" => "Resultat de " . $q
                ];
            } else
                var_dump("Vous devez vous connectez pour faire votre recherche.");
        } else
            var_dump(" Vous n'avez rien saisie??!!");
    }
}

<?php
    namespace Controller;
    
    
    use App\Session;
    use App\Router;
    use Model\Manager\AccueilManager;
    use Model\Manager\CategorieManager;
    use Model\Manager\SujetManager;
    use Model\Manager\MessageManager;
    use Model\Manager\UtilisateurManager;
   
    class AccueilController {
        /**
         * Afficher la page d'accueil
         */
    public function index(){
        Session::authenticationRequired("ROLE_USER");

            return [
                "view" => "accueil.php", 
                "data" => null
            ];
        Router::redirectTo("forum","listSujets");
        // Router::redirectTo("accueil","allCategories");
    }
    public function allCategories(){

        $id = (isset($_GET['id'])) ? $_GET['id'] : null;

        $manager = new CategorieManager();
        $manMessage = new MessageManager();

        $nbm= $manager->nbMessageByCategorie($id);
        $categories = $manager->findAll();
        $messges= $manMessage->LatestPostsByCat($id);
        $totalMessges= $manMessage->totalMessages($id);
        return [
            "view" => "forum/accueil.php", 
            "data" => [
                "categories" => $categories,
                "nbm" => $nbm,
                "messages" => $messges,
                "totalMessages" => $totalMessges
            ],
            "titrePage" => "FORUM | Accueil"
        ];
    }
    
    
}
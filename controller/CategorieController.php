<?php
    namespace Controller;
    
    use App\Session;
    use App\Router;
    use Model\Manager\CategorieManager;
    use Model\Manager\SujetManager;
    use Model\Manager\MessageManager;

class CategorieController {
    public function supcategorie()
    {

        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        
        $manager = new CategorieManager();
        $manager->deleteCategorie($id);
    }
}
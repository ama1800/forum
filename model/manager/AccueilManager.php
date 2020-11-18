<?php
    namespace Model\Manager;
    

    use App\AbstractManager;
    
    class AccueilManager extends AbstractManager
    {
        private static $classname = "Model\Entity\Categorie";

        public function __construct(){
            self::connect(self::$classname);
        }
}
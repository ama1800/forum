<?php
    namespace App;

    abstract class Router
    {
        public static function CSRFProtection($token){
            if(!empty($_POST)){
                if(isset($_POST['token'])){
                    $form_csrf = $_POST['token'];
                    if(hash_equals($form_csrf, $token)){
                        return true;
                    }
                }
                return false;
            }
            return true;
        }
        
        public static function handleRequest($get){
            $ctrlname = "Controller\ForumController";
            $method = "listSujets";
            
            if(isset($get['ctrl'])){
                $ctrlname = "Controller\\".ucfirst($get['ctrl'])."Controller";
            }
            
            $ctrl = new $ctrlname();

            if(isset($get['method']) && method_exists($ctrl, $get['method'])){
                $method = $get['method'];
            }
            
            return $ctrl->$method();
        }

        public static function redirectTo($ctrl = null, $method = null){

            header("Location:?ctrl=".$ctrl."&method=".$method);
            die();
           
        }

    }

    
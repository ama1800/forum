<?php

namespace App;


// use App\Router;

require_once "app/Autoloader.php";
Autoloader::register();



define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', '.' . DS);
define('PUBLIC_PATH', ROOT_DIR . 'public' . DS);
define('CSS_PATH', PUBLIC_PATH . 'css' . DS);
define('IMG_PATH', PUBLIC_PATH . 'img' . DS);
define('JS_PATH', PUBLIC_PATH . 'js' . DS);
define('FILES_PATH', PUBLIC_PATH . 'files' . DS);

define('AVATAR_PATH', FILES_PATH . 'avatar' . DS);

define('SERVICE_PATH', ROOT_DIR . 'app' . DS);
define('CTRL_PATH', ROOT_DIR . 'controller' . DS);
define('VIEW_PATH', ROOT_DIR . 'view' . DS);

//On demande à la Session de générer une clef propre à elle-même
Session::generateKey();
//Le token CSRF est généré pour cette requête HTTP seulement
$token = hash_hmac("sha256", "phrase_secrete", Session::getKey());
// revoir la doc PHP pour le hash_mac

//si la protection présente dans Router renvoie true
if (Router::CSRFProtection($token)) {
    //le routeur donne la pemission au controlleur de traiter la demande 
    //(aka : continuer la prise en charge de la requête comme normalement)
    $result = Router::handleRequest($_GET);
} //sinon, on redirige vers l'accueil
else Router::redirectTo("security", "logout");
ob_start();
if (is_array($result) && array_key_exists('view', $result)) {
    $data = isset($result['data']) ? $result['data'] : null;
    include VIEW_PATH . $result['view'];
} else include VIEW_PATH . "404.html";
//else include VIEW_PATH.$result['view'];
$page = ob_get_contents();
ob_end_clean();

include VIEW_PATH . "layout.php";

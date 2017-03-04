<?php

require_once 'app/request/Request.php';
require_once 'app/controllers/Controller.php';
require_once 'app/controllers/AdminController.php';
require_once 'app/controllers/ClientController.php';
require_once 'app/view/View.php';
require_once 'app/config/config.php';
require_once 'app/database/Database.php';
require_once 'app/models/Utilisateur.php';
require_once 'app/models/Publication.php';
require_once 'app/models/Question.php';
require_once 'app/models/NotificationPub.php';
require_once 'app/models/Evaluation.php';
require_once 'app/validation/Validation.php';

$url = $_SERVER['REQUEST_URI'];

//echo $url;

$url = explode('/',$url);

//print_r($url);

$view = new View();

$database = new Database();

$request = new Request();

//Extraction du parametre de l'url pour creer un nouveau controlleur et modele
if(isset($url[2]) && !empty($url[2])) {
    $url[2]=ucfirst($url[2]);
    $controllerName = $url[2]."Controller";
    //Injection du modele et de la vue
    $controller = new $controllerName($view,$request);
//    print_r($controller);

} else {
    echo "ERREUR!";
}


if(method_exists($controller,$url[3])) {
    $method = $url[3];
    $controller->$method();
}
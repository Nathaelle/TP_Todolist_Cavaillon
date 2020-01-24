<?php
session_start();

require "conf/autoload.php";
require "conf/global.php";

// Afficher le contenu d'une superglobale (à décommenter si besoin)
//var_dump($_GET);
//var_dump($_POST);
//var_dump($_SESSION);

// On vérifie qu'une route est bien transmise en paramètre, si ce n'est pas le cas, on lui donne une valeur par défaut
// pour éviter que ça "casse" à l'étape suivante
$route = (isset($_REQUEST['route']))? $_REQUEST['route'] : 'home';

$router = new Controllers\Router($route);
unset($_REQUEST['route']); // Normalement on ne doit plus en avoir besoin !

$controller = $router->getController();
$controller->init($_REQUEST);//setRequest()
unset($_REQUEST); 

$view = $controller->getView();


// ----- AFFICHAGE -------
require "template.php";
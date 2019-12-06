<?php
var_dump($_GET);

$route = (isset($_REQUEST['route']))? $_REQUEST['route'] : 'home';

switch($route) {
    case 'home' : home();
    break;
    case 'membre' : membre();
    break;
    case 'insert_user': insert_user();
    break;
    default : home();
}

// Fonctionnalités d'affichage
function home() {
    global $view;
    $view = 'views/home.html';
}

function membre() {
    global $view;
    $view = 'views/membre.php';
}

// Fonctionnalités de traitement, redirigées
function insert_user() {


}





require "template.php";
<?php
session_start();

require "conf/autoload.php";

// Afficher le contenu d'une superglobale (à décommenter si besoin)
var_dump($_GET);
var_dump($_POST);
var_dump($_SESSION);

// On vérifie qu'une route est bien transmise en paramètre, si ce n'est pas le cas, on lui donne une valeur par défaut
// pour éviter que ça "casse" à l'étape suivante
$route = (isset($_REQUEST['route']))? $_REQUEST['route'] : 'home';

switch($route) {
    case 'home' : home();
    break;
    case 'membre' : membre();
    break;
    case 'insert_user': insert_user();
    break;
    case 'connect_user': connect_user();
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

    // Première verif : Si les "champs" du formulaire ont tous bien été renseignés
    if(!empty($_POST['pseudo']) && !empty($_POST['passwd']) && !empty($_POST['passwd2'])) {
        
        // Je vérifie que les deux mots de passe entrés correspondent
        if($_POST['passwd'] === $_POST['passwd2']) {
            
            // Dans ce cas, j'instancie un nouvel objet utilisateur, et lui renseigne ses propriétés
            $utilisateur = new Utilisateur();
            $utilisateur->setPseudo($_POST['pseudo']);
            $utilisateur->setPasswd(password_hash($_POST['passwd'], PASSWORD_DEFAULT));

            $utilisateur->save_user();
        }
    }

    header("Location:index.php?route=home");
    
}

function connect_user() {

    $utilisateur = new Utilisateur();
    $utilisateur->setPseudo($_POST['pseudo']);

    $utilisateur->verify_user();
    if(password_verify($_POST['passwd'], $utilisateur->getPasswd())) {
        // Dans ce cas on est connecté, on place donc l'utilisateur en session
        $_SESSION['user'] = $utilisateur;
        // Et on le redirige sur son espace
        header("Location:index.php?route=membre");
    } else {
        header("Location:index.php?route=home");
    }

}






// ----- AFFICHAGE -------
require "template.php";
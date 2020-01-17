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

switch($route) {
    case 'home' : home(); // affichage
    break;
    case 'membre' : membre(); // affichage
    break;
    case 'insert_user': insert_user();
    break;
    case 'connect_user': connect_user();
    break;
    case 'deconnexion': deconnexion();
    break;
    case 'insert_tache' : insert_tache();
    break;
    case 'delete_tache' : delete_tache();
    break;
    case 'modif_tache' : modif_tache();
    break;
    default : home();
}

// Fonctionnalités d'affichage
function home() {
    global $view;
    $view = 'views/home.html';
}

function membre() {
    if(isset($_SESSION['user'])) {

        global $view;
        $view = 'views/membre.php';

        global $taches;
        $tache = new Models\Tache();

        if(isset($_REQUEST['tache'])) {
            global $item;
            $tache->setId($_REQUEST['tache']);
            $item = $tache->select();
        }
        
        $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);
        $taches = $tache->selectByUser();
        
    } else {
        header("Location:index.php?route=home");
    }
}

// Fonctionnalités de traitement, redirigées
function insert_user() {

    // Première verif : Si les "champs" du formulaire ont tous bien été renseignés
    if(!empty($_POST['pseudo']) && !empty($_POST['passwd']) && !empty($_POST['passwd2'])) {
        
        // Je vérifie que les deux mots de passe entrés correspondent
        if($_POST['passwd'] === $_POST['passwd2']) {
            
            // Dans ce cas, j'instancie un nouvel objet utilisateur, et lui renseigne ses propriétés
            $utilisateur = new Models\Utilisateur();
            $utilisateur->setPseudo($_POST['pseudo']);
            $utilisateur->setPasswd(password_hash($_POST['passwd'], PASSWORD_DEFAULT));
            $utilisateur->setNom($_POST['nom']);
            $utilisateur->setPrenom($_POST['prenom']);
            $utilisateur->setEmail($_POST['email']);

            var_dump($utilisateur);
            $utilisateur->insert();
        }
    }

    header("Location:index.php?route=home");
    
}

function connect_user() {

    $utilisateur = new Models\Utilisateur();
    $utilisateur->setPseudo($_POST['pseudo']);
    
    $utilisateur->verify_user();
    var_dump($utilisateur);
    if(password_verify($_POST['passwd'], $utilisateur->getPasswd())) {
        // Dans ce cas on est connecté, on place donc l'utilisateur en session
        $_SESSION['user']['idUtilisateur'] = $utilisateur->getId();
        $_SESSION['user']['pseudo'] = $utilisateur->getPseudo();
        // Et on le redirige sur son espace
        header("Location:index.php?route=membre");
    } else {
        //header("Location:index.php?route=home");
    }
}

function deconnexion() {
    $_SESSION = array();
    session_destroy();
    header("Location:index.php?route=home");
}

function insert_tache() {

    $tache = new Models\Tache();
    $tache->setDescription($_POST['description']);
    $tache->setDeadline($_POST['date_limite']);
    $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);

    $tache->insert();
    
    header("Location:index.php?route=membre");
}

function delete_tache() {

    $tache = new Models\Tache();
    $tache->setId($_REQUEST['id_tache']);
    $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);

    $tache->delete();
    
    header("Location:index.php?route=membre");
}

function modif_tache() {

    $tache = new Models\Tache();
    $tache->setId($_POST['id_tache']);
    $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);
    $tache->setDescription($_POST['description']);
    $tache->setDeadline($_POST['date_limite']);

    $tache->update();
    
    header("Location:index.php?route=membre");
}


// ----- AFFICHAGE -------
require "template.php";
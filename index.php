<?php
session_start();

require "conf/autoload.php";
require "conf/global.php";
require "conf/sec.php";

// Afficher le contenu d'une superglobale (à décommenter si besoin)
//var_dump($_GET);
//var_dump($_POST);
//var_dump($_SESSION);

// On vérifie qu'une route est bien transmise en paramètre, si ce n'est pas le cas, on lui donne une valeur par défaut
// pour éviter que ça "casse" à l'étape suivante
$route = (isset($_REQUEST['route']))? $_REQUEST['route'] : 'home';

//$router = new Controllers\Router($route);
//$controller = $router->getController();
//$view = $controller->getView();
try {
    $view = $route();
} catch(Error $e) {
    $view = home();
}

// Fonctionnalités d'affichage
function home() {
    return ['view' => 'views/home.html'];
}

function membre() {
  
    if(isset($_SESSION['user'])) {

        $tache = new Models\Tache();
        $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);
        $taches = $tache->selectByUser();

        if(isset($_REQUEST['tache'])) {
            
            $tache->setId($_REQUEST['tache']);
            $item = $tache->select();

            $_SESSION['token']['tache'] = mkToken($item->getId());

            return ['view' => 'views/membre.php', 'datas' => [
                'taches' => $taches,
                'item' => $item
            ]];
        }
        
    } else {
        header("Location:home.html");
    }

    return ['view' => 'views/membre.php', 'datas' => [
        'taches' => $taches
    ]];

}

// Fonctionnalités de traitement, redirigées
function insert_user() {

    // Première verif : Si les "champs" du formulaire ont tous bien été renseignés
    if(!empty($_POST['pseudo']) && !empty($_POST['passwd']) && !empty($_POST['passwd2'])) {
        
        // Je vérifie que les deux mots de passe entrés correspondent
        if($_POST['passwd'] === $_POST['passwd2']) {

            if(!preg_match("#^[a-zA-Z'àâäïîéèêôöëùûüçÀÂÉÈÔÙÛÇ\s-]+$#", $_POST['nom'])) {
                $_SESSION['validerrors']['nom'] = "Votre nom n'est pas valide";
            }

            
            // (...)
            
            
            if(!isset($_SESSION['validerrors'])) {

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
    }

    header("Location:home.html");
    
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
        header("Location:membre.html");
    } else {
        header("Location:home.html");
    }
}

function deconnexion() {
    $_SESSION = array();
    session_destroy();
    header("Location:home.html");
}

function insert_tache() {

    $tache = new Models\Tache();
    $tache->setDescription($_POST['description']);
    $tache->setDeadline($_POST['date_limite']);
    $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);

    $tache->insert();
    
    header("Location:membre.html");
}

function delete_tache() {

    $tache = new Models\Tache();
    $tache->setId($_REQUEST['tache']);
    $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);

    $tache->delete();
    
    header("Location:membre.html");
}

function modif_tache() {

    // Vérification de l'intégrité des données transmises via champ hidden
    // Dans l'absolu, il faut également valider TOUTES les données !!
    if(chkToken($_POST['id_tache'])) {

        $tache = new Models\Tache();
        $tache->setId($_POST['id_tache']);
        $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);
        $tache->setDescription($_POST['description']);
        $tache->setDeadline($_POST['date_limite']);

        $tache->update();
    }

    
    
    header("Location:membre.html");
}


// ----- AFFICHAGE -------
require "template.php";
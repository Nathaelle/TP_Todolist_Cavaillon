<?php

namespace Controllers;
use Models\Utilisateur;

class ConnectUser {

    private $request;

    function init($request) {
        $this->request = $request;
        $this->index();
    }

    function index() {

        $utilisateur = new Utilisateur();
        $utilisateur->setPseudo($this->request['pseudo']);
        
        $utilisateur->verify_user();
        
        if(password_verify($this->request['passwd'], $utilisateur->getPasswd())) {

            // Dans ce cas on est connecté, on place donc l'utilisateur en session
            $_SESSION['user']['idUtilisateur'] = $utilisateur->getId();
            $_SESSION['user']['pseudo'] = $utilisateur->getPseudo();

            // Et on le redirige sur son espace
            header("Location:membre.html");
            exit;

        } else {

            header("Location:home.html");
            exit;
        }

    }

    function getView() { return null; }

}
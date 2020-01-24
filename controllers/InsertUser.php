<?php

namespace Controllers;
use Models\Utilisateur;

class InsertUser {

    private $request;

    function init($request) {
        $this->request = $request;
        $this->index();
    }

    function index() {

        // Première verif : Si les "champs" du formulaire ont tous bien été renseignés
        if(!empty($this->request['pseudo']) && !empty($this->request['passwd']) && !empty($this->request['passwd2'])) {
            
            // Je vérifie que les deux mots de passe entrés correspondent
            if($this->request['passwd'] === $this->request['passwd2']) {

                if(!preg_match("#^[a-zA-Z'àâäïîéèêôöëùûüçÀÂÉÈÔÙÛÇ\s-]+$#", $this->request['nom'])) {
                    $_SESSION['validerrors']['nom'] = "Votre nom n'est pas valide";
                }

                
                // (...)
                
                
                if(!isset($_SESSION['validerrors'])) {

                    // Dans ce cas, j'instancie un nouvel objet utilisateur, et lui renseigne ses propriétés
                    $utilisateur = new Utilisateur();
                    $utilisateur->setPseudo($this->request['pseudo']);
                    $utilisateur->setPasswd(password_hash($this->request['passwd'], PASSWORD_DEFAULT));
                    $utilisateur->setNom($this->request['nom']);
                    $utilisateur->setPrenom($this->request['prenom']);
                    $utilisateur->setEmail($this->request['email']);

                    $utilisateur->insert();
                }
                
            }
        }

        header("Location:home.html");
        exit;

    }

    function getView() {
        return null;
    }

}
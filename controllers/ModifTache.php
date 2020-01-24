<?php

namespace Controllers;
use Models\Tache;

class ModifTache {

    private $request;

    function init($request) {
        $this->request = $request;
        $this->index();
    }

    function index() {

        // Vérification de l'intégrité des données transmises via champ hidden
        // Dans l'absolu, il faut également valider TOUTES les données !!
        if(chkToken($this->request['id_tache'])) {

            $tache = new Tache();
            $tache->setId($this->request['id_tache']);
            $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);
            $tache->setDescription($this->request['description']);
            $tache->setDeadline($this->request['date_limite']);

            $tache->update();
        }
        
        header("Location:membre.html");
        exit;

    }

    function getView() {
        return null;
    }

}
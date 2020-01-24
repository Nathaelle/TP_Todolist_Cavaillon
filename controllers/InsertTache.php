<?php

namespace Controllers;
use Models\Tache;

class InsertTache {

    private $request;

    function init($request) {
        $this->request = $request;
        $this->index();
    }

    function index() {

        $tache = new Tache();
        $tache->setDescription($this->request['description']);
        $tache->setDeadline($this->request['date_limite']);
        $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);

        $tache->insert();
    
        header("Location:membre.html");
        exit;

    }

    function getView() {
        return null;
    }

}
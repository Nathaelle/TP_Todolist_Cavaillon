<?php

namespace Controllers;
use Models\Tache;

class DeleteTache {

    private $request;

    function init($request) {
        $this->request = $request;
        $this->index();
    }

    function index() {

        $tache = new Tache();
        $tache->setId($this->request['tache']);
        $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);

        $tache->delete();
        
        header("Location:membre.html");
        exit;

    }

    function getView() {
        return null;
    }

}
<?php

namespace Controllers;
use Models\Tache;

class Membre {

    private $view;

    function __construct() {

        $this->view = $this->index();
    }

    function index() {

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?route=home");
        }

        $tache = new Tache();
        $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);
        $taches = $tache->selectByUser();
            

        return ['view' => 'views/membre.php', 'datas' => [
            'taches' => $taches
        ]];

    }

    function getView() {
        return $this->view;
    }







}
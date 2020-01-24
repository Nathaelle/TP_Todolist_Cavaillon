<?php

namespace Controllers;
use Models\Tache;

class Membre {

    private $view;

    function __construct() {

    }

    function init() {
        if(isset($_REQUEST['tache'])) {
            $this->view = $this->indexWithTask();
        } else {
            $this->view = $this->index();
        }
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

    function indexWithTask() {

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?route=home");
        }

        $tache = new Tache();
        $tache->setIdUtilisateur($_SESSION['user']['idUtilisateur']);
        $taches = $tache->selectByUser();

        $tache->setId($_REQUEST['tache']);
        $item = $tache->select();

        $_SESSION['token']['tache'] = mkToken($item->getId());

        return ['view' => 'views/membre.php', 'datas' => [
            'taches' => $taches,
            'item' => $item
        ]];
    }

    function getView() {
        return $this->view;
    }







}
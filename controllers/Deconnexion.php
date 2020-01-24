<?php

namespace Controllers;

class Deconnexion {

    function init() {
        $this->index();
    }

    function index() {

        $_SESSION = array();
        session_destroy();
        unset($_SESSION);
        header("Location:home.html");
        exit;

    }

    function getView() {
        return null;
    }

}
<?php

namespace Controllers;

class Home {

    private $view;

    function __construct() {

        $this->view = $this->index();
    }

    function index() {


        return $this->view = ['view' => 'views/home.html'];

    }

    function getView() {
        return $this->view;
    }

}
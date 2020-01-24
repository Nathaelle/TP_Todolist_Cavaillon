<?php

namespace Controllers;

class Home {

    private $view;

    function init() {
        $this->view = $this->index();
    }

    function index() {

        return $this->view = ['view' => 'views/home.html'];

    }

    function getView() {
        return $this->view;
    }

}
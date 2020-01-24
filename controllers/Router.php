<?php

namespace Controllers;
use Error;

class Router {

    protected $controller;

    function __construct(string $route) {

        $name = $this->format($route);
        try {
            $this->controller = new $name();
        } catch (Error $e) {
            //$this->controller = new Home();
        }
    }

    function format(string $route) {
        $tab = explode('_', $route);
        foreach($tab as &$val) {
            $val = ucfirst($val);
        }
        $name = join($tab);
        return $name;
    }

    function getController() {
        return $this->controller;
    }

}
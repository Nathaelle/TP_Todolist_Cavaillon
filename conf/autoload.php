<?php

// Documentation https://www.php.net/manual/fr/function.spl-autoload-register.php
/*spl_autoload_register(function ($classname) {
    if(file_exists("models/$classname.php")) {
        require "models/$classname.php";
    }
});*/

spl_autoload_register(function ($classname) {
    $tab = explode("\\", $classname);
    if(sizeof($tab) === 2) {
        $tab[0] = lcfirst($tab[0]);
        if(file_exists($tab[0]."/".$tab[1].".php")) {
            require $tab[0]."/".$tab[1].".php";
        }
    }
});
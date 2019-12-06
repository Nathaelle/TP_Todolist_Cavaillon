<?php

// Documentation https://www.php.net/manual/fr/function.spl-autoload-register.php
spl_autoload_register(function ($classname) {
    if(file_exists("models/$classname.php")) {
        require "models/$classname.php";
    }
});
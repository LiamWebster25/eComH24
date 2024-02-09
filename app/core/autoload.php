<?php
spl_autoload_register(
    function ($class_name) {
        //version 0.1 PSR4 autoloader
        $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);

        if (file_exists($class_name . '.php')) {
            require_once($class_name . '.php');
            return true;
        } else {
            return false;
        }
    }
);
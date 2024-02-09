<?php
namespace app\core;

class Controller {
    function view($name, $data = null) {
        //load the view fies to present them to the Web user
        include('app/views/' . $name . '.php');
    }
}
<?php
namespace app\controllers;

use stdClass;

class Person extends \app\core\Controller{

    function list() {
        $people = \app\models\Person::getAll();
        $this->view('Person/list', $people);
    }

    function register() {
        $this->view('Person/register');
    }

    function complete_registration() {
        //Person object
        $person = new \app\models\Person();
        //declare a person object
        $person->first_name = $_POST['first_name'];
        $person->last_name = $_POST['last_name'];
        $person->email = $_POST['email'];
        $person->weekly_flyer = in_array('weekly_flyer', $_POST['publications']);
        $person->mailing_list = in_array('mailing_list', $_POST['publications']);
        print_r($person);
        //hypothetically send to db
        //show the feedback view to confirm with the user

        $person->insert(); //Add person to data file

        $this->view('Person/complete_registration', $person);
    }
}
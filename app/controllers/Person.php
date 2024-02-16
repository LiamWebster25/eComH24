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
        $publications = $_POST['publications'] ?? [];
        $person->weekly_flyer = in_array('weekly_flyer', $publications);
        $person->mailing_list = in_array('mailing_list', $publications);
        //hypothetically send to db
        //show the feedback view to confirm with the user

        $person->insert(); //Add person to data file

        //redirect the user back to the list
        header('location:/Person/');
    }

    function delete() {
        //get the id of the record to delete
        $id = $_GET['id'];
        //call the deletion on Person
        \app\models\Person::delete($id);
        //redirect the user to the updated list
        header('location:/Person/');
    }

    //get the relevant record and display it in a form to allow a user to modify the information
    //URL like http://localhost/Person/edit?id=0
    function edit() {
        //get the id of the record to edit
        $id = $_GET['id'];
        //get the record
        $person = \app\models\Person::get($id);
        //get the updated information from the user
        $this->view('Person/edit', $person);
    }

    //update the record from the information given by the user
    function update() {
        //get the id
        $id = $_GET['id'];
        //get the record
        $person = \app\models\Person::get($id);
        //change the record fields (same as populating data before insert)
        $person->first_name = $_POST['first_name'];
        $person->last_name = $_POST['last_name'];
        $person->email = $_POST['email'];
        $publications = $_POST['publications'] ?? [];
        $person->weekly_flyer = in_array('weekly_flyer', $publications);
        $person->mailing_list = in_array('mailing_list', $publications);
        //update the record in the storage  
        $person->update();
        //redirect to the list
        header('location:/Person/');
    }
}
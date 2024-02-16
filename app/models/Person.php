<?php
namespace app\models;

class Person
{
    public $first_name;
    public $last_name;
    public $email;
    public $weekly_flyer;
    public $mailing_list;

    public function __construct($object = null)
    {
        if ($object == null) {
            return;
        }

        $this->first_name = $object->first_name;
        $this->last_name = $object->last_name;
        $this->email = $object->email;
        $this->weekly_flyer = $object->weekly_flyer;
        $this->mailing_list = $object->mailing_list;
    }


    //insert the record in the data file
    public function insert()
    {
        //Open a file for writing (append)
        $filename = 'resources/People.txt';
        //obtain exclusive access to the file to avoid data corruption
        $file_handle = fopen($filename, 'a'); // 'a' is for append and 'w' is for writing from the start
        flock($file_handle, LOCK_EX);
        // LOCK_SH to acquire a shared lock (reader).
        // LOCK_EX to acquire an exclusive lock (writer).
        // LOCK_UN to release a lock (shared or exclusive).

        //format the data and write it to the file
        $data = json_encode($this);
        fwrite($file_handle, $data . "\n"); //Place a single record on each line
        //release the exclusive access to the file
        flock($file_handle, LOCK_UN);
        //close the file
        fclose($file_handle);
    }
    public function update()
    {
        //Read the entire file line by line and write each line except the one at line number $id...
        $filename = "resources/People.txt";
        //get the contents of the file in this array
        $file_contents = file($filename);
        //open a new version of the same file
        $file_handle = fopen($filename, "w");
        //obtain a lock on the file (avoid reading data that is changing)
        flock($file_handle, LOCK_EX);

        $counter = 0;
        $size = count($file_contents);
        while ($counter < $size) {
            if ($this->id != $counter) {
                fwrite($file_handle, $file_contents[$counter]);
            } else {
                //add the modified record
                unset($this->id);
                $data = json_encode($this);
                fwrite($file_handle, $data . "\n");
            }
            $counter++;//next record
        }
        flock($file_handle, LOCK_UN);
        fclose($file_handle);
    }
    public static function getAll()
    {
        //read the file and return the collection of people (All Person records)
        $filename = 'resources/People.txt';
        $records = file($filename);

        //TODO: process the JSON strings into objects
        foreach ($records as $key => $value) {
            $object = json_decode($value);
            $person = new \app\models\Person($object);
            $records[$key] = $person;
        }
        return $records;
    }

    //delete a record at line $id in the file
    public static function delete($id)
    {
        //Read the entire file line by line and write each line except the one at line number $id...
        $filename = "resources/People.txt";
        //get the contents of the file in this array
        $file_contents = file($filename);
        //open a new version of the same file
        $file_handle = fopen($filename, "w");
        //obtain a lock on the file (avoid reading data that is changing)
        flock($file_handle, LOCK_EX);

        $counter = 0;
        $size = count($file_contents);
        while ($counter < $size) {
            if ($id != $counter) {
                fwrite($file_handle, $file_contents[$counter]);
                break;
            }//else it is skipped
            $counter++;//next record
        }
        flock($file_handle, LOCK_UN);
        fclose($file_handle);
    }

    public static function get($id)
    {
        //read the file and return the collection of people (All Person records)
        $filename = 'resources/People.txt';
        $records = file($filename);

        //process the JSON strings into object
        $object = json_decode($records[$id]);
        $person = new \app\models\Person($object);
        $person->id = $id;
        //return the record       
        return $person;
    }


}
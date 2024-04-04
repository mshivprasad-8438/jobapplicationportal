<?php
class JobDetails extends EMongoEmbeddedDocument{
    public $salary;
    public $location;
    public $description;

    public function rules(){
        return array(
            ["salary,location,description","safe"],
            ["salary,location,description","required"],

            );
    }

    public function embeddedDocuments(){
        return array(
            'salary' => 'salary',
            'location'=>'location',
            'description'=>'description',

        );
    }
    
}
<?php
class UserTracking extends EMongoDocument
{
    public $_id;
    public $email;
    public $jobid = array(); 
   

    public function rules()
    {
        return array(
           
            array('email', 'required'),
            array('email', 'email'),
           
        );
    }
    public function getCollectionName()
    {
        return 'UserTracking';
    }
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
}
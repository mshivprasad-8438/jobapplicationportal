<?php
 
class Jobs extends EMongoDocument
{
    public $jobTitle;
    public $companyName;
    public $totalApplications;
    public $openings;
    public $category;
    public $lastDate;
    public $logo;
    public $isAvailable;
    public $email;
    public $postedTime;
    public function getCollectionName()
    {
        return "jobs";
    }
 
    public function getMongoDBComponent()
    {
        return Yii::app()->mongodbMp;
    }
 
 
    public function embeddedDocuments()
    {
        return array(
            'details' => 'JobDetails',
        );
    }
 
 
    public function beforeSave()
    {
        try {
            if ($this->isNewRecord) {
                // $this->totalApplications = (int) $this->totalApplications;
                // $this->openings = (int) $this->openings;
                // $this->details->salary = (int) $this->details->salary;
                $this->lastDate = new MongoDate(strtotime($this->lastDate));
                $this->postedTime = new MongoDate(strtotime(date('Y-m-d H:i:s')));// Assuming create_time is a datetime field
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
 
    public function rules()
    {
        return array(
            array('jobTitle,companyName,category,totalApplications,openings,lastDate,logo', 'required'),
            array('jobTitle,companyName,category,totalApplications,openings,lastDate,logo', 'safe'),
        );
    }
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
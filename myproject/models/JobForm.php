<?php
class JobForm extends CFormModel{
    public $jobTitle;
    public $companyName;
    public $totalApplications;
    public $openings;
    public $category;
    public $lastDate;
    public $salary;
    public $location;
    public $description;


        // public $image;

    public function rules(){
        return[
            array('jobTitle,companyName,totalApplications,openings,category,salary,location,description,lastDate','required'),
        ];
    }

    public function attributeLabels()
	{
		return array(
			'jobTitle' => 'jobTitle',
			'companyName' => 'companyName',
			'totalApplications' => 'totalApplications',
			'openings'=>'openings',
			'category' => 'category',
            'lastDate'=>'lastDate',
			'salary' => 'salary',
			'location' => 'location',
			'description' => 'description',
		);
	}
    
}
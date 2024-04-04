<?php

class Employee extends EMongoDocument{
    public $name;
    public $companyName;
    public $email;
    public $password;
    public $industry;
    public $eligibility;
    public $employeeId;
    public $profile;
    public $role;
    public $registeredTime;
    public function getCollectionName(){
        return ("employees");
    }

    public function getMongoDBComponent(){
        return Yii::app()->mongodbMp;
    }

    public function primaryKey() {
		return 'email';
	}

	public function indexes() {
		return [
			'email'=>[
				'key'=>[
					'email'=>EMongoCriteria::SORT_ASC,
				],
				'unique'=>true
			]
		];
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->password=CPasswordHelper::hashPassword($this->password);//base64_encode($this->password);
            $this->role="employee";
            $this->eligibility= false;
        }
        return true;
    }

    public function rules()
	{ 
        return array(
			array('name,companyName,industry,employeeId,email,password','required'),
			array('name,companyName,industry,employeeId,email,password','safe'),
            array('email','email'),
        array('registeredTime', 'default', 'value' => new MongoDate(time())),
		);
	}

    // public function validateEmailDomain($attribute, $params) {
    //     $allowedDomains = ['darwinbox.io', 'companyname.io']; // Add more allowed domains as needed
    //     $domain = substr(strrchr($this->$attribute, "@"), 1);
    //     if (!in_array($domain, $allowedDomains)) {
    //         $this->addError($attribute, 'The email domain is not allowed.');
    //     }
    // }
    public function attributeLabels()
	{
		return array(
			'name' => 'name',
			'companyName' => 'companyName',
			'password' => 'password',
			'email' => 'email',
			'industry' => 'industry',
			'employeeId'=>'employeeId',
		);
	}

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
}
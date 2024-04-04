<?php

class Signupcolls extends EMongoDocument  {
	public $_id;
	public $name;
	public $email;
	public $password;
	public $password_reset_token;
	public $token;

	public function getCollectionName() {
		return 'signupcolls';
	}

	public function primaryKey()
   {
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
	public function getMongoDBComponent(){
        return Yii::app()->mongodb;
    }
// public function beforeSave()
// {
    
//     $this->password=CPasswordHelper::hashPassword($this->password);
//    echo("hello");
//     return parent::beforeSave();

// }
public function rules() {
	return array(
		array('name, email, password', 'required'),
		array('name, email, password, _id', 'safe'),
		array('email', 'email'), // Ensure that the email is a valid email address format
		
	);
}

public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	
	
}

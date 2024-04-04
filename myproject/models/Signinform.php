<?php

class Signinform extends CFormModel
{
    public $_id;
    public $email;
    public $password;
    public $rememberMe = false; // Added rememberMe property
    private $_identity;

    public function rules()
    {
        return array(
            array('password, email', 'required'),
            array('email', 'email'),
            array('rememberMe', 'boolean'), // Validation rule for rememberMe
            array('password', 'authenticate'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'password' => 'Password',
            'rememberMe' => 'Remember Me', // Label for rememberMe checkbox
        );
    }

    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity(strtolower($this->email), $this->password);
            
            if ($this->_identity->authenticate() == UserIdentity::ERROR_USERNAME_INVALID) {
                $this->addError('password', "You don't have an account");
            } elseif ($this->_identity->authenticate() == UserIdentity::ERROR_PASSWORD_INVALID) {
                $this->addError('password', "Incorrect username or password.");
            }
        }
    }

    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }

        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // Set duration based on rememberMe
            Yii::app()->user->login($this->_identity, $duration); 
            $session = Yii::app()->session;
           $session->open();
           $session['name'] = Yii::app()->user->getState('username');
            $session['email']=Yii::app()->user->getState('email');

            return true;
        } else {
            return false;
        }
    }
}

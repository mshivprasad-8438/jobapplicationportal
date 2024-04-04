<?php
 
class EmployeeSignin extends CFormModel
{  public $_id;
    public $email;
    public $password;
    private $_identity;
    public $rememberMe = false;
 
    public function rules()
    {
        return array(
            array('password, email', 'required'),
            array('email', 'email'),
            array('password', 'authenticate'),
        );
    }
 
    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'password' => 'Password',
        );
    }
 
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $this->_identity = new UserIdentity(strtolower($this->email), $this->password);
            
            
            if ($this->_identity->authenticate()==UserIdentity::ERROR_USERNAME_INVALID )
            {  
                $this->addError('password', "you don't have account");
            }
             
            if ($this->_identity->authenticate()==UserIdentity::ERROR_PASSWORD_INVALID)
            {  
                $this->addError('password', "Incorrect username or password.");
            }
        }
    }
 
    public function login()
    {
        if ($this->_identity === null)
        {
            $this->_identity = new UserIdentity($this->email, $this->password);
            
            $this->_identity->authenticate();
        }
    
        if ($this->_identity->errorCode===UserIdentity::ERROR_NONE)
        {
           
            Yii::app()->user->login($this->_identity);
            $model=Employee::model()
            ->startAggregation()
            ->match(['email' => $this->email])
            ->project(['eligibility' => 1,'_id' => 0])
            ->aggregate();
            // var_dump( $model['result'][0]['eligibility']);exit;
            return $model['result'][0]['eligibility'];
        }
        else
        {
         return false;
        }
    }

}
 
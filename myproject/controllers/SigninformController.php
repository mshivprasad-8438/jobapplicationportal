<?php

 use app\helpers\Mailhelper;
// use app\helpers\OtpHelper;
use Google\Client;
use League\OAuth2\Client\Provider\LinkedIn;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
require_once "/data/live/protected/modules/myproject/components/helpers/Mailhelper.php";
class SigninformController extends Controller{
   public $layout='emptylayout';
    
    public function actionIndex()
    {

      // $result=Yii::app()->cache->executeCommand('hset',['test','key1','v1']);
      //   $result=Yii::app()->cache->executeCommand('hgetall',['test']);
      // $session = Yii::app()->session;
      //   $session->open();
      //   $session['name1'] = 'testsession';
        
        $model=new Signinform();
       $this->render('signin',array('model'=>$model,"message"=>" "));
    }
    public function actionSignin()
    { 


      $model=new Signinform();
       if(isset($_POST["Signinform"]))
       {
          $model->attributes=$_POST["Signinform"];
          if($model->validate())
          {   
            if($model->login())
            {  
              $payload = array('email' => $model->email);
              $token = Yii::app()->jwt->encode($payload);
              $session=new CHttpSession;
              $session->open();
              $session['jwtToken']=$token; 
              
           
             $this->redirect("/myproject/about");
            }
            else{
               
              $this->redirect("/myproject/signupform");
            }
          }
          else {
          $this->render('signin', array('model' => $model));
         }
       }
    }

    

    public function  actionForgotpassword()
    {
      $model=new ForgotPasswordForm();
      $this->render('forgotPasswordForm',array('model'=>$model));
    }

    public function actionForgotpasswordsubmit()
    {
      $model = new ForgotPasswordForm();

      if (isset($_POST['ForgotPasswordForm'])) {
          $model->attributes = $_POST['ForgotPasswordForm'];

          if ($model->validate()) {
              $user = Signupcolls::model()->findByAttributes(['email' => $model->email]);

              if ($user !== null) {
                 $otp=OtpHelper::sendOtp();
                 if(MailHelper::sendMail($model->email,"OTP","OTP is $otp"))
                 {  
                  Yii::app()->session["reset_password_email"]=$model->email;
                
                  $this->render('enterotp');
                  return;
                 }
                 else
                 {
                  $model2=new Signinform();
                  $this->render('signin',array('model'=>$model2,'message'=>"failed to send otp"));
                  return;
                 }
                }
                else {
                  $model2=new Signupform();
                   $this->render("signupform",array('model'=>$model,'message'=>"You Don't have account please do signup"));
                   return;
                 }

              }
               else {
                $this->render('forgotPasswordForm',array('model'=>$model));
               }
          } else {
              Yii::app()->clientScript->registerScript('message096', '
              alert(" something went wrong");');
              $this->render('forgotPasswordForm', ['model' => $model]);
              return;
          }
     
    }


    public function actionSubmitotp()
    {
     if(isset($_POST["otp"]))
     {
      $userotp=$_POST["otp"];
      $otp=OtpHelper::verifyOtp($userotp);
      if($otp==1)
      {
        $model=new ResetPasswordForm();
        $this->render('resetPassword',array('model'=>$model));
      }
      elseif($otp==0){
        $model=new ForgotPasswordForm();
        $this->render('forgotPasswordForm',array('model'=>$model,'message'=>"invalid otp"));
      }
      else{
        $model=new ForgotPasswordForm();
        $this->render('forgotPasswordForm',array('model'=>$model,'message'=>"OTP EXPIRED"));
      }
     }
    }
    public function actionResetpassword()
    {
       
        $user=Signupcolls::model()->findByAttributes(['email'=>Yii::app()->session["reset_password_email"]]);
       

        if ($user !== null) {
            $model = new ResetPasswordForm();

            if (isset($_POST['ResetPasswordForm'])) {
                $model->attributes = $_POST['ResetPasswordForm'];

                if ($model->validate()) {
                    $user->password = password_hash($model->newPassword, PASSWORD_DEFAULT);
                   
                    if ($user->save()) {
                        
                        $this->redirect('http://demo.darwinboxlocal.com/index.php/myproject/signinform');
                    } else {
                        Yii::app()->user->setFlash('error', 'Failed to reset your password. Please try again.');
                    }
                }

            }

            $this->render('resetPassword', ['model' => $model,'message'=>"Failed to reset your password. Please try again"]);
} else {
         $model=new Signinform();
           
          $this->render("signin",array('message'=>"Invalid or expired password reset token.","model"=>$model));
        }
    }
   


}
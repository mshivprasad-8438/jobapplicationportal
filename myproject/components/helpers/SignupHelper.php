<?php
class SignupHelper extends CComponent {

    pubLic static function Signup($attributes){

    $model=new Signupform();
    $model->attributes=$attributes;

    if ($model->validate()) {
        $model2=new Signupcolls();
        // echo($model->uniqueEmail("email"));
    if($model->uniqueEmail("email")){
        $model2->name=$model->name;
        $model2->email=$model->email;
        $model2->password=password_hash($model->password, PASSWORD_DEFAULT);
        if($model2->save()){
         return true;
        }
      }
        else {
        //  $model=new Signinform();
        //   $this->render('signin', array('model' => $model,'message'=>"you already have an account"));
        return false;
        //   return;
        }
          
      } 
    }

}
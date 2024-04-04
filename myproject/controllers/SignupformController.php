<?php
class SignupformController extends Controller
{
  public $layout='emptylayout';
    public function actionIndex()
    { 
        $model = new Signupform(); // Create a new instance of Signupform model
        $this->render('signupform', array('model' => $model)); // Pass the model to the view
    }
    public function actionSignup()
     {
        if (isset($_POST["Signupform"])) {
            $attributes= $_POST["Signupform"];
            $b=SignupHelper::Signup($attributes);
              if($b){
               $this->redirect('/myproject/signinform');
              }
              else {
               $model=new Signinform();
               $this->render('signin', array('model' => $model,'message'=>"you already have an account"));
                return;
              }
                
            } 
            else {
              $model = new Signupform();
              $this->render('signupform', array('model' => $model));
            }
        }
    }


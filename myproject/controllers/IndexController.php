<?php
class IndexController extends Controller{
    public $layout="emptylayout";
    public function actionIndex()

    {

        // $session=new CHttpSession;
        // $session->open();
        if(!Yii::app()->user->isGuest)
        {
            if(Yii::app()->user->getState("roles") == "user")
            {
               $y=Yii::app()->user->getState("username");
                $this->redirect("/myproject/about");
            }
            else if(Yii::app()->user->getState("roles") == "employee"){
                $this->redirect("/myproject/employerabout");

            }
        
        }
        return $this->render("index");
    }
}
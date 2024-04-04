<?php
class LogoutController extends CController{
    public function actionIndex()
    {
        $y=Yii::app()->user->getstate("username");

        Yii::app()->user->logout();
        $x=Yii::app()->user->getstate("username");
        $this->redirect("/myproject/index");
      
    }
}
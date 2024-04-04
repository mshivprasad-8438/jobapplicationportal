<?php
require_once ('protected/modules/project/components/helpers/S3Helper.php');
class EmployeeHelper
{
    public static function Signup()
    {
        if (isset($_POST['Employee'])) {//['AddForm']
            // $data=new Products;
            $modell = new Employee();
            // var_dump(($_FILES));exit;
            $path = $_FILES['Employee']['tmp_name']['profile'];
            $s3Object = new S3Helper();
            $link = $s3Object->upload($path);
            $modell->attributes = $_POST['Employee'];//['AddForm'];
            $modell->profile = $link;


            $response = $modell->save();

            unset($_POST['Employee']);
        }
        return $response;
    }


    public static function signin()
    {
        $model = new EmployeeSignin();
        $model->attributes = $_POST["EmployeeSignin"];
        if ($model->validate()) {
            if ($model->login()) {
                $encodedEmail = base64_encode($_POST["EmployeeSignin"]['email']);
                // Yii::app()->session['token'] = $encodedEmail;
                $companyName = Employee::model()
                    ->startAggregation()
                    ->match(["email" => $_POST["EmployeeSignin"]['email']])
                    ->project(["companyName"=>1,"_id"=>0])
                    ->aggregate();
                    
                    Yii::app()->session['empInfo'] = array(
                        'companyName' => $companyName['result'][0]['companyName'],
                        'token' => $encodedEmail
                    );
                Yii::app()->request->redirect("/project/employee/home");

            } else {

                Yii::app()->request->redirect("/project/employee/Signup");
            }
            unset($_POST['EmployeeSignin']);

        }
        return;
    }
}
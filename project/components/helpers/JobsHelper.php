<?php

class JobsHelper
{
    public static function addjob()
    {
        $model = new Jobs();
        $path = $_FILES['Jobs']['tmp_name']['logo'];
        $s3Object = new S3Helper();
        $link = $s3Object->upload($path);
        $model->attributes = $_POST['Jobs'];//['AddForm'];
        $model->details->attributes = $_POST['JobDetails'];
        $model->logo = $link;
        $model->companyName=Yii::app()->session['empInfo']["companyName"];
        $tokenvalue= (Yii::app()->session['empInfo']['token']);
        $model->email=base64_decode($tokenvalue);
        $response = $model->save();
        unset($_POST['Jobs']);

        return $response;
    }

    public static function deletejob()
    {
        
            echo $_POST['id'];
            $id = new MongoDB\BSON\ObjectID((string) $_POST["id"]);
            $data = Jobs::model()->findByAttributes(array('_id' => $id));
            if ($data === null) {
                echo "Data is not available";
                return;
            }
            $data->isAvailable = false;
            $data->update(['isAvailable'], true /* <- second parameter indicates to use partial update mechanism */);
            // Delete the model
            // $data->delete();
            // Redirect to the index page or any other page
            unset($_POST["id"]);
            return;
    }
}
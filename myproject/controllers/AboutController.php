<?php
require_once "/data/live/protected/modules/myproject/components/helpers/S3Helper.php";
use \MongoDB\BSON\ObjectId;
class AboutController extends CController{
    public $layout="aboutpagelayout";
    public function actionIndex()
    {
        if(Yii::app()->user->isGuest)
        {
            // exit(var_dump(Yii::app()->user->isGuest));
            $this->redirect("/myproject/signinform");
        }
    $username=Yii::app()->user->getState("username");
    //  $session = new CHttpSession;
    //  $session->open();
  // $username=$session["username"];
     return $this->render("about",array("username" =>$username ));
    }
   
    
    public function actionJobs($category)
    {
        if(Yii::app()->user->isGuest)
        {
            $this->redirect("/myproject/signinform");
        }
        
        if (isset($category)) {

        $result=AboutHelper::Jobs($category);
        $pages = $result['pages'];
        $arr = $result['jobs'];
            $this->render("jobs", array(
                "jobdata" => $arr,
                "category" => $category,
                "pages" => $pages,
            ));
        }
    }
    public function actionUsertracking()
    {
        
        if(Yii::app()->request->isAjaxRequest){
    {
        $jobid=Yii::app()->request->getPost('jobId');
        // $session = Yii::app()->session;
        // $session->open();username
        // $s=$session->get("email");
        $useremail=Yii::app()->user->getState("email");
        $status=AboutHelper::addUserTrack($jobid,$useremail);
        if($status){
            echo "Success";
            

        }
        else{
           
            echo "Failed";
        }
    }
}
    }


    
     public function actionApplicationform($jobid)
     {

        $model=new ApplicationCollection();
        $this->render("applicationform",array("jobid"=>$jobid,"model"=>$model));
     }
    public function actionApplicationformsubmit()
{
    if (isset($_POST["ApplicationCollection"])) {
        $model = new ApplicationCollection();
        $model->attributes = $_POST['ApplicationCollection'];
        $tempFilePath = $_FILES['ApplicationCollection']['tmp_name']['resume'];
        $jobid = isset($_POST['job_id']) ? trim($_POST['job_id']) : null;
        $model->jobid=$jobid;
        $model->resume=$tempFilePath;
        if (!$model->validate()) {
            $this->render("applicationform",
             array(
                "jobid" => $jobid,
                "model" => $model,

            )
        );
            return;
        }
        

        // Check if the user has already applied for this job
        $existingRecord = ApplicationCollection::model()->findByAttributes(array('email' => $model->email, 'jobid' => $model->jobid));
        if ($existingRecord) {
            $this->render("successpage",array("status"=>"applied"));
            return;
        }
         else {
        if (is_uploaded_file($tempFilePath)) {
            $path=$_FILES['ApplicationCollection']['tmp_name']['resume'];
            $s3Object = new S3Helper();
            $url = $s3Object->upload($path);

                // $s3Helper = new S3helper();
                // $url = $s3Helper->putObject($_FILES['ApplicationCollection']['name']['resume'], $tempFilePath);
            $model->resume = $url;
            } else {
                $this->render("successpage",array("status"=>"error"));
                return;
            }
            $model->status = "pending";
            $model->save();
            $id =new \MongoDB\BSON\ObjectId($jobid);
            $job = Jobs::model()->findByAttributes(array('_id' => $id));
            if ($job) {
                $job->openings--; 
                $job->save(); 
    
            } 
            else {
                $this->render("successpage",array("status"=>"error"));
                return;
            }

            // Render success view
            $this->render("successpage",array("status"=>"success"));
            return;
        }
    }
}
public function actionViewapplications()
{
    $email = Yii::app()->user->getState("email");

    
    $criteria = new EMongoCriteria;

   
    $criteria->addCond('email', '==', $email);

   
    $criteria->sort('appliedDate', EMongoCriteria::SORT_DESC);
    $applications = ApplicationCollection::model()->findAll($criteria);

    $this->render('yourapplications', array("applications" => $applications));
}

public function actionApplicationDetails()
{

    if(Yii::app()->request->isAjaxRequest){
        {
            $jobId=Yii::app()->request->getPost('JobId');
            $application=AboutHelper::applicationDetails($jobId);

            if($application){

                 echo json_encode($application);
             }                       
            else{
               echo "Failed";
            }

        }

}

}

// public function actionAtlasSearch()
// {

   
//     if(Yii::app()->request->isAjaxRequest) {
//         $query = Yii::app()->request->getPost("Query");

//         $startStage = [
//             '$search' => [
//                 'index' => 'applicationindex',
//                 'autocomplete' => [
//                     'query' => $query,
//                     'path' => ['category', 'jobTitle', 'companyName'],
//                     'fuzzy' => [
//                         'maxEdits' => 2
//                     ]
//                 ]
//             ]
//         ];

//         $sortStage = [
//             '$sort' => [
//                 'appliedDate' => -1
//             ]
//         ];

//         $result =ApplicationCollection::model()
//             ->startAggregation()
//             ->addStage($startStage)
//             ->addStage($sortStage)
//             ->aggregate();

//         if ($result !== null) {
//             echo json_encode($result);
//         } else {
//             echo json_encode(['error' => 'No results found']);
//         }
//     }

public function actionFetchJobs()
{
    if(Yii::app()->request->isAjaxRequest){
        {
            $category=Yii::app()->request->getPost('category');
            $jobs=AboutHelper::fetchJobs($category);

            if($jobs)
            {
               echo json_encode($jobs);
            }
            else
            {
                echo "Failed";
            }
 }
}
}
public function actionFilterJobs()
{
    if(Yii::app()->request->isAjaxRequest){
        {
            $category=Yii::app()->request->getPost('category');
            $company=Yii::app()->request->getPost('company');
            $jobTitle=Yii::app()->request->getPost('job');
            $selectedJobs=AboutHelper::fetchJobs($category,$jobTitle,$company);
            if($selectedJobs)
            {
                echo json_encode($selectedJobs);
            }
            else
            {
                echo "error";
            }
        }
}


}
}










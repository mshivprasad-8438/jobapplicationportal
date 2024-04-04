<?php
class AboutHelper extends CComponent {
    public static function addUserTrack($jobid, $useremail) {
        $model = new UserTracking();
        $model->email = $useremail;
        $existingModel = UserTracking::model()->findByAttributes(['email' => $useremail]);

        if ($existingModel !== null) {
           
            if (!in_array($jobid, $existingModel->jobid)) {
                
                $existingModel->jobid[] = $jobid; }
        if ($existingModel->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            $model->jobid[] = $jobid;
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }
    }
    public static function jobs($category)
    {
        $today = new MongoDate(strtotime(date('Y-m-d')));
            $criteria=new EMongoCriteria();
            
            $criteria->openings("greater",0);
            $criteria->category("==",$category);
            $criteria->lastDate(">=",$today);
           $totalCount = Jobs::model()->count($criteria);
           $pages = new CPagination($totalCount);
            $pages->pageSize = 6;
    
            // Adjust the offset based on the current page
            $criteria->limit($pages->pageSize);
            $criteria->offset( $pages->currentPage * $pages->pageSize);
            
    
            $docs = Jobs::model()->findAll($criteria);
            $arr=[];
            foreach($docs as $doc){
                $arr[]=$doc->getAttributes();
            }
            return ['pages' => $pages, 'jobs' => $arr];
            
    }
    public static function applicationDetails($jobId)
    {
     $application=Jobs::model()->findByAttributes(array("_id"=> new \MongoDB\BSON\ObjectId($jobId)));
     return $application->getAttributes();
    }

    public static function fetchJobs($category = null, $jobTitle = null, $companyName = null)
{
    $today = new MongoDate();
    if (!empty($category) && !empty($jobTitle) && !empty($companyName)) {
        $jobs = Jobs::model()->findAllByAttributes(array(
            "category" => $category,
            "jobTitle" => $jobTitle,
            "companyName" => $companyName,
            "lastDate" => ['$gte' => $today],
            "isAvailable" => true
        ));
    } elseif (!empty($category) && !empty($jobTitle) && empty($companyName)) {
        $jobs = Jobs::model()->findAllByAttributes(array(
            "category" => $category,
            "jobTitle" => $jobTitle,
            "lastDate" => ['$gte' => $today],
            "isAvailable" => true
        ));
    } elseif (!empty($category) && empty($jobTitle) && !empty($companyName)) {
        $jobs = Jobs::model()->findAllByAttributes(array(
            "category" => $category,
            "companyName" => $companyName,
            "lastDate" => ['$gte' => $today],
            "isAvailable" => true
        ));
    } elseif (empty($category) && !empty($jobTitle) && !empty($companyName)) {
        $jobs = Jobs::model()->findAllByAttributes(array(
            "jobTitle" => $jobTitle,
            "companyName" => $companyName,
            "lastDate" => ['$gte' => $today],
            "isAvailable" => true
        ));
    } elseif (!empty($category)) {
        $jobs = Jobs::model()->findAllByAttributes(array(
            "category" => $category,
            "lastDate" => ['$gte' => $today],
            "isAvailable" => true
        ));
    } elseif (!empty($jobTitle)) {
        $jobs = Jobs::model()->findAllByAttributes(array(
            "jobTitle" => $jobTitle,
            "lastDate" => ['$gte' => $today],
            "isAvailable" => true
        ));
    } elseif (!empty($companyName)) {
        $jobs = Jobs::model()->findAllByAttributes(array(
            "companyName" => $companyName,
            "lastDate" => ['$gte' => $today],
            "isAvailable" => true
        ));
    } else {
        return null;
    }
    $arr = [];
    foreach ($jobs as $job) {
        $arr[] = $job->getAttributes();
    }
    return $arr;
}

    
}

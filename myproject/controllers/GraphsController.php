<?php
class GraphsController extends CController{
    public $layout="graphlayout";
    public function actionShowCompanywiseDistribution()
    {
        $this->render("graph1");
    }

    public function actionGraphOne($category, $timerange)
{
    $response=GraphHelper::GraphOne($category,$timerange);
    
   echo  json_encode($response);
    
}
public function actionApplicationTrends()
{
  $this->render("graph2");
    
}



public function actionGraphTwo($category, $timeRange)
{
   $response=GraphHelper::GraphTwo($category,$timeRange);
   echo json_encode($response);
}
public function actionMoreTrendingCategory()
    {
        
$startStage = ['$unwind' => '$jobid'];

$lookupStage = ['$lookup' => [
    'from' => 'jobs',
    'localField' => 'jobid',
    'foreignField' => '_id',
    'as' => 'job'
]];

$groupStage = ['$group' => [
    '_id' => '$job.category',
    'count' => ['$sum' => 1]
]];

$result = UserTracking::model()->startAggregation()
    ->addStage($startStage)
    ->addStage($lookupStage)
    // ->addStage($groupStage)
    ->aggregate();

$softwareCount=0;
$coreCount = 0;

var_dump($result);
exit();
foreach ($result as $doc) {
    if ($doc['_id'] === 'software') {
        $softwareCount = $doc['count'];
    } elseif ($doc['_id'] === 'core') {
        $coreCount = $doc['count'];
    }
}

// Pass counts to the view
$data = [
    'softwareCount' => $softwareCount,
    'coreCount' => $coreCount,
];

// Render the view with the data
$this->render('graph3', $data);



        
}




}
<?php
require_once ('protected/modules/project/components/helpers/JobsHelper.php');
require_once ('protected/modules/project/components/helpers/S3Helper.php');
class JobsController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public $layout = 'main';
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    // public function beforeAction($action){
    //     var_dump($action);
    //     return true;
    // }
    // public function afterAction($action){
    //     var_dump($action);
    //     return true;
    // }


    public function actionIndex()
    {

        $this->render(
            'home',
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionApplication()
    {
        if (!empty($_POST) && isset($_POST["id"])) {
            echo $_POST['id'];
            $job_id = new MongoDB\BSON\ObjectID((string) $_POST["id"]);
            $data = Jobs::model()->findByAttributes(array('_id' => $job_id));
            if ($data === null) {
                echo "Data is not available";
                exit;
            }

            // Delete the model
            $data->delete();
            // Redirect to the index page or any other page

        } else {
            echo "No id passed";
        }
        $this->redirect('/index.php/item');

    }

    public function actionDisplay()
    {
        $model = new Jobs;
        $criteria = new EMongoCriteria;
        $criteria->openings('>', 0);


        if (!empty($_POST['selectCategory']) && $_POST['selectCategory'] != "None") {
            // $this->layout = "Layyingout";
            $model = new Jobs;
            $criteria = new EMongoCriteria;
            $criteria->category('==', $_POST['selectCategory'])->limit(5);

            // $model = new Item();
            // $model = $model->findAllByAttributes(array('title' => $_POST['search']));
            // $model = $model->findAll($criteria);
            // $forming = new AddForm();


        }
        $model = $model->findAll($criteria);
        echo "<pre>";
        echo CJSON::encode($model);
        exit;
        // $this->render(
        //     'home',
        //     array(
        //         'jsonArray' => $model,
        //         'model' => $forming,
        //     )
        // );
    }

    /**
     * Displays the contact page
     */

    public function actionAddJob()
    {
        $model = new Jobs();

        if (isset($_POST['Jobs'])) {//['AddForm']
            $response = JobsHelper::addjob();
            if ($response) {
                $this->redirect('/project/jobs/');
            }
        }
        $this->render(
            'addJob',
            array(
                'model' => $model,
            )
        );

    }


    // public function actionUpdate()
    // {

    //     if (isset($_POST['Jobs'])) {
    //         $response = JobsHelper::updatejob();
    //         if ($response) {
    //             $this->redirect('/project/jobs/');
    //         }
    //     }
    //     $this->render(
    //         'addJob',
    //         array(
    //             'model' => Jobs::model(),
    //         )
    //     );
    // }

    public function actionDelete()
    {
        $_POST["id"] = "660d5e2f28d84f12a7091f62";
        $this->layout = false;
        if (!empty($_POST) && isset($_POST["id"])) {
            JobsHelper::deletejob();
        } else {
            echo "No id passed";
        }
        $this->redirect('/project/employee/home');
        // $this->redirect('/project/employee/posts');

    }

}
<?php
require_once ('/data/live/protected/modules/myproject/components/helpers/EmployeeHelper.php');
use MongoDB\BSON\ObjectId;

class EmployeeController extends Controller
{
    /**
     * Declares class-based actions.
     */
    // public $layout = 'main';
    public $layout = 'hello';

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


    public function actionIndex()
    {
        // $this->render('signupform',array('model'=>Employee::model()));
        $this->render(
            'index',
        );
    }

    public function actionHome()
    {
        $this->render(
            'home',
            array(
            )

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

    // public function actionDisplay()
    // {
    //     $model = new Jobs;
    //     $criteria = new EMongoCriteria;
    //     $criteria->openings('>', 0);


    //     if (!empty ($_POST['selectCategory']) && $_POST['selectCategory'] !="None") {
    //         // $this->layout = "Layyingout";
    //         $model = new Jobs;
    //         $criteria = new EMongoCriteria;
    //         $criteria->category('==',$_POST['selectCategory'])->limit(5);

    //         // $model = new Item();
    //         // $model = $model->findAllByAttributes(array('title' => $_POST['search']));
    //         // $model = $model->findAll($criteria);
    //         // $forming = new AddForm();


    //     } 
    //     $model = $model->findAll($criteria);
    //     echo "<pre>";
    //     echo CJSON::encode($model);
    //     exit;
    //     // $this->render(
    //     //     'home',
    //     //     array(
    //     //         'jsonArray' => $model,
    //     //         'model' => $forming,
    //     //     )
    //     // );
    // }
    public function actionSignin()
    {

        $model = new EmployeeSignin();
        if (isset($_POST['EmployeeSignin'])) {
            EmployeeHelper::signin();
        }
        $this->render(
            'signin',
            array(
                'model' => $model,
            )
        );
    }
    public function actionMyapplicants()
    {
        $this->layout = false;

        $email = "nani@gmail.com"; 
        $criteria = new EMongoCriteria;
        $criteria->addCond('email', '==', $email);

        $distinctValues = Jobs::model()->findAll($criteria);
        
        $jobIds = array_map(function ($id) {
            echo ((string) $id['_id']);
            return ((string) $id["_id"]);
        }, $distinctValues);//exit;
        var_dump($jobIds);//exit;

        // Match ApplicationCollection documents where jobid is in the list of jobIds
        $criteria = new EMongoCriteria;
        $criteria = [
            'jobid' => ['$in' => $jobIds]
        ];
        $applications = ApplicationCollection::model()->findAllByAttributes($criteria);
        echo CJSON::encode($applications);
        exit;
        // var_dump( $applications);
        echo sizeof($applications) . 'length\n';
        // $data = Application::model()
        //     ->startAggregation()
        //     ->sort(["cost" => -1])
        //     ->limit(2)
        //     ->aggregate();

        // $lookup: {
        //     from: "jobs",
        //     localField: "job_id",
        //     foreignField: "_id",
        //     as: "job"
        //   }
    }

    public function actionClient()
    {

        $criteria = new EMongoCriteria;

        // Pagination
        $count = Jobs::model()->count($criteria);
        $pagination = new CPagination($count);
        $pagination->pageSize = 2; // Number of items per page
        // $pagination->applyLimit($criteria);
        $criteria->limit($pagination->pageSize);
        $criteria->offset($pagination->currentPage * $pagination->pageSize);
        $jobs = Jobs::model()->findAll($criteria);
        // var_dump( $pagination);//$criteria);
        // exit;

        $this->render(
            'applicants',
            array(
                'jobs' => $jobs,
                'pagination' => $pagination,
            )
        );

    }

    public function actionPosts()
    {
        $model = new Jobs;
        $criteria = new EMongoCriteria;
        $criteria->email('==', "nani@gmail.com");
        if (!empty($_POST['selectCategory']) && $_POST['selectCategory'] != "None") {
            $model = new Jobs;
            $criteria = new EMongoCriteria;
            $criteria->category('==', $_POST['selectCategory'])->limit(5);
        }
        $model = $model->findAll($criteria);
        // echo "<pre>";
        // echo CJSON::encode($model);
        // // echo 
        // exit;
        $this->render(
            'home',
            array(
                'jobs' => $model,
                'model' => Jobs::model(),
            )
        );
    }

    /**
     * Displays the contact page
     */

    public function actionSignup()
    {
        $forming = new Employee;
        // echo CJSON::encode($_POST['Employee']);
        if (EmployeeHelper::signup()) {
            $this->redirect(
                '/project/employee',
            );
        }
        $this->render(
            'signup',
            array(
                'model' => $forming,
            )
        );
    }

    public function actionLogout()
    {
        Yii::app()->session->destroy();
        $this->render(
            'index',
        );
    }
}
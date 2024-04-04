<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Signup</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(-60deg, #ff5858 0%, #f09819 100%);
        }

        .container {
            background: #fff;
            max-width: 800px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-container {
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        #messageContainer {
            color: #dc3545;
            margin-bottom: 10px;
        }

        /* Ensure the image fills the entire column */
        .img-fluid {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
    </style>
</head>


<body>


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Image -->
                <img src="/images/signupact.jpeg" alt="Signup Image" class="img-fluid">
            </div>
            <div class="col-md-6 form-container">
                <div class="form-container">
                    <h2>Signup Form</h2>
                    <span style="text-align: left;">
                        <?php $form = $this->beginWidget(
                            'CActiveForm',
                            array(
                                'id' => 'employee-form',
                                'action' => Yii::app()->createUrl('/project/employee/Signup'),
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                ),
                                'htmlOptions' => array(
                                    'enctype' => 'multipart/form-data',
                                )
                            )

                        ); ?>

                        <p class="note">Fields with <span class="required">*</span> are required.</p>

                        <?php //echo $form->errorSummary($model);  ?>

                        <div class="form-group">
                            <!-- <div class="row"> -->
                            <?php echo $form->labelEx($model, 'name', array('class' => 'form-label')); ?>
                            <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control')); ?>

                        </div>

                        <div class="form-group">
                            <!-- <div class="row"> -->
                            <?php echo $form->labelEx($model, 'companyName', array('class' => 'form-label')); ?>
                            <?php echo $form->textField($model, 'companyName', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control')); ?>
                            <?php //echo $form->error($model,'email');  ?>
                        </div>

                        <div class="form-group">
                            <!-- <div class="row"> -->
                            <?php echo $form->labelEx($model, 'email', array('class' => 'form-label')); ?>
                            <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control')); ?>
                            <?php //echo $form->error($model,'email');  ?>
                        </div>

                        <div class="form-group">
                            <!-- <div class="row"> -->
                            <?php echo $form->labelEx($model, 'password', array('class' => 'form-label')); ?>
                            <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control')); ?>
                            <?php //echo $form->error($model,'password');  ?>
                        </div>


                        <div class="form-group">
                            <!-- <div class="row"> -->
                            <?php echo $form->labelEx($model, 'industry', array('class' => 'form-label')); ?>
                            <?php
                            // Assuming $options is an array containing your dropdown options
                            $options = array(
                                'software' => 'Software',
                                'core' => 'Core',

                            );
                            echo $form->dropDownList($model, 'industry', $options, array('class' => 'form-control', 'prompt' => 'Select industry'));
                            ?>

                            <div class="form-group">
                                <!-- <div class="row"> -->
                                <?php echo $form->labelEx($model, 'employeeId', array('class' => 'form-label')); ?>
                                <?php echo $form->textField($model, 'employeeId', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control')); ?>
                                <?php //echo $form->error($model,'email');  ?>
                            </div>
                            <div class="form-group">
                                <!-- <div class="row"> -->
                                <?php echo $form->labelEx($model, 'profile', array('class' => 'form-label')); ?>
                                <?php echo $form->fileField($model, 'profile', array('class' => 'input-file', 'accept' => 'image/*')); ?>
                                <?php echo $form->error($model, 'profile'); ?>
                            </div>

                            <div class="row buttons">
                                <?php echo CHtml::submitButton('Add', array('id' => 'add-submit')); ?>
                            </div>

                            <?php $this->endWidget(); ?>
                            <p>Already have an account? <a href="/myproject/signinform">Sign In</a></p>

                            <?php if (isset($message)): ?>
                                <p class="custom-message">
                                    <?= $message ?>
                                </p>
                            <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    <div class="form">

    </div>





    </div><!-- form -->

</body>

</html>
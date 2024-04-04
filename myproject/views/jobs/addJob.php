<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Display</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>


<body>
    <div class="form">
        <?php $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'employee-form',
                'action' => Yii::app()->createUrl('/project/jobs/AddJob'),
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                )
            ));
            

         ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php //echo $form->errorSummary($model);  ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'jobTitle'); ?>
            <?php echo $form->textField($model, 'jobTitle', array('size' => 60, 'maxlength' => 128)); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'totalApplications'); ?>
            <?php echo $form->numberField($model, 'totalApplications', array('size' => 60, 'maxlength' => 128)); ?>
            <?php //echo $form->error($model,'email');  ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'openings'); ?>
            <?php echo $form->numberField($model, 'openings', array('size' => 60, 'maxlength' => 128)); ?>
            <?php //echo $form->error($model,'email');  ?>
        </div>

        <div class="row">
    <?php echo $form->labelEx($model, 'category'); ?>
    <?php echo $form->dropDownList($model, 'category', array(
        'software' => 'Software',
        'core' => 'Core',
    ), array('prompt' => 'Select Category')); ?>
</div>

        <!-- <div class="row">
            <?php //echo $form->labelEx($model,'lastDate');  ?>
            <?php //echo $form->textField($model,'lastDate',array('size'=>60,'maxlength'=>128));  ?>
            <?php //echo $form->error($model,'email');  ?>
        </div> -->

        <div class="row">
            <?php echo $form->labelEx($model, 'lastDate'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'lastDate',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', // Set the date format here
                    // You can add more options as needed
                ),
                'htmlOptions' => array(
                    'size' => 60,
                    'maxlength' => 128,
                ),
            )
            ); ?>
            <?php //echo $form->error($model,'lastDate');  ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'logo'); ?>
            <?php echo $form->fileField($model, 'logo',array('class'=>'input-file','accept' => 'image/*')); ?>
            <?php echo $form->error($model, 'logo'); ?>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($model['details'], 'salary'); ?>
            <?php echo $form->numberField($model['details'], 'salary', array('size' => 60, 'maxlength' => 128)); ?>
            <?php //echo $form->error($model,'email');  ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model['details'], 'location'); ?>
            <?php echo $form->textField($model['details'], 'location', array('size' => 60, 'maxlength' => 128)); ?>
            <?php //echo $form->error($model,'email');  ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model['details'], 'description'); ?>
            <?php echo $form->textArea($model['details'], 'description', array('size' => 60, 'maxlength' => 128)); ?>
            <?php //echo $form->error($model,'email');  ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Add', array('id' => 'add-submit')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->




</body>

</html>
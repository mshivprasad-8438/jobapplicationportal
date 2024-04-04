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
                'action' => Yii::app()->createUrl('/project/employee/Signin'),
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            )
            
        ); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php //echo $form->errorSummary($model); ?>

        
        <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
            <?php //echo $form->error($model,'email'); ?>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
            <?php //echo $form->error($model,'password'); ?>
        </div>

        <div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Add', array('id' => 'add-submit')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->

    
    

</body>
</html>

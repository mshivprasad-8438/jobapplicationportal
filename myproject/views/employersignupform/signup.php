<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'signup-form',
    'action' => Yii::app()->createUrl('/myproject/employersignupform/signup'),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('enctype' => 'multipart/form-data'), // Add enctype for file uploads
));
?>


<div class="row">
    <h2>Personal Information</h2>
</div>

<div class="row">
    <?php echo $form->labelEx($model->personalInfo, 'name', array('class' => 'control-label')); ?>
    <?php echo $form->textField($model->personalInfo, 'name', array('class' => 'form-control')); ?>
    <?php echo $form->error($model->personalInfo, 'name', array('class' => 'error-message')); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->personalInfo, 'email', array('class' => 'control-label')); ?>
    <?php echo $form->textField($model->personalInfo, 'email', array('class' => 'form-control')); ?>
    <?php echo $form->error($model->personalInfo, 'email', array('class' => 'error-message')); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->personalInfo, 'password', array('class' => 'control-label')); ?>
    <?php echo $form->passwordField($model->personalInfo, 'password', array('class' => 'form-control')); ?>
    <?php echo $form->error($model->personalInfo, 'password', array('class' => 'error-message')); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->personalInfo, 'photo', array('class' => 'control-label')); ?>
    <?php echo $form->fileField($model->personalInfo, 'photo', array('class' => 'form-control')); ?>
    <?php echo $form->error($model->personalInfo, 'photo', array('class' => 'error-message')); ?>
</div>


<div class="row">
    <h2>Company Information</h2>
</div>

<div class="row">
    <?php echo $form->labelEx($model->companyInfo, 'companyName', array('class' => 'control-label')); ?>
    <?php echo $form->textField($model->companyInfo, 'companyName', array('class' => 'form-control')); ?>
    <?php echo $form->error($model->companyInfo, 'companyName', array('class' => 'error-message')); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->companyInfo, 'industry', array('class' => 'control-label')); ?>
    <?php echo $form->textField($model->companyInfo, 'industry', array('class' => 'form-control')); ?>
    <?php echo $form->error($model->companyInfo, 'industry', array('class' => 'error-message')); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->companyInfo, 'employerIdNumber', array('class' => 'control-label')); ?>
    <?php echo $form->textField($model->companyInfo, 'employerIdNumber', array('class' => 'form-control')); ?>
    <?php echo $form->error($model->companyInfo, 'employerIdNumber', array('class' => 'error-message')); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Signup', array('class' => 'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>
<?php if(isset($message)): ?>
 <p class="custom-message"><?= $message ?></p>
<?php endif; ?>

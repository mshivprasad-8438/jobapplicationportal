<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'signin-form',
    'enableClientValidation' => true,
    'action' => Yii::app()->createUrl('/myproject/employersigninform/employerabout'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
));
?>

<div class="row">
    <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'email', array('class' => 'error-message')); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'password', array('class' => 'error-message')); ?>
</div>

<div class="row">
    <?php echo $form->checkBox($model, 'rememberMe'); ?>
    <?php echo $form->label($model, 'rememberMe'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>
<?php if(isset($message)): ?>
 <p class="custom-message"><?= $message ?></p>
<?php endif; ?>



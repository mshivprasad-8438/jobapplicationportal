<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #FF8300;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        header {
    background-color: #ff8300;
    padding: 10px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav {
    display: flex;
    justify-content: flex-start;
    
    padding: 10px;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 10px 20px;
}

nav a:hover {
    background-color: #555;
}
.container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            width: 600px; /* Adjust the width as needed */
        }
</style>
</head>
<body style="background-image: linear-gradient(-90deg, #ff5858 0%, #f09819 100%);">
    

   
        <!-- Job Posting Form -->
        <div class="container mt-5 p-10">
            <h1 class="mb-4">Job Posting Form</h1>
        
            <!-- Job Posting Form -->
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'job-post-form',
                'enableClientValidation' => true,
                'action' => Yii::app()->createUrl('/myproject/employerabout/postjob'),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            )); ?>
        
            <!-- Job Details -->
            <div class="mb-3">
                <?php echo $form->labelEx($model, 'category', array('class' => 'form-label')); ?>
                <?php echo $form->dropDownList($model, 'category', array(
                    '' => 'Select Category',
                    'softwarejob' => 'Software',
                    'corejob' => 'Core',
                ), array('class' => 'form-control', 'required' => true)); ?>
                <?php echo $form->error($model, 'category', array('class' => 'error-message')); ?>
            </div>
        
            <div class="mb-3">
                <?php echo $form->labelEx($model, 'email', array('class' => 'form-label')); ?>
                <?php echo $form->emailField($model, 'email', array('class' => 'form-control', 'required' => true)); ?>
                <?php echo $form->error($model, 'email', array('class' => 'error-message')); ?>
            </div>
        
            <div class="mb-3">
                <?php echo $form->labelEx($model, 'jobname', array('class' => 'form-label')); ?>
                <?php echo $form->textField($model, 'jobname', array('class' => 'form-control', 'required' => true)); ?>
                <?php echo $form->error($model, 'jobname', array('class' => 'error-message')); ?>
            </div>
        
            <div class="mb-3">
                <?php echo $form->labelEx($model, 'companyname', array('class' => 'form-label')); ?>
                <?php echo $form->textField($model, 'companyname', array('class' => 'form-control', 'required' => true)); ?>
                <?php echo $form->error($model, 'companyname', array('class' => 'error-message')); ?>
            </div>
        
            <div class="mb-3">
                <?php echo $form->labelEx($model, 'openings', array('class' => 'form-label')); ?>
                <?php echo $form->numberField($model, 'openings', array('class' => 'form-control', 'required' => true)); ?>
                <?php echo $form->error($model, 'openings', array('class' => 'error-message')); ?>
            </div>
        
            <div class="mb-3">
                <?php echo $form->labelEx($model, 'lastdate', array('class' => 'form-label')); ?>
                <?php echo $form->dateField($model, 'lastdate', array('class' => 'form-control', 'required' => true)); ?>
                <?php echo $form->error($model, 'lastdate', array('class' => 'error-message')); ?>
            </div>
        
            <div class="mb-3">
                <?php echo $form->labelEx($model, 'description', array('class' => 'form-label')); ?>
                <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'rows' => 4, 'required' => true)); ?>
                <?php echo $form->error($model, 'description', array('class' => 'error-message')); ?>
            </div>
        
            <!-- Logo Image/File Input -->
            <div class="mb-3">
                <?php echo $form->labelEx($model, 'logo', array('class' => 'form-label')); ?>
                <?php echo $form->fileField($model, 'logo', array('class' => 'form-control', 'required' => true)); ?>
                <?php echo $form->error($model, 'logo', array('class' => 'error-message')); ?>
            </div>
        
            <!-- Submit Button -->
            <div class="mb-3">
                <?php echo CHtml::submitButton('Post Job', array('class' => 'btn btn-primary')); ?>
            </div>
        
            <?php $this->endWidget(); ?>
        </div>
    </div>

    <!-- Bootstrap JS (optional, if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Your custom scripts (if any) -->
</body>
</html>

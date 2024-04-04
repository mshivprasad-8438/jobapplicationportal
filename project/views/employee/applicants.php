<?php
/* @var $this EmployeeController */
/* @var $jobs Job[] */
/* @var $pagination CPagination */

$this->breadcrumbs = array(
    'Display Jobs',
);

?>

<h1>Jobs</h1>

<?php foreach ($jobs as $job): ?>
    <div class="job">
        <h2><?php echo $job->jobTitle; ?></h2>
        <p><?php echo $job->companyName; ?></p>
    </div>
<?php endforeach; ?>

<!-- Pagination -->
<?php $this->widget('CLinkPager', array(
    'pages' => $pagination,
)); ?>

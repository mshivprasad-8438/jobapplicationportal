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

        .card {
            width: 100%;
            background-color: #f8f9fa;
            /* Light gray background color */
            border: 1px solid #dee2e6;
            /* Gray border */
        }

        .card-header {
            background-color: #fff;
            /* White background color for header */
            border-bottom: 1px solid #dee2e6;
            /* Gray border */
        }

        .card-body {
            padding: 1.25rem;
            /* Add padding to the card body */
        }
    </style>
</head>


<body>
    <div>
        <form action="<?php echo $this->createUrl('employee/Posts') ?>" style="margin-right:10px" method="post">
            <h2>JSON Data</h2>
            <select name="selectCategory">
                <option value="None">All</option>
                <option value="Software">Software</option>
                <option value="Core">Core</option>
                <!-- Add more options as needed -->
            </select>
            <input type="text" name="search">
            <button type="submit" class="btn btn-danger btn-sm">Search</button>
        </form>
        <form action=<?php echo $this->createUrl('jobs/Delete') ?> method="post"
            onsubmit="return confirm('Are you sure you want to delete this item?');">
            <input type="hidden" name="id" value="660af5feb52c6499c58851ec">
            <!-- <input type="hidden" name="id" value="<?php //echo $item["_id"];   ?>"> -->
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
        <?php echo CHtml::link('Add job', array('/project/jobs/AddJob'), array('class' => 'btn btn-primary')); ?>




        <div class="container">
            <div class="row">
                <?php foreach ($jobs as $job): ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card" >
                            <div class="card-header">
                                <h5 class="card-title">
                                    <?php echo $job['jobTitle']; ?>
                                </h5>
                            </div>
                            <div class="card-body bg-primary">
                                <p class="card-text"><strong>Company:</strong>
                                    <?php echo $job['companyName']; ?>
                                </p>
                                <p class="card-text"><strong>Total Applications:</strong>
                                    <?php echo $job['totalApplications']; ?>
                                </p>
                                <p class="card-text"><strong>Openings:</strong>
                                    <?php echo $job['openings']; ?>
                                </p>
                                <p class="card-text"><strong>Category:</strong>
                                    <?php echo $job['category']; ?>
                                </p>
                                <p class="card-text"><strong>Last Date:</strong>
                                    <?php //echo date('Y-m-d', $job['lastDate']['sec']); ?>
                                </p>
                                <img src="<?php echo $job['logo']; ?>" alt="Logo" class="img-fluid">
                                <p class="card-text"><strong>Posted Time:</strong>
                                    <?php //echo date('Y-m-d H:i:s', $job['postedTime']['sec']); ?>
                                </p>
                                <p class="card-text"><strong>Salary:</strong>
                                    <?php echo $job['details']['salary']; ?>
                                </p>
                                <p class="card-text"><strong>Location:</strong>
                                    <?php echo $job['details']['location']; ?>
                                </p>
                                <p class="card-text"><strong>Description:</strong>
                                    <?php echo $job['details']['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>




    </div>

</body>

</html>







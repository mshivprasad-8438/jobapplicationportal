<div class="container mt-4">
    <h1 class="mb-4">My Applications</h1>
    
    <!-- Search Bar -->
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search by Company Name, Job Name, or Category" id="searchInput">
        
    </div>

    <!-- Application Cards -->
    <?php foreach ($applications as $application) { ?>
        <div class="row mb-3">
            <div class="col">
                <!-- Card Styling based on Status -->
                <?php if ($application->status === 'approved') { ?>
                    <div class="card bg-success-light border border-success shadow-lg rounded-3 mx-auto" style="width: 70%; background-color:lightseagreen;">
                <?php } else if ($application->status === 'rejected') { ?>
                    <div class="card bg-danger-light border border-danger shadow-lg rounded-3 mx-auto" style="width: 70%;background-color:crimson;">
                <?php } else if ($application->status === 'pending') { ?>
                    <div class="card bg-warning-light border border-warning shadow-lg rounded-3 mx-auto" style="width: 70%;background-color:palegoldenrod;">
                <?php } else { ?>
                    <div class="card bg-primary-light border border-primary shadow-lg rounded-3 mx-auto" style="width: 70%;background-color:cornflowerblue;">
                <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $application->jobTitle; ?> at <?php echo $application->companyName; ?></h5>
                            <p class="card-text">Category: <?php echo $application->category; ?></p>
                            <p class="card-text">Status: <?php echo ucfirst($application->status); ?></p>

                            <!-- Additional Card Content -->
                            <?php if ($application->status === 'approved') { ?>
                                <p class="card-text ">Approved</p>
                            <?php } else if ($application->status === 'rejected') { ?>
                                <p class="card-text ">Rejected</p>
                            <?php } else if ($application->status === 'pending') { ?>
                                <p class="card-text ">Pending</p>
                            <?php } else { ?>
                                <p class="card-text ">Applied</p>
                            <?php } ?>
                           
                            <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#jobModal" onclick='fun1(<?php echo json_encode($application->jobid) ?>)'>More Info</a>
                        </div>
                    </div>
            </div>
        </div>
    <?php } ?>

    <!-- No Applications Message -->
    <?php if (empty($applications)) { ?>
        <p class="lead">You have no applications yet.</p>
    <?php } ?>
</div>

<!-- Modal for displaying job details -->
<div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="jobModalLabel">Job Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Job details will be displayed here -->
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Function to show job details in modal
    function fun1(jobId) {
        console.log(jobId);
        console.log("hello");
        $.ajax({
            url: "/myproject/about/applicationDetails",
            type: "POST",
            data: { JobId: jobId },
            success: function(response) {
                var job = JSON.parse(response);
                var html = `
                    <h5>${job.jobTitle} at ${job.companyName}</h5>
                    <p>Category: ${job.category}</p>
                    <p>Last Date: ${job.lastDate}</p>
                    <p>Salary: ${job.details.salary}</p>
                    <p>Location: ${job.details.location}</p>
                    <p>Description: ${job.details.description}</p>
                `;
                var modalBody = $('.modal-body');
                modalBody.html(html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function filterApplications(query) {
        $('.row.mb-3').each(function() {
            var companyName = $(this).find('.card-title').text().toLowerCase();
            var jobTitle = $(this).find('.card-text').eq(0).text().split(':')[1].trim().toLowerCase();
            var category = $(this).find('.card-text').eq(1).text().split(':')[1].trim().toLowerCase();

            if (companyName.includes(query) || jobTitle.includes(query) || category.includes(query)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Search Functionality
    $('#searchInput').on('keyup input', function() {
        var query = $(this).val().trim().toLowerCase();
        filterApplications(query);
    });
</script>

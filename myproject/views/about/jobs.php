<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available <?= $category ?> Jobs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    
    <!-- integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <style>
        .job-card {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 10px;
            transition: box-shadow 0.3s;
            padding: 20px;
            cursor: pointer;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .job-card:hover {
            box-shadow: 0 0 11px rgba(33, 33, 33, 0.2);
        }

        .job-card img {
            width: 100%;
            height: 200px; /* Adjust as needed */
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .job-card .card-body {
            padding: 10px;
        }

        .job-card button {
            width: calc(50% - 10px);
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .job-card button:hover {
            background-color: #3396ff;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div id="info" class="col-md-8">
            <h1 class="text-center mr-9">Available <?= $category ?> Jobs</h1>

                <div class="container">
                    <div  class="row row-cols-1 row-cols-md-3 g-4">
                   
                        <?php if (!empty($jobdata)): ?>
                            <?php foreach ($jobdata as $data): ?>
                                <div class="col-4">
                                    <div class="card job-card mr-5 ml-5">
                                        <h3 class="text-center">Company: <?= $data["companyName"] ?></h3>
                                        <img p-3 src=<?= $data["logo"] ?> alt=""/>
                                        <div class="card-body">
                                            <div class="text-center">category: <?= $data["category"] ?></div>
                                            <div class="text-center">Jobname: <?= $data["jobTitle"] ?></div>
                                            <div class="text-center">Openings: <?= $data["openings"]?></div>
                                            <div class="text-center">Last Date: <span class="last-date"><?= $data["lastDate"]->sec ?></span></div>

                                            <div class="d-grid gap-2">
                                                <p><?php var_dump((int)$data["_id"]);?></p>
                                                <button type="button" class="btn btn-primary" onclick='fun1(<?php echo json_encode($data); ?>)'>More Info</button>
                                                <a class="btn btn-success" href="/myproject/about/applicationform?jobid=<?= $data["_id"] ?>">Apply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php $this->widget('CLinkPager', array(
                            'pages' => $pages,
                            'prevPageLabel' => '<i class="bi bi-chevron-left"></i>',
                            'nextPageLabel' => '<i class="bi bi-chevron-right"></i>',
                            'header' => '',
                            'firstPageLabel' => 'First',
                            'lastPageLabel' => 'Last',
                            'maxButtonCount' => 5,
                            'htmlOptions' => ['class' => 'pagination']
                        )); ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4">
            <div class="container m-6 p-5">
    <h3 class="text-center m-3">Filter Options</h3>
    <div>
        <label for="companyFilter" class="form-label">Company Name:</label>
        <select class="form-select" id="companyFilter">
            <option value="">Select Company</option>
        </select>
    </div>
    <div>
        <label for="jobNameFilter" class="form-label">Job Name:</label>
        <select class="form-select" id="jobNameFilter" >
            <option value="">Select Job</option>
        </select>
    </div>
    <div class="text-center mt-3">
    <button type="button" class="btn btn-primary" onclick="applyFilters()">Search</button>
    <!-- Reset button with proper href attribute -->
    <a href="/myproject/about/jobs?category=<?= $category ?>" class="btn btn-secondary">Reset</a>
</div>


    </div>

    <div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
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
          var category = '<?= $category ?>'; 
        $(document).ready(function() {
            fetchJobs(); 
        });
        function fun1(data) {
            console.log(data);
            $.ajax({
                url: '/myproject/about/usertracking', // Replace with your actual URL
                type: 'POST', // or 'GET' depending on your server endpoint
                data: { jobId: data["_id"] }, // Send job ID to the server
                success: function(response) {
                    console.log(data);
                    // Update modal content with the fetched job details
                    var modalBody = $('.modal-body');
                    var html = `
                  
                        <p><strong>Salary:</strong> ${data["details"].salary}</p>
                        <p><strong>Location:</strong> ${data["details"].location}</p>
                        <p><strong>Description:</strong> ${data["details"].description}</p>
                    `;
                    modalBody.html(html);
                    
                    // Show the modal using jQuery
                    $('#jobModal').modal('show');
                    
                    // Add blur effect to the modal backdrop
                    $('.modal-backdrop').addClass('blur');
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error(error);
                }
            });
        }
    
        console.log(category);

        function fetchJobs() {
    console.log("hieeeeeeeeeeee");
    $.ajax({
        url: '/myproject/about/fetchJobs',
        type: 'POST',
        data: { category: category },
        success: function(response) {
            response=JSON.parse(response);
            console.log(response);
            const uniqueCompanies = [...new Set(response.map(obj => obj.companyName))];
            // Get unique job titles
            const uniqueJobTitles = [...new Set(response.map(obj => obj.jobTitle))];
            updateOptions($('#companyFilter'), uniqueCompanies);
            updateOptions($('#jobNameFilter'), uniqueJobTitles);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}


    function updateOptions(selectElement, options) {
        selectElement.empty();
        console.log("bye");
        selectElement.append('<option value="">Select Option</option>');
        $.each(options, function(index, option) {
            selectElement.append('<option value="' + option + '">' + option + '</option>');
        });
    }

    function applyFilters() {
    var selectedCompany = $('#companyFilter').val();
    var selectedJob = $('#jobNameFilter').val();

    // Send AJAX request to fetch filtered job posts
    $.ajax({
        url: '/myproject/about/filterJobs',
        type: 'POST',
        data: { category: category, company: selectedCompany, job: selectedJob },
        success: function(response) {
    $('#info').empty();
    response = JSON.parse(response);
    var row = $('<div class="row"></div>'); // Create a new row
    response.forEach(function(data, index) {
        if (index > 0 && index % 2 === 0) {
            // Append the completed row and create a new one
            $('#info').append(row);
            row = $('<div class="row"></div>');
        }
        var card = `
            <div class="col-5 m-2 p-2">
                <div class="card job-card mr-5 ml-5">
                    <h3 class="text-center">Company: ${data.companyName}</h3>
                    <img p-3 src="${data.logo}" alt=""/>
                    <div class="card-body">
                        <div class="text-center">Category: ${data.category}</div>
                        <div class="text-center">Job Name: ${data.jobTitle}</div>
                        <div class="text-center">Openings: ${data.openings}</div>
                        <div class="text-center">Last Date: <span class="last-date">${data.lastDate.sec}</span></div>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" onclick='fun1(${JSON.stringify(data)})'>More Info</button>
                            <a class="btn btn-success" href="/myproject/about/applicationform?jobid=${data._id.$oid}">Apply</a>
                        </div>
                    </div>
                </div>
            </div>`;
        row.append(card); // Append the job card to the current row
    });
    // Append the last row if it's not complete
    if (response.length % 2 !== 0) {
        $('#info').append(row);
    }
},

        error: function(xhr, status, error) {
            console.log("error");
        }
    });
}



</script>
<script>
    // Get all elements with class "last-date"
    var lastDateElements = document.querySelectorAll('.last-date');

    // Loop through each element
    lastDateElements.forEach(function(element) {
        // Get the MongoDB date value from the element's text content
        var timestamp = parseInt(element.textContent);

        // Create a new Date object using the timestamp
        var date = new Date(timestamp * 1000); // Multiply by 1000 to convert from seconds to milliseconds

        // Format the date as desired (e.g., YYYY-MM-DD)
        var formattedDate = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();

        // Update the element's text content with the formatted date
        element.textContent = formattedDate;
    });
</script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Job Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
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
            background-color: #e25f00;
        }

        a:hover {
            background-color: #e25f00;
        }

        .search-bar {
            margin: 0 auto;
            text-align: center;
            margin-bottom: 20px;
        }

        .job-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 0 auto;
        }

        .job-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%; /* Set width to 100% for full-width cards */
            position: relative; /* Position relative for absolute positioning of remove button */
        }

        .job-card img {
            max-width: 100px; /* Set the maximum width for the image */
            height: auto;
            border-radius: 8px;
            margin-right: 10px; /* Add some spacing between image and text */
        }

        .btn-remove-post {
            position: absolute;
            top: 5px;
            right: 5px;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#companySearch").on("input", function () {
                // Get the entered company name
                var companyName = $(this).val().toLowerCase();
                $(".job-card").each(function () {
                    var cardCompany = $(this).find('p:contains("Company:")').text().toLowerCase().replace("company:", "").trim();
                    if (cardCompany.includes(companyName) || companyName === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</head>

<body>
   

    <!-- Search Bar -->
    <div class="container search-bar mt-5">
        <input type="text" id="companySearch" class="form-control" placeholder="Search by Company Name...">
    </div>

    <!-- Job Container -->
    <div class="container job-container">
        <?php if (!empty($softwareposts) || !empty($coreposts)) { ?>
            <?php foreach ($softwareposts as $softwareJob) { ?>
                <!-- Display software job card -->
                <div class="card job-card">
                    <img src="<?= $softwareJob['logo'] ?>" class="card-img-top" alt="Company Logo">
                    <div class="card-body">
                        <h5 class="card-title"><?= $softwareJob['jobname'] ?></h5>
                        <p class="card-text">Company: <?= $softwareJob['companyname'] ?></p>
                        <p class="card-text">Total Applications: <?= $softwareJob['totalapplications'] ?></p>
                        <p class="card-text">Applied: <?= (!is_nan($softwareJob['totalapplications']) && !is_nan($softwareJob['openings'])) ? ($softwareJob['totalapplications'] - $softwareJob['openings']) : 'N/A' ?></p>
                        <a href="/employerlogin/mypostfindcandidatecompany?company=<?= $softwareJob['companyname'] ?>&category=softwarejob&job=<?= $softwareJob['jobname'] ?>&status=applied" class="btn btn-primary btn-view-candidates">
                            Show Applied Candidates
                        </a>
                        <a href="/employerlogin/removepost?category=softwarejob&id=<?= $softwareJob['_id'] ?>" class="btn btn-danger btn-remove-post">Remove</a>
                    </div>
                </div>
            <?php } ?>

            <?php foreach ($coreposts as $coreJob) { ?>
                <!-- Display core job card -->
                <div class="card job-card">
                    <img src="<?= $coreJob['logo'] ?>" class="card-img-top" alt="Company Logo">
                    <div class="card-body">
                        <h5 class="card-title"><?= $coreJob['jobname'] ?></h5>
                        <p class="card-text">Company: <?= $coreJob['companyname'] ?></p>
                        <p class="card-text">Total Applications: <?= $coreJob['totalapplications'] ?></p>
                        <p class="card-text">Applied: <?= (!is_nan($coreJob['totalapplications']) && !is_nan($coreJob['openings'])) ? ($coreJob['totalapplications'] - $coreJob['openings']) : 'N/A' ?></p>
                        <a href="/employerlogin/mypostfindcandidatecompany?company=<?= $coreJob['companyname'] ?>&category=corejob&job=<?= $coreJob['jobname'] ?>&status=applied" class="btn btn-primary btn-view-candidates">
                            Show Applied Candidates
                        </a>
                        <a href="/employerlogin/removepost?category=corejob&id=<?= $coreJob['_id'] ?>" class="btn btn-danger btn-remove-post">Remove</a>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <!-- Display an image or message when no posts are available -->
            <div class="text-center">
                <img src="/path/to/empty-image.jpg" alt="No Job Posts">
                <p>No job posts available.</p>
            </div>
        <?php } ?>
        <div>
            <h6>Total Software Job Posts: <?= count($softwareposts) ?></h6>
            <h6>Total Core Job Posts: <?= count($coreposts) ?></h6>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Application Graphs</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
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
      padding: 5px;
    }

    nav a {
      color: white;
      text-decoration: none;
      padding: 10px 20px;
    }

    nav a:hover {
      background-color: #555;
    }
    .card-header {
        background-color:#ff8300;
        color: #fff;
        font-weight: bold;
    }
    .nav-link {
        color: #ff8300;
        border: none;
        border-radius: 0;
    }
    .nav-link:hover {
        color: #fff;
        background-color: #ff8300;
    }
    .nav-link.active,
    .nav-link.active:hover {
        background-color: #ff8300;
        color: #fff;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
</style>

   
</head>
<body >
    <header class="text-white  back">
        <div>
            <img src="images/logo.png" alt="" />
            <span>
             JobForge
            </span>
        </div>
       
        
    </header>

<div class="row mt-3 ">
    <div class="col-md-5 p-5">
        <div class="card">
            <h5 class="card-header">Core Job Applications</h5>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                
                <div class="container-fluid">
                   
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#coreNavbar" aria-controls="coreNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="coreNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showCoreGraph('today')" id="todayCoreBtn">Today (Core)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showCoreGraph('5days')" id="5daysCoreBtn">Last 5 Days (Core)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showCoreGraph('10days')" id="10daysCoreBtn">Last 10 Days (Core)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showCoreGraph('1month')" id="1monthCoreBtn">Last 1 Month (Core)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showCoreGraph('2months')" id="2monthsCoreBtn">Last 2 Months (Core)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showCoreGraph('3months')" id="3monthsCoreBtn">Last 3 Months (Core)</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="card-body">
                <canvas id="coreGraph" width="400" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-5 p-5">
        <div class="card">
            <h5 class="card-header">Software Job Applications</h5>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                
                <div class="container-fluid">
                   
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#softwareNavbar" aria-controls="softwareNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="softwareNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showSoftwareGraph('today')" id="todaySoftwareBtn">Today (Software)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showSoftwareGraph('5days')" id="5daysSoftwareBtn">Last 5 Days (Software)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showSoftwareGraph('10days')" id="10daysSoftwareBtn">Last 10 Days (Core)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showSoftwareGraph('1month')" id="1monthSoftwareBtn">Last 1 Month (Core)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showSoftwareGraph('2months')" id="2monthsSoftwareBtn">Last 2 Months (Core)</button>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" onclick="showSoftwareGraph('3months')" id="3monthsSoftwareBtn">Last 3 Months (Core)</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="card-body">
                <canvas id="softwareGraph" width="400" height="250"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    let coreChart; 
    let softwareChart; 

    function showCoreGraph(timeRange) {
        fetch(`/myproject/graphs/graphTwo?category=core&timeRange=${timeRange}`)
            .then(response => response.json())
            .then(data => {
                const labels = data.labels;
                const documentCounts = data.documentCounts;
                displayCoreGraph(labels, documentCounts);
            })
            .catch(error => console.error('Error fetching Core data:', error));

        resetButtonStyles();
        document.getElementById(`${timeRange}CoreBtn`).classList.add('active');
    }

    function displayCoreGraph(labels, data) {
        var ctx = document.getElementById('coreGraph').getContext('2d');

        if (coreChart) {
            coreChart.data.labels = labels;
            coreChart.data.datasets[0].data = data;
            coreChart.update();
        } else {
            coreChart = new Chart(ctx, {
                type: 'line', 
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of CoreJob Applications',
                        data: data,
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }

    function showSoftwareGraph(timeRange) {
        fetch(`/myproject/graphs/graphTwo?category=software&timeRange=${timeRange}`)
            .then(response => response.json())
            .then(data => {
                const labels = data.labels;
                const documentCounts = data.documentCounts;
                displaySoftwareGraph(labels, documentCounts);
            })
            .catch(error => console.error('Error fetching Software data:', error));

        resetButtonStyles();
        document.getElementById(`${timeRange}SoftwareBtn`).classList.add('active');
    }

    function displaySoftwareGraph(labels, data) {
        var ctx = document.getElementById('softwareGraph').getContext('2d');

        if (softwareChart) {
            softwareChart.data.labels = labels;
            softwareChart.data.datasets[0].data = data;
            softwareChart.update();
        } else {
            softwareChart = new Chart(ctx, {
                type: 'line', 
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Software Applications',
                        data: data,
                        fill: false, 
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
    function resetButtonStyles() {
        const buttons = document.querySelectorAll('.nav-link');
        buttons.forEach(button => {
            button.classList.remove('active');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
       
        showCoreGraph("5days");
        showSoftwareGraph("5days");
    });
</script>





<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

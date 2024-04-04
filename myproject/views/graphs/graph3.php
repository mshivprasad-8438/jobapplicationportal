<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Category Pie Chart</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 50%;">
        <canvas id="jobCategoryPieChart" width="400" height="400"></canvas>
    </div>
    <div ><?= $softwareCount  ?> </div>
    <div ><?= $coreCount?></div>

    <script>
        // PHP data passed from the controller
        

        var softwareCount = <?php echo $softwareCount; ?>;
        var coreCount = <?php echo $coreCount; ?>;
        console.log(softwareCount);
        console.log(coreCount);

        var ctx = document.getElementById('jobCategoryPieChart').getContext('2d');
        var jobCategoryPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Software', 'Core'],
                datasets: [{
                    label: 'Job Categories',
                    data: [softwareCount, coreCount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Job Category Distribution'
                }
            }
        });
    </script>
</body>
</html>
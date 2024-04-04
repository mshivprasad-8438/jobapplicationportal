<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="experience_section layout_padding-top layout_padding2-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="img-box justify-content-center">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/experience-img.jpg" alt="">
                    </div>
                </div>

                <div class="card-container">
                    <div class="card">
                        <h3>Software Jobs</h3>
                        <p>Find exciting opportunities in the software industry.</p>
                        <a href="/myproject/about/jobs?category=software" class="btn btn-success">View Jobs</a>
                    </div>

                    <div class="card">
                        <h3>Core Jobs</h3>
                        <p>Discover core engineering job openings.</p>
                        <a href="/myproject/about/jobs?category=core" class="btn btn-danger">View Jobs</a>
                    </div>
                    <div class="card">
                        <h3>Your Applications</h3>
                        <p>Check the status of your job applications.</p>
                        <a href="/myproject/about/viewapplications" class="btn btn-info">View Applications</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end experience section -->

    <form class="bg-light p-4" action="/searchjob" method="post">
        <select class="form-control" name="category" id="category" onchange="updateField2Options(); ">
            <option value="" disabled selected>Select Category</option>
            <option value="softwarejob">Software</option>
            <option value="corejob">Core Jobs</option>
        </select>

        <select class="form-control" name="role" id="field2" disabled onchange="toggleSearchButton();">
            
        </select>

        <button type="submit" class="btn btn-success" id="searchBtn" disabled>Search</button>
    </form>
    <script>
        function logout() {
            fetch('/logout').then(data => {
                window.location.href = "/"
            }
            )
        }

        function toggleSearchButton() {
            var categorySelect = document.getElementById('category');
            var field2Select = document.getElementById('field2');
            var searchButton = document.getElementById('searchBtn');

            // Check if both category and job name are selected
            if (categorySelect.value && field2Select.value) {
                searchButton.disabled = false; // Enable search button
            } else {
                searchButton.disabled = true; // Disable search button
            }
        }
    </script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>

    <script>
        async function updateField2Options() {
            var categorySelect = document.getElementById('category');
            var field2Select = document.getElementById('field2');

            // Enable the second dropdown
            field2Select.disabled = false;
            const cat = categorySelect.value;
            // Clear existing options
            field2Select.innerHTML = '<option value="" disabled selected>Select Job Name</option>';
            await fetch(`/${cat}sapi`).then((res) => {
                return res.json();
            }).then((data) => {
                const arr = new Array();
                let arraymap;
                const currentDate = new Date();
                arraymap = data.map((val, i, arr) => {
                    if (data[i].openings > 0 && new Date(data[i].lastdate).getTime() >= currentDate.getTime()) {
                        if (!arr.includes(data[i].jobname)) {
                            field2Select.innerHTML += `<option value=${data[i].jobname} name=${data[i].jobname}>${data[i].jobname}</option>`;
                            arr.push(data[i].jobname);
                        }

                    }
                })
            });
        }
    </script>
</body>
</html>
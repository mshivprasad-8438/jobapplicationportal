<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Job Portal</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <img src="/images/maxresdefault (1).jpg" class="card-img-top mb-5 p-5" alt="Post a Job Image">
                    <div class="card-body p-10">
                        <h2 class="card-title mt-5">Post a Job</h2>
                        <p class="card-text">Share your job opportunities with the world. Create a detailed job listing, including requirements, responsibilities, and benefits.</p>
                        <h4 class="mt-4">Core Jobs</h4>
                        <p>Explore opportunities in core engineering fields.</p>
                        <h4 class="mt-4">Software Jobs</h4>
                        <p>Discover openings in the exciting world of software development.</p>
                        <a href="/myproject/employerabout/viewposts" class="btn btn-primary mt-3">View Your Posts</a>
                        <a href="/myproject/employerabout/postjobform" class="btn btn-primary mt-3">Post Job</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img src="/images/about-img.jpg" class="card-img-top mb-5" alt="Find Candidate Image">
                    <div class="card-body">
                        <h2 class="card-title mt-4">Find the Right Candidate</h2>
                        <p class="card-text">In your quest to build a stellar team, explore a diverse array of qualified candidates. Leverage our platform to discover skilled professionals who align with your company's vision and values.</p>
                        <form class="bg-light p-4" action="/employerabout/findcandidate?status=applied" method="post">
                            <div class="mb-3">
                                <select class="form-select" name="category" id="category">
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="corejob">Core</option>
                                    <option value="softwarejob">Software</option>
                                </select>
                                <select class="form-control mt-4" name="role" id="field2" disabled></select>
                            </div>
                            <button type="submit" class="btn btn-primary">Find Candidate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#category').change(function() {
                var cat = $(this).val();
                $.ajax({
                    url: `/myproject/employerabout/corejobsapi`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var data = response;
                        $('#field2').prop('disabled', false);
                        $('#field2').empty().append('<option value="" disabled selected>Job Name</option>');
                        var arr = [];
                        $.each(data, function(i, item) {
                            if (!arr.includes(item.jobname)) {
                                $('#field2').append(`<option value="${item.jobname}" name="${item.jobname}">${item.jobname}</option>`);
                                arr.push(item.jobname);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", error);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

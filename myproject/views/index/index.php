<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title></title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid ">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" >
            <img src="<?php echo Yii::app()->request->baseUrl; ?>images/logo.png" alt="" />
            <span>
             JobForge
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item" >
                <a class="nav-link" id="about1" href="/myproject/signinform">About</button>

                </li>
            </ul>
            <div class="user_option">
              <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
          </div>
          <div>
            <div class="custom_menu-btn ">
              <button>
                <span class=" s-1">

                </span>
                <span class="s-2">

                </span>
                <span class="s-3">

                </span>
              </button>
            </div>
          </div>

        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div class="carousel_btn-container">
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2">03</li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      You Can <br>
                      Find Jobs <br>
                      Here
                    </h1>
                    <a style="background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;"
    href="/myproject/signupform"
>
SignUp
                  </a>
    <a style="background-color: #008CBA; /* Blue */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;"
href="/myproject/signinform">
SignIn
                </a>
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      Apply  <br>
                      For Any Work <br>
                      Here
                    </h1>
                    <p>
                       where passion meets profession, and every project is a canvas for creativity."
                    </p>
                    <div class="btn-box">
                      <a style="background-color: #008CBA; /* Blue */
                      border: none;
                      color: white;
                      padding: 10px 20px;
                      text-align: center;
                      text-decoration: none;
                      display: inline-block;
                      font-size: 16px;
                      margin: 4px 2px;
                      cursor: pointer;"
                  href="/myproject/signinform/signinform">
                  SignIn
                                  </a>
                    </div>
                    
                    
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                     <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider-img.png" alt=""> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      You can <br>
                      Find Different<br>
                      Jobs Here<br>
                      
    <!-- Signin Button -->
                      
                    </h1>
                    <p>
                      It is a long established fact that a reader will be distracted by
                      the readable content of a page
                    </p>
                    <a style="background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;"
     href="/myproject/signupform"
>
SignUp
                  </a>
    <a style="background-color: #008CBA; /* Blue */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;"
   href="/myproject/signinform/signinform" 
>
SignIn
                </a>
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section>
    <!-- end slider section -->
  </div>


  <!-- experience section -->

  <section class="experience_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="img-box">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/resumeimg.jpg" alt="">
          </div>
        </div>
        <div class="col-md-7">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Post jobs for free in 2024
                
                
              </h2>
            </div>
            <div class="heading_container">
              <h4>
                JobForge makes setting up and posting a job for free
                as easy as clicking a few buttons
              </h4>
            </div>
            <p>
              At JobForge, we believe in simplifying the hiring process. Our free job posting service is designed to help you find the right talent without breaking the bank. Click, post, and connect with candidates today!
             </p>
            <div class="btn-box">
              <a href="/myproject/employee/signin" class="btn-1">
               Employer Signin
              </a>
              <br>
              <a href="/myproject/employee/signup" class="btn-2">
               Employer Signup
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- end experience section -->

  <!-- category section -->

  <section class="category_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Different Categories Of Jobs

            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/c3.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              CoreJobs
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/c4.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              FreelancerJobs
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/c4.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Services
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/c3.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
             Content Creators
            </h5>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- end category section -->

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-lg-9 mx-auto">
          <div class="img-box">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/about-img.jpg" alt="">
          </div>
        </div>
      </div>
      <div class="detail-box">
        <h2>
          About JobForge
        </h2>
        <p>
          Explore a diverse array of job opportunities tailored to your skills and preferences on our application. Easily apply for your dream job with a seamless application process, personalized to each job listing. Our platform offers a user-friendly resume creation tool, empowering you to showcase your talents effectively. Elevate your career journey with tailored job recommendations and simplified application steps. Join us and take the next step towards your professional success
        </p><a href="/myproject/graphs/showCompanyWiseDistribution">
          Show Company-wise Distribution
         
        </a>
        <a href="/myproject/graphs/ApplicationTrends">
        Apllications_Trends
         
        </a>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- freelance section -->

  <section class="freelance_section ">
    <div id="accordion">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 offset-md-1">
            <div class="detail-box">
              <div class="heading_container">
                <h2>
                  OverView
                </h2>
              </div>
              <div class="tab_container">
                <div class="t-link-box" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>images/f1.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      2000+
                    </h5>
                    <h3>
                      Registrations
                    </h3>
                  </div>
                </div>
                <div class="t-link-box collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/f2.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                     
                    </h5>
                    <h3>
                      Paid Invoices
                    </h3>
                  </div>
                </div>
                <div class="t-link-box collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/f3.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      700,000
                    </h5>
                    <h3>
                      Worldwide Freelancer
                    </h3>
                  </div>
                </div>
                <div class="t-link-box collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  <div class="img-box">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/f4.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      98%
                    </h5>
                    <h3>
                      Customer <br>
                      Satisfaction Rate
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse show" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="img-box">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/freelance-img.jpg" alt="">
              </div>
            </div>
            <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="img-box">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/freelance-img.jpg" alt="">
              </div>
            </div>
            <div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="img-box">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/freelance-img.jpg" alt="">
              </div>
            </div>
            <div class="collapse" id="collapseFour" aria-labelledby="headingfour" data-parent="#accordion">
              <div class="img-box">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/freelance-img.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end freelance section -->

  <!-- client section -->

  <!-- end client section -->



  <!-- info section -->

  
  <!-- end  footer section -->
  <script>
     const handleAboutClick = () => {
       window.location.href="/about"
        }; 
    const handlesigninClick = () => {
       window.location.href="/signinhandle"
       
     }; 
   </script>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-3.4.1.min.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>


</body>
</body>

</html>
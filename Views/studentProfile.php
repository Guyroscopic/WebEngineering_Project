<?php
    //Checking if Student is logged in or not
    session_start();

    if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){

        $email    = $_SESSION["current_student_email"];
        $username = $_SESSION["current_student_username"];
            
    }
    else{
        header("location: login.php?notloggedin=true");
    }

    //Adding the required Models
    require_once "../Models/StudentTutorialBridgeModel.php";

    //Fetching the number of tutorials student has completed
    $num_completed_tutorials = getNumOfCompletedTutorialsByStudentEmail($email)[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">

    <!-- Title -->
    <title>Student Profile</title>
    <style type="text/css">        
        .flashMsg{
          color: #fff;          
          opacity: 0.7;
          background-color: #db5a5a;
          border-radius: 5px;
          text-align: center;
          margin: 20px 100px 0 100px;
          font-size: 15px;
          padding: 5px 0 5px 0;
        }

        .navBackground{
            background: linear-gradient(#43cae9 0%, #38f9d7 100%);
        }

        .btnA {
          background-color: #43cae9;
          color: #fff;
          min-width: 160px;
          font-size: 1.3rem;
          padding: 10px 20px;
          box-sizing: border-box;
          cursor: pointer;
          display: inline-flex;
          justify-content: center;
          text-align: center;
          text-decoration: none;
          transition: 0.3s;
          border-radius: 15px;
          border: 2px solid #1F2833;
          font-weight: 500;
          vertical-align: middle;
          margin: 5px;
          align-items:center;
          position: relative;
          left: 40px;
        }

        .btnA:hover{
            color: #e0e0e0;
            background-color: #828181;
            text-decoration: none;
        }
    </style>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- Line Icons css -->
    <link rel="stylesheet" href="../assets/css/LineIcons.css"> 
    
    <!-- Slick css -->
    <link rel="stylesheet" href="../assets/css/slick.css"> 

    <!-- Animate css -->
    <link rel="stylesheet" href="../assets/css/animate.css">

    <!-- Default css -->
    <link rel="stylesheet" href="../assets/css/default.css">

    <!-- Style css -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Bootstrap 4.5 --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>


    <!-- NAVBAR PART START -->

    <section class="header-area">
        
        <!-- Navigation Bar -->
        <header class="site-header">
            <nav class="navbar navBackground navbar-light fixed-top fixed-right navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand ml-3" href="/webproject">
                        <img src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png" alt="Logo" class="img4">
                    </a>  

                    <!-- Name of website -->
                     <a class="nav-item nav-link navLinkFont" href="/webproject"
                      style="font-size: 25px; font-weight: 600; color: #fff;">
                        LazyLearn
                    </a>           

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                        <span style="color: #fff" class="navbar-toggler-icon"></span>    
                    </button>

                    <div class="collapse navbar-collapse ml-4" id="navbarToggle">

                    <!-- Navigation bar extreme-right side -->
                    <div class="navbar-nav ml-auto">

                      <a class="nav-item nav-link navLinkFont mr-3" href="/webproject"
                         style="font-size: 18px; font-weight: 600; color: #fff;">
                         Home
                      </a>              
                      <a class="nav-item nav-link navLinkFont mr-3" href="about.php"
                         style="font-size: 18px; font-weight: 600; color: #fff;">
                        About
                      </a>
                      <a class="nav-item nav-link navLinkFont mr-5" href="studentLogout.php"
                         style="font-size: 18px; font-weight: 600; color: #fff;">
                        Logout
                      </a>   
                      <a class="nav-item nav-link" href="#side-menu-right"
                         style="font-size: 18px; font-weight: 600; color: #fff;">
                        <b><i style="color: #fff; font-weight: 600;" class="lni-menu"></i></b>
                      </a>
                

                </div>                  
              </div>
            </div>
          </nav>
        </header>
        <!-- End of Navigation Bar -->

          <!-- background image for student profile -->
            <div class="big-image">
                <div class="overlay1">
                    <div class="single-portfolio mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.7s">

                         <!-- Output divs for flash msgs -->
                        <?php if(@$_GET["invalidAccess"]){ ?>
                            <div class="flashMsg">Your access was Invalid</div>
                        <?php } ?>

                        <div class="text">
                            <h1>Welcome Student <?php echo $username ?></h1>                         
                            <p>Eamil ID: <?php echo $email ?></p>
                            <p>Tutorials Completed: <?php echo $num_completed_tutorials ?></p>
                        </div>
                         <a class="btnA" href="viewTutorials.php">Browse Tutorials</a><br>
                         <a class="btnA" href="completedTutorials.php">Show Completed Tutorials</a><br>
                         <a class="btnA" style="margin-bottom: 30px" href="#">Change Password</a><br><br>
                    </div>
                </div>
            </div>
    </section>

    <!--====== NAVBAR PART ENDS ======-->
    </section>

    <!--====== SAIDEBAR PART START ======-->

    <div class="sidebar-right">
        <div class="sidebar-close">
            <a class="close" href="#close"><i class="lni-close"></i></a>
        </div>
        <div class="sidebar-content">
            <div class="sidebar-logo text-center">
                <a href="#"><img src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png" alt="Logo" class="img1"></a>
            </div> <!-- logo -->
            <div class="sidebar-menu">
                <ul>
                    <li class="nav-item">
                        <a class="page-scroll" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="teachers.php">Registered Teachers</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="page-scroll" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
            </div> <!-- menu -->
          <div>
        </div> 
        </div> <!-- content -->
    </div> 
    <div class="overlay-right"></div>

    <!--====== SAIDEBAR PART ENDS ======-->

   <!--===== FOOTERpart starts ======-->
    
  <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About our Project</h6>
            <p class="text-justify">Our project is tutoring website for students where teachers can post and edit tutorials while students can see tutorials and can examine themselves through quizes. It is managed by Admin. We have used PHP for backend and HTML, CSS, jQuery and Bootstrap for frontend.</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Contact Information</h6>
            <ul>
              <p>SEECS</p>
              <p>NUST, H12 Campus</p>
              <p>ISLAMABAD</p>
            </ul>
          </div>
          <br><br><br>
          <div class="col-xs-6 col-md-3"><br>
            <ul>
              <p>BESE9B</p>
              <p>Batch'2k18</p>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2021 All rights reserved by Babloo Gang
            </p>
          </div>
        </div>
      </div>
</footer>

    <!--===== FOOTERpart ends ======-->


    <!--====== jquery js ======--> 
    <script src="../assets/js/jquery-1.12.4.min.js"></script> 

    <!--====== Bootstrap js ======-->
    <script src="../assets/js/bootstrap.min.js"></script>


    <!--====== Slick js ======-->
    <script src="../assets/js/slick.min.js"></script>

    <!--====== Isotope js ======-->
    <script src="../assets/js/isotope.pkgd.min.js"></script>

    <!--====== Images Loaded js ======-->
    <script src="../assets/js/imagesloaded.pkgd.min.js"></script> 
    
    <!-- Scrolling js -->
    <script src="../assets/js/scrolling-nav.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script> 

    <!-- wow js -->
    <script src="../assets/js/wow.min.js"></script>

    <!-- Main js -->
    <script src="../assets/js/main.js"></script>

    <!-- BOOTSTRAP JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>
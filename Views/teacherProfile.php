<?php
    //Checking if Teacher is logged in or not
    session_start();

    if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

        $email    = $_SESSION["current_teacher_email"];
        $username = $_SESSION["current_teacher_username"];            
    }
    else{
        header("location: login.php?notloggedin=true");
    }

    //Adding the required Models
    require_once "../Models/TutorialModel.php";

    $num_teacher_tutorials = getNumOfTutorialsByTeacherEmail($email)[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">

    <!-- Title -->
    <title>Teacher Profile</title>


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
    <style type="text/css">
        .btn{
            background-color: #828181;
        }
        .btn:hover{
            background-color: #5c5b5b;
        }
    </style>


</head>
<body>

    <!-- NAVBAR PART START -->

    <section class="header-area">

    <section class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#">
                                <img src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png" alt="Logo" class="img4">
                            </a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarEight" aria-controls="navbarEight" aria-expanded="false" aria-label="Toggle navigation">
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto">
                                    <li input style="margin-top: 15px;margin-left: 40px; margin-bottom: 20px;" class="nav-item active">
                                        <a class="page-scroll" href="/webproject">HOME</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 2px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="about.php">ABOUT</a>
                                    </li>
                                     <li input style="margin-top: 15px;margin-left: 500px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="teacherLogout.php">LOGOUT</a>
                                    </li>
                                    </ul> 
                                </ul>
                            </div>

                            <div class="navbar-btn d-none mt-15 d-lg-inline-block">
                                <a class="menu-bar" href="#side-menu-right"><i class="lni-menu"></i></a>
                            </div>
                        </nav> 
                    </div>
                </div> 
            </div> 
        </div>

          <!-- background image for teacher profile -->
            <div class="teacher-big-image">
                <div class="teacher-overlay1">
                    <div class="single-portfolio mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.7s">
                        <div class="text">
                            <h1>Welcome Teacher <?php echo $username ?></h1> 
                            <p>Email ID: <?php echo $email ?></p>
                            <p>Tutorials Published: <?php echo $num_teacher_tutorials ?></p>
                        </div>
                        
                        <a class="btn" href="viewTutorials.php">View Tutorials</a><br>
                        <a class="btn" href="publishedTutorials.php">View Published Tutorials</a><br>
                        <a class="btn" href="createTutorial.php">Create New Tutorials</a><br>
                        <a class="btn" href="updateInfo.php">Update Information</a><br><br><br>
                        =
                    </div>
                </div>
            </div>
    </section>

    <!--====== NAVBAR PART ENDS ======-->

    <!-- Output divs for flash msgs -->
    <?php if(@$_GET["invalidAccess"]){ ?>
        <p style="color: red">Your access was Invalid</p>
    <?php } ?>

    <?php if(@$_GET["created"]){ ?>
        <div style="color: green">Tutorial Successfully Created!</div>
    <?php } ?>

    <?php if(@$_GET["quizCreated"]){ ?>
        <div style="color: green">Quiz Successfully Created!</div>
    <?php } ?>

    <?php if(@$_GET["quizUpdated"]){ ?>
        <div style="color: green">Quiz Successfully Updated!</div>
    <?php } ?>

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

    <!-- Jquery js -->
    <script src="../assets/js/jquery-1.12.4.min.js"></script> 

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.min.js"></script>


    <!-- Slick js -->
    <script src="../assets/js/slick.min.js"></script>

    <!-- Isotope js -->
    <script src="../assets/js/isotope.pkgd.min.js"></script>

    <!-- Images Loaded js -->
    <script src="../assets/js/imagesloaded.pkgd.min.js"></script> 

    <!-- Scrolling js -->
    <script src="../assets/js/scrolling-nav.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script> 

    <!-- wow js -->
    <script src="../assets/js/wow.min.js"></script>

    <!-- Main js -->
    <script src="../assets/js/main.js"></script>

</body>

</html>
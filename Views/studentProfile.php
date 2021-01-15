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


</head>
<body>


    <!-- NAVBAR PART START -->

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
                                     <li input style="margin-top: 15px;margin-left: 2px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="studentLogout.php">LOGOUT</a>
                                    </li>
                                    <li><input style="margin-top: 15px;margin-left: 60px; margin-bottom: 20px; width: 200%;" type="text" placeholder="Search tutorial"></li>
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

          <!-- background image for student profile -->
            <div class="big-image">
                <div class="overlay1">
                    <div class="single-portfolio mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.7s">
                        <div class="text">
                            <h1>Welcome Student <?php echo $username ?></h1>                           
                            <p>Eamil ID: <?php echo $email ?></p>
                            <p>Tutorials Completed: <?php echo $num_completed_tutorials ?></p>
                        </div>
                    <ul class="carousel-btn rounded-buttons">
                        <li>
                            <a class="main-btn rounded-one" href="viewTutorials.php">
                                BROWSE TUTORIALS
                            </a>
                        </li>
                        <li>
                            <a class="main-btn rounded-two" href="#">
                                Link 2
                            </a>
                        </li>
                    </ul>  
                    </div>
                </div>
            </div>
    </section>

    <!--====== NAVBAR PART ENDS ======-->
    </section>

    <!-- Output divs for flash msgs -->
    <?php if(@$_GET["invalidAccess"]){ ?>
        <p style="color: red">Your access was Invalid</p>
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
                        <a class="page-scroll" href="studentProfile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="viewTutorials.php">Browse All Tuorials</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="contactus.php">Contat Us</a>
                    </li>
                </ul>
            </div> <!-- menu -->
          <div>
        </div> 
        </div> <!-- content -->
    </div> 
    <div class="overlay-right"></div>

    <!--====== SAIDEBAR PART ENDS ======-->




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

</body>

</html>
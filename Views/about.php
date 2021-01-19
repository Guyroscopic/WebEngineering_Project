<?php
    //Checking if Teacher is logged in or not
    session_start();

    $student_loggedin  = false; 
    $teacher_loggedin  = false;    

    if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){
        $teacher_loggedin  = true;
    }
    elseif(isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])){
        $student_loggedin  = true;            
    }    
        
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">

    <!-- Title -->
    <title>About</title>


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
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>    
                        
                            </button>

                            <?php if($student_loggedin){ ?>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="/webproject">HOME</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="about.php">ABOUT</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="login.php">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="studentLogout.php">Logout</a>
                                    </li>
                                </ul>
                            </div>
                            <?php }elseif($teacher_loggedin){ ?>
                            <div class="collapse navbar-collapse sub-menu-bar">
                                <ul class="navbar-nav ml-auto">
                                    <li  class="nav-item active">
                                        <a class="page-scroll" href="/webproject">HOME</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="about.php">ABOUT</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="login.php">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="teacherLogout.php">Logout</a>
                                    </li>
                                </ul>
                            </div>
                            <?php }else{ ?>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="/webproject">HOME</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="about.php">ABOUT</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="login.php">LOGIN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="register.php">REGISTER</a>
                                    </li>
                                    </ul> 
                                </ul>
                            </div>
                            <?php } ?>

                            <div class="navbar-btn d-none mt-15 d-lg-inline-block">
                                <a class="menu-bar" href="#side-menu-right"><i class="lni-menu"></i></a>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navbar area -->
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
                        <a class="page-scroll" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="teachers.php">Registered Teachers</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="contactus.php">Contact Us</a>
                    </li>
                    <?php if(!$student_loggedin && !$teacher_loggedin){ ?>
                    <li class="nav-item">
                        <a class="page-scroll" href="adminLogin.php">Login as Admin</a>
                    </li>
                    <?php } ?>
                </ul>
            </div> <!-- menu -->
          <div>
        </div> 
        </div> <!-- content -->
    </div> 
    <div class="overlay-right"></div>

    <!--====== SAIDEBAR PART ENDS ======-->
    
    <!--====== ABOUT PART START ======-->

    <section id="about" class="about-area">
       <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="about-image text-center wow fadeInUp mt-45" data-wow-duration="1.5s" data-wow-offset="100">
                        <img src="https://1on1.today/images/HomePage/en/Computer-Programming-tutor-online-lesson-course.jpg" alt="services" class="img3">
                    </div>
                    <div class="section-title text-center mt-40 pb-40">
                        <h4 class="title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.5s">Learn and Examine yourself</h4>
                        <p class="text wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">An platform for learning programming. Register yourself to get early access.</p>
                    </div> <!-- section title -->
                </div>
            </div> 
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-40 wow fadeInUp" data-wow-duration="1.0s" data-wow-delay="0.9s">
                    <!--     <div class="about-icon">
                            <img src="assets/images/icon-1.png" alt="Icon">
                        </div>  -->
                        <div class="about-content media-body">
                            <h4 class="about-title">Access to many tutorials</h4>
                            <p class="text">Our website provides access to several programming tutorials for students.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-40 wow fadeInUp" data-wow-duration="1.0s" data-wow-delay="0.9s">
                    
                        <div class="about-content media-body">
                            <h4 class="about-title">Easy registration</h4>
                            <p class="text">The registration process is simple and students can register themselves through their email.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-40 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.0s">
                    
                        <div class="about-content media-body">
                            <h4 class="about-title">Study at home</h4>
                            <p class="text">By simple registration process you can get access to several tutorials and develop your understanding by sitting at home.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-40 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.0s">
                    
                        <div class="about-content media-body">
                            <h4 class="about-title">Test yourself through quizes</h4>
                            <p class="text">Our website provides students with the feasibility of quizes to test their knowledge.</p>
                        </div>
                    </div> 
                </div>
            </div> 
        </div> 
    </section>

    <!--====== ABOUT PART ENDS ======-->


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

</body>

</html>
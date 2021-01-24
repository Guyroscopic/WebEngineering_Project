<?php
    //Checking if Teacher is logged in or not
    session_start();

    $student_loggedin  = false; 
    $teacher_loggedin  = false;
    $admin_loggedin    = false;    

    if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){
        $teacher_loggedin  = true;
    }
    elseif(isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])){
        $student_loggedin  = true;            
    }
    elseif(isset($_SESSION['admin_email']) && isset($_SESSION['admin_username'])){
        $admin_loggedin    = true;
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
    <style type="text/css">
        .navBackground{
            background: linear-gradient(#43cae9 0%, #38f9d7 100%);
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

    <section class="header-area">
        <!-- Navigation Bar -->
        <header class="site-header">
            <nav class="navbar navBackground navbar-light fixed-top fixed-right navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand ml-3" href="/webproject">
                        <img src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png" alt="Logo" class="img4">
                    </a>

                    <!-- Name of website -->
                     <a class="nav-item nav-link navLinkFont mr-3" href="/webproject"
                      style="font-size: 25px; font-weight: 600; color: #fff;">
                        LazyLearn
                    </a>           

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                        <span style="color: #fff" class="navbar-toggler-icon"></span>    
                    </button>

                    <div class="collapse navbar-collapse ml-4" id="navbarToggle">

                    <!-- Navigation bar extreme-right side -->
                    <div class="navbar-nav ml-auto">

                    <?php if($student_loggedin){ ?>
                    <a class="nav-item nav-link navLinkFont mr-3" href="/webproject"
                      style="font-size: 18px; font-weight: 600; color: #fff;">
                        Home
                    </a>              
                    <a class="nav-item nav-link navLinkFont mr-3" href="about.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                        About
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-3" href="login.php"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        Profile
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-5" href="studentLogout.php"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        Logout
                    </a>   
                    <a class="nav-item nav-link" href="#side-menu-right"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        <b>
                            <i style="color: #fff; font-weight: 600;" class="lni-menu">
                            </i>
                        </b>
                    </a>
                    <?php }elseif($teacher_loggedin){ ?>
                    <a class="nav-item nav-link navLinkFont mr-3" href="/webproject"
                      style="font-size: 18px; font-weight: 600; color: #fff;">
                        Home
                    </a>              
                    <a class="nav-item nav-link navLinkFont mr-3" href="about.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                        About
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-3" href="login.php"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        Profile
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-5" href="teacherLogout.php"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        Logout
                    </a>   
                    <a class="nav-item nav-link" href="#side-menu-right"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        <b>
                            <i style="color: #fff; font-weight: 600;" class="lni-menu">
                            </i>
                        </b>
                    </a>
                    <?php }elseif($admin_loggedin){ ?>
                    <a class="nav-item nav-link navLinkFont mr-3" href="/webproject"
                      style="font-size: 18px; font-weight: 600; color: #fff;">
                        Home
                    </a>              
                    <a class="nav-item nav-link navLinkFont mr-3" href="about.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                        About
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-3" href="adminPanel.php"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        Panel
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-5" href="adminLogout.php"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        Logout
                    </a>   
                    <a class="nav-item nav-link" href="#side-menu-right"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        <b>
                            <i style="color: #fff; font-weight: 600;" class="lni-menu">
                            </i>
                        </b>
                    </a>
                  <?php }else{ ?>
                  <a class="nav-item nav-link navLinkFont mr-3" href="/webproject"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                     Home
                  </a>              
                  <a class="nav-item nav-link navLinkFont mr-3" href="about.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                    About
                  </a>
                  <a class="nav-item nav-link navLinkFont mr-3" href="login.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                    Login
                  </a>
                  <a class="nav-item nav-link navLinkFont mr-5" href="register.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                    Register
                  </a>   
                  <a class="nav-item nav-link" href="#side-menu-right"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                    <b><i style="color: #fff; font-weight: 600;" class="lni-menu"></i></b>
                  </a>
                <?php } ?>

                </div>                  
              </div>
            </div>
          </nav>
        </header>
        <!-- End of Navigation Bar -->
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
                    <?php if(!$student_loggedin && !$teacher_loggedin && !$admin_loggedin){ ?>
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

     <!-- BOOTSTRAP JS, Popper.js, and jQuery
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->

</body>

</html>
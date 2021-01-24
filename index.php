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
        $admin_loggedin  = true; 
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
    <title>Home</title>
    <style type="text/css">        
        .flashMsg{
          color: #fff;
          background-color: #76e060;
          opacity: 0.8;
          border-radius: 5px;
          margin: 40px 50px 0px 50px;
          text-align: center;
          font-size: 20px;
          padding: 5px 0 5px 0;
        }

        .navBackground{
            background: linear-gradient(#43cae9 0%, #38f9d7 100%);
        }
    </style>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Line Icons css -->
    <link rel="stylesheet" href="assets/css/LineIcons.css"> 
    
    <!-- Slick css -->
    <link rel="stylesheet" href="assets/css/slick.css"> 

    <!-- Animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">

    <!-- Default css -->
    <link rel="stylesheet" href="assets/css/default.css">

    <!-- Style css -->
    <link rel="stylesheet" href="assets/css/style.css">

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

                    <?php if($student_loggedin){ ?>
                    <a class="nav-item nav-link navLinkFont mr-3" href="/webproject"
                      style="font-size: 18px; font-weight: 600; color: #fff;">
                        Home
                    </a>              
                    <a class="nav-item nav-link navLinkFont mr-3" href="Views/about.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                        About
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-3" href="Views/login.php"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        Profile
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-5" href="Views/studentLogout.php"
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
                    <a class="nav-item nav-link navLinkFont mr-3" href="Views/about.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                        About
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-3" href="Views/login.php"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        Profile
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-5" href="Views/teacherLogout.php"
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
                    <a class="nav-item nav-link navLinkFont mr-3" href="Views/about.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                        About
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-3" href="Views/adminPanel.php"
                    style="font-size: 18px; font-weight: 600; color: #fff;">
                        Panel
                    </a>
                    <a class="nav-item nav-link navLinkFont mr-5" href="Views/adminLogout.php"
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
                  <a class="nav-item nav-link navLinkFont mr-3" href="Views/about.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                    About
                  </a>
                  <a class="nav-item nav-link navLinkFont mr-3" href="Views/login.php"
                     style="font-size: 18px; font-weight: 600; color: #fff;">
                    Login
                  </a>
                  <a class="nav-item nav-link navLinkFont mr-5" href="Views/register.php"
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

        <!-- Sliding Photos and flash msgs-->
        <div id="home" class="slider-area">
            <div class="bd-example">
                <div id="carouselOne" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselOne" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselOne" data-slide-to="1"></li>
                        <li data-target="#carouselOne" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="carousel-item bg_cover active" style="background-image: url(https://static.wixstatic.com/media/nsplsh_6f7572514852544532494d~mv2_d_5472_3648_s_4_2.jpg/v1/fill/w_640,h_328,al_c,q_80,usm_0.66_1.00_0.01/nsplsh_6f7572514852544532494d~mv2_d_5472_3648_s_4_2.webp)">

                            <!-- Output div for flash msgs -->
                            <?php
                            //require 'DBinit.php';
                            if(@$_GET["loggedout"]){ ?>
                                <div class="flashMsg">Logged out Successfully!</div>
                            <?php } ?>

                            <div class="carousel-caption">
                                <div class="container">

                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-7 col-sm-10">
                                            
                                            <h2 class="carousel-title">Learn from home</h2>
                                            
                                        </div>
                                    </div> <!-- row -->
                                </div> <!-- container -->
                            </div> <!-- carousel caption -->
                        </div> <!-- carousel-item -->

                        <div class="carousel-item bg_cover" style="background-image: url(https://www.computersciencedegreehub.com/wp-content/uploads/2020/06/Is-Computer-Science-the-Same-as-Programming-1024x683.jpg)">
                            <div class="carousel-caption">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-7 col-sm-10">
                                            <h2 class="carousel-title">Build your understanding</h2>
                                            <ul class="carousel-btn rounded-buttons">
                                            </ul>
                                        </div>
                                    </div> <!-- row -->
                                </div> <!-- container -->
                            </div> <!-- carousel caption -->
                        </div> <!-- carousel-item -->

                        <div class="carousel-item bg_cover" style="background-image: url(https://res.cloudinary.com/grand-canyon-university/image/fetch/w_750,h_564,c_fill,g_faces/https://www.gcu.edu/sites/default/files/2020-09/programming.jpg)">
                            <div class="carousel-caption">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-7 col-sm-10">
                                            <h2 class="carousel-title">Access to many tutorials</h2>
                                            <ul class="carousel-btn rounded-buttons">
                                            </ul>
                                        </div>
                                    </div> <!-- row -->
                                </div> <!-- container -->
                            </div> <!-- carousel caption -->
                        </div> <!-- carousel-item -->
                    </div> <!-- carousel-inner -->

                    <a class="carousel-control-prev" href="#carouselOne" role="button" data-slide="prev">
                        <i class="lni-arrow-left-circle"></i>
                    </a>

                    <a class="carousel-control-next" href="#carouselOne" role="button" data-slide="next">
                        <i class="lni-arrow-right-circle"></i>
                    </a>
                </div> <!-- carousel -->
            </div> <!-- bd-example -->
        </div>
    </section>
     <!-- End of Sliding Photos and flash msgs-->

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
                        <a class="page-scroll" href="Views/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="Views/teachers.php">Registered Teachers</a>
                    </li>
                    <li>
                        <a href="Views/contactus.php">Conact Us</a>
                    </li>
                    <?php if(!$student_loggedin && !$teacher_loggedin && !$admin_loggedin){ ?>
                    <li class="nav-item">
                        <a class="page-scroll" href="Views/adminLogin.php">Login as Admin</a>
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
 
    <script src="assets/js/jquery-1.12.4.min.js"></script> 

    <!--====== Bootstrap js ======-->
    <script src="assets/js/bootstrap.min.js"></script>


    <!--====== Slick js ======-->
    <script src="assets/js/slick.min.js"></script>

    <!--====== Isotope js ======-->
    <script src="assets/js/isotope.pkgd.min.js"></script>

    <!--====== Images Loaded js ======-->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script> 
    
    <!-- Scrolling js -->
    <script src="assets/js/scrolling-nav.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script> 

    <!-- wow js -->
    <script src="assets/js/wow.min.js"></script>

    <!-- Main js -->
    <script src="assets/js/main.js"></script>

   
</body>

</html>
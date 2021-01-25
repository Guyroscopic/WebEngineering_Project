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
    <title>Contact Us</title>


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

     <style>
         @import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800");
         body {
          background-color: #D3D3D3;
        }

        .navBackground{
            background: linear-gradient(#43cae9 0%, #38f9d7 100%);
        }
    </style>

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

 
  <!--====== Contact PART STARTS ======-->
    <br><br><br><br><br><br><br>
    <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-4"></div>

        <div class="col-lg-4 col-md-4 col-sm-4">

            <!-- <div class="mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.7s">  -->
            <div class="text-color">
                <h1 align="center">Contact</h1>
                <p align="center"><b>For further queries you can reach us out through our email 
                adresses.</b></p>
            </div>                
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4"></div>
    </div>

    <div class="row">
            
        <div class="col-lg-2 col-md-2 col-sm-2"></div>

        <div class="col-lg-2 col-md-2 col-sm-2" align="center">
            <a href="mailto:fkhalid.bese18seecs@seecs.edu.pk">
                <img src="../assets/images/student-1.jpg" alt="s1" class="img2">
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2" align="center">
            <a href="mailto:larjamand.bese18seecs@seecs.edu.pk">
                <img src="../assets/images/student-2.jpg" alt="s2"class="img2">
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2" align="center">
            <a href="mailto:arafey.bese18seecs@seecs.edu.pk">
                <img src="../assets/images/student-3.jpg" alt="s3"class="img2">
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2" align="center">
            <a href="mailto:gbibi.bese18seecs@seecs.edu.pk">
                <img src="../assets/images/student-4.jpg" alt="s4"class="img2">
            </a>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2"></div>

    </div>
    <br><br><br>

    <!--====== Contact PART ENDS ======-->

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
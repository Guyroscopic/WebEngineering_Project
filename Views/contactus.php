<?php
    //Checking if Teacher is logged in or not
    session_start();

    $student_loggedin  = false; 
    $teacher_loggedin  = false;    

    if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){
        $student_loggedin  = true;
    }
    elseif(isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])){
        $teacher_loggedin  = true;            
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

     <style>
         @import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800");
         body {
      background-color: #D3D3D3;
    }
    </style>


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

                            <?php if($student_loggedin){ ?>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto">
                                    <li input style="margin-top: 15px;margin-left: 40px; margin-bottom: 20px;" class="nav-item active">
                                        <a class="page-scroll" href="/webproject">HOME</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="Views/about.php">ABOUT</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="Views/login.php">Profile</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="Views/studentLogout.php">Logout</a>
                                    </li>
                                </ul>
                            </div>
                            <?php }elseif($teacher_loggedin){ ?>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto">
                                    <li input style="margin-top: 15px;margin-left: 40px; margin-bottom: 20px;" class="nav-item active">
                                        <a class="page-scroll" href="/webproject">HOME</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="Views/about.php">ABOUT</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="Views/login.php">Profile</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="Views/teacherLogout.php">Logout</a>
                                    </li>
                                </ul>
                            </div>
                            <?php }else{ ?>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto">
                                    <li input style="margin-top: 15px;margin-left: 40px; margin-bottom: 20px;" class="nav-item active">
                                        <a class="page-scroll" href="/webproject">HOME</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="about.php">ABOUT</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 480px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="login.php">LOGIN</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
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

 
  <!--====== Contact PART STARTS ======-->
   
                <div class="col-lg-4 col-md-7 col-sm-9">

                        <div class="mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.7s">
                            <div class="text-color">
                            <h1>Contact</h1>
                            <p><b>For further queries you can reach us out through our email 
                            adresses.</b></p>
                            <p>Click on the picture and talk to us.</p>
                        </div>
                            
                        </div>
                            <div id="container">
                            <div id="box">
                                <div class="mt-35 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.7s">
                                <a href="mailto:fkhalid.bese18seecs@seecs.edu.pk"><img src="../assets/images/student-1.jpg" alt="s1" class="img2"></a>
                                <a href="mailto:larjamand.bese18seecs@seecs.edu.pk"><img src="../assets/images/student-2.jpg" alt="s2"class="img2"></a>
                                <a href="mailto:arafey.bese18seecs@seecs.edu.pk"><img src="../assets/images/student-3.jpg" alt="s3"class="img2"></a>
                                <a href="mailto:gbibi.bese18seecs@seecs.edu.pk"><img src="../assets/images/student-4.jpg" alt="s4"class="img2"></a>
                            </div>
                            </div>
                        </div> 
                </div><br><br><br><br><br><br><br><br><br><br>

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
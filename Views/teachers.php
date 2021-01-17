<?php

    include "../Models/DBconfig.php";

    include "../Models/UserModel.php";

    $teacher_records = getTeacherTable()
?>

<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">

    <!-- Title -->
    <title>Tutor</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../web project/assets/css/bootstrap.min.css">

    <!-- Line Icons css -->
    <link rel="stylesheet" href="../web project/assets/css/LineIcons.css"> 
    
    <!-- Slick css -->
    <link rel="stylesheet" href="../web project/assets/css/slick.css"> 

    <!-- Animate css -->
    <link rel="stylesheet" href="../web project/assets/css/animate.css">

    <!-- Default css -->
    <link rel="stylesheet" href="../web project/assets/css/default.css">

    <!-- Style css -->
    <link rel="stylesheet" href="../web project/assets/css/style.css">


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
                                        <a class="page-scroll" href="MainPage.html">HOME</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="About.html">ABOUT</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="TutorsPage.html">TUTORS</a>
                                    </li>
                                    <li input style="margin-top: 15px;margin-left: 10px; margin-bottom: 20px;" class="nav-item">
                                        <a class="page-scroll" href="Contact.html">Contact</a>
                                    </li>
                                   <li><input style="margin-top: 15px;margin-left: 40px; margin-bottom: 20px; width: 170%;" type="text" placeholder="Search tutorial"></li> 
                                    </ul> 
                                </ul>
                            </div>

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
                        <a class="page-scroll" href="About.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="TutorsPage.html">Tutors</a>
                    </li>
                    <li><a href="register.html">Registration</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li class="nav-item">
                        <a class="page-scroll" href="Contact.html">Contact</a>
                    </li>
                </ul>
            </div> <!-- menu -->
          <div>
        </div> 
        </div> <!-- content -->
    </div> 
    <div class="overlay-right"></div>

    <!--====== SAIDEBAR PART ENDS ======-->

    <!--====== Tutors PART START ======-->

    <section id="testimonial" class="testimonial-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center mt-42 pb-20">
                        <div class="single-portfolio wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.7s">
                        <h3 class="title">Tutors</h3>
                        <p class="text-color">They are our highly trained and experienced teachers!</p>
                    </div>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="row testimonial-active">

                        <?php while($teacher = mysqli_fetch_array($teacher_records)){ ?>
                        <div class="col-lg-4">
                            <div class="single-testimonial mb-30 text-center">
                                <div class="testimonial-content">
                                    <div class="single-portfolio wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.9s">
                                    <h6 class="text"><?php echo $teacher["username"]; ?></h6>
                                    <p class="text"><?php echo $teacher["description"]; ?></p> 
                                    <h6 class="author-name"><?php echo $teacher["email"]; ?></h6>
                                    <span class="sub-title"><?php echo $teacher["education"]; ?></span>
                                </div>
                                </div>
                            </div> 
                        </div>
                        <?php } ?>
                    </div>
                </div> 
            </div>
    </section>

    <!--====== Tutors PART ENDS ======-->

    <!--====== jquery js ======-->
 
    <script src="../web project/assets/js/jquery-1.12.4.min.js"></script> 

    <!--====== Bootstrap js ======-->
    <script src="../web project/assets/js/bootstrap.min.js"></script>


    <!--====== Slick js ======-->
    <script src="../web project/assets/js/slick.min.js"></script>

    <!--====== Isotope js ======-->
    <script src="../web project/assets/js/isotope.pkgd.min.js"></script>

    <!--====== Images Loaded js ======-->
    <script src="../web project/assets/js/imagesloaded.pkgd.min.js"></script> 
    
    <!-- Scrolling js -->
    <script src="../web project/assets/js/scrolling-nav.js"></script>
    <script src="../web project/assets/js/jquery.easing.min.js"></script> 

    <!-- wow js -->
    <script src="../web project/assets/js/wow.min.js"></script>

    <!-- Main js -->
    <script src="../web project/assets/js/main.js"></script>

</body>

</html>
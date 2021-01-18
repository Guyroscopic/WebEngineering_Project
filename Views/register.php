<?php
    //Starting Session
    session_start();

    //Redirecting in case user is already logged in 
    if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
        header("location: studentProfile.php");
    }

    elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
        header("location: teacherProfile.php");
    }
    //Redirecting in case admin is already logged in 
    elseif(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
        header("location: adminPanel.php");
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
    <title>REGISTER</title>
    <style type="text/css">        
        .flashMsg{
          color: #fff;          
          opacity: 0.7;
          background-color: #db5a5a;
          border-radius: 5px;
          text-align: center;
          margin: 20px 50px 0 50px;
          font-size: 15px;
          padding: 5px 0 5px 0;
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
    </section>
    
    <!-- NAVBAR PART END -->
    
    <!-- REGISTRATION PART START -->
    <div class="main-register-form">
            <div class="register">

                <!-- OUTPUT DIV FOR ERROR MESSAGES -->
                <?php if(@$_GET["invalid"]){ ?>
                    <div class="flashMsg"><?php echo $_GET["invalid"]; ?></div>
                <?php } ?>

                <?php if(@$_GET["userexists"]){ ?>
                    <div class="flashMsg"><?php echo $_GET["userexists"]; ?></div>
                <?php } ?> 

                <?php if(@$_GET["empty"]){ ?>
                    <div class="flashMsg"><?php echo $_GET["empty"]; ?></div>
                <?php } ?>

                <h2>Register Here</h2>

                <form  action="../Controllers/SignupController.php" method="POST" id="signupForm">
                    <div class="radio" align="center">
                        <label>Register as</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" value="student" name="registertype" class="student" required>
                        <span id="student">Student</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" value="teacher" name="registertype" class="teacher" required>
                        <span id="teacher">Teacher</span>
                    </div>
                    <br>
                    
                    <div align=center style="padding: 0 50px 0 50px">
                    <input type="text" name="username" id="name" placeholder="Enter Your Username">
                    <br><br>
                    
                    <input type="email" name="email" id="name" placeholder="Enter Your Email">
                    <br><br>
                    
                    <input type="password" name="password" id="password" placeholder="Enter Your Password">
                    <br><br>
                    
                    <input type="password" name="confirm-password" id="password" placeholder="Confirm Your Password">
                    <br><br>
                    </div>
                    
                    <div class="reg-btn" style="padding: 0 50px 0 50px">
                        <button type="submit" name="registeruserbutton">REGISTER</button>
                    </div>
                    <br>
                    <div id="login" align=center style="padding: 0 50px 20px 50px">Already have an account?
                        <a href="login.php">Login Here</a>
                    </div>
                    
                </form>
            </div>
        </div>
    <!-- REGISTRATION PART END -->

    <!-- SIDEBAR PART START -->
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
                        <a class="page-scroll" href="teachers.php">Registered Teachers</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="about.php">About</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="page-scroll" href="contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="adminLogin.php">Login as Admin</a>
                    </li>
                </ul>
            </div> <!-- menu -->
          <div>
        </div> 
        </div> <!-- content -->
    </div> 
    <!-- SIDEBAR PART ENDS -->

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
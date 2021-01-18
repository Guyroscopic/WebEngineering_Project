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
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>LOGIN</title>
    <style type="text/css">        
        .flashMsg{
          color: #fff;          
          opacity: 0.7;
          background-color: #db5a5a;
          border-radius: 5px;
          text-align: center;
          margin-top: 30px;
          margin-bottom: 30px;
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
    
    <!-- Icons Stylesheet Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    
    <!-- LOGIN PART START -->
    <div class="login-bg-img">
        <div class="login-box">

            <!-- Output divs for flash msgs -->
            <?php if(@$_GET["notloggedin"]){ ?>
                <div class="flashMsg">You need to Login to Access that Page</div>
            <?php } ?>

            <?php if(@$_GET["empty"]){ ?>
                <div class="flashMsg">Enter Values Before Submitting</div>
            <?php } ?>

            <?php if(@$_GET["logoutbeforelogin"]){ ?>
                <div class="flashMsg">You need to Login before Logging Out!</div>
            <?php } ?>

            <?php if(@$_GET["invalidemail"]){ ?>
                <div class="flashMsg">Invalid Email! Please Try Again</div>
            <?php } ?>

            <?php if(@$_GET["invalidpassword"]){ ?>
                <div class="flashMsg">Wrong Password! Please Try Again</div>
            <?php } ?>

            <header>Login Here</header>

            <form action="../Controllers/LoginController.php" id="loginForm" method="POST">
                <div class="login-type">
                    <label>Login as</label><!-- Login Type -->
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" class="student" value="student" name="loginType" required>
                    <span id="student">Student</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" class="teacher" value="teacher" name="loginType" required>
                    <span id="teacher">Teacher</span>
                </div>
                <br>
                
                <div class="field"><!-- Email or Username Input fields -->
                    <span class="fa fa-user"></span>
                    <input type="text" name="email" placeholder="yourname@example.com" required>
                </div>
                <br>
                
                <div class="field"><!-- Password field -->
                    <span class="fa fa-lock"></span>
                    <input type="password" class="pass-key" name="password" placeholder="Password" required>
                </div>
                <br>
                
                <div class="login-btn">
                    <button type="submit" name="login">LOGIN</button>
                </div>
                
            </form>
            <br>
        
        <div class="log-register">Don't have an account?
          <a href="register.php">Register Here</a>
        </div>
      </div>
    </div>
    <!-- LOGIN PART END -->

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
    
     <br><br>

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
<?php
    //Starting Session
    session_start();

    //Redirecting in case admin is already logged in 
    if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
        header("location: adminPanel.php");
    }
    //Redirecting in case user is already logged in 
    elseif(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
        header("location: studentProfile.php?invalidAccess=true");
    }

    elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
        header("location: teacherProfile.php?invalidAccess=true");
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
    <title>Admin Login</title>
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
    
    <!-- Icons Stylesheet Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!-- Bootstrap 4.5 --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
    
<body>
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
                      <a class="nav-item nav-link navLinkFont mr-3" href="/webproject"
                         style="font-size: 18px; font-weight: 600; color: #fff;">
                         Home
                      </a>              
                      <a class="nav-item nav-link navLinkFont mr-3" href="about.php"
                         style="font-size: 18px; font-weight: 600; color: #fff;">
                        About
                      </a>
                      <a class="nav-item nav-link" href="#side-menu-right"
                         style="font-size: 18px; font-weight: 600; color: #fff;">
                        <b><i style="color: #fff; font-weight: 600;" class="lni-menu"></i></b>
                      </a>   

                    </div>                  
                </div>
            </div>
        </nav>
    </header>
    <!-- End of Navigation Bar -->
    
    <!-- LOGIN PART START -->
    <div class="login-bg-img">
        <div class="login-box">

            <!-- Output divs for flash msgs -->
            <?php if(@$_GET["notloggedin"]){ ?>
                <div class="flashMsg">You need to Login as Admin to Access that Page</div>
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

            <form action="../Controllers/AdminLoginController.php" id="loginForm" method="POST">
                <div class="login-type">
                    <label>LOGIN as ADMIN</label><!-- Login Type -->
                    &nbsp;&nbsp;&nbsp;&nbsp;

                </div>
                <br>
                
                <div class="field"><!-- Email or Username Input fields -->
                    <span class="fa fa-user"></span>
                    <input type="text" name="email" placeholder="yourname@example.com" required>
                </div>
                <br>
                
                <div class="field"><!-- Password field -->
                    <span class="fa fa-lock"></span>
                    <input type="password" name="password" class="pass-key" placeholder="Password" required>
                </div>
                
                <br>
                <div class="login-btn">
                    <button type="submit" name="login">Login</button>
                </div>
            </form>
            <br><br>
        
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
                        <a class="page-scroll" href="about.php">About</a>
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
    <!-- SIDEBAR PART ENDS -->


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
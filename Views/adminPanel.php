<?php
	//Starting Session
    session_start();

    //Redirecting in case admin is not logged in 
    if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){

    	$email    = $_SESSION['admin_email'];
    	$username = $_SESSION['admin_username'];        
    }
    elseif(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username']))
    {
    	header("location: studentProfile.php?invalidAccess=true");
    }
    elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username']))
    {
    	header("location: teacherProfile.php?invalidAccess=true");
    }
    else{
    	header("location: adminLogin.php?notloggedin=true");
    }

    //Adding the required Models
    require_once "../Models/AdminModel.php";
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">

    <!-- Title -->
    <title>Admin Panel</title>


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

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="/webproject">HOME</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="about.php">ABOUT</a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="page-scroll" href="adminlogout.php.php">LOGOUT</a>
                                    </li>
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
                        <a class="page-scroll" href="about.php">About Us</a>
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
    <div class="overlay-right"></div>

    <!--====== SAIDEBAR PART ENDS ======-->

          <!-- background image for admin panel -->
            <div class="big-image">
                <div class="overlay1">
                    <div class="single-portfolio mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.7s">
                        <div class="admin-main">
                            <h1 class="admin-rights"><span >Welcome <?php echo $username ?></span></h1>
                            <div> <br> <br>
							<h3 class="admin-rights">You have Add and Delete Rights on:</h3> <br>
                            <ul>
								<div class="admin-line">
								<li><a class="btn" href="studentTable.php">Student Table</a></li> 
							    </div>
								<dive class="admin-line">
								<li><a class="btn" href="teacherTable.php">Teacher Table</a></li> 
							    </div>
								<li><a class="btn" href="tutorialCategoryTable.php">Tutorial Category Table</a></li>
                                
							</ul>
                              <br>
                    
                            <div>
                            <h3 class="admin-rights">You have Viewing Rights on:</h3><br>
                                <ul> 
									<div class="admin-line">
                                    <li><a class="btn" href="studentTutorialBridgeTable.php">Student Tutorial Bridge Table</a></li>
									</div>
									<div class="admin-line">
									<li><a class="btn" href="#">Student Quiz Bridge Table</a></li>
                                    </div>
                                    <li><a class="btn" href="#">Tutorial Category Table</a></li>
                                </ul>
                            </div>
                            <br>
                            <div>
                                <h3 class="admin-rights">You have Deleting Rights on:</h3> <br>
                                <ul>
									<div class="admin-line">
									<li><a class="btn" href="tutorialTable.php">Tutorial Table</a></li>
									</div>
									<div class="admin-line">
									<li><a class="btn" href="paragraphTable.php">Paragraphs Table</a></li>
                                    </div>
									<div class="admin-line">
									<li><a class="btn" href="quizTable.php">Quiz Table</a></li>
                                    </div>
									<li><a class="btn" href="questionTable.php">Question Table</a></li>
                                </ul>
                            </div>
                            <br>
                            <div>
                                <h3 class="admin-rights">You have Adding Rights on:</h3> <br>
                                <ul>
                                    <li><a class="btn" href="adminTable.php">Admin Table</a></li>
                                </ul>
                            </div>
                            <br>
                            </div>
                    </div>
                </div>
            </div><br><br><br><br><br><br><br>
    </section>


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
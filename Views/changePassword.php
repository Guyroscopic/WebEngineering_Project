<?php

	//Checking if Teacher is logged in or not
	session_start();
	//echo $_SESSION['current_teacher_email'];
	//exit();

	$teacher_loggedin = false;
	$student_loggedin = false;

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){
		
		$teacher_email    = $_SESSION['current_teacher_email'];
		$teacher_password = $_SESSION['current_teacher_username'];
		$teacher_loggedin = true;
	}
	elseif(isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username']))
	{		
		$student_email     = $_SESSION["current_student_email"];
		$student_username  = $_SESSION["current_student_username"];
		$student_loggedin  = true;
	}
	elseif(isset($_SESSION['admin_email']) && isset($_SESSION['admin_username'])){
		header("location: adminPanel.php?invalidAcess=ture");
	}
	else{
		header("location: login.php?notloggedin=true");
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">

  <title>Change Password</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  

  <style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800");
    body {
      font-family: "Poppins", sans-serif;
      background-color: white;
    }
    
    .main {
      margin-left: 250px;
      padding: 0px 10px;
      color: black;
    }

    .multi-text {
        background-image: linear-gradient(to left, #43cae9 0%, #38f9d7 100%);
        -webkit-background-clip: text;
        -moz-background-clip: text;
        background-clip: text;
        color: transparent;
        font-size: 50px;
        font-weight: bold;
      }

    .logo{
      position: relative;
      left:40px;
      width:150px;
    }

    .sidenav {
      height: 100%;
      width: 250px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0; 
      background: linear-gradient(#43cae9 0%, #38f9d7 100%);
      overflow-x: hidden;
      padding-top: 20px;
    }

    .sidenav a {
      padding: 6px 8px 6px 16px;
      text-decoration: none;
      font-size: 20px;
      color:#ffffff;
      display: block;
    }

    .sidenav a:hover {
      color: #38f9d7;
      background: #fff;
      text-decoration: none;
    }
    .flashMsgRed{
          color: #fff;          
          opacity: 0.7;
          background-color: #db5a5a;
          border-radius: 5px;
          text-align: center;
          margin: 0px 50px 0px 50px;
          font-size: 15px;
          padding: 5px 0 5px 0;
        }

    .flashMsgGreen{
      color: #fff;
      background-color: #76e060;
      opacity: 0.7;
      border-radius: 5px;
      margin: 0px 50px 0px 50px;
      text-align: center;
      font-size: 15px;
      padding: 5px 0 5px 0;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }

  </style>

	<!-- Importing jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

	<div class="sidenav">
    <img class="logo" src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png">
    <br><br>
    <a href="/webproject"><i class="fa fa-home"></i> Home</a>
    <br>
    <a href="About.php"><i class="fa fa-font"></i> About</a>
    <br>
    <a href="login.php"><i class="fa fa-hand-o-left"></i> Return to Profile</a>
    <br>
    <?php if($student_loggedin){ ?>
      <a href="studentLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
    <?php }elseif($teacher_loggedin){ ?>
      <a href="teacherLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
    <?php } ?>
    <br>
    </div>

    <div class="main">
	<h1><span class="multi-text">Change Password Here!</span></h1><br><br>

	<!-- Output div for an empty submissoin -->
	<?php if(@$_GET["empty"]){ ?>
		<div class="flashMsgRed"><?php echo $_GET["empty"]; ?></div>
	<?php } ?>

	<!-- Output div for an Error -->
	<?php if(@$_GET["invalid"]){ 	?>
		<div class="flashMsgRed"><?php echo $_GET["invalid"]; ?></div>
	<?php } ?>

	<!-- Output div for an Error -->
	<?php if(@$_GET["error"]){ 	?>
		<div class="flashMsgRed"><?php echo $_GET["error"]; ?></div>
	<?php } ?>

	<br><br><form class="form-horizontal" name="changePassword" method="POST" action='../Controllers/ChangePasswordController.php'>

		<div class="form-group row"> 
		<label class="col-sm-2 col-form-label col-form-label">Old Password</label>
		<div class="col-sm-10">
		<input class="form-control form-control" type="password" name="old_password" placeholder="Enter Your Old Password" required>
		</div>
		</div>

		<div class="form-group row"> 
		<label class="col-sm-2 col-form-label col-form-label">New Password</label>
		<div class="col-sm-10">
		<input class="form-control form-control" type="password" name="new_password" placeholder="Enter Your New Password" required>
		</div>
		</div>

		<div class="form-group row"> 
		<label class="col-sm-2 col-form-label col-form-label">Confirm New Password</label>
		<div class="col-sm-10">
		<input class="form-control form-control" type="password" name="confirm_new_password" placeholder="Confirm Your New Password" required>
		</div>
		</div>

		<button class="btn btn-info" type="submit" name="change_password">Change Password</button><br><br>
	</form>
</div>
</body>
</html>
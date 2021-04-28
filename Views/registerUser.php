<?php
	session_start();

	if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
        $current_admin_email    = $_SESSION['admin_email'];
        $current_admin_username = $_SESSION['admin_username'];
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
?>  

<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta charset="UTF-8">

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
    <a href="adminPanel.php"><i class="fa fa-hand-o-left"></i> Return to Profile</a>
    <br>
    <a href="adminLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
    <br>
    </div>

    <div class="main">

	<!-- OUTPUT DIV FOR ERROR MESSAGES -->

    <?php if(@$_GET["invalid"]){ ?>
		<div class="flashMsgRed"><?php echo $_GET["invalid"]; ?></div>
    <?php } ?>

	<?php if(@$_GET["userexists"]){ ?>
	    <div class="flashMsgRed"><?php echo $_GET["userexists"]; ?></div>
	<?php } ?> 

	<?php if(@$_GET["empty"]){ ?>
	    <div class="flashMsgRed"><?php echo $_GET["empty"]; ?></div>
	<?php } ?> 

	<form class="form-horizontal" action="../Controllers/SignupController.php" method="POST">

		<?php if(@$_GET["usertype"] == "addTeacher"){ ?>
			<h1><span class="multi-text">Add Teacher</span></h1><br><br>
			<div class="form-group row"> 
			<label class="col-sm-2 col-form-label col-form-label">User Type:</label>
			<div class="col-sm-8">
			<input class="form-control form-control" type="text" name="registertype" value="Teacher" readonly>
			<br>
			</div>
			</div>
		<?php } ?>

		<?php if(@$_GET["usertype"] == "addStudent"){ ?>
			<h1><span class="multi-text">Add Student</span></h1><br><br>
			<div class="form-group row"> 
			<label class="col-sm-2 col-form-label col-form-label">User Type:</label>
			<div class="col-sm-4">
			<input class="form-control form-control" type="text" name="registertype" value="Student" readonly>
			<br>
			</div>
		    </div>
		<?php } ?>

    <?php if(@$_GET["usertype"] == "addAdmin"){ ?>
      <h1><span class="multi-text">Add Admin</span></h1><br><br>
      <div class="form-group row"> 
      <label class="col-sm-2 col-form-label col-form-label">User Type:</label>
      <div class="col-sm-4">
      <input class="form-control form-control" type="text" name="registertype" value="Admin" readonly>
      <br>
      </div>
        </div>
    <?php } ?>

		<div class="form-group row"> 
		<label class="col-sm-2 col-form-label col-form-label">Username</label>
		<div class="col-sm-4">
	    <input class="form-control form-control" type="text" type="text" name="username" placeholder="Enter Username" required>
	    <br>
		</div>
		</div>

		<div class="form-group row"> 
		<label class="col-sm-2 col-form-label col-form-label">Email</label>
		<div class="col-sm-4">
	    <input class="form-control form-control" type="email" name="email" placeholder="Enter Email ID" required>
	    <br>
	    </div>
		</div>

		<div class="form-group row"> 
		<label class="col-sm-2 col-form-label col-form-label">Password</label>
		<div class="col-sm-4">
	    <input class="form-control form-control" type="text" name="password" placeholder="Enter Password" value=12345678 readonly>
	    <br>
	    </div>
		</div>

    <div class="form-group row"> 
    <label class="col-sm-2 col-form-label col-form-label">CNIC</label>
    <div class="col-sm-4">
      <input class="form-control form-control" type="text" name="cnic" placeholder="Enter Last 6 Digits of CNIC">
      <br>
      </div>
    </div>

    <div class="form-group row"> 
    <label class="col-sm-2 col-form-label col-form-label">Phone</label>
    <div class="col-sm-4">
      <input class="form-control form-control" type="text" name="phone" placeholder="Enter Phone">
      <br>
      </div>
    </div>

	  <input type="hidden" name="confirm-password" value=12345678>

		<input type="hidden" name="page" value="adminregister">

	    <button class="btn btn-info" name="register">Add User</button>

	</form>
	</div>

</body>
</html>
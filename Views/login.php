<!DOCTYPE html>
<html>
<head>
	<title>WebEng Project</title>
</head>
<body>

	<?php
		session_start();

		if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
			header("location: studentProfile.php");
		}

		if(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
			header("location: teacherProfile.php");
		}
	?>

	<h1>Login Form</h1>

	<?php
		if(@$_GET["notloggedin"] == true){
	?>
		<div style="color: red">You need to Login to Access that Page</div>
	<?php
		}
	?>

	<?php
		if(@$_GET["empty"] == true){
	?>
		<div style="color: red">Enter Values Before Submitting</div>
	<?php
		}
	?>

	<?php
		if(@$_GET["logoutbeforelogin"] == true){
	?>
		<div style="color: red">You need to Login before Logging Out!'</div>
	<?php
		}
	?>

	<?php
		if(@$_GET["invalidcreds"] == true){
	?>
		<div style="color: red">Invalid Credentials! Please Try Again</div>
	<?php
		}
	?>

	<label for="loginType">Login as:</label>
	<select name="loginType" form="loginForm">
	  <option value="student">Student</option>
	  <option value="teacher">Teacher</option>
	</select>
	<br><br>

	<form action="../Controllers/LoginController.php" id="loginForm" method="POST">
		<label>Email ID:</label>
		<input type="text" name="email" placeholder="yourname@example.com" required><br><br>

		<label>Password:</label>
		<input type="password" name="password" placeholder="Enter Password" required><br><br>

		<button name="login">Login</button><br><br>
	</form>
	
</body>
</html>
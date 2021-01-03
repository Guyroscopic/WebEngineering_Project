<!DOCTYPE html>
<html>
<head>
	<title>WebEng Project</title>
</head>
<body>

	<?php
		session_start();

		if(isset($_SESSION['login_user_email']) and isset($_SESSION['login_user_username'])){
			header("location: profile.php");
		}
	?>

	<h1>Login Form</h1>

	<?php
		if(@$_GET["Empty"] == true){
	?>
		<div><?php echo $_GET["Empty"]; ?></div>
	<?php
		}
	?>

	<?php
		if(@$_GET["Invalid"] == true){
	?>
		<div><?php echo $_GET["Invalid"]; ?></div>
	<?php
		}
	?>

	<form action="../Controllers/LoginController.php" method="POST">
		<label>Email ID:</label>
		<input type="text" name="email" placeholder="yourname@example.com" required><br><br>

		<label>Password:</label>
		<input type="password" name="password" placeholder="Enter Password" required><br><br>

		<button name="Login">Login</button><br><br>
	</form>
	
</body>
</html>
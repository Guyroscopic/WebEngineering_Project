<!DOCTYPE html>
<html>
<head>
	<title>WebEng Project</title>
</head>
<body>

	<?php
		//session_start();

		if(isset($_SESSION["message"]) and ){
			echo "<div class='invalid-login'>Invalid Credentials, Try again</div>";
		}
	?>

	<h1>Login Form</h1>

	<form action="../Controllers/LoginController.php" method="POST">
		<label>Email ID:</label>
		<input type="text" name="username" placeholder="yourname@example.com" required><br><br>

		<label>Password:</label>
		<input type="password" name="password" placeholder="Enter Password" required><br><br>

		<input type="submit" name="submit" value="Login"><br><br>
	</form>
	
</body>
</html>
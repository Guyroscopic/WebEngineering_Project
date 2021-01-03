<?php

	session_start();
	$email    = $_SESSION["login_user_email"];
	$username = $_SESSION["login_user_username"];

?>

<!DOCTYPE html>
<html>
<head>
	<title>WebEng Project</title>
</head>
<body>

	<?php
		if(isset($_SESSION['login_user_email']) and isset($_SESSION['login_user_username'])){
				
			echo "<h1>Welcome " . $username . "</h1>";
			echo "<h3>Welcome " . $email . "</h3>";
			echo "<a href='logout.php'>Logout</a>";
		}
		else{
			header("location: ../index.php?msg=Please Login in First");
		}
	?>

</body>
</html>
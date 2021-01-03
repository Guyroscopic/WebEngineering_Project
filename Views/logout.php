<?php
	
	session_start();

	if(isset($_SESSION['login_user_email']) and isset($_SESSION['login_user_username'])){
		session_destroy();
		header("location: ../index.php?msg= User Logged out successfully!");
	}
	else{
		header("location: ../index.php?msg= No User Currently Logged in");
	}
	

?>
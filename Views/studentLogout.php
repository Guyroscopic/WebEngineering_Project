<?php
	
	session_start();

	if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
		session_destroy();
		header("location: ../index.php?loggedout=true");
	}
	else{
		header("location: login.php?logoutbeforelogin=true");
	}	

?>
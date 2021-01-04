<?php
	
	session_start();

	if(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
		session_destroy();
		header("location: ../index.php?loggedout=true");
	}
	else{
		header("location: ../index.php?notloggedin=true");
	}
	

?>
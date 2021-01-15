<?php
	
	session_start();

	if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
		session_destroy();
		header("location: ../index.php?loggedout=true");
	}
	else{
		header("location: adminLogin.php?logoutbeforelogin=true");	
	}

?>
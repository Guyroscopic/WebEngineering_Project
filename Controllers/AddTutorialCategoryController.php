<?php

	/* Initialize Session */
	session_start();
	
	/* Redirecting to Profile Page if user is Already Logged In */
	if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
		//pass
	}
	/* Redirecting to Profile Page if user is Already Logged In */
	elseif(isset($_SESSION["current_student_email"]) and isset($_SESSION["current_student_username"])){
		header("location: ../Views/studentProfile.php?invalidAccess=true");
	}
	elseif(isset($_SESSION["current_teacher_email"]) and isset($_SESSION["current_teacher_username"])){
		header("location: ../Views/teacherProfile.php?invalidAccess=true");
	}
	else{
		header("location: ../Views/adminLogin.php?notloggedin=true");
	}

	//Adding the required Models
	require_once "../Models/TutorialCategoryModel.php";

	//Checking button click
	if(isset($_POST["add"])){

		//Sanitizing the input
		$name = mysqli_real_escape_string($database_connection, stripslashes($_POST["categoryName"]));

		addTutorialCategory($name);

		//Closing database connection
		mysqli_close($database_connection);

		//Rediecting
		header("location: ../Views/tutorialCategoryTable.php?added=true");
	}
?>
<?php
	//Checking if Teacher is logged in or not
	session_start();

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){
		//pass			
	}
	elseif(isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])){
		header("location: studentProfile.php?invalidAcess=ture");
	}
	elseif(isset($_SESSION['admin_email']) && isset($_SESSION['admin_username'])){
		header("location: adminPanel.php?invalidAcess=ture");
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	//Adding the Required Models
	require_once "../Models/TutorialModel.php";

	if(isset($_POST["delete"])){

		$id = stripcslashes($_POST["tutorial_id"]);

		deleteTutorial($id);

		//Closing the DB connection
		mysqli_close($database_connection);

		//Redirecting
		header("location: ../Views/publishedTutorials.php?deleted=true");
	}
?>
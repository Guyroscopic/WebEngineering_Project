<?php
	//Checking if Student is logged in or not
	session_start();

	if(isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
		
		$student_email    = $_SESSION["current_student_email"];
		$student_username = $_SESSION["current_student_username"];
	}
	else{
		header("location: ../Views/teacherProfile.php?invalidAccess=true");
	}

	//Adding the required Models
	require_once "../Models/StudentTutorialBridgeModel.php";

	//Checking button click
	if(isset($_POST["completed"])){
		
		$tutorial_id   = $_POST["tutorial_id"];
		$rating        = $_POST["rating"];
		$student_email = $_POST["student_email"];

		//Marking the tutorial complete for student in the DB
		markTutorialCompleteForStudent($student_email, $tutorial_id, $rating);

		//Closing the Database connection		
		global $database_connnectiton;
		$database_connection->close();

		//Redirecting to view all tutorial page
		header("location: ../Views/allTutorials.php?completed=true");

	}
	else{
		//Closing the Database connection		
		global $database_connnectiton;
		$database_connection->close();

		//Redirecting
		header("location: ../Views/studentProfile.php?invalidAccess=true");
	}

?>
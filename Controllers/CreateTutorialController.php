<?php
	
	/* Initialize Session */
	session_start();

	//Applying Login Check
	if(!isset($_SESSION["current_teacher_email"]) || !isset($_SESSION["current_teacher_username"])){
		header("location: ../Views/login.php?notloggedin=true");
	}
	else{
		$current_teacher_email    = $_SESSION["current_teacher_email"];
		$current_teacher_username = $_SESSION["current_teacher_username"];
	}

	//Adding the required Models
	require_once "../Models/TutorialModel.php";
	require_once "../Models/ParagraphModel.php";

	//Handling the Form Submission
	if(isset($_POST["create"])){

		$title 			   = $_POST["title"];
		$tutrialCategoryID = $_POST["tutorialCategory"];
		$numOfParagrphs    = $_POST["numOfParagraphs"];
		$instructor        = $current_teacher_email;

		//Checking for empty submissions before processing
		if(empty($title)){
			header("location: ../Views/createTutorial.php?empty=true");
		}

		for($i=1; $i<=$numOfParagrphs; $i++){

			$heading_name = "heading_" . $i;
			$content_name = "content_" . $i;

			$heading      = $_POST[$heading_name];
			$content      = $_POST[$content_name];

			if(empty($heading) || empty($content)){
				header("location: ../Views/createTutorial.php?empty=true");
			}
		}

		//Creating a Tutorial in the Database
		$tutorialID  = addTutorial($tutrialCategoryID, $instructor, $title);
		echo "Tutorial ID: " . $tutorialID . "<br>";
		//echo "Title: " . $title . "<br>" . "Category: " . $tutrialCategory . "<br>"; 
		
		for($i=1; $i<=$numOfParagrphs; $i++){

			$heading_name = "heading_" . $i;
			$content_name = "content_" . $i;

			$heading      = $_POST[$heading_name];
			$content      = $_POST[$content_name];
			
			echo "<br>Heading: " . $heading . "<br>" . "Content: " . $content . "<br>";
			addParagraph($tutorialID, $heading, $content);
		}

		//Closing the DB Connection
		mysqli_close($database_connection);

		header("location: ../Views/teacherProfile.php?created=true");
	}
	else{
		//Redirecting incase of invalid access through URL
		header("location: ../Views/createTutorial.php");
		mysqli_close($database_connection);
	}
?>
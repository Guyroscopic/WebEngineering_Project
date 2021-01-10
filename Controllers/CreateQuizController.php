<?php
	
	/* Initialize Session */
	session_start();

	//Applying Login Check
	if(!isset($_SESSION["current_teacher_email"]) || !isset($_SESSION["current_teacher_username"])){
		header("location: ../Views/login.php?notloggedin=true");
	}

	//If an unauthorized user(student) tries to access the page
	elseif(isset($_SESSION["current_student_email"]) and isset($_SESSION["current_student_username"])){
		echo "Acces Denied";
	}

	else{
		$current_teacher_email    = $_SESSION["current_teacher_email"];
		$current_teacher_username = $_SESSION["current_teacher_username"];
	}


	//Adding the required Models
	require_once "../Models/QuizModel.php";

	//Handling the Form Submission
	if(isset($_POST["create"])){

		$num_of_questions = $_POST["numOfQuestions"];
		$tutorial_id	  = $_POST["tutorialId"];

		// creating quiz
		$quiz_id		  = addQuiz($tutorial_id);

		// adding questions to quiz
		for($i=1; $i<=$num_of_questions; $i++){

			$question_statement = "question".$i;
			$question           = $_POST[$question_statement];

			$option1 = $_POST["option1"];
			$option2 = $_POST["option2"];
			$option3 = $_POST["option3"];
			$option4 = $_POST["option4"];

			if(empty($question) || empty($option1) || empty($option2)){
				header("location: ../Views/createQuiz.php?empty=true");
			}

			// calling addQuestions function to add questions to database
			addQuestions($quiz_id, $question, $option1, $option2, $option3, $option4);
		}

		//Closing the DB Connection
		mysqli_close($database_connection);
		header("location: ../Views/teacherProfile.php?quizCreated=true");	
	}

	else{
		header("location: ../Views/createQuiz.php?error=true");
	}
?>
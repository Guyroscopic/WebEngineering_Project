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

		$num_of_questions = stripslashes($_POST["numOfQuestions"]);
		$tutorial_id	  = stripslashes($_POST["tutorialId"]);
		$quiz_topic		  = stripslashes($_POST["quiz_topic"]);
		// creating quiz
		$quiz_id		  = addQuiz($tutorial_id, $quiz_topic);

		// adding questions to quiz
		for($i=1; $i<=$num_of_questions; $i++){

			// defining the variables to index the global POST array 
			$question_statement = "question".$i;
			$q_option_1			= "question".$i."_option1";
			$q_option_2 		= "question".$i."_option2";
			$q_option_3			= "question".$i."_option3";
			$q_option_4			= "question".$i."_option4";
			$q_correct_answer	= "question".$i."_correct_answer";

			// retrieving the quiz question data frorm POST
			$quizTopic = stripslashes($_POST["quiz_topic"]);
			$question  = stripslashes($_POST[$question_statement]);
			$option1   = stripslashes($_POST[$q_option_1]);
			$option2   = stripslashes($_POST[$q_option_2]);
			$option3   = stripslashes($_POST[$q_option_3]);
			$option4   = stripslashes($_POST[$q_option_4]);
			$correct_answer_post = stripslashes($_POST[$q_correct_answer]);

			// if the teacher doesnt provide the correct answer
			if(!$correct_answer_post){
				mysqli_close($database_connection);
				header("location: ../Views/createQuiz.php?Empty=true");
				exit();
			}

			// else retrieving the correct answer
			$correct_answer = stripslashes($_POST[$correct_answer]);

			// checking for empty fields
			if(empty($question) || empty($option1) || empty($option2) || empty($correct_answer_post)){
				mysqli_close($database_connection);
				header("location: ../Views/createQuiz.php?Empty=true");
			}

			if($correct_answer_post == $option3 && empty($option3)){
				mysqli_close($database_connection);
				header("location: ../Views/createQuiz.php?Empty=true");
			}

			if($correct_answer_post == $option4 && empty($option4)){
				mysqli_close($database_connection);
				header("location: ../Views/createQuiz.php?Empty=true");
			}
			// calling addQuestions function to add questions to database
			addQuestions($quiz_id, $question, $option1, $option2, $option3, $option4, $correct_answer);
		}

		//Closing the DB Connection
		mysqli_close($database_connection);
		header("location: ../Views/teacherProfile.php?quizCreated=true");	
	}

	else{
		mysqli_close($database_connection);
		header("location: ../Views/createQuiz.php?Error=true");
	}
?>
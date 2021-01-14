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
	require_once "../Models/QuizQuestionModel.php";
	require_once "../Models/QuizModel.php";

	//Handling the Form Submission
	if(isset($_POST["update"])){

		$num_of_questions     = (int)$_POST["num_of_questions"];
		$new_num_of_questions = (int)$_POST["new_num_of_questions"];
		$quizId               = $_POST["quiz_id"];

		$total_qs = $num_of_questions + $new_num_of_questions;

		if(isset($_POST["new_num_of_questions"])){
			$new_num_of_questions = $num_of_questions;
		}

		// adding questions to quiz
		for($i=1; $i<=$new_num_of_questions; $i++){

			$question_statement = "question".$i;
			$q_option_1			= "question".$i."_option1";
			$q_option_2 		= "question".$i."_option2";
			$q_option_3			= "question".$i."_option3";
			$q_option_4			= "question".$i."_option4";
			$q_correct_answer	= "question".$i."_correct_answer";

			$question  = $_POST[$question_statement];
			$option1   = $_POST[$q_option_1];
			$option2   = $_POST[$q_option_2];


			if(!empty($_POST[$q_option_3])){
				$option3 = $_POST[$q_option_3];
			}
			else{
				$option3 = "";
			}
			if(!empty($_POST[$q_option_4])){
				$option4   = $_POST[$q_option_4];
			}
			else{
				$option4 = "";
			}

			$correct_answer = $_POST[$q_correct_answer];

			if(empty($question) || empty($option1) || empty($option2) || empty($correct_answer)){
				header("location: ../Views/teacherProfile.php?Empty=true");
			}

			if($i > $num_of_questions){
				// calling addQuestions function to add questions to database
				addQuestions($quizId, $question, $option1, $option2, $option3, $option4, $correct_answer);
			}

			elseif($i <= $num_of_questions){
			// calling addQuestions function to add questions to database
			$updateQuiz = updateQuiz($quizId, $question, $option1, $option2, $option3, $option4, $correct_answer);}
			}
		
		header("location: ../Views/quiz.php?id='$quizId'");
		//Closing the DB Connection
		mysqli_close($database_connection);	
	}

	else{
		header("location: ../Views/editQuiz.php?Error=true");
		//echo "Unknown Error";
	}
?>
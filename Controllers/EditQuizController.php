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

		if($new_num_of_questions == 0){
			$total_qs = $num_of_questions;
		}
		else{
			$total_qs = $new_num_of_questions;
		}

		// adding questions to quiz
		for($i=1; $i<=$total_qs; $i++){

			// defining the variables to index the global POST array
			$question_statement = "question".$i;
			$q_option_1			= "question".$i."_option1";
			$q_option_2 		= "question".$i."_option2";
			$q_option_3			= "question".$i."_option3";
			$q_option_4			= "question".$i."_option4";
			$q_correct_answer	= "question".$i."_correct_answer";
			$q_question_id        = "question".$i."_id";

			// retrieving the quiz question data frorm POST
			$question  = stripslashes($_POST[$question_statement]);
			$option1   = stripslashes($_POST[$q_option_1]);
			$option2   = stripslashes($_POST[$q_option_2]);

			// checking for empty and non empty fields
			if(!empty($_POST[$q_option_3])){
				$option3 = stripslashes($_POST[$q_option_3]);
			}
			else{
				$option3 = "";
			}
			if(!empty($_POST[$q_option_4])){
				$option4   = stripslashes($_POST[$q_option_4]);
			}
			else{
				$option4 = "";
			} 

			// retrieving the correct answer
			$select_correct_answer = stripslashes($_POST[$q_correct_answer]);
			if(empty($select_correct_answer)){
				header("location: ../Views/editQuiz.php?empty=Select The Correct Answer&quiz_id=".$quizId);
				exit();
			}
			
			$correct_answer = stripslashes($_POST[$select_correct_answer]);

			if($correct_answer == $option3 && empty($option3)){
				mysqli_close($database_connection);
				header("location: ../Views/editQuiz.php?empty=Invalid Option Selected&quiz_id=".$quizId);
				exit();
			}

			if($correct_answer == $option4 && empty($option4)){
				mysqli_close($database_connection);
				header("location: ../Views/editQuiz.php?empty=Invalid Option Selected&quiz_id=".$quizId);
				exit();
			}
			// checking for empty and non empty fields
			if(empty($question) || empty($option1) || empty($option2) || empty($correct_answer)){

				if(empty($question))
					header("location: ../Views/editQuiz.php?empty=You Left The Question Field Empty&quiz_id=".$quizId);
				elseif(empty($option1))
					header("location: ../Views/editQuiz.php?empty=You Left The Option 1 Empty&quiz_id=".$quizId);
				elseif(empty($option2))
					header("location: ../Views/editQuiz.php?empty=You Left The Option 2 Empty&quiz_id=".$quizId);
				elseif(empty($correct_answer))
					header("location: ../Views/editQuiz.php?empty=You Left The Correct Answer Field Empty&quiz_id=".$quizId);
				exit();
			}

			// if a new question has been added to quiz, Add it to database
			if($i > $num_of_questions){
				// calling addQuestions function to add questions to database
				addQuestions($quizId, $question, $option1, $option2, $option3, $option4, $correct_answer);
			}

			// if a previous question has been edited,update it
			elseif($i <= $num_of_questions){
				$question_id = stripslashes($_POST[$q_question_id]);
				// calling addQuestions function to add questions to database
				$updateQuiz = updateQuiz($question_id, $question, $option1, $option2, $option3, $option4, $correct_answer);}
		}

		//Closing the DB Connection
		mysqli_close($database_connection);	
		header("location: ../Views/quiz.php?id=".$quizId);	
	}

	else{

		//Closing the DB Connection
		mysqli_close($database_connection);	
		header("location: ../Views/editQuiz.php?error=An Error Occured&quiz_id=".$quizId);
	}
?>
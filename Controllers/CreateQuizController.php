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
		$quiz_created 	  = false;

		if(empty($quiz_topic)){
			header("location: ../Views/createQuiz.php?empty=Quiz Topic is Empty&tutorial_id=".$tutorial_id);
			exit();
		}

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
			if(empty($correct_answer_post)){
				header("location: ../Views/createQuiz.php?empty=Select The Correct Answer&tutorial_id=".$tutorial_id);
				exit();
			}

			// else retrieving the correct answer
			$correct_answer = stripslashes($_POST[$correct_answer_post]);

			if(empty($question) || empty($option1) || empty($option2) || empty($correct_answer)){

				if(empty($question))
					header("location: ../Views/createQuiz.php?empty=One of the Question is Empty&tutorial_id=".$tutorial_id);
				elseif(empty($option1))
					header("location: ../Views/createQuiz.php?empty=Option 1 is Empty&tutorial_id=".$tutorial_id);
				elseif(empty($option2))
					header("location: ../Views/createQuiz.php?empty=Option 2 is Empty&tutorial_id=".$tutorial_id);
				elseif(empty($correct_answer))
					header("location: ../Views/createQuiz.php?empty=Answer Field is Empty&tutorial_id=".$tutorial_id);
					exit();
			}

			if($correct_answer == $option3 && empty($option3)){
				mysqli_close($database_connection);
				header("location: ../Views/createQuiz.php?empty=Invalid Option Selected&tutorial_id=".$tutorial_id);
				exit();
			}

			if($correct_answer == $option4 && empty($option4)){
				mysqli_close($database_connection);
				header("location: ../Views/createQuiz.php?empty=Invalid Option Selected&tutorial_id=".$tutorial_id);
				exit();
			}

			if(!$quiz_created){
				// creating quiz
				$quiz_id = addQuiz($tutorial_id, $quiz_topic);
				$quiz_created = true;
			}
			// calling addQuestions function to add questions to database
			addQuestions($quiz_id, $question, $option1, $option2, $option3, $option4, $correct_answer);
		}

		//Closing the DB Connection
		mysqli_close($database_connection);
		header("location: ../Views/viewQuiz.php?quizCreated=Quiz Created Successfully&id=".$tutorial_id);	
	}

	else{
		mysqli_close($database_connection);
		header("location: ../Views/createQuiz.php?error=An Unknown Error Occured&tutorial_id=".$tutorial_id);
	}
?>
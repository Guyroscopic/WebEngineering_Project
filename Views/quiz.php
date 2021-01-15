<?php	
	//Checking if Teacher or Student is logged in or not
	session_start();

	$teacher_loggedin  = false;
	$student_loggedin  = false;

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$teacher_email     = $_SESSION["current_teacher_email"];
		$teacher_username  = $_SESSION["current_teacher_username"];
		$teacher_loggedin  = true;
			
	}
	elseif (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
		
		$student_email     = $_SESSION["current_student_email"];
		$student_username  = $_SESSION["current_student_username"];
		$student_loggedin  = true;
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	//Adding the required Models
	require_once "../Models/QuizModel.php";
	require_once "../Models/QuizQuestionModel.php";
	require_once "../Models/StudentQuizBridgeModel.php";

	//Extracting Quiz ID from URL and fetching the respective Quiz and Its Questions
	$quiz_id 		  = $_GET["id"];
	// Initializing the score of student as negative value, implying student has
	// not score any number yet
	$score 			  = -1;

	// Retrieving the tutorial id using the quiz id
	$tutorial_id_array= getTutorialByQuizId($quiz_id);
	$tutorial_id      = $tutorial_id_array["tutorial_id"];

	// Using the Quiz Model to load the quiz content including questions
	$quiz 	 		  = getQuizById($quiz_id);
	$quiz_question    = getQuizQuestionById($quiz_id);

	// If no questions have been added to the quiz
	if(mysqli_num_rows($quiz_question) == 0){
			echo "No Questions In This Quiz";
			exit();
	}

	//Fetching the score of previous attempt by student if any
	$quiz_score_query_result = getStudentQuizScore($student_email, $quiz_id);
	if(mysqli_num_rows($quiz_score_query_result) > 0){

		$quiz_score_array	= mysqli_fetch_array($quiz_score_query_result);
		$score 				= $quiz_score_array["quiz_score"];
	}

	//Fetcing the info of logged in teacher and all of his created Quizzes
	if($teacher_loggedin){
		$current_teacher_quiz = getAllQuizzesByEmail($teacher_email, $quiz_id);
	}

	//Checking if this is the logged in instructor's own tutorial
	$match = 0;
	if($teacher_loggedin){
		while($row = mysqli_fetch_assoc($current_teacher_quiz)){

			//echo "Tuorial ID: " . $tutorial["id"] . "<br>";
			if($row["quiz_id"] == $quiz_id){
				$match += 1;
			}
		}
	}


	$quiz_title = $quiz["topic"];
	$quiz_question_list = "";
	$quiz_form			= "";
	$question_num 		= 0;
	
	//Closing the DB Connection
	$database_connection->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Web Project</title>
</head>
<body>

	<!-- Displaying Quiz Information -->
	<h1><?php echo $quiz_title; ?></h1>

	<!-- Displaying The Quiz Content -->
	<?php

		if($teacher_loggedin){

			// If the teacher is logged in and he has created the respective tutorial
			// He can edit the respective quiz
			if($match > 0){

			// showing edit quiz button to quiz creator
			echo "<form name='EditQuizForm' method='POST' action='editQuiz.php'>
					<button type='submit' name='editQuiz'>Edit Quiz</button>
					<input type='hidden' value='". $quiz_id . "' name='quiz_id'>
				  </form>";
			}

			//displaying quiz
			$quiz_question_list .= "<ol>";
			while($question = mysqli_fetch_assoc($quiz_question)){

				//fetching the quiz content
				$statement 		 = $question["statement"];
				$option1   		 = $question["option1"];
				$option2   		 = $question["option2"];
				$option3   		 = $question["option3"];
				$option4   		 = $question["option4"];
				$correct_option  = $question["correct_option"];

				$quiz_question_list .= "<li>" . $statement .
					 				   "<ul><li>" . $option1 . "</li><li>" . $option2 . "</li>";

				if($option3){
					$quiz_question_list .= "<li>" . $option3 . "</li>";	
				}
				if($option4){
					$quiz_question_list .= "<li>" . $option4 . "</li>";
				}
				$quiz_question_list .= "</ul>";

				$quiz_question_list .= "<b>Correct Answer: " . $correct_option . "</b><br><br>";
			}
			
			
			$quiz_question_list .= "</ol>";
			echo $quiz_question_list;
		}

		if($student_loggedin){

			// if the student is logged in, he is able to attempt the quiz
			$quiz_form .= "<form name='attemptQuiz' action='result.php' method='POST'>";
			$quiz_form .= "<ol>";

			while($question = mysqli_fetch_assoc($quiz_question)){

				$question_num += 1;

				$statement 		 = $question["statement"];
				$option1   		 = $question["option1"];
				$option2   		 = $question["option2"];
				$option3   		 = $question["option3"];
				$option4   		 = $question["option4"];
				$correct_option  = $question["correct_option"];

				$quiz_form .= "<li>". $statement;


				$quiz_form .= "<br><input type='radio' name='". $question_num. "_option1' value='".
				               $option1 . "'><label>" . $option1 . "</label><br>";

				$quiz_form .= "<input type='radio' name='". $question_num. "_option2' value='". 
							   $option2 . "'><label>" . $option2 . "</label><br>";

				if($option3){
					$quiz_form .= "<input type='radio' name='". $question_num. "' value='". $option3."'><label>".$option3."</label><br>";
				}
				if($option4){
					$quiz_form .= "<input type='radio' name='". $question_num. "' value='". $option4."'><label>".$option4."</label></li><br>";
				}

				$quiz_form .= "<input type='hidden' name='". $question_num ."_answer' value='". $correct_option . "'>"; 

			}
			$quiz_form .= "<input type='hidden' value='". $quiz_id ."' name='quiz_id'>";
			$quiz_form .= "<input type='hidden' value='". $question_num ."' name='num_of_question'>";
			$quiz_form .= "<button type='submit' name='showresult'>Show Quiz Result</button>";
			$quiz_form .= "</form>";

			// if the student has already attempted the quiz before, displpaying his previous best score
			if($score >= 0){
				echo "<p style='color:green'>Your Best Score For This Quiz Has Been: " . $score . " out of " . $question_num ."</p>";
			}
			echo $quiz_form;			
		}

	?>

</body>
</html>
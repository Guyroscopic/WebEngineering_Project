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

	//Extracting Quiz ID from URL and fetching the respective Quiz and Its Questions
	$quiz_id 		  = $_GET["id"];

	$quiz 	 		  = getQuizById($quiz_id);
	$quiz_question    = getQuizQuestionById($quiz_id);

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

	$quiz_title = $quiz["Topic"];
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

			if($match > 0){
			echo "<form name='EditQuizForm' method='POST' action='editQuiz.php'>
				<button type='submit' name='editQuiz'>Edit Quiz</button>
				<input type='hidden' value='". $quiz_id ."' name='quiz_id'>
			</form>";
		}

			$quiz_question_list .= "<ol>";
			while($question = mysqli_fetch_assoc($quiz_question)){

				$statement 		 = $question["statement"];
				$option1   		 = $question["option1"];
				$option2   		 = $question["option2"];
				$option3   		 = $question["option3"];
				$option4   		 = $question["option4"];
				$correct_option  = $question["correct_option"];

				$quiz_question_list .= "<li>".$statement.
					 "<ul><li>".$option1."</li><li>".$option2."</li>";

				if($option3){
					$quiz_question_list .= "<li>".$option3."</li>";	
				}
				if($option4){
					$quiz_question_list .= "<li>".$option4."</li>";
				}
				$quiz_question_list .= "</ul>";
				$quiz_question_list .= "Correct Answer: ".$correct_option;
			}
			
			$quiz_question_list .= "</ol>";
			echo $quiz_question_list;
		}

		if($student_loggedin){

			$quiz_form .= "<form action='checkQuiz.php'>";
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

				$quiz_form .= "<br><input type='radio' name='". $question_num. "_option1' value='". $option1."'><label>".$option1."</label><br>";
				$quiz_form .= "<input type='radio' name='". $question_num. "_option2' value='". $option2."'><label>".$option2."</label><br>";

				if($option3){
					$quiz_form .= "<input type='radio' name='". $question_num. "_option3' value='". $option3."'><label>".$option3."</label><br>";
				}
				if($option4){
					$quiz_form .= "<input type='radio' name='". $question_num. "_option4' value='". $option4."'><label>".$option4."</label></li><br>";
				}

			}

			$quiz_form .= "<input type='submit' value='Submit'>";
			$quiz_form .= "</form>";

			echo $quiz_form;
		}

	?>

</body>
</html>
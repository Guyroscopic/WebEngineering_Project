<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php

	session_start();

	if (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
		
		$student_email     = $_SESSION["current_student_email"];
		$student_username  = $_SESSION["current_student_username"];
	}

	include "../Models/QuizQuestionModel.php";
	include '../Models/QuizModel.php';
	include '../Models/StudentQuizBridgeModel.php';


	if(isset($_POST["num_of_question"])){
	
		// retrieving values
		$score			 = 0;
		$num_of_question = $_POST["num_of_question"];
		$quiz_id 		 = $_POST["quiz_id"];

		$tutorial_id_query = getTutorialByQuizId($quiz_id);
		$tutorial_id = $tutorial_id_query["tutorial_id"];

		// fetching quiz questions from database
		$quiz_question = getQuizQuestionById($quiz_id);
		//initializing the question count for the quiz
		$question_num  = 0;

		// creating result form
		$result_form = "<form name='quizresult'>";
		$result_form .= "<ol>";

		while($question = mysqli_fetch_assoc($quiz_question)){

				$question_num += 1;

				$selected_option = $_POST[$question_num];
				$correct_answer	 = $_POST[$question_num ."_answer"];

				if($selected_option == $correct_answer){
					$score++ ;
				}

				$statement 		 = $question["statement"];
				$options 		 = array($question["option1"], $question["option2"], $question["option3"], $question["option4"]);
				$correct_option  = $question["correct_option"];

				$result_form .= "<li>". $statement;
				foreach ($options as $option) {
						
						if($option){
							if($option == $selected_option){

								if($selected_option != $correct_option){
									$result_form .= "<br><input type='radio' name='". $question_num. "' value='". $option."' checked='checked' disabled><label style='color:red'>".$option."</label>";
								}
								elseif($selected_option == $correct_option){
								$result_form .= "<br><input type='radio' name='". $question_num. "' value='". $option."' checked='checked' disabled><label style='color:green'>".$option."</label>";
							}
							}
							else{
								$result_form .= "<br><input type='radio' name='". $question_num. "' value='". $option."'  disabled><label>".$option."</label>";
							}
						
					}	}		
				}

				$quiz_score_query_result = getStudentQuizScore($student_email, $quiz_id);
				
				// storing the score of student in database
				if(mysqli_num_rows($quiz_score_query_result)){
					$quiz_score_array		 = mysqli_fetch_array($quiz_score_query_result);
					$previous_score 		 = $quiz_score_array["quiz_score"];
					if($previous_score < $score){
						updateStudentQuizScore($student_email, $quiz_id, $score);
					}
				}
				else{
					insertStudentQuizScore($student_email, $quiz_id, $score);
				}

				$result_form .= "</ol></form>";
				echo "<h4>You Scored". $score . "/". $num_of_question ."</h4>";
				echo $result_form;	
				echo "<form action='viewQuiz.php' method='POST'><button type='submit' name='backbutton'>Go Back To Quizzes</button><input type='hidden' value='".$tutorial_id."' name='tutorial_id'></form>";
				echo "<a href='quiz.php?id=".$quiz_id."'>Attempt Again</a>";

}


				
				/*$result_form .= "<input type='radio' name='". $question_num. "' value='". $option2."'><label>".$option2."</label><br>";

				if($option3){
					$result_form .= "<input type='radio' name='". $question_num. "' value='". $option3."'><label>".$option3."</label><br>";
				}
				if($option4){
					$result_form .= "<input type='radio' name='". $question_num. "' value='". $option4."'><label>".$option4."</label></li><br>";*/

				//$result_form .= "<input type='hidden' name='". $question_num ."_answer' value='". $correct_option . "'>"; 

			

			//$result_form .= "<input type='hidden' value='". $question_num ."' name='num_of_question'>";
			//$result_form .= "<button type='submit' name='showresult'>Show Quiz Result</button>";
			
			//header("location: quiz.php?score=$score");
		?>
</body>
</html>

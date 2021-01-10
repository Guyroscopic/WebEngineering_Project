<?php
	
	include_once "../Models/QuizModel.php";
	if(isset($_POST["viewQuiz"])){

		$tutorial_id = $_POST["tutorial_id"];
		
		$quiz_details = getQuiz($tutorial_id);

		echo $quiz_details["statement"];
		echo $quiz_details["option1"];		
	}
	
?>
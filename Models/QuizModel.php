<?php

	require_once "DBconfig.php";

	function addQuiz($tutorial_id){

		global $database_connection;

		// executing the query to create a quiz
		$sql_query = "INSERT INTO `quiz`(`tutorial_id`) VALUES ('$tutorial_id')";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		if (!$sql_query_execute) {
		    printf("Quiz Error: %s\n", mysqli_error($database_connection));
		    exit();
		}
		$quiz_id =  mysqli_insert_id($database_connection);

		return $quiz_id;
	}

	function addQuestions($quiz_id, $questionStatement, $option1, $option2, $option3, $option4){

		global $database_connection;

		// adding questions to a quiz

		$sql_query = "INSERT INTO `question`(`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`) VALUES ('$quiz_id', '$questionStatement', '$option1', '$option2', '$option3','$option4')";

		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		//if (!$sql_query_execute) {
		//    printf("Q Error: %s\n", mysqli_error($database_connection));
		//    exit();
		}
	

	function getQuiz($tutorial_id){

		global $database_connection;

		$sql_query = "SELECT * FROM question
					LEFT JOIN quiz ON question.quiz_id = quiz.id
					LEFT JOIN tutorial ON 
					quiz.tutorial_id = '$tutorial_id'";


		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}
		$result = mysqli_fetch_array($sql_query_execute);
		return $result;
	}


	function getAllQuizzes($email){

		global $database_connection;

		$sql_query = "SELECT * FROM quiz RIGHT JOIN
					 tutorial WHERE quiz.tutorial_id = tutorial.id AND instructor = '$email'";

		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		$result = mysqli_fetch_array($sql_query_execute);

		return $result;
	}


?>
<?php

	require_once "DBconfig.php";

	function addQuiz($tutorial_id, $quiz_topic){

		global $database_connection;

		// executing the query to create a quiz
		$sql_query = "INSERT INTO `quiz`(`tutorial_id`, `Topic`) VALUES ('$tutorial_id', '$quiz_topic')";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		if (!$sql_query_execute) {
		    printf("Quiz Error: %s\n", mysqli_error($database_connection));
		    exit();
		}
		$quiz_id =  mysqli_insert_id($database_connection);

		return $quiz_id;
	}

	function addQuestions($quiz_id, $questionStatement, $option1, $option2, $option3, $option4, $correct_option){

		global $database_connection;

		// adding questions to a quiz

		$sql_query = "INSERT INTO `question`(`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`) VALUES ('$quiz_id', '$questionStatement', '$option1', '$option2', '$option3','$option4', '$correct_option')";

		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		//if (!$sql_query_execute) {
		//    printf("Q Error: %s\n", mysqli_error($database_connection));
		//    exit();
		return $sql_query_execute;
		}
	

	function getQuizByTutorialID($tutorial_id){

		global $database_connection;

		$sql_query = "SELECT Topic, id FROM quiz WHERE tutorial_id='$tutorial_id'";


		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}
		//$result = mysqli_fetch_assoc($sql_query_execute);
		return $sql_query_execute;
	}


	function getAllQuizzesByEmail($email,$quiz_id){

		global $database_connection;

		$sql_query = "SELECT quiz.id quiz_id, tutorial.id tutorial_id FROM quiz INNER JOIN tutorial on quiz.tutorial_id=tutorial.id WHERE instructor='$email' and quiz.id='$quiz_id'";

		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}

		return $sql_query_execute;
	}

	function getAllQuizzes(){

		global $database_connection;

		$sql_query = "SELECT Topic FROM quiz";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}

		$result = mysqli_fetch_array($sql_query_execute);
		return $result;
	}

	function getQuizById($quiz_id){

		global $database_connection;

		$sql_query = "SELECT * FROM `quiz` WHERE `id`='$quiz_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		$quiz = mysqli_fetch_array($sql_query_execute);

		return $quiz;

	}

	function getTutorialByQuizId($quiz_id){

		global $database_connection;

		$sql_query = "SELECT `tutorial_id` FROM `quiz` WHERE `id`='$quiz_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		$tutorial_id = mysqli_fetch_array($sql_query_execute);

		return $tutorial_id;
	}

?>
<?php

	require_once "DBconfig.php";

	function addQuiz($tutorial_id, $quiz_topic){

		/* This function adds a new quiz to database */

		global $database_connection;

		// executing the query to create a quiz
		$sql_query = "INSERT INTO `quiz`(`tutorial_id`, `topic`) VALUES ('$tutorial_id', '$quiz_topic')";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		/*if (!$sql_query_execute) {
		    printf("Quiz Error: %s\n", mysqli_error($database_connection));
		    exit();
		}*/
		$quiz_id =  mysqli_insert_id($database_connection);

		return $quiz_id;
	}

	function addQuestions($quiz_id, $questionStatement, $option1, $option2, $option3, $option4, $correct_option){

		/* This function adds new questions to database */

		global $database_connection;

		// adding questions to a quiz

		$sql_query = "INSERT INTO `question`(`quiz_id`, `statement`, `option1`, `option2`, `option3`, `option4`, `correct_option`) VALUES ('$quiz_id', '$questionStatement', '$option1', '$option2', '$option3','$option4', '$correct_option')";

		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}
		//if (!$sql_query_execute) {
		//    printf("Q Error: %s\n", mysqli_error($database_connection));
		//    exit();
		}
	

	function getQuizByTutorialID($tutorial_id){

		/* This function retrieves quiz using tutorial id */

		global $database_connection;

		$sql_query = "SELECT topic, id FROM quiz WHERE tutorial_id='$tutorial_id'";


		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}
		//$result = mysqli_fetch_assoc($sql_query_execute);
		return $sql_query_execute;
	}

	function getQuizByTutorialIDesc($tutorial_id){

		/* This function retrieves quiz using tutorial id */

		global $database_connection;

		$sql_query = "SELECT topic, id FROM quiz WHERE tutorial_id='$tutorial_id' ORDER BY id DESC;";


		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}
		//$result = mysqli_fetch_assoc($sql_query_execute);
		return $sql_query_execute;
	}


	function getAllQuizzesByEmail($email,$quiz_id){

		/* This function retrieves quiz using user email and quiz id */		

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

		/* This function retrieves all quizzes from database */

		global $database_connection;

		$sql_query = "SELECT topic FROM quiz";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}

		$result = mysqli_fetch_array($sql_query_execute);
		return $result;
	}

	function getQuizById($quiz_id){

		/* This function retrieves quiz using quiz id */

		global $database_connection;

		$sql_query = "SELECT * FROM `quiz` WHERE `id`='$quiz_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}
		$quiz = mysqli_fetch_array($sql_query_execute);

		return $quiz;
 
	}

	function getTutorialByQuizId($quiz_id){

		/* This function retrieves tutorial id using quiz id from quiz table*/

		global $database_connection;

		$sql_query = "SELECT `tutorial_id` FROM `quiz` WHERE `id`='$quiz_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}
		$tutorial_id = mysqli_fetch_array($sql_query_execute);

		return $tutorial_id;
	}

	function getQuizTable(){

		global $database_connection;

		$sql_query         = "SELECT * FROM quiz";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
	}

	function deleteQuiz($id){

		global $database_connection;

		$sql_query         = "DELETE FROM quiz WHERE id='$id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Q Error: %s\n", mysqli_error($database_connection));
		    exit();
		}

		return $sql_query_execute;		
	}

?>
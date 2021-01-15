<?php

	require_once "DBconfig.php";

	function  getQuizQuestionById($quiz_id){

		global $database_connection;

		$sql_query = "SELECT * FROM `question` WHERE `quiz_id`='$quiz_id'";
		$query_execute = mysqli_query($database_connection,$sql_query);

		//$question = mysqli_fetch_array($query_execute);
		return $query_execute;
	}

	function updateQuiz($question_id, $question_statement, $option1, $option2, $option3, $option4, $correct_option){

		global $database_connection;

		$sql_query = "UPDATE `question` SET `statement`='$question_statement', `option1`='$option1', `option2`='$option2', `option3`='$option3', `option4`='$option4', `correct_option`='$correct_option' WHERE `id`='$question_id'";

		$query_execute = mysqli_query($database_connection,$sql_query);

		//$question = mysqli_fetch_array($query_execute);
		return $query_execute;
	}

	function getQuestionTable(){

		global $database_connection;

		$sql_query         = "SELECT * FROM question";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
	}
?>
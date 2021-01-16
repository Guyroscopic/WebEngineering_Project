<?php

	require_once "DBconfig.php";

	function insertStudentQuizScore($student_email, $quiz_id, $quiz_score){

		/* This function adds the quiz score of student to database */

		global $database_connection;

		$sql_query = "INSERT INTO `student_quiz_bridge` VALUES('$student_email', '$quiz_id', '$quiz_score');";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		if (!$sql_query_execute) {
	    printf("Quiz Error: %s\n", mysqli_error($database_connection));
	    exit();

		}
	}

	function getStudentQuizScore($student_email, $quiz_id){

		/* This function retrieves quiz score from database */

		global $database_connection;

		$sql_query = "SELECT * FROM `student_quiz_bridge` WHERE `student_email`='$student_email' AND `quiz_id`='$quiz_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		if (!$sql_query_execute) {
	    printf("Quiz Error: %s\n", mysqli_error($database_connection));
	    exit();
		}

		return $sql_query_execute;
	}

	function updateStudentQuizScore($student_email, $quiz_id, $quiz_score){

		/* This function updates the quiz score */

		global $database_connection;

		$sql_query = "UPDATE `student_quiz_bridge` SET `quiz_score`='$quiz_score' WHERE `student_email`='$student_email' AND `quiz_id`='$quiz_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		if (!$sql_query_execute) {
	    printf("Quiz Error: %s\n", mysqli_error($database_connection));
	    exit();
		}
	}

?>

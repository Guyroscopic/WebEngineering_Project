<?php
	
	require_once "DBconfig.php";

	function getRatingByStudentEmailandTutorialID($student_email, $tutorial_id){

		global $database_connection;

		$sql_query         = "SELECT tutorial_rating FROM student_tutorial_bridge WHERE " .
							 "student_email='$student_email' AND tutorial_id='$tutorial_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		
		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

	function getTutorialAvgRating($tutorial_id){

		global $database_connection;

		$sql_query         = "SELECT ROUND(AVG(tutorial_rating), 2) FROM student_tutorial_bridge WHERE " .
		    				 "tutorial_id='$tutorial_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		
		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

	function getTutorialNumOfRatings($tutorial_id){

		global $database_connection;

		$sql_query         = "SELECT COUNT(tutorial_rating) FROM student_tutorial_bridge WHERE " .
		    				 "tutorial_id='$tutorial_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		
		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

	function markTutorialCompleteForStudent($student_email, $tutorial_id, $rating){

		global $database_connection;

		$sql_query         = "INSERT INTO student_tutorial_bridge(`student_email`, `tutorial_id`, ".
							 "`tutorial_rating`) VALUES ('$student_email', '$tutorial_id', '$rating')";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}		
	}

	function getNumOfCompletedTutorialsByStudentEmail($email){

		global $database_connection;

		$sql_query         = "SELECT COUNT(*) FROM student_tutorial_bridge WHERE " .
		    				 "student_email='$email'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		
		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

	function getStudentTutorialBridgeTable(){

		global $database_connection;

		$sql_query         = "SELECT * FROM student_tutorial_bridge";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
	}

	function getStudentCompletedTutorials($email){

		global $database_connection;

		$sql_query         = "SELECT * FROM student_tutorial_bridge WHERE " .
		    				 "student_email='$email'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		
		return $sql_query_execute;
	}

?>
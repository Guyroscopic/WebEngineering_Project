<?php
	
	require_once "DBconfig.php";

	function addTutorial($category_id, $instructor, $title){

		global $database_connection;

		$sql_query         = "INSERT INTO `tutorial`(`category_id`, `instructor`, `title`) " . 
							 "VALUES ('$category_id', '$instructor', '$title')";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		/*if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}*/
		//$sql_query_result  = mysqli_fetch_assoc($sql_query_execute);

		$tutorial_id =  mysqli_insert_id($database_connection);

		//Closing the DB Connection
		//$database_connection->close();
		return $tutorial_id;
	}

	function getTutorialsByTeacherEmail($email){

		global $database_connection;

		$sql_query         = "SELECT id, title FROM tutorial WHERE instructor='$email'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		/*if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}*/
		//$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_execute;

	}

?>
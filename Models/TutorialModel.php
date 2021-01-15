<?php
	
	require_once "DBconfig.php";

	function addTutorial($category_id, $instructor, $title, $description){

		global $database_connection;

		$sql_query         = "INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`)". 				"VALUES ('$category_id', '$instructor', '$title', '$description')";
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

	function setTutorialVideo($tutorial_id, $video){

		global $database_connection;

		$sql_query = "UPDATE tutorial SET video='$video' WHERE id=$tutorial_id";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}

	}

	function getAllTutorials(){

		global $database_connection;

		$sql_query         = "SELECT * FROM tutorial";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
	}

	function getTutorialsByTeacherEmail($email){

		global $database_connection;

		$sql_query         = "SELECT * FROM tutorial WHERE instructor='$email'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		/*if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}*/
		//$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_execute;

	}

	function getTutorialByID($id){

		global $database_connection;

		$sql_query         = "SELECT * FROM tutorial WHERE id='$id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

	function getTutorialsByCategoryID($category_id){

		global $database_connection;

		$sql_query         = "SELECT * FROM tutorial WHERE category_id='$category_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		//$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_execute;
	}

	function getNumOfTutorialsByTeacherEmail($email){

		global $database_connection;

		$sql_query         = "SELECT COUNT(*) FROM tutorial WHERE instructor='$email'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

	function getTutorialTable(){

		global $database_connection;

		$sql_query         = "SELECT * FROM tutorial";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
	}

?>
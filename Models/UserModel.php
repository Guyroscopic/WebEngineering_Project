<?php

	/* Including the Database Config File */
	require_once "DBconfig.php";

	function getUserFromEmailID($emailID, $loginType){

		global $database_connection;

		$sql_query         = "SELECT * FROM " . $loginType . " WHERE email = '$emailID'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		//$sql_query_result  = mysqli_fetch_array($sql_query_execute);
		if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}

		return $sql_query_execute;
	}

	function registerUser($username, $email, $password, $userType){

		/* Function to Add User into the database */
		global $database_connection;
		
		$sql_query = "INSERT INTO " . $userType . "(`email`, `username`, `password`) VALUES ('$email', '$username', '$password');";

		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
		}

	function updateTeacherInfo($email, $education, $description){

		/* Function to update the info of teacher */
		global $database_connection;

		$sql_query = "UPDATE `teacher` SET `education`='$education', `description`='$description' WHERE `email`='$email'";

		$sql_query_execute = mysqli_query($database_connection, $sql_query);
	
		return $sql_query_execute;
	}

	function getTeacherByEmail($email){

		global $database_connection;

		$sql_query         = "SELECT * FROM teacher WHERE email='$email'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

	function getStudentTable(){

		global $database_connection;

		$sql_query         = "SELECT email, username FROM student";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
	}

	function getTeacherTable(){

		global $database_connection;

		$sql_query         = "SELECT email, username, education, description FROM teacher";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
	}

	function deleteStudent($email){

		global $database_connection;

		$sql_query         = "DELETE FROM student WHERE email='$email'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);		
	}

	function deleteTeacher($email){

		global $database_connection;

		$sql_query         = "DELETE FROM teacher WHERE email='$email'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);		
	}
?>
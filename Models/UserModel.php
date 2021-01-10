<?php

	/* Including the Database Config File */
	require_once "DBconfig.php";

	function getUserFromEmailID($emailID, $loginType){

		global $database_connection;

		$sql_query         = "SELECT * FROM " . $loginType . " WHERE email = '$emailID'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		    //printf("Error: %s\n", mysqli_error($database_connection));
		    //exit();
		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

	function registerUser($username, $email, $password, $userType){

		/*
			Function to Add User into the database
		*/
		global $database_connection;
		//echo $email . " : " . $userType;
		$sql_query = "INSERT INTO " . $userType . "(`email`, `username`, `password`) VALUES ('$email', '$username', '$password');";

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

?>
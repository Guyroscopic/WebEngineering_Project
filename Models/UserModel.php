<?php

	/* Including the Database Config File */
	require "DBconfig.php";

	function getUserFromEmailID($emailID, $loginType){

		global $database_connection;

		$sql_query         = "SELECT * FROM " . $loginType . " WHERE email = '$emailID'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		echo $sql_query_execute ? 'true' : 'false';
		if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}

		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		//Closing the DB Connection
		return $sql_query_result;
	}

	function registerUser($username, $email, $password, $userType){

		/*
			Function to Add User into the database
		*/
		global $database_connection;
		echo $email . " : " . $userType;
		$sql_query = "INSERT INTO " . $userType . "(`email`, `username`, `password`) VALUES ('$email', '$username', '$password');";

		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		echo $sql_query_execute ? 'true' : 'false';
		if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}

		$database_connection->close();
		return $sql_query_execute;
		}

?>
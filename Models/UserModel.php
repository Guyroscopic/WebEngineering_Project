<?php

	/* Including Database Config File */
	require_once "DBconfig.php";

	function getUserFromEmailID($emailID, $loginType){

		global $database_connection;

		global $database_connection;
		echo $emailID . " : " . $loginType;
		$sql_query         = "SELECT * FROM " . $loginType . " WHERE email = '$emailID'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		//echo $sql_query_execute ? 'true' : 'false';
		/*if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}*/

		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		//Closing the DB Connection
		$database_connection->close();
		return $sql_query_result;
	}

	function registerUser($username, $email, $password){

		/*
			Function to Add User into the database
		*/
		global $database_connection;

		$sql_query = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email');";

		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		if($sql_query_execute)
			return $sql_query_execute;
		else
			return mysqli_connect_error();
		}

?>
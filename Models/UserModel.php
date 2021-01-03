<?php

	/* Including Database Credentials */
	require "DBcreds.php";

	/* Connecting to MySql Database*/
	$database_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

	/* Check if connection establishes */
	if(!$database_connection){
		die("ERROR: Could not Connect to Database. ". mysqli_connect_error());	
	}

	function getUserFromEmailID($emailID){

		global $database_connection;

		$sql_query         = "SELECT * FROM user WHERE email = '$emailID'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		/*if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}*/

		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

?>
<?php

	/* 
	Script to connect to database with:
	username = root
	password = "" (no password)
	*/

	define('DB_HOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'users');

	/* Connecting to MySql Database*/
	$databse_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

	/* Check if connection establishes */
	if($databse_connection == false){
		die("ERROR: Could not Connect to Database. ". mysqli_connect_error());	
	}
?>
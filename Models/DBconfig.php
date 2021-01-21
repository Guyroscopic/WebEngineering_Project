<?php

	/* Database Credentials */

	/*
	define('DB_HOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'webproject');
	*/

	$DB_HOST = "localhost";
	$DB_USERNAME = "root";
	$DB_PASSWORD = "";

	$DB_NAME = "webproject";
	//$DB_NAME = "webproject_new";

	/* Connecting to MySql Database*/
	$database_connection = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

	/* Check if connection establishes */
	if(!$database_connection){
		die("ERROR: Could not Connect to Database. ". mysqli_connect_error());	
	}
?>
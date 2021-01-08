<?php
	
	/*
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$database_connection = new mysqli($servername, $username, $password);
	
	// Check database_connectionection
	if ($database_connection->error) {
	  	die("database_connectionection failed: " . $database_connection->error);
	}*/

	require_once "Models/DBconfig.php";

	// Create database
	$sql = array("CREATE DATABASE IF NOT EXISTS webproject;",

				"CREATE TABLE IF NOT EXISTS student(
							
						email VARCHAR(100) NOT NULL PRIMARY KEY,
					    username varchar(100) NOT NULL,
					    password varchar(100) NOT NULL
				)",

				"INSERT INTO `student`(`email`, `username`, `password`) VALUES 
				('rafey@example.com',   'Abdul Rafey',   '12345678'),
				('laraib@example.com',  'Laraib Chuss',  '12345678'),
				('fatima@example.com',  'Fatima Aunty',  '12345678'),
				('ghazala@example.com', 'Qatil Haseena', '12345678');",

				"CREATE TABLE IF NOT EXISTS teacher(
							
						email VARCHAR(100) NOT NULL PRIMARY KEY,
					    username varchar(100) NOT NULL,
					    password varchar(100) NOT NULL
				);",

				"INSERT INTO `teacher`(`email`, `username`, `password`) VALUES
				('teacher1@example.com', 'Teacher 1', '12345678'),
				('teacher1@example.com', 'Teacher 1', '12345678'),
				('teacher2@example.com', 'Teacher 2', '12345678');"
);
  

	foreach($sql as $query){

	    if ($result = $database_connection->query($query)){
		  	echo "$database_connection->error";
	    }
		else{ 
		  	echo "$database_connection->error";
		}
	}

	$database_connection->close();


?>
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

			"USE webproject;",

			"DROP TABLE IF EXISTS user;",

		    "create table user(
		    userID int NOT NULL primary key AUTO_INCREMENT,
		    username varchar(20) NOT NULL UNIQUE,
		    password varchar(10) NOT NULL,
		    email varchar(20)
	    	);",

	    	"INSERT INTO user (username,password,email) VALUES 
            ('Laraib Arjamand', '12345678', 'laraib@gmail.com'),
            ('Abdul Rafey', '12345678', 'rafey@gmail.com'),
            ('Fatima Khalid', '12345678', 'fatima@gmail.com');"
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
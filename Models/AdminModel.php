<?php

	/* Including the Database Config File */
	require_once "DBconfig.php";

	function getAdminFromEmailID($emailID){

		global $database_connection;

		$sql_query         = "SELECT * FROM admin WHERE email='$emailID'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		$sql_query_result  = mysqli_fetch_array($sql_query_execute);

		return $sql_query_result;
	}

	function getAdminTable(){

		global $database_connection;

		$sql_query         = "SELECT email, username FROM admin";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
	}

?>
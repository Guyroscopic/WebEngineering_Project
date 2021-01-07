<?php
	
	require_once "DBconfig.php";

	function getAllCategoriesQueryResult(){

		global $database_connection;

		$sql_query         = "SELECT * FROM tutorial_categeory";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);
		/*if (!$sql_query_execute) {
		    printf("Error: %s\n", mysqli_error($database_connection));
		    exit();
		}*/
		//$sql_query_result  = mysqli_fetch_assoc($sql_query_execute);

		//Closing the DB Connection
		$database_connection->close();
		return $sql_query_execute;
	}

?>
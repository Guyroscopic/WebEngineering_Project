<?php
	
	require_once "DBconfig.php";

	function getQuizByTutorialID($tutorial_id){

		global $database_connection;

		$sql_query         = "SELECT * FROM quiz WHERE tutorial_id='$tutorial_id'";
		$sql_query_execute = mysqli_query($database_connection, $sql_query);

		return $sql_query_execute;
	} 

?>
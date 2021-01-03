<?php

	/* Initialize Session */
	session_start();
	
	/* Check If user is Already Logged In and redirect to HomePage*/
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
		header("loaction:index.html");
	}

	/* Including the User Model File */
	require "../Models/UserModel.php";
	require "../loginTemplate.php";

	/* Processing the Form Submission */
	if(($_SERVER["REQUEST_METHOD"] == "POST")){

		$username = $_POST["username"];
		$password = $_POST["password"];	

		//Calling the method in Model to get the user from username
		$sql_query_result = getUserFromEmailID($username);

		//Authenticating the user
		if($sql_query_result && count($sql_query_result) > 0){

			if($sql_query_result["password"] == $password){
				echo "Welcoe User: " . $sql_query_result["username"];
				unset($_SESSION['message']);
				echo "<script>location.replace('/webproject/Views/profile.php')</script>";
			}				
		}
		else{
			echo "<script>location.replace('/webproject/Views/login.php')</script>";
		}		
	}
?>
<?php

	/* Initialize Session */
	session_start();
	
	/* Check if user is Already Logged In and redirect to Profile Page*/
	if(isset($_SESSION['login_user_email']) and isset($_SESSION['login_user_username'])){
		header("loaction: profile.php");
	}

	/* Including the User Model File */
	require "../Models/UserModel.php";

	/* Processing the Form Submission */
	if(($_SERVER["REQUEST_METHOD"] == "POST")){

		$email    = $_POST["email"];
		$password = $_POST["password"];

		if(empty($email) || empty($password)){
			header("location: ../Views/login.php?Empty= Enter Values Before Submitting");
		}

		// To protect MySQL injection for Security purpose
		$email    = stripslashes($email);
		$password = stripslashes($password);
		//$email    = mysql_real_escape_string($email);
		//$password = mysql_real_escape_string($password);

		//Calling the method in Model to get the user from email
		$sql_query_result = getUserFromEmailID($email);

		//Authenticating the user
		if($sql_query_result && count($sql_query_result) > 0){

			if($sql_query_result["password"] == $password){
				//echo "Welcoe User: " . $sql_query_result["username"];
				//echo "<script>location.replace('/webproject/Views/profile.php')</script>";

				// Initializing Session
				$_SESSION["login_user_email"]    = $email; 	
				$_SESSION["login_user_username"] = $sql_query_result["username"]; 
				header("location: ../Views/profile.php");
			}				
		}
		else{
			header("location: ../Views/login.php?Invalid= Invalid Login Credentials");
			// "<script>location.replace('/webproject/Views/login.php')</script>";
		}		
	}
?>
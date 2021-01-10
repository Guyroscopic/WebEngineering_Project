<?php

	/* Initialize Session */
	session_start();
	
	/* Check if user is Already Logged In and redirect to Profile Page*/
	if(isset($_SESSION["current_student_email"]) and isset($_SESSION["current_student_username"])){
		header("location: studentProfile.php");
	}
	else if(isset($_SESSION["current_teacher_email"]) and isset($_SESSION["current_teacher_username"])){
		header("location: teacherProfile.php");
	}

	/* Including the User Model File */
	require "../Models/UserModel.php";

	/* Processing the Form Submission */
	//if(($_SERVER["REQUEST_METHOD"] == "POST")){
	if(isset($_POST["login"])){


		$email     = $_POST["email"];
		$password  = $_POST["password"];
		$loginType = $_POST["loginType"];

		if(empty($email) || empty($password)){
			header("location: ../Views/login.php?empty=ture");
		}

		// To protect MySQL injection for Security purpose
		$email    = stripslashes($email);
		$password = stripslashes($password);
		//$email    = mysql_real_escape_string($email);
		//$password = mysql_real_escape_string($password);

		$sql_query_result = getUserFromEmailID($email, $loginType);

		//Authenticating the user
		if($sql_query_result && count($sql_query_result) > 0){

			if($sql_query_result["password"] == $password){				

				//Initializing Session and Redirecting based on login type
				if($loginType == "student"){
					
					$_SESSION["current_student_email"]    = $email; 	
					$_SESSION["current_student_username"] = $sql_query_result["username"]; 
					//$_SESSION["current_student_type"]   = $loginType;
					header("location: ../Views/studentProfile.php");
				}
				else if($loginType == "teacher"){

					$_SESSION["current_teacher_email"]    = $email; 	
					$_SESSION["current_teacher_username"] = $sql_query_result["username"]; 
					//$_SESSION["current_teacher_type"]   = $loginType;
					header("location: ../Views/teacherProfile.php");
				}
				mysqli_close($database_connection);
			}				
		}
		else{
			header("location: ../Views/login.php?invalidcreds=''");
			// "<script>location.replace('/webproject/Views/login.php')</script>";
			mysqli_close($database_connection);
		}		
	}
?>
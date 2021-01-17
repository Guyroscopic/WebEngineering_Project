<?php

	/* Initialize Session */
	session_start();
	
	/* Redirecting to Profile Page if user is Already Logged In */
	if(isset($_SESSION["current_student_email"]) and isset($_SESSION["current_student_username"])){
		header("location: ../Views/studentProfile.php");
	}
	elseif(isset($_SESSION["current_teacher_email"]) and isset($_SESSION["current_teacher_username"])){
		header("location: ../ViewsteacherProfile.php");
	}
	//Redirecting in case admin is already logged in 
    elseif(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
        header("location: ../Views/adminPanel.php");
    }
    else{
    	header("locatoion: ../Views/login.php?notloggedin=true");
    }

	/* Including the User Model */
	require "../Models/UserModel.php";

	/* Processing the Form Submission */
	//if(($_SERVER["REQUEST_METHOD"] == "POST")){
	if(isset($_POST["login"])){


		$email     = $_POST["email"];
		$password  = $_POST["password"];
		$loginType = $_POST["loginType"];

		//Checking for empty submission
		if(empty($email) || empty($password)){

			//Closing the DB Connection
			mysqli_close($database_connection);

			//Redirecting to login page
			header("location: ../Views/login.php?empty=ture");
		}

		//Sanitiing input to avoid SQL injection attacks
		$email    = mysqli_real_escape_string($database_connection, stripslashes($email));
		$password = mysqli_real_escape_string($database_connection,stripslashes($password));
		
		//Fetching the user from the database
		$user_query_result = getUserFromEmailID($email, $loginType);
		$sql_query_result = mysqli_fetch_array($user_query_result);

		//Authenticating the user
		if($sql_query_result && count($sql_query_result) > 0){ //Authenticating email

			//echo "<br>here<br>";

			if($sql_query_result["password"] == $password){				

				//Initializing Session and Redirecting based on login type
				if($loginType == "student"){
					
					$_SESSION["current_student_email"]    = $email; 	
					$_SESSION["current_student_username"] = $sql_query_result["username"];

					//Closing the DB Connection
					mysqli_close($database_connection);
					
					//Redirecting to student profile
					header("location: ../Views/studentProfile.php");
				}
				else if($loginType == "teacher"){

					$_SESSION["current_teacher_email"]    = $email; 	
					$_SESSION["current_teacher_username"] = $sql_query_result["username"]; 

					//Closing the DB Connection
					mysqli_close($database_connection);
					
					//Redirecting to teacher profile
					header("location: ../Views/teacherProfile.php");
				}

			}//Password Didnt match
			else{
				//Closing the DB Connection
				mysqli_close($database_connection);

				//Redrecting to login page
				header("location: ../Views/login.php?invalidpassword=true");
			}
		}//No user with such email 
		else{
			//Closing the DB Connection
			mysqli_close($database_connection);

			//Redrecting to login page
			header("location: ../Views/login.php?invalidemail=true");
		}				
	}
	else{
		echo "login not set";
	}
?>
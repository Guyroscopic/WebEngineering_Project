<?php

	/* Initialize Session */
	session_start();
	
	/* Redirecting to Profile Page if user is Already Logged In */
	if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
		header("location: ../Views/adminPanel.php");
	}
	/* Redirecting to Profile Page if user is Already Logged In */
	elseif(isset($_SESSION["current_student_email"]) and isset($_SESSION["current_student_username"])){
		header("location: ../Views/studentProfile.php?invalidAccess=true");
	}
	elseif(isset($_SESSION["current_teacher_email"]) and isset($_SESSION["current_teacher_username"])){
		header("location: ../Views/teacherProfile.php?invalidAccess=true");
	}
	else{
		header("location: ../Views/adminLogin.php?notloggedin=true");
	}

	//Adding the required Models
	require "../Models/AdminModel.php";

	if(isset($_POST["login"])){

		$email     = $_POST["email"];
		$password  = $_POST["password"];

		if(empty($email) || empty($password)){
			//Closing the DB Connection
			mysqli_close($database_connection);

			//Redirecting to admin login page
			header("location: ../Views/adminLogin.php?empty=ture");
		}

		//Sanitiing input to avoid SQL injection attacks
		$email    = mysqli_real_escape_string($database_connection, stripslashes($email));
		$password = mysqli_real_escape_string($database_connection, stripslashes($password));

		//Fetching the admin from the database
		$admin = getAdminFromEmailID($email);

		//Authenticating the user
		if($admin && count($admin) > 0){ //Authenticating email

			if($admin["password"] == $password){

				$_SESSION["admin_email"]    = $email; 	
				$_SESSION["admin_username"] = $admin["username"];

				//Closing the DB Connection
				mysqli_close($database_connection);
				
				//Redirecting to student profile
				header("location: ../Views/adminPanel.php");

			}//Password Didnt match
			else{
				//Closing the DB Connection
				mysqli_close($database_connection);

				//Redirecting to admin login page
				header("location: ../Views/adminLogin.php?invalidpassword=true");
			}

		}//No user with such email 
		else{
			//Closing the DB Connection
			mysqli_close($database_connection);

			//Redirecting to admin login page
			header("location: ../Views/adminLogin.php?invalidemail=true");
		}
	}
?>
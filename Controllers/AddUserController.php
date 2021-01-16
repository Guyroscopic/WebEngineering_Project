<?php 
/* Initialize Session */
	session_start();
	
	/* Redirecting to Profile Page if user is Already Logged In */
	if(isset($_SESSION["current_student_email"]) and isset($_SESSION["current_student_username"])){
		header("location: ../Views/studentProfile.php?invalidAccess=true");
	}
	elseif(isset($_SESSION["current_teacher_email"]) and isset($_SESSION["current_teacher_username"])){
		header("location: ../ViewsteacherProfile.php?invalidAccess=true");
	}
    elseif(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
        //pass
    }
    else{
    	header("locatoion: ../Views/login.php?notloggedin=true");
    }

    /* Including the User Model */
	require "../Models/UserModel.php";

	if(isset($_POST["add"])){

		$email     = $_POST["email"];
		$username  = $_POST["username"];
		$password  = $_POST["password"];
		$loginType = $_POST["loginType"];

		//Checking for empty submission
		if(empty($email) || empty($password) || empty($password)){

			//Closing the DB Connection
			mysqli_close($database_connection);

			//Redirecting to login page
			header("location: ../Views/addStudent.php?empty=ture");
		}

		//Sanitiing input to avoid SQL injection attacks
		$email    = mysqli_real_escape_string($database_connection, stripslashes($email));
		$username = mysqli_real_escape_string($database_connection,stripslashes($username));
		$password = mysqli_real_escape_string($database_connection,stripslashes($password));


		//***************************DO THE SAME THING AS SIGN UP******************//
	}

?>
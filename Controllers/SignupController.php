<?php

	/* Initialize Session */
	session_start();
	
	/* Check if user is Already Logged In and redirect to Profile Page*/
	if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
			header("location: studentProfile.php");
		}

	elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
			header("location: teacherProfile.php");
		}
	elseif(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
		header("location: adminPanel.php");
	}

	/* Including the User Model File */
	require_once "../Models/UserModel.php";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
	//if(isset($_POST["submit"])){
		$username = stripslashes($_POST["username"]);
		$email    = stripslashes($_POST["email"]);
		$password = stripslashes($_POST["password"]);
		$confirm_password = stripslashes($_POST["confirm-password"]);
		$userType = $_POST["registertype"];

		// Validating the user entered credentials
		// Check Empty Username
		if(empty($username)){
			//redirecting based on the register user form
			if(isset($_POST["registeruserbutton"]))
				header("location: ../Views/register.php?empty=Please Enter Username");
			elseif(isset($_POST["registerbyadminbutton"]))
				header("location: ../Views/registerUser.php?empty=Please Enter Username&usertype=add".$userType);
		}

		// Check Empty Email
		elseif(empty($email)){
			//redirecting based on the register user form			
			if(isset($_POST["registeruserbutton"]))
				header("location: ../Views/register.php?empty=Please Enter Email");
			elseif(isset($_POST["registerbyadminbutton"]))
				header("location: ../Views/registerUser.php?empty=Please Enter Email&usertype=add".$userType);
		}

		if(isset($_POST["registeruserbutton"])){

			// Check Empty Password
			if(empty($password)){
				header("location: ../Views/register.php?empty=Please Enter Password");
			}

			// Check Password Length
			elseif(strlen($password) < 8){
				header("location: ../Views/register.php?invalid=Password length cannot be less than length 8!");
			}

			// Check If Both Passwords are Same
			elseif($password != $confirm_password){
				header("location: ../Views/register.php?invalid=Password length cannot be less than length 8!");
			}
		}

		$getUser = getUserFromEmailID($email, $userType);
		// Check if user already exists
		if (mysqli_num_rows($getUser) > 0) {
			//redirecting based on the register user form			
			if(isset($_POST["registeruserbutton"]))
				header("location: ../Views/register.php?userexists=User Already Exists!");
			elseif(isset($_POST["registerbyadminbutton"]))
				header("location: ../Views/registerUser.php?userexists=User Already Exists!&usertype=add".$userType);
		}

		// If Everything Goes Well
		else{
			$register_user_query_result = registerUser($username, $email, $password, $userType);

			mysqli_close($database_connection);
			if($register_user_query_result){
				//redirecting based on the register user form			
				if(isset($_POST["registeruserbutton"]))
					header("location: ../Views/login.php");
				elseif(isset($_POST["registerbyadminbutton"]))
					if($userType == "Teacher")
						header("location: ../Views/teacherTable.php");
					elseif($userType == "Student")
						header("location: ../Views/StudentTable.php");
			}

			else{
				//redirecting based on the register user form			
				if(isset($_POST["registeruserbutton"]))
					header("location: ../Views/register.php?empty= Could not Register, Try Again!");
				elseif(isset($_POST["registerbyadminbutton"]))
					header("location: ../Views/registerUser.php?empty= Could not Register, Try Again!");
			}
		} 
		}
	else{
		echo "error";
	}



	
?>
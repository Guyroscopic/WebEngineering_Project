<?php

	/* Initialize Session */
	session_start();
	
	/* Check if user is Already Logged In and redirect to Profile Page*/
	if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
			header("location: studentProfile.php");
		}

	if(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
			header("location: teacherProfile.php");
		}

	/* Including the User Model File */
	require "../Models/UserModel.php";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
	//if(isset($_POST["submit"])){
		$username = stripslashes($_POST["username"]);
		$email    = stripslashes($_POST["email"]);
		$password = stripslashes($_POST["password"]);
		$confirm_password = stripslashes($_POST["confirm-password"]);
		$userType = $_POST["userType"];
		$getUser = getUserFromEmailID($email, $userType);

		// Validating the user entered credentials

		// Check Empty Username
		if(empty($username)){
			header("location: ../Views/register.php?Invalid=Please Enter Email");
		}

		// Check Empty Password
		elseif(empty($password)){
			header("location: ../Views/register.php?Invalid=Please Enter Email");
		}

		// Check Empty Email
		elseif(empty($email)){
			header("location: ../Views/register.php?Invalid=Please Enter Email");
		}

		// Check Password Length
		elseif(strlen($password) < 8){
			header("location: ../Views/register.php?Invalid=Password length cannot be less than length 8!");
		}

		// Check If Both Passwords are Same
		elseif($password != $confirm_password){
			header("location: ../Views/register.php?Invalid=Password length cannot be less than length 8!");

		}

		// Check if user already exists
		elseif ($getUser["email"] == $email) {
			header("location: ../Views/register.php?UserExists=User Already Exists!\nForgot Password?");
		}

		// If Everything Goes Well
		else{
			$register_user_query_result = registerUser($username, $email, $password, $userType);

			if($register_user_query_result){
				header("location: ../Views/login.php");
				mysqli_close($database_connection);
			}

			else{
				header("location: ../Views/register.php?Empty= Could not Register, Try Again!");
				mysqli_close($database_connection);
			}
		} 
		}



	
?>
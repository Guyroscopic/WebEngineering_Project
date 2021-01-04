<?php

	/* Initialize Session */
	session_start();
	
	/* Check if user is Already Logged In and redirect to Profile Page*/
	if(isset($_SESSION['signup_user_email']) and isset($_SESSION['signup_user_username'])){
		header("location: profile.php");
	}

	/* Including the User Model File */
	require "../Models/UserModel.php";

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$username = stripslashes($_POST["username"]);
		$email    = stripslashes($_POST["email"]);
		$password = stripslashes($_POST["password"]);
		$confirm_password = stripslashes($_POST["confirm-password"]);
		$getUser = getUserFromEmailID($email);

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
		elseif($password != $confirm-password){
			header("location: ../Views/register.php?Invalid=Password length cannot be less than length 8!");

		}

		// Check if user already exists
		elseif ($getUser["email"] == $email) {
			header("location: ../Views/register.php?UserExists=User Already Exists!\nForgot Password?");
		}

		// If Everything Goes Well
		else{

			$register_user_query_result = registerUser($username, $email, $password);

			if($register_user_query_result){
				header("location: ../Views/login.php");
			}

			else{
				header("location: ../Views/register.php?Empty= Could not Register, Try Again!");
			}
		}
		}



	
?>
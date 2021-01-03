<?php

	/* Initialize Session */
	session_start();

	/* Check If user is Already Logged In and redirect to HomePage*/
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
		header("loaction:index.html");
	}

	/* Including Database Configuration File */
	require_once "database_configuration.php";

	$username = $password = "";
	$username_error = $password_error = "";


	/* Processing the Form Submission */
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		/* Check if no Credentials are provided */

		/* If Username is not Provided*/
		if(empty($_POST["username"])){
			$username_error = "Please Enter Username";
			//header('location:login_form.html');
		}
		else{
			$username = $_POST["username"];
		}
		
		/* If Password is not Provided*/
		if(empty($_POST["password"])){
			$password_error = "Please Enter Password";
			//header('location:login_form.html');
		}
		else{
			$password = $_POST["password"];
		}

		/* If there are no errors in username and password */
		if(empty($username_error) && empty($password_error)){

			/* SQL Query */
			$sql_query  	   = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$sql_query_execute = mysqli_query($databse_connection,$sql_query);
			$sql_query_result  = mysqli_fetch_array($sql_query_execute);

			if($sql_query_result['username'] == $username && $sql_query_result['password'] == $password){
			echo "Welcome".$username;
			}
			else{
				echo"<script>alert('Invalid Login')</script>";
				echo "<script>location.replace('login_form.html')</script>";
			}
		}
	}

	
	// echo "$username";
	// echo "$password";

	/*$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($conn, $sql);
	$row    = mysqli_fetch_array($result);

	

	if($row['username'] == $username && $row['password'] == $password){
		echo "Welcome".$username;
	}
	else{
		echo"<script>alert('Invalid Login')</script>";
		echo "<script>location.replace('login_form.html')</script>";
	}*/
?>
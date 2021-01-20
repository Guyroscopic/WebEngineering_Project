<?php

	session_start();
	//echo $_SESSION['current_teacher_email'];
	//exit();

	$teacher_loggedin = false;
	$student_loggedin = false;

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){
		
		$teacher_email    = $_SESSION['current_teacher_email'];
		$teacher_username = $_SESSION['current_teacher_username'];
		$teacher_loggedin = true;
	}
	elseif(isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username']))
	{		
		$student_email     = $_SESSION["current_student_email"];
		$student_username  = $_SESSION["current_student_username"];
		$student_loggedin  = true;
	}
	elseif(isset($_SESSION['admin_email']) && isset($_SESSION['admin_username'])){
		header("location: adminPanel.php?invalidAcess=ture");
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	include_once '../Models/UserModel.php';

	if(isset($_POST["change_password"])){

		$old_password = $_POST["old_password"];
		$new_password = $_POST["new_password"];
		$confirm_new_password = $_POST["confirm_new_password"];

		// deciding the user type based on the login 
		if($teacher_loggedin){
			$userType = 'teacher';
			$email    = $teacher_email;
		}
		elseif($student_loggedin){
			$userType = 'student';
			$email    = $student_email;
		}

		// fetching the old password from database
		$old_password_db = getPassword($email, $userType);
		//echo $old_password_db;
		//exit();

		// verifying the entered old password
		if($old_password_db != $old_password){
			header("location: ../Views/changePassword.php?invalid=Entered Password Does Not Match Your Old Password");
			exit();
		}

		elseif($new_password != $confirm_new_password){
			header("location: ../Views/changePassword.php?invalid=Password and Confirm Password Don't Match");
			exit();
		}
		// validating the new password and old password
		elseif($old_password == $new_password){
			header("location: ../Views/changePassword.php?invalid=Your Old Password Matches Your New Entered Password");
			exit();
		}

		$password_changed = changePassword($email, $new_password, $userType);
		if($password_changed)
			header("location: ../Views/".$userType."Profile.php?pwchanged=Password Changed Sucessfully");
		else
			header("location: ../Views/changePassword.php?error=An Error Occured");
		

	}
?>
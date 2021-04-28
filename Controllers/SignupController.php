<?php

	/* Initialize Session */
	session_start();
	
	/* Check if user is Already Logged In and redirect to Profile Page*/
	if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
			header("location: ../Views/studentProfile.php");
	}

	elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
			header("location: ../Views/teacherProfile.php");
	}

	elseif(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
		//header("location: ../Views/adminPanel.php");
	}

	/* Including the User Model File */
	require_once "../Models/UserModel.php";
	require_once "../Models/Transaction.php";

	if(isset($_POST["register"])){

		$username = stripslashes($_POST["username"]);
		$email    = stripslashes($_POST["email"]);
		$password = stripslashes($_POST["password"]);
		$confirm_password = stripslashes($_POST["confirm-password"]);
		$phone    = stripslashes($_POST["phone"]);
		$cnic     = stripslashes($_POST["cnic"]);
		$userType = stripslashes($_POST["registertype"]);
		$page     = stripslashes($_POST["page"]);


		// checking for empty fields
		if(empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($userType) || empty($email) || empty($phone) || empty($cnic)){

			if($page == "userregister"){
				header("location: ../Views/register.php?empty=true");
			}

			elseif($page == "adminregister"){
				header("location: ../Views/registerUser.php?empty=true&usertype=add".$userType);
			}
		}

		// verifying the email input
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

	      	if($page == "userregister"){
				header("location: ../Views/register.php?invalid=Invalid Email");
			}

			elseif($page == "adminregister"){
				header("location: ../Views/registerUser.php?invalid=Invalid Email&usertype=add".$userType);
			}
	    }

		// verifying the length of password
		if(strlen($password) < 8){

			if($page == "userregister"){
				header("location: ../Views/register.php?invalid=Password Length Cannot Be Less Than 8");
				exit();
			}

			elseif($page == "adminregister"){
				header("location: ../Views/registerUser.php?invalid=Invalid Email&usertype=add".$userType);
				exit();
			}
		}
		// verrifying if password and confirm-password are same
		if($password != $confirm_password){
			if($page == "userregister"){
				echo $password. "<br>";
				echo $confirm_password;
				header("location: ../Views/register.php?invalid=Passwords Don't Match");
				exit();

			}
			elseif($page == "adminregister"){
				header("location: ../Views/registerUser.php?invalid=Invalid Password&usertype=add".$userType);
				exit();
			}
		}

		// verifying the length of phone
		if(strlen($phone) > 11){

			if($page == "userregister"){
				header("location: ../Views/register.php?invalid=Invalid Phone Number");
				exit();
			}

			elseif($page == "adminregister"){
				header("location: ../Views/registerUser.php?invalid=Invalid Phone Number&usertype=add".$userType);
				exit();
			}
		}
		// verifying the length of cnic
		if(strlen($cnic) > 6){

			if($page == "userregister"){
				header("location: ../Views/register.php?invalid=Enter Only 6 Digits of CNIC");
				exit();
			}

			elseif($page == "adminregister"){
				header("location: ../Views/registerUser.php?invalid=Enter Only 6 Digits of CNIC&usertype=add".$userType);
				exit();
			}
		}

		// check if user already exists
		$user_record = getUserFromEmailID($email, $userType);
		if(mysqli_num_rows($user_record) > 0){

			if($page == "userregister"){
				header("location: ../Views/register.php?invalid=User Already Exists");
			}

			elseif($page == "adminregister"){
				header("location: ../Views/registerUser.php?invalid=User Already Exists&usertype=add".$userType);
			}
		}

		else{
			// making transaction
			$response = makeTransaction($phone, $cnic, 20);
			echo response;
			exit();
			// all inputs are verified and user does not exist
			$register_user_query = registerUser($username, $email, $password, $phone, $cnic, $userType);
			if($register_user_query){
				echo "no";
				if($page == "userregister"){
					header("location: ../Views/login.php");
				}

				elseif($page == "adminregister"){
					if($userType == "Teacher")
						header("location: ../Views/teacherTable.php?added=User Added!");
					if($userType == "Student")
						header("location: ../Views/StudentTable.php?added=User Added!");
					if($userType == "Admin")
						header("location: ../Views/adminTable.php?added=User Added!");
				}

			}
			else{
				echo "Error";
			}
	}
	}




	
?>
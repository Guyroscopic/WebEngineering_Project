<?php
    //Starting Session
    session_start();

    //Redirecting in case admin is already logged in 
    if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
        header("location: adminPanel.php");
    }
    //Redirecting in case user is already logged in 
    elseif(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
        header("location: studentProfile.php?invalidAccess=true");
    }

    elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
        header("location: teacherProfile.php?invalidAccess=true");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
</head>
<body>

	<h1>Login as Admin</h1>

	<?php if(@$_GET["notloggedin"]){ ?>
		<div style="color: red">You need to Login as Admin to Access that Page</div>
	<?php }	?>

	<?php if(@$_GET["empty"]){ ?>
		<div style="color: red">Enter Values Before Submitting</div>
	<?php }	?>

	<?php if(@$_GET["logoutbeforelogin"]){ ?>
		<div style="color: red">You need to Login before Logging Out!</div>
	<?php }	?>

	<?php if(@$_GET["invalidemail"]){ ?>
		<div style="color: red">Invalid Email! Please Try Again</div>
	<?php } ?>

	<?php if(@$_GET["invalidpassword"]){ ?>
		<div style="color: red">Wrong Password! Please Try Again</div>
	<?php }	?>

	<form action="../Controllers/AdminLoginController.php" id="loginForm" method="POST">
		<label>Email ID:</label>
		<input type="text" name="email" placeholder="yourname@example.com" required><br><br>

		<label>Password:</label>
		<input type="password" name="password" placeholder="Enter Password" required><br><br>

		<button name="login">Login</button><br><br>
	</form>

</body>
</html>
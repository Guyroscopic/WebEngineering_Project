<?php
	session_start();

	if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
        $current_admin_email    = $_SESSION['admin_email'];
        $current_admin_username = $_SESSION['admin_username'];
	}
	elseif(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username']))
	{
		header("location: studentProfile.php?invalidAccess=true");
	}
	elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username']))
	{
		header("location: teacherProfile.php?invalidAccess=true");
	}
    else{
    	header("location: adminLogin.php?notloggedin=true");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
</head>
<body>

	<!-- OUTPUT DIV FOR ERROR MESSAGES -->

    <?php if(@$_GET["invalid"]){ ?>
		<div style="color: red"><?php echo $_GET["invalid"]; ?></div>
    <?php } ?>

	<?php if(@$_GET["userexists"]){ ?>
	    <div style="color: red"><?php echo $_GET["userexists"]; ?></div>
	<?php } ?> 

	<?php if(@$_GET["empty"]){ ?>
	    <div style="color: red"><?php echo $_GET["empty"]; ?></div>
	<?php } ?> 

	<form action="../Controllers/SignupController.php" method="POST">

		<?php if(@$_GET["usertype"] == "addTeacher"){ ?>
			<h1>Add Teacher</h1>
			<label>User Type:</label>
			<input type="text" name="registertype" value="Teacher" readonly>
			<br><br>
		<?php } ?>

		<?php if(@$_GET["usertype"] == "addStudent"){ ?>
			<h1>Add Student</h1>
			<label>User Type:</label>
			<input type="text" name="registertype" value="Student" readonly>
			<br><br>
		<?php } ?>

		<label>Username</label>
	    <input type="text" name="username" placeholder="Enter Username" required>
	    <br><br>

	    <label>Email</label>
	    <input type="text" name="email" placeholder="Enter Email ID" required>
	    <br><br>

	    <label>Password</label>
	    <input type="password" name="password" placeholder="Enter Password" value=12345678 readonly>
	    <br><br>

	    <input type="hidden" name="confirm-password" value=12345678>

		<input type="hidden" name="page" value="adminregister">

	    <button name="register">Add User</button>

	</form>

</body>
</html>
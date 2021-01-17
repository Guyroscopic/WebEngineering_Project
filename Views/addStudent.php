<!DOCTYPE html>
<html> 
<head>
	<title>Add Student</title>
</head>
<body>

	<h1>Add Student</h1>

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

		<input type="hidden" name="registertype" value="student">

		<label>Username</label>
	    <input type="text" name="username" placeholder="Enter Username" required>
	    <br><br>

	    <label>Email</label>
	    <input type="text" name="email" placeholder="Enter Email ID" required>
	    <br><br>

	    <!--<label>Password</label>-->
	    <input type="hidden" name="password" placeholder="Enter Password" value=12345678>
	    <br><br>

	    <input type="hidden" name="confirm-password" value=12345678>

	    <button name="addstudentbutton">Add Student</button>

	</form>

</body>
</html>
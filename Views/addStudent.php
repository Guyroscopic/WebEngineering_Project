<!DOCTYPE html>
<html>
<head>
	<title>Add Student</title>
</head>
<body>

	<h1>Add Student</h1>

	<?php if(@$_GET["empty"]){ ?>
        <div style="color: red">OOPS! Looks like you left a field empty</div>
    <?php } ?>

	<form action="../Controllers/AddUserController.php" method="POST">

		<input type="hidden" name="loginType" value="student">

		<label>Username</label>
	    <input type="text" name="username" placeholder="Enter Username" required>
	    <br><br>

	    <label>Email</label>
	    <input type="text" name="email" placeholder="Enter Email ID" required>
	    <br><br>

	    <label>Password</label>
	    <input type="text" name="password" placeholder="Enter Password" required>
	    <br><br>

	    <button name="add">Add Student</button>

	</form>

</body>
</html>
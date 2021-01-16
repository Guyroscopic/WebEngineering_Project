<!DOCTYPE html>
<html>
<head>
	<title>Add Admin</title>
</head>
<body>

	<h1>Add Admin</h1>

	<?php if(@$_GET["empty"]){ ?>
        <div style="color: red">OOPS! Looks like you left a field empty</div>
    <?php } ?>

	<form action="../Controllers/AddAdminController.php" method="POST">

		<label>Username</label>
	    <input type="text" name="username" placeholder="Enter Username" required>
	    <br><br>

	    <label>Email</label>
	    <input type="text" name="email" placeholder="Enter Email ID" required>
	    <br><br>

	    <label>Password</label>
	    <input type="text" name="password" placeholder="Enter Password" required>
	    <br><br>

	    <button name="add">Add Admin</button>

	</form>

</body>
</html>
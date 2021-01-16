<!DOCTYPE html>
<html>
<head>
	<title>Register Here!</title>
</head>
<body>

	<h2>Sign Up</h2>

    <?php if(@$_GET["Invalid"]){ ?>
        <div><?php echo $_GET["Invalid"]; ?></div>
    <?php } ?>

    <?php if(@$_GET["UserExists"]){ ?>
        <div><?php echo $_GET["UserExists"]; ?></div>
    <?php } ?>        

    <label for="userType">SignUp as:</label>
    <select name="userType"  form="signupForm">
      <option value="student">Student</option>
      <option value="teacher">Teacher</option>
    </select>
    <br><br>

	<form action="../Controllers/SignupController.php" method="POST" id="signupForm">

		<label>Username</label>
        <input type="text" name="username" placeholder="Enter Your Name Here" required>
        <br><br>

        <label>Email</label>
        <input type="text" name="email" placeholder="Enter Your Email Here" required>
        <br><br>

        <label>Password</label>
        <input type="password" name="password" required>
        <br><br>

        <label>Confirm Password</label>
        <input type="password" name="confirm-password" required>
        <br><br>
        <input type="submit" name="submit">
	</form>

</body>
</html>
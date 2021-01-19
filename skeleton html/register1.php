<!DOCTYPE html>
<html>
<head>
	<title>Register Here!</title>
</head>
<body>

	<h2>Sign Up</h2>

    <?php if($_GET["invalid"]){ ?>
        <div><?php echo $_GET["invalid"]; ?></div>
    <?php } ?>

    <?php if($_GET["userexists"]){ ?>
        <div><?php echo $_GET["userexists"]; ?></div>
    <?php } ?>

    <?php if($_GET["empty"]){ ?>
        <div><?php echo $_GET["empty"]; ?></div>
    <?php } ?>        

    <label for="userType">SignUp as:</label>
    <select name="registertype"  form="signupForm">
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
        <input type="submit" name="registeruserbutton">
	</form>
   

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Register Here!</title>
</head>
<body>

	<h2>Sign Up</h2>

        <?php
                if(@$_GET["Invalid"] == true){
        ?>
                <div><?php echo $_GET["Invalid"]; ?></div>
        <?php
                }
        ?>

        <?php
                if(@$_GET["UserExists"] == true){
        ?>
                <div><?php echo $_GET["UserExists"]; ?></div>
        <?php
                }

        ?>     

        

    <label for="userType">SignUp as:</label>
        <select name="userType"  form="signupForm">
          <option value="student">Student</option>
          <option value="teacher">Teacher</option>
        </select>
        <br><br>

	<form action="../Controllers/SignupController.php" method="POST" id="signupForm">

		<label>Username</label>
        <input type="text" name="username" placeholder="Enter Your Name Here">
        <br><br>

        <label>Email</label>
        <input type="text" name="email" placeholder="Enter Your Email Here">
        <br><br>

        <label>Password</label>
        <input type="password" name="password">
        <br><br>

        <label>Confirm Password</label>
        <input type="password" name="confirm-password">
        <br><br>
        <input type="submit" name="submit">
	</form>

</body>
</html>
<?php
	//Checking if Student is logged in or not
	session_start();

	if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){

		$email    = $_SESSION["current_student_email"];
		$username = $_SESSION["current_student_username"];
			
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	//Adding the required Models
	require_once "../Models/StudentTutorialBridgeModel.php";

	//Fetching the number of tutorials student has completed
	$num_completed_tutorials = getNumOfCompletedTutorialsByStudentEmail($email)[0];
?>

<!DOCTYPE html>
<html>
<head>
	<title>WebEng Project</title>
</head>
<body>

	<?php if(@$_GET["invalidAccess"]){ ?>
		<p style="color: red">Your access was Invalid</p>
	<?php } ?>

	<h1>Welcome Student <?php echo $username ?></h1>	
	<h3>Email ID: <?php echo $email ?></h3>
	<h3>Tutorials Completed: <?php echo $num_completed_tutorials ?></h3>

	<ul>
		<li><a href='viewTutorials.php'>Browse Tutorials</a></li>
		<li><a href='studentLogout.php'>Logout</a></li>
	</ul>

</body>
</html>
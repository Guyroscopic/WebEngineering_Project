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
?>

<!DOCTYPE html>
<html>
<head>
	<title>WebEng Project</title>
</head>
<body>

	<?php
		echo "<h1>Welcome Student " . $username . "</h1>";
		echo "<h3>Email ID: " . $email . "</h3>";		
	?>

	<ul>
		<?php
			echo "<li><a href='allTutorials.php'>Browse All Tutorials</a></li>";
			echo "<li><a href='tutorialCategories.php'>Browse Tutorials by Category</a></li>";
			echo "<li><a href='studentLogout.php'>Logout</a></li>";
		?>
	</ul>

</body>
</html>
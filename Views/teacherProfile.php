<?php
	//Checking if Student is logged in or not
	session_start();

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$email    = $_SESSION["current_teacher_email"];
		$username = $_SESSION["current_teacher_username"];
			
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
		echo "<h1>Welcome Teacher" . $username . "</h1>";
		echo "<h3>Email ID: " . $email . "</h3>";
	?>

	<ul>
		<?php
			echo "<li><a href='publishedTutorials.php'>View Published Tutorials</a></li>";
			echo "<li><a href='createTutorial.php'>Create New Tutorial</a></li>";
			echo "<li><a href='editTutorial.php'>Edit Existing Tutorials</a></li>";
			echo "<li><a href='teacherLogout.php'>Logout</a></li>";
		?>
	</ul>

</body>
</html>
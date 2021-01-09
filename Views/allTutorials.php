<?php
	
	//Checking if Teacher is logged in or not
	session_start();

	$teacher_loggedin  = false;
	$student_loggedin  = false;

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$teacher_email    = $_SESSION["current_teacher_email"];
		$teacher_username = $_SESSION["current_teacher_username"];
		$teacher_loggedin  = true;
			
	}
	elseif (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
		
		$student_email    = $_SESSION["current_student_email"];
		$student_username = $_SESSION["current_student_username"];
		$student_loggedin  = true;
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	//Adding the required Models
	require_once "../Models/TutorialModel.php";
	require_once "../Models/TutorialCategoryModel.php";
	
	//Fetching all the tutrials
	$all_tutorials_SQL_result = getAllTutorials();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Web Project</title>
</head>
<body>

	<h1>All Tutorials</h1>

	<?php

	//Displaying
	echo "<ol>";
	while($tutorial = $all_tutorials_SQL_result->fetch_assoc()){

		echo "<li>";
		echo "<a href='tutorial.php?id=" . $tutorial["id"] . "'>" . $tutorial["title"] . "</a><br>";
		echo "<p>" . $tutorial["description"] . "</p><br>";
		echo "</li>";

	}
	echo "</ol>"

	?>

</body>
</html>
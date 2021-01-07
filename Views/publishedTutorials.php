<?php
	
	//Checking if Teacher is logged in or not
	session_start();

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$email    = $_SESSION["current_teacher_email"];
		$username = $_SESSION["current_teacher_username"];
			
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	//Adding the required Models
	require_once "../Models/TutorialModel.php";

	$instructor_Tutorials = getTutorialsByTeacherEmail($email);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Web Project</title>
</head>
<body>

	<h1>Following is the List of Tutorials you have Published</h1>

	<ul>
		<?php
		while($tutorial = $instructor_Tutorials->fetch_assoc()) {				
				echo "<li><a href=tutorial?id=" . $tutorial["id"] . ">" . $tutorial["title"] . "</a></li>";
		}
		?>
	</ul>

</body>
</html>
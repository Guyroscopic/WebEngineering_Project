<?php	
	//Checking if Teacher is logged in or not
	session_start();

	$teacher_loggedin  = false;
	$student_loggedin  = false;

	// Checking If the Teacher is already Logged In
	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$teacher_email     = $_SESSION["current_teacher_email"];
		$teacher_username  = $_SESSION["current_teacher_username"];
		$teacher_loggedin  = true;
			
	}

	// Checking If the Student is already Logged In	
	elseif (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
		
		$student_email     = $_SESSION["current_student_email"];
		$student_username  = $_SESSION["current_student_username"];
		$student_loggedin  = true;
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	
	//Adding the required Models
	require_once "../Models/QuizModel.php";


	if(isset($_POST["view"]) || isset($_POST["backbutton"])){

		//Extracting Tutorial ID from URL and fetching the respective Quizzes
		$tutorial_id = $_POST["tutorial_id"];
		$quiz = getQuizByTutorialID($tutorial_id);

		//Check If the Quiz Doesnt Exist 
		if(mysqli_num_rows($quiz) == 0){
			echo "<h3>No Quiz for This Tutorial</h3>";
		}

		else{
		//Else Display the Quiz Topics
		echo "<ol>";
		while($row = mysqli_fetch_assoc($quiz)) {

			echo "<li><a href='quiz.php?id=" . $row["id"] . "'>".$row["topic"]."</a></li><br>";
		}
		echo "</ol>";
	}
	}
	mysqli_close($database_connection);
?>

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
	require_once "../Models/UserModel.php";
	require_once "../Models/ParagraphModel.php";
	require_once "../Models/QuizModel.php";

	//Extracting Tutorial ID from URL and fetching the respective Tutorial
	$tutorial_id = $_GET["id"];
	$tutorial    = getTutorialByID($tutorial_id);

	//Check If the tutorial doesnt exist 
	if($tutorial["id"] == ""){
		echo "<h1>NO TUTORIAL</h1>";
	}

	//Extracting the Tutorial Informating
	$title               = $tutorial["title"];
	$tutorial_instructor = getTeacherByEmail($tutorial["instructor"]);
	$category    		 = getCategoryNameByID($tutorial["category_id"]);

	//Fetching all the quizes for tutorial
	if($student_loggedin){
		$current_tutorial_quizzes_SQL_result = getQuizByTutorialID($tutorial_id);
	}

	//Fetcing the info of logged in teacher and all of his published tutorials
	if($teacher_loggedin){
		$current_teacher  = getTeacherByEmail($teacher_email);
		$current_teacher_tutorials_SQL_result = getTutorialsByTeacherEmail($current_teacher["email"]);
	}

	//Checking if this is the logged in instructor's own tutorial
	$match = 0;
	if($teacher_loggedin){
		while($tutorial = $current_teacher_tutorials_SQL_result->fetch_assoc()){

			//echo "Tuorial ID: " . $tutorial["id"] . "<br>";
			if($tutorial["id"] == $tutorial_id){
				$match += 1;
			}
		}
	}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Web Project</title>
</head>
<body>

	<!-- Displaying Tutorial Information -->
	<h1><?php echo $title ?></h1>
	<h3>Tutorial By: <?php echo $tutorial_instructor["username"] ?></h3>
	<h3>Contact Instructor at: <?php echo $tutorial_instructor["email"] ?></h3>
	<h3>Category: <?php echo $category["name"] ?></h3>

	<!-- Displaying Paragraphs of the Tutorial -->
	<?php
	//Fetching the paragraphs of current tutorial
	$current_tutorial_pargraphs_SQL_result = getParagaphsByTutorialID($tutorial_id);

	//Dispaying
	while($paragraph = $current_tutorial_pargraphs_SQL_result->fetch_assoc()){

		echo "<h4>" . $paragraph["heading"]  . "</h4>\n";
		echo "<p>"  . $paragraph["content"] . "</p>\n";
	}

	//Closing the DB Connection
	$database_connection->close();
	?>

	<!-- Form for going to Edit Tutorial Page along with the tutorial ID -->
	<form name="editTutorialForm" action="editTutorial.php" method="POST">

		<input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>
		<?php
		if($match > 0){
			echo "<button name='edit'>Edit</button>";		
		}
		?>
	</form><br>

	<!-- Form for going to Creatae Quiz along with the tutorial ID -->
	<form name="addQuizForm" action="createQuiz.php" method="POST">

		<input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>
		<?php
		if($match > 0){
			echo "<button name='create'>Add Quiz for Tutorial</button>";	
		}
		?>
	</form>

	<!-- Form for marking current tutorial as comepleted along with the tutorial ID -->
	<form name="completedTutrial" action="../Controller/CompletedTutorialController.php" method="POST">

		<input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>
		<?php
		if($student_loggedin){
			echo "<button name='completed'>Mark as Completed</button>";	
		}
		?>
	</form>

	<!-- Displaying Attempt Quiz Links -->
	<?php
	if($student_loggedin){
		$quiz_num = 1;
		while($quiz = $current_tutorial_quizzes_SQL_result->fetch_assoc()){
			echo "<br><a href='qiuz.php?id=" . $quiz["id"] . "'>Attempt Quiz " . $quiz_num . "</a>";
			$quiz_num += 1;
		}
		
		//Notifying Student if no Quiz is uploaded for this quiz 
		if(!($quiz_num > 1)){
			echo "<p>No Quiz uploaded for this tutorial</p>";	
		}
	}
	?>

</body>
</html>
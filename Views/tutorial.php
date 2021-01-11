<?php	
	//Checking if Teacher is logged in or not
	session_start();

	$teacher_loggedin  = false;
	$student_loggedin  = false;

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$teacher_email     = $_SESSION["current_teacher_email"];
		$teacher_username  = $_SESSION["current_teacher_username"];
		$teacher_loggedin  = true;
			
	}
	elseif (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
		
		$student_email     = $_SESSION["current_student_email"];
		$student_username  = $_SESSION["current_student_username"];
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
	require_once "../Models/StudentTutorialBridgeModel.php";

	//Extracting Tutorial ID from URL and fetching the respective Tutorial
	$tutorial_id = $_GET["id"];
	$tutorial    = getTutorialByID($tutorial_id);

	//Check If the tutorial doesnt exist 
	if($tutorial["id"] == ""){
		echo "<h1>NO TUTORIAL FOUND</h1>";
		exit();
	}

	//Extracting the Tutorial Informating
	$title               = $tutorial["title"];
	$tutorial_instructor = getTeacherByEmail($tutorial["instructor"]);
	$category    		 = getCategoryNameByID($tutorial["category_id"]);

	//Fetching the paragraphs of tutorial
	$current_tutorial_pargraphs_SQL_result = getParagaphsByTutorialID($tutorial_id);

	//Fetching all the quizes for tutorial
	if($student_loggedin){
		$current_tutorial_quizzes_SQL_result = getQuizByTutorialID($tutorial_id);
	}

	//Checking if the student has already completed the tutorial
	if($student_loggedin){
		$rating = getRatingByStudentEmailandTutorialID($student_email, $tutorial_id)["tutorial_rating"];
	}

	//Fetching the tutorial rating and number of ratings
	$avg_tutorial_rating = getTutorialAvgRating($tutorial_id)[0];
	$num_tutorial_rating = getTutorialNumOfRatings($tutorial_id)[0];

	//Fetcing the info of logged in teacher and all of his published tutorials
	if($teacher_loggedin){
		$current_teacher  					  = getTeacherByEmail($teacher_email);
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

	//Closing the DB Connection
	$database_connection->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Web Project</title>
</head>
<body>

	<!-- Displaying Tutorial Information -->
	<h1><?php echo $title ?></h1>
	<h3>
		Rating: <?php echo $avg_tutorial_rating ? $avg_tutorial_rating : 0 ?> 
		(<?php echo $num_tutorial_rating ?>)
	</h3>
	<h3>Tutorial By: <?php echo $tutorial_instructor["username"] ?></h3>
	<h3>Contact Instructor at: <?php echo $tutorial_instructor["email"] ?></h3>
	<h3>Category: <?php echo $category["name"] ?></h3>

	<?php
	//Dispaying Paragraphs of the Tutorial
	while($paragraph = $current_tutorial_pargraphs_SQL_result->fetch_assoc()){

		echo "<h4>" . $paragraph["heading"]  . "</h4>\n";
		echo "<p>"  . $paragraph["content"]  . "</p>\n";
	}	
	?>

	<!-- Checking if the current user is a teacher and if its his own tutorial, and displaying the relevant 	 informating -->
	<?php if($match > 0){ ?>
	<!-- Form for going to Edit Tutorial Page along with the tutorial ID -->
	<form name="editTutorialForm" action="editTutorial.php" method="POST">

		<input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>
		<button name='edit'>Edit</button>
	</form><br>

	<!-- Form for going to Creatae Quiz along with the tutorial ID -->
	<form name="addQuizForm" action="createQuiz.php" method="POST">

		<input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>
		<button name='create'>Add Quiz for Tutorial</button>
	</form><br>
	<?php } ?>

	
	<!-- Checking if the current user is a student and displaying student relevant information -->
	<?php if($student_loggedin){ ?>
		<!-- If student is new to this tutorial -->
		<?php if(!$rating){ ?>
		<!-- Form for marking current tutorial as comepleted along with the tutorial ID -->
		<form name="completedTutrial" action="../Controllers/CompletedTutorialController.php" method="POST">

			<input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>
			<input type="hidden" name="student_email" value=<?php echo $student_email ?>>

			<label for="rating">Rate this Tutorial: </label>
			<select name="rating" required>
				<option value="">None</option>
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				<option value=5>5</option>
			</select>
			<br><br>
			<button name='completed'>Mark as Completed</button>

		</form>
		<!-- If student has already completed the tutorial -->
		<?php } else{ ?>
			<p style="color: green">You have already completed this tutorial</p>
			<p style="color: green">You gave it <?php echo $rating ?> stars</p>
		<?php } ?>
	<?php } ?>	

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
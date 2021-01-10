<?php
	
	//Checking if Teacher is logged in or not
	session_start();

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$teacher_email    = $_SESSION["current_teacher_email"];
		$teacher_username = $_SESSION["current_teacher_username"];
			
	}
	elseif (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
		
		$student_email    = $_SESSION["current_student_email"];
		$student_username = $_SESSION["current_student_username"];
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	//Adding the required Models
	require_once "../Models/TutorialModel.php";
	require_once "../Models/TutorialCategoryModel.php";
	require_once "../Models/UserModel.php";

	//Extracting Tutorial ID from URL and fetching the Tutorial from DB using it.
	$tutorial_id = $_GET["id"];
	$tutorial    = getTutorialByID($tutorial_id);

	if($tutorial["id"] == ""){
		echo "<h1>NO TUTORIAL</h1>";
	}

	//Fetcing the info of logged in teacher
	$current_teacher  = getTeacherByEmail($teacher_email);

	//Extracting the Tutorial Informating
	$title               = $tutorial["title"];
	$tutorial_instructor = getTeacherByEmail($tutorial["instructor"]);
	$category    		 = getCategoryNameByID($tutorial["category_id"]);

	//Fetching all the tutorials published by the logged in Instructor
	$current_teacher_tutorials_SQL_result = getTutorialsByTeacherEmail($current_teacher["email"]);

	//Checking if this is the instructor's own tutorial
	$match = 0;
	while($tutorial = $current_teacher_tutorials_SQL_result->fetch_assoc()){

		//echo "Tuorial ID: " . $tutorial["id"] . "<br>";
		if($tutorial["id"] == $tutorial_id){
			$match += 1;
		}
	}

	//If this tutorial is not published by the logged in instructor
	if($match == 0){
		//header("location: publishedTutorials.php?unauthorized=true");
	}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Web Project</title>
</head>
<body>

	<h1><?php echo $title ?></h1>

	<p>Tutorial By: <?php echo $tutorial_instructor["username"] ?></p>
	<p>Contact Instructor at: <?php echo $tutorial_instructor["email"] ?></p>
	<p>Category: <?php echo $category["name"] ?></p>

	<form name="editTutorialForm" action="editTutorial.php" method="POST">

		<input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>
		<?php
		if($match > 0){
			echo "<button name='edit'>Edit</button>";		
		}
		?>
	</form><br>
	<form name="addQuizForm" action="createQuiz.php" method="POST">

		<input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>
		<?php
		if($match > 0){
			echo "<button name='create'>Add Quiz for Tutorial</button>";	
		}
		?>
	</form>
	<form name="viewQuizForm" action="viewQuiz.php" method="POST">
		<input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>
		<?php
		if($match > 0){
			echo "<button name='viewQuiz'>View Quiz for Tutorial</button>";	
		}
		?>
	</form>



</body>
</html>
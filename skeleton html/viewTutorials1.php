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

	//Fetching all tutorial categories
	$all_tutorial_categories_SQL_result = getAllCategoriesQueryResult();	

	//Default value for category is all
	$category_id = "all";

	//Checking for button click
	if(isset($_POST["select"]) && ($_POST["tutorialCategory"] != "all")){

		//Extracting category ID from the form
		$category_id =  $_POST["tutorialCategory"];		

		//Fetching tutrials based on category
		$tutorials_SQL_result = getTutorialsByCategoryID($category_id);
		
	}
	else{
		//Fetching all tutrials
		$tutorials_SQL_result = getAllTutorials();
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

	<?php if(@$_GET["completed"]){ ?>
		<p style="color: green">Tutorial Completed! Time for another one</p>
	<?php } ?>

	<h1>Tutorials</h1>

	<form action="viewTutorials.php" method="POST">
		<label for="tutorialCategory">Select Category: </label>
		<select name="tutorialCategory">
			<option value="all">All</option>
			<?php
				while($row = mysqli_fetch_assoc($all_tutorial_categories_SQL_result)) {

					if($category_id == $row["id"]){			
						echo "<option value='" . $row["id"] . "' selected>" . $row["name"] . "</option>";
					}
					else{
						echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
					}
				}
			?>
		</select>
		<button name="select">View Tutorials</button>
	</form>

	<?php
	//Displaying
	echo "<ol>";
	while($tutorial = mysqli_fetch_assoc($tutorials_SQL_result)){

		echo "<li>";
		echo "<a href='tutorial.php?id=" . $tutorial["id"] . "'>" . $tutorial["title"] . "</a><br>";
		if($tutorial["video"]){
			echo "<p>Video Based Tutorial | " . $tutorial["description"] ."</p>";
		}
		else{
			echo "<p>Text Based Tutorial | "  . $tutorial["description"] ."</p>";
		}		
		echo "<br></li>";

	}
	echo "</ol>"
	?>

</body>
</html>
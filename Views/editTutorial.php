<?php

	//Checking if Teacher is logged in or not
	session_start();

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$teacher_email    = $_SESSION["current_teacher_email"];
		$teacher_username = $_SESSION["current_teacher_username"];			
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	//Importing the Required Models
	require_once "../Models/TutorialModel.php";
	require_once "../Models/ParagraphModel.php";

	//Checking form submission	
	if(isset($_POST["edit"])){

		//Extracting the tutorial from the form
		$tutorial_id = $_POST["tutorial_id"];

		//Fetching the Tutorial
		$tutorial = getTutorialByID($tutorial_id);

		//Fetching Tutorial Paragraphs
		$tutoriral_paragraphs_SQL_result = getParagaphsByTutorialID($tutorial_id);

		//Counting the number of paragraphs
		$paragraph_num = 0;
		$temp = getParagaphsByTutorialID($tutorial_id);
		while($paragraph = $temp->fetch_assoc()){
			$paragraph_num += 1;
		}

		echo "Editing Tutorial with ID: " . $_POST["tutorial_id"] . "<br>";
		//echo "Number of Paragraphs: " . $paragraph_num;
	}
	else{
		header("location: publishedTutorials.php?invalidAccess=true");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Web Project</title>
</head>
<body>

	<h1>Edit Tutorial</h1>

	<form name="editTorialFrom" action="../Controllers/editTutorialController.php" method="POST">

		<input type="hidden" value=<?php echo $tutorial_id ?>>

		<label>Title: </label>
		<input type="text" name="title" value="<?php echo $tutorial["title"] ?>" required>
		<br><br>

		<label>Description: </label>
		<input type="text" name="description" value="<?php echo $tutorial["description"] ?>" required>
		<br><br>

		<?php
		$paragraph_num = 1;
		while($paragraph = $tutoriral_paragraphs_SQL_result->fetch_assoc()){

			echo "<label>Heading " . $paragraph_num . ": </label>" .
			     "<input type='text' name='heading_" . $paragraph_num . "' value='" . $paragraph["heading"] . 
			     "' required>" . "<br><br>" .
			     "<label>Content: </label>" .
			     "<textarea name='content_" . $paragraph_num . "' required>" . $paragraph["content"] .
			     "</textarea><br><br>";
			$paragraph_num += 1;
		}
		?>

		<button name="apply">Apply Changes</button>
	</form>

</body>
</html>

<?php
	//Checking if Teacher is logged in or not
	session_start();

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$email    = $_SESSION["current_teacher_email"];
		$username = $_SESSION["current_teacher_username"];
			
	}
	//If an unauthorized user(student) tries to access the page
	elseif(isset($_SESSION["current_student_email"]) and isset($_SESSION["current_student_username"])){
		echo "Acces Denied";
	}

	else{
		header("location: login.php?notloggedin=true");
	}

	$tutorial_id = $_POST["tutorial_id"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>WebEng Project</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

	<!-- Output div for an empty submissoin -->
	<?php
		if(@$_GET["empty"] == true){
	?>
		<div style="color: red">OOPS! Looks like you left a field empty</div>
	<?php
		}
	?>
	<!-- Output div for successful quiz creation -->
	<?php
		if(@$_GET["created"] == true){
	?>
		<div style="color: green">Quiz Created Successfully</div>
	<?php
		}
	?>

	<!-- Output div for any unknown error -->
	<?php
		if(@$_GET["error"] == true){
	?>
		<div style="color: red">An Unknown Error Occured!<br>Please Try Again!</div>
	<?php
		}
	?>

	<h1>Create Quiz</h1>

	<form id="createQuiz" action="../Controllers/CreateQuizController.php" method="POST">

		<input type="hidden" value="<?php echo "$tutorial_id"?>" name="tutorialId">

		<label>Question 1: </label>
		<input type='text' name='question1' placeholder='Enter Question' required><br><br>

		<label>Option1: </label>
		<input type="text" id='option1' name='option1' 
				  placeholder='Enter the First Choice' required><br>

		<label>Option2: </label>
		<input type="text" id='option2' name='option2' 
				  placeholder='Enter the First Choice' required><br>

		<label>Option3: </label>
		<input type="text" id='option3' name='option3' 
				  placeholder='Enter the Second Choice(optional)'><br>

		<label>Option4: </label>
		<input type="text" id='option4' name='option4' 
				  placeholder='Enter the Last Choice(optional)'><br>


		<input type="button" id="addQuestionButton" onclick="addQuestions()" value="Add More Question"></button><br><br>

		<input id="numOfQuestions" type="hidden" name="numOfQuestions" value=1>
		<button name="create">Create</button>

	</form>

	<script>

		let clicked = 1;

		/* Function to dynamically add questions to a Quiz */
		function addQuestions(){

			clicked    += 1;
			str         = "<br><br><label>Question 1: </label>" +
						  "<input type='text' name='question'"+ clicked + " placeholder='Enter Question' required><br>"+

						  "<label>Option1: </label>" + 
						  "<input type='text' id='option1' name='option1' placeholder='Enter the First Choice' required><br>" +
						  "<label>Option2: </label>" + 
						  "<input type='text' id='option2' name='option2' placeholder='Enter the First Choice' required><br>" +
						  "<label>Option3: </label>" +
						  "<input type='text' id='option3' name='option3' placeholder='Enter the Second Choice(optional)'><br>"+
						  "<label>Option4: </label>"+
						  "<input type='text' id='option4' name='option4' placeholder='Enter the Last Choice(optional)'><br>"	;
									  
			$("#numOfQuestions").attr("value", clicked);
			$("#option4").after(str);
		}

	</script>



</body>
</html>
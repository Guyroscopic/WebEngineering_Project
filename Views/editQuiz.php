<?php

//Checking if Teacher or Student is logged in or not
	session_start();

	$teacher_loggedin  = false;
	$student_loggedin  = false;

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$teacher_email     = $_SESSION["current_teacher_email"];
		$teacher_username  = $_SESSION["current_teacher_username"];
		$teacher_loggedin  = true;
			
	}
	elseif (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
		
		echo "Acces Denied";
		header("location: studentProfile.php");
	}
	else{
		header("location: login.php?notloggedin=true");
	}
?>
	<?php
		if(@$_GET["created"] == true){
	?>
		<div style="color: green">Quiz Created Successfully</div>
	<?php
		}
	?>

	<!-- Output div for any unknown error -->
	<?php
		if(@$_GET["Error"] == true){
	?>
		<div style="color: red">An Unknown Error Occured!<br>Please Try Again!</div>
	<?php
		}
	?>
	<!-- Output div for any unknown error -->
	<?php
		if(@$_GET["Empty"] == true){
	?>
		<div style="color: red">An Unknown Error Occured!<br>Please Try Again!</div>
	<?php
		}
	?>
	

<?php
	//Adding the required Models
	require_once "../Models/QuizModel.php";
	require_once "../Models/QuizQuestionModel.php";

	$quiz_question_list = "";
	$num_of_questions = 0;

	//Extracting Quiz ID from URL and fetching the respective Quiz and Its Questions
	$quiz_id 		  = $_POST["quiz_id"];

	$quiz 	 		  = getQuizById($quiz_id);
	$quiz_question    = getQuizQuestionById($quiz_id);
?>

<!DOCTYPE html>
<html>
<head>

	<title><?php echo "Edit Quiz"; echo  $quiz_id; ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

	<form name='UpdateQuizForm' method='POST' action='../Controllers/EditQuizController.php'>

		<?php
			$quiz_question_list .= "<ol id='quiz_list'>";
			while($question = mysqli_fetch_assoc($quiz_question)){

				$num_of_questions += 1;
				$i = $num_of_questions;

				$statement 		 = $question["statement"];
				$option1   		 = $question["option1"];
				$option2   		 = $question["option2"];
				$option3   		 = $question["option3"];
				$option4   		 = $question["option4"];
				$correct_option  = $question["correct_option"];

				$quiz_question_list .= "<li><input type='text' name='question".$i."' value='".$statement.
					 "'><ul><li><input type='text' name='question".$i."_option1' value='".$option1."'></li><li><input type='text' name='question".$i."_option2' value='".$option2."''></li>";

				if(!empty($option3)){
					$quiz_question_list .= "<li><input type='text' name='question".$i."_option3' value='".$option3."'></li>";	
				}
				else{
					$quiz_question_list .= "<li><input type='text' name='question".$i."_option3' value=''></li>";	
				}
				if(!empty($option4)){
					$quiz_question_list .= "<li><input type='text' name='question".$i."_option4' value='".$option4."'></li>";
				}
				else{
					$quiz_question_list .= "<li><input type='text' name='question".$i."_option4' value=''></li>";
				}

				$quiz_question_list .= "</ul>";
				$quiz_question_list .= "Correct Answer: <input type='text' name='question".$i."_correct_answer' value='".$correct_option."'>";
			}
			
			$quiz_question_list .= "</ol>";
			echo $quiz_question_list;
		?>

		<input type='hidden' value='<?php echo $quiz_id; ?>' name='quiz_id'>
		<input type='hidden' value='<?php echo $num_of_questions; ?>' name='num_of_questions' id='numOfQuestions'>
		<input type='hidden' value='' name='new_num_of_questions' id='newNumOfQuestions'>
		<input type='button' id='addQuestionButton' onclick='addQuestions()' value='Add More Question'>
		<input type='submit' name='update' value='Update'>
				
		</form>


	<script type="text/javascript">
		
		let clicked = parseInt(document.getElementById("numOfQuestions").value);

		/* Function to dynamically add questions to a Quiz */
		function addQuestions(){

			clicked    += 1;
			str         = "<br><br><label>Question "+clicked+": </label>" +
						  "<input type='text' name='question"+ clicked + "' placeholder='Enter Question' required><br>"+

						  "<label>Option1: </label>" + 
						  "<input type='text' id='option1' name='question"+clicked+"_option1' placeholder='Enter the First Choice' required><br>" +
						  "<label>Option2: </label>" + 
						  "<input type='text' id='option2' name='question"+clicked+"_option2' placeholder='Enter the First Choice' required><br>" +
						  "<label>Option3: </label>" +
						  "<input type='text' id='option3' name='question"+clicked+"_option3' placeholder='Enter the Second Choice(optional)'><br>"+
						  "<label>Option4: </label>"+
						  "<input type='text' id='option4' name='question"+clicked+"_option4' placeholder='Enter the Last Choice(optional)'><br>" +
						  "<label>Correct Answer: </label>" +
						  "<input type='text' id='correct_answer' name='question"+clicked+"_correct_answer'" + 
				  		  "placeholder='Write the Correct Answer'><br>";
									  
			$("#newNumOfQuestions").attr("value", clicked);
			$("#quiz_list").after(str);
		}

	</script>
</body>
</html>
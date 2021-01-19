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
		
		$student_email     = $_SESSION["current_student_email"];
		$student_username  = $_SESSION["current_student_username"];
		$student_loggedin  = true;
	}
	else{
		header("location: login.php?notloggedin=true");
	}

	//Adding the required Models
	require_once "../Models/QuizModel.php";
	require_once "../Models/QuizQuestionModel.php";
	require_once "../Models/StudentQuizBridgeModel.php";

	//Extracting Quiz ID from URL and fetching the respective Quiz and Its Questions
	$quiz_id 		  = $_GET["id"];
	// Initializing the score of student as negative value, implying student has
	// not score any number yet
	$score 			  = -1;

	// Retrieving the tutorial id using the quiz id
	$tutorial_id_array= getTutorialByQuizId($quiz_id);
	$tutorial_id      = $tutorial_id_array["tutorial_id"];

	// Using the Quiz Model to load the quiz content including questions
	$quiz 	 		  = getQuizById($quiz_id);
	$quiz_question    = getQuizQuestionById($quiz_id);

	// If no questions have been added to the quiz
	if(mysqli_num_rows($quiz_question) == 0){
			echo "No Questions In This Quiz";
			exit();
	}

	if($student_loggedin){
	//Fetching the score of previous attempt by student if any
	$quiz_score_query_result = getStudentQuizScore($student_email, $quiz_id);
		if(mysqli_num_rows($quiz_score_query_result) > 0){

			$quiz_score_array	= mysqli_fetch_array($quiz_score_query_result);
			$score 				= $quiz_score_array["quiz_score"];
		}
	}

	//Fetcing the info of logged in teacher and all of his created Quizzes
	if($teacher_loggedin){
		$current_teacher_quiz = getAllQuizzesByEmail($teacher_email, $quiz_id);
	}

	//Checking if this is the logged in instructor's own tutorial
	$match = 0;
	if($teacher_loggedin){
		while($row = mysqli_fetch_assoc($current_teacher_quiz)){

			//echo "Tuorial ID: " . $tutorial["id"] . "<br>";
			if($row["quiz_id"] == $quiz_id){
				$match += 1;
			}
		}
	}


	$quiz_title = $quiz["topic"];
	$quiz_question_list = "";
	$quiz_form			= "";
	$question_num 		= 0;
	
	//Closing the DB Connection
	$database_connection->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quiz - <?php echo $quiz_title; ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">

	<title>View Quiz</title>

	<!--- CSS Link for view Tutorials-->
    <link href="../assets/css/ViewTutorials.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  
	<style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800");
    body {
      font-family: "Poppins", sans-serif;
      background-color: white;
    }
    
    .main {
      margin-left: 250px;
      padding: 0px 10px;
      color: black;
    }

    .multi-text {
        background-image: linear-gradient(to left, #43cae9 0%, #38f9d7 100%);
        -webkit-background-clip: text;
        -moz-background-clip: text;
        background-clip: text;
        color: transparent;
        font-size: 50px;
        font-weight: bold;
      }

    .quiz-topic-name{
        color: #708090;
        font-size: 30px;
        text-transform: uppercase;
    }
    .quiz-content text{
        display: inline-block;
        font-family: 'Poppins',sans-serif;
        font-weight: 600;
    }
    .edit-quiz-btn{
        display: flex;
        color: #66FCF1;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        align-items: center;
        border: 2px solid #66FCF1;
        background-color: #ffffff;
        padding: 12px 22px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;  
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        outline: none;
    }

    .edit-quiz-btn:hover{
        background-color: #C5C6C7;
        Color: black;
        border: 2px solid #708090;
    }

    .logo{
        position: relative;
        left:40px;
        width:150px;
    }
    .sidenav {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0; 
        background: linear-gradient(#43cae9 0%, #38f9d7 100%);
        overflow-x: hidden;
        padding-top: 20px;
    }

    .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 20px;
        color:#ffffff;
        display: block;
    }

    .sidenav a:hover {
        color: #38f9d7;
        background: #fff;
        text-decoration: none;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }

  </style>
</head>
<body>

	<div class="sidenav">
    <img class="logo" src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png">
    <br><br>
    <a href="/webproject"><i class="fa fa-home"></i> Home</a>
    <br>
    <a href="About.php"><i class="fa fa-font"></i> About</a>
    <br>
    <a href="login.php"><i class="fa fa-hand-o-left"></i> Profile</a>
    <br>
    <a href="tutorial.php?id=<?php echo $tutorial_id; ?>"><i class="fa fa-hand-o-left"></i>Tutorial</a>
    <br>
    <a href="viewQuiz.php?id=<?php echo $tutorial_id; ?>"><i class="fa fa-hand-o-left"></i>Quizzes</a>
    <br>
    <?php if($teacher_loggedin){ ?>
      <a href="teacherLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
    <?php }elseif($student_loggedin){ ?>
      <a href="studentLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
    <?php } ?>
    <br>
  	</div>

  	<div class="main ">
	<!-- Displaying Quiz Information -->
	<h1><span class="multi-text">Quiz</span></h1>
	<h4><span class="quiz-topic-name"><?php echo $quiz_title; ?></span></h4>


	<!-- Displaying The Quiz Content -->
	<?php
		if($teacher_loggedin){
			// If the teacher is logged in and he has created the respective tutorial
			// He can edit the respective quiz
			if($match > 0){

			if(@$_GET["quizCreated"]){?>
				<div style="color: green">Quiz Created</div>
			<?php }
			// showing edit quiz button to quiz creator
	?>
			<form name='EditQuizForm' method='POST' action='editQuiz.php'>
				<button class="edit-quiz-btn" type='submit' name='editQuiz'>Edit Quiz</button>
				<input type='hidden' value="<?php echo $quiz_id; ?>" name='quiz_id'>
			</form>
			<?php } ?>

			<!-- Displaying Quiz -->
			<div class="quiz-content">
			<?php
			$quiz_question_list .= "<ol>";
			while($question = mysqli_fetch_assoc($quiz_question)){

				//fetching the quiz content
				$statement 		 = $question["statement"];
				$option1   		 = $question["option1"];
				$option2   		 = $question["option2"];
				$option3   		 = $question["option3"];
				$option4   		 = $question["option4"];
				$correct_option  = $question["correct_option"];

				$quiz_question_list .= "<li>" . $statement .
					 				   "<ul><li>" . $option1 . "</li><li>" . $option2 . "</li>";

				if($option3){
					$quiz_question_list .= "<li>" . $option3 . "</li>";	
				}
				if($option4){
					$quiz_question_list .= "<li>" . $option4 . "</li>";
				}
				$quiz_question_list .= "</ul>";

				if($match > 0)
					$quiz_question_list .= "<b>Correct Answer: " . $correct_option . "</b><br><br>";
			}
			
			
			$quiz_question_list .= "</ol>";
			echo $quiz_question_list;
		} ?>
	</div>
		<?php
		if($student_loggedin){
		?>
		<div class="main-content5">
		<?php
			// if the student is logged in, he is able to attempt the quiz
			$quiz_form .= "<form name='attemptQuiz' action='result.php' method='POST'>";
			$quiz_form .= "<ol>";

			while($question = mysqli_fetch_assoc($quiz_question)){

				$question_num += 1;

				$statement 		 = $question["statement"];
				$option1   		 = $question["option1"];
				$option2   		 = $question["option2"];
				$option3   		 = $question["option3"];
				$option4   		 = $question["option4"];
				$correct_option  = $question["correct_option"];

				$quiz_form .= "<li>". $statement;


				$quiz_form .= "<label><br><input type='radio' name='". $question_num. "' value='".
				               $option1 . "'>" . $option1 . "</label><br>";

				$quiz_form .= "<label><input type='radio' name='". $question_num. "' value='". 
							   $option2 . "'>" . $option2 . "</label><br>";

				if($option3){
					$quiz_form .= "<label><input type='radio' name='". $question_num. "' value='". $option3."'>".$option3."</label><br>";
				}
				if($option4){
					$quiz_form .= "<label><input type='radio' name='". $question_num. "' value='". $option4."'>".$option4."</label></li><br>";
				}

				$quiz_form .= "<input type='hidden' name='". $question_num ."_answer' value='". $correct_option . "'>"; 

			}
			$quiz_form .= "<input type='hidden' value='". $quiz_id ."' name='quiz_id'>";
			$quiz_form .= "<input type='hidden' value='". $question_num ."' name='num_of_question'>";
			$quiz_form .= "<button class='quiz-button' type='submit' name='showresult'>Show Quiz Result</button>";
			$quiz_form .= "</form>";

			// if the student has already attempted the quiz before, displpaying his previous best score
			if($score >= 0){
				echo "<p style='color:green'>Your Best Score For This Quiz Has Been: " . $score . " out of " . $question_num ."</p>";
			}
			echo $quiz_form;			
		}

	?>
</div>

</body>
</html>
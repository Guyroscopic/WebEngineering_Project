<!DOCTYPE html>
<html>
<head>
	<!-- Required Meta Tags-->
        <meta charset="UTF-8">
        <title>result</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--- CSS Link for view Tutorials-->
        <link href="../assets/css/ViewTutorials.css" rel="stylesheet">

        <!-- CSS Link for Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style type="text/css">

        .flashMsgRed{
          color: #fff;          
          opacity: 0.7;
          background-color: #db5a5a;
          border-radius: 5px;
          text-align: center;
          margin: 0px 50px 0px 50px;
          font-size: 15px;
          padding: 5px 0 5px 0;
        }

        .flashMsgGreen{
          color: #fff;
          background-color: #76e060;
          opacity: 0.7;
          border-radius: 5px;
          margin: 0px 50px 0px 50px;
          text-align: center;
          font-size: 15px;
          padding: 5px 0 5px 0;
        }

    	a.link-btn {
    	  background-color: #66e0ff;
		  color: white;
		  padding: 14px 25px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  border-radius: 5px;
		  text-transform: uppercase;
    	}

        </style>
	<title>Quiz Result</title>
</head>
<body>
	<?php

	$student_loggedin = false;
	$teacher_loggedin = false;
	session_start();

	if (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
		
		$student_email     = $_SESSION["current_student_email"];
		$student_username  = $_SESSION["current_student_username"];
		$student_loggedin = true;
	}

	include "../Models/QuizQuestionModel.php";
	include '../Models/QuizModel.php';
	include '../Models/StudentQuizBridgeModel.php';


	if(isset($_POST["num_of_question"])){
	
		// retrieving values
		$score			 = 0;
		$num_of_question = stripslashes($_POST["num_of_question"]);
		$quiz_id 		 = stripslashes($_POST["quiz_id"]);

		$tutorial_id_query = getTutorialByQuizId($quiz_id);
		$tutorial_id = $tutorial_id_query["tutorial_id"];

		// fetching quiz questions from database
		$quiz_question = getQuizQuestionById($quiz_id);
		//initializing the question count for the quiz
		$question_num  = 0;
		?>

		<!-- Left Fixed Sidebar-->
        <div class="sidenav">
            <img class="logo" src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png" alt="logo">
            <br><br>
            <a href="/webproject"><i class="fa fa-home"></i> Home</a>
		    <br>
		    <a href="About.php"><i class="fa fa-font"></i> About</a>
		    <br>
		    <a href="login.php"><i class="fa fa-hand-o-left"></i> Profile</a>
		    <br>
		    <a href="tutorial.php?id=<?php echo $tutorial_id; ?>"><i class="fa fa-hand-o-left"></i> Tutorial</a>
		    <br>
            <?php if($teacher_loggedin){ ?>
		      <a href="teacherLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
		    <?php }elseif($student_loggedin){ ?>
		      <a href="studentLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
		    <?php } ?>
		    <br>
        </div>


		<?php 
		// creating result form
		$result_form = "<form name='quizresult'>";
		$result_form .= "<ol>";

		while($question = mysqli_fetch_assoc($quiz_question)){

				$question_num += 1;

				
				if(empty($_POST[$question_num])){
					$selected_option = "none";
				}
				else{
					$selected_option = stripslashes($_POST[$question_num]);
				}

				$correct_answer	 = stripslashes($_POST[$question_num ."_answer"]);

				if($selected_option == $correct_answer){
					$score++ ;
				}

				$statement 		 = $question["statement"];
				$options 		 = array("option1", "option2", "option3", "option4");
				$correct_option  = $question["correct_option"];

				$result_form .= "<br><li>". $statement."<br>";

				foreach ($options as $option) {
						if($question[$option]){
							if($option == $selected_option){

								if($selected_option != $correct_option){
									$result_form .= "<label style='color:red'><br><input type='radio' name='". $question_num. "' value='". $option."' checked='checked' disabled>".$question[$option]."</label>";
								}
								elseif($selected_option == $correct_option){
								$result_form .= "<label style='color:green'><br><input type='radio' name='". $question_num. "' value='". $option."' checked='checked' disabled>".$question[$option]."</label>";
							}
							}
							else{
								$result_form .= "<br><label><input type='radio' name='". $question_num. "' value='". $option."'  disabled>".$question[$option]."</label>";
							}
						
					}	}		
				}

				$quiz_score_query_result = getStudentQuizScore($student_email, $quiz_id);
				
				// storing the score of student in database
				if(mysqli_num_rows($quiz_score_query_result) > 0){
					$quiz_score_array		 = mysqli_fetch_array($quiz_score_query_result);
					$previous_score 		 = $quiz_score_array["quiz_score"];
					if($previous_score < $score){
						updateStudentQuizScore($student_email, $quiz_id, $score);
					}
				}
				else{
					insertStudentQuizScore($student_email, $quiz_id, $score);
				}

				$result_form .= "</ol></form>";?>
				<div class="tut-bg">
			        <h1><span class="multi-text" > Result: Quiz No. <?php echo $quiz_id ?></span></h1>
			    </div>
			    <?php if($score > 0){ ?>
				<div class="main-content5"><h2 class="flashMsgGreen">You Scored <?php echo $score . "/". $num_of_question ?></h2>
				<?php } ?>

				 <?php if($score == 0){ ?>
				<div class="main-content5"><h2 class="flashMsgRed">You Scored <?php echo $score . "/". $num_of_question ?></h2>
				<?php } 
				echo "<br><a class='link-btn' href='quiz.php?id=".$quiz_id."'>Attempt Again</a>";
				?>

				<?php
				echo $result_form;	
				echo "<form action='viewQuiz.php' method='POST'><button class='quiz-button' type='submit' name='backbutton'>Go Back To Quizzes</button><input type='hidden' value='".$tutorial_id."' name='tutorial_id'></form>";

}				?>
				</div>


</body>
</html>

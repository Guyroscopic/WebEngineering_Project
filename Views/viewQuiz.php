<?php
	
	session_start();

	include_once "../Models/QuizModel.php";

	$email    = $_SESSION["current_teacher_email"];
	$quiz = getAllQuizzes($email);

	echo $quiz;
	
?>
<?php
	//Checking if Teacher is logged in or not
	session_start();

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

		$email    = $_SESSION["current_teacher_email"];
		$username = $_SESSION["current_teacher_username"];
			
	}
	//If an unauthorized user(student) tries to access the page
	elseif(isset($_SESSION["current_student_email"]) and isset($_SESSION["current_student_username"])){

		header("location: studentProfile.php?invalidAccess=true");
	}

	else{
		header("location: login.php?notloggedin=true");
	}

	if(isset($_POST["create"]) || @$_GET["tutorial_id"]){

		if(@$_GET["tutorial_id"])
			$tutorial_id = $_GET["tutorial_id"];
		else
			$tutorial_id = $_POST["tutorial_id"];
	}		
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">

  <title>Create Quiz</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  

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

    .flashMsg{
          color: #fff;          
          opacity: 0.7;
          background-color: #db5a5a;
          border-radius: 5px;
          text-align: center;
          margin-top: 30px;
          margin-bottom: 30px;
          font-size: 15px;
          padding: 5px 0 5px 0;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }

  </style>
	<title>Create Quiz</title>

	<!-- Importing jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>	
	<div class="sidenav">
    <img class="logo" src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png">
    <br><br>
    <a href="/webproject"><i class="fa fa-home"></i> Home</a>
    <br>
    <a href="About.php"><i class="fa fa-font"></i> About</a>
    <br>
    <a href="tutorial.php?id=<?php echo $tutorial_id; ?>"><i class="fa fa-hand-o-left"></i>Tutorial</a>
    <br>
    <a href="teacherProfile.php"><i class="fa fa-hand-o-left"></i> Return to Profile</a>
    <br>
    <a href="login.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
    <br>
    </div>

    <div class="main">
	<h1><span class="multi-text">Create Quiz</span></h1><br><br>

	<!-- Output div for an empty submissoin -->
	<?php if(@$_GET["empty"]){ ?>
		<div class="flashMsg"><?php echo $_GET["empty"]; ?></div>
	<?php } ?>

	<!-- Output div for an Error -->
	<?php if(@$_GET["error"]){ 	?>
		<div class="flashMsg"><?php echo $_GET["error"]; ?></div>
	<?php } ?>

	<form class="form-horizontal" id="createQuiz" action="../Controllers/CreateQuizController.php" method="POST">

		<input type="hidden" value="<?php echo $tutorial_id?>" name="tutorialId">

		<label class="col-sm-2 col-form-label col-form-label-lg" for="topic">Topic</label>
		<input type="text" class="form-control form-control-lg" id="topic" placeholder="Enter the Topic of Quiz" name="quiz_topic" required>
		
		<label class="col-sm-2 col-form-label col-form-label-lg" >Question 1: </label>
		<input type='text'class="form-control form-control-lg" name='question1' placeholder='Enter Question' required>
		
		<label class="col-sm-2 col-form-label col-form-label">Option1: </label>
		<input type="text" id='option1' class="form-control form-control" name='question1_option1' 
				  placeholder='Option 1' required>

		<label class="col-sm-2 col-form-label col-form-label">Option2: </label>
		<input type="text" class="form-control form-control" id='option2' name='question1_option2' 
				  placeholder='Option 2' required>

		<label class="col-sm-2 col-form-label col-form-label">Option3(Optional): </label>
		<input type="text" id='option3' class="form-control form-control" name='question1_option3' 
				  placeholder='Option 3'>

		<label class="col-sm-2 col-form-label col-form-label">Option4(Optional): </label>
		<input type="text" id='option4' class="form-control form-control" name='question1_option4' 
				  placeholder='Option 4'>

		<label class="col-sm-2 col-form-label col-form-label-lg">Correct Answer: </label>
		<select class="custom-select custom-select-lg mb-3" name="question1_correct_answer" id="correct_answer_1">
		  <option value=''>Select</option>
		  <option value="option1">Option 1</option>
		  <option value="option2">Option 2</option>
		  <option value="option3">Option 3</option>
		  <option value="option4">Option 4</option>
		</select><br><br>

		<button class="btn btn-info" type="submit" id="addQuestionButton" onclick="addQuestions()">Add More Question</button><br><br>

		<input id="numOfQuestions" type="hidden" name="numOfQuestions" value=1>
		<button class="btn btn-info" name="create">Create</button>

	</form>
</div>

	<script>

		let clicked = 1;

		/* Function to dynamically add questions to a Quiz */
		function addQuestions(){

			clicked    += 1;
			str 		= "<br><br>";
			str         += "<label class='col-sm-2 col-form-label col-form-label-lg' for='ques'>Question "+clicked+": </label>" +
						  "<input type='text' name='question"+ clicked + "' class='form-control form-control-lg' placeholder='Enter Question' required>"+

						  "<label class='col-sm-2 col-form-label col-form-label'>Option1: </label>" + 
						  "<input class='form-control form-control' type='text' id='option1' name='question"+clicked+"_option1' placeholder='Enter the First Choice' required><br>" +

						  "<label class='col-sm-2 col-form-label col-form-label'>Option2: </label>" +
						  "<input class='form-control form-control' type='text' id='option2' name='question"+clicked+"_option2' placeholder='Enter the Second Choice' required><br>" +

						  "<label class='col-sm-2 col-form-label col-form-label'>Option3: </label>" +
						  "<input class='form-control form-control' type='text' id='option3' name='question"+clicked+"_option3' placeholder='Enter the Third Choice(optional)'><br>"+

						  "<label class='col-sm-2 col-form-label col-form-label'>Option4: </label>"+
						  "<input class='form-control form-control' type='text' id='option4' name='question"+clicked+"_option4' placeholder='Enter the Last Choice(optional)'><br>" +
						  "<label class='col-sm-2 col-form-label col-form-label-lg'>Correct Answer: </label>" +
						  "<select class='custom-select custom-select-lg mb-3' name='question"+clicked+"_correct_answer' id='correct_answer_" + clicked + "'>"+
						  	  "<option value=''>Select</option>"+
							  "<option value='option1'>Option 1</option>"+
							  "<option value='option2'>Option 2</option>"+
							  "<option value='option3'>Option 3</option>"+
							  "<option value='option4'>Option 4</option>"+
							"</select><br><br>";
									  
			$("#numOfQuestions").attr("value", clicked);
			$("#correct_answer_" + (clicked-1)+"").after(str);
		}

	</script>

	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<!-- Latest compiled and minified Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>
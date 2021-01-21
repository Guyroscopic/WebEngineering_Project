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
  elseif(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){

    header("location: adminPanel.php");

  }
  else{
    header("location: login.php?notloggedin=true");
  } 

  //Adding the required Models
  require_once "../Models/QuizModel.php";
  require_once "../Models/QuizQuestionModel.php";

  $quiz_question_list = "";
  $num_of_questions = 0;

  //Extracting Quiz ID from URL and fetching the respective Quiz and Its Questions
  if(isset($_POST["quiz_id"]) || @$_GET["quiz_id"]){

    if(isset($_POST["quiz_id"]))
      $quiz_id = $_POST["quiz_id"];

    elseif(@$_GET["quiz_id"])
      $quiz_id = @$_GET["quiz_id"];
  }

  
  $quiz         = getQuizById($quiz_id);
  $quiz_question    = getQuizQuestionById($quiz_id);

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

    if($match == 0){
      header("location: teacherProfile.php");
      exit();
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">

  <title>Edit Quiz</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- IMP CSS FOR SELECT TAG-->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" 
  integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  
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

    .ques-input{
      display: inline-block;
      font-family: 'Poppins',sans-serif;
      font-size: 14px;
      width: 75%;
      border-radius: 5px;
      border: 2px solid #C5C6C7;
      outline: none;
    }

    .ques-output{
      display: inline-block;
      font-family: 'Poppins',sans-serif;
      font-size: 14px;
      width:30%;
      border-radius: 5px;
      border: 2px solid #C5C6C7;
      outline: none;
    }
    .quiz-content text{
        display: inline-block;
        font-family: 'Poppins',sans-serif;
        font-weight: 600;
        font-size: 16px;
    }

    #addQuestionButton{
        display: flex;
        color: #66FCF1;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        align-items: center;
        border: 2px solid #66FCF1;
        background-color: #ffffff;
        padding: 10px 22px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;  
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        outline: none;
    }

    #addQuestionButton:hover{
        background-color: #C5C6C7;
        Color: black;
        border: 2px solid #708090;
    }

    .new-ques input{
      margin-left: 3%;
    }

    #delete-btn{
        display: flex;
        color: #66FCF1;
        text-transform: uppercase;
        letter-spacing: 0.10em;
        align-items: center;
        border: 2px solid #66FCF1;
        background-color: #ffffff;
        padding: 8px 11px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;  
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        outline: none;
    }

    #update-btn{
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

    #delete-btn:hover, #update-btn:hover{
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

  <title><?php echo "Edit Quiz"; echo  $quiz_id; ?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

  <div class="sidenav">
    <img class="logo" src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png">
    <br><br>
    <a href="/webproject"><i class="fa fa-home"></i> Home</a>
    <br>
    <a href="about.php"><i class="fa fa-font"></i> About</a>
    <br>
    <a href="quiz.php?id=<?php echo $quiz_id; ?>"><i class="fa fa-hand-o-left"></i> Back To View Quiz</a>
    <br>
    <a href="teacherProfile.php"><i class="fa fa-hand-o-left"></i> Return to Profile</a>
    <br>
    <a href="login.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
    <br>
    </div>

  <div class="main" id="main-content">
    <h1><span class="multi-text"> Edit Quiz</span></h1><br>

    <h4><span class="quiz-topic-name"><?php echo $quiz["topic"]; ?></span></h4>
    <?php
    if(@$_GET["empty"]){
    ?>
      <div class="flashMsg"><?php  echo $_GET["empty"]; ?></div>
    <?php
      }
    if(@$_GET["error"]){?>
      <div class="flashMsg"><?php  echo $_GET["error"]; ?></div>
    <?php
    }
    ?>
  <form name='UpdateQuizForm' method='POST' action='../Controllers/EditQuizController.php'>

    <?php
      $quiz_question_list .= "<ol id='quiz_list'>";
      while($question = mysqli_fetch_assoc($quiz_question)){

        $num_of_questions += 1;
        $i = $num_of_questions; 

        $statement     = $question["statement"];
        $option1       = $question["option1"];
        $option2       = $question["option2"];
        $option3       = $question["option3"];
        $option4       = $question["option4"];
        $correct_option  = $question["correct_option"];
        $question_id   = $question["id"];

        $quiz_question_list .= "<li><input class='ques-input' type='text' name='question".$i."' value='".$statement.
           "'><br><br><ul style='list-style-type: square;'><li><input class='ques-output' type='text' name='question".$i."_option1' value='".$option1."' required></li><br><li><input class='ques-output' type='text' name='question".$i."_option2' value='".$option2."' required></li><br>";

        if(!empty($option3)){
          $quiz_question_list .= "<li><input type='text' class='ques-output' name='question".$i."_option3' value='".$option3."'></li><br>"; 
        }
        else{
          $quiz_question_list .= "<li><input type='text' class='ques-output' name='question".$i."_option3' value=''></li><br>"; 
        }
        if(!empty($option4)){
          $quiz_question_list .= "<li><input type='text' class='ques-output' name='question".$i."_option4' value='".$option4."'></li><br>";
        }
        else{
          $quiz_question_list .= "<li><input type='text' class='ques-output' name='question".$i."_option4' value=''></li><br>";
        }


        $quiz_question_list .= "</ul><br>";
        $quiz_question_list .= "<div id='correct_option_".$i."'><text id='correct_option'>Correct Answer: </text><select name='question".$i."_correct_answer' class='selectpicker show-tick' data-style='btn btn-info'>".
                "<option value=''>Select</option>".
                "<option value='option1' ". (($correct_option == 'option1') ? "selected='selected'":'').">Option 1</option>".
                "<option value='option2' ". (($correct_option == 'option2') ? "selected='selected'":'').">Option 2</option>".
                "<option value='option3' ". (($correct_option == 'option3') ? "selected='selected'":'').">Option 3</option>".
                "<option value='option4' ". (($correct_option == 'option4') ? "selected='selected'":'').">Option 4</option>".
                "</select><br><br></div>";
  
        
        $quiz_question_list .= "<input type='hidden' name='question".$i."_id' value='". $question_id."'>";
      }
      
      $quiz_question_list .= "</ol>";
      echo $quiz_question_list;
    ?>

    <input type='hidden' value='<?php echo $quiz_id; ?>' name='quiz_id'>
    <input type='hidden' value='<?php echo $num_of_questions; ?>' name='num_of_questions' id='numOfQuestions'>
    <input type='hidden' value='' name='new_num_of_questions' id='newNumOfQuestions'>
    <br>
    <button class="btn btn-info" type="submit" id="addQuestionButton" onclick="addQuestions()">Add More Question</button>
    <br>
    <button type='submit' id="update-btn" name='update' value='Update'>Update</button>
    </form>
</div>

  <script type="text/javascript">
    
    let clicked = parseInt(document.getElementById("numOfQuestions").value);

    /* Function to dynamically add questions to a Quiz */
    function addQuestions(){

      clicked    += 1;
      str         = "<div class='new-ques'><br><br><label>Question "+clicked+": </label>" +
              "<input class='ques-input' type='text' name='question"+ clicked + "' placeholder='Enter Question' required><br><br>"+

              "<label>Option1: </label>" + 
              "<input class='ques-output' type='text' id='option1' name='question"+clicked+"_option1' placeholder='Enter the First Choice' required><br><br>" +
              "<label>Option2: </label>" + 
              "<input class='ques-output' type='text' id='option2' name='question"+clicked+"_option2' placeholder='Enter the First Choice' required><br><br>" +
              "<label>Option3: </label>" +
              "<input class='ques-output' type='text' id='option3' name='question"+clicked+"_option3' placeholder='Enter the Second Choice(optional)'><br><br>"+
              "<label>Option4: </label>"+
              "<input class='ques-output' type='text' id='option4' name='question"+clicked+"_option4' placeholder='Enter the Last Choice(optional)'><br><br>" +
              "<label>Correct Answer: </label>" +
              "<select name='question"+clicked+"_correct_answer' id='correct_option_"+clicked+"'>"+
                  "<option value=''>Select</option>"+
                "<option value='option1'>Option 1</option>"+
                "<option value='option2'>Option 2</option>"+
                "<option value='option3'>Option 3</option>"+
                "<option value='option4'>Option 4</option>"+
              "</select><br><br></div>";
                    
      $("#newNumOfQuestions").attr("value", clicked);
      $("#correct_option_"+(clicked-1)+"").after(str);
    }

  </script>

  <!-- IMP JAVASCRIPT CODE FOR SELECT TAG-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> 
</body>
</html>
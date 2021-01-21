<?php 
  //Checking if Teacher is logged in or not
  session_start();

  $teacher_loggedin  = false;
  $student_loggedin  = false;

  // Checking If the Teacher is already Logged In
  if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

    $teacher_email     = $_SESSION["current_teacher_email"];
    $teacher_username  = $_SESSION["current_teacher_username"];
    $teacher_loggedin  = true;
      
  }

  // Checking If the Student is already Logged In 
  elseif (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
    
    $student_email     = $_SESSION["current_student_email"];
    $student_username  = $_SESSION["current_student_username"];
    header("location: studentProfile.php");
  }
  
  else{
    header("location: login.php?notloggedin=true");
  }

  
  //Adding the required Models
  require_once "../Models/QuizModel.php";

  if (isset($_POST["view"]) || isset($_POST["backbutton"]) || @$_GET["id"] || @$_GET["tutorial_id"]){

    //Extracting Tutorial ID from URL and fetching the respective Quizzes
     
    if(@$_GET["id"]){
      $tutorial_id = $_GET["id"];
    }
    elseif (@$_GET["tutorial_id"]) {
        $tutorial_id = $_GET["tutorial_id"];
      }  
    else{
      $tutorial_id = $_POST["tutorial_id"];
    }
    
    $quiz = getQuizByTutorialIDesc($tutorial_id);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Quizzes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Style css 
    <link rel="stylesheet" href="../assets/css/style.css"> -->
    <link rel="stylesheet" href="../assets/css/ViewTutorials.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800");
    body {
      font-family: "Poppins", sans-serif;
      background-color: white;
    }
    .logo{
      position: relative;
      left:40px;
      width:150px;
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

    .quiz-msg{
        color: #708090;
        font-size: 30px;
        text-transform: uppercase;
    }

    .flashMsgRed{
          color: #fff;          
          opacity: 0.7;
          background-color: #db5a5a;
          border-radius: 5px;
          text-align: center;
          margin: 0px 50px 30px 50px;
          font-size: 15px;
          padding: 5px 0 5px 0;
    }

    .flashMsgGreen{
      color: #fff;
      background-color: #76e060;
      opacity: 0.7;
      border-radius: 5px;
      margin: 0px 50px 30px 50px;
      text-align: center;
      font-size: 15px;
      padding: 5px 0 5px 0;
    }

    .card{
      border: 1px solid #38f9d7;
      border-radius: 5px;
      background-color: rgba(0, 0, 0, 0.1);
      padding: 8px;
      margin-bottom: 2%;
      margin-left: 5%;
      text-align: center;
    }

    .card a{
      font-size: 25px;
      text-decoration: none;
      font-weight: 600;
      color: #484c54
      
    }

    .card a:hover{
     color: #4d7bd6;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }

  </style>
</head>
<body style="background-color: #d3ebe5;">

  <!-- Navbar Starts Here -->
  <div class="sidenav">
    <img class="logo" src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png">
    <br><br>
    <a href="/webproject"><i class="fa fa-home"></i> Home</a>
    <br>
    <a href="about.php"><i class="fa fa-font"></i> About</a>
    <br>
    <a href="tutorial.php?id=<?php echo $tutorial_id; ?>"><i class="fa fa-hand-o-left"></i>Tutorial</a>
    <br>
    <a href="login.php"><i class="fa fa-hand-o-left"></i> Profile</a>
    <br>
    <?php if($teacher_loggedin){ ?>
      <a href="teacherLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
    <?php }elseif($student_loggedin){ ?>
      <a href="studentLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
    <?php } ?>
    <br>
    </div>
  <!-- Navbar Ends Here -->

  <!-- Quiz List Starts Here -->
  <h1 align="center">
      <span class="multi-text">Quizzes</span>
    </h1>
    <br>
    <div class="main">
    <!-- Displaying All Quizzes For That Tutorial -->
    <?php

    // if no quiz has been created for the tutorial
    if(mysqli_num_rows($quiz) == 0){
      echo "<h3 class='quiz-msg'>No Quiz for This Tutorial</h3>";
      exit();
    }

    if(@$_GET["quizCreated"])
      echo "<div class='flashMsgGreen'>" . @$_GET["quizCreated"] . "</div>";

    if(@$_GET["quizDeleted"])
      echo "<div class='flashMsgRed'>" . @$_GET["quizDeleted"] . "</div>";

  //echo "<ol>";
  $count = 0;
  while($row = mysqli_fetch_assoc($quiz)) {

    if($count % 3 == 0 ){
      echo "<div class='row'>";
    }
    //echo "<li><a href='quiz.php?id=" . $row["id"] . "'>".$row["topic"]."</a></li><br>";
    echo "<div class='card col-lg-3 col-md-3 col-sm-3'><a href='quiz.php?id=" . $row["id"] . "'>".$row["topic"]."</a></div>";
    $count++;
    if($count % 3 == 0){
      echo "</div>";
    }
  }

  }
  
  mysqli_close($database_connection);
  ?>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>  

</body>
</html> 



<?php
  
  //Checking if Teacher is logged in or not
  session_start();

  $student_loggedin = false;
  $teacher_loggedin = false;

  if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

    $teacher_email    = $_SESSION["current_teacher_email"];
    $teacher_username = $_SESSION["current_teacher_username"];
    $teacher_loggedin = true;
  }
  elseif (isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])) {
    
    $student_email    = $_SESSION["current_student_email"];
    $student_username = $_SESSION["current_student_username"];
    $student_loggedin = true;
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
  mysqli_close($database_connection);
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Style css
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/ViewTutorials.css"> -->

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

    .flashMsg{
      color: #fff;
      background-color: #76e060;
      opacity: 0.7;
      border-radius: 5px;
      text-align: center;
      margin: 30px 0 30px 0;
      font-size: 20px;
    }

    .card{
      border: 1px solid #38f9d7;
      border-radius: 5px;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.1);
      padding: 10px;
      margin-bottom: 10px;
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

    .type{
      font-weight: 600;
      color: #000000;
    }

    .rating-text{
      font-size: 20px;
      color: black;
    }

    .mark-btn{
      width: fit-content;
      color: #ffffff;
      justify-content: center;
      border: 2px solid #66FCF1;
      padding: 12px 22px;
      margin-left: 15px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 500;  
      border-radius: 15px;
      text-decoration: none;
      outline: none;
      background: linear-gradient(#43cae9 0%, #38f9d7 100%);
    }

    .mark-btn:hover{
      background: #43cae9;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }

  </style>
</head>

<body style="background-color: #d3ebe5;">

  <div class="sidenav">
    <img class="logo" src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png">
    <br><br>
    <a href="/webproject"><i class="fa fa-home"></i> Home</a>
    <br>
    <a href="about.php"><i class="fa fa-font"></i> About</a>
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


  <div class="main ">

    <!-- Output div for flash msgs -->
    <?php if(@$_GET["completed"]){ ?>
      <div class="flashMsg">Tutorial Completed! Time for another one</div>
    <?php } ?>

    <h1 align="center">
      <span class="multi-text">Tutorials</span>
    </h1>

    <!-- Form for selecting Tutorial Category -->
    <form action="viewTutorials.php" method="POST">
      <label for="tutorialCategory" class="rating-text">Select Category: </label>
      <select name="tutorialCategory" class="selectpicker show-tick">
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
      <button class="mark-btn" name="select">View Tutorials</button>
    </form>

    <!-- Displaying Tutorials -->
    <?php
    echo "<ol>";
    while($tutorial = mysqli_fetch_assoc($tutorials_SQL_result)){

      echo "<li class='card'>";
      echo "<a href='tutorial.php?id=" . $tutorial["id"] . "'>" . $tutorial["title"] . "</a><br>";
      if($tutorial["video"]){
        echo "<p><span class='type'>Video Based Tutorial - </span> " . $tutorial["description"] ."</p>";
      }
      else{
        echo "<p><span class='type'>Text Based Tutorial - </span> "  . $tutorial["description"] ."</p>";
      }   
      echo "<br></li>";

    }
    echo "</ol>"
    ?>

    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> 

</body>
</html> 


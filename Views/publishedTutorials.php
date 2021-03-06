<?php
  
  //Checking if Teacher is logged in or not
  session_start();

  if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

    $email    = $_SESSION["current_teacher_email"];
    $username = $_SESSION["current_teacher_username"];
      
  }
  else{
    header("location: login.php?notloggedin=true");
  }

  //Adding the required Models
  require_once "../Models/TutorialModel.php";

  $instructor_Tutorials = getTutorialsByTeacherEmail($email);

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Style css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/ViewTutorials.css">
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
      margin-top: 30px;
      margin-bottom: 30px;
      font-size: 20px;
    }

    .card{
      border: 1px solid #38f9d7;
      border-radius: 5px;
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
    <a href="about.php"><i class="fa fa-font"></i> About</a>
    <br>
    <a href="login.php"><i class="fa fa-hand-o-left"></i> Profile</a>
    <br>   
    <a href="teacherLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>   
    <br>
  </div>


<div class="main ">

  <!-- Output divs for flash msgs -->
  <?php if(@$_GET["deleted"]){ ?>
    <div class="flashMsg">Tutorial Deleted Successfully!</div>
  <?php } ?> 

  <h1 align="center">
    <span class="multi-text">Tutorials Published By You</span>
  </h1>

  <!-- Displaying Published Tutorials -->
  <?php
  echo "<ol>";
  while($tutorial = $instructor_Tutorials->fetch_assoc()) {       
      echo "<li class='card'>";
      echo "<a href='tutorial.php?id=" . $tutorial["id"] . "'>" . $tutorial["title"] . "</a><br>";
      
      if($tutorial["video"]){
      echo "<p><span class='type'>Video Based Tutorial - </span> " . $tutorial["description"] ."</p>";
      }
      else{
        echo "<p><span class='type'>Text Based Tutorial - </span>"  . $tutorial["description"] ."</p>";
      }   
        echo "<br></li>";
  }
  echo "</ol>"
  ?>

</div>

   <!--===== FOOTERpart starts ======-->
    
  <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About our Project</h6>
            <p class="text-justify">Our project is tutoring website for students where teachers can post and edit tutorials while students can see tutorials and can examine themselves through quizes. It is managed by Admin. We have used PHP for backend and HTML, CSS, jQuery and Bootstrap for frontend.</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Contact Information</h6>
            <ul>
              <p>SEECS</p>
              <p>NUST, H12 Campus</p>
              <p>ISLAMABAD</p>
            </ul>
          </div>
          <br><br><br>
          <div class="col-xs-6 col-md-3"><br>
            <ul>
              <p>BESE9B</p>
              <p>Batch'2k18</p>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2021 All rights reserved by Babloo Gang
            </p>
          </div>
        </div>
      </div>
</footer>

    <!--===== FOOTERpart ends ======-->

</body>
</html> 

<?php
    //Checking if Teacher is logged in or not
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
    elseif(isset($_SESSION['admin_email']) && isset($_SESSION['admin_username'])){
        header("location: adminPanel.php?invalidAcess=ture");
    }
    else{
        header("location: login.php?notloggedin=true");
    }

    //Adding the required Models
    require_once "../Models/TutorialModel.php";
    require_once "../Models/TutorialCategoryModel.php";
    require_once "../Models/UserModel.php";
    require_once "../Models/ParagraphModel.php";
    require_once "../Models/QuizModel.php";
    require_once "../Models/StudentTutorialBridgeModel.php";

    //Extracting Tutorial ID from URL and fetching the respective Tutorial
    $tutorial_id = $_GET["id"];
    $tutorial    = getTutorialByID($tutorial_id);

    //Check If the tutorial doesnt exist 
    if($tutorial["id"] == ""){
        echo "<h1>NO TUTORIAL FOUND</h1>";
        exit();
    }

    //Extracting the Tutorial Information
    $title               = $tutorial["title"];
    $tutorial_instructor = getTeacherByEmail($tutorial["instructor"]);
    $category            = getCategoryNameByID($tutorial["category_id"]);
    $video_path          = $tutorial["video"];

    //Fetching the paragraphs of tutorial
    $current_tutorial_pargraphs_SQL_result = getParagaphsByTutorialID($tutorial_id);

    //Fetching all the quizes for tutorial
    if($student_loggedin){
        $current_tutorial_quizzes_SQL_result = getQuizByTutorialID($tutorial_id);
    }

    //Checking if the student has already completed the tutorial
    if($student_loggedin){
        $rating = getRatingByStudentEmailandTutorialID($student_email, $tutorial_id)["tutorial_rating"];
    }

    //Fetching the tutorial rating and number of ratings
    $avg_tutorial_rating = getTutorialAvgRating($tutorial_id)[0];
    $num_tutorial_rating = getTutorialNumOfRatings($tutorial_id)[0];

    //Fetcing the info of logged in teacher and all of his published tutorials
    if($teacher_loggedin){
        $current_teacher                      = getTeacherByEmail($teacher_email);
        $current_teacher_tutorials_SQL_result = getTutorialsByTeacherEmail($current_teacher["email"]);
    }

    //Checking if this is the logged in instructor's own tutorial
    $match = 0;
    if($teacher_loggedin){
        while($tutorial = $current_teacher_tutorials_SQL_result->fetch_assoc()){

            //echo "Tuorial ID: " . $tutorial["id"] . "<br>";
            if($tutorial["id"] == $tutorial_id){
                $match += 1;
            }
        }
    }

    //Closing the DB Connection
    $database_connection->close(); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tutorial</title>

        <!-- CSS Link for Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
            }

            .multi-text {
                background-image: linear-gradient(to left, #43cae9 0%, #38f9d7 100%);
                -webkit-background-clip: text;
                -moz-background-clip: text;
                background-clip: text;
                color: transparent;
                font-size: 45px;
                font-weight: bold;
            }

            .container { 
                display: flex;
                justify-content: space-between;
                margin: 0; 
                width:100%; 
                background: white; 
                height: 100px; 
            }

            .white-box { 
                width: 300px; 
                height: 100px;
                display: flex;
                flex-direction: row;
                background: rgba(255,255,255,0.3);
                padding: 0 15px;
                box-shadow: 0 1px 2px rgba(0,0,0,0.50);
                border-radius: 5px;
            }

            .white-box:hover{
                cursor: pointer;
                background: #AFEEEE;
                width: 320px;
                height: 90px;
            }

            .main-content1{
                font-size: 35px;
                display: flex;
                flex-direction: column;
                color: #708090;
                text-decoration: none;
            }

            .main-content2{
                font-size: 26px;
                display: flex;
                flex-direction: column;
                color: black;
                text-decoration: none;
            }

            .main-content3{
                display: flex;
                flex-direction: column;
                margin-left: 50px;
                font-size: 18px;
                color: grey;
            }

            .rating-text{
                font-size: 20px;
                color: black;
            }

            .mark-btn{
                display: flex;
                width: fit-content;
                color: #ffffff;
                justify-content: center;
                border: 2px solid #66FCF1;
                padding: 12px 22px;
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
            .video{
                text-align: center;
            }

            /* Style of SideBar */
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
              background-color: #76e060;
              opacity: 0.7;
              border-radius: 5px;
              margin: 40px 50px 0px 50px;
              text-align: center;
              font-size: 15px;
              padding: 5px 0 5px 0;
            }

            .quizLink{
                font-size: 20px;
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
            <a href="about.php"><i class="fa fa-font"></i> About</a>
            <br>
            <a href="login.php"><i class="fa fa-hand-o-left"></i> Return to Profile</a>
            <br>
            <?php if($teacher_loggedin){ ?>
                <a href="teacherLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
            <?php }elseif($student_loggedin){ ?>
                <a href="studentLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
            <?php } ?>
            <br>
        </div>


        <div class="main">

            <!-- Output divs for flash msgs -->
            <?php if(@$_GET["edited"]){ ?>
                <div class="flashMsg">Tutorial Edited Successfully!</div>
            <?php } ?>

          <h1><span class="multi-text"><?php echo $title ?></span></h1><br>

          <!-- Blocks for rating, teacher and email -->
          <div class="container">
            <div class="white-box">
                <h4>
                    Rating:
                    <?php echo $avg_tutorial_rating ? $avg_tutorial_rating : 0 ?> 
                    (<?php echo $num_tutorial_rating ?>)
                </h4>
            </div>
            <div class="white-box">
                <h4>
                    Instructor: <?php echo $tutorial_instructor["username"] ?>
                </h4>
            </div>
            <div class="white-box">
                <h4>
                    Contact Instructor at:<br>
                    <?php echo $tutorial_instructor["email"] ?>
                </h4>
            </div>
            <div class="white-box">
                <h4>
                    Category: <?php echo $category["name"] ?>
                </h4>
            </div>
          </div>
          <br><br>

          <!-- Content for Category, Heading and Paragraph Content-->
          <div class="main-content">

            <!-- Video -->
            <?php if($video_path){ ?>
            <h2 class="main-content2">Video</h2>
            <div class="video">
                <video width="640" height="480" controls>Your browser does not support the video tag.
                    <source src="<?php echo $video_path ?>"/>
                </video>
            </div>
            <?php } ?> 

            <!-- Dispaying Paragraphs of the Tutorial -->
            <?php
            while($paragraph = $current_tutorial_pargraphs_SQL_result->fetch_assoc()){

                echo "<h2 class='main-content2'>" . $paragraph["heading"]  . "</h2>";
                echo "<p class='main-content3'>"  . $paragraph["content"]  . "</p>";
            }   
            ?>
            
          </div>
          <br><br>

        <!-- Checking if the current user is a teacher and if its his own tutorial, and displaying the relevant information -->
        <?php if($match > 0){ ?>
        <!-- Form for going to Edit Tutorial Page along with the tutorial ID -->
        <form name="editTutorialForm" action="editTutorial.php" method="POST">

            <input type="hidden" name="tutorial_id" value="<?php echo $tutorial_id ?>">
            <button class="mark-btn" name='edit'>Edit</button>
        </form><br>

        <!-- Form for going to Creatae Quiz along with the tutorial ID -->
        <form name="addQuizForm" action="createQuiz.php" method="POST">

            <input type="hidden" name="tutorial_id" value="<?php echo $tutorial_id ?>">
            <button class="mark-btn" name='create'>Add Quiz for Tutorial</button>
        </form><br>

        <!-- Form for Deleting the Tutorial along with the tutorial ID -->
        <form name="deleteTtorialForm" action="../Controllers/DeleteForTeacherController.php" method="POST">

            <input type="hidden" name="tutorial_id" value="<?php echo $tutorial_id ?>">
            <button class="mark-btn" name='delete'>Delete Tutorial</button>
        </form><br>

        <!-- Form for viewing all quizes for tutorial -->
        <form name="viewQuizForm" action="viewQuiz.php" method="POST">
            <input type="hidden" name="tutorial_id" value="<?php echo $tutorial_id ?>">
            <button class="mark-btn" name='view'>view Quizzes for Tutorial</button>
        </form>

        <?php } ?>

        <!-- Checking if the current user is a student and displaying student relevant information -->
        <?php if($student_loggedin){ ?>
            <!-- If student is new to this tutorial -->
            <?php if(!$rating){ ?>
            <!-- Form for marking current tutorial as comepleted along with the tutorial ID -->
            <form name="completedTutrial" action="../Controllers/CompletedTutorialController.php" method="POST">

                <input type="hidden" name="tutorial_id" value="<?php echo $tutorial_id ?>">
                <input type="hidden" name="student_email" value="<?php echo $student_email ?>">

                <label for="rating" class="rating-text">Rate this Tutorial: </label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select class="selectpicker show-tick" data-style="btn-info" name="rating"        required>
                    <option value="">None</option>
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                </select>
                <br><br>

                <button class="mark-btn" name='completed'>Mark as Completed</button>

            </form>
            <!-- If student has already completed the tutorial -->
            <?php } else{ ?>
                <p class='main-content3' style="color: green">
                    You have already completed this tutorial
                </p>
                <p class='main-content3' style="color: green">
                    You gave it <?php echo $rating ?> stars
                </p>
            <?php } ?>
        <?php } ?>
        <br><br>

        <!-- Displaying Attempt Quiz Links -->  
        <?php
        if($student_loggedin){
            echo "<h3><span class='main-content1'>Quizzes:</span></h3>";
            $quiz_num = 1;
            while($quiz = $current_tutorial_quizzes_SQL_result->fetch_assoc()){
                echo "<a class='quizLink' href='quiz.php?id=" . $quiz["id"] . "'>" . $quiz_num . ")Attempt Quiz: " . 
                     $quiz["topic"] . "</a><br>";
                $quiz_num += 1;
            }
            
            //Notifying Student if no Quiz is uploaded for this tutorial
            if(!($quiz_num > 1)){
                echo "<p class='main-content3'>No Quiz uploaded for this tutorial</p>";   
            }
        }
        ?>
        <br><br><br>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> 

    </body>
</html> 
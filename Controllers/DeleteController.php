<?php
	//Starting Session
    session_start();

    //Making sure only admin is allowed to access this
    if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
		//pass       
    }
    elseif(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username']))
    {
    	header("location: studentProfile.php?invalidAccess=true");
    }
    elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username']))
    {
    	header("location: teacherProfile.php?invalidAccess=true");
    }
    else{
    	header("location: adminLogin.php?notloggedin=true");
    }

    //Adding the Required Models
    require_once "../Models/UserModel.php";
    require_once "../Models/TutorialCategoryModel.php";
    require_once "../Models/TutorialModel.php";
    require_once "../Models/ParagraphModel.php";
    require_once "../Models/QuizModel.php";
    require_once "../Models/QuizQuestionModel.php";

    //Extracting the Tabke
    $table = mysqli_real_escape_string($database_connection, stripslashes($_GET["table"]));

    if(@$_GET["email"]){

    	$email = mysqli_real_escape_string($database_connection, stripslashes($_GET["email"]));
        if($table == "student"){
            deleteStudent($email);

            //Closing the DB Connection
            mysqli_close($database_connection);

            //Redirecting
            header("location: ../Views/studentTable.php?success=true");

        }
        elseif($table == "teacher"){
            deleteTeacher($email);

            //Closing the DB Connection
            mysqli_close($database_connection);

            //Redirecting
            header("location: ../Views/teacherTable.php?success=true");
        }
        else{
            echo "<h1>INVALID TABLE</h1>";
            exit();
        }
    }
    elseif(@$_GET["id"]){

    	$id = mysqli_real_escape_string($database_connection, stripslashes($_GET["id"]));
        if($table == "tutorial_catageory"){
            deleteTutorialCategory($id);

            //Closing the DB Connection
            mysqli_close($database_connection);

            //Redirecting
            header("location: ../Views/tutorialCategoryTable.php?success=true");
        }
        elseif($table == "tutorial"){
            deleteTutorial($id);

            //Closing the DB Connection
            mysqli_close($database_connection);

            //Redirecting
            header("location: ../Views/tutorialTable.php?success=true");

        }
        elseif($table == "paragraph"){
            deleteParagraph($id);

            //Closing the DB Connection
            mysqli_close($database_connection);

            //Redirecting
            header("location: ../Views/paragraphTable.php?success=true");
        }
        elseif($table == "quiz"){
            deleteQuiz($id);

            //Closing the DB Connection
            mysqli_close($database_connection);

            //Redirecting
            header("location: ../Views/quizTable.php?success=true");
        }
        elseif($table == "question"){
            deleteQuestion($id);

            //Closing the DB Connection
            mysqli_close($database_connection);

            //Redirecting
            header("location: ../Views/questionTable.php?success=true");
        }
        else{
            echo "<h1>INVALID TABLE</h1>";
            exit();
        }
    	
    }
    else{
    	echo "<h1>INVALID ACCESS</h1>";
    	exit();
    }



    
?>
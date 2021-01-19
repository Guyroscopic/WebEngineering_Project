<?php	
    //Starting Session
    session_start();

    if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
        header("location: studentProfile.php?invalidAccess=true");
    }

    elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
        $teacher_email    = $_SESSION["current_teacher_email"];
		$teacher_username = $_SESSION["current_teacher_username"];
    }
    //Redirecting in case admin is already logged in 
    elseif(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
        header("location: adminPanel.php?invalidAccess=true");
    }
    else{
		header("location: login.php?notloggedin=true");
	}

    //Adding the required Models
    require_once "../Models/TutorialModel.php";

    //Checking button click
    if(isset($_POST["apply"])){

        $tutorial_id    = mysqli_real_escape_string(
                            $database_connection, stripslashes($_POST["tutorial_id"])
                          );
        $title          = mysqli_real_escape_string(
                            $database_connection,stripslashes($_POST["title"])
                          );
        $description    = mysqli_real_escape_string(
                            $database_connection,stripslashes($_POST["description"])
                          );

        
    }

?>
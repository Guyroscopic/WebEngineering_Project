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
    require_once "../Models/ParagraphModel.php";

    //Checking button click
    if(isset($_POST["apply"])){

        $tutorial_id     = mysqli_real_escape_string(
                            $database_connection, stripslashes($_POST["tutorial_id"])
                           );
        $title           = mysqli_real_escape_string(
                            $database_connection,stripslashes($_POST["title"])
                           );
        $description     = mysqli_real_escape_string(
                            $database_connection,stripslashes($_POST["description"])
                           );
        $paragraphNum    = mysqli_real_escape_string(
                            $database_connection,stripslashes($_POST["paragraph_num"])
                           );

        //Checking for empty Submission
        if(empty($tutorial_id) || empty($title) || empty($description) || empty($paragraphNum)){
            header("location: ../Views/editTutorial.php?id=" . $tutorial_id . "&empty=true");
        }

        //Updating the Tutorial Table
        setTutorialTitleAndDescription($tutorial_id, $title, $description);

        //Fetching tutorial Paragraphs for getting their IDs
        $tutorial_paragraphs = getParagaphsByTutorialID($tutorial_id);        

        for($i=1; $i<$paragraphNum; $i++){

            $heading_name = "heading_" . $i;
            $content_name = "content_" . $i; 
            $paragraph_id = mysqli_fetch_assoc($tutorial_paragraphs)["id"];

            $heading      = mysqli_real_escape_string(
                            $database_connection,stripslashes($_POST[$heading_name])
                            );
            $content      = mysqli_real_escape_string(
                            $database_connection,stripslashes($_POST[$content_name])
                            );

            //Checking for empty Submission
            if(empty($heading) || empty($heading)){
                header("location: ../Views/editTutorial.php?id=" . $tutorial_id . "&empty=true");
            }

            //Updating the Paragaph Table
            setParagraph($paragraph_id, $heading, $content);
        }

        //Code for handling file upload
        $allowedExts = array("mp4", "mov", "mkv");
        $extension   = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);

        if($_FILES["video"]["name"] != ""){
            if ((   ($_FILES["video"]["type"] == "video/mp4")
                 || ($_FILES["video"]["type"] == "video/mov")
                 || ($_FILES["video"]["type"] == "video/mkv")))
                {

                if(($_FILES["video"]["size"] < 256000000)){

                    if(in_array($extension, $allowedExts)){

                        if ($_FILES["video"]["error"] > 0){
                            header("location: ../Views/createTutorial.php?error=" . $_FILES["file"]["error"]);
                        }
                        else{
                            //echo "Upload: " . $_FILES["video"]["name"] . "<br />";
                            //echo "Type: " . $_FILES["video"]["type"] . "<br />";
                            //echo "Size: " . ($_FILES["video"]["size"] / 1024) . " Kb<br />";
                            //echo "Temp file: " . $_FILES["video"]["tmp_name"] . "<br />";
                            
                            $file_path = "../assets/videos/" . "videoForTutorial_" . $tutorial_id . 
                                         "." . $extension;
                            $result = move_uploaded_file($_FILES["video"]["tmp_name"], $file_path);
                            //setTutorialVideo($tutorialID, $file_path);

                            //Closing the DB Connection
                            mysqli_close($database_connection);

                            //Redirecting after successful tutorial creation
                            header("location: ../Views/tutorial.php?id=" . $tutorial_id . "&edited=true");
                        }
                    }
                    else{
                        //Closing the DB Connection
                        mysqli_close($database_connection);

                        //Redirecting with error msg
                        header("location: ../Views/editTutorial.php?id=" . $tutorial_id . "&error=Invalid Extension");
                    }
                }
                else{
                    //Closing the DB Connection
                    mysqli_close($database_connection);

                    //Redirecting with error msg
                    header("location: ../Views/editTutorial.php?id=" . $tutorial_id . "&error=File Size must be less than 256MB");    
                }
               }
               else{
                    //Closing the DB Connection
                    mysqli_close($database_connection);

                    //Redirecting with error msg
                    header("location: ../Views/editTutorial.php?id=" . $tutorial_id . "&error=Invalid File Type");
               }
            }
            else{
                //Closing the DB Connection
                mysqli_close($database_connection);

                //Redirecting after successful tutorial creation
                header("location: ../Views/tutorial.php?id=" . $tutorial_id . "&edited=true");
            }
    }

?>
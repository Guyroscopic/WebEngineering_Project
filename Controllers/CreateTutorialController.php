<?php
	
	/* Initialize Session */
	session_start();

	//Applying Login Check
	if(!isset($_SESSION["current_teacher_email"]) || !isset($_SESSION["current_teacher_username"])){
		header("location: ../Views/login.php?notloggedin=true");
	}
	else{
		$current_teacher_email    = $_SESSION["current_teacher_email"];
		$current_teacher_username = $_SESSION["current_teacher_username"];
	}

	//Adding the required Models
	require_once "../Models/TutorialModel.php";
	require_once "../Models/ParagraphModel.php";

	//print_r(array_keys($_FILES["video"]));
	//echo $_FILES["video"]["type"] . "<br>";
	//echo $_FILES["video"]["size"] . "<br>";
	//echo $_FILES["video"]["tmp_name"] . "<br>";
	//echo $_FILES["video"]["type"] . "<br>";

	//exit();

	//Handling the Form Submission
	if(isset($_POST["create"])){

		$title 			   = $_POST["title"];
		$description	   = $_POST["description"];
		$tutrialCategoryID = $_POST["tutorialCategory"];
		$numOfParagrphs    = $_POST["numOfParagraphs"];
		$instructor        = $current_teacher_email;

		//Checking for empty submissions before processing
		if(empty($title) || empty($description)){
			header("location: ../Views/createTutorial.php?empty=true");
		}

		for($i=1; $i<=$numOfParagrphs; $i++){

			$heading_name = "heading_" . $i;
			$content_name = "content_" . $i;

			$heading      = $_POST[$heading_name];
			$content      = $_POST[$content_name];

			if(empty($heading) || empty($content)){
				header("location: ../Views/createTutorial.php?empty=ture");
			}
		}

		//Adding a Tutorial in the Database
		//$tutorialID  = addTutorial($tutrialCategoryID, $instructor, $title, $description);
		//echo "Tutorial ID: " . $tutorialID . "<br>";
		
		//Adding the paragraphs into the Database
		for($i=1; $i<=$numOfParagrphs; $i++){

			$heading_name = "heading_" . $i;
			$content_name = "content_" . $i;

			$heading      = $_POST[$heading_name];
			$content      = $_POST[$content_name];
			
			//echo "<br>Heading: " . $heading . "<br>" . "Content: " . $content . "<br>";
			//addParagraph($tutorialID, $heading, $content);
		}

		//Code for handling file upload
		$allowedExts = array("mp4", "mov", "mkv");
		$extension   = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);

		if ((   ($_FILES["video"]["type"] == "video/mp4")
			 || ($_FILES["video"]["type"] == "video/mov")
			 || ($_FILES["video"]["type"] == "video/mkv")
			)&& ($_FILES["video"]["size"] < 256000000)
			 && in_array($extension, $allowedExts)
		   )
		   {
			if ($_FILES["video"]["error"] > 0){
				header("location: ../Views/createTutorial.php?error=" . $_FILES["file"]["error"]);
		    }
		    else{
		    	echo "Upload: " . $_FILES["video"]["name"] . "<br />";
			    echo "Type: " . $_FILES["video"]["type"] . "<br />";
			    echo "Size: " . ($_FILES["video"]["size"] / 1024) . " Kb<br />";
			    echo "Temp file: " . $_FILES["video"]["tmp_name"] . "<br />";
			    
			    $file_path = "../assets/videos/" . "videoForTutorial_" . $tutorialID . 
			    			 "." . $extension;
			    $result = move_uploaded_file($_FILES["video"]["tmp_name"], $file_path);

			    //Closing the DB Connection
				$database_connection->close();

			    //Redirecting after successful tutorial creation
			    header("location: ../Views/teacherProfile.php?created=true");
		    }
		   }
		   else{
			   	//Closing the DB Connection
				$database_connection->close();

				//Redirecting with error msg
			   	header("location: ../Views/createTutorial.php?error=invalid File");
		   }		
	}
	else{
		//Closing the DB Connection
		$database_connection->close();

		//Redirecting incase of invalid access through URL		
		header("location: ../Views/createTutorial.php");
	}
?>
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

	//Importing the Required Models
	require_once "../Models/TutorialModel.php";
	require_once "../Models/ParagraphModel.php";

	//Checking form submission	
	if(isset($_POST["edit"])){

		//Extracting the tutorial from the form
		$tutorial_id = $_POST["tutorial_id"];

		//Fetching the Tutorial
		$tutorial = getTutorialByID($tutorial_id);

		//Fetching Tutorial Paragraphs
		$tutoriral_paragraphs_SQL_result = getParagaphsByTutorialID($tutorial_id);

		//Counting the number of paragraphs
		$paragraph_num = 0;
		$temp = getParagaphsByTutorialID($tutorial_id);
		while($paragraph = $temp->fetch_assoc()){
			$paragraph_num += 1;
		}

		//echo "Editing Tutorial with ID: " . $_POST["tutorial_id"] . "<br>";
		//echo "Number of Paragraphs: " . $paragraph_num;

	}
    elseif(@$_GET["empty"] || @$_GET["error"]){

        //Extracting the tutorial from the URL
        $tutorial_id = $_GET["id"];
    }
	else{
		header("location: publishedTutorials.php?invalidAccess=true");
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required Meta Tags-->
        <meta charset="UTF-8">
        <title>Create New Tutorial</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--- CSS Link for Creat New Tutorials-->
        <link href="../assets/css/CreatTutorial.css" rel="stylesheet">
        <style type="text/css">        
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
        </style>

        <!-- CSS Link for Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!-- Importing jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Bootstrap-->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" 
        integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    </head>

    <body>
        <!-- Left Fixed Sidebar-->
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
        
        <!-- Main Content-->

        <!-- Output divs for an empty submissoin -->
        <?php if(@$_GET["empty"]){ ?>
            <div class="flashMsg">OOPS! Looks like you left a field empty</div>
        <?php } ?>

        <!-- Output div for error in video upload -->
        <?php if(@$_GET["error"]){ ?>
            <div class="flashMsg">
                OOPS! Looks like there was an error in your video uplaod<br>
                ERROR: <?php echo $_GET["error"] ?>
            </div>
        <?php } ?>

        <form name="editTorialFrom" action="../Controllers/EditTutorialController.php" method="POST">

        	<div class="tut-bg">

            <!-- Heading of Create Tutorial -->
            <div class="main-tut-header">
                <h1><span class="tut-header">Edit Tutorial</span></h1>
            </div>
            <br>

            <input type="hidden" name="tutorial_id" value=<?php echo $tutorial_id ?>>

            <label>Title:</label>
            <input type="text" name='title' id="title" value="<?php echo $tutorial["title"] ?>" 		   required>         
            <br>

            <label>Description:</label>
            <textarea id="title-desc" name='description' required><?php echo $tutorial["description"] ?></textarea>
            <br>            
            
            <label>Video(optional):</label>    
            <input type="file" id="video" name="video" class='form-control-file'>           
            <br>
            
            <?php
			$paragraph_num = 1;
			while($paragraph = $tutoriral_paragraphs_SQL_result->fetch_assoc()){

				echo "<label>Heading " . $paragraph_num . ": </label>" .
				     "<input type='text' name='heading_" . $paragraph_num . "' class='form-control' value='" . $paragraph["heading"] . 
				     "' required>" . "<br><br>" .
				     "<label>Content: </label>" .
				     "<textarea name='content_" . $paragraph_num . "' class='form-control' required>" . $paragraph["content"] .
				     "</textarea><br><br>";
				$paragraph_num += 1;
			}
			?>

            <button name="apply" class="btn btn-info" style="margin-bottom:10px">
            	Apply Changes
        	</button>           

        </div>
        </form>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>   

    </body>
</html>

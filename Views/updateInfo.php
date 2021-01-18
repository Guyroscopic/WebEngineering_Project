<?php

	session_start();

	if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

        $email    = $_SESSION["current_teacher_email"];
        $username = $_SESSION["current_teacher_username"];            
    }
    elseif(isset($_SESSION['current_student_email']) && isset($_SESSION['current_student_username'])){
    	 header("location: studentProfie.php?invalidAccess=true");
    }
    elseif(isset($_SESSION['admin_email']) && isset($_SESSION['admin_username'])){
    	 header("location: adminLogin.php?invalidAccess=true");
    }
    else{
        header("location: login.php?notloggedin=true");
    }

    if(@$_GET["error"]){
    	echo "<div style='color:red'>An Error Occured</div>";
    }

	include "../Models/UserModel.php";

	// fetching the teacher record frorm database
	$teacher_record = getTeacherByEmail($email);

	if(!empty($teacher_record["education"])){
		$education = $teacher_record["education"];
	}
	else{
		$education = "";
	}

	if(!empty($teacher_record["description"])){
		$description = $teacher_record["description"];
	}
	else{
		$description = "";
	}
?>


<!DOCTYPE html>
<html>
    <head>
        <!-- Required Meta Tags-->
        <meta charset="UTF-8">
        <title>Update Information</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--- CSS Link for Creat New Tutorials-->
        <link href="../assets/css/CreatTutorial.css" rel="stylesheet">

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

        <form name="editInfoForm" method="POST" action="../Controllers/UpdateInfoController.php">

        <div class="tut-bg">

            <!-- Heading of Create Tutorial -->
            <div class="main-tut-header">
                <h1><span class="tut-header">Update Your Information</span></h1>
            </div>
            <br>
  			
			<label>Qualification</label>
			<input type="text" name="education" class="form-control" value=<?php echo $education; ?>>

			<br><br>

			<label>Description</label>
			<textarea name="description" class="form-control"><?php echo $description; ?></textarea>

			<input type="hidden" name="email" value=<?php echo $email; ?>>

			<br><br>

			<button type="submit" name="updateinfo" class="btn btn-info">Update</button>          

        </div>
        </form>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>   

    </body>
</html>
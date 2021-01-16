<?php
	//Starting Session
    session_start();

    //Redirecting in case admin is not logged in 
    if(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){

    	$email    = $_SESSION['admin_email'];
    	$username = $_SESSION['admin_username'];        
    }
    else{
    	header("location: adminLogin.php?notloggedin=true");
    }

    //Adding the required Models
    require_once "../Models/AdminModel.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
</head>
<body>

	<h1>Welcome <?php echo $username ?></h1>

	<h3>You have Add and Delete Rights on:</h3>
	<ul>
		<li><a href="studentTable.php">Student Table</a></li>
		<li><a href="teacherTable.php">Teacher Table</a></li>
		<li><a href="tutorialCategoryTable.php">Tutorial Category Table</a></li>
	</ul>

	<h3>You have Viewing Rights on:</h3>
	<ul>
		<li><a href="studentTutorialBridgeTable.php">Student Tutorial Bridge Table</a></li>
		<li><a href="#">Student Quiz Brirdge Table</a></li>
	</ul>

	<h3>You have Deleting Rights on:</h3>
	<ul>
		<li><a href="tutorialTable.php">Tutorial Table</a></li>
		<li><a href="paragraphTable.php">Paragraphs Table</a></li>
		<li><a href="quizTable.php">Quiz Table</a></li>
		<li><a href="questionTable.php">Question Table</a></li>
	</ul>

	<h3>You have Adding Rights on:</h3>
	<ul>
		<li><a href="adminTable.php">Admin Table</a></li>
	</ul>

	<a href="adminLogout.php">Logout</a>

</body>
</html>
<?php
	//Starting Session
    session_start();
    
    //Redirecting in case user is already logged in 
    if(isset($_SESSION['current_student_email']) and isset($_SESSION['current_student_username'])){
        header("location: studentProfile.php?invalidAccess=true");
    }
    elseif(isset($_SESSION['current_teacher_email']) and isset($_SESSION['current_teacher_username'])){
        header("location: teacherProfile.php?invalidAccess=true");
    }
    //Redirecting in case admin is already logged in 
    elseif(isset($_SESSION['admin_email']) and isset($_SESSION['admin_username'])){
        //pass
    }
    else{
    	header("location: adminLogin.php?notloggedin=true");
    }

    //Adding the required Models
    require_once "../Models/QuizModel.php";

    //Fetching the Student table form the database
    $quiz_table = getQuizTable();

    //Closing database connection
    mysqli_close($database_connection);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Quiz Table</title>
	<style>
		table, td, th{
			border: 1px solid black;
			border-collapse: collapse;
			padding: 10px;
		}
	</style>
</head>
<body>

	<?php if(@$_GET["success"]){ ?>
		<div style="color: green">Quiz Deleted Successfully!</div>
	<?php } ?>

	<!-- Table tag for displaying the student table -->
	<table>
		<tr>
			<th>ID</th>
			<th>Tutorial ID</th>
			<th>Quiz Topic</th>
			<th>Action</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($quiz_table)){ ?>
		<tr>
			<td><?php echo $row["id"] ?></td>
			<td><?php echo $row["tutorial_id"] ?></td>
			<td><?php echo $row["topic"] ?></td>
			<td><a href='../Controllers/DeleteController.php?table=quiz&id=<?php echo $row["id"] ?>'>Delete</a></td>
		</tr>
		<?php } ?>
	</table>

</body>
</html>
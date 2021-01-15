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
    require_once "../Models/QuizQuestionModel.php";

    //Fetching the Student table form the database
    $question_table = getQuestionTable();

    //Closing database connection
    mysqli_close($database_connection);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Quuestion Table</title>
	<style>
		table, td, th{
			border: 1px solid black;
			border-collapse: collapse;
			padding: 10px;
		}
	</style>
</head>
<body>

	<!-- Table tag for displaying the student table -->
	<table>
		<tr>
			<th>ID</th>
			<th>Quiz ID</th>
			<th>Statment</th>
			<th>Option 1</th>
			<th>Option 2</th>
			<th>Option 3</th>
			<th>Option 4</th>
			<th>Correct Option</th>
			<th>Action</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($question_table)){ ?>
		<tr>
			<td><?php echo $row["id"] ?></td>
			<td><?php echo $row["quiz_id"] ?></td>
			<td><?php echo $row["statement"] ?></td>
			<td><?php echo $row["option1"] ?></td>
			<td><?php echo $row["option2"] ?></td>
			<td><?php echo $row["option3"] ?></td>
			<td><?php echo $row["option4"] ?></td>
			<td><?php echo $row["correct_option"] ?></td>
			<td><a href="#">Delete</a></td>
		</tr>
		<?php } ?>
	</table>

</body>
</html>
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
    require_once "../Models/UserModel.php";

    //Fetching the Student table form the database
    $student_table = getStudentTable();	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Table</title>
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
		<div style="color: green">Student Deleted Successfully!</div>
	<?php } ?>

	<!-- Anchor tag for adding a student -->
	<a href="addStudent.php">Add a Student</a><br><br>

	<!-- Table tag for displaying the student table -->
	<table>
		<tr>
			<th>Email ID</th>
			<th>Username</th>
			<th>Action</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($student_table)){ ?>
		<tr>
			<td><?php echo $row["email"] ?></td>
			<td><?php echo $row["username"] ?></td>
			<td><a href='../Controllers/DeleteController.php?table=student&email=<?php echo $row["email"] ?>'>Delete</a></td>
		</tr>
		<?php } ?>
	</table>

</body>
</html>
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
    require_once "../Models/TutorialModel.php";

    //Fetching the Student table form the database
    $tutorial_table = getTutorialTable();

    //Closing database connection
    mysqli_close($database_connection);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tutorial Table</title>
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
			<th>Tutorial ID</th>
			<th>Category ID</th>
			<th>Instructor Email</th>
			<th>Title</th>
			<th>Action</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($tutorial_table)){ ?>
		<tr>
			<td><?php echo $row["id"] ?></td>
			<td><?php echo $row["category_id"] ?></td>
			<td><?php echo $row["instructor"] ?></td>
			<td><?php echo $row["title"] ?></td>
			<td><a href="#">Delete</a></td>
		</tr>
		<?php } ?>
	</table>

</body>
</html>
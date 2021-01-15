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
    require_once "../Models/StudentTutorialBridgeModel.php";

    //Fetching the Student table form the database
    $student_tutorial_bridge_table = getStudentTutorialBridgeTable();	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Tutorial Bridge Table</title>
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
			<th>Student Email ID</th>
			<th>Tutorial ID</th>
			<th>Tutorial Rating By Student</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($student_tutorial_bridge_table)){ ?>
		<tr>
			<td><?php echo $row["student_email"] ?></td>
			<td><?php echo $row["tutorial_id"] ?></td>
			<td><?php echo $row["tutorial_rating"] ?></td>
		</tr>
		<?php } ?>
	</table>

</body>
</html>
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
    require_once "../Models/TutorialCategoryModel.php";

    //Fetching the Student table form the database
    $tutorial_category_table = getTutorialCategoryTable();	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tutorial Category Table</title>
	<style>
		table, td, th{
			border: 1px solid black;
			border-collapse: collapse;
			padding: 10px;
		}
	</style>
</head>
<body>

	<!-- Output divs for flash msgs -->
	<?php if(@$_GET["added"]){ ?>
        <div style="color: green">Tutorial Category Added Successfuly!</div>
    <?php } ?>

    <?php if(@$_GET["success"]){ ?>
		<div style="color: green">Tutorial Category Deleted Successfully!</div>
	<?php } ?>

	<!-- Anchor tag for adding a student -->
	<a href="addTutorialCategory.php">Add a Tutorial Category</a><br><br>

	<!-- Table tag for displaying the student table -->
	<table>
		<tr>
			<th>Category ID</th>
			<th>Category Name</th>
			<th>Acion</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($tutorial_category_table)){ ?>
		<tr>
			<td><?php echo $row["id"] ?></td>
			<td><?php echo $row["name"] ?></td>
			<td><a 
				href='../Controllers/DeleteController.php?table=tutorial_categeory&id=<?php echo $row["id"] ?>'>Delete
			</a></td>
		</tr>
		<?php } ?>
	</table>

</body>
</html>
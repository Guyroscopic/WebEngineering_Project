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

<html>

	<h3>Update Information</h3>

	<form name="editInfoForm" method="POST" action="../Controllers/UpdateInfoController.php">

		<label>Qualification</label>
		<input type="text" name="education" value=<?php echo $education; ?>>

		<br><br>

		<label>Description</label>
		<textarea name="description"><?php echo $description; ?></textarea>

		<input type="hidden" name="email" value=<?php echo $email; ?>>

		<br><br>
		<button type="submit" name="updateinfo">Update</button>

	</form>



</html>
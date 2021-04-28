<?php

	include '../Models/UserModel.php';

	if(isset($_POST["updateinfo"])){

		// fetching values from the POST request
		$email 	   = $_POST["email"];
		$education = $_POST["education"];
		$description = $_POST["description"];


		$updateinfo = updateTeacherInfo($email, $education, $description);
 
		if($updateinfo){
			header("location: ../Views/teacherProfile.php");
		} 
		else{
			//echo "Error";
			header("location: ../Views/updateinfo.php?error=true");
		}





	}

?>
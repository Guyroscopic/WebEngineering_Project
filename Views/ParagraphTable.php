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
    require_once "../Models/ParagraphModel.php";

    //Fetching the Student table form the database
    $paragraph_table = getParagraphTable();

    //Closing database connection
    mysqli_close($database_connection);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Paragraph Table</title>

	<meta charset = "UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
	<!-- CSS Link for Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
	<style>

		table, td, th{
			border: 1px solid black;
			border-collapse: collapse;
			padding: 10px;
		}

		 body{
            font-family: 'Poppins', sans-serif;
            background: white;   
        }

        .multi-text{
            background-image: linear-gradient(to left, #43cae9 0%, #38f9d7 100%);
            -webkit-background-clip: text;
            -moz-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: bold;
            font-size: 50px;
        }

        #add{
            font-size: 20px; 
            text-align: center;
            line-height:1em;
            padding: 10px;
            color: #ffffff;
            background: #43cae9;
            border: 2px solid #43cae9;
            border-radius: 10px;
            font-weight: bold;
        }

        #add a{
            text-decoration: none;
            text-transform: uppercase;
            color: #ffffff;
        }

        #add:hover{
            text-decoration: none;
            background: #66FCF1;
        }

        .container th {
            font-weight: 600;
            font-size: 20px;
            text-align: left;
            color: black;
            background-color: darkgray;
        }

        .container td {
            font-size: 20px;
            color: black;
            -webkit-box-shadow: 0 2px 2px -2px #0e1819;
            -moz-box-shadow: 0 2px 2px -2px #0E1119;
            box-shadow: 0 2px 2px -2px #0E1119;
        }

        .container td:last-child{
            font-size: 20px;
            color: black;
            -webkit-box-shadow: 0 2px 2px -2px #0e1819;
            -moz-box-shadow: 0 2px 2px -2px #0E1119;
            box-shadow: 0 2px 2px -2px #0E1119;
        }

        .container {
            text-align: left;
            overflow: hidden;
            width: 100%;
            margin: 0 auto;
            display: table;
            padding: 0 0 8em 0;
            border-radius: 15px;
        }

        .container td, .container th {
            padding-bottom: 1%;
            padding-top: 1%;
            padding-left: 1%; 
        }

        .container td:last-child{
            padding-bottom: 1%;
            padding-top: 1%;
        }

        /* Background-color of the odd rows */
        .container tr:nth-child(odd) {
            background-color: lightgray;
        }

        /* Background-color of the even rows */
        .container tr:nth-child(even) {
            background-color: darkgray;
        }

        .container tr:hover {
            background-color: #C7C6C1;
            -webkit-box-shadow: 0 6px 6px -6px #0E1119;
            -moz-box-shadow: 0 6px 6px -6px #0E1119;
            box-shadow: 0 6px 6px -6px #0E1119;
            transform: translate3d(6px, -6px, 0);
            transition-delay: 0s;
            transition-duration: 0.4s;
        }
         .flashMsgGreen{
	        color: #fff;
	        background-color: #76e060;
	        opacity: 0.7;
	        border-radius: 5px;
	        margin: 0px 50px 0px 50px;
	        text-align: center;
	        font-size: 15px;
	        padding: 5px 0 5px 0;
    	}
        td, th{
            
        }
        
        
	</style>
</head>
<body>

	<?php if(@$_GET["success"]){ ?>
		<div class="flashMsgGreen">Paragraph Deleted Successfully!</div>
	<?php } ?>

	<h1><span class="multi-text">View Paragraph Database</span></h1>

	<!-- Table tag for displaying the student table -->
	<table class="container">
		<thead>
		<tr>
			<th>ID</th>
			<th>Tutorial ID</th>
			<th>Paragraph Heading</th>
			<th>Paragraph Content</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php while($row = mysqli_fetch_assoc($paragraph_table)){ ?>
		<tr>
			<td style="min-width: 50px;"><?php echo $row["id"] ?></td>
			<td style="min-width: 60px;"><?php echo $row["tutorial_id"] ?></td>
			<td><?php echo $row["heading"] ?></td>
			<td style="max-width: 2200px;"><?php echo $row["content"] ?></td>
			<td><a href='../Controllers/DeleteController.php?table=paragraph&id=<?php echo $row["id"] ?>'>Delete</a></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">

    <!-- Title -->
    <title>Web Project</title>


    <!-- Bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Line Icons css -->
    <link rel="stylesheet" href="assets/css/LineIcons.css"> 
    
    <!-- Slick css -->
    <link rel="stylesheet" href="assets/css/slick.css"> 

    <!-- Animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">

    <!-- Default css -->
    <link rel="stylesheet" href="assets/css/default.css">

    <!-- Style css -->
    <link rel="stylesheet" href="assets/css/style.css">


</head>
<body>

	<?php
		//require 'DBinit.php';
		if(@$_GET["loggedout"] == true){
	?>
		<div style="color: green">Logged out Successfully!</div>
	<?php } ?>

	<h1>This is the Home Page</h1>

	<ul>
		<li><a href="/webproject">Home</a></li>		
		<li><a href="Views/about.php">About</a></li>
		<li><a href="Views/login.php">Login</a></li>
		<li><a href="Views/register.php">Register</a></li>
	</ul>
	
</body>
</html>
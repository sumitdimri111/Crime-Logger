<?php 
session_start();
if(!isset($_SESSION['username']) && empty($_SESSION['username']))
	{
    	header('location: login.php');
  	}
?>
<!DOCTYPE html>
<html>
	<head>
			<title>User Registration</title>
			<link rel="stylesheet" type="text/css" href="style.css">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
<body>
	<div class="row" style="background-color: lightblue;">
			<div class="col-md-3">	
				<img src="images/911.png" alt="Stop" class="img-responsive center-block" style="height: 180px; width: 100%;">
			</div>
			<div class="col-md-6">	
				<img src="images/pic4.png" alt="Stop" class="img-responsive center-block" style="height: 180px; width: 100%;">
			</div>
			<div class="col-md-3">
				<img src="images/crime-stop.jpg" alt="Stop" class="img-responsive center-block" style="height: 180px; width: 100%;">
			</div>
		</div>
	
		<div class="row">
		    <div class="col-md-2 left_screen" style="background-color: gray; height: 150vh;"> 
			    <a class="btn btn-danger form-control" href="home.php" ">Home</a> <br>
   			    <a class="btn btn-danger form-control" href="complaint.php">Upload Complaint</a>
			    <a class="btn btn-danger form-control" href="show.php" ">Show crime</a> <br>
			    <a class="btn btn-danger form-control" href="contact.php" ">Contact us</a> <br>
			    <a class="btn btn-danger form-control" href="about.php">About</a>
			    <a class="btn btn-danger form-control" href="logout.php" ">Logout</a> <br>
      		</div>
	
			<div class="col-md-10 right_screen">
			</div>
		</div>
</body>
</html>
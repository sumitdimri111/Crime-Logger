<?php include('server.php'); ?>
<?php include('errors.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Crime Logger</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>		
	</head>

	<body>
		<div class="row" style="background-color: red; height: 180px">
			<div class="col-md-3">	
				<img src="images/911.png" alt="Stop" class="img-responsive center-block" style="height: 180px; width: 100%;">
			</div>
			<div class="col-md-6">	
				<img src="images/pic4.png" alt="Stop" class="img-responsive center-block" style="height: 180px; width: 100%;">
			</div>
			<div class="col-md-3">
			 <!-- style="background-image: url('images/crime-stop.jpg'); height: 180px; width: 100%;"> -->
				<img src="images/crime-stop.jpg" alt="Stop" class="img-responsive center-block" style="height: 180px; width: 100%;">
			</div>;
		</div>
	
		<div class="row">
		    <div class="col-md-2" style="background-color: gray; height: 150vh;"> 
			    <a class="btn btn-danger form-control" href="show.php" ">Show crime</a> <br>
			    <a class="btn btn-danger form-control" href="contact.php" ">Contact us</a> <br>
			    <a class="btn btn-danger form-control" href="about.php">About</a>
      		</div>

		<div class="col-md-10 right_screen">
			<div class="header">
				<h2>Register</h2>
			</div>
			<form method="post" action="registor.php">
				<div class="input-group">
				  <label>Username</label>
				  <input type="text" name="username">
				</div>
				<div class="input-group">
				  <label>Email</label>
				  <input type="email" name="email">
				</div>
				<div class="input-group">
				  <label>Password</label>
				  <input type="password" name="password_1">
				</div>
				<div class="input-group">
				  <label>Confirm password</label>
				  <input type="password" name="password_2">
				</div>
				<div class="input-group">
				  <button type="submit" class="reg_btn" name="reg_user">Register</button>
				</div>
				<p>
					Already a member? <a href="login.php">Sign in</a>
				</p>
			</form>
		</div>
	</div>
	</body>
</html>
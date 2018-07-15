<?php 
	session_start();
	if(!isset($_SESSION['username']) && empty($_SESSION['username']))
	{
		echo "<script type='text/javascript'> alert('Please Login to upload complaint!'); </script>";
    	header('location: login.php');
  	}
	$db = mysqli_connect('localhost', 'root', '', 'registration');

	if(isset($_POST['upload']))
	{
		$username = $_SESSION['username'];
		$complaint_type = $_POST['complaint_type'];
		$complaint_description = $_POST['complaint_description'];
		$time_of_crime = $_POST['time_of_crime'];
		$date_of_crime = $_POST['date_of_crime'];
		$crime_location = $_POST['crime_location'];

		$city = str_replace(' ', '+', $crime_location);
		$data = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($crime_location)."&sensor=true");
		if(!$data) {
			echo "<script type='text/javascript'> alert('Invalid Location!'); </script>";
			header('location : complaint.php');
		}
		$longitude = json_decode($data)->results[0]->geometry->location->lng;
		$latitude = json_decode($data)->results[0]->geometry->location->lat;
  	

			$query = "INSERT INTO complaint(username, complaint_type, complaint_description, time_of_crime, date_of_crime, crime_location, latitude, longitude) VALUES('$username', '$complaint_type', '$complaint_description', '$time_of_crime', '$date_of_crime', '$crime_location', '$latitude', '$longitude')";
			if($latitude != 0 && $longitude != 0) {
				mysqli_query($db, $query);
			//header('location: home.php');
			echo "<script type='text/javascript'> alert('Complaint uploaded successfully!'); </script>";
			}
			else
			{
				echo "<script type='text/javascript'> alert('Invalid Location!'); </script>";
			}

	}
?>
<!DOCTYPE html>
<html>
	<head>
			<title> User Registration </title>
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
			    <a class="btn btn-danger form-control" href="about.php">About</a>
			    <a class="btn btn-danger form-control" href="contact.php" ">Contact us</a> <br>
			    <a class="btn btn-danger form-control" href="logout.php" ">Logout</a> <br>
      		</div>
	
			<div class="col-md-10 comp right_screen" style="background-image: url('images/brick.jpg'); height: 150vh;">
				<div class="header">
					<h2> Upload Details </h2>
				</div>
				<form method="post" enctype="multipart/form-data" action="complaint.php" style="background-image: url('images/brick.jpg');">
					<div class="input-group">
					  <label> Complaint Type </label>
						  <select name="complaint_type">
						  	<option>Kidnapping</option>
						  	<option>Murder</option>
						  	<option>Rape</option>
						  	<option>Robbery</option>
						  </select>
					</div>
					<div class="input-group">
					  <label> Complaint Description </label>
					  <input type="text" name="complaint_description">
					</div>
					<div class="input-group">
					  <label> Time of Crime </label>
					  <input type="time" name="time_of_crime">
					</div>
					<div class="input-group">
					  <label> Data of Crime </label>
					  <input type="date" name="date_of_crime">
					</div>
					<div class="input-group">
					  <label> Crime Location </label>
					  <input type="text" id="place" name="crime_location">
					</div>
					<!-- <div class="input-group">
					  <label> Upload Images </label>
					  <input type="file" name="image1">
					</div> -->
					<div class="input-group">
					  <button type="submit" class="upload_btn" name="upload"> Upload </button>
					</div>
				</form>
			</div>
		</div>

		<script>
			function initAutocomplete() 
      		{
        		var search = new google.maps.places.SearchBox(document.getElementById('place'));
			}
		</script>
		<script 
		async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzryhoilydlqFFfxLfSzZ-toUIJ1y0xAs&libraries=places&callback=initAutocomplete">
    	</script>

	</body>
</html>
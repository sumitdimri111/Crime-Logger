<?php 
session_start();
	if(isset($_SESSION['username']) && !empty($_SESSION['username']))
	{
    	header('location: show.php');
  	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		  <style>
		      #map
		      {
		        height: 650px;
		      }
		      html, body 
		      {
		        height: 650px;
		        margin: 0;
		        padding: 0;
		      }

      /*.pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }*/

      /*#pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }
*/
      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      /*.pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }*/

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }
		    </style>

			<title>Crime City</title>
			<link rel="stylesheet" type="text/css" href="style.css">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	</head>
	<body>
	 <!-- onload="initialize()"> -->
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
		    <div class="col-md-2 left_screen" style="background-color: gray; height: 100vh;"> 
			    <a class="btn btn-danger form-control" href="complaint.php">Upload Complaint</a>
			    <a class="btn btn-danger form-control" href="show.php" ">Show crime</a> <br>
			    <a class="btn btn-danger form-control" href="contact.php" ">Contact us</a> <br>
			    <a class="btn btn-danger form-control" href="about.php">About</a>
      		</div>

			<div class="col-md-10 comp right_screen" style="height: 100vh;">
		   		<input type="text" id="pac-input" class="controls" placeholder="Search Your location">
				<!-- <button type="submit" name="search_btn"> Search </button> -->

			    <div id="map"></div>
		    	
<!-- 			    	// $address = str_replace(" ", "+", $_POST['c_loc']);
					    // $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
					    // $json = json_decode($json);
					    // $latitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
					    // $longitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
 -->
				<script>
					var marker;
					var map;
				    function initAutocomplete()
				    {
				        var infoWindow = new google.maps.InfoWindow;
				        map = new google.maps.Map(document.getElementById('map'), {
							center: {lat: 30.3165, lng: 78.0322},
				        	zoom: 10
				        });
							<?php
    							$con = mysqli_connect('localhost', 'root', '', 'registration');
				                $sql = mysqli_query($con,"select * from complaint");
				                if(mysqli_num_rows($sql) > 0)
				                {
								    while($row=mysqli_fetch_array($sql))
								    {
										$username = $row['username'];
								      	$latitude = $row['latitude'];
								      	$longitude = $row['longitude'];
								      	$complaint_type = $row['complaint_type'];
								      	$complaint_description = $row['complaint_description'];
								      	$time = $row['time_of_crime'] . ' : ' . $row['date_of_crime'];
								      	$crime_location = $row['crime_location'];
								      	$vote = $row['vote'];

								      	$detail  = 	'<b>  Username : '. $username .
										      		'<br> Area : '. $crime_location .
										      		'<br> Complaint type : '. $complaint_type .
										      		'<br> Time : '. $time.
										      		'<br> Description : '. $complaint_description.'<br><br>'.
										      		// 'Vote fot crime '.' : '.
										      		// '<button onclick="update(1)"> Yes </button>' .
										      		// '<button onclick="update(0)"> No </button>' .
										      		// '<button onclick="update(2)"> Dont Know </button>' .
										      		'<b>';

								      	echo("addMarker($latitude, $longitude, '$detail');\n");
									}
				                }
				                else
				                {
				                	die("No rows selected!");
				                }
							?>

						

						function addMarker(lat, lng, info)
						{
							var location = new google.maps.LatLng(lat, lng);
				            var marker = new google.maps.Marker({
				                map: map,
				                position: location
				            });
				            bindInfoWindow(marker, infoWindow, info);
						}

						function bindInfoWindow(marker, infoWindow, info)
						{
				          	google.maps.event.addListener(marker, 'click', function() {
				          	// info += '<button type="buttton" onclick="updateVote()"> Yes </button>';
				            info += '<input type="button" value="click" onclick="updateVote()>"';
				            infoWindow.setContent(info);
				            infoWindow.open(map, marker);
				          });
				        }

				        function updateVote() {
							alert("Sumit");
						}
		           
				        var input = document.getElementById('pac-input');
				        var searchBox = new google.maps.places.SearchBox(input);
				        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

				        map.addListener('bounds_changed', function() {
				          searchBox.setBounds(map.getBounds());
				        });

				        var markers = [];
				        searchBox.addListener('places_changed', function() {
				          var places = searchBox.getPlaces();

				          if (places.length == 0) {
				            return;
				          }

				          markers.forEach(function(marker) {
				            marker.setMap(null);
				          });
				          markers = [];

				          var bounds = new google.maps.LatLngBounds();
				          places.forEach(function(place) {
				            if (!place.geometry) {
				              console.log("Returned place contains no geometry");
				              return;
				            }
				            // var icon = {
				            //   url: place.icon,
				            //   size: new google.maps.Size(71, 71),
				            //   origin: new google.maps.Point(0, 0),
				            //   anchor: new google.maps.Point(17, 34),
				            //   scaledSize: new google.maps.Size(25, 25)
				            // };

				            // Create a marker for each place.
				            markers.push(new google.maps.Marker({
				              map: map,
				              // icon: icon,
				              title: place.name,
				              position: place.geometry.location
				            }));

				            if (place.geometry.viewport) {
				              bounds.union(place.geometry.viewport);
				            } else {
				              bounds.extend(place.geometry.location);
				            }
				          });
				          map.fitBounds(bounds);
				        });
      				}
				</script>

				<script 
				async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzryhoilydlqFFfxLfSzZ-toUIJ1y0xAs&libraries=places&callback=initAutocomplete">
		    	</script>
		</div>
	</div>
  </body>
</html>
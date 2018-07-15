<?php
	$con = mysqli_connect('localhost', 'root', '', 'registration');
	$query = "SELECT *FROM users WHERE username='smt'";
	$sql = mysqli_query($con, $query);
	
	while ($row = mysqli_fetch_assoc($sql)) {
		$username = $row['username'];
		$otp = $row['otp'];
		$verify = $row['verify'];
		$email = $row['email'];
	}

	$generate_otp = rand();

	$message = 
	"
		Confirm your Email
		Click the link below to verify your account...
		localhost/crime/conifimation.php?username=$username.code=$generate_otp
	";

	mail($email, "Confirmation mail", $message, "From: DoNotReply@crimeLogger.com");
?>
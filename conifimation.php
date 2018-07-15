<?php
	$username = $_GET['username'];
	$code = $_GET['code'];

	$con = mysqli_connect('localhost', 'root', '', 'registration');
	$sql = mysqli_query($con,"select * from users where username = '$username'");

	while ($row = mysqli_fetch_assoc($sql)) {
		$db_otp = $row['otp'];
	}

	if($code == $db_otp) {
		mysql_query("UPDATE users SET verify='1'");
		mysql_query("UPDATE users SET otp='0'");
	}
	
	else {
        echo "<script type='text/javascript'> alert('Invalid confirmation!'); </script>";
	}



  ?>
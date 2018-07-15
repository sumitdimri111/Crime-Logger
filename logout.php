<?php 
	session_start();
		session_unset(); 
		session_destroy();
			$msg = "Successfully Logout!";
      		echo "<script type='text/javascript'> alert('$msg') </script>";
		header('location: login.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		print_r($_SESSION);
	?>
</body>
</html>
<?php  
	$msg="";
	if (count($errors) > 0) {
	  	foreach ($errors as $error) {
	  		$msg .= $error . '\n';
	  	}
	  	
	  	$len = count($errors);
		array_splice($errors, 0, $len);
		echo "<script> alert('$msg'); </script>";
		$msg="";
	}
?>
<?php
	session_start(); 
	require "connect.php";
	$query = "SELECT * from places where location_id = '{$_POST['place']}'";
	$result = mysqli_query($dbconn, $query);
	if(mysqli_affected_rows($dbconn)){
		$value = mysqli_fetch_assoc($result);
		echo $value['place_id'];
	}else{
		echo 0;
	}
	
 ?>
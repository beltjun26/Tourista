<?php
	session_start(); 
	require "connect.php";
	$query = "INSERT INTO places(name, description, location_id) values('{$_POST['place_name']}', '{$_POST['description']}', '{$_POST['place_id']}')";
	$result = mysqli_query($dbconn, $query);
	if(mysqli_affected_rows($dbconn)){
		echo "success";
	}
	

 ?>
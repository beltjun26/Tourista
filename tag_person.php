<?php
	session_start(); 
	require "connect.php";
	$term = $_GET['term'];
	$query = "SELECT concat(firstname,' ', middlename,' ', lastname) as value, acc_id as id from account where username like '%$term%' or firstname like '%$term%' or middlename like '%$term%' or lastname like '%$term%'";
	$result = mysqli_query($dbconn, $query);
	if(mysqli_affected_rows($dbconn)){
		while($row = mysqli_fetch_assoc($result)){
			$row_set[] = $row;
		}
	}

	echo json_encode($row_set);
 ?>	
<?php
	session_start(); 
	require "connect.php";
	$query= "SELECT concat(firstname, ' ', lastname) as fullname, acc_id from tag natural join account where post_id={$_POST['post_id']}";
	$result = mysqli_query($dbconn, $query);
	while($row = mysqli_fetch_assoc($result)){
		$data[] = $row;
	}
	
	echo json_encode($data);
	
 ?>	
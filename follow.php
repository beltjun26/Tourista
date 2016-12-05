<?php 
	require "connect.php";
	session_start();
	$status = "";
	$follow_user = $_GET['acc_id'];

	$userID = $_SESSION['userID'];
	
	$query = "SELECT * FROM follow WHERE acc_id_follower = $userID AND acc_id_follows = $follow_user;";	
	$result = mysqli_query ($dbconn, $query);
	if (!mysqli_num_rows($result)){
		$query = "INSERT INTO follow (acc_id_follower, acc_id_follows) VALUES ($userID, $follow_user);";		
		$result = mysqli_query ($dbconn, $query);
		$status = "follow";
	}else{
		$query = "DELETE FROM follow WHERE acc_id_follower = $userID AND acc_id_follows = $follow_user;";		
		$result = mysqli_query ($dbconn, $query);
		$status = "unfollow";
	}

	echo $status;
?>
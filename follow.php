<?php 
	require "connect.php";
	session_start();

	$follow_user = $_GET['acc_id'];

	$userID = $_SESSION['userID'];
	
	$query = "SELECT * FROM follow WHERE acc_id_follower = $userID AND acc_id_follows = $follow_user;";	
	$result = mysqli_query ($dbconn, $query);
	if (mysqli_num_rows($result) == 0){
		$query = "INSERT INTO follow (acc_id_follower, acc_id_follows) VALUES ($userID, $follow_user);";		
		$result = mysqli_query ($dbconn, $query);
	} if (mysqli_num_rows($result) >= 1){
		$query = "DELETE FROM follow WHERE acc_id_follower = $userID AND acc_id_follows = $follow_user;";		
		$result = mysqli_query ($dbconn, $query);
	}

	header("Location: people_profile.php?acc_id=$follow_user");
?>
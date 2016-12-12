<?php 
	session_start();
	require "connect.php";
	if(!isset($_SESSION['userID'])){
				header("Location: login.php");
	}
	$status = "";
	$follow_user = $_GET['acc_id'];

	$userID = $_SESSION['userID'];
	
	$query = "SELECT * FROM follow WHERE acc_id_follower = $userID AND acc_id_follows = $follow_user;";	
	$result = mysqli_query ($dbconn, $query);
	if (!mysqli_num_rows($result)){
		$query = "INSERT INTO follow (acc_id_follower, acc_id_follows) VALUES ($userID, $follow_user);";		
		$result = mysqli_query ($dbconn, $query);
		$status = "follow";

		//NOTIF TYPE 1 for LIKE
		$query = "INSERT INTO `notification` (`notif_id`, `redirect_id`, `user_id_from`, `notif_type`, `time_stamp_notif`) VALUES (NULL, '{$_SESSION['userID']}', '{$_SESSION['userID']}', '3', CURRENT_TIMESTAMP);";

		mysqli_query($dbconn, $query);

		//Save the last increment of notif_id
		$notif_id = mysqli_insert_id($dbconn);


		//GET acc_id of the one who to notify

		$acc_id = $_GET['acc_id'];

		$query = "INSERT INTO `notified` (`notif_id`, `user_id_notified`) VALUES ('$notif_id', '$acc_id')";
		mysqli_query($dbconn, $query);
		
	}else{
		$query = "DELETE FROM follow WHERE acc_id_follower = $userID AND acc_id_follows = $follow_user;";		
		$result = mysqli_query ($dbconn, $query);
		$status = "unfollow";
	}

	echo $status;
?>
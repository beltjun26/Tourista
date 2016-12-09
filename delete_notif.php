<?php 
	session_start();
	require "connect.php";

	if(isset($_GET['redirect_id'])){
		$notif_id = $_GET['notif_id'];
		$user_id = $_SESSION['userID'];
		$redirect_id = $_GET['redirect_id'];


		$query = "DELETE FROM `notified` WHERE notif_id = '$notif_id' AND user_id_notified = '$user_id';";
		mysqli_query($dbconn, $query);

		header("Location: view_post.php?post_id=".$_GET['redirect_id']);
	}
	else{
		$notif_id = $_GET['notif_id'];
		$user_id = $_SESSION['userID'];

		$query = "DELETE FROM `notified` WHERE notif_id = '$notif_id' AND user_id_notified = '$user_id';";
		mysqli_query($dbconn, $query);
		header("Location: notifications.php");
	}

 ?>

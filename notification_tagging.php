<?php 
	session_start(); 
	require "connect.php";


	//NOTIF TYPE 2 for TAG
	$query = "INSERT INTO `notification` (`notif_id`, `redirect_id`, `user_id_from`, `notif_type`, `time_stamp_notif`) VALUES (NULL, '{$_POST['post_id']}', '{$_SESSION['userID']}', '2', CURRENT_TIMESTAMP);";

	mysqli_query($dbconn, $query);

	//Save the last increment of notif_id
	$notif_id = mysqli_insert_id($dbconn);


 ?>
<?php
	session_start(); 
	require "connect.php";
	$query = "SELECT * from upvote where post_id={$_POST['post_id']}";
	$result = mysqli_query($dbconn, $query);
	$noRows = mysqli_affected_rows($dbconn);
	$query = "SELECT * from upvote where acc_id={$_SESSION['userID']} and post_id = {$_POST['post_id']}";
	$result= mysqli_query($dbconn, $query);
	if(mysqli_affected_rows($dbconn)){
		$query = "DELETE from upvote where acc_id={$_SESSION['userID']} and post_id = {$_POST['post_id']}";
		mysqli_query($dbconn, $query);
		$noRows = $noRows-1;
		$status =  "deleted";
	}	
	else{
		$query = "INSERT into upvote(acc_id, post_id) values({$_SESSION['userID']}, {$_POST['post_id']})";
		mysqli_query($dbconn, $query);
		$noRows = $noRows+1;
		$status =  "inserted";

		//NOTIF TYPE 1 for LIKE
		$query = "INSERT INTO `notification` (`notif_id`, `redirect_id`, `user_id_from`, `notif_type`, `time_stamp_notif`) VALUES (NULL, '{$_POST['post_id']}', '{$_SESSION['userID']}', '1', CURRENT_TIMESTAMP);";

		mysqli_query($dbconn, $query);

		//Save the last increment of notif_id
		$notif_id = mysqli_insert_id($dbconn);


		//GET acc_id of the one who posted
		$query = "SELECT acc_id FROM posted WHERE post_id = '{$_POST['post_id']}'";
		$acc_id_result = mysqli_query($dbconn, $query);

		$row = mysqli_fetch_assoc($acc_id_result);

		$acc_id = $row['acc_id'];

		if($_SESSION['userID'] != $row['acc_id']){
			$query = "INSERT INTO `notified` (`notif_id`, `user_id_notified`) VALUES ('$notif_id', '$acc_id')";
			mysqli_query($dbconn, $query);
		}

		

	}




	echo json_encode(array('status' => $status,'likes'=>$noRows));
 ?>
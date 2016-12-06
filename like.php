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
	}
	echo json_encode(array('status' => $status,'likes'=>$noRows));
 ?>
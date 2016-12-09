<?php
	session_start(); 
	require "connect.php";
	$query = "INSERT INTO tag(acc_id, post_id) values({$_POST['acc_id']}, {$_POST['post_id']})";
	$result = mysqli_query($dbconn, $query);

	$query = "INSERT INTO `notified` (`notif_id`, `user_id_notified`) VALUES ('{$_POST['notif_id']}', '{$_POST['post_id']}')";
	mysqli_query($dbconn, $query);

	$query = "SELECT username as fullname, acc_id from account where acc_id = {$_POST['acc_id']}";
	$result = mysqli_query($dbconn, $query);
	$data =  mysqli_fetch_assoc($result);
	echo json_encode(array('acc_id' =>$data['acc_id'],'fullname'=>$data['fullname']));
?>	
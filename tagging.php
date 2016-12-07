<?php
	session_start(); 
	require "connect.php";
	$query = "INSERT INTO tag(acc_id, post_id) values({$_POST['acc_id']}, {$_POST['post_id']})";
	$result = mysqli_query($dbconn, $query);
	$query = "SELECT concat(firstname, " ", lastname) as fullname, acc_id from account where acc_id = {$_POST['acc_id']}";
	$result = myslqi_query($dbconn, $query);
	$data =  fetch_assoc($result);
	echo json_encode(array('acc_id' => ,$data['acc_id'],'acc_name'=>$data['fullname'] ));
	
 ?>	
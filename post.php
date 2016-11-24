<?php
	session_start(); 
	require "connect.php";

	$post = $_POST['post'];
	$userID = $_SESSION['userID'];
	$locationID = 2; 				 //Still no location


	$query = "INSERT INTO posted(`post_id`, `content`, `place_id`, `acc_id`, `time_post`) VALUES (NULL, '$post', '$userID', '$locationID', CURRENT_TIMESTAMP);";

	mysqli_query($dbconn, $query);


	//if may image




	header("Location: home_page.php");

 ?>
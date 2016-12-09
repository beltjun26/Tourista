<?php
	session_start(); 
	require "connect.php";
	$query = "DELETE from posted where post_id={$_GET['post_id']}";
	mysqli_query($dbconn, $query);
	$query = "DELETE from tag where post_id={$_GET['post_id']}";
	mysqli_query($dbconn, $query);
	$query = "DELETE from upvote where post_id={$_GET['post_id']}";
	mysqli_query($dbconn, $query);
	$file = "images/post_img/".$_GET['post_id'].".jpg";
	if(file_exists($file)){
		unlink($file);
	}
	header("Location: home_page.php");

 ?>
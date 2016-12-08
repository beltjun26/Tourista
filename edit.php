<?php
	session_start(); 
	require "connect.php";
	echo $_POST['postid'];
	$query = "UPDATE posted set content='{$_POST['content']}' where post_id = {$_POST['postid']}";
	mysqli_query($dbconn, $query);
	header("Location: home_page.php");

 ?>
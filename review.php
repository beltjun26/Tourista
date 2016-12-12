<?php
	require "connect.php";
	session_start();

	if (isset($_POST["review"])) {
		$rate = $_POST["rating"];
		$comment = $_POST["comment"];
		$place = $_POST["place"];
		$user = $_SESSION["userID"];
		echo $rate." ".$comment." ".$place." ".$user;
		$query = "INSERT INTO `rating`(`acc_id`, `place_id`, `comment`, `rating_no`) VALUES ('$user' ,'$place' ,'$comment' ,'$rate');";
		mysqli_query($dbconn, $query);
		
		header("Location: place.php?place_id=$place");
	}

	if (isset($_POST["reviewagain"])) {
		$rate = $_POST["rating"];
		$comment = $_POST["comment"];
		$place = $_POST["place"];
		$user = $_SESSION["userID"];
		echo $rate." ".$comment." ".$place." ".$user;
		$query = "UPDATE `rating` SET `comment` = '$comment', `rating_no` = '$rate' WHERE `rating`.`acc_id` = $user AND `rating`.`place_id` = $place;";
		mysqli_query($dbconn, $query);
		
		header("Location: place.php?place_id=$place");
	}
?>
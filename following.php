<?php
	session_start();
	if(!isset($_SESSION['userID'])){
				header("Location: login.php");
	}
	include 'connect.php';
	$query = mysqli_query($dbconn, "SELECT acc_id_follows from follow where acc_id_follower = $acc_id");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Followers:</title>
		<meta charset="utf-8">
	</head>
	<body>

<?php	while($following = mysqli_fetch_assoc($query)){
		$follow_id = $following['acc_id_follows'];
		$queryind = mysqli_query($connect, "SELECT username, profile_pick from account where acc_id = $follow_id");
		$followprof = mysqli_fetch_assoc($queryind);
		$followprof_username = $followprof['username'];
		$followprof_pp = $followprof['profile_pick'];?>
		Username: <?php echo $followprof_username ;?>
		<img src="images/<?php echo $followprof_pp;?>" onerror = "this.src = 'images/default_profile.png'"><br>
		<?php } ?>
	</body>
</html>
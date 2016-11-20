<?php
	$db = 'tourista';
	$connect = mysqli_connect('localhost', 'root', '', $db) or die('Could not connect to database.');
	// $acc_id = $_GET['acc_id'];
	$acc_id = 1;
	$query = mysqli_query($connect, "SELECT acc_id_follows from follow where acc_id_follower = $acc_id");
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
		<img src="images/<?php echo $followprof_pp;?>"><br>
		<?php } ?>
	</body>
</html>
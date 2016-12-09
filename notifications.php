<?php

	session_start();




?>

<!DOCTYPE html>
<html>
<head>
	<title>Tourista!</title>
	<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
	<link rel="stylesheet" type="text/css" href="css/notifications.css">
</head>
<body>
	<div id = "navBar">
		<form action="search_results_places.php" method="get">
			<input type="text" placeholder="Search..." name = "search">
		</form>
		<ul id = "navList">
			<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
			<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
			<!-- <li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li> -->
			<li><a href="Notifications.php" class="active"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
			<li><a href="logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
			<li><a href="my_profile.php" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']; ?>.jpg" onerror = "this.src = 'images/default_profile.png'"></a></li>
		</ul>
	</div>
	<div class="container">

	<?php 

		require 'connect.php';

		$query = "SELECT *
				  FROM notification
				  NATURAL JOIN notified
				  WHERE user_id_notified = '{$_SESSION['userID']}'
				  ORDER BY time_stamp_notif DESC;";

		$result = mysqli_query($dbconn, $query);

	 if(mysqli_num_rows($result)){


	  foreach ($result as $value): ?>
		<div class="notif-container">
			<img class="user-photo" src="images/profile_pic_img/acc_id_<?=$value['user_id_from']?>.jpg">
			<a href="delete_notif.php?notif_id=<?=$value['notif_id']?>" class="close">&times;</a>


			<?php 
				$query = "SELECT *
						  FROM account
						  WHERE acc_id = '{$value['user_id_from']}';";

				$user_result = mysqli_query($dbconn, $query);
				$row = mysqli_fetch_assoc($user_result);
			 ?>

			<span class="username"><?=$row['username']?></span>
			<span class="time-stamp"><?php echo date("F j, Y, g:i a", strtotime($value['time_stamp_notif']));  ?></span>

			<?php 

			$fullname = $row['firstname']." ".$row['lastname'];


			 ?>
			<?php if ($value['notif_type'] == 1): ?>
				<p><?= $fullname ?> liked one of your posts.</p><br>
			<?php endif ($value['notif_type'] == 2): ?>
				<p><?= $fullname ?> tagged you in his post.</p><br>
			<?php endif ($value['notif_type'] == 3): ?>
				<p><?= $fullname ?> started following you.</p><br>
			<?php endif ?>
			


			<a href="delete_notif.php?redirect_id=<?=$value['redirect_id']?>&notif_id=<?=$value['notif_id']?>" class="view">View</a>
		</div>
	<?php endforeach; 
	}
	else{
		?>


		<span class="no-notifs">NO MORE NOTIFICATIONS</span>














		<?php
	}

	?>
	
	






	</div>
</body>
</html>
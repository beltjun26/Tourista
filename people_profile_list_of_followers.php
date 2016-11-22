<!DOCTYPE html>
<html>
	<head>
		<title>Toursita</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/Home_Page_style.css">
		<link rel="stylesheet" type="text/css" href="css/People_Profile_Page_style.css">
		<link rel="stylesheet" type="text/css" href="css/search_style.css">
	</head>
	<body>

	<?php 
	include 'connect.php';

	session_start();
	$user_id = $_SESSION['userID'];
	$queryuser = "SELECT  CONCAT(firstname,' ', lastname) as 'fullname', about_me FROM account where acc_id=$user_id";
	$result = mysqli_query($dbconn, $queryuser);
	while($row = mysqli_fetch_array($result)){
		$username = $row["fullname"];
		$aboutme = $row["about_me"];
	}
	?>
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search...">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="login.html"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="people_profile.php" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		<div class="container">	
			<div class="search-filter">	
				<ul>
					<li><a href="people_profile_list_of_following.php">FOLLOWING</a></li>				
					<li><a href="#" class="active">FOLLOWERS</a></li>
				</ul>
			</div>
			<div class="results-container">
			<?php
				$queryfollowinglist = "SELECT CONCAT(firstname, ' ', lastname) as follower_fullname, acc_id as follower_id, about_me as follower_aboutme from account, follow where acc_id_follows = $user_id && acc_id_follower=acc_id";	
				$result = mysqli_query($dbconn, $queryfollowinglist);	
				$num_followers = mysqli_num_rows($result);
				if($num_followers > 0){
					while($row = mysqli_fetch_array($result)){ 
						$followername = $row["follower_fullname"];
						$follower_aboutme = $row["follower_aboutme"];
						$follower_id = $row["follower_id"]; ?>
							<div class="result-people">
								<a class="userphoto-link" href="people_profile.php?id=<?php echo $row['follower_id'];?>">
									<img src = "images/profile_pic_img/acc_id_<?=$row['follower_id']?>.jpg" alt="user image">
								</a>
								<div class = "user-details">
									<a href="#" class = "username-link"><h2 class="username"><?php echo $followername;?></h2></a>
									<p><?php echo $row["follower_aboutme"];?></p>
								</div>
							</div>
					<?php }
					} else {	?>
						<p>No followers</p>

					<?php	} ?>
		</div>
	</body>
</html>
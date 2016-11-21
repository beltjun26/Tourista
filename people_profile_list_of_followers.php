<!DOCTYPE html>
<html>
	<head>
		<title>TourisTA! - Homepage</title>
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
	$host = 'localhost';  
	$username = 'root'; 
	$password = ''; 
	$db = 'database_name'; 
	$dbconn = mysqli_connect($host,$username,$password) or die("Could not connect to database!"); 
	mysqli_select_db($dbconn, 'tourista') or die( "Unable to select database");
	session_start();
	$_SESSION['user_id'] = 1;
	$user_id = $_SESSION['user_id'];
	$queryfollowers = "SELECT count(*) as followerscount FROM account as acc, follow WHERE acc_id_follows = $user_id && acc_id_follower=acc.acc_id";
	$queryfollowing = "SELECT count(*) as followingcount FROM account as acc, follow WHERE acc_id_follows = acc_id && acc_id_follower=$user_id";
	$queryuser = "SELECT  CONCAT(firstname,' ', lastname) as 'fullname', about_me, profile_pic, cover_photo FROM account where acc_id=$user_id";
	$result = mysqli_query($dbconn, $queryfollowers);
	$followerscount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryfollowing);
	$followingcount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryuser);
	while($row = mysqli_fetch_array($result)){
		$username = $row["fullname"];
		$aboutme = $row["about_me"];
		$pathpp = $row["profile_pic"];
		$pathcp = $row["cover_photo"];
	}
	?>
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search...">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"> HOME </a></li>
				<li><a href="visit.php"> VISITS </a></li>
				<li><a href="#"> STARRED PLACES </a></li>
				<li><a href="notifications.php"> NOTIFICATIONS </a></li>
				<li><a href="login.php"> LOGOUT </a></li>
				<li><a href="people_profile"><img src="images/pp_cover/<?php echo $pathpp;?>"></a></li>
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
				$queryfollowinglist = "SELECT CONCAT(firstname, ' ', lastname) as follower_fullname, acc_id as follower_id, about_me as follower_aboutme, profile_pic, cover_photo from account, follow where acc_id_follows = $user_id && acc_id_follower=acc_id";	
				$result = mysqli_query($dbconn, $queryfollowinglist);	
				while($row = mysqli_fetch_array($result)){ 
					$pp = $row["profile_pic"];
					$followername = $row["follower_fullname"];
					$follower_aboutme = $row["follower_aboutme"];
					$follower_id = $row["follower_id"]; ?>
							<div class="result-people">
								<a class="userphoto-link" href="people_profile.php?id=<?php echo $row['follower_id'];?>">
									<img src = "images/pp_cover/<?php echo $pp;?>" alt="user image">
								</a>
								<div class = "user-details">
									<a href="#" class = "username-link"><h2 class="username"><?php echo $followername;?></h2></a>
									<p><?php echo $row["follower_aboutme"];?></p>
								</div>
							</div>
					<?php } ?>
		</div>
	</body>
</html>
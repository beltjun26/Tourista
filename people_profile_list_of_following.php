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
	$num_followers = mysqli_num_rows($result);
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
				<li><a href="home_page.php"> HOME </a></li>
				<li><a href="visit.php"> VISITS </a></li>
				<li><a href="#"> STARRED PLACES </a></li>
				<li><a href=notifications.php> NOTIFICATIONS </a></li>
				<li><a href="login.php"> LOGOUT </a></li>
				<li><a href="my_profile.php" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		
		<div class="container">
			<div class="search-filter">	
				<ul>
					<li><a href="#" class="active">FOLLOWING</a></li>				
					<li><a href="people_profile_list_of_followers.php">FOLLOWERS</a></li>
				</ul>
			</div>
			<div class="results-container">
				<?php
						$queryfollowinglist = "SELECT CONCAT(firstname, ' ', lastname) as following_fullname, acc_id as following_id, about_me as following_aboutme from account, follow where acc_id_follows = acc_id && acc_id_follower= $user_id";	
						$result = mysqli_query($dbconn, $queryfollowinglist);	
						$num_following = mysqli_num_rows($result);
						if($num_following!=0){ 
							while($row = mysqli_fetch_array($result)){ 							
								$following_name = $row["following_fullname"];
								$following_about_me = $row["following_aboutme"];
								$followingid = $row["following_id"];  ?>
								<div class="result-people">
									<a class="userphoto-link" href="people_profile.php?id=<?php echo $following_id;?>">
										<img src = "images/profile_pic_img/acc_id_<?=$row['following_id']?>.jpg" alt="user image">
									</a>
									<div class = "user-details">
										<a href="#" class = "username-link"><h2 class="username"><?php echo $following_name;?></h2></a>
										<p><?php echo $following_about_me;?></p>
									</div>
								</div>
						<?php }
					} elseif($num_following == 0) { ?>
						<p>No following</p>
		<?php			}
					 ?>	
			</div>
		</div>
	</body>
</html>
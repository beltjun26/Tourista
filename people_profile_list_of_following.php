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
		<link rel="stylesheet" type="text/css" href="css/People_Profile_Page_Style_Before.css">
		<link rel="stylesheet" type="text/css" href="css/profile_options.css">
		<link rel="stylesheet" type="text/css" href="css/search_style.css">
	</head>
	<body>

		<?php 
		require "connect.php";
		session_start();

		$acc_id = $_GET['acc_id'];

		$queryfollowers = "SELECT count(*) as followerscount FROM account as acc, follow WHERE acc_id_follows = $acc_id && acc_id_follower=acc.acc_id";
		$queryfollowing = "SELECT count(*) as followingcount FROM account as acc, follow WHERE acc_id_follows = acc_id && acc_id_follower=$acc_id";
		$queryuser = "SELECT  CONCAT(firstname,' ', lastname) as 'fullname',about_me,username FROM account where acc_id = $acc_id";

		$result = mysqli_query($dbconn, $queryfollowers);
		$followerscount = mysqli_fetch_assoc($result);
		$result = mysqli_query($dbconn, $queryfollowing);
		$followingcount = mysqli_fetch_assoc($result);
		$result = mysqli_query($dbconn, $queryuser);
		$row = mysqli_fetch_assoc($result);
		$fullname = $row['fullname'];
		$aboutme = $row['about_me'];
		$username = $row['username'];
		?>

		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name = "search">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
				<li><a href=notifications.php><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php?=<?=$_SESSION['userID']?>" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		
		<div class="container">
			<div class="headerprofile">
				<div id="coverphoto">
					<img src="images/cover_img/cover_<?=$acc_id?>.png" alt="user-cover">
					<?php if ($acc_id==$_SESSION['userID']) { ?> <button id="Editcovbtn">Edit Cover <span class="glyphicon glyphicon-pencil"></span></button> <?php } ?>
				</div>
				<h1 id="username"><?=$fullname?><br><span class="usernameorig"><?=$username?></span></h1>
				<div id="userphoto">
					<img src="images/profile_pic_img/acc_id_<?=$_GET['acc_id']?>.jpg">
					<?php if ($acc_id==$_SESSION['userID']) { ?> <button id="Editpicbtn">Edit Profile Picture <span class="glyphicon glyphicon-pencil"></span></button> <?php } ?>
				</div>
				<ul id="follows">
					<li><a href="#follow-head">Following: <?php echo $followingcount['followingcount']; ?></a></li>
					<li><a href="people_profile_list_of_followers.php?acc_id=<?=$acc_id?>#follow-head">Followers: <?php echo $followerscount['followerscount'];?></a></li>
				</ul>
				<div id="aboutme">
					<h1>ABOUT ME</h1>
					<br>
					<p><?php echo $aboutme ;?></p>
					<?php if ($acc_id==$_SESSION['userID']) { ?> <button id="Editdesbtn">Edit Description <span class="glyphicon glyphicon-pencil"></span></button> <?php } ?>
				</div>
			</div>
			<?php if ($acc_id == $_SESSION['userID']) { ?>
					<ul class="user-options">
						<li><button id="Editallbtn">Edit Profile<span class="glyphicon glyphicon-pencil"></span></button></li>
						<li><a href="my_profile.php?acc_id=<?=$acc_id?>">Feed<span class="glyphicon glyphicon-credit-card"></span></a></li>
						<li><a href="#">Visits<span class="glyphicon glyphicon-map-marker"></span></a></li>
						<li><a href="people_profile_list_of_followers.php?acc_id=<?=$acc_id?>#follow-head">Followers<span class="glyphicon glyphicon-hand-left"></span></a></li>
						<li><a href="#follow-head" class="active">Following<span class="glyphicon glyphicon-hand-right"></span></a></li>
						<li><a href="#">Notifications<span class="glyphicon glyphicon-bell"></span></a></li>
					</ul>
			<?php } else { ?>
					<ul class="visitor-options">
						<li><a href="people_profile.php?acc_id=<?=$value['acc_id']?>">Feed<span class="glyphicon glyphicon-credit-card"></a></li>
						<li><a href="follow.php?acc_id=<?=$acc_id?>">
							<?php
								$query = "SELECT * FROM follow WHERE acc_id_follower = {$_SESSION['userID']} AND acc_id_follows = $acc_id;";	
								$result = mysqli_query ($dbconn, $query);
								if (mysqli_num_rows($result) == 0){
									echo "Follow<span class='glyphicon glyphicon-plus'>";
								} else{
									echo "Unfollow<span class='glyphicon glyphicon-minus'>";
								}
							?>
						</span></a></li>
						<li><a href="#">Ask for a Tour<span class="glyphicon glyphicon-sunglasses"></a></li>
						<li><a href="#">Visits<span class="glyphicon glyphicon-map-marker"></a></li>
						<li><a href="#follow-head" class="active">Following<span class="glyphicon glyphicon-hand-right"></span></a></li>
						<li><a href="people_profile_list_of_followers.php?acc_id=<?=$acc_id?>#follow-head">Followers<span class="glyphicon glyphicon-hand-left"></a></li>
					</ul>
			<?php } ?>
		</div>

		<div class="search-container">
			<h1 id="follow-head">FOLLOWING</h1>
			<div class="search-type">	
				<input type="text" id="Filter" onkeyup="Filter()" placeholder="Filter names...">
				<ul>
					<li><a href="#" class="active">FOLLOWING</a></li>				
					<li><a href="people_profile_list_of_followers.php?acc_id=<?=$acc_id?>#follow-head">FOLLOWERS</a></li>
				</ul>
			</div>
			<ul id="Results" class="results-container">
			<?php
				$queryfollowinglist = "SELECT * from account, follow where acc_id_follows = acc_id && acc_id_follower= $acc_id";	
				$result = mysqli_query($dbconn, $queryfollowinglist);	
				$num_following = mysqli_num_rows($result);
				if($num_following!=0){ 
					foreach ($result as $value) {?>
						<li class="result-people">
							<a href="people_profile.php?acc_id=<?=$value['acc_id']?>">
									<img src = "images/profile_pic_img/acc_id_<?=$value['acc_id'] ?>.jpg" alt="user image">
								<div class = "user-details">
									<h2 class="username"><?php echo $value['firstname']." ".$value['lastname'] ?></h2>
									<p><?=$value['about_me'] ?></p>
								</div>
							</a>
						</li>
			<?php 	}
				} else { ?>
					<p class="no-results-follow">No following</p>
			<?php } ?>	
			</ul>
		</div>

		<script>
			$(function() {
			  $('a[href*="#"]:not([href="#"])').click(function() {
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			      var target = $(this.hash);
			      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			      if (target.length) {
			        $('html, body').animate({
			          scrollTop: target.offset().top
			        }, 1000);
			        return false;
			      }
			    }
			  });
			});
		</script>

		<script>
			function Filter() {
			    var input, filter, ul, li, a, i;
			    input = document.getElementById('Filter');
			    filter = input.value.toUpperCase();
			    ul = document.getElementById("Results");
			    li = ul.getElementsByTagName('li');

			    for (i = 0; i < li.length; i++) {
			        a = li[i].getElementsByTagName("h2")[0];
			        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
			            li[i].style.display = "";
			        } else {
			            li[i].style.display = "none";
			        }
			    }
			}
		</script>
	</body>
</html>
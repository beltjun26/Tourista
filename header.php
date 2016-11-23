			<div class="headerprofile">
				<img src="images/cover_img/cover_<?=$_SESSION['userID']?>.png" alt="user-cover" id="coverphoto">
				<h1 id="username"><?=$fullname?><br><span class="usernameorig"><?=$username?></span></h1>
				<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" id="userphoto">
				<ul id="follows">
					<li><a href="people_profile_list_of_following.php">Following: <?php echo $followingcount['followingcount']; ?></a></li>
					<li><a href="people_profile_list_of_followers.php">Followers: <?php echo $followerscount['followerscount'];?></a></li>
				</ul>
				<div id="aboutme">
					<h1>ABOUT ME</h1>
					<br>
					<p><?php echo $aboutme ;?></p>
				</div>
			</div>
			<ul class="user-options">
				<li><button id="Edit">Edit Profile<span class="glyphicon glyphicon-pencil"></span></button></li>
				<li><a href="#">Feed<span class="glyphicon glyphicon-credit-card"></span></a></li>
				<li><a href="#">Visits<span class="glyphicon glyphicon-map-marker"></span></a></li>
				<li><a href="people_profile_list_of_followers.php">Followers<span class="glyphicon glyphicon-hand-left"></span></a></li>
				<li><a href="people_profile_list_of_following.php">Following<span class="glyphicon glyphicon-hand-right"></span></a></li>
				<li><a href="#">Notifications<span class="glyphicon glyphicon-bell"></span></a></li>
			</ul>

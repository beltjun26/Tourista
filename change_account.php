<!DOCTYPE html>
<html>
	<head>
		<title>Tourista</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/Style_Registration.css">
	</head>
	<body>
		<?php 
			require "connect.php";
			session_start();
			$change = 0;
			$passBlank = false;
			$passWrong = false;
			$passSuccess = false;
			$usermsg = false;
			$userSuccess = false;
			$mismatch = false;
			if(!(isset($_SESSION["userName"]))){ 
				header("Location:login.php");
			} else {
				$user_name = $_SESSION["userName"];	
				if (isset($_POST['changeset'])){
					$username = $_POST['username'];
					$old_pass = $_POST['curpass'];
					$new_pass = $_POST['newpass'];
					$retype_new = $_POST['retpass'];
					 if ($old_pass=='' || $new_pass=='' || $retype_new=='') { 
						// $passmsg1 = "Current password, new password, and password retype confirmation must be filled out to make changes to your current password.";
						$passBlank = true;
					} elseif(!empty($_POST["username"]) && !empty($_POST["curpass"]) && !empty($_POST["retpass"]) && !empty($_POST["newpass"])){
								$query = "SELECT password FROM account WHERE password=MD5('$old_pass') ";
								$result = mysqli_query($dbconn, $query);
								$numrows = mysqli_num_rows($result);
								if($numrows==0){
									$passWrong = true;
								} 
								if($new_pass!=$retype_new){ 
										// $mismatch = "Oops, new password and confirmation don't match!"; 
									$mismatch = true;
								} 
								if($numrows==1 && ($new_pass==$retype_new)){
											$query = "UPDATE account SET password=MD5('$new_pass') where BINARY username='$user_name' ";
											$result = mysqli_query($dbconn,$query);
											$_SESSION["username"] = $_POST["username"]; 
											// $passSuccess = "You have succesfully updated your password!";
											$passSuccess = true;
								 	} else {
		 									//$passmsg3 = "New password must at least be 8 characters long and should contain at least 1 integer.";
									}
					}
					if($_SESSION["userName"] != $username || $old_pass =='' || $new_pass=='' || $retype_new==''){
						$query = "SELECT * FROM account WHERE BINARY username='$username'";
						$result = mysqli_query($dbconn, $query);
						$numrows = mysqli_num_rows($result);
						if($numrows>=1){
							// $usermsg = "Invalid! Username $username already taken.";
							$usermsg = true;
							$user_name = $username;
							// $passmsg1 =false;
							// $passmsg2 = false;
							// $passmsg3 = false;
							// $passmsg4 = false;;
						} elseif( !($old_pass == '') && !($new_pass=='') && !($retype_new=='') ){
								$change = 1;
						} elseif((empty($old_pass) || empty($new_pass) || empty($retype_new))){
							$change = 1;
						} 
						if(empty($old_pass) || empty($new_pass) || empty($retype_new)){ 
							// $change = 1;
							// $passmsg1 =false;
							// $passmsg2 =false;
							// $passmsg3 =false;;
						}
						
					} 
				}
			}

			if($change == 1){
				// $userSuccess = "Success! You change your username.";
				$userSuccess = true;
							//$query = "UPDATE `account` SET username='$username' WHERE username='$user_name'";
							$query = "UPDATE `account` SET `username` = '$username' WHERE `account`.`username`='$user_name'";
							$result = mysqli_query($dbconn, $query);



							$query = "SELECT username FROM account WHERE username='$username'";
							$result = mysqli_query($dbconn, $query);
							$row = mysqli_fetch_array($result);
							$user_name = $row['username'];
							$_SESSION["userName"] = $_POST["username"];  
			}


		?>
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name="search">
			</form>

			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<!-- <li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li> -->
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php?=<?=$_SESSION['userID']?>" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		<div class="container" id="container">
			<h1>Change Account Settings</h1>
			<form method="post"> 
				<input required type="text" name="username" placeholder="Username" value="<?php echo $user_name; ?>">
				<?php if($userSuccess){ ?>
				  			<span class="success">Username updated successfully!</span>
				 <?php }elseif ($usermsg) { ?>
				  			<span class="error">Invalid! Username <?php echo $username ?> already taken.</span>
				 <?php } ?>

				<input type="password" name="curpass" placeholder="Current Password">
				<?php if ($passSuccess) { ?>
				  			<span class="success">Password updated successfully!</span>
				 <?php }elseif ($passWrong) { ?>
				  			<span class="error">Sorry,that is not your password!</span>
				 <?php }elseif (!$userSuccess && $passBlank) { ?>
				 		<span class="error">Current password, new password, and password retype confirmation must be filled out to make changes to your current password!</span>
				 <?php } ?>

				<input pattern = "^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" type="password" name="newpass" placeholder="New Password(must be at least 8 characters with 1 integer)">
				<!-- <?php if($passBlank):?>
				  			<span class="error">Current password, new password, and password retype confirmation must be filled out to make changes to your current password!</span>
				  		<?php endif; ?> -->

				<input type="password" name="retpass" placeholder="Retype Password">
				<?php if($mismatch):?>
				  			<span class="error">Oops! Your new password does not match with the retyped password.</span>
				  		<?php endif; ?>
				
				<input type="submit" name="changeset" value="CHANGE">
				<a class="pagelink" href="my_profile.php">CANCEL</a>
			</form>
		</div>
		<script>
			h = $('#navBar').outerHeight(true);
			console.log(h);
			x = window.innerHeight;
			console.log(x);
			x = x - h;
			console.log(x);
			document.getElementById('container').setAttribute("style","min-height: "+x+"px;width:100%;margin-top:"+h+"px;");
		</script>
	</body>
</html>
<?php
	include 'connect.php';
	session_start();

	// $_SESSION['user_id'] = ;
	$user_id = $_SESSION['userID'];

	$errorinput = 0;
	$upload_pp = 0;
	$upload_cp = 0;
	$change_desc = 0;
	// $queryuser = "SELECT profile_pic, cover_photo, acc_id FROM account where acc_id=$user_id";
	// $result = mysqli_query($dbconn, $queryuser);
	// while($row = mysqli_fetch_array($result)){
		// $pathpp = $row["profile_pic"];
		// $pathcp = $row["cover_photo"];
	// }
	//WHY BOTH?
		if($_FILES["profile"]["error"] == 4 && $_FILES["profile"]["error"] == 4){
			$_about_me = addslashes($_POST["about_me_input"]);
			$queryaboutme = "UPDATE account SET about_me = '$_about_me' WHERE account.acc_id = $user_id";
			$resultchangeaboutme = mysqli_query($dbconn, $queryaboutme);
			// header("Location: people_profile.php");
		}
		if($_FILES["profile"]["error"] == 4 || $_FILES["cover"]["error"]==4){
			$change_desc = 1;
			if($_FILES["profile"]["error"] == 0){
					$fileType = exif_imagetype($_FILES["profile"]["tmp_name"]);
					$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
					if ((!in_array($fileType, $allowed))) { 
						$errorinput = 1;
					} else {
						$upload_pp = 1;
						$change_desc = 1;
					}
			} 
			if($_FILES["cover"]["error"] == 0){
					$fileTypeCP = exif_imagetype($_FILES["cover"]["tmp_name"]);
					$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
					if ((!in_array($fileTypeCP, $allowed))) { 
						$errorinput = 1;
					} else {
						$upload_cp = 1;
						$change_desc = 1;
					}			
			}	
		} 
		elseif (($_FILES["profile"]["error"] == 0) && ($_FILES["cover"]["error"] == 0)){
				$fileTypePP = exif_imagetype($_FILES["profile"]["tmp_name"]);
				$fileTypeCP = exif_imagetype($_FILES["cover"]["tmp_name"]);
				$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
				if ((!in_array($fileTypePP, $allowed))) { 
					$errorinput = 1;
				} elseif((!in_array($fileTypeCP, $allowed))){ 
					$errorinput = 1;
				} else {
					$upload_pp = 1;
					$upload_cp = 1;
					$change_desc = 1;
				}
		} 
		if($errorinput == 1 ){ 
			?>
			<script type="text/javascript">
				alert("Unsupported file type! Only .gif, .jpeg, .png only!");
				window.location = 'my_profile.php';
			</script> 
			<?php 
			die();
		}
		if($change_desc == 1){
			$about_me_val = $_POST["about_me_input"];
			$queryaboutme = "UPDATE account SET about_me = '$about_me_val' WHERE account.acc_id = $user_id";
			$resultchangeaboutme = mysqli_query($dbconn, $queryaboutme);
		}
		if($upload_pp == 1){
			$newfilename = "acc_id_$user_id.jpg";
			move_uploaded_file($_FILES['profile']['tmp_name'], 'images/profile_pic_img/' . $newfilename);
		}
		if($upload_cp == 1){
			$newfilename = "cover_$user_id.png";
			move_uploaded_file($_FILES['cover']['tmp_name'],'images/cover_img/' . $newfilename);
		}
		header("Location: my_profile.php");
?>
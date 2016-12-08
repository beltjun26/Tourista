<?php
	include 'connect.php';
	session_start();

	$user_id = $_SESSION['userID'];

	$errorinput = 0;
	$upload_pp = 0;
	$upload_cp = 0;
	if(isset($_POST['change_profilecover'])){
		if($_FILES["cover"]["error"] == 0){
			$fileTypeCP = exif_imagetype($_FILES["cover"]["tmp_name"]);
			$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
			if ((!in_array($fileTypeCP, $allowed))) { 
				$errorinput = 1;
			} else {
				$upload_cp = 1;	
			}			
		}
	}
	// die();
	
	if(isset($_POST['change_profilepic'])){
		if($_FILES["profile"]["error"] == 0){
			$fileTypePP = exif_imagetype($_FILES["profile"]["tmp_name"]);
			$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
			if ((!in_array($fileTypePP, $allowed))) { 
				$errorinput = 1;
			} else {
				$upload_pp = 1;
			}			
		}
	}
	if($errorinput == 1 ){ 	?>
		<script type="text/javascript">
			alert("Unsupported file type! Only .gif, .jpeg, .png only!");
			window.location = 'my_profile.php';
		</script> 
		<?php
		die();
	}
	if($upload_cp == 1){
		$newfilename = "cover_$user_id.png";
		move_uploaded_file($_FILES['cover']['tmp_name'],'images/cover_img/'. $newfilename);
	}

	if($upload_pp == 1){
		$newfilename = "acc_id_$user_id.jpg";
		move_uploaded_file($_FILES['profile']['tmp_name'], 'images/profile_pic_img/' . $newfilename);
	}
	// die();
	header("Location: my_profile.php");

?>
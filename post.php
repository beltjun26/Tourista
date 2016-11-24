<?php
	session_start(); 
	require "connect.php";

	$post = $_POST['post'];
	$userID = $_SESSION['userID'];
	$locationID = 2; //placeholder BALAY CAWAYAN

	//if may image
	if($_FILES["photo"]["error"] == 0){
		$fileType = exif_imagetype($_FILES["photo"]["tmp_name"]);
		$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
			if ((!in_array($fileType, $allowed))) { 
				$if_image = 0;
?>
				<script type="text/javascript">
					alert("Unsupported file type! Only .gif, .jpeg, .png only!");
					window.location = 'home_page.php';
				</script> 
<?php 
				die();
			} else {
				$if_image = 1;
			}
	}else{
		$if_image = 0;
	}

	$query = "INSERT INTO posted(`post_id`, `content`, `place_id`, `acc_id`, `time_post`, `if_image`) 
				VALUES (NULL, '$post', '$locationID', '$userID', CURRENT_TIMESTAMP, '$if_image');";
	mysqli_query($dbconn, $query);

	$post_id = mysqli_insert_id($dbconn);

	if($if_image == 1){
	 	$newfilename = "$post_id.jpg";
		move_uploaded_file($_FILES['photo']['tmp_name'], 'images/post_img/' . $newfilename);
	}



	header("Location: home_page.php");

 ?>
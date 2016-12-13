<?php
	
	session_start();
	include 'connect.php';

	$place_id = $_SESSION['place_id'];

	if($_FILES["background"]["error"] == 0){
			$fileTypePP = exif_imagetype($_FILES["background"]["tmp_name"]);
			$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
			if ((!in_array($fileTypePP, $allowed))) { 
				?>
			<script type="text/javascript">
				alert("Unsupported file type! Only .gif, .jpeg, .png only!");
				window.location = 'place.php?place_id=<?php echo $_SESSION['place_id']; ?>';
			</script> 
				<?php
				die();


			} else {
				$newfilename = "place_id_$place_id.png";
				move_uploaded_file($_FILES['background']['tmp_name'],'images/places_img/'. $newfilename);
			}			
	}


	header("Location: place.php?place_id=".$place_id);

?>
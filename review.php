<?php
	if (isset($_POST["review"])) {
		$rate = $_POST["rating"];
		$comment = $_POST["comment"];
		echo $rate." ".$comment;
	}
?>
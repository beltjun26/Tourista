<?php 
	
		require "connect.php";
			
		if (isset($_GET["search"])) {
			$searchVal = $_GET["search"];
			$query = "SELECT * FROM account 
					  WHERE username 
					  like '%$searchVal%' 
					  or firstname 
					  like '%$searchVal%'
					  or lastname 
					  like '%$searchVal%' 
					  ";		
			$result = mysqli_query ($dbconn, $query);
			$numberR = mysqli_num_rows($result);
		}
		if(!isset($_GET['page'])){
			$_GET['page'] = 1;
		}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TourisTA!</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
		<meta name="Maynard Vargas and Rosjel Jolly Lambungan" content="Search results people">
		<meta name="James Anthony Yatar" content="Navigation Bar">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/search_style.css">
	</head>
	<body>
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name = "search" value= <?=$searchVal?>>
				<!-- <input type="submit" value="SEARCH" > -->
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<!-- <li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li> -->
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" onerror = "this.src = 'images/default_profile.png'"></a></li>
			</ul>
		</div>
		<div class="search-container" style="margin-top: 60px;">
			<div class="search-type">	
				<h2 class="label result">You have searched for <span class="keyword"><?=$searchVal?></span>. <?=$numberR?> results</h2>
				<ul>
					<li><a href="search_results_places.php?search=<?=$searchVal?>">PLACES</a></li>
					<li><a href="#" class="active">PEOPLE</a></li>
				</ul>
			</div>
			<ul id="Results" class="results-container">
			<?php 
			$numRow = mysqli_num_rows($result);
			$resPerPage = 6;
			$paginationNum = ceil($numRow/$resPerPage); //10 results per 
			$count = 0;
			$pageNum;
			if(isset($_GET["page"])){
				$pageNum = $_GET["page"];
			}else{
				$pageNum = 1;
			}

			
			for($i = 1; $i < $pageNum; $i++){
				for($o = 0; $o < $resPerPage; $o++){
					mysqli_fetch_row($result);
				}

			}


			while($value = mysqli_fetch_assoc($result)){
			//foreach ($result as $value) {?>
				<li class="result-people">
					<a href="people_profile.php?acc_id=<?=$value['acc_id']?>">
						<img src = "images/profile_pic_img/acc_id_<?=$value['acc_id'] ?>.jpg" alt="user image" onerror = "this.src = 'images/default_profile.png'">
						<div class = "user-details">
							<h2 class="username"><?php echo $value['firstname']." ".$value['lastname'] ?></h2>
							<p><?=$value['about_me'] ?></p>
						</div>
					</a>
				</li>
			<?php 
				$count++;
				if($count >= $resPerPage){
					break;
				}
			} ?>
			</ul>
			<ul class="pagination">
				<?php for($i = 1; $i <= $paginationNum; $i++): ?>
				<li><a href="search_results_people.php?search=<?php echo $searchVal;?>&page=<?php echo $i;?>"  
					<?php if ($_GET['page']==$i): ?>
						class="active">
					<?php else: ?>
						>
					<?php endif; 
					      echo $i; 
					      ?>
					</a>
				</li>
				<?php endfor; ?>
			</ul>
		</div>
	</body>
</html>
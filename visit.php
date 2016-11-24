<!DOCTYPE html>
<html>
<head>
	<meta name="author" content="Rosiebelt Jun Abisado and Andrew">
	<title>Toursita</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
	<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
</head>
<body>
  <?php 
      session_start();
      include 'connect.php';
      $query = "SELECT * from image as i, post as p, places as l where p.acc_id = {$_SESSION['userID']} and p.post_id = i.post_id and l.place_id = p.place_id";
      $result = mysqli_query($dbconn, $query);
      $row = [];
      if(mysqli_affected_rows($dbconn)!=0){
        while($data = mysqli_fetch_assoc($result)){
            $row[] = $data;
        }  
      }

      if (isset($_GET["search"])) {
        $searchVal = $_GET["search"];
        
        $query = "SELECT * FROM places WHERE places.name like '%$searchVal%'";    
        $result = mysqli_query ($dbconn, $query);
        $numberR = mysqli_num_rows($result);
      }
   ?>
	<div id = "navBar">
		<form action="search_results_places.php" method="get">
        <input type="text" placeholder="Search..." name = "search">
      </form>
		<ul id = "navList">
			<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
			<li><a href="visit.php" class="active"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
			<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
			<li><a href="people_profile.php" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']; ?>.jpg"></a></li>
		</ul>
	</div>
<!-- insert nav here -->
<input type="text" name="pac-input" id="pac-input">
<div style="height: 600px;width:100%;padding-top:28px" id="map"></div>
<!-- modify map on css please -->
</body>
	<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;
      var geocoder;
      var bounds;
      var markers = [];
      $(window).bind("load", function() {
        bounds = new google.maps.LatLngBounds();
          console.log(markers.length);  
          for (var i = 0; i < markers.length; i++) {
            console.log(markers[i].getPosition());
           bounds.extend(markers[i].getPosition());
          }

          map.fitBounds(bounds);
          map.panToBounds(bounds);
          console.log(map.getBounds());
      });
      function initMap() {
        var pyrmont = {lat: 10.7201501, lng: 122.56210629999998};

        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 15
        });
        geocoder = new google.maps.Geocoder;
        infowindow = new google.maps.InfoWindow();


        var map_icon = {
          url: "images/location_pin.png",
          scaledSize: new google.maps.Size(40, 50),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(0, 0)
        }
        
          <?php foreach ($row as $value):?>
              putplace(map, '<?php echo $value['location_id'] ?>', map_icon);
          <?php endforeach?>
          console.log("haaha");
          
      }


      function putplace(map, place_id, micon){
        geocoder.geocode({'placeId': place_id}, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                  markers.push(new google.maps.Marker({
                  map: map,
                  icon: micon,
                  title: results[0].formatted_address,
                  position: results[0].geometry.location
                }));
                  console.log(markers.length);
                } else {
                  window.alert('No results found');
                }
              } else {
                window.alert('Geocoder failed due to: ' + status);
              }
            });    
      }
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjA-G7nAd-602rgQZiEzTq_hBzxM8eM0E&libraries=places&callback=initMap" async defer></script>
</html>

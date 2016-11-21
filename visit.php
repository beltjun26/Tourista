<!DOCTYPE html>
<script>
//Javascript area looooool 
var w = window,
    d = document,
    e = d.documentElement,
    g = d.getElementsByTagName('body')[0],
    x = w.innerWidth || e.clientWidth || g.clientWidth,
    y = w.innerHeight|| e.clientHeight|| g.clientHeight;
	//alert(x + ' × ' + y); 
</script> 
<html>
<head>
	<meta name="author" content="Rosiebelt Jun Abisado and Andrew">
	<title>Visited Page</title>
	<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
</head>
<body>
  <?php 
      include 'connect.php';
   ?>
<!-- insert nav here -->
	<div id = "navBar">
		<form action="" method="">
			<input id="search_input" type="text" placeholder="Search...">
		</form>
		<ul id = "navList">
			<li><a href="home_page.php"> HOME </a></li>
			<li><a href="visit.php" class="active"> VISITS </a></li>
			<li><a href="#"> EXPLORE </a></li>
			<li><a href="notifications.php"> NOTIFICATIONS </a></li>
			<li><a href="login.php"> LOGOUT </a></li>
			<li><img src="images/temp_pp.png"></li>
		</ul>
	</div>
<div style="height: 600px;width:100%" id="map"></div>
<!-- modify map on css please -->
</body>
	<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;

      function initMap() {
        var pyrmont = {lat: -33.867, lng: 151.195};

        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 15
        });

        var input = document.getElementById('search_input');
        var searchBox = new google.maps.places.SearchBox(input);

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pyrmont,
          radius: 500,
          type: ['store']
        }, callback);
      }

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      } 

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL698CLCTGKNTR4wU0-o_IXtTqdZAowGo&libraries=places&callback=initMap" async defer></script>
</html>

<!DOCTYPE html>
<html>
<head>
	<meta name="author" content="Rosiebelt Jun Abisado and Andrew">
	<title>Toursita</title>
	<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
	<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
</head>
<body>
  <?php 
      include 'connect.php';
   ?>
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
			<li><a href="people_profile.php" class="image-list"><img src="images/pp_cover/Clyde1.jpg"></a></li>
		</ul>
	</div>
<!-- insert nav here -->
<input type="text" name="pac-input" id="pac-input">
<div style="height: 600px;width:100%" id="map"></div>
<!-- modify map on css please -->
</body>
	<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;
      var geocoder;
      function initMap() {
        var pyrmont = {lat: 10.7201501, lng: 122.56210629999998};

        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 15
        });
        geocoder = new google.maps.Geocoder;
        infowindow = new google.maps.InfoWindow();

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];

        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            console.log(place.place_id);
            console.log(place.locality);

            geocoder.geocode({'placeId': placeId}, function(results, status) {
            if (status === 'OK') {
              if (results[0]) {
                console.log(results[0].);
                map.setZoom(11);
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
                });
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
              } else {
                window.alert('No results found');
              }
            }
          });





            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          
          });
          map.fitBounds(bounds);
        });searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

      }

      function geocodePlaceId(geocoder, map, infowindow) {
      var placeId = document.getElementById('place-id').value;
      geocoder.geocode({'placeId': placeId}, function(results, status) {
        if (status === 'OK') {
          if (results[0]) {
            map.setZoom(11);
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });
    }

        // var input = document.getElementById('search_input');
        // var searchBox = new google.maps.places.SearchBox(input);

        // infowindow = new google.maps.InfoWindow();
        // var service = new google.maps.places.PlacesService(map);
        // service.nearbySearch({
        //   location: pyrmont,
        //   radius: 500,
        //   type: ['store']
        // }, callback);
      // }

      // function callback(results, status) {
      //   if (status === google.maps.places.PlacesServiceStatus.OK) {
      //     for (var i = 0; i < results.length; i++) {
      //       createMarker(results[i]);
      //     }
      //   }
      // } 

      // function createMarker(place) {
      //   var placeLoc = place.geometry.location;
      //   var marker = new google.maps.Marker({
      //     map: map,
      //     position: place.geometry.location
      //   });

      //   google.maps.event.addListener(marker, 'click', function() {
      //     infowindow.setContent(place.name);
      //     infowindow.open(map, this);
      //   });
      
       
      
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBww8i2ICp66WttVNyEbgcQXbY8a8sxDrg&libraries=places&callback=initMap" async defer></script>
</html>

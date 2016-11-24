*<!DOCTYPE html>
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
      $query = "SELECT post_id, p.place_id, if_image, name, location_id from  posted as p, places as l where p.acc_id = {$_SESSION['userID']} and  l.place_id = p.place_id group by location_id";
      $result = mysqli_query($dbconn, $query);
      $row = [];
      if(mysqli_affected_rows($dbconn)!=0){
        while($data = mysqli_fetch_assoc($result)){
            $row[] = $data;
        }  
      }
      
   ?>
	<div id = "navBar">
		<form action="" method="">
			<input id="search_input" type="text" placeholder="Search..." name = "search">
		</form>
		<ul id = "navList">
			<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
			<li><a href="visit.php" class="active"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
			<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
			<li><a href="people_profile.php" class="image-list"><img src="images/pp_cover/Clyde1.jpg"></a></li>
		</ul>
	</div>
<!-- insert nav here -->
<div id="map"></div>
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
      var infor_array = [];
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



          <?php foreach ($row as $value):?>
              putplace(map, '<?php echo $value['location_id'] ?>','<?php echo $value['post_id'] ?>', '<?php echo $value['name'] ?>', '<?php echo $value['if_image'] ?>', '<?php echo $value['place_id']?>');
          <?php endforeach?>
      }


      function putplace(map, place_id, img_id,name, if_img, dplace_id){
        geocoder.geocode({'placeId': place_id}, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                  console.log(img_id);
                  var newmarker= new google.maps.Marker({
                  map: map,
                  icon: "images/location_pin.png",
                  title: results[0].formatted_address,
                  position: results[0].geometry.location
                });
                if(if_img==1){
                  var infowindow = new google.maps.InfoWindow({
                  content:'<IMG BORDER="0" ALIGN="Left" style="width:100px;height:auto" SRC="images/post_img/'+img_id+'.jpg"><br><a href="place.php?place_id=1">Visit page<a/><br><p>'+name+'<p/>'
                  });  
                }else{
                    var infowindow = new google.maps.InfoWindow({
                    content:'<a href="place.php?place_id='+dplace_id+'">Visit page<a/><br><p>'+name+'<p/>'
                    });
                }
                
                newmarker.addListener('click', function(){
                  infowindow.open(map, newmarker);
                });
                infor_array.push(infowindow);
                markers.push(newmarker);


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
     <script>
        x = screen.height;
        x = x-130;
        document.getElementById('map').setAttribute("style","height: "+x+"px;width:100%;padding-top:50px");
        console.log("lol");
  </script>
</html>

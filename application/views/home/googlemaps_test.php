<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

    <!-- For UI consistency wehere a p tag exists to greet user if logged in -->
    <p></p>

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Meet Up!</h1>
                <hr class= "my-4">
                <p class="lead">Use the predefined markers to choose a meetup location. For directions, click on the name near the corresponding marker such as Quad or Bee Garden to open Google Maps and navigate to the selected location. </p>
            </div>
        </div>
    </div>

    <br /><br /><br />

    <div class="row-sm-12 justify-content-center">
        <div class="col" style="border: solid 2px #363; border-radius: 6px">

    	    <div id="map" style="width:100%;height:500px"></div>

	    <script>
		function myMap() {

		    // Gets the locations of each meetup spot.
  	            var spot1 = new google.maps.LatLng(37.722319,-122.477410);
 		    var spot2 = new google.maps.LatLng(37.723538,-122.479714);


		    // Centers the map on the first meetup spot.
	            var mapCanvas = document.getElementById("map");
		    var mapOptions1 = {center: spot1, zoom: 17};
		    var map = new google.maps.Map(mapCanvas, mapOptions1);

 
		    // Creates a marker at each meetup spot location.
  		    var marker1 = new google.maps.Marker({position:spot1});
		    var marker2 = new google.maps.Marker({position:spot2});

		    marker1.setMap(map);
		    marker2.setMap(map);


		    // Creates an information window representing each meetup spot.
		    var infowindow1 = new google.maps.InfoWindow({
		   	content: "Meetup Spot 1"
		    });
		    var infowindow2 = new google.maps.InfoWindow({
     		    	content: "Meetup Spot 2"
		    });

		    infowindow1.open(map,marker1);
  		    infowindow2.open(map,marker2);

			
		    // Adds a click event listener to toggle between displaying and hiding the information windows of the meetup spots.
  		    google.maps.event.addListener(marker1, 'click', function() {
    		   	infowindow1.open(map,marker1);
  		    });
  		    google.maps.event.addListener(marker2, 'click', function() {
    		    	infowindow2.open(map,marker2);
  		    });
		}
	    </script>

	    <!-- Uses the provided Google API key to enable the API-->
	    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCUdcpHnR-_uAlhLWkyNN_RPbPqZzYfWM&callback=myMap"></script>

    	    </div>
	</div>

	<br /><br /><br />

    </div>
</div>

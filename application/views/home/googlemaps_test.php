
<div class="container" style="margin-top: 100px">

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron" style="background-color:#FFF; margin-top: 25px; text-align: center">
                <h1 class="display-4">Meet Up!</h1>
                <hr class= "my-4">
                <p class-"lead">Use the predefined markers to choose a location to meet up. For directions, click on the name near the marker such as Quad or Bee Garden to open Google Maps. </p>
            </div>
        </div>
    </div>

    <br /><br /><br />

    <div class="row-sm-12 justify-content-center">
        <div class="col" style="border: solid 2px #363; border-radius: 6px">

    
	    <!--<div id="googleMap" style="width:100%;height:400px;"></div>-->
	    <div id="map" style="width:100%;height:500px"></div>

		<script>
		    function myMap() {

		   /*
		    var mapProp= {
    			center:new google.maps.LatLng(51.508742,-0.120850),
    			zoom:5,
		    };
		    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
		    */


  		    	var spot1 = new google.maps.LatLng(37.722319,-122.477410);
 		    	var spot2 = new google.maps.LatLng(37.723538,-122.479714);

		    	var mapCanvas = document.getElementById("map");

		    	var mapOptions1 = {center: spot1, zoom: 17};


		    	var map = new google.maps.Map(mapCanvas, mapOptions1);
 
  		   	var marker1 = new google.maps.Marker({position:spot1});
		   	marker1.setMap(map);

		   	var marker2 = new google.maps.Marker({position:spot2});
		    	marker2.setMap(map);

		    	var infowindow1 = new google.maps.InfoWindow({
		    	    content: "Meetup Spot 1"
		    	});
 
		    	infowindow1.open(map,marker1);

		    	var infowindow2 = new google.maps.InfoWindow({
     		    	    content: "Meetup Spot 2"
		    	});

  		    	infowindow2.open(map,marker2);


  		    	google.maps.event.addListener(marker1, 'click', function() {
    		    	    infowindow1.open(map,marker1);
  		    	});

  		   	google.maps.event.addListener(marker2, 'click', function() {
    		    	    infowindow2.open(map,marker2);
  		    	});

		    }

		</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCUdcpHnR-_uAlhLWkyNN_RPbPqZzYfWM&callback=myMap"></script>

    	    </div>
	</div>

	<br /><br /><br />

    </div>
</div>

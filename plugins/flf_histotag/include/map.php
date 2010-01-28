<?php

$latitude = $_GET["latitude"];
$longitude = $_GET["longitude"];
$apiKey = $_GET["apiKey"];
$image = $_GET["image"];
$width = $_GET["width"];
$height = $_GET["height"];
echo <<<EOT

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>easyMap for Pixelpost</title>
<script type="text/javascript">
      var KillAlerts = true;
      var realAlert = alert;
      var alert = new Function('a', 'if(!KillAlerts){realAlert(a)}');
</script>
 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$apiKey}" type="text/javascript"></script>
 <style type="text/css">
<!--
#map {
width:{$width}px;
height:{$height}px;
display:block;
}
-->
</style>
<script type="text/javascript">

function load() {	 
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.setMapType(G_SATELLITE_MAP);
        map.addControl(new GLargeMapControl());
				map.addControl(new GMapTypeControl());
				map.addControl(new GOverviewMapControl());
				map.enableContinuousZoom();
				map.enableDoubleClickZoom(); 
				
        map.setCenter(new GLatLng({$latitude},{$longitude}), 13);
        map.setZoom(15);
        
         var center = map.getCenter();
					var center_y = center.y
					var center_x = center.x 
						GEvent.addListener(map, "mouseover", function(){
							map.showControls();
						});
						GEvent.addListener(map, "mouseout", function(){
							map.hideControls(); 
						});
						var infoTabs = [
						new GInfoWindowTab("Standort"," <div style='text-align:center;'><img style='vertical-align:middle;' src='{$image}'><\div>")
					];
					var marker = new GMarker(map.getCenter());
					map.addOverlay(marker);
					var windowOptions = {maxWidth: "95"}; 
					GEvent.addListener(marker, "click", function() {
					marker.openInfoWindowTabsHtml(infoTabs,windowOptions);
					});
      }
      else {
      	if (G_INCOMPAT) {
            // Key is NOT valid.
            //Open the Google Maps website
            document.getElementById("map").innerHTML = '<span style="background-color:#394253;color:#7CFC00">Google API key failure!</span><br/><br/><a href="http://maps.google.com/?ie=UTF8&ll={$latitude},{$longitude}&z=13&q={$latitude},{$longitude}(photo location)&output=">click here to visit google maps directly instead</a>' ;
        } else {
            // Can't tell if the Google API Key is valid, due to the browser not being compatible with the Google Maps API.
            document.getElementById("map").innerHTML = '<span style="background-color:#394253;color:#7CFC00">Google API key failure!</span><br/><br/><a href="http://maps.google.com/?ie=UTF8&ll={$latitude},{$longitude}&z=13&q={$latitude},{$longitude}(photo location)&output=">click here to visit google maps directly instead</a>' ;
        }
      }
}

</script>


</head>

<body onload="load()">
<div id="map"><a href="http://maps.google.com/?ie=UTF8&ll={$latitude},{$longitude}&z=13&q={$latitude},{$longitude}(photo location)&output=" title="go to Google Maps"><img src="http://maps.google.com/staticmap?center={$latitude},{$longitude}&markers={$latitude},{$longitude},redc&zoom=10&size=500x400&key={$apiKey}" alt="Google API key failure! Click here to visit google maps directly instead"/></a></div>
</body>
</html>
         

EOT;

?>
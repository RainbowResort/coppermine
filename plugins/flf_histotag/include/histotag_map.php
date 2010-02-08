<?php

$latitude = $_GET["latitude"];
$longitude = $_GET["longitude"];
$apiKey = $_GET["apiKey"];
$image = $_GET["image"];
$width = $_GET["width"];
$height = $_GET["height"];
$type=$_GET["type"];
$maptype="";
switch ($type) {
    case 1:
        $maptype='G_SATELLITE_MAP';
        break;
    case 2:
        $maptype='G_NORMAL_MAP';
        break;
    case 3:
        $maptype='G_HYBRID_MAP';;
        break;
    case 4:
        $maptype='G_PHYSICAL_MAP';;
        break;
    case 5:
        $maptype='G_SATELLITE_3D_MAP';;
        break;        
        
        default:
        $maptype='G_SATELLITE_MAP';
}





echo <<<EOT

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>flf histotag for coppermine</title>
<script type="text/javascript">
      var KillAlerts = true;
      var realAlert = alert;
      var alert = new Function('a', 'if(!KillAlerts){realAlert(a)}');
</script>
 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$apiKey}" type="text/javascript"></script>
 <style type="text/css">
<!--
#histotag_map {
width:{$width}px;
height:{$height}px;
display:block;
}
-->
</style>
<script type="text/javascript">

function load() {	 
      if (GBrowserIsCompatible()) {
        var histotag_map = new GMap2(document.getElementById("histotag_map"));
        histotag_map.setMapType($maptype);
        
       // histotag_map.setMapType(G_SATELLITE_MAP);
        histotag_map.addControl(new GLargeMapControl());
				histotag_map.addControl(new GMapTypeControl());
				histotag_map.addControl(new GOverviewMapControl());
				histotag_map.enableContinuousZoom();
				histotag_map.enableDoubleClickZoom(); 
				
        histotag_map.setCenter(new GLatLng({$latitude},{$longitude}), 13);
        histotag_map.setZoom(15);
        
         var center = histotag_map.getCenter();
					var center_y = center.y
					var center_x = center.x 
						GEvent.addListener(histotag_map, "mouseover", function(){
							histotag_map.showControls();
						});
						GEvent.addListener(histotag_map, "mouseout", function(){
							histotag_map.hideControls(); 
						});
						var infoTabs = [
						new GInfoWindowTab("Standort"," <div style='text-align:center;'><img style='vertical-align:middle;' src='{$image}'><\div>")
					];
					var marker = new GMarker(histotag_map.getCenter());
					histotag_map.addOverlay(marker);
					var windowOptions = {maxWidth: "95"}; 
					GEvent.addListener(marker, "click", function() {
					marker.openInfoWindowTabsHtml(infoTabs,windowOptions);
					});
      }
      else {
      	if (G_INCOMPAT) {
            // Key is NOT valid.
            //Open the Google Maps website
            document.getElementById("histotag_map").innerHTML = '<span style="background-color:#394253;color:#7CFC00">Google API key failure!</span><br/><br/><a href="http://maps.google.com/?ie=UTF8&ll={$latitude},{$longitude}&z=13&q={$latitude},{$longitude}(photo location)&output=">click here to visit google maps directly instead</a>' ;
        } else {
            // Can't tell if the Google API Key is valid, due to the browser not being compatible with the Google Maps API.
            document.getElementById("histotag_map").innerHTML = '<span style="background-color:#394253;color:#7CFC00">Google API key failure!</span><br/><br/><a href="http://maps.google.com/?ie=UTF8&ll={$latitude},{$longitude}&z=13&q={$latitude},{$longitude}(photo location)&output=">click here to visit google maps directly instead</a>' ;
        }
      }
}

</script>


</head>

<body onload="load()">
<div id="histotag_map"><a href="http://maps.google.com/?ie=UTF8&ll={$latitude},{$longitude}&z=13&q={$latitude},{$longitude}(photo location)&output=" title="go to Google Maps"><img src="http://maps.google.com/staticmap?center={$latitude},{$longitude}&markers={$latitude},{$longitude},redc&zoom=10&size=500x400&key={$apiKey}" alt="Google API key failure! Click here to visit google maps directly instead"/></a></div>
</body>
</html>
         

EOT;

?>
<?php
/**************************************************
  Coppermine 1.5.x Plugin - GeoData
  *************************************************
  Copyright (c) 2011 Pierre BASMOREAU
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: 
  $Revision:
  $LastChangedBy: 
  $Date: 2011/08/11 (use Google Maps V3)
  **************************************************/

if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

require_once ('include/init.inc.php');

$geodata_superCage = Inspekt::makeSuperCage();

//Filter PID of picture
if ($geodata_superCage->get->keyExists('id')) {
    $pid = $geodata_superCage->get->getInt('id');
} elseif ($geodata_superCage->post->keyExists('id')) {
    $pid = $geodata_superCage->post->getInt('id');
} else {
    cpg_die(ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
}

//Reading pictures of album
$sql="SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_geodata WHERE geodata_pid = '{$pid}'";
$result = cpg_db_query($sql);
$row = mysql_fetch_assoc($result);
$latitude = $row['geodata_latitude'];
$longitude = $row['geodata_longitude'];

$mapwidth = 800;
$mapheight = 600;

echo <<<EOT

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Plugin GeoData for Coppermine</title>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">

	var map;
	var latlng = new google.maps.LatLng({$latitude}, {$longitude});

	/**
	 * The HomeControl adds a control to the map that simply
	 * returns the user to marker. This constructor takes
	 * the control DIV as an argument.
	 */
	function HomeControl(controlDiv, map) {
		// Set CSS styles for the DIV containing the control
		// Setting padding to 5 px will offset the control
		// from the edge of the map
		controlDiv.style.padding = '5px';

		// Set CSS for the control border
		var controlUI = document.createElement('DIV');
		controlUI.style.backgroundColor = 'white';
		controlUI.style.borderStyle = 'solid';
		controlUI.style.borderWidth = '2px';
		controlUI.style.cursor = 'pointer';
		controlUI.style.textAlign = 'center';
		controlUI.title = 'Click to set the map to Home';
		controlDiv.appendChild(controlUI);

		// Set CSS for the control interior
		var controlText = document.createElement('DIV');
		controlText.style.fontFamily = 'Arial,sans-serif';
		controlText.style.fontSize = '12px';
		controlText.style.paddingLeft = '4px';
		controlText.style.paddingRight = '4px';
		controlText.innerHTML = '<b>Home</b>';
		controlUI.appendChild(controlText);

		// Setup the click event listeners: simply set the map to latlng
		google.maps.event.addDomListener(controlUI, 'click', function() {
		map.setCenter(latlng),
		map.setZoom(18)
		});
	}

	function initialize() {	
		var myOptions = {
			zoom: 18,
			center: latlng,
			navigationControl: true,
			streetViewControl: false,
			mapTypeControl: true,
			mapTypeId: google.maps.MapTypeId.SATELLITE,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
			}
		};
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		
		//Bulle du marqueur
		var html="<div style='text-align:center;'><b>Latitude</b> : {$latitude}<br/><b>Longitude</b> : {$longitude}<\div>";
		
		//Définition du marqueur de l'image
		var marker = new google.maps.Marker ({
			position: latlng
		});
		
		//Affiche le marqueur sur la carte
		marker.setMap(map);
		
		//Définition InfoWindow du marqueur
		var infoWindow = new google.maps.InfoWindow({
			content: html
		});
		
		//Evenement clic du marqueur
		google.maps.event.addListener(marker, 'click', function() {
			infoWindow.open(map,marker);
		});

		// Create the DIV to hold the control and
		// call the HomeControl() constructor passing
		// in this DIV.
		var homeControlDiv = document.createElement('DIV');
		var homeControl = new HomeControl(homeControlDiv, map);
		homeControlDiv.index = 1;
		map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);

	} // End of Initialize

	// Call intialize to start
	google.maps.event.addDomListener(window, 'load', initialize);

</script>

</head>

<body>
	<div id="map_canvas" style="width:{$mapwidth}px; height:{$mapheight}px;"></div>
</body>

</html>

EOT;

?>

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
  $Date: 2011/08/22
  **************************************************/
define('IN_COPPERMINE', true);
require('./plugins/geodata/include/init.inc.php');

$geodata_superCage = Inspekt::makeSuperCage();

//Filter PID of picture
if ($geodata_superCage->get->keyExists('id')) {
    $pid = $geodata_superCage->get->getInt('id');
} elseif ($geodata_superCage->post->keyExists('id')) {
    $pid = $geodata_superCage->post->getInt('id');
} else {
    cpg_die(ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
}

/* --------------------------------------------------------------------------
 * SAVE picture in GEODATA
 * --------------------------------------------------------------------------*/
function save_picture_geodata()
{
    global $CONFIG, $USER_DATA, $lang_errors, $lang_editpics_php, $geodata_superCage, $lang_plugin_geodata, $aid;

    //Check if the form token is valid
    if(!checkFormToken()){
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }
	//PID picture + AID album
    $pid = $geodata_superCage->post->getInt('id');
	$aid = $geodata_superCage->post->getInt('aid');
	$latitude = $geodata_superCage->post->getRaw('current_latitude');
	$longitude = $geodata_superCage->post->getRaw('current_longitude');
	//Update string for latitude
	$update = "geodata_latitude = '$latitude', ";
	//Update string for longitude
	$update .= "geodata_longitude = '$longitude', ";
	//Update date
	$update .= "geodata_date = NOW(), ";
	//Update aid album
	$update .= "geodata_aid = '$aid'";

	$query="select geodata_pid from {$CONFIG['TABLE_PREFIX']}plugin_geodata where geodata_pid='$pid'";
	$vResult = cpg_db_query($query);
	$current_pic = mysql_fetch_assoc($vResult);	
	if (isset($current_pic['geodata_pid'])) {
		//SQL UPDATE geodata
		$query = "UPDATE {$CONFIG['TABLE_PREFIX']}plugin_geodata set $update WHERE geodata_pid='$pid'";
	} else {
		//SQL INSERT geodata
		$query = "INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_geodata SET geodata_pid='$pid', $update ";
	}
    cpg_db_query($query);
	
	//Save lastlatitude in Config File
	$lastlatitude = $latitude;
	$CONFIG['plugin_geodata_lastlatitude'] = $lastlatitude;
	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='$lastlatitude' WHERE name='plugin_geodata_lastlatitude'";
    cpg_db_query($query);
	//Save lastlongitude in Config File
	$lastlongitude = $longitude;
	$CONFIG['plugin_geodata_lastlongitude'] = $lastlongitude;
	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='$lastlongitude' WHERE name='plugin_geodata_lastlongitude'";
    cpg_db_query($query);
}

/* --------------------------------------------------------------------------
 * Remove picture from GEODATA
 * --------------------------------------------------------------------------*/
function remove_picture_geodata ()
{
    global $CONFIG, $USER_DATA, $lang_errors, $lang_editpics_php, $geodata_superCage, $lang_plugin_geodata, $aid;

    //Check if the form token is valid
    if(!checkFormToken()){
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }
	//PID picture + AID album
    $pid = $geodata_superCage->post->getInt('id');
	$query="DELETE from {$CONFIG['TABLE_PREFIX']}plugin_geodata where geodata_pid='$pid'";
	$vResult = cpg_db_query($query);

}

/* --------------------------------------------------------------------------
 * MAIN CODE
 * --------------------------------------------------------------------------*/

//Default Submit Button to send geodata
$button_submit = "<input type=\"submit\" class=\"button\" value=\"{$lang_plugin_geodata['submit_geodata']}\" id=\"apply_geodata\" name=\"apply_geodata\">";
$button_remove = "<input type=\"submit\" class=\"button\" value=\"{$lang_plugin_geodata['remove_geodata']}\" id=\"remove_geodata\" name=\"remove_geodata\">";

//If geodata sent by form, process !
if ($geodata_superCage->post->keyExists('apply_geodata')) {
    save_picture_geodata();
	$message = "<h2><a href=\"#\" onclick=\"self.close();\">".$lang_plugin_geodata['update_success']."</a></h2>";
	// Submit button deactivate after process
	$button_submit = "";
} elseif ($geodata_superCage->post->keyExists('remove_geodata')) {
	remove_picture_geodata();
	$message = "<h2><a href=\"#\" onclick=\"self.close();\">".$lang_plugin_geodata['remove_success']."</a></h2>";
	// Submit button deactivate after process
	$button_submit = "";
}

//Info picture
$result = cpg_db_query("SELECT *, p.title AS title, p.votes AS votes FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON a.aid = p.aid WHERE pid = '$pid'");
$CURRENT_PIC = mysql_fetch_assoc($result);
mysql_free_result($result);

//Authorized to modify picture ?
if (!(GALLERY_ADMIN_MODE || $CURRENT_PIC['category'] == FIRST_USER_CAT + USER_ID || ($CONFIG['users_can_edit_pics'] && $CURRENT_PIC['owner_id'] == USER_ID)) || !USER_ID) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

$thumb_url = get_pic_url($CURRENT_PIC, 'thumb');
$filename = htmlspecialchars($CURRENT_PIC['filename']);
$filepath = htmlspecialchars($CURRENT_PIC['filepath']);

//Initialize last latitude/longitude from last picture or lat/lon by default
if ($CONFIG['plugin_geodata_lastlatitude'])
	$latitude_base = $CONFIG['plugin_geodata_lastlatitude'];
else
	$latitude_base = 20;

if ($CONFIG['plugin_geodata_lastlongitude'])
	$longitude_base = $CONFIG['plugin_geodata_lastlongitude'];
else
	$longitude_base = -10;


//Geodata for picture (if modify)
if ($geodata_superCage->get->keyExists('latitude')) {
	$current_latitude = $geodata_superCage->get->getRaw('latitude');
	$latitude_base = $current_latitude;
}
if ($geodata_superCage->get->keyExists('longitude')) {
	$current_longitude = $geodata_superCage->get->getRaw('longitude');
	$longitude_base = $current_longitude;
}


// Token form
list($timestamp, $form_token) = getFormToken();

// Display map
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
	var marker;

	function initialize() {	
		var latlng = new google.maps.LatLng({$latitude_base}, {$longitude_base});
		
		var myOptions = {
			zoom: 15,
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

		//Initialize marker with last Lat/Lng
		var marker = new google.maps.Marker ({
			position: latlng,
			map: map,
			draggable: true
		});
		
		// Update current position info.
		updateMarkerPosition(latlng);

		// Position marker after drag
		google.maps.event.addListener(marker, 'dragend', function() {
			updateMarkerPosition(marker.getPosition());
		});

		// re Center marker on map with single click
		google.maps.event.addListener(map, 'click', function(e) {
			marker.setPosition(e.latLng);
			updateMarkerPosition(e.latLng);
		});
		
	} // End of Initialize

	// Call intialize to start
	google.maps.event.addDomListener(window, 'load', initialize);

	// Display position of marker
	function updateMarkerPosition(latlng) {
		document.getElementById('current_longitude').value = latlng.lng();
		document.getElementById('current_latitude').value = latlng.lat();
	}

</script>

</head>
<body>
	<div id="map_canvas" style="width: 750px; height: 500px"></div>
	<div style="float:left;"><img src="$thumb_url" class="image" border="0" alt="{$CURRENT_PIC['title']}"/></div>
	<div style="float:left;">
    <form name="creategeodata" id="cpgform_creategeodata" method="post" action="index.php?file=geodata/creategeodata">
	{$message}
	{$button_submit}
	{$button_remove}
	
	<input type="hidden" name="form_token" value="{$form_token}" />
	<input type="hidden" name="timestamp" value="{$timestamp}" />
	<input type="hidden" name="id" value="{$CURRENT_PIC['pid']}" />
	<input type="hidden" name="aid" value="{$CURRENT_PIC['aid']}" />

	<input type="hidden" id="current_latitude" name="current_latitude" value="" >
	<input type="hidden" id="current_longitude" name="current_longitude" value="" >
	
	</div>
	</form>
		
</body>
</html>

EOT;

?>
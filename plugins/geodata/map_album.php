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
  $Date: 2011/08/22 (use Google Maps API V3)
  **************************************************/
define('IN_COPPERMINE', true);
require_once ('include/init.inc.php');

define('MAP_ALBUM', true);

$geodata_superCage = Inspekt::makeSuperCage();

// Filter AID album
$aid=$geodata_superCage->get->getInt('aid');
if (in_array($aid, $FORBIDDEN_SET_DATA)) {
    cpg_die(ERROR, $lang_errors['access_none']);
}

//Info album
$result = cpg_db_query("SELECT category, title, aid, keyword, description, alb_password_hint FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = $aid");
if (mysql_num_rows($result) > 0) {
	$CURRENT_ALBUM_DATA = mysql_fetch_assoc($result);
	$CURRENT_ALBUM_KEYWORD = $CURRENT_ALBUM_DATA['keyword'];
	breadcrumb($actual_cat, $breadcrumb, $breadcrumb_text);
}
mysql_free_result($result);

$mapheight = 600;
$enlargeit = $CONFIG['plugin_geodata_enlargeit'];
$widthright=$CONFIG['thumb_width']+25;

//Reading pictures of album
$sql="SELECT t.pid, t.aid, t.title, t.filepath, t.filename, t.pwidth, t.pheight FROM {$CONFIG['TABLE_PICTURES']} t WHERE t.aid ='{$aid}' and t.pid in (SELECT geodata_pid from  {$CONFIG['TABLE_PREFIX']}plugin_geodata)";
$result = cpg_db_query($sql);
$markers="";
$count=0;

// For each picture, reading info, constructs geodata to display marker and link to display picture in full size
while ($row = mysql_fetch_assoc($result)) {
	$pid = $row['pid'];
	$aid = $row['aid'];
	$filepath = $row['filepath'];
	$filename = $row['filename'];
	$title = $row['title'];
	$pwidth = $row['pwidth'];
	$pheight = $row['pheight'];
	$mapcoord=picture_in_geodata($pid);

	// Reading geodata
	if ($mapcoord[0] == true) {
		$latitude=$mapcoord[1];
		$longitude=$mapcoord[2];
		//Link inside marker to display picture in full size
		if ($CONFIG['plugin_geodata_enlargeit'] == 1) {
			//Use local enlargeit
			$html="<div align=\'center\'><a href=\"#\" onclick=\"return false;\"><img src=\'albums/{$filepath}thumb_{$filename}\' id=\'{$pid}\' onclick=\'enlarge(this);\' alt=\'{$filename}\' longdesc=\'albums/{$filepath}{$filename}\'></a></div><div align=\'center\'>$title</div>";
		}
		else {
			//Display image standard
			$html="<div align=\'center\'><a href=\"javascript:;\" onclick=\"MM_openBrWindow(\'displayimage.php?pid={$pid}&amp;fullsize=1\')\"><img src=\'albums/{$filepath}thumb_{$filename}\'></a></div><div align=\'center\'>$title</div>";
		}

		//Constructs every marker to display
		$markers = $markers ."
			var pointLieu = new google.maps.LatLng($latitude,$longitude);
			bounds.extend(pointLieu);
			var marker = new google.maps.Marker ({
				position: pointLieu,
				map: maCarte,
				title: '{$title}'
			});
			google.maps.event.addListener(marker, 'click', onMarkerClick('{$html}'));
			//Limits of map (to display all markers)
			maCarte.fitBounds(bounds);
			//Save info for sidebar
			gmarkers.push(marker);
			// Content of sidebar
			side_bar_html += '<a href=\"javascript:myclick({$count})\"><img class=\"image\" src=\"albums/{$filepath}thumb_{$filename}\"></a>';";
			
		$count++;
	}
} //End of WHILE

pageheader();
starttable("100%",$CURRENT_ALBUM_DATA['title'] . " > <a href='thumbnails.php?album=".$CURRENT_ALBUM_DATA['aid']."'>".$lang_img_nav_bar['thumb_title']."</a>");
endtable();

echo <<<EOT

<script type="text/javascript">

var gmarkers = [];
var side_bar_html = '';

// If click on sidebar, display the infoWindow of marker
function myclick(i) {
	google.maps.event.trigger(gmarkers[i],'click');
}

function initialize() {

    var optionsCarte = {
        mapTypeId: google.maps.MapTypeId.SATELLITE,
		streetViewControl: false,
		scrollwheel: false
    };
    var maCarte = new google.maps.Map(document.getElementById("map_canvas"), optionsCarte);
	
    var bounds = new google.maps.LatLngBounds();

	//Create single instance of the InfoWindow
	var infoWindow = new google.maps.InfoWindow();
	
	//Click on marker to display thumbnail
	var onMarkerClick = function(html) {
		return function() {
			var marker = this;
			infoWindow.setContent(html);
			infoWindow.open(maCarte, marker);
		};
	};

	//Close InfoWindow when clicking anywhere on the map
	google.maps.event.addListener(maCarte, 'click', function() {
		infoWindow.close();
	});
	
EOT;

echo $markers;

echo <<<EOT

	// Load sidebar
	document.getElementById("side_bar").innerHTML = side_bar_html;
}
	// Call initialize to start
	google.maps.event.addDomListener(window, 'load', initialize);

</script>

<table width="100%" border="1" CELLSPACING="0">
	<tr>
	<td><div id="map_canvas" style=" width: 100%; height: {$mapheight}px;"></div></td>
	<td width="{$widthright}px" align="center" valign="center"><div id="side_bar" style="height: {$mapheight}px; overflow: auto;"></div></td>
	</tr>
</table>

EOT;

pagefooter();
ob_end_flush();
exit;


?>

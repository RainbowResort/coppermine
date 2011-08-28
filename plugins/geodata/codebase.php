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
  $Date: 2011/08/17
  **************************************************/
 
if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}
if (!defined('PLUGINMGR_PHP')) {
	define('PLUGINMGR_PHP', true);
}
if (!defined('ADMIN_PHP')) {
    define('ADMIN_PHP', true);
}
if (!defined('CORE_PLUGIN')) {
    define('CORE_PLUGIN', true);
}

// Add plugin_cleanup action
$thisplugin->add_action('plugin_cleanup','geodata_cleanup');
// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','geodata_uninstall');
// Add plugin_install action
$thisplugin->add_action('plugin_install','geodata_install');

// Add display map for 1 picture
$thisplugin->add_filter('theme_img_navbar','geodatabuttoncheck');
// Add logo google to display map for album
$thisplugin->add_action('post_breadcrumb','ShowMapAlbum');
// Add filter for page head
$thisplugin->add_filter('page_meta','geodata_head');

/********************************************************************
Insert META For API Google V3
********************************************************************/
function geodata_head($meta) {
	$meta .=<<<EOT
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
EOT;
	return $meta;
}

/********************************************************************
Display link to display map for all pictures of album
Only if pictures found with geodata !
********************************************************************/
function ShowMapAlbum($html) {
	GLOBAL $lang_plugin_geodata, $CONFIG;
	$geodata_superCage = Inspekt::makeSuperCage();
	$aid=$geodata_superCage->get->getInt('album');
	if ($aid>0) {
		// Verify if pictures of album are found with geodata
		$sql = "SELECT COUNT(geodata_aid) AS nb_pictures FROM {$CONFIG['TABLE_PREFIX']}plugin_geodata where geodata_aid='{$aid}'";
		$result = cpg_db_query($sql);
		$row = mysql_fetch_assoc($result);
		if ($row['nb_pictures'] != 0) {
			// Show only if valid album is selected.
			$link="<div align=\"center\"><a href=\"index.php?file=geodata/map_album&aid={$aid}\" title=\"{$lang_plugin_geodata['mapalbumtitle']}\"><img src=\"plugins/geodata/images/google_maps_logo.jpg\" border=\"0\"></a></div>";
			echo $link;
		}
	}
	return $html;
}

/********************************************************************
Choice button if geodata found or not
********************************************************************/
function geodatabuttoncheck ($template_img_navbar) {
	global $CONFIG;
	$result=$template_img_navbar;
	// Option show_button = 1 (always) OR show_button = 2 (only geodata found)
	if ($CONFIG['plugin_geodata_showbutton'] < '3'){
		$result=render_geodata_button($template_img_navbar);
	}
	return $result;
}

/********************************************************************
Check if picture contains geodata
returns : true if geodata found with coordinates
returns : false in other case
********************************************************************/
function picture_in_geodata ($picture_id)
{
	global $CONFIG;
	
	$sql="select * from {$CONFIG['TABLE_PREFIX']}plugin_geodata where geodata_pid='{$picture_id}'";
	$result = cpg_db_query($sql);
	$current_pic = mysql_fetch_assoc($result);

	if (isset($current_pic['geodata_pid'])) {
		$returnvalues[0]=true;
		$returnvalues[1]=$current_pic['geodata_latitude'];
		$returnvalues[2]=$current_pic['geodata_longitude'];
	} else {
		$returnvalues[0]=false;
	}
	return $returnvalues;
}

/********************************************************************
Build link for geodata button
********************************************************************/
function render_geodata_button($template_img_navbar) {

    global $CONFIG, $CURRENT_PIC_DATA, $FAVPICS, $REFERER, $lang_picinfo, $lang_plugin_geodata;

	require ('./plugins/geodata/include/init.inc.php');

	$ref = $REFERER ? "&amp;referer=$REFERER" : '';

	//Picture in plugin_geodata ?
	$data_found = picture_in_geodata($CURRENT_PIC_DATA['pid']);
	
	// Data found ?
	if ($data_found[0] == true) {
		$latitude = $data_found[1];
		$longitude = $data_found[2];
		// User Mode
		if (!GALLERY_ADMIN_MODE) {
			$geo_title = $lang_plugin_geodata['map_picture'];
			$geo_icon = "geo.png";
			$geo_button="
			<td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
				<a href=\"javascript:;\" title=\"$geo_title\" onclick=\"return MM_openBrWindow('index.php?file=geodata/map_picture&id={$CURRENT_PIC_DATA['pid']}','Create GeoData','scrollbar=no,toolbar=no,status=no,resizable=no,width=800,height=600')\"><img src=\"plugins/geodata/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"geo_ico\" /></a>
			</td>";
		}
		// Admin Mode
		else {
			$geo_title = $lang_plugin_geodata['view_modify_geodata'];
			$geo_icon = "geo.png";
			$geo_button = "
			<td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
				<a href=\"javascript:;\" title=\"$geo_title\" onclick=\"return MM_openBrWindow('index.php?file=geodata/creategeodata&id={$CURRENT_PIC_DATA['pid']}&latitude={$latitude}&longitude={$longitude}','Create GeoData','location=no,scrollbar=no,toolbar=no,status=no,resizable=no,width=800,height=600')\"><img src=\"plugins/geodata/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"geo_ico\" /></a>
				</td>";
		}
	}

	// No data
	else {
		// User Mode
		if (!GALLERY_ADMIN_MODE) { 
			// Option show_button = 2 (ONLY geodata)
			if ($CONFIG['plugin_geodata_showbutton'] < '2') {
				$geo_title = $lang_plugin_geodata['no_data'];
				$geo_icon = "nogeo.png";
				$geo_button = "
				<td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
					<a href=\"#\" class=\"navmenu_pic\" title=\"$geo_title\" id=\"geo_lnk\"><img src=\"plugins/geodata/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"geo_ico\" /></a>
				</td>";
			}
		}
		//Admin Mode
		else {
			$geo_title = $lang_plugin_geodata['create_geodata'];
			$geo_icon = "nogeo.png";
			$geo_button = "
			<td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
				<a href=\"javascript:;\" title=\"$geo_title\" onclick=\"return MM_openBrWindow('index.php?file=geodata/creategeodata&id={$CURRENT_PIC_DATA['pid']}','Create GeoData','location=no,scrollbar=no,toolbar=no,status=no,resizable=no,width=800,height=600')\"><img src=\"plugins/geodata/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"geo_ico\" /></a>
				</td>";
		}
	}
    $search = substr_count($template_img_navbar, "<!-- BEGIN pic_info_button -->") > 0 ? "<!-- BEGIN pic_info_button -->" : "<!-- BEGIN slideshow_button -->";
    $template_img_navbar = str_replace($search, $geo_button.$search, $template_img_navbar);
    return $template_img_navbar;
}


/********************************************************************
Uninstall plugin
********************************************************************/
function geodata_uninstall()
{
	global $CONFIG;
	$geodata_superCage = Inspekt::makeSuperCage();

	if (!$geodata_superCage->post->keyExists('drop')) {
		return 1;
	}
	// Drop the tables
	if ($geodata_superCage->post->getInt('drop') == 1) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_geodata");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}config WHERE name LIKE 'plugin_geodata_%'");
	}
	return true;
}

/********************************************************************
Ask if we want to drop the table
********************************************************************/
function geodata_cleanup($action) {

    global $lang_plugin_geodata, $CONFIG;
	require_once('./plugins/geodata/include/init.inc.php');

    $geodata_superCage = Inspekt::makeSuperCage();
    $cleanup = $geodata_superCage->server->getEscaped('REQUEST_URI');

    if ($action===1) {
    echo <<< EOT
    <form action="{$cleanup}" method="post">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="tableb">
                    {$lang_plugin_geodata['geodata_remove']}
                </td>
                <td class="tableb">
                    <input type="radio" name="drop" id="drop_yes" value="1" />
                    <label for="drop_yes" class="clickable_option">{$lang_plugin_geodata['yes']}</label>
                </td>
                <td class="tableb">
                    <input type="radio" name="drop" id="drop_no" checked="checked" value="0" />
                    <label for="drop_no" class="clickable_option">{$lang_plugin_geodata['no']}</label>
                </td>
                <td class="tableb">
                    <input type="submit" name="submit" value="{$lang_plugin_geodata['submit_button']}">
                </td>
            </tr>
        </table>
    </form>
EOT;
    }
}

/********************************************************************
Install plugin
********************************************************************/
function geodata_install()
{
	global $CONFIG, $thisplugin;
	$tablename='plugin_geodata';

	//Create table plugin_geodata
	$sql = "CREATE TABLE IF NOT EXISTS `{$CONFIG['TABLE_PREFIX']}{$tablename}` (
	`geodata_pid` int(11) NOT NULL default '0',
	`geodata_aid` int(11) NOT NULL default '0',
	`geodata_latitude` FLOAT (10,6) NOT NULL,
	`geodata_longitude` FLOAT (10,6) NOT NULL,
	`geodata_date` datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY (`geodata_pid`)
	);";
	cpg_db_query($sql);	
	
	//Create fields in TABLE_CONFIG if not exists
	if (!$CONFIG['plugin_geodata_lastlatitude']) {
		$sql = "insert IGNORE into {$CONFIG['TABLE_CONFIG']} values ('plugin_geodata_lastlatitude','20.000000')";
		cpg_db_query($sql);
	}
	if (!$CONFIG['plugin_geodata_lastlongitude']) {
		$sql = "insert IGNORE into {$CONFIG['TABLE_CONFIG']} values ('plugin_geodata_lastlongitude','-10.000000')";
		cpg_db_query($sql);
	}
	if (!$CONFIG['plugin_geodata_showbutton']) {
		$sql = "insert IGNORE into {$CONFIG['TABLE_CONFIG']} values ('plugin_geodata_showbutton','1')";
		cpg_db_query($sql);
	}
	if (!$CONFIG['plugin_geodata_enlargeit']) {
		$sql = "insert IGNORE into {$CONFIG['TABLE_CONFIG']} values ('plugin_geodata_enlargeit','0')";
		cpg_db_query($sql);
	}
	return true;
}

?>
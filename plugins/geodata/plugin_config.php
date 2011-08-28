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

require_once('include/init.inc.php');
require('./plugins/geodata/include/init.inc.php');

$geodata_superCage = Inspekt::makeSuperCage();

global $CONFIG, $lang_plugin_geodata;

// Not Admin Mode = access denied
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

if($lang_text_dir=='ltr') {
  $align="left";
  $direction="ltr";
}else {
  $align="right";
  $direction="rtl";
}

//Page Header
pageheader($lang_plugin_geodata['display_name']);

//Update ?
if ($geodata_superCage->post->keyExists('submit')) {

	//GeoSupport = showbutton
	if ($geodata_superCage->post->keyExists('showbutton') == TRUE  && $geodata_superCage->post->getInt('showbutton') != $CONFIG['plugin_geodata_showbutton']) {
    	$CONFIG['plugin_geodata_showbutton'] = $geodata_superCage->post->getInt('showbutton');
    	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_geodata_showbutton']}' WHERE name='plugin_geodata_showbutton'";
    	cpg_db_query($query);
	}

	//Use EnlargeIt	
	if ($geodata_superCage->post->keyExists('picenlargeit') == TRUE  && $geodata_superCage->post->getInt('picenlargeit') != $CONFIG['plugin_geodata_enlargeit']) {
		$CONFIG['plugin_geodata_enlargeit'] = $geodata_superCage->post->getInt('picenlargeit');
    	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_geodata_enlargeit']}' WHERE name='plugin_geodata_enlargeit'";
    	cpg_db_query($query);
	}

	msg_box($lang_plugin_geodata['display_name'], $lang_plugin_geodata['update_success']);
}//End of Update

//Load config plugin GEODATASET
require('./plugins/geodata/include/load_geodataset.php');
//Set option showbutton
switch ($GEODATASET['plugin_geodata_showbutton']) {
	case 1:
		$option_showbutton_1 = 'checked="checked"';
		$option_showbutton_2 = '';
		$option_showbutton_3 = '';
		break;
	case 2:
		$option_showbutton_1 = '';
		$option_showbutton_2 = 'checked="checked"';
		$option_showbutton_3 = '';
		break;
	case 3:
		$option_showbutton_1 = '';
		$option_showbutton_2 = '';
		$option_showbutton_3 = 'checked="checked"';
		break;
}

// Set option enlargeIt
switch ($GEODATASET['plugin_geodata_enlargeit']) {
	case 1:
		$option_enlargeit_1 = 'checked="checked"';
		$option_enlargeit_2 = '';
		break;
	default:
		$option_enlargeit_1 = '';
		$option_enlargeit_2 = 'checked="checked"';
		break;
}

//Display configuration
starttable('100%', $lang_plugin_geodata['main_title'].' - Version '.$lang_plugin_geodata['version']);
echo <<<EOT

<tr>
	<td>
	<form action="{$_SERVER['PHP_SELF']}" method="post" name="geodata_settings">
	<table class="maintable" cellspacing="1" cellpadding="0" width="100%" align="{$align}" id="section1" class="maintable cpg_zebra">
		<tr>
			<td width="50%">&nbsp;</td>
			<td width="50%">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" class="tableb tableb_alternate">{$lang_plugin_geodata['showbutton']}</td>
			<td align="left" class="tableb tableb_alternate">
				<input name="showbutton" type="radio" class="radio" value="1" {$option_showbutton_1}>{$lang_plugin_geodata['showbutton_1']}<br/>
				<input name="showbutton" type="radio" class="radio" value="2" {$option_showbutton_2}>{$lang_plugin_geodata['showbutton_2']}<br/>
				<input name="showbutton" type="radio" class="radio" value="3" {$option_showbutton_3}>{$lang_plugin_geodata['showbutton_3']}<br/>		
			</td>
		</tr>
		<tr></tr>
		<tr>
			<td align="right" class="tableb tableb_alternate">{$lang_plugin_geodata['enlargeit']}&nbsp;&nbsp;</td>
			<td align="left" class="tableb tableb_alternate">
			<input name="picenlargeit" type="radio" class="radio" value="1" {$option_enlargeit_1}>{$lang_plugin_geodata['yes']}&nbsp;
			<input name="picenlargeit" type="radio" class="radio" value="0" {$option_enlargeit_2}>{$lang_plugin_geodata['no']}
			</td>
		</tr>

		<tr>
			<td colspan="2" align="center" class="tablef"><input name="submit" class="button" type="submit" value="{$lang_plugin_geodata['submit_button']}"></td>
		</tr>
		
	</table>
	</form>
	</td>
</tr>

EOT;

endtable();
pagefooter();
ob_end_flush();
?>
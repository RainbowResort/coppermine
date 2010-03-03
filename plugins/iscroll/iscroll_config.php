<?php
/**
 * Coppermine Photo Gallery
 *
 * Copyright (c) 2003-2009 Coppermine Dev Team
 * v1.1 originally written by Gregory DEMAR
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Coppermine version: 1.4.26 
 *
 * isroll ver 2.1 
 * Based on mod. by rphMedia  http://forum.coppermine-gallery.net/index.php?action=profile;u=9702
 * Plugin Written by JR Carver - http://gallery.josephcarver.com/natural/ - http://i-imagine.net
 * 04 February 2010
*/

	define('IN_COPPERMINE', true);
	require('include/init.inc.php');
	pageheader('iscroll configuration');
	if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied']);
    global $CONFIG, $lang_admin_php, $lang_continue;
	
	   		$chk_radlast = '';
	   		$chk_radhit = '';
	   		$chk_radrate = '';
	   		$chk_radran = '';
			
	$show_met = ($CONFIG['iscroll_cfg_meta']);

	$show_wid = ($CONFIG['iscroll_cfg_width']);
	
	$show_hei = ($CONFIG['iscroll_cfg_height']);

	$show_num = ($CONFIG['iscroll_cfg_count']);	

			   if ($show_met  == '1') {
	   		$chk_radlast = 'selected="selected"';
	}
		   if ($show_met  == '2') {
	   		$chk_radhit = 'selected="selected"';
	}
		   if ($show_met  == '3') {
	   		$chk_radrate = 'selected="selected"';
	}
			if ($show_met  == '4') {
	   		$chk_radran = 'selected="selected"';
	}


   if (isset($_POST['update'])) {
		   
		   if ($_POST['iscr_meta']=='') {
	   		echo '<h1>error_meta</h1>';
			pagefooter();		
				return 1;
	}
		   
		   if ($_POST['iscr_width']=='') {
	   		echo '<h1>error_WIDTH</h1>';
			pagefooter();
				return 1;
	}
	
	   	   if ($_POST['iscr_height']=='') {
	   		echo '<h1>error_height</h1>';
			pagefooter();
				return 1;
	}
		   if ($_POST['iscr_count']=='') {
	   		echo '<h1>error_count</h1>';
			pagefooter();
				return 1;
	}
		
		
		//change values in the configuration table
		
		$iscr_meta = ($_POST['iscr_meta']);
		$iscr_width = ($_POST['iscr_width']);
		$iscr_height = ($_POST['iscr_height']);
		$iscr_count = ($_POST['iscr_count']);
		            
					
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$iscr_count' WHERE name = 'iscroll_cfg_count'");
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$iscr_meta' WHERE name = 'iscroll_cfg_meta'");	
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$iscr_width' WHERE name = 'iscroll_cfg_width'");
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$iscr_height' WHERE name = 'iscroll_cfg_height'");

		echo <<< EOT
<br />
<h2 align= "center"> Success!</h2>
<br />
EOT;
        msg_box($lang_admin_php['info'], $lang_admin_php['upd_success'], $lang_continue, 'index.php');
		pagefooter();
		exit;
	}
	
	starttable("100%");

		echo <<< EOT
<tr><td>
<form name="cpgform" id="cpgform" action="{$_SERVER['REQUEST_URI']}" method="post">
<table border="0" cellspacing="2" cellpadding="2" width= "95%">
			<tr>
			<td><br><b>Configure the settings of your iscroll plugin.</b></td>
			</tr>
			<tr>
			<td>  </td>
			</tr>
			<tr>
			<td> <hr> Select Meta album for thumbnails. Current setting is: ( $show_met ) </td>
			</tr> 
			<tr>
				<td align="right">			<select name="iscr_meta" id="iscr_meta">
                 <option value="1" $chk_radlast>Last uploads (1)</option>
                 <option value="2" $chk_radhit>Most viewed (2)</option>
                 <option value="3" $chk_radrate>Top rated (3)</option>
				 <option value="4" $chk_radran>Random Thumbs (4)</option>
            </select>
			</td>
			</tr>
			<tr>
			<td> <hr> Set size - default is 800x250 (for 17 thumbs) -  600x220 works for 5 thumbs</td>
			</tr> 
			<tr>		
			<td class="tableb" align="right">iscroll width:</td>
             <td>
             <input type="text" name="iscr_width" class="textinput" size="3" value="$show_wid" />
             </td>
             </tr>
             <tr>
              <td class="tableb" align="right">iscroll height:</td>
                <td>
                  <input type="text" name="iscr_height" class="textinput" size="3" value="$show_hei" />
                </td>
              </tr>
				<tr>
				<td><br></td></tr>
				              <tr>
			<td> <hr> Set image/thumb count - default is 24 - VERY LARGE VALUES MAY LOAD SLOW</td>
			</tr> 
			<tr>
			                <td class="tableb" align="right">
                  iscroll count:
                </td>
                <td class="tableb">
                  <input type="text" name="iscr_count" class="textinput" size="2" value="$show_num" />
                </td>
              </tr>	
			<tr>
			                <td class="tableb" align="right"><br></td>
              </tr>	
			<tr>
	       <td class="tableb" align="right">		
			<span>
			<input name="update" type="hidden" id="update" value="1" />
			<input type="submit" name="submit" value="Submit" /> 
		</span>
		<p>&nbsp;</p>
		</td>
		</tr>
EOT;
	
	  
	echo '</table>';		
	echo '</form>';	
	endtable();

	pagefooter();
	ob_end_flush();

?>
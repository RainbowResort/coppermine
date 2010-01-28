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
 * Coppermine version: 1.5.xx
 *
*/


	global $CONFIG, $flf_lang_var;
	//require('./plugins/flf_histotag/include/histotag_support.inc.php');
	pageheader('flf exif Configuration');
	
	if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
	
    global $lang_plugin_php, $CONFIG, $lang_common, $lang_pluginmgr_php, $lang_admin_php, $icon_array;

    $v_tab =$CONFIG['flf_histotag_tablename'];
    $v_mapw =$CONFIG['flf_histotag_mapwidth'];
    $v_maph =$CONFIG['flf_histotag_mapheight'];
    $v_lbw =$CONFIG['flf_histotag_lyteboxwidth'];
    $v_lbh =$CONFIG['flf_histotag_lyteboxheight'];
    $v_api =$CONFIG['flf_histotag_apikey'];
    $v_geo =$CONFIG['flf_histotag_show_geo_button'];
    $v_geo2 =$CONFIG['flf_histotag_show_geo_button_if_no_geotag']; 
    $v_histfeature=$CONFIG['flf_histogram_use_hist_feature']; 
    $v_histo=$CONFIG['flf_histogram_show_hist_button'];
    $v_histo2=$CONFIG['flf_histogram_show_hist_if_no_hist'];
    $v_histtype=$CONFIG['flf_histogram_type'];
    $v_histcol=$CONFIG['flf_histogram_color'];
    $v_histw=$CONFIG['flf_histogram_width'];
    $v_histlbw =$CONFIG['flf_histo_lyteboxwidth'];
    $v_histlbh =$CONFIG['flf_histo_lyteboxheight'];
    $v_histfly =$CONFIG['flf_histo_onthefly'];
    


    
		$sel_geo = '';	
		if ($v_geo  == '1') {
	   	$sel_geo = 'selected="selected"';
		}
		
		$sel_geob = '';	
		if ($v_geo  == '0') {
	   	$sel_geob = 'selected="selected"';
		}
		
		$sel_geo2 = '';	
		if ($v_geo2  == '1') {
	   	$sel_geo2 = 'selected="selected"';
		}
	   $sel_geo2b = '';	
		if ($v_geo2  == '0') {
	   	$sel_geo2b = 'selected="selected"';
		}
		
		
    	$sel_histofeature = '';	
		if ($v_histfeature  == '1') {
	   	$sel_histofeature = 'selected="selected"';
		}
		
		$sel_histofeatureb = '';	
		if ($v_histfeature  == '0') {
	   	$sel_histofeatureb = 'selected="selected"';
		}

				$sel_histofly = '';	
		if ($v_histfly  == '1') {
	   	$sel_histofly = 'selected="selected"';
		}
		
		$sel_histoflyb = '';	
		if ($v_histfly  == '0') {
	   	$sel_histoflyb = 'selected="selected"';
		}
    
	
	// Make form 
		$lb_superCage = Inspekt::makeSuperCage();
	
	starttable("85%");
	echo <<< EOT
	<tr><td>
	<form name="cpgform" id="cpgform" action="{$_SERVER['REQUEST_URI']}" method="post">
	<table border="0" cellspacing="2" cellpadding="2" width= "85%">
			<tr>
			<td><br /><b>{$flf_lang_var['configuretitle']}</b></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
			<td> 
			<hr> {$flf_lang_var['showgeobutton']}
			</td>
			<td>
			<br />
			<select name="geobutton" id="geobutton">
                 <option value="1" $sel_geo>{$flf_lang_var['showbutton']}</option>
                 <option value="0" $sel_geob>{$flf_lang_var['dontshowbutton']}</option>
            </select>
            

			</td>
			</tr>
			<tr>
			<td> 
			<hr> {$flf_lang_var['showgeobuttonifnodata']}
			</td>
			<td>
			<br />
			<select name="geobutton2" id="geobutton2">
                 <option value="1" $sel_geo2>{$flf_lang_var['showbutton']}</option>
                 <option value="0" $sel_geo2b>{$flf_lang_var['dontshowbutton']}</option>
            </select>
			</td>
			</tr>
			<tr>
			<td> 
			<hr> {$flf_lang_var['configmap']}<br /> 
			</td>
			</tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['mapwidth']}</td>
            <td>
            <input type="text" name="mapwidth" class="textinput" size="3" value="$v_mapw" />
            </td>
            </tr>
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['mapheight']}</td>
            <td>
            <input type="text" name="mapheight" class="textinput" size="3" value="$v_maph" />
            </td>
            </tr>
			<tr>			
			<td>
			<hr> {$flf_lang_var['configlytebox']}<br /> 
			</td>
			</tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['mapwidth']}</td>
            <td>
            <input type="text" name="lbwidth" class="textinput" size="3" value="$v_lbw" />
            </td>
            </tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['mapheight']}</td>
            <td>
            <input type="text" name="lbheight" class="textinput" size="3" value="$v_lbh" />
            </td>
            </tr>
			<tr>			
			<td>									
			<hr> {$flf_lang_var['settablename']}<br /> 
			</td>
			</tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['tablename']}</td>
            <td>
            <input type="text" name="tablename" class="textinput" size="25" value="$v_tab" />
            </td>
            </tr>
			<tr>			
			<td>
			<hr> {$flf_lang_var['setapi']}<br /> 
			</td>
			</tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['apikey']}</td>
            <td>
            <input type="text" name="apikey" class="textinput" size="100" value="$v_api" />
            </td>
            </tr>

    		<tr>
			<td> 
			<hr> {$flf_lang_var['usehistofeature']}
			</td>
			<td>
			<br />
			<select name="usehistofeature" id="usehistofeature">
                 <option value="1" $sel_histofeature>{$flf_lang_var['use']}</option>
                 <option value="0" $sel_histofeatureb>{$flf_lang_var['dontuse']}</option>
            </select>
            

			</td>
			</tr>
    
    
    
    
			<tr>
			<td> 
			<hr> {$flf_lang_var['showhistobutton']}
			</td>
			<td>
			<br />
			<select name="histobutton" id="histobutton">
                 <option value="1" $sel_histo>{$flf_lang_var['showbutton']}</option>
                 <option value="0" $sel_histob>{$flf_lang_var['dontshowbutton']}</option>
            </select>
            

			</td>
			</tr>
			<tr>
			<td> 
			<hr> {$flf_lang_var['showhistobuttonifnodata']}
			</td>
			<td>
			<br />
			<select name="histobutton2" id="histobutton2">
                 <option value="1" $sel_histo2>{$flf_lang_var['showbutton']}</option>
                 <option value="0" $sel_histo2b>{$flf_lang_var['dontshowbutton']}</option>
            </select>
			</td>
			</tr>
			<tr>
			<td> 
			<hr> {$flf_lang_var['histo_on_the_fly']}
			</td>
			<td>
			<br />
			<select name="histfly" id="histfly">
                 <option value="1" $sel_histofly>{$flf_lang_var['showbutton']}</option>
                 <option value="0" $sel_histoflyb>{$flf_lang_var['dontshowbutton']}</option>
            </select>
			</td>
			</tr>
            <tr>
            <td>
    		<hr> {$flf_lang_var['histtype']}<br /> 
			</td>
			</tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['type']}</td>
            <td>
            <input type="text" name="histtype" class="textinput" size="10" value="$v_histtype" />
            </td>
            </tr>
			<tr>
            <td>
        	<hr> {$flf_lang_var['histowidth']}<br /> 
			</td>
			</tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['mapwidth']}</td>
            <td>
            <input type="text" name="histw" class="textinput" size="10" value="$v_histw" />
            </td>
            </tr>
			<tr>
            <td>
        	<hr> {$flf_lang_var['histcol']}<br /> 
			</td>
			</tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['col']}</td>
            <td>
            <input type="text" name="histcol" class="textinput" size="10" value="$v_histcol" />
            </td>
            </tr>
            <tr>
            <td>   
    		<hr> {$flf_lang_var['configlytebox']}<br /> 
			</td>
			</tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['mapwidth']}</td>
            <td>
            <input type="text" name="histlbw" class="textinput" size="3" value="$v_histlbw" />
            </td>
            </tr> 
			<tr>		
			<td class="tableb" align="right">{$flf_lang_var['mapheight']}</td>
            <td>
            <input type="text" name="histlbh" class="textinput" size="3" value="$v_histlbh" />
            </td>
            </tr>
    
            
            
            
            
            
    
    
            
	       <td class="tableb" align="right"><br /><br />
			<span>
			<input name="update" type="hidden" id="update" value="1" />
			<input type="submit" name="submit" value="{$flf_lang_var['submit']}" /> 
		</span>
		</td>
		</tr>
		</td>		
		</table>
		</form>
EOT;
	
	
	//change values in the configuration table - minimal data filtering assumes admin use only
	if ($lb_superCage->post->keyExists('update')) {

  $v_tab = $lb_superCage->post->getEscaped('tablename');
  $v_mapw = $lb_superCage->post->getInt('mapwidth');
  $v_maph = $lb_superCage->post->getInt('mapheight');
  $v_lbw = $lb_superCage->post->getInt('lbwidth');
  $v_lbh = $lb_superCage->post->getInt('lbheight');
  $v_api = $lb_superCage->post->getEscaped('apikey');
  $v_geo = $lb_superCage->post->getInt('geobutton');
  $v_geo2 = $lb_superCage->post->getInt('geobutton2');  

  $v_histo = $lb_superCage->post->getInt('histobutton');
  $v_histo2 = $lb_superCage->post->getInt('histobutton2'); 
  $v_histofeature = $lb_superCage->post->getInt('usehistofeature');
    $v_histtype=$lb_superCage->post->getEscaped('histtype');
    $v_histcol=$lb_superCage->post->getEscaped('histcol');
    $v_histw=$lb_superCage->post->getInt('histw');
    $v_histlbw =$lb_superCage->post->getInt('histlbw');
    $v_histlbh =$lb_superCage->post->getInt('histlbh');
    $v_histfly=$lb_superCage->post->getInt('histfly');

	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_tab' WHERE name = 'flf_histotag_tablename'");
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_mapw' WHERE name = 'flf_histotag_mapwidth'");	
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_maph' WHERE name = 'flf_histotag_mapheight'");
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_lbw' WHERE name = 'flf_histotag_lyteboxwidth'");
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_lbh' WHERE name = 'flf_histotag_lyteboxheight'");
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_api' WHERE name = 'flf_histotag_apikey'");
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_geo' WHERE name = 'flf_histotag_show_geo_button'");
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_geo2' WHERE name = 'flf_histotag_show_geo_button_if_no_geotag'");		
		
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_histo' WHERE name = 'flf_histogram_show_hist_button'");
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_histo2' WHERE name = 'flf_histogram_show_hist_if_no_hist'");		
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_histofeature' WHERE name = 'flf_histogram_use_hist_feature'");		
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_histtype' WHERE name = 'flf_histogram_type'");
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_histcol' WHERE name = 'flf_histogram_color'");		
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_histw' WHERE name = 'flf_histogram_width'");
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_histlbw' WHERE name = 'flf_histo_lyteboxwidth'");		
	    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_histlbh' WHERE name = 'flf_histo_lyteboxheight'");		
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$v_histfly' WHERE name = 'flf_histo_onthefly'");		
	
        cpgRedirectPage('index.php?file=flf_histotag/flf_histotag_config', $lang_common['information'], 'flf histotag plugin settings saved successfully', 1);
		
        exit;
	}

	endtable();

	pagefooter();
	
	ob_end_flush();

?>
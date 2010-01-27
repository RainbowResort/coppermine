<?php
/**************************************************
  Coppermine 1.4.x Plugin - HighSlide v 3.04
  *************************************************
  Copyright (c) 2006-2008 Borzoo Mossavari and Timos-Welt
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Skip Intermediate Page and show full page on the page
  Based on Highslide JS @ http://vikjavev.no/highslide/ 
  ***************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add an install & configure & uninstall actions
$thisplugin->add_action('plugin_install','hs_install');
$thisplugin->add_action('plugin_configure','hs_configure');
$thisplugin->add_action('plugin_uninstall','hs_uninstall');
$thisplugin->add_action('plugin_cleanup','hs_cleanup');


// Add a configure action
$thisplugin->add_action('page_start','hs_temp');

// Add a filter for the page HTML
$thisplugin->add_filter('page_html','hs_main');
// Installation Function
function hs_install() 
{
	global $CONFIG, $thisplugin, $lang_plugin_highslide_install;
	require ('plugins/highslide/include/init.inc.php');
	if ($_POST['submit']==$lang_plugin_highslide_install['button_install']) {
		if(!isset($CONFIG['highslide_enable'])) {
			require 'include/sql_parse.php';
			$query="INSERT INTO ".$CONFIG['TABLE_CONFIG']." VALUES ('highslide_enable', '1');";
			cpg_db_query($query);

			// create table	
			$db_schema = $thisplugin->fullpath . '/schema.sql';
			$sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
			$sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

			$sql_query = remove_remarks($sql_query);
			$sql_query = split_sql_file($sql_query, ';');
		
			foreach($sql_query as $q) { 
				cpg_db_query($q);
			}
			// Put default setting
			$db_schema = $thisplugin->fullpath . '/basic.sql';
			$sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
			$sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

			$sql_query = remove_remarks($sql_query);
			$sql_query = split_sql_file($sql_query, ';');
		
			foreach($sql_query as $q) { 
				cpg_db_query($q);
			}
		}
		return true;
	} else {
		return 1;
	}
}

// Configure Plugin
function hs_configure() 
{
	global $CONFIG, $lang_plugin_highslide_install;
	require ('plugins/highslide/include/init.inc.php');

	echo <<< EOT
		<h2>{$lang_plugin_highslide_install['install_click']}</h2>
		{$lang_plugin_highslide_install['install_note']}<br />
		<br />
		<form action="{$_SERVER['REQUEST_URI']}" method="post">
		<input type="submit" value="{$lang_plugin_highslide_install['button_install']}" name="submit" />
		</form>
EOT;
}

// Uninstall
function hs_uninstall()
{
	global $CONFIG, $thisplugin;
	
	if (!isset($_POST['drop'])) return 1;
	
	if ($_POST['drop']) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_HIGHSLIDE_CONFIG']}");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='highslide_enable';");
   	}
	return true;
}

// Ask if admin wants to drop the table
function hs_cleanup($action) 
{
    global $lang_plugin_highslide_install;
    require ('plugins/highslide/include/init.inc.php');

    if ($action===1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            {$lang_plugin_highslide_install['cleanup_question']}
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="drop" value="1" /></td>
                <td>Yes</td>
            </tr>
            <tr>
                <td><input type="radio" name="drop" checked="checked" value="0" /></td>
                <td>No</td>
            </tr>
        </table>
        </div>
        <span>
           <input type="submit" name="submit" value="{$lang_plugin_highslide_install['button_submit']}" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="{$lang_plugin_highslide_install['button_cancel']}" />
        </span>
    </form>
EOT;
    }
}

// add config button
function hs_add_config_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;

  $new_template = $template_gallery_admin_menu;
  $button = template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}

//function to cahnge thumbnail template and load some setting at page start
function hs_temp() {
	global $CONFIG, $template_thumbnail_view, $lang_plugin_highslide, $lang_plugin_highslide_config, $lang_plugin_highslide_install, $HIGHSLIDESET, $lang_plugin_highslide_js;
	
	require ('plugins/highslide/include/init.inc.php');
	require ('plugins/highslide/include/init2.inc.php');

	$CONFIG['TABLE_HIGHSLIDE_CONFIG'] = $CONFIG['TABLE_PREFIX'].'highslide_config';

	if (GALLERY_ADMIN_MODE) {
		hs_add_config_button('index.php?file=highslide/plugin_config',$lang_plugin_highslide_config['config_title'],'',$lang_plugin_highslide_config['config_button']);
	}
if (($HIGHSLIDESET['admin_show'] == 1 && !GALLERY_ADMIN_MODE ) || ($HIGHSLIDESET['admin_show'] == 0)) {
	$template_thumbnail_view = <<<EOT

<!-- BEGIN header -->
        <tr>
<!-- END header -->
<!-- BEGIN thumb_cell -->
        <td valign="top" class="thumbnails" width ="{CELL_WIDTH}" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                                <td align="center">
                                        <!-- BEGIN hs_thumb_cell_init --><a href="{LINK_TGT}">{THUMB}<br /></a><!-- END hs_thumb_cell_init -->
                                        {CAPTION}
                                        {ADMIN_MENU}
                                </td>
                        </tr>
                </table>
        </td>
<!-- END thumb_cell -->
<!-- BEGIN empty_cell -->
                <td valign="top" class="thumbnails" align="center">&nbsp;</td>
<!-- END empty_cell -->
<!-- BEGIN row_separator -->
        </tr>
        <tr>
<!-- END row_separator -->
<!-- BEGIN footer -->
        </tr>
<!-- END footer -->
<!-- BEGIN tabs -->
        <tr>
                <td colspan="{THUMB_COLS}" style="padding: 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                       {TABS}
                                </tr>
                        </table>
                </td>
        </tr>
<!-- END tabs -->
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="7" border="" alt="" /><br />
<!-- END spacer -->

EOT;
}
}

// main function to modify page html
function hs_main($html,$HIGHSLIDESET) {
    global $thisplugin, $thumb_list, $HIGHSLIDESET, $lang_plugin_highslide, $lang_plugin_highslide_js;

$hsinit = '';
if (GALLERY_ADMIN_MODE) {
  $hsinit .= <<<EOS
  <script src="plugins/highslide/hs_colorselect.js" type="text/javascript"></script>
  <script language="JavaScript">
   <!--
    function hs_previewchange() {
	    var hs_selectedbutton = document.forms['hs_settings'].style_mode;
   	  var hs_selectedbuttonvalue = hs_selectedbutton.options[hs_selectedbutton.selectedIndex].value;
  	  document.images.hs_vorschau.src = "plugins/highslide/graphics/preview/" + hs_selectedbuttonvalue + ".jpg";
  	  if (hs_selectedbuttonvalue == 0) { document.forms['hs_settings'].thickness.value = 0; }
  	  if (hs_selectedbuttonvalue == 4) { document.forms['hs_settings'].thickness.value = 0; }
  	  if (hs_selectedbuttonvalue == 1) { document.forms['hs_settings'].border_color.value = "#FFFFFF"; }
			if (hs_selectedbuttonvalue == 5) { document.forms['hs_settings'].border_color.value = "#2A2B36"; }
			if (hs_selectedbuttonvalue == 6) { document.forms['hs_settings'].border_color.value = "#BFBFBF"; }
			if (hs_selectedbuttonvalue == 7) { document.forms['hs_settings'].border_color.value = "#808080"; }
			if (hs_selectedbuttonvalue == 8) { document.forms['hs_settings'].border_color.value = "#424242"; }
			if (hs_selectedbuttonvalue == 9) { document.forms['hs_settings'].border_color.value = "#000000"; }
			if (hs_selectedbuttonvalue == 10) { document.forms['hs_settings'].border_color.value = "#0000FF"; }
			if (hs_selectedbuttonvalue == 11) { document.forms['hs_settings'].border_color.value = "#000065"; }
			if (hs_selectedbuttonvalue == 12) { document.forms['hs_settings'].border_color.value = "#00FF00"; }
			if (hs_selectedbuttonvalue == 13) { document.forms['hs_settings'].border_color.value = "#005E00"; }
			if (hs_selectedbuttonvalue == 14) { document.forms['hs_settings'].border_color.value = "#FF0000"; }
			if (hs_selectedbuttonvalue == 15) { document.forms['hs_settings'].border_color.value = "#7B0000"; }
			if (hs_selectedbuttonvalue == 16) { document.forms['hs_settings'].border_color.value = "#FF9D00"; }
			if (hs_selectedbuttonvalue == 17) { document.forms['hs_settings'].border_color.value = "#00FFFF"; }
      }
  //-->
  </script>  

EOS;

  }

if (($HIGHSLIDESET[admin_show] && !GALLERY_ADMIN_MODE ) || (!$HIGHSLIDESET[admin_show])) {
	$hsinit .= <<<EOT
	<link rel="stylesheet" href="plugins/highslide/include/highslide.css" type="text/css" />
	<script type="text/javascript" src="scripts.js"></script>
	<script type="text/javascript" src="plugins/highslide/highslide.js"></script>
	<style type="text/css">
  .highslide-image {
EOT;
  
  $hsinit .='border: '.$HIGHSLIDESET['thickness'].'px solid '.$HIGHSLIDESET['border_color'].'; 
  ';
  $hsinit .='cursor: url(\'plugins/highslide/graphics/zoomout.cur\'), pointer; } 
  ';
  $hsinit .='.highslide { cursor: url(\'plugins/highslide/graphics/zoomin.cur\'), pointer; } 
  ';
  $hsinit .='.highslide_dtails { color: '.$HIGHSLIDESET['details_color'].'; } 
  ';
  $hsinit .='.highslide_dtails_over { color:'.$HIGHSLIDESET['detailsover_color'].'; } 
  ';
  $hsinit .='.highslide-caption { border: '.$HIGHSLIDESET['thickness'].'px solid '.$HIGHSLIDESET['border_color'].'; 
  ';
  $hsinit .='background-color: '.$HIGHSLIDESET['border_color'].'; } 
  ';
  $hsinit .='.highslide-loading { background-image: url(\'plugins/highslide/graphics/loader.gif\'); } 
  ';
  $hsinit .='.hscontrolbar { background: url(\'plugins/highslide/graphics/controlbar5.gif\'); width: 167px; height: 34px;	margin-top: 25px; margin-right: 25px; }
  ';
  $hsinit .='.hscontrolbar a:hover { background-image: url(\'plugins/highslide/graphics/controlbar5-hover.gif\'); }
  ';

  $hsinit .='</style> ';
	$hsinit .='<script type="text/javascript">    
	hs.graphicsDir = \'plugins/highslide/graphics/\';
	hs.loadingText = \''.$lang_plugin_highslide_js['loading_text'].'\';
	hs.loadingTitle = \''.$lang_plugin_highslide_js['loading_title'].'\';
	hs.restoreTitle = \''.$lang_plugin_highslide_js['restore_title'].'\';
	hs.expandSteps = '.$HIGHSLIDESET['expand_steps'].';
	hs.expandDuration = '.$HIGHSLIDESET['expand_duration'].';
	hs.restoreSteps = '.$HIGHSLIDESET['restore_steps'].';
  hs.restoreDuration = '.$HIGHSLIDESET['restore_duration'].';
  hs.captionSlideSpeed = '.$HIGHSLIDESET['caption_slide_speed'].';
  hs.allowMultipleInstances = '.$HIGHSLIDESET['allow_multi_inst'].';
	hs.fullExpandTitle = \''.$lang_plugin_highslide_js['fullexpand_title'].'\';
	// remove the registerOverlay call to disable the controlbar
	hs.registerOverlay( 
	  	{
    		thumbnailId: null,
    		overlayId: \'hscontrolbar\',
    		position: \'top right\',
    		hideOnMouseOut: true
		}
	);
	';
	switch($HIGHSLIDESET[style_mod]){
		case 0:
		$hsinit_b = ''; 
		break;
		case 1:
		$hsinit_b = 'hs.outlineType = \'rounded-white\';'; 
		break;
		case 2:
		$hsinit_b = ''; 
		break;
		case 3:
		$hsinit_b = 'hs.outlineType = \'outer-glow\';'; 
		break;
		case 4:
		$hsinit_b = 'hs.outlineType = null;';
		break; 
		case 5:
		$hsinit_b = 'hs.outlineType = \'beveled\';';
		break;
		case 6:
		$hsinit_b = 'hs.outlineType = \'rounded-lightgray\';';
		break;
		case 7:
		$hsinit_b = 'hs.outlineType = \'rounded-mediumgray\';';
		break; 
		case 8:
		$hsinit_b = 'hs.outlineType = \'rounded-darkgray\';';
		break; 
		case 9:
		$hsinit_b = 'hs.outlineType = \'rounded-black\';';
		break; 
		case 10:
		$hsinit_b = 'hs.outlineType = \'rounded-royalblue\';';
		break; 
		case 11:
		$hsinit_b = 'hs.outlineType = \'rounded-darkblue\';';
		break; 
		case 12:
		$hsinit_b = 'hs.outlineType = \'rounded-lightgreen\';';
		break; 
		case 13:
		$hsinit_b = 'hs.outlineType = \'rounded-darkgreen\';';
		break; 
		case 14:
		$hsinit_b = 'hs.outlineType = \'rounded-lightred\';';
		break; 
		case 15:
		$hsinit_b = 'hs.outlineType = \'rounded-darkred\';';
		break; 
		case 16:
		$hsinit_b = 'hs.outlineType = \'rounded-orange\';';
		break; 
		case 17:
		$hsinit_b = 'hs.outlineType = \'rounded-cyan\';';
		break; 
		default:
		$hsinit_b = 'hs.outlineType = \'rounded-white\';'; 
	}
 	$hsinit .= $hsinit_b.'
	</script>';
	$exper = '#(<\s*script\s*type\s*=\s*"text/javascript"\s*src\s*=\s*"scripts.js"\s*>\s*</script>)#i';
	$html = preg_replace($exper,$hsinit,$html);
	$exper = '#<body(.*)>#';
	preg_match($exper,$html,$bodies);
	$html = str_replace($bodies[0],'<body'.$bodies[1].'><div id="highslide-container"></div>',$html);
// Addition for control bar
  $html = str_replace('<div class="footer"','<div id="hscontrolbar" class="highslide-overlay hscontrolbar">
	<a href="#" class="previous" onclick="return hs.previous(this)" title="'.$lang_plugin_highslide['controlbarprev'].'"></a>
	<a href="#" class="next" onclick="return hs.next(this)" title="'.$lang_plugin_highslide['controlbarnext'].'"></a>
  <a href="#" class="highslide-move" onclick="return false" title="'.$lang_plugin_highslide['controlbarmove'].'"></a>
  <a href="#" class="close" onclick="return hs.close(this)" title="'.$lang_plugin_highslide['controlbarclose'].'"></a>
  </div><div class="footer"',$html);
  
	if($HIGHSLIDESET[index_only] == 0 && $HIGHSLIDESET[sef] == 0){// check if plugin apply to index only or to all pages
		$exper = '#<!-- BEGIN hs_thumb_cell_init -->\s*<a\s*href=\"(displayimage\.php\?.*)\">\s*<img\s*src=\"(.*?)thumb_(.*?)\"\s*.*\s*alt=\"(.*?)\"\s*title=\"(.*\n.*\n.*\n.*?)\"\s*/><br /></a><!-- END hs_thumb_cell_init -->#i'; 
	}else if ($HIGHSLIDESET[index_only] == 1 && $HIGHSLIDESET[sef] == 0){
		$exper = '#<!-- BEGIN hs_thumb_cell_init -->\s*<a\s*href=\"(displayimage\.php\?album=.+cat=.+pos=.+)\">\s*<img\s*src=\"(.*?)thumb_(.*?)\"\s*.*\s*alt=\"(.*?)\"\s*title=\"(.*\n.*\n.*\n.*?)\"\s*/><br /></a><!-- END hs_thumb_cell_init -->#i'; 
	
	}else if ($HIGHSLIDESET[index_only] == 0 && $HIGHSLIDESET[sef] == 1){
		$exper = '#<!-- BEGIN hs_thumb_cell_init -->\s*<a\s*href=\"(displayimage-.*-.*)\">\s*<img\s*src=\"(.*?)thumb_(.*?)\"\s*.*\s*alt=\"(.*?)\"\s*title=\"(.*\n.*\n.*\n.*?)\"\s*/><br /></a><!-- END hs_thumb_cell_init -->#i'; 
	} else {
		$exper = '#<!-- BEGIN hs_thumb_cell_init -->\s*<a\s*href=\"(displayimage-.*-.*-.*)\">\s*<img\s*src=\"(.*?)thumb_(.*?)\"\s*.*\s*alt=\"(.*?)\"\s*title=\"(.*\n.*\n.*\n.*?)\"\s*/><br /></a><!-- END hs_thumb_cell_init -->#i'; 
	}
	preg_match_all($exper, $html,$matches,PREG_SET_ORDER);
	$iCaptionCounter = 0;
	$hsbrowser = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';
	
	
	foreach($matches as $match) {
		$iCaptionCounter = $iCaptionCounter + 1;
		//File Type detection
		$hs_filetype = explode(".",$match[4]);
		if( $hs_filetype[1] == 'jpg' || $hs_filetype[1] == 'jpeg' || $hs_filetype[1] == 'jpe'|| $hs_filetype[1] == 'png'|| $hs_filetype[1] == 'gif'|| $hs_filetype[1] == 'bmp'|| $hs_filetype[1] == 'jpc' || $hs_filetype[1] == 'jp2' || $hs_filetype[1] == 'jpx' || $hs_filetype[1] == 'jb2'|| $hs_filetype[1] == 'swc' || $hs_filetype[1] == 'JPG' || $hs_filetype[1] == 'JPEG' || $hs_filetype[1] == 'JPE' || $hs_filetype[1] == 'PNG' || $hs_filetype[1] == 'GIF' || $hs_filetype[1] == 'BMP' || $hs_filetype[1] == 'JPC' || $hs_filetype[1] == 'JP2' || $hs_filetype[1] == 'JPX' || $hs_filetype[1] == 'SWC' ){
			
			
			$test_image=$match[2].'normal_'.$match[3];
			$test_wrong = array ("%28","%29","%C3%BC","%5B","%5D","%25","%23","%7E","%c2%A7","%21","%3D","%C2%B4");
			$test_right = array ('(',')','#','[',']','%','#','~','§','!','=','´');
			$test_image = str_replace($test_wrong, $test_right, $test_image);
			
			if($HIGHSLIDESET[full_image]==1){
				$rep_str = '<!-- BEGIN hs_thumb_cell --><a href="';
        if(($HIGHSLIDESET[slide_cnt]==1) && !(stristr($hsbrowser, "opera"))){
					$hsalbpath = substr($match[2],7);
				  $rep_str .= 'hscnt.php?a='.$hsalbpath.'&amp;n=0&amp;p='.$match[3]; }
				  else
				  { $rep_str .= $match[2].$match[3]; }
				$rep_str .= '" class="highslide" onclick="return hs.expand(this)"><img src="'.$match[2].'thumb_'.$match[3].'" class="image" id="highslide'.$iCaptionCounter.'" border="0" alt="'.$match[4].'" title="'.$match[5].'"/><br /></a>';
			}else if(my_is_file($test_image) || $HIGHSLIDESET[full_image] == 2 ) {
				$rep_str = '<!-- BEGIN hs_thumb_cell --><a href="';
         if(($HIGHSLIDESET[slide_cnt]==1) && !(stristr($hsbrowser, "opera"))){
				  $hsalbpath = substr($match[2],7);
				  $rep_str .= 'hscnt.php?a='.$hsalbpath.'&amp;n=1&amp;p='.$match[3]; }
				  else
				  { $rep_str .= $match[2].'normal_'.$match[3]; }
				$rep_str .= '" class="highslide" onclick="return hs.expand(this)"><img src="'.$match[2].'thumb_'.$match[3].'" class="image" id="highslide'.$iCaptionCounter.'" border="0" alt="'.$match[4].'" title="'.$match[5].'"/><br /></a>';
			}else {
				$rep_str = '<!-- BEGIN hs_thumb_cell --><a href="';
				if(($HIGHSLIDESET[slide_cnt]==1) && !(stristr($hsbrowser, "opera"))){
					$hsalbpath = substr($match[2],7);
				  $rep_str .= 'hscnt.php?a='.$hsalbpath.'&amp;n=0&amp;p='.$match[3]; }
				  else
				  { $rep_str .= $match[2].$match[3]; }
				$rep_str .= '" class="highslide" onclick="return hs.expand(this)"><img src="'.$match[2].'thumb_'.$match[3].'" class="image" id="highslide'.$iCaptionCounter.'" border="0" alt="'.$match[4].'" title="'.$match[5].'"/><br /></a>';
			}
			if($HIGHSLIDESET[detail] || $HIGHSLIDESET[close] || $HIGHSLIDESET[title]){
				if(($HIGHSLIDESET[title] && $HIGHSLIDESET[close]) || ($HIGHSLIDESET[title] && $HIGHSLIDESET[detail]))// add caption
					$rep_str.='<div class="highslide-caption" id="caption-for-highslide'.$iCaptionCounter.'" >';
				else
					$rep_str.='<div class="highslide-caption" style="height:35px;" id="caption-for-highslide'.$iCaptionCounter.'" >';
			}
			if($HIGHSLIDESET[detail]){ // add link to intermadiate
					$rep_str.='<div onclick="location.href=\''.$match[1].'\'" class="highslide_dtails"  style="float:left;" onmouseover="this.className=\'highslide_dtails_over\'"  onmouseout="this.className=\'highslide_dtails\'" >'.$lang_plugin_highslide['detail'].'</div>';
			}
			if($HIGHSLIDESET[close]){ // add link to close
					$rep_str.='<div onclick="hs.closeId(\'highslide'.$iCaptionCounter.'\')" align="right" class="highslide_dtails" style="float:right;"  onmouseover="this.className=\'highslide_dtails_over\'" onmouseout="this.className=\'highslide_dtails\'" >'.$lang_plugin_highslide['close'].'</div>';
			}
			if($HIGHSLIDESET[title]){ // add title to caption
			$rep_str .= '<div align="center" class="thumb_caption" >'.$match[5].'</div>';
			}
			if($HIGHSLIDESET[detail] || $HIGHSLIDESET[close] || $HIGHSLIDESET[title]){
				$rep_str.='<div style="clear:both"></div></div>';
			}
			$rep_str.='<!-- END hs_thumb_cell -->';
			$html = str_replace($match[0],$rep_str,$html);
	 	}
 	 }
	}
	return $html;
}
// cheking for file (Intermadiate) availablity
function my_is_file($file)
{
  
	  if(is_file($file))
		return true;
	else
		return false;
}
?>
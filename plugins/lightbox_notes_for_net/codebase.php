<?php
/*******************************************************
  Coppermine 1.5.x Plugin - LightBox (NotesFor.net)
  ******************************************************
  Copyright (c) 2009-2010 Joe Carver and Helori Lamberty
  ******************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *****************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add plugin_install action
$thisplugin->add_action('plugin_install','lightbox_install');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','lightbox_uninstall');


// Add a filter for the gallery header
$thisplugin->add_filter('page_meta','lightbox_header');

// Add a filter for the image pop-up
$thisplugin->add_filter('file_data','lightbox_theme_html_picture');

// Function to modify the gallery header
// config to set values for var settings 
function lightbox_header($html) {
	global $template_header, $CONFIG, $CPG_PHP_SELF, $LINEBREAK;
	if (($CPG_PHP_SELF == 'displayimage.php') && ($CPG_PHP_SELF !=='index.php')) {

		$lb_bor  = $CONFIG['plugin_lightbox_nfn_border'];	
		$lb_tim  = $CONFIG['plugin_lightbox_nfn_slidetimer'];
		$lb_spd  = $CONFIG['plugin_lightbox_nfn_sizespeed'];
		$lb_not  = $CONFIG['plugin_lightbox_nfn_notimer'];			
		$lb_ext  = $CONFIG['plugin_lightbox_nfn_image_exit'];
		$lb_pad  = ($lb_bor .'px');
			
		$met_lb = <<< EOT
 $LINEBREAK
<!--LightBox head start-->
<link rel="stylesheet" href="plugins/lightbox_notes_for_net/style.css" type="text/css" media="screen" /> 
<script type="text/javascript" src="plugins/lightbox_notes_for_net/script.js"></script> 
<script type="text/javascript">
$(function() {var settings = { 
containerBorderSize: $lb_bor,
slideShowTimer: $lb_tim,
containerResizeSpeed: $lb_spd,
noshowTimer: $lb_not,
image_exit: $lb_ext,
}, settings;
$('a.lightbox').lightBox(settings);
});
</script>
			
<style type="text/css">
#lightbox-container-image
{
	height: 100%;
	padding: $lb_pad;
}
    </style>
<!--LightBox head end-->
 $LINEBREAK
EOT;

    $template_header = str_replace('</head>', $met_lb .'</head>', $template_header);
	}
	}

// Changes HTML for theme_html_picture() in themes.inc.php

function lightbox_theme_html_picture($SlideShowhtml)
{
	global $slideshow_pic_html, $mime_content, $CURRENT_PIC_DATA;
	$mime_content = cpg_get_type($SlideShowhtml['filename']);
	if ($mime_content['content']=='image') {
        if (preg_match('/^youtube_(.*)\.jpg$/', $CURRENT_PIC_DATA['filename'], $ytmatches)){
    		$vid = $ytmatches[1];
      		$slideshow_pic_html = '<object width="560" height="350"><param name="movie" value="http://www.youtube.com/v/'. $vid . '"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'. $vid . '" type="application/x-shockwave-flash" wmode="transparent" width="560" height="350"></embed></object><br />';
                $SlideShowhtml['html'] = $slideshow_pic_html;
    	} elseif (isset($image_size['reduced'])) {
			$slideshow_pic_html = lightbox_list($SlideShowhtml);
			$SlideShowhtml['html'] = $slideshow_pic_html;
        } else {
		$slideshow_pic_html = lightbox_list($SlideShowhtml);
		$SlideShowhtml['html'] = $slideshow_pic_html;
		return $SlideShowhtml;
}	
}		
}  

	#################################################
	 //Second part of lightbox update

function lightbox_list($picId) {

    global $lang_display_image_php, $CONFIG;
	
	// Set max size/count of picture list plugin_lightbox_nfn_maxpics
		$lb_max  = $CONFIG['plugin_lightbox_nfn_maxpics'];
		if ($lb_max <= 1) {
		$max = -1;
		}		
		else {
		$max = $lb_max;
		}

		$picList = '';
		
	$i = 0;
	$pid = $picId['pid'];
		
	$superCage = Inspekt::makeSuperCage();
	$lb_alb=$superCage->get->getRaw('album');
	$lb_ran=$superCage->get->getRaw('random');

	
	$aid = (empty($lb_alb) || $lb_ran || 
	$superCage->get->getRaw('lastup')) ? $picId['aid'] : $lb_alb;
	

	$pic_data = get_pic_data($aid, $pic_count, $album_name, -1, -1, false);
	$imax = 0;			//counter
	$max = $max/2;
	foreach ($pic_data as $picture){
		if ($picture['pid'] == $pid) {
		//the number of the picture in  order
		$picnumber = $imax;
		}
	$imax++;
	}	

	//Check beginning and ending of album
	if(! ($max == ((-1)/2))){
		if ($imax > $max){
			if ($picnumber < $max || $picnumber == 0){
				$down = 0;
				$up = 0 + ($max*2);
			}elseif (($picnumber + $max) > $imax){
				$down = $imax - ($max*2);
				$up = $imax;
			}else{
				$down = $picnumber - $max;
				$up = $picnumber + $max;
			}
		}else{
			$down = 0;
			$up = $imax;
		}
	}else{
			$down = 0;
			$up = $imax;
	}
	$pic_already_shown = false; //fix to remove duplicate entries
	foreach ($pic_data as $picture) {
		if ($i >= $down && $i <= $up){
			if($CONFIG['thumb_use']=='ht' && $picture['pheight'] > $CONFIG['picture_width'] ){
			  $condition = true;
			}elseif($CONFIG['thumb_use']=='wd' && $picture['pwidth'] > $CONFIG['picture_width']){
			  $condition = true;
			}elseif($CONFIG['thumb_use']=='any' && max($picture['pwidth'], $picture['pheight']) > $CONFIG['picture_width']){
			  $condition = true;
			}else{
			$condition = false;
			}
			$picture_page = "./displayimage.php?album=".$picture['aid']."&pos=-".$picture['pid'];
			if (is_image($picture['filename'])) {
			$superCage = Inspekt::makeSuperCage();
				if ($CONFIG['make_intermediate'] && $condition ) {
					$picture_url = get_pic_url($picture, 'normal');
				} else {
					$picture_url = get_pic_url($picture, 'fullsize');
				}
				$picture_url_fullsize = get_pic_url($picture, 'fullsize');
				// add config here
				$pic_title = ($picture['title'] ? $picture['title'] : strtr(preg_replace("/(.+)\..*?\Z/", "\\1", htmlspecialchars($picture['filename'])), "_", " "));
				
				// 	variable set caption plugin_lightbox_nfn_caption	
				$pic_caption = '';
				$show_caption = $CONFIG['plugin_lightbox_nfn_caption'];
				if ($show_caption == 1) {
				$pic_caption = ($picture['caption'] ? $picture['caption'] : strtr(preg_replace("/(.+)\..*?\Z/", "\\1", htmlspecialchars($picture['caption'])), "_", " "));
				}
				
				// variable for rel = nofollow  plugin_lightbox_nfn_nofollow
				$follow_not  = '';
				$follow_me = $CONFIG['plugin_lightbox_nfn_nofollow'];
				if ($follow_me == 1) {
				$follow_not  = 'nofollow';
				}				
				
				if ($picture['pid'] == $pid && !$pic_already_shown ) {
					$picList .= "<a href=\"$picture_url_fullsize\" picpage=\"$picture_page\" class =\"lightbox\" pid=\"$picture[pid]\" title=\"$pic_title\" caption=\"$pic_caption\">";
					$picList .= "<img src=\"$picture_url\" class=\"image\" border=\"0\" alt=\"$lang_display_image_php[view_fs]\" /><br />";
					$picList .= "</a>\n";
					$pic_already_shown = true; //fix to remove duplicate entries
				}else{
					$picList .= "<a href=\"$picture_url_fullsize\" picpage=\"$picture_page\" class =\"lightbox\" pid=\"$picture[pid]\" title=\"$pic_title\" caption=\"$pic_caption\" rel=\"$follow_not\"></a>\n";
			}
			}
		}
	$i++;
	}
	return $picList;
}
//End of second part

	// Install the plugin

	function lightbox_install() {
		global $CONFIG, $thisplugin;
		
		cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_lightbox_nfn_border', '8')");
		cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_lightbox_nfn_slidetimer', '6000')");
		cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_lightbox_nfn_sizespeed', '820')");
		cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_lightbox_nfn_notimer', '1')");
		cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_lightbox_nfn_image_exit', '1')");
		cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_lightbox_nfn_caption', '1')");
		cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_lightbox_nfn_nofollow', '1')");
		cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_lightbox_nfn_maxpics', '1')");
		return true;		
	}

	// Uninstall the plugin

	function lightbox_uninstall() {
		global $CONFIG, $thisplugin;
		//remove the records from config
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_lightbox_nfn_border'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_lightbox_nfn_slidetimer'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_lightbox_nfn_sizespeed'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_lightbox_nfn_notimer'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_lightbox_nfn_image_exit'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_lightbox_nfn_caption'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_lightbox_nfn_nofollow'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_lightbox_nfn_maxpics'");
		return true;		
	}

?>
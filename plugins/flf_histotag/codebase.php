<?php
/**
 * flf exif support
 *
 * Plugin Written by Florian Lechner - http://www.lounge-lizard.org
 * 16 January 2010
*/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

global $CONFIG, $flf_lang_var;
require('./plugins/flf_histotag/include/histotag_support.inc.php');

$thisplugin->add_filter('add_file_data_success','generate_exif_entry');
$thisplugin->add_filter('after_delete_file','delete_exif_entry');
$thisplugin->add_filter('file_data','include_lytebox');
// TODO: check if differentitation between 2 button modes is possible
if ($CONFIG['flf_histotag_show_geo_button']=='1'){
	$thisplugin->add_filter('theme_img_navbar','geo_button');
}
$thisplugin->add_action('plugin_install','flf_histotag_install');
$thisplugin->add_action('plugin_uninstall','flf_histotag_uninstall');
function flf_histotag_install($data){
	
	require('./plugins/flf_histotag/include/install.inc.php');
	$tablename="flf_histotag"; 	// TODO: Give User Choice to name table himself!

	$retval = flf_create_table($tablename);
	if ($retval) {
		$retval=flf_enter_base_config();
		
	}
	if ($retval) {
		$retval=flf_create_directory();
	}
	
	
	return $retval;

}

function flf_histotag_uninstall($data){
		require('./plugins/flf_histotag/include/install.inc.php');
		global $CONFIG, $thisplugin;
		$tablename=$CONFIG['flf_histotag_tablename']; 
		// TODO: Security check -- really delete table?
		$retval=flf_delete_table($tablename);
		if ($retval) {
			$retval=flf_delete_base_config();	
		}
   
	    return $retval;
}



//TODO: Find a better place to include the lytebox!



function include_lytebox($org) {

	$lytebox_include= <<<EOT
<script type="text/javascript" language="javascript" src="plugins/flf_histotag/include/lytebox/lytebox.js"></script>
<link rel="stylesheet" href="plugins/flf_histotag/include/lytebox/lytebox.css" type="text/css" media="screen" />
EOT;
	print $lytebox_include;
	return $org;

}

function geo_button($template_img_navbar) {
    global $CONFIG;
	$result = renderGeoButton($template_img_navbar);
	if ($CONFIG['flf_histogram_use_hist_feature']=='1') 
      {
    	 require('./plugins/flf_histotag/include/histogram_support.inc.php');
		 $result=renderHistoButton($result);
      }    
	
	return $result;
	
}

function generateLinkToGoogleMap($html)
{
	$org=$html;
	global $CURRENT_PIC_DATA;
	return GenerateLinkToMap($CURRENT_PIC_DATA['pid']);
}



function generate_exif_entry($html) {
   

   global $CONFIG;
   
   extractExifsAndImport($html);
   
   if ($CONFIG['flf_histogram_use_hist_feature']=='1') 
   {
    // load the functions	
   	require('./plugins/flf_histotag/include/histogram_support.inc.php');
    // create the histogram
    makeHistogram('albums/'.$html['filepath'],$html['filename'], $html['pid']);
    
   }

   return $html;
}
function delete_exif_entry($html) {
	deleteExifData($html);
   if ($CONFIG['flf_histogram_use_hist_feature']=='1') 
   {
    // load the functions	
   	require('./plugins/flf_histotag/include/histogram_support.inc.php');
    // delete the histogram
    deletehistogram('albums/'.$html['filepath'],$html['filename'], $html['pid']);
    
   }
	return $html;
}
?>
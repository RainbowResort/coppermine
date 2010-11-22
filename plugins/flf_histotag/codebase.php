<?php
/**
 * flf exif support
 *
 * Plugin Written by Florian Lechner - http://www.lounge-lizard.org
 * 16 January 2010
*/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

global $CONFIG, $flf_lang_var;
require_once('./plugins/flf_histotag/include/histotag_support.php');

$thisplugin->add_action('add_file_data_success','generate_exif_entry');
$thisplugin->add_action('after_delete_file','delete_exif_entry');
$thisplugin->add_action('plugin_configure','flf_histotag_configure');
// TODO: check if differentitation between 2 button modes is possible
/*if ($CONFIG['plugin_flf_histotag_showgeo']=='1'){
    $thisplugin->add_filter('theme_img_navbar','geo_button');
}
*/
    $thisplugin->add_filter('theme_img_navbar','navbuttoncheck');


$thisplugin->add_action('plugin_install','flf_histotag_install');
$thisplugin->add_action('plugin_uninstall','flf_histotag_uninstall');
function flf_histotag_install($data){
    
    require_once('./plugins/flf_histotag/include/histotag_install.php');

    $retval = flf_create_table();
    if ($retval) {
        $retval=flf_enter_base_config();
        
    }

    return $retval;

}

function flf_histotag_uninstall($data){
        require_once('./plugins/flf_histotag/include/histotag_install.php');
        global $CONFIG, $thisplugin;
        $tablename=$CONFIG['TABLE_PREFIX'].'plugin_flf_histotag'; 
        // TODO: Security check -- really delete table?
        $retval=flf_delete_table($tablename);
        if ($retval) {
            $retval=flf_delete_base_config();	
        }
   
        return $retval;
}

function navbuttoncheck ($template_img_navbar) {
    global $CONFIG;
    $result=$template_img_navbar;
    if ($CONFIG['plugin_flf_histotag_geosupport']=='1' || $CONFIG['plugin_flf_histotag_geosupport']=='2' ){
        $result=geo_button($result);
    }
    
    if ($CONFIG['plugin_flf_histotag_histosupport']=='1' || $CONFIG['plugin_flf_histotag_histosupport']=='2' || $CONFIG['plugin_flf_histotag_histosupport']=='3'){
        $result=hist_button($result);
    }
    return $result;

}




function hist_button ($template_img_navbar) {
         require_once('./plugins/flf_histotag/include/histotag_histogram_support.php');
         $result=renderHistoButton($template_img_navbar);	
        return $result;
}





function geo_button($template_img_navbar) {
    global $CONFIG;
    $result = renderGeoButton($template_img_navbar);

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
   
   if ($CONFIG['plugin_flf_histotag_createonupload']=='1') 
   {
    // load the functions	
    require_once('./plugins/flf_histotag/include/histotag_histogram_support.php');
    // create the histogram
    makeHistogram('albums/'.$html['filepath'],$html['filename'], $html['pid']);
    
   }
}
function delete_exif_entry($html) {
    global $CONFIG;
    deleteExifData($html);
    require_once('./plugins/flf_histotag/include/histotag_histogram_support.php');
    // delete the histogram
    deletehistogram('albums/'.$html['filepath'],$html['filename'], $html['pid']);    
}

function flf_histotag_configure() {
    global $CONFIG, $thisplugin, $lang_common, $thumb_rotate_icon_array, $lang_errors, $flf_lang_var, $imagerotate_exist;
    $superCage = Inspekt::makeSuperCage();
    if (!GALLERY_ADMIN_MODE) {
        cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
    }

    // Populate the form fields and run the queries for the submit form
    $config_changes_counter = 0;
    $dump_cache = 0;
    
    // plugin_flf_histotag_histoquality
    if ($superCage->post->keyExists('plugin_flf_histotag_histoquality') == TRUE) {
        if ($superCage->post->getInt('plugin_flf_histotag_histoquality') >= 0 && $superCage->post->getInt('plugin_flf_histotag_histoquality') <= 100 && $CONFIG['plugin_flf_histotag_histoquality'] != $superCage->post->getInt('plugin_flf_histotag_histoquality')) {
            $CONFIG['plugin_flf_histotag_histoquality'] = $superCage->post->getInt('plugin_flf_histotag_histoquality');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_histoquality']}' WHERE name='plugin_flf_histotag_histoquality'";
            cpg_db_query($query);
            $config_changes_counter++;
            $dump_cache++;
        }
    }
   
    // bgcolor
    if ($superCage->post->keyExists('plugin_flf_histotag_histocolor') == TRUE) {
        $temp = $superCage->post->getRaw('plugin_flf_histotag_histocolor'); // Usually, we would not use that method, but we'll sanitize later.
        $temp = '#' . strtoupper(ltrim($temp, '#'));
        if (preg_match('/^#(?:(?:[a-f\d]{3}){1,2})$/i', $temp)) {
            if ($CONFIG['plugin_flf_histotag_histocolor'] != $temp) {
                $CONFIG['plugin_flf_histotag_histocolor'] = $temp;
                $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_histocolor']}' WHERE name='plugin_flf_histotag_histocolor'";
                cpg_db_query($query);
                $config_changes_counter++;
                $dump_cache++;
            }
        }
    }
    
    // Map Width
    if ($superCage->post->keyExists('plugin_flf_histotag_mapwidth') == TRUE) {
        if ($superCage->post->getInt('plugin_flf_histotag_mapwidth') >= 0 && $superCage->post->getInt('plugin_flf_histotag_mapwidth') <= 1280 && $CONFIG['plugin_flf_histotag_mapwidth'] != $superCage->post->getInt('plugin_flf_histotag_mapwidth')) {
            $CONFIG['plugin_flf_histotag_mapwidth'] = $superCage->post->getInt('plugin_flf_histotag_mapwidth');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_mapwidth']}' WHERE name='plugin_flf_histotag_mapwidth'";
            cpg_db_query($query);
            $config_changes_counter++;
            $dump_cache++;
        }
    }
     // Map Height
    if ($superCage->post->keyExists('plugin_flf_histotag_mapheight') == TRUE) {
        if ($superCage->post->getInt('plugin_flf_histotag_mapheight') >= 0 && $superCage->post->getInt('plugin_flf_histotag_mapheight') <= 1024 && $CONFIG['plugin_flf_histotag_mapheight'] != $superCage->post->getInt('plugin_flf_histotag_mapheight')) {
            $CONFIG['plugin_flf_histotag_mapheight'] = $superCage->post->getInt('plugin_flf_histotag_mapheight');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_mapheight']}' WHERE name='plugin_flf_histotag_mapheight'";
            cpg_db_query($query);
            $config_changes_counter++;
            $dump_cache++;
        }
    }

    // Map Box Width
    if ($superCage->post->keyExists('plugin_flf_histotag_mapboxwidth') == TRUE) {
        if ($superCage->post->getInt('plugin_flf_histotag_mapboxwidth') >= 0 && $superCage->post->getInt('plugin_flf_histotag_mapboxwidth') <= 1280 && $CONFIG['plugin_flf_histotag_mapboxwidth'] != $superCage->post->getInt('plugin_flf_histotag_mapboxwidth')) {
            $CONFIG['plugin_flf_histotag_mapboxwidth'] = $superCage->post->getInt('plugin_flf_histotag_mapboxwidth');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_mapboxwidth']}' WHERE name='plugin_flf_histotag_mapboxwidth'";
            cpg_db_query($query);
            $config_changes_counter++;
            $dump_cache++;
        }
    }
     // Map Height
    if ($superCage->post->keyExists('plugin_flf_histotag_mapboxheight') == TRUE) {
        if ($superCage->post->getInt('plugin_flf_histotag_mapboxheight') >= 0 && $superCage->post->getInt('plugin_flf_histotag_mapboxheight') <= 1024 && $CONFIG['plugin_flf_histotag_mapboxheight'] != $superCage->post->getInt('plugin_flf_histotag_mapboxheight')) {
            $CONFIG['plugin_flf_histotag_mapboxheight'] = $superCage->post->getInt('plugin_flf_histotag_mapboxheight');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_mapboxheight']}' WHERE name='plugin_flf_histotag_mapboxheight'";
            cpg_db_query($query);
            $config_changes_counter++;
            $dump_cache++;
        }
    }
           
      // API key
    if ($superCage->post->keyExists('plugin_flf_histotag_apikey') == TRUE) {
        $temp=$superCage->post->getRaw('plugin_flf_histotag_apikey');
            if ($CONFIG['plugin_flf_histotag_apikey'] != $temp) {
                 $CONFIG['plugin_flf_histotag_apikey'] = $temp;         		 
                $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_apikey']}' WHERE name='plugin_flf_histotag_apikey'";
                cpg_db_query($query);
            $config_changes_counter++;
            $dump_cache++;
        }
    }
               

    if ($superCage->post->keyExists('plugin_flf_histotag_mapmode') == TRUE  && $superCage->post->getInt('plugin_flf_histotag_mapmode') != $CONFIG['plugin_flf_histotag_mapmode']) {
        $CONFIG['plugin_flf_histotag_mapmode'] = $superCage->post->getInt('plugin_flf_histotag_mapmode');
        $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_mapmode']}' WHERE name='plugin_flf_histotag_mapmode'";
        cpg_db_query($query);
        $config_changes_counter++;
        $dump_cache++;
    }
    
    switch ($CONFIG['plugin_flf_histotag_mapmode']) {
        case 1:
            $option_output['plugin_flf_histotag_mapmode_2'] = '';
            $option_output['plugin_flf_histotag_mapmode_3'] = '';
            $option_output['plugin_flf_histotag_mapmode_4'] = '';
            $option_output['plugin_flf_histotag_mapmode_5'] = '';
            $option_output['plugin_flf_histotag_mapmode_1'] = 'checked="checked"';
            break;
        case 2:
            $option_output['plugin_flf_histotag_mapmode_1'] = '';
            $option_output['plugin_flf_histotag_mapmode_3'] = '';
            $option_output['plugin_flf_histotag_mapmode_4'] = '';
            $option_output['plugin_flf_histotag_mapmode_5'] = '';
            $option_output['plugin_flf_histotag_mapmode_2'] = 'checked="checked"';
            break;
        case 3:
            $option_output['plugin_flf_histotag_mapmode_2'] = '';
            $option_output['plugin_flf_histotag_mapmode_1'] = '';
            $option_output['plugin_flf_histotag_mapmode_4'] = '';
            $option_output['plugin_flf_histotag_mapmode_5'] = '';
            $option_output['plugin_flf_histotag_mapmode_3'] = 'checked="checked"';
            break;
        case 4:
            $option_output['plugin_flf_histotag_mapmode_2'] = '';
            $option_output['plugin_flf_histotag_mapmode_3'] = '';
            $option_output['plugin_flf_histotag_mapmode_1'] = '';
            $option_output['plugin_flf_histotag_mapmode_5'] = '';
            $option_output['plugin_flf_histotag_mapmode_4'] = 'checked="checked"';
            break;
        case 5:
            $option_output['plugin_flf_histotag_mapmode_2'] = '';
            $option_output['plugin_flf_histotag_mapmode_3'] = '';
            $option_output['plugin_flf_histotag_mapmode_4'] = '';
            $option_output['plugin_flf_histotag_mapmode_1'] = '';
            $option_output['plugin_flf_histotag_mapmode_5'] = 'checked="checked"';
            break;        
            
            default:
            $option_output['plugin_flf_histotag_mapmode_2'] = '';
            $option_output['plugin_flf_histotag_mapmode_3'] = '';
            $option_output['plugin_flf_histotag_mapmode_4'] = '';
            $option_output['plugin_flf_histotag_mapmode_5'] = '';
            $option_output['plugin_flf_histotag_mapmode_1'] = 'checked="checked"';
    }   
        
        
     if ($superCage->post->keyExists('plugin_flf_histotag_geosupport') == TRUE  && $superCage->post->getInt('plugin_flf_histotag_geosupport') != $CONFIG['plugin_flf_histotag_geosupport']) {
        $CONFIG['plugin_flf_histotag_geosupport'] = $superCage->post->getInt('plugin_flf_histotag_geosupport');
        $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_geosupport']}' WHERE name='plugin_flf_histotag_geosupport'";
        cpg_db_query($query);
        $config_changes_counter++;
        $dump_cache++;
    }
    
    switch ($CONFIG['plugin_flf_histotag_geosupport']) {
        case 1:
            $option_output['plugin_flf_histotag_geosupport_2'] = '';
            $option_output['plugin_flf_histotag_geosupport_3'] = '';
            $option_output['plugin_flf_histotag_geosupport_1'] = 'checked="checked"';
            break;
        case 2:
            $option_output['plugin_flf_histotag_geosupport_1'] = '';
            $option_output['plugin_flf_histotag_geosupport_3'] = '';
            $option_output['plugin_flf_histotag_geosupport_2'] = 'checked="checked"';
            break;
        case 3:
            $option_output['plugin_flf_histotag_geosupport_2'] = '';
            $option_output['plugin_flf_histotag_geosupport_1'] = '';
            $option_output['plugin_flf_histotag_geosupport_3'] = 'checked="checked"';
            break;
            
            
         default:
            $option_output['plugin_flf_histotag_geosupport_2'] = '';
            $option_output['plugin_flf_histotag_geosupport_3'] = '';
            $option_output['plugin_flf_histotag_geosupport_1'] = 'checked="checked"';
            break;
    }   

     if ($superCage->post->keyExists('plugin_flf_histotag_imagesource') == TRUE  && $superCage->post->getInt('plugin_flf_histotag_imagesource') != $CONFIG['plugin_flf_histotag_imagesource']) {
        $CONFIG['plugin_flf_histotag_imagesource'] = $superCage->post->getInt('plugin_flf_histotag_imagesource');
        $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_imagesource']}' WHERE name='plugin_flf_histotag_imagesource'";
        cpg_db_query($query);
        $config_changes_counter++;
        $dump_cache++;
    }
    
    switch ($CONFIG['plugin_flf_histotag_imagesource']) {
        case 1:
            $option_output['plugin_flf_histotag_imagesource_2'] = '';
            $option_output['plugin_flf_histotag_imagesource_3'] = '';
            $option_output['plugin_flf_histotag_imagesource_1'] = 'checked="checked"';
            break;
        case 2:
            $option_output['plugin_flf_histotag_imagesource_1'] = '';
            $option_output['plugin_flf_histotag_imagesource_3'] = '';
            $option_output['plugin_flf_histotag_imagesource_2'] = 'checked="checked"';
            break;
        case 3:
            $option_output['plugin_flf_histotag_imagesource_2'] = '';
            $option_output['plugin_flf_histotag_imagesource_1'] = '';
            $option_output['plugin_flf_histotag_imagesource_3'] = 'checked="checked"';
            break;
            
            
         default:
            $option_output['plugin_flf_histotag_imagesource_2'] = '';
            $option_output['plugin_flf_histotag_imagesource_3'] = '';
            $option_output['plugin_flf_histotag_imagesource_1'] = 'checked="checked"';
            break;
    }   



    
      if ($superCage->post->keyExists('plugin_flf_histotag_histosupport') == TRUE  && $superCage->post->getInt('plugin_flf_histotag_histosupport') != $CONFIG['plugin_flf_histotag_histosupport']) {
        $CONFIG['plugin_flf_histotag_histosupport'] = $superCage->post->getInt('plugin_flf_histotag_histosupport');
        $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_histosupport']}' WHERE name='plugin_flf_histotag_histosupport'";
        cpg_db_query($query);
        $config_changes_counter++;
        $dump_cache++;
    }
    
    switch ($CONFIG['plugin_flf_histotag_histosupport']) {
        case 1:
            $option_output['plugin_flf_histotag_histosupport_2'] = '';
            $option_output['plugin_flf_histotag_histosupport_3'] = '';
            $option_output['plugin_flf_histotag_histosupport_4'] = '';
            $option_output['plugin_flf_histotag_histosupport_1'] = 'checked="checked"';
            break;
        case 2:
            $option_output['plugin_flf_histotag_histosupport_1'] = '';
            $option_output['plugin_flf_histotag_histosupport_3'] = '';
            $option_output['plugin_flf_histotag_histosupport_4'] = '';
            $option_output['plugin_flf_histotag_histosupport_2'] = 'checked="checked"';
            break;
        case 3:
            $option_output['plugin_flf_histotag_histosupport_1'] = '';
            $option_output['plugin_flf_histotag_histosupport_2'] = '';
            $option_output['plugin_flf_histotag_histosupport_4'] = '';
            $option_output['plugin_flf_histotag_histosupport_3'] = 'checked="checked"';
            break;
            
        case 4:
            $option_output['plugin_flf_histotag_histosupport_1'] = '';
            $option_output['plugin_flf_histotag_histosupport_2'] = '';
            $option_output['plugin_flf_histotag_histosupport_3'] = '';
            $option_output['plugin_flf_histotag_histosupport_4'] = 'checked="checked"';
            break;
                        
         default:
            $option_output['plugin_flf_histotag_histosupport_2'] = '';
            $option_output['plugin_flf_histotag_histosupport_3'] = '';
            $option_output['plugin_flf_histotag_histosupport_4'] = '';
            $option_output['plugin_flf_histotag_histosupport_1'] = 'checked="checked"';
            break;
            
            
    }      
    
    
    
    
    
    
    
    // UseHistogram function upon upload of images
      if ($superCage->post->keyExists('plugin_flf_histotag_createonupload') == TRUE && $superCage->post->getInt('plugin_flf_histotag_createonupload') == 1) {
        $temp = 1;
     } elseif($superCage->post->keyExists('submit') == TRUE) {
        $temp = 0;
     } else {
        $temp = $CONFIG['plugin_flf_histotag_createonupload'];
     }
    if ($CONFIG['plugin_flf_histotag_createonupload'] != $temp) {
        $CONFIG['plugin_flf_histotag_createonupload'] = $temp;
        $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_createonupload']}' WHERE name='plugin_flf_histotag_createonupload'";
        cpg_db_query($query);
        $config_changes_counter++;

    }
   if ($CONFIG['plugin_flf_histotag_createonupload'] == '1') {
        $option_output['plugin_flf_histotag_createonupload'] = 'checked="checked"';
   }

  if ($superCage->post->keyExists('plugin_flf_histotag_histotype') == TRUE  && $superCage->post->getInt('plugin_flf_histotag_histotype') != $CONFIG['plugin_flf_histotag_histotype']) {
        $CONFIG['plugin_flf_histotag_histotype'] = $superCage->post->getInt('plugin_flf_histotag_histotype');
        $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_histotype']}' WHERE name='plugin_flf_histotag_histotype'";
        cpg_db_query($query);
        $config_changes_counter++;
        $dump_cache++;
    }
    if ($CONFIG['plugin_flf_histotag_histotype'] == '2') {
        $option_output['plugin_flf_histotag_histotype_combined'] = '';
        $option_output['plugin_flf_histotag_histotype_separate'] = 'checked="checked"';
    } else { // default is "combined"
        $option_output['plugin_flf_histotag_histotype_combined'] = 'checked="checked"';
        $option_output['plugin_flf_histotag_histotype_separate'] = '';
    }


    // Histogram  Box Width
    if ($superCage->post->keyExists('plugin_flf_histotag_histoboxwidth') == TRUE) {
        if ($superCage->post->getInt('plugin_flf_histotag_histoboxwidth') >= 0 && $superCage->post->getInt('plugin_flf_histotag_histoboxwidth') <= 1280 && $CONFIG['plugin_flf_histotag_histoboxwidth'] != $superCage->post->getInt('plugin_flf_histotag_histoboxwidth')) {
            $CONFIG['plugin_flf_histotag_histoboxwidth'] = $superCage->post->getInt('plugin_flf_histotag_histoboxwidth');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_histoboxwidth']}' WHERE name='plugin_flf_histotag_histoboxwidth'";
            cpg_db_query($query);
            $config_changes_counter++;
            $dump_cache++;
        }
    }
     // Histogram Box Height
    if ($superCage->post->keyExists('plugin_flf_histotag_histoboxheight') == TRUE) {
        if ($superCage->post->getInt('plugin_flf_histotag_histoboxheight') >= 0 && $superCage->post->getInt('plugin_flf_histotag_histoboxheight') <= 1024 && $CONFIG['plugin_flf_histotag_histoboxheight'] != $superCage->post->getInt('plugin_flf_histotag_histoboxheight')) {
            $CONFIG['plugin_flf_histotag_histoboxheight'] = $superCage->post->getInt('plugin_flf_histotag_histoboxheight');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_histoboxheight']}' WHERE name='plugin_flf_histotag_histoboxheight'";
            cpg_db_query($query);
            $config_changes_counter++;
            $dump_cache++;
        }
    }
    
     // Histogram Width
    if ($superCage->post->keyExists('plugin_flf_histotag_histowidth') == TRUE) {
        if ($superCage->post->getInt('plugin_flf_histotag_histowidth') >= 0 && $superCage->post->getInt('plugin_flf_histotag_histowidth') <= 1024 && $CONFIG['plugin_flf_histotag_histowidth'] != $superCage->post->getInt('plugin_flf_histotag_histowidth')) {
            $CONFIG['plugin_flf_histotag_histowidth'] = $superCage->post->getInt('plugin_flf_histotag_histowidth');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_flf_histotag_histowidth']}' WHERE name='plugin_flf_histotag_histowidth'";
            cpg_db_query($query);
            $config_changes_counter++;
            $dump_cache++;
        }
    }
        

    
    

    
    // Form submit?
    if ($superCage->post->keyExists('submit') == TRUE) {
        if ($config_changes_counter > 0) {
            $additional_submit_information = '<div class="cpg_message_success">' . $flf_lang_var['changes_saved'] . '</div>';

            }
        
            else {
            $additional_submit_information = '<div class="cpg_message_validation">' . $flf_lang_var['no_changes'] . '</div>';
        }
    }



    // TODO: Create the table row that is displayed during initial install
    $install_section='';
    
    
    // Start the actual output
    echo <<< EOT
            <style type="text/css" media="screen">
                .farbtastic {
                  position: relative;
                }
                .farbtastic * {
                  position: absolute;
                  cursor: crosshair;
                }
                .farbtastic, .farbtastic .wheel {
                  width: 195px;
                  height: 195px;
                }
                .farbtastic .color, .farbtastic .overlay {
                  top: 47px;
                  left: 47px;
                  width: 101px;
                  height: 101px;
                }
                .farbtastic .wheel {
                  background: url(plugins/flf_histotag/images/wheel.png) no-repeat;
                  width: 195px;
                  height: 195px;
                }
                .farbtastic .overlay {
                  background: url(plugins/flf_histotag/images/mask.png) no-repeat;
                }
                .farbtastic .marker {
                  width: 17px;
                  height: 17px;
                  margin: -8px 0 0 -8px;
                  overflow: hidden; 
                  background: url(plugins/flf_histotag/images/marker.png) no-repeat;
                }
            </style>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#colorpicker_bgcolor').farbtastic('#plugin_flf_histotag_histocolor');
                $("#plugin_flf_histotag_histoquality").SpinButton({min: 0,max: 100});
                    $("#plugin_flf_histotag_mapwidth").SpinButton({min: 200,max: 1280});
                    $("#plugin_flf_histotag_mapheight").SpinButton({min:100,max: 1024});
                    $("#plugin_flf_histotag_mapboxwidth").SpinButton({min: 200,max: 1280});
                    $("#plugin_flf_histotag_mapboxheight").SpinButton({min:100,max: 1024});
                    $("#plugin_flf_histotag_histoboxwidth").SpinButton({min: 100,max: 1280});
                    $("#plugin_flf_histotag_histoboxheight").SpinButton({min:100,max: 1024});
                    $("#plugin_flf_histotag_histowidth").SpinButton({min:256,max: 1024});
                    
                    
});
            </script>
            <form action="" method="post" name="thumb_rotate_config" id="thumb_rotate_config">
EOT;

    starttable('100%', $thumb_rotate_icon_array['config'] . $flf_lang_var['config'], 2);
    echo <<< EOT

            <tr>
                        <td valign="top" class ="tableh1">
                    
                              {$flf_lang_var['configure_geo']}
                              </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$flf_lang_var['geosupport']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                            <input type="radio" name="plugin_flf_histotag_geosupport" id="plugin_flf_histotag_geosupport_1" class="checkbox" value="1" {$option_output['plugin_flf_histotag_geosupport_1']} /> 
                            <label for="plugin_flf_histotag_geosupport_1"> {$flf_lang_var['geosupport_1']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_geosupport" id="plugin_flf_histotag_geosupport_2" class="checkbox" value="2" {$option_output['plugin_flf_histotag_geosupport_2']} /> 
                            <label for="plugin_flf_histotag_geosupport_2"> {$flf_lang_var['geosupport_2']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_geosupport" id="plugin_flf_histotag_geosupport_3" class="checkbox" value="3" {$option_output['plugin_flf_histotag_geosupport_3']} /> 
                            <label for="plugin_flf_histotag_geosupport_3"> {$flf_lang_var['geosupport_3']}</label>
                            <br />
             
                            
                            
                            
                            
                            
                            </td>
                    </tr>
                    
                    
                    
                    
                    
                    
                    
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$flf_lang_var['maptype']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                            <input type="radio" name="plugin_flf_histotag_mapmode" id="plugin_flf_histotag_mapmode_1" class="checkbox" value="1" {$option_output['plugin_flf_histotag_mapmode_1']} /> 
                            <label for="plugin_flf_histotag_mapmode_1"> {$flf_lang_var['maptype_1']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_mapmode" id="plugin_flf_histotag_mapmode_2" class="checkbox" value="2" {$option_output['plugin_flf_histotag_mapmode_2']} /> 
                            <label for="plugin_flf_histotag_mapmode_2"> {$flf_lang_var['maptype_2']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_mapmode" id="plugin_flf_histotag_mapmode_3" class="checkbox" value="3" {$option_output['plugin_flf_histotag_mapmode_3']} /> 
                            <label for="plugin_flf_histotag_mapmode_3"> {$flf_lang_var['maptype_3']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_mapmode" id="plugin_flf_histotag_mapmode_4" class="checkbox" value="4" {$option_output['plugin_flf_histotag_mapmode_4']} /> 
                            <label for="plugin_flf_histotag_mapmode_4"> {$flf_lang_var['maptype_4']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_mapmode" id="plugin_flf_histotag_mapmode_5" class="checkbox" value="5" {$option_output['plugin_flf_histotag_mapmode_5']} /> 
                            <label for="plugin_flf_histotag_mapmode_5"> {$flf_lang_var['maptype_5']}</label>
                            
                            
                            
                            
                            
                            
                            </td>
                    </tr>

                    <tr>
                        <td valign="top" class ="tableb">
                    
                              {$flf_lang_var['configmap']}
                              </td>
                    </tr>
                        <td valign="top" class="tableb">
                            {$flf_lang_var['mapwidth']}
                        </td>
                        <td valign="top" class="tableb">
                             <input type="text" name="plugin_flf_histotag_mapwidth" id="plugin_flf_histotag_mapwidth" class="textinput spin-button" size="4" maxlength="4" value="{$CONFIG['plugin_flf_histotag_mapwidth']}" /> px


                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$flf_lang_var['mapheight']}
                        </td>
                        <td valign="top" class="tableb">
                             <input type="text" name="plugin_flf_histotag_mapheight" id="plugin_flf_histotag_mapheight" class="textinput spin-button" size="4" maxlength="4" value="{$CONFIG['plugin_flf_histotag_mapheight']}" /> px
                            <br />&nbsp;<br />

                        </td>
                    </tr>  
                            <tr>
                        <td valign="top" class ="tableb">
                    
                              {$flf_lang_var['configmapbox']}
                              </td>
                    </tr>                                    
                    <tr>

                    
                        <td valign="top" class="tableb">
                            {$flf_lang_var['mapwidth']}
                        </td>
                        <td valign="top" class="tableb">
                             <input type="text" name="plugin_flf_histotag_mapboxwidth" id="plugin_flf_histotag_mapboxwidth" class="textinput spin-button" size="4" maxlength="4" value="{$CONFIG['plugin_flf_histotag_mapboxwidth']}" /> px
    

                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$flf_lang_var['mapheight']}
                        </td>
                        <td valign="top" class="tableb">
                             <input type="text" name="plugin_flf_histotag_mapboxheight" id="plugin_flf_histotag_mapboxheight" class="textinput spin-button" size="4" maxlength="4" value="{$CONFIG['plugin_flf_histotag_mapboxheight']}" /> px
                            <br />&nbsp;<br />

                        </td>
                    </tr>   
                    
                    <tr>
                        <td valign="top" class="tableb">
                            {$flf_lang_var['setapi']}
                        </td>
                        <td valign="top" class="tableb">
                             <input type="text" name="plugin_flf_histotag_apikey" id="plugin_flf_histotag_apikey" class="textinput" size="50" maxlength="200" value="{$CONFIG['plugin_flf_histotag_apikey']}" />
                            <br />&nbsp;<br />

                        </td>
                    </tr>   
            
                    
                            <tr>
                        <td valign="top" class ="tableh1">
                            <br>
                              {$flf_lang_var['configure_histo']}
                              <br>
                              </td>
                    </tr>
                    
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$flf_lang_var['histosupport']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                            <input type="radio" name="plugin_flf_histotag_histosupport" id="plugin_flf_histotag_histosupport_1" class="checkbox" value="1" {$option_output['plugin_flf_histotag_histosupport_1']} /> 
                            <label for="plugin_flf_histotag_histosupport_1"> {$flf_lang_var['histosupport_1']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_histosupport" id="plugin_flf_histotag_histosupport_2" class="checkbox" value="2" {$option_output['plugin_flf_histotag_histosupport_2']} /> 
                            <label for="plugin_flf_histotag_histosupport_2"> {$flf_lang_var['histosupport_2']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_histosupport" id="plugin_flf_histotag_histosupport_3" class="checkbox" value="3" {$option_output['plugin_flf_histotag_histosupport_3']} /> 
                            <label for="plugin_flf_histotag_histosupport_3"> {$flf_lang_var['histosupport_3']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_histosupport" id="plugin_flf_histotag_histosupport_4" class="checkbox" value="4" {$option_output['plugin_flf_histotag_histosupport_4']} /> 
                            <label for="plugin_flf_histotag_histosupport_4"> {$flf_lang_var['histosupport_4']}</label>
                            <br />             
                            
                            
                            
                            
                            
                            </td>
                    </tr>
                    
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$flf_lang_var['imagesource']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                            <input type="radio" name="plugin_flf_histotag_imagesource" id="plugin_flf_histotag_imagesource_1" class="checkbox" value="1" {$option_output['plugin_flf_histotag_imagesource_1']} /> 
                            <label for="plugin_flf_histotag_imagesource_1"> {$flf_lang_var['imagesource_1']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_imagesource" id="plugin_flf_histotag_imagesource_2" class="checkbox" value="2" {$option_output['plugin_flf_histotag_imagesource_2']} /> 
                            <label for="plugin_flf_histotag_imagesource_2"> {$flf_lang_var['imagesource_2']}</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_imagesource" id="plugin_flf_histotag_imagesource_3" class="checkbox" value="3" {$option_output['plugin_flf_histotag_imagesource_3']} /> 
                            <label for="plugin_flf_histotag_imagesource_3"> {$flf_lang_var['imagesource_3']}</label>
                            <br />
             
                            
                            
                            
                            
                            
                            </td>
                    </tr>
                    
                    
                    
                    
                    
                       <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$flf_lang_var['createonupload']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                            <input type="checkbox" name="plugin_flf_histotag_createonupload" id="plugin_flf_histotag_createonupload" class="checkbox" value="1" {$option_output['plugin_flf_histotag_createonupload']} /> 
                           {$flf_lang_var['activated']}
                            </td>
                    </tr>         
                                       
         
                  


                    
                    
                    
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$flf_lang_var['histcol']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                                <input type="text" name="plugin_flf_histotag_histocolor" id="plugin_flf_histotag_histocolor" class="textinput" size="8" maxlength="7" value="{$CONFIG['plugin_flf_histotag_histocolor']}" style="text-transform:uppercase;" />
                            <span class="detail_head_collapsed">{$flf_lang_var['toggle_color_picker']}</span>
                            <div id="colorpicker_bgcolor" class="detail_body"></div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$flf_lang_var['histo_quality']}
                        </td>
                        <td valign="top" class="tableb">
                             <input type="text" name="plugin_flf_histotag_histoquality" id="plugin_flf_histotag_histoquality" class="textinput spin-button" size="3" maxlength="3" value="{$CONFIG['plugin_flf_histotag_histoquality']}" /> %
                            <br />&nbsp;<br />

                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$flf_lang_var['histtype']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                            <input type="radio" name="plugin_flf_histotag_histotype" id="plugin_flf_histotag_histotype_combined" class="checkbox" value="1" {$option_output['plugin_flf_histotag_histotype_combined']} /> 
                            <label for="plugin_flf_histotag_histotype_combined"> ({$flf_lang_var['histo_type_combined']})</label>
                            <br />
                            <input type="radio" name="plugin_flf_histotag_histotype" id="plugin_flf_histotag_histotype_separate" class="checkbox" value="2" {$option_output['plugin_flf_histotag_histotype_separate']} /> 
                            <label for="plugin_flf_histotag_histotype_separate"> ({$flf_lang_var['histo_type_separate']})</label>
                        </td>
                    </tr>
                    
                    <tr>
                        <td valign="top" class="tableb">
                            {$flf_lang_var['histowidth']}
                        </td>
                        <td valign="top" class="tableb">
                             <input type="text" name="plugin_flf_histotag_histowidth" id="plugin_flf_histotag_histowidth" class="textinput spin-button" size="4" maxlength="4" value="{$CONFIG['plugin_flf_histotag_histowidth']}" /> px
                            <br />&nbsp;<br />

                        </td>
                    </tr>  
                    
                    <tr>
                        <td valign="top" class ="tableb">
                    
                              {$flf_lang_var['configmapbox']}
                              </td>
                    </tr>  
                    <tr>
                        <td valign="top" class="tableb">
                            {$flf_lang_var['mapwidth']}
                        </td>
                        <td valign="top" class="tableb">
                             <input type="text" name="plugin_flf_histotag_histoboxwidth" id="plugin_flf_histotag_histoboxwidth" class="textinput spin-button" size="4" maxlength="4" value="{$CONFIG['plugin_flf_histotag_histoboxwidth']}" /> px
    

                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$flf_lang_var['mapheight']}
                        </td>
                        <td valign="top" class="tableb">
                             <input type="text" name="plugin_flf_histotag_histoboxheight" id="plugin_flf_histotag_histoboxheight" class="textinput spin-button" size="4" maxlength="4" value="{$CONFIG['plugin_flf_histotag_histoboxheight']}" /> px
                            <br />&nbsp;<br />

                        </td>
                    </tr>   
               

                    {$install_section}
                    <tr>
                        <td valign="middle" class="tablef">
                        </td>
                        <td valign="middle" class="tablef">
                            <button type="submit" class="button" name="submit" value="{$lang_common['ok']}">{$thumb_rotate_icon_array['ok']}{$lang_common['ok']}</button>
                        </td>
                    </tr>
EOT;
    endtable();
    echo <<< EOT
            {$additional_submit_information}
            </form>

EOT;

}

?>
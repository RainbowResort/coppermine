<?php
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start','monitor_calibration_bar_language');
$thisplugin->add_action('plugin_install','monitor_calibration_bar_install');
$thisplugin->add_action('plugin_uninstall','monitor_calibration_bar_uninstall');
$thisplugin->add_action('plugin_configure','monitor_calibration_bar_configure');
$thisplugin->add_filter('file_info','monitor_calibration_bar_picinfo');
$thisplugin->add_filter('html_image','monitor_calibration_bar_underneath_intermediate');
$thisplugin->add_filter('html_image_reduced','monitor_calibration_bar_underneath_intermediate');
$thisplugin->add_filter('admin_menu','monitor_calibration_bar_config_button');
$thisplugin->add_filter('sys_menu','monitor_calibration_bar_sub_button');

function monitor_calibration_bar_underneath_intermediate($html) {
    global $CONFIG, $lang_plugin_moncalb;
    // Don't execute this no matter what, but only if the corresponding option is set
    if ($CONFIG['plugin_moncalb_how'] == 2) {
        $html .= monitor_calibration_bar_display_bar($CONFIG['picture_width']);
    } elseif ($CONFIG['plugin_moncalb_how'] == 3) {
    	$html .= '<a href="index.php?file=monitorcalibrationbar/index&amp;action=display" title="'.$lang_plugin_moncalb['config_name'].'" rel="nofolow">'.$lang_plugin_moncalb['menu'].'</a>';
    }
    return $html;
}

function monitor_calibration_bar_picinfo($html) {
    global $CONFIG, $lang_plugin_moncalb;
    // Don't execute this no matter what, but only if the corresponding option is set
    if ($CONFIG['plugin_moncalb_how'] == 0) {
        $html[$lang_plugin_moncalb['picinfo_heading']] = monitor_calibration_bar_display_bar('100%');
    } elseif ($CONFIG['plugin_moncalb_how'] == 1) {
    	$html[$lang_plugin_moncalb['picinfo_heading']] = '<a href="index.php?file=monitorcalibrationbar/index&amp;action=display" title="'.$lang_plugin_moncalb['config_name'].'" rel="nofolow">'.$lang_plugin_moncalb['menu'].'</a>';
    }
    return $html;
}

function monitor_calibration_bar_language() {
	global $CONFIG, $lang_plugin_moncalb;
	require "./plugins/monitorcalibrationbar/lang/english.php";
	if ($CONFIG['lang'] != 'english' && file_exists("./plugins/monitorcalibrationbar/lang/{$CONFIG['lang']}.php")) {
	    require "./plugins/monitorcalibrationbar/lang/{$CONFIG['lang']}.php";
	}
}

// Install the plugin
function monitor_calibration_bar_install() {
    global $CONFIG;
    // Create the three extra entries in coppermine's config table
    if (isset($CONFIG['plugin_moncalb_how']) != TRUE) {
    	$CONFIG['plugin_moncalb_how'] = 0; // Set default value here
        $query = "INSERT INTO {$CONFIG['TABLE_CONFIG']} VALUES ('plugin_moncalb_how', '{$CONFIG['plugin_moncalb_how']}')";
    	cpg_db_query($query);
    }
    if (isset($CONFIG['plugin_moncalb_config_link']) != TRUE) {
    	$CONFIG['plugin_moncalb_config_link'] = 0; // Set default value here
        $query = "INSERT INTO {$CONFIG['TABLE_CONFIG']} VALUES ('plugin_moncalb_config_link', '{$CONFIG['plugin_moncalb_config_link']}')";
    	cpg_db_query($query);
    }
    if (isset($CONFIG['plugin_moncalb_height']) != TRUE) {
    	$CONFIG['plugin_moncalb_height'] = 20; // Set default value here
        $query = "INSERT INTO {$CONFIG['TABLE_CONFIG']} VALUES ('plugin_moncalb_height', '{$CONFIG['plugin_moncalb_height']}')";
    	cpg_db_query($query);
    }
    return true;
}

function monitor_calibration_bar_uninstall() {
        global $CONFIG;
        $superCage = Inspekt::makeSuperCage();
        // Drop the database records
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_moncalb_how'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_moncalb_config_link'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_moncalb_height'");
        return true;
}


// Configure function: displays the configuration form
function monitor_calibration_bar_configure() {
    global $CONFIG, $thisplugin, $lang_plugin_moncalb, $lang_common, $lang_gallery_admin_menu;
    $superCage = Inspekt::makeSuperCage();
    $icon_array['ok'] = cpg_fetch_icon('ok', 1);
    $icon_array['config'] = cpg_fetch_icon('config', 1);
    // Populate the form fields
    if ($superCage->post->keyExists('moncalb_option_how') == TRUE) {
        if ($superCage->post->getInt('moncalb_option_how') >= 0 && $superCage->post->getInt('moncalb_option_how') <= 4) {
            $CONFIG['plugin_moncalb_how'] = $superCage->post->getInt('moncalb_option_how');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_moncalb_how']}' WHERE name='plugin_moncalb_how'";
            cpg_db_query($query);
        }
    }
    for ($i = 0; $i <= 4; $i++) { // Loop through the possible options
        if ($CONFIG['plugin_moncalb_how'] == $i ) {
            $checked_how[$i] = 'checked="checked"';
        } else {
            $checked_how[$i] = '';
        }
    }
    if ($superCage->post->keyExists('submit') == TRUE) {
    	if ($superCage->post->getInt('moncalb_option_config_link') == 1 ) {
    		$CONFIG['plugin_moncalb_config_link'] =1;
    	} else {
    		$CONFIG['plugin_moncalb_config_link'] = 0;
    	}
    $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_moncalb_config_link']}' WHERE name='plugin_moncalb_config_link'";
    cpg_db_query($query);    
    }
    if ($CONFIG['plugin_moncalb_config_link'] == 1) {
    	$checked_config_link = 'checked="checked"';
    } else {
    	$checked_config_link = '';
    }
    if ($superCage->post->keyExists('moncalb_option_height') == TRUE) {
        if ($superCage->post->getMatched('moncalb_option_height', '/^[0-9]{1,3}$/') == TRUE) {
            $CONFIG['plugin_moncalb_height'] = $superCage->post->getInt('moncalb_option_height');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_moncalb_height']}' WHERE name='plugin_moncalb_height'";
            cpg_db_query($query);
        }
    }
        echo <<< EOT
            <form action="{$_SERVER['REQUEST_URI']}" method="post">
EOT;
        starttable('100%', $icon_array['config'] . $lang_plugin_moncalb['config'], 2);
        echo <<< EOT
                    <tr>
                        <td valign="top" class="tableb tableb_alternate" colspan="2">
                            {$lang_plugin_moncalb['config_description']}<br />
                            <a href="index.php?file=monitorcalibrationbar/index&action=display" class="admin_menu" title="{$lang_plugin_moncalb['menu']}">{$lang_plugin_moncalb['picinfo_heading']}</a> 
                            &nbsp;&nbsp;
                            <a href="pluginmgr.php" class="admin_menu" title="{$lang_gallery_admin_menu['pluginmgr_title']}">{$lang_gallery_admin_menu['pluginmgr_lnk']}</a>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_moncalb['option_how']}
                        </td>
                        <td valign="top" class="tableb">
                            <input type="radio" id="moncalb_option_how_picinfo_bar" name="moncalb_option_how" value="0"  {$checked_how[0]} class="radio" /><label for="moncalb_option_how_picinfo_bar" class="clickable_option">{$lang_plugin_moncalb['display_picinfo_bar']}</label><br />
                            <input type="radio" id="moncalb_option_how_picinfo_link" name="moncalb_option_how" value="1"  {$checked_how[1]} class="radio" /><label for="moncalb_option_how_picinfo_link" class="clickable_option">{$lang_plugin_moncalb['display_picinfo_link']}</label><br />
                            <input type="radio" id="moncalb_option_how_intermediate_bar" name="moncalb_option_how" value="2"  {$checked_how[2]} class="radio" /><label for="moncalb_option_how_intermediate_bar" class="clickable_option">{$lang_plugin_moncalb['display_intermediate_bar']}</label><br />
                            <input type="radio" id="moncalb_option_how_admin_menu_link" name="moncalb_option_how" value="3"  {$checked_how[3]} class="radio" /><label for="moncalb_option_how_admin_menu_link" class="clickable_option">{$lang_plugin_moncalb['display_intermediate_link']}</label><br />
                            <input type="radio" id="moncalb_option_how_sysmenu_link" name="moncalb_option_how" value="4"  {$checked_how[4]} class="radio" /><label for="moncalb_option_how_sysmenu_link" class="clickable_option">{$lang_plugin_moncalb['display_sysmenu_link']}</label><br />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            <label for="moncalb_option_config_link" class="clickable_option">{$lang_plugin_moncalb['admin_menu_configuration_link']}</label>
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                            <input type="checkbox" name="moncalb_option_config_link" id="moncalb_option_config_link" class="checkbox" value="1" {$checked_config_link} /> ({$lang_plugin_moncalb['not_recommended']})
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_moncalb['option_height']}
                        </td>
                        <td valign="top" class="tableb">
                            <input type="text" name="moncalb_option_height" size="3" maxlength="3" class="textinput" value="{$CONFIG['plugin_moncalb_height']}" /> ({$lang_plugin_moncalb['option_height_explanation']})
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tablef">
                        </td>
                        <td valign="top" class="tablef">
                            <button type="submit" class="button" name="submit" value="{$lang_common['ok']}">{$icon_array['ok']}{$lang_common['ok']}</button>
                        </td>
                    </tr>
EOT;
        endtable();
        echo <<< EOT
            </form>

EOT;
}

function monitor_calibration_bar_config_button($admin_menu){
    global $lang_plugin_moncalb, $CONFIG;
    if ($CONFIG['plugin_moncalb_config_link'] == 1) {
    $new_button = '<div class="admin_menu admin_float"><a href="index.php?file=monitorcalibrationbar/index&amp;action=configure" title="' . $lang_plugin_moncalb['config'] . '">'.cpg_fetch_icon('config', 1) . $lang_plugin_moncalb['config'] . '</a></div>';
    $look_for = '<!-- END export -->';
    $admin_menu = str_replace($look_for, $look_for . $new_button, $admin_menu);
    }
    return $admin_menu;
}

function monitor_calibration_bar_sub_button($menu) {
    global $lang_plugin_moncalb, $template_sys_menu_spacer, $CONFIG;
    if ($CONFIG['plugin_moncalb_how'] == 4) {
		monitor_calibration_bar_language();
        $new_button = array();
        $new_button[0][0] = $lang_plugin_moncalb['picinfo_heading'];
        $new_button[0][1] = $lang_plugin_moncalb['menu'];
        $new_button[0][2] = 'index.php?file=monitorcalibrationbar/index&amp;action=display';
        $new_button[0][3] = 'monitor_calibration';
        $new_button[0][4] = $template_sys_menu_spacer;
        $new_button[0][5] = 'rel="nofolow"';

        array_splice($menu, count($menu)-1, 0, $new_button);
    }

    return $menu;
}

function monitor_calibration_bar_display_bar($bar_width = '100%', $helpneeded = 'yes') {
    global $CONFIG, $lang_plugin_moncalb,$image_size,$CURRENT_PIC_DATA;
    $greyscale_array = array('#040404', '#0F0F0F', '#171717', '#212121', '#2C2C2C', '#353535', '#404040', '#4B4B4B', '#515151', '#5E5E5E', '#676767', '#717171', '#7B7B7B', '#878787', '#919191', '#9B9B9B', '#9B9B9B', '#A4A4A4', '#B7B7B7', '#C2C2C2', '#CBCBCB', '#D4D4D4', '#DFDFDF', '#E7E7E7', '#F2F2F2', '#FDFDFD');
    if ($helpneeded != 'no') {
    	$help = '&nbsp;'. cpg_display_help('f=empty.htm&amp;base=64&amp;h=' . urlencode(base64_encode(serialize($lang_plugin_moncalb['config_name']))) . '&amp;t=' . urlencode(base64_encode(serialize($lang_plugin_moncalb['explain']))), $CONFIG['picture_width'], 400);
    	$additional_column_exist = 1;
    } else {
    	$help = '';
    	$additional_column_exist = 0;
    }
    
    if (strpos($bar_width, '%') === FALSE) {
        $individual_strip_width = floor($bar_width / (count($greyscale_array)+$additional_column_exist));
        $individual_image_width = $individual_strip_width;
        $css_unit = 'px';
    } else {
        $individual_strip_width = $bar_width / (count($greyscale_array)+$additional_column_exist);
        $individual_image_width = 1;
        $bar_width = rtrim($bar_width,'%');
        $css_unit = '%';
    }
    $actual_bar_width = $individual_strip_width * (count($greyscale_array)+$additional_column_exist);
    if ($helpneeded != 'no') {
    	$additional_column_width = $individual_strip_width;
    } else {
    	$additional_column_width = 0;
    }
    $return = <<< EOT
    
    <div style="width:{$bar_width}{$css_unit};">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td style="background-color:black;width:1px;"></td>
EOT;

    $loopCounter = 1;
    foreach ($greyscale_array as $bar_color) {
        $return .= <<< EOT
        
                <td style="background-color:{$bar_color};border-top:1px solid black;border-bottom:1px solid black;width:{$individual_strip_width}{$css_unit}" title="{$loopCounter}/{$bar_color}">
                    <img src="images/spacer.gif" border="0" width="{$individual_image_width}" height="{$CONFIG['plugin_moncalb_height']}" alt="" />
                </td>
EOT;
    $loopCounter++;
    }
    $return .= <<< EOT
                
                <td width="{$additional_column_width}{$css_unit}" valign="top" style="border-left:1px solid black;">{$help}</td>
            </tr>
        </table>
        
    </div>
EOT;
    return $return;
}
?>
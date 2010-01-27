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

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

// Lang setting for installation process
$lang_plugin_highslide_install = array(
  'button_install'=> 'Install',
  'button_submit' => 'Submit',
  'button_cancel' => 'Cancel',
  'button_done'   => 'Done',
  'cleanup_question' => 'Remove the table that was used to store settings ?',
  'install_note'  => 'Configure plugin using button on Admin toolbar.',	// Note about configuring plugin
  'install_click' => 'Click button to install plugin.',	// Message to install plugin
);

// Lang setting for Caption
$lang_plugin_highslide = array( 
	'detail'       => 'Detail', // Lable of the link to intermadiate image
	'close'        => 'Close', // Lable of the close link
	'title'        => 'Title', // Lable of the title
	'controlbarnext'  => 'Next (right arrow key)',  // HS v3.02
	'controlbarprev'  => 'Previous (left arrow key)', // HS v3.02
	'controlbarmove'  => 'Click and drag to move', // HS v3.02
	'controlbarclose' => 'Close', //HS v3.02
);
//Lang setting for configuration and admin panel
$lang_plugin_highslide_config = array(
  'display_name'  => 'HighSlide',			// Display Name
  'config_title'  => 'Configure HighSlide',			// Title of the button on the gallery config menu
  'config_button' => 'HighSlide',				// Label of the button on the gallery config menu
  'page_success'  => 'Configuration Settings Updated.',		// Page success message
  'page_failure'  => 'Unable to update settings.',		// Page failure message
  'version'       => 'Ver 3.04', // HS 3.01
  'pluginmanager' => 'Plugin Manager',
  'expand_all'    => 'Expand All',
  'main_title'    => 'HighSlide plugin management',
  'Style_of_border'   => 'Border style:',
  'Disable_Admin_Mode'=> 'Disable plugin on admin mode:',
  'Link_To_intermadiate'=> 'Link to intermediate:',
  'Link_for_Closing'=> 'Link to close:', // HS v 2.3
  'Dispaly_Title_Caption'=> 'Display title on caption :',// HS 2.1
  'Custom_HTML_Caption'=> 'Custom HTML on caption: ',
  'Aimao' => 'Where do you want to apply HighSlide? ', // HS v 2.2 
  'SFIuSIi' => 'Size of slide: ', // HS v 2.3 
  'Yes' => 'Yes',
  'No' => 'No',
  'full_image' => 'Full size image', // HS v 2.1
  'intermadiate' => 'Intermediate (checked via file name; may fail with special characters in file names)', // HS v 2.1
  'force_intermadiate' => 'Force always intermediate (if you have intermediate versions of all pics)', // HS v3.0
  'Wrob'=> 'Rounded white outline border *',
  'StyleNote' => '* Color for borders and caption will be changed to fit!', //HS 3.01
  'StyleNote2' => '** Thickness will be set to 0px!', //HS 3.01
  'Beveled' => 'Half transparent beveled **', //HS 3.0
  'W10b'=> 'Square border (select color below)',
  'Ogb'=> 'Square border with outer glow (select color below)',
  'Nb'=> 'No border **',
  'Nbshadow'=> 'Drop shadow only **', //HS 3.01
  'note1' => 'These options are not enabled for this version !!!',
  'apply_to_all'  => 'Apply to all pages', // HS v 2.3
  'apply_to_index'  => 'Apply to index & meta albums', // HS v 2.2
  'page_success' => 'HighSlide configuration settings updated.', // HS v 2.2
  'enable_sef' => 'Enable SEF compatibility: ', // HS v2.2
  'slide_cnt' => 'Count slide views as real views (hscnt.php must be moved to gallery root!):', //HS v2.5
  'border_color' => 'Color for borders and caption:', //HS 3.0
  'details_color' => 'Color for caption text:', //HS 3.0
  'detailsover_color' => 'Color for caption text (hover):', //HS 3.0
  'thickness' => 'Border thickness:', //HS 3.0
  'expand_steps' => 'Number of steps when expanding image:', //HS 3.0
  'expand_duration' => 'Duration of expanding [ms]:', //HS 3.0
  'restore_steps' => 'Number of steps when restoring image:', //HS 3.0
  'restore_duration' => 'Duration of restoring [ms]:', //HS 3.0
  'caption_slide_speed' => 'Caption slide speed:', //HS 3.0
  'allow_multi_inst' => 'Allow more than one expanded image at a time:', //HS 3.0
  'RightNow' => 'Immediately', //HS 3.0
  'Slowest' => 'Slowest', //HS 3.0
  'Slower' => 'Slower', //HS 3.0
  'Slow' => 'Slow', //HS 3.0
  'Fast' => 'Fast', //HS 3.0
  'Faster' => 'Faster', //HS 3.0
  'Fastest' => 'Fastest', //HS 3.0
  'Rlightgray' => 'Rounded light-gray outline border *', //HS 3.01
  'Rmediumgray' => 'Rounded medium-gray outline border *', //HS 3.01
  'Rdarkgray' => 'Rounded dark-gray outline border *', //HS 3.01
  'Rblack' => 'Rounded black outline border *', //HS 3.01
  'Rroyalblue' => 'Rounded royal-blue outline border *', //HS 3.01
  'Rdarkblue' => 'Rounded dark-blue outline border *', //HS 3.01
  'Rlightgreen' => 'Rounded light-green outline border *', //HS 3.01
  'Rdarkgreen' => 'Rounded dark-green outline border *', //HS 3.01
  'Rlightred' => 'Rounded light-red outline border *', //HS 3.01
  'Rdarkred' => 'Rounded dark-red outline border *', //HS 3.01
  'Rorange' => 'Rounded orange outline border *', //HS 3.01
  'Rcyan' => 'Rounded cyan outline border *', //HS 3.01
  'Preview' => 'Preview', //HS 3.01
);
// JS lang setting
$lang_plugin_highslide_js = array (
	'loading_text'   =>  'Loading...',// HS v2.3
	'loading_title'  =>  'Click to cancel',// HS v2.3
	'restore_title'  =>  'Click to restore thumbnail',// HS v2.3
	'fullexpand_title' => 'Click for original size', // HS v3.0
);
?>
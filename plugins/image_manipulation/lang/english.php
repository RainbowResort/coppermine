<?php
/**************************************************
  Coppermine 1.5.x Plugin - Image manipulation
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) { 
	die('Not in Coppermine...'); 
}
$lang_plugin_im['display_name'] = 'Image Manipulation';
$lang_plugin_im['update_success'] = 'Configuration has been updated successfully; your changes have been saved.';
$lang_plugin_im['main_title'] = 'Image Manipulation PlugIn';
$lang_plugin_im['pluginmanager'] = 'Plugin Manager';
$lang_plugin_im['submit'] = 'Submit';
$lang_plugin_im['no_changes'] = 'There have been no changes or the changes you applied were invalid.';
$lang_plugin_im['recommended'] = 'recommended';
$lang_plugin_im['not_recommended'] = 'not recommended';
$lang_plugin_im['description'] = 'Allows the visitor to non-destructively manipulate the image. Changes will be reflected in the URL as well as saved in a cookie of the visitor\'s browser';
$lang_plugin_im['install_info'] = 'You can configure the plugin after installation using the button on the plugin manager.';
$lang_plugin_im['extra_info'] = 'This plugin will only work if \'Insert a transparent overlay to minimize image theft\' is deactivated in the gallery settings.';
$lang_plugin_im['announcement_thread'] = 'Announcement thread';
$lang_plugin_im['im_configuration'] = 'Image Manipulation configuration';
$lang_plugin_im['plugin_setup'] = 'Plugin setup';
$lang_plugin_im['usecompatible'] = 'Use compatible mode';
$lang_plugin_im['usecookies'] = 'Use cookies';
$lang_plugin_im['useurlvalues'] = 'Use URL values';
$lang_plugin_im['enable'] = 'Enable';
$lang_plugin_im['disable'] = 'Disable';
$lang_plugin_im['enlargeit_documentation'] = 'Image Manipulation documentation';
$lang_plugin_im['im_strlightness'] = 'Brightness';
$lang_plugin_im['im_strreset'] = 'Reset';
$lang_plugin_im['im_strbw'] = 'B/W';
$lang_plugin_im['im_strsepia'] = 'Sepia';
$lang_plugin_im['im_strflipv'] = 'Flip vert';
$lang_plugin_im['im_strfliph'] = 'Flip hori';
$lang_plugin_im['im_strinvert'] = 'Invert';
$lang_plugin_im['im_stremboss'] = 'Emboss';
$lang_plugin_im['im_strblur'] = 'Blur';
$lang_plugin_im['im_strcontrast'] = 'Contrast';
$lang_plugin_im['im_strsatur'] = 'Saturation';
$lang_plugin_im['im_strsharpen'] = 'Sharpness';
?>
<?php
/**************************************************
  Coppermine 1.5.x Plugin - thumb_rotate
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
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

$lang_plugin_thumb_rotate['config_name'] = 'Thumb Rotate';
$lang_plugin_thumb_rotate['config_description'] = 'Rotates thumbnails for a different look of your gallery, like a comic or a scrap book.'; 
$lang_plugin_thumb_rotate['resources_warning'] = 'The rotated thumbnails get cached. Despite of that, this plugin is a CPU hog and shouldn\'t be used with large galleries or on slow servers. If you experience performance issues, turn this plugin off! Consider this plugin to be in beta status only.';
$lang_plugin_thumb_rotate['config_details'] = 'You can set the maximum amount of rotation and the background color of the generated thumbnails in the config screen that comes with this plugin.';
$lang_plugin_thumb_rotate['config'] = 'Thumb Rotate Configuration';
$lang_plugin_thumb_rotate['minimum_requirements'] = 'Minimum requirements';
$lang_plugin_avatar_create['minimum requirements_summary'] = 'This plugin requires PHP 4.3.2 or better and working GD2.';
$lang_plugin_thumb_rotate['minimum_requirements_ok'] = 'Passed: your version of %s (%s) appears to be good enough.';
$lang_plugin_thumb_rotate['minimum_requirements_low'] = 'Failed: your version of %s (%s) doesn\'t appear to be good enough.';
$lang_plugin_thumb_rotate['minimum_requirements_unavailable'] = 'Failed: you don\'t seem to have the GD library at all.';
$lang_plugin_thumb_rotate['minimum_requirements_imagerotate'] = 'Failed: you don\'t seem to have the function imagerotate available, so an even more resources-consuming alternative will be used instead.';
$lang_plugin_thumb_rotate['continue_anyway'] = 'Continue anyway?';
$lang_plugin_thumb_rotate['option_rounded_corners'] = 'Rounded corners';
$lang_plugin_thumb_rotate['option_rounded_corners_radius'] = 'Radius';
$lang_plugin_thumb_rotate['option_rotation'] = 'Rotation';
$lang_plugin_thumb_rotate['option_maxrotation'] = 'Rotation angle';
$lang_plugin_thumb_rotate['option_rotation_method'] = 'Rotation method';
$lang_plugin_thumb_rotate['option_rotation_method_random'] = 'random';
$lang_plugin_thumb_rotate['option_rotation_method_fixed'] = 'fixed';
$lang_plugin_thumb_rotate['option_bgcolor'] = 'Background color of your theme';
$lang_plugin_thumb_rotate['option_border'] = 'Border';
$lang_plugin_thumb_rotate['option_borderwidth'] = 'Border width';
$lang_plugin_thumb_rotate['option_bordercolor'] = 'Border color';
$lang_plugin_thumb_rotate['option_admin_only'] = 'Only visible for admin';
$lang_plugin_thumb_rotate['option_admin_only_explain'] = 'To prepare the plugin and build the cache in advance in the backend only';
$lang_plugin_thumb_rotate['option_timelimit'] = 'Delay between thumbnail-creation intervalls';
$lang_plugin_thumb_rotate['option_filetype'] = 'File type';
$lang_plugin_thumb_rotate['option_filetype_png_explain'] = 'Transparency possible, limited support in older browsers';
$lang_plugin_thumb_rotate['option_filetype_jpg_explain'] = 'No transparency, platform-independant';
$lang_plugin_thumb_rotate['pixels'] = 'pixels';
$lang_plugin_thumb_rotate['seconds'] = 'seconds';
$lang_plugin_thumb_rotate['zero_to_disable'] = '0 to disable';
$lang_plugin_thumb_rotate['submit_to_install'] = 'Submit this form to install the plugin';
$lang_plugin_thumb_rotate['author'] = 'Originally created by %s, re-written by %s, Colorpicker jQuery Plugin &quot;Farbtastic&quot; by %s';
$lang_plugin_thumb_rotate['announcement_thread'] = 'Announcement thread';
$lang_plugin_thumb_rotate['changes_saved'] = 'Your changes have been saved';
$lang_plugin_thumb_rotate['no_changes'] = 'There have been no changes or the values you entered where invalid';
$lang_plugin_thumb_rotate['toggle_color_picker'] = 'Show/hide color picker';
$lang_plugin_thumb_rotate['cache'] = 'Cache';
$lang_plugin_thumb_rotate['empty_cache'] = 'Empty cache';
$lang_plugin_thumb_rotate['cache_size'] = 'Cached files: %s (of %s total)';
$lang_plugin_thumb_rotate['wait'] = 'Please wait, there are %s more records to process.';
$lang_plugin_thumb_rotate['preview'] = 'Preview';
$lang_plugin_thumb_rotate['no_preview_available'] = 'No preview available - cache is empty.';
$lang_plugin_thumb_rotate['remove_settings'] = 'Remove the plugin settings from the database?';
$lang_plugin_thumb_rotate['batch_fill'] = 'Batch-fill cache';
$lang_plugin_thumb_rotate['x_files_remaining'] = '%s files remaining';
$lang_plugin_thumb_rotate['manual_control'] = 'Manual control';
$lang_plugin_thumb_rotate['cancel'] = 'cancel';
$lang_plugin_thumb_rotate['manual_control_explain'] = 'use only to cancel or speed up automatic mode';
?>
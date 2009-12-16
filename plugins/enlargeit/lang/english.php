<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
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
$lang_plugin_enlargeit['display_name'] = 'EnlargeIt!';
$lang_plugin_enlargeit['update_success'] = 'Configuration has been updated successfully; your changes have been saved.';
$lang_plugin_enlargeit['main_title'] = 'EnlargeIt! PlugIn';
$lang_plugin_enlargeit['pluginmanager'] = 'Plugin Manager';
$lang_plugin_enlargeit['submit'] = 'Submit';
$lang_plugin_enlargeit['enlarge_to_pic_in'] = 'Enlarge to pic in';
$lang_plugin_enlargeit['intermediate_size'] = 'intermediate size';
$lang_plugin_enlargeit['full_size'] = 'full size';
$lang_plugin_enlargeit['force_intermediate_size'] = 'force intermediate size';
$lang_plugin_enlargeit['animation'] = 'Animation';
$lang_plugin_enlargeit['none'] = 'none';
$lang_plugin_enlargeit['fade'] = 'fade in/out';
$lang_plugin_enlargeit['glide'] = 'glide';
$lang_plugin_enlargeit['bumpglide'] = 'bump glide';
$lang_plugin_enlargeit['smoothglide'] = 'smooth glide';
$lang_plugin_enlargeit['expglide'] = 'hard glide';
$lang_plugin_enlargeit['topglide'] = 'glide from top';
$lang_plugin_enlargeit['leftglide'] = 'glide from left';
$lang_plugin_enlargeit['topleftglide'] = 'glide from top left';
$lang_plugin_enlargeit['time_between_animation_steps'] = 'Time between animation steps';
$lang_plugin_enlargeit['animation_steps'] = 'Animation steps';
$lang_plugin_enlargeit['border_width'] = 'Border width';
$lang_plugin_enlargeit['border_texture'] = 'Border texture';
$lang_plugin_enlargeit['border_color'] = 'Border color';
$lang_plugin_enlargeit['round_border'] = 'Round border';
$lang_plugin_enlargeit['shadow_size'] = 'Shadow size';
$lang_plugin_enlargeit['shadow_opacity'] = 'Shadow opacity';
$lang_plugin_enlargeit['show_titlebar'] = 'Show title bar when buttons are inactive';
$lang_plugin_enlargeit['title_bar_text_color'] = 'Title bar text color';
$lang_plugin_enlargeit['background_color_ajax_area'] = 'Background color AJAX area';
$lang_plugin_enlargeit['center_enlarge_images'] = 'Center enlarged image';
$lang_plugin_enlargeit['darken_screen'] = 'Darken screen when enlarged';
$lang_plugin_enlargeit['darken_strength'] = 'Darken strength';
$lang_plugin_enlargeit['button_picture'] = 'Display button "Show picture"';
$lang_plugin_enlargeit['show_picture'] = 'Show picture'; // js-alert
$lang_plugin_enlargeit['button_info'] = 'Show button "Info"';
$lang_plugin_enlargeit['open_as_ajax'] = 'Open as AJAX snippet';
$lang_plugin_enlargeit['open_intermediate_page'] = 'Open "regular" intermediate page';
$lang_plugin_enlargeit['show_info'] = 'Show info'; // js-alert
$lang_plugin_enlargeit['button_download'] = 'Display "Download" button ';
$lang_plugin_enlargeit['download_this_file'] = 'Download this file'; // js-alert
$lang_plugin_enlargeit['download_explain'] = 'Click here to download this file';
$lang_plugin_enlargeit['button_favorites'] = 'Display "Favorites" button';
$lang_plugin_enlargeit['favorites'] = 'Favorites'; // js-alert
$lang_plugin_enlargeit['button_comments'] = 'Display "Comments" button';
$lang_plugin_enlargeit['comment'] = 'Comment';
$lang_plugin_enlargeit['button_histogram'] = 'Display "Histogram" button';
$lang_plugin_enlargeit['histogram'] = 'Histogram'; // js-alert
$lang_plugin_enlargeit['button_bbcode'] = 'Display "BBCode" button';
$lang_plugin_enlargeit['bbcode'] = 'BBCode'; // js-alert
$lang_plugin_enlargeit['button_vote'] = 'Display "Vote" button';
$lang_plugin_enlargeit['vote'] = 'Vote';
$lang_plugin_enlargeit['full_size'] = 'Full size'; // js-alert
$lang_plugin_enlargeit['for_registered_users_only'] = 'for registered users only';
$lang_plugin_enlargeit['as_popup_window'] = 'As pop-up window';
$lang_plugin_enlargeit['enl_maxpopupforreg'] = 'yes, as pop-up but not for anonymous users';
$lang_plugin_enlargeit['button_close'] = 'Display "Close" button';
$lang_plugin_enlargeit['close_esc'] = 'Close [Esc]'; // js-alert
$lang_plugin_enlargeit['button_navigation'] = 'Display "Navigation" buttons';
$lang_plugin_enlargeit['previous_left'] = 'Previous file [left arrow key]'; // js-alert
$lang_plugin_enlargeit['next_right'] = 'Next file [right arrow key]'; // js-alert
$lang_plugin_enlargeit['administrators'] = 'administrators';
$lang_plugin_enlargeit['registered_users'] = 'registered users';
$lang_plugin_enlargeit['guests'] = 'guests';
$lang_plugin_enlargeit['enable_sefurl_support'] = 'Enable SEF_URL support';
$lang_plugin_enlargeit['file_added_to_favorites'] = 'The file has been added to your favorites.';
$lang_plugin_enlargeit['file_removed_from_favorites'] = 'The file has been removed from your favorites.';
$lang_plugin_enlargeit['button_favorites'] = 'Show my favorites';
$lang_plugin_enlargeit['enable_drag_drop'] = 'Allow enlarged pictures to be moved around';
$lang_plugin_enlargeit['darkening_speed'] = 'Darkening speed';
$lang_plugin_enlargeit['no_comments'] = 'There are no comments yet, and you are not allowed to add one!';
$lang_plugin_enlargeit['mouse_wheel_navigation'] = 'Mouse wheel navigation';
$lang_plugin_enlargeit['cancel_loading'] = 'Click to cancel loading of this picture'; // js-alert
$lang_plugin_enlargeit['no_flash_found'] = 'To watch this file, you need the Adobe flash player as a browser plugin'; // js-alert
$lang_plugin_enlargeit['flash_player'] = 'Use which FLV player software';
$lang_plugin_enlargeit['copy_to_clipboard'] = 'Copy to clipboard';
$lang_plugin_enlargeit['transparency_for_glide'] = 'Transparency effect for glide animation';
$lang_plugin_enlargeit['marble'] = 'Marble';
$lang_plugin_enlargeit['metallight'] = 'Brushed Metal';
$lang_plugin_enlargeit['metalwhite'] = 'White Metal';
$lang_plugin_enlargeit['metalwhite2'] = 'White Metal 2';
$lang_plugin_enlargeit['metalblue'] = 'Blue Metal';
$lang_plugin_enlargeit['metalred'] = 'Red Metal';
$lang_plugin_enlargeit['metalgreen'] = 'Green Metal';
$lang_plugin_enlargeit['metalsilver'] = 'Silver Metal';
$lang_plugin_enlargeit['metalblack'] = 'Black Metal';
$lang_plugin_enlargeit['rain'] = 'Rain';
$lang_plugin_enlargeit['rainlight'] = 'Light Rain';
$lang_plugin_enlargeit['woodlight'] = 'Light Wood';
$lang_plugin_enlargeit['wooddark'] = 'Dark Wood';
$lang_plugin_enlargeit['paper'] = 'Paper';
$lang_plugin_enlargeit['leather'] = 'Leather';
$lang_plugin_enlargeit['green'] = 'Dark Green';
$lang_plugin_enlargeit['greenliquid'] = 'Green Liquid';
$lang_plugin_enlargeit['choc'] = 'Chocolate';
$lang_plugin_enlargeit['plugin_configuration'] = 'Plugin configuration';
$lang_plugin_enlargeit['enlargement_type'] = 'Enlargement type';
$lang_plugin_enlargeit['animation_type'] = 'Animation type';
$lang_plugin_enlargeit['milliseconds'] = 'Milliseconds';
$lang_plugin_enlargeit['zero_to_disable'] = '0 to disable';
$lang_plugin_enlargeit['border'] = 'Border';
$lang_plugin_enlargeit['toggle_color_picker'] = 'Toggle color picker';
$lang_plugin_enlargeit['mozilla_only'] = 'Mozilla/Safari only';
$lang_plugin_enlargeit['shadow'] = 'Shadow';
$lang_plugin_enlargeit['right_bottom'] = 'to the right and bottom';
$lang_plugin_enlargeit['title_bar'] = 'Title bar';
$lang_plugin_enlargeit['action'] = 'Action';
$lang_plugin_enlargeit['only_darken_when_image_shows'] = 'only darken when image shows';
$lang_plugin_enlargeit['remain_dark_when_using_navigation'] = 'remain dark when using navigation';
$lang_plugin_enlargeit['darkening_speed_explain'] = '1 = immediately dark, 20 = very slowly darkening';
$lang_plugin_enlargeit['buttons'] = 'Buttons';
$lang_plugin_enlargeit['not_implemented_yet'] = 'Not implemented yet';
$lang_plugin_enlargeit['for_all'] = 'for all (guests as well as registered users)';
$lang_plugin_enlargeit['enable_for'] = 'Enable for';
$lang_plugin_enlargeit['multimedia'] = 'Multimedia';
$lang_plugin_enlargeit['os_flv'] = 'OS FLV';
$lang_plugin_enlargeit['rphmedia'] = 'RphMedia';
$lang_plugin_enlargeit['no_changes'] = 'There have been no changes or the changes you applied were invalid.';
$lang_plugin_enlargeit['recommended'] = 'recommended';
$lang_plugin_enlargeit['not_recommended'] = 'not recommended';
$lang_plugin_enlargeit['description'] = 'AJAX GUI for Coppermine 1.5.x to seamlessly open the image embedded into the output on the thumbnail page, with an optional greybox feature and a detailed configuration screen.';
$lang_plugin_enlargeit['install_info'] = 'You can configure the plugin after installation using the button on the plugin manager or inside the admin menu (configurable). If you want ImageFlow or Slider plugins to use EnlargeIt!, install them together with this plugin and switch the settings on the config pages of those plugins.';
$lang_plugin_enlargeit['extra_info'] = 'This plugin is currently a beta version. Not all features may work, especially the AJAX parts. Thanks for understanding.';
$lang_plugin_enlargeit['announcement_thread'] = 'Announcement thread';
$lang_plugin_enlargeit['enlargeit_configuration'] = 'EnlargeIt! configuration';
$lang_plugin_enlargeit['plugin_setup'] = 'Plugin setup';
$lang_plugin_enlargeit['display_plugin_config_in_admin_menu'] = 'Display a link to the plugin configuration in the admin menu';
$lang_plugin_enlargeit['not_a_valid_extension'] = '%s is not a valid extension';
$lang_plugin_enlargeit['gd_version'] = 'GD version: %s';
$lang_plugin_enlargeit['not_available'] = 'not available';
$lang_plugin_enlargeit['file_cache_x_files_using_x_bytes'] = 'File cache: %s files using %s of web space';
$lang_plugin_enlargeit['histogram_cache_file_lifetime'] = 'Histogram cache file lifetime';
$lang_plugin_enlargeit['unlimited'] = 'unlimited';
$lang_plugin_enlargeit['days'] = 'days';
$lang_plugin_enlargeit['max_file_size_total'] = 'Maximum file size total';
$lang_plugin_enlargeit['maximize_method'] = 'Maximize method for full-size pics';
$lang_plugin_enlargeit['preview'] = 'Preview';
$lang_plugin_enlargeit['image_formats'] = 'Image formats';
$lang_plugin_enlargeit['video_formats'] = 'Video formats';
$lang_plugin_enlargeit['jpg'] = 'Joint Photography Experts Group graphics file format'; 
$lang_plugin_enlargeit['jpeg'] = 'Joint Photography Experts Group graphics file format'; 
$lang_plugin_enlargeit['jpe'] = 'Joint Photography Experts Group graphics file format'; 
$lang_plugin_enlargeit['png'] = 'Portable Network Graphics';
$lang_plugin_enlargeit['gif'] = 'Graphics Interchange Format';
$lang_plugin_enlargeit['bmp'] = 'BitMap Picture';
$lang_plugin_enlargeit['jpc'] = 'Japan PIC';
$lang_plugin_enlargeit['jp2'] = 'JPEG 2000 image'; 
$lang_plugin_enlargeit['jpx'] = 'JPEG 2000 image'; 
$lang_plugin_enlargeit['jb2'] = 'JBIG2 Bitmap Graphic'; 
$lang_plugin_enlargeit['swc'] = 'Flex Components Archive';
$lang_plugin_enlargeit['swf'] = 'Shockwave Flash';
$lang_plugin_enlargeit['ytb'] = 'YouTube Video';
$lang_plugin_enlargeit['dvx'] = 'DivX Video';
$lang_plugin_enlargeit['flv'] = 'Flash video file';
$lang_plugin_enlargeit['download'] = 'Download';
$lang_plugin_enlargeit['enlargeit_documentation'] = 'EnlargeIt! documentation';
$lang_plugin_enlargeit['shadow_color'] = 'Shadow color';
?>
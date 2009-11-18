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
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) { 
	die('Not in Coppermine...'); 
}
$lang_plugin_enlargeit['display_name'] = 'EnlargeIt! PlugIn';
$lang_plugin_enlargeit['update_success'] = 'Configuration has been updated successfully; your changes have been saved.';
$lang_plugin_enlargeit['main_title'] = 'EnlargeIt! PlugIn';
$lang_plugin_enlargeit['pluginmanager'] = 'Plugin Manager';
$lang_plugin_enlargeit['submit_button'] = 'Submit';
$lang_plugin_enlargeit['enl_pictype'] = 'Enlarge to pic in';
$lang_plugin_enlargeit['enl_normalsize'] = 'intermediate size';
$lang_plugin_enlargeit['enl_fullsize'] = 'full size';
$lang_plugin_enlargeit['enl_forcenormal'] = 'force intermediate size';
$lang_plugin_enlargeit['enl_ani'] = 'Animation';
$lang_plugin_enlargeit['noani'] = 'none';
$lang_plugin_enlargeit['fade'] = 'fade in/out';
$lang_plugin_enlargeit['glide'] = 'glide';
$lang_plugin_enlargeit['bumpglide'] = 'bump glide';
$lang_plugin_enlargeit['smoothglide'] = 'smooth glide';
$lang_plugin_enlargeit['expglide'] = 'hard glide';
$lang_plugin_enlargeit['topglide'] = 'glide from top';
$lang_plugin_enlargeit['leftglide'] = 'glide from left';
$lang_plugin_enlargeit['topleftglide'] = 'glide from top left';
$lang_plugin_enlargeit['enl_speed'] = 'Time between animation steps';
$lang_plugin_enlargeit['enl_maxstep'] = 'Animation steps';
$lang_plugin_enlargeit['enl_brdsize'] = 'Border width';
$lang_plugin_enlargeit['enl_brdbck'] = 'Border texture';
$lang_plugin_enlargeit['enl_brdcolor'] = 'Border color';
$lang_plugin_enlargeit['enl_brdround'] = 'Round border';
$lang_plugin_enlargeit['enl_shadowsize'] = 'Shadow size';
$lang_plugin_enlargeit['enl_shadowintens'] = 'Shadow opacity';
$lang_plugin_enlargeit['enl_titlebar'] = 'Show title bar when buttons are inactive';
$lang_plugin_enlargeit['enl_titletxtcol'] = 'Title bar text color';
$lang_plugin_enlargeit['enl_ajaxcolor'] = 'Background color AJAX area';
$lang_plugin_enlargeit['enl_center'] = 'Center enlarged image';
$lang_plugin_enlargeit['enl_dark'] = 'Darken screen when enlarged';
$lang_plugin_enlargeit['enl_darkprct'] = 'Darken strength';
$lang_plugin_enlargeit['enl_buttonpic'] = 'Display button \'Show picture\'';
$lang_plugin_enlargeit['enl_tooltippic'] = 'Show picture';
$lang_plugin_enlargeit['enl_buttoninfo'] = 'Show button \'Info\'';
$lang_plugin_enlargeit['enl_buttoninfoyes1'] = 'open as AJAX snippet';
$lang_plugin_enlargeit['enl_buttoninfoyes2'] = 'open "regular" intermediate page';
$lang_plugin_enlargeit['enl_tooltipinfo'] = 'Show info';
$lang_plugin_enlargeit['enl_buttondownload'] = 'Display \'Download\' button ';
$lang_plugin_enlargeit['enl_tooltipdownload'] = 'Download this file';
$lang_plugin_enlargeit['enl_clickdownload'] = 'Click here to download this file';
$lang_plugin_enlargeit['enl_buttonfav'] = 'Display \'Favorites\' button';
$lang_plugin_enlargeit['enl_tooltipfav'] = 'Favorites';
$lang_plugin_enlargeit['enl_buttoncomment'] = 'Display \'Comments\' button';
$lang_plugin_enlargeit['enl_tooltipcomment'] = 'Comment';
$lang_plugin_enlargeit['enl_buttonhist'] = 'Display \'Histogramm\' button';
$lang_plugin_enlargeit['enl_tooltiphist'] = 'Histogramm';
$lang_plugin_enlargeit['enl_buttonbbcode'] = 'Display \'BBCode\' button';
$lang_plugin_enlargeit['enl_tooltipbbcode'] = 'BBCode';
$lang_plugin_enlargeit['enl_buttonvote'] = 'Display \'Vote\' button';
$lang_plugin_enlargeit['enl_tooltipvote'] = 'Vote';
$lang_plugin_enlargeit['enl_buttonmax'] = 'Display \'Maximize\' button';
$lang_plugin_enlargeit['enl_tooltipmax'] = 'Full size';
$lang_plugin_enlargeit['enl_maxforreg'] = 'for registered users';
$lang_plugin_enlargeit['enl_maxpopup'] = 'as pop-up window';
$lang_plugin_enlargeit['enl_maxpopupforreg'] = 'yes, as pop-up but not for anonymous users';
$lang_plugin_enlargeit['enl_buttonclose'] = 'Display \'Close\' button';
$lang_plugin_enlargeit['enl_tooltipclose'] = 'Close [Esc]';
$lang_plugin_enlargeit['enl_buttonnav'] = 'Display \'Navigation\' buttons';
$lang_plugin_enlargeit['enl_tooltipprev'] = 'Previous pic [left arrow key]';
$lang_plugin_enlargeit['enl_tooltipnext'] = 'Next pic [right arrow key]';
$lang_plugin_enlargeit['enl_adminmode'] = 'administrators';
$lang_plugin_enlargeit['enl_registeredmode'] = 'registered users';
$lang_plugin_enlargeit['enl_guestmode'] = 'guests';
$lang_plugin_enlargeit['enl_sefmode'] = 'Enable SEF support';
$lang_plugin_enlargeit['enl_addedtofav'] = 'The picture has been added to your favorites.';
$lang_plugin_enlargeit['enl_removedfromfav'] = 'The picture has been removed from your favorites.';
$lang_plugin_enlargeit['enl_showfav'] = 'Show my favorites';
$lang_plugin_enlargeit['enl_dragdrop'] = 'Drag & drop of enlarged pictures';
$lang_plugin_enlargeit['enl_darkensteps'] = 'Darkening speed';
$lang_plugin_enlargeit['enl_cantcomment'] = 'There are no comments yet, and you are not allowed to add one!';
$lang_plugin_enlargeit['enl_wheelnav'] = 'Mouse wheel navigation';
$lang_plugin_enlargeit['enl_canceltext'] = 'Click to cancel loading of this picture';
$lang_plugin_enlargeit['enl_noflashfound'] = 'To watch this file, you need the Adobe flash player as a browser plugin';
$lang_plugin_enlargeit['enl_flvplayer'] = 'Use which FLV player software';
$lang_plugin_enlargeit['enl_copytoclipbrd'] = 'Copy to clipboard';
$lang_plugin_enlargeit['enl_opaglide'] = 'Transparency effect for glide animation';
$lang_plugin_enlargeit['marble'] = 'Marble';
$lang_plugin_enlargeit['brushed_metal'] = 'Brushed Metal';
$lang_plugin_enlargeit['white_metal'] = 'White Metal';
$lang_plugin_enlargeit['white_metal2'] = 'White Metal 2';
$lang_plugin_enlargeit['blue_metal'] = 'Blue Metal';
$lang_plugin_enlargeit['red_metal'] = 'Red Metal';
$lang_plugin_enlargeit['green_metal'] = 'Green Metal';
$lang_plugin_enlargeit['silver_metal'] = 'Silver Metal';
$lang_plugin_enlargeit['black_metal'] = 'Black Metal';
$lang_plugin_enlargeit['rain'] = 'Rain';
$lang_plugin_enlargeit['light_rain'] = 'Light Rain';
$lang_plugin_enlargeit['light_wood'] = 'Light Wood';
$lang_plugin_enlargeit['dark_wood'] = 'Dark Wood';
$lang_plugin_enlargeit['paper'] = 'Paper';
$lang_plugin_enlargeit['leather'] = 'Leather';
$lang_plugin_enlargeit['dark_green'] = 'Dark Green';
$lang_plugin_enlargeit['green_liquid'] = 'Green Liquid';
$lang_plugin_enlargeit['chocolate'] = 'Chocolate';
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
?>
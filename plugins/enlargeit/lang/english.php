<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_enlargeit = array(
'display_name' => 'EnlargeIt! PlugIn',
'update_success' => 'Values have been updated successfully',
'main_title' => 'EnlargeIt! PlugIn',
'version' => 'v2.15',
'pluginmanager' => 'Plugin Manager',
'enl_yes' => 'yes',
'enl_no' => 'no',
'submit_button' => 'Submit',
'enl_pictype' => 'Enlarge to pic in',
'enl_normalsize' => 'intermediate size',
'enl_fullsize' => 'full size',
'enl_forcenormal' => 'force intermediate size',
'enl_ani' => 'Animation',
'noani' => 'none',
'fade' => 'fade in/out',
'glide' => 'glide',
'bumpglide' => 'bump glide',
'smoothglide' => 'smooth glide',
'expglide' => 'hard glide',
'enl_speed' => 'Time between animation steps',
'enl_maxstep' => 'Animation steps',
'enl_brd' => 'Use border',
'enl_brdsize' => 'Border thickness',
'enl_brdbck' => 'Border texture',
'enl_brdcolor' => 'Border color',
'enl_brdround' => 'Round border (Mozilla/Safari only)',
'enl_shadow' => 'Use border shadow',
'enl_shadowsize' => 'Shadow size right/bottom',
'enl_shadowcolor' => 'Shadow color (usually black)',
'enl_shadowintens' => 'Shadow opacity',
'enl_titlebar' => 'Show title bar when no buttons active',
'enl_titletxtcol' => 'Title bar text color',
'enl_ajaxcolor' => 'Background color AJAX area',
'enl_center' => 'Center enlarged image',
'enl_dark' => 'Darken screen when enlarged (only 1 pic at a time)',
'enl_darkprct' => 'Darken strength',
'enl_buttonpic' => 'Show button \'Show picture\'',
'enl_tooltippic' => 'Show picture',
'enl_buttoninfo' => 'Show button \'Info\'',
'enl_buttoninfoyes1' => 'yes (open AJAX snippet)',
'enl_buttoninfoyes2' => 'yes (open intermediate page)',
'enl_tooltipinfo' => 'Show info',
'enl_buttonfav' => 'Show button \'Favorites\'',
'enl_tooltipfav' => 'Favorites',
'enl_buttoncomment' => 'Show button \'Comments\'',
'enl_tooltipcomment' => 'Comment',
'enl_buttondownload' => 'Show button \'Download\'',
'enl_tooltipdownload' => 'Download this file',
'enl_clickdownload' => 'Click here to download this file',
'enl_buttonhist' => 'Show button \'Histogram\'',
'enl_tooltiphist' => 'Histogram',
'enl_buttonbbcode' => 'Show button \'BBCode\'',
'enl_tooltipbbcode' => 'BBCode',
'enl_buttonecard' => 'Show button \'E-Card\'',
'enl_tooltipecard' => 'E-Card',
'enl_buttonvote' => 'Show button \'Vote\'',
'enl_tooltipvote' => 'Vote',
'enl_buttonmax' => 'Show button \'Maximize\'',
'enl_tooltipmax' => 'Full size',
'enl_maxforreg' => 'yes, but not for anonymous users',
'enl_maxpopup' => 'yes, as pop-up window',
'enl_maxpopupforreg' => 'yes, as pop-up but not for anonymous users',
'enl_buttonclose' => 'Show button \'Close\'',
'enl_tooltipclose' => 'Close [Esc]',
'enl_buttonnav' => 'Show buttons \'Navigation\'',
'enl_tooltipprev' => 'Previous pic [left arrow key]',
'enl_tooltipnext' => 'Next pic [right arrow key]',
'enl_adminmode' => 'Enable EnlargeIt! in admin mode',
'enl_registeredmode' => 'Enable EnlargeIt! for registered users',
'enl_guestmode' => 'Enable EnlargeIt! for guests',
'enl_sefmode' => 'Enable SEF support',
'enl_addedtofav' => 'The picture has been added to your favorites.',
'enl_removedfromfav' => 'The picture has been removed from your favorites.',
'enl_showfav' => 'Show my favorites',
'enl_dragdrop' => 'Drag & drop of enlarged pictures',
'enl_darkensteps' => 'Steps for darkening (1 = immediately)',
'enl_cantcomment' => 'There are no comments yet, and you are not allowed to add one!',
'enl_cantecard' => 'Sorry, you are not allowed to send eCards!',
'enl_wheelnav' => 'Mouse wheel navigation',
'enl_canceltext' => 'Click to cancel loading of this picture',
'enl_noflashfound' => 'To watch this file, you need the browser plugin Adobe Flash Player!',
'enl_flvplayer' => 'Use which FLV player software',
'enl_copytoclipbrd' => 'Copy to clipboard',
'enl_opaglide' => 'Transparency effect for glide animation',
'enl_mousecursors' => 'Use hourglass mouse cursors if browser supports it',
);
?>
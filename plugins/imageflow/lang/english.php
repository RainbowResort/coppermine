<?php
/**************************************************
  Coppermine 1.4.x Plugin - Imageflow $VERSION$=2.08
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_plugin_imageflow = array(
'imageflow_width'  => 'Width of Imageflow&nbsp;&nbsp;<br>(percent or absolute; examples: 800px, 50%)',
'imageflow_numberofpics' => 'Number of pics',
'imageflow_bgcolor' => 'Background color #',
'display_name' => 'Imageflow PlugIn',
'main_title' => 'Imageflow PlugIn',
'version' => 'v2.08',
'pluginmanager' => 'Plugin manager',
'imageflow_yes' => 'Yes',
'imageflow_no' => 'No',
'submit_button' => 'Submit',
'update_success' => 'The values have been changed correctly.',
'skipportrait' => 'Skip pics in portrait orientation',
'align' => 'Align',
'left' => 'left',
'center' => 'center',
'intable' => 'Theme has table based layout&nbsp;&nbsp;<br />(normally leave this active; certain themes may require No)',
'procent' => 'Generated reflexion images have&nbsp;&nbsp;<br />size of normal intermediate pics in percent (only relevant&nbsp;&nbsp;<br />if Imageflow width is set in %)',
'cache' => 'Cache generated reflexion pics (increases speed, but uses&nbsp;&nbsp;<br>additional webspace). Please finally set to yes AFTER&nbsp;&nbsp;<br>you found your personal percent size of normal pics (see above)',
'hardcore' => '!!!THESE ARE HARDCORE OPTIONS!!!&nbsp;&nbsp;<br>Please: Only change, if you know exactly what you\'re doing!',
'topcorrect' => 'Correct upper border of animation (value between -200 and 500)',
'loading' => 'Loading images',
'album' => 'Show pics from which meta album',
'standardtable' => 'Show Imageflow in standard table of the theme',
'useenlarge' => 'Use EnlargeIt!',
'enlani' => 'EnlargeIt! animation',
'noani' => 'no animation',
'fade' => 'fade in/out',
'glide' => 'glide',
'enlspeed' => 'EnlargeIt! time between animation steps',
'enlmaxstep' => 'EnlargeIt! number of animation steps',
'enlborder' => 'EnlargeIt! use border',
'enlbrdcolor' => 'EnlargeIt! border color',
'enlbrdsize' => 'EnlargeIt! border thickness',
'enlshowcap' => 'EnlargeIt! show caption',
'pictype' => 'Enlarge to pic in',
'imageflow_normalsize' => 'intermediate (normal) size',
'imageflow_fullsize' => 'full size',
'enlbrdshadow' => 'EnlargeIt! show drop shadow around border',
'enlshadowsize' => 'EnlargeIt! size of shadow right/bottom',
'enlshadowintens' => 'EnlargeIt! shadow intensity',
'bumpglide' => 'bump glide',
'enlargeoptions' => 'EnlargeIt! options',
'enlclosebtn' => 'EnlargeIt! use close button',
'enlcenter' => 'EnlargeIt! center enlarged pic in browser window',
'enldark' => 'EnlargeIt! darken screen when pic is enlarged',
);
?>
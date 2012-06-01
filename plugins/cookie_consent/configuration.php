<?php
/**************************************************
  Coppermine 1.5.x Plugin - Cookie consent
  *************************************************
  Copyright (c) 2012 eenemeenemuu
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

require "./plugins/cookie_consent/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/cookie_consent/lang/{$CONFIG['lang']}.php")) {
    require "./plugins/cookie_consent/lang/{$CONFIG['lang']}.php";
}

$name = 'Cookie consent';
$description = sprintf($lang_plugin_cookie_consent['description'], '<a href="http://eur-lex.europa.eu/LexUriServ/LexUriServ.do?uri=CELEX:32009L0136:EN:NOT" rel="external" class="external">Directive 2009/136/EC</a>');
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.0';
$plugin_cpg_version = array('min' => '1.5.22');
$extra_info = $install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,TODO.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_cookie_consent['announcement_thread'].'</a>';

?>
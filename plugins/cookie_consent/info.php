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

pageheader($lang_plugin_cookie_consent['name']);
starttable("100%", $lang_plugin_cookie_consent['name'], 2);
echo "<tr><td class=\"tableb\"><b>{$lang_plugin_cookie_consent['cookie_name']}</b></td><td class=\"tableb\" width=\"100%\"><b>{$lang_plugin_cookie_consent['used_for']}</b></td></tr>";
foreach ($plugin_cookie_consent_cookies as $key => $value) {
    echo "<tr><td class=\"tableb\">{$key}</td><td class=\"tableb\">{$value}</td></tr>";
}
endtable();
// TODO: add button "don't show message this session" -> add some parameter to url and use page_html to add it to all links & forms (does it work with JS redirections?) - only implement if it's possible to add that parameter to really every page call
pagefooter();

?>
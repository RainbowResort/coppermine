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

if ($superCage->post->keyExists('accept_cookies')) {
    setcookie($CONFIG['cookie_name'].'_cookies_allowed', true, time() + (CPG_WEEK*52), $CONFIG['cookie_path']);
}

header('Location: '.urldecode($superCage->get->getRaw('ref')));

?>
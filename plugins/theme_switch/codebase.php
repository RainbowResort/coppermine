<?php
/**************************************************
  Coppermine 1.5.x Plugin - Theme switch
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start', 'theme_switch_page_start');

function theme_switch_page_start() {
    global $CONFIG, $USER;

    $superCage = Inspekt::makeSuperCage();

    $mobile_browser = '0';
 
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($superCage->server->getRaw('HTTP_USER_AGENT')))) {
        $mobile_browser++;
    }

    if((strpos(strtolower($superCage->server->getRaw('HTTP_ACCEPT')),'application/vnd.wap.xhtml+xml')>0) or (($superCage->server->keyExists('HTTP_X_WAP_PROFILE') or $superCage->server->keyExists('HTTP_PROFILE')))) {
        $mobile_browser++;
    }

    $mobile_ua = strtolower(substr($superCage->server->getRaw('HTTP_USER_AGENT'),0,4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda','xda-');
     
    if(in_array($mobile_ua,$mobile_agents)) {
        $mobile_browser++;
    }

    if (strpos(strtolower($superCage->server->getRaw('ALL_HTTP'),'operamini')>0)) {
        $mobile_browser++;
    }

    if (strpos(strtolower($superCage->server->getRaw('HTTP_USER_AGENT')),' ppc;')>0) {
        $mobile_browser++;
    }

    if (strpos(strtolower($superCage->server->getRaw('HTTP_USER_AGENT')),'windows ce')>0) {
        $mobile_browser++;
    }
    else if (strpos(strtolower($superCage->server->getRaw('HTTP_USER_AGENT')),'windows')>0) {
        $mobile_browser=0;
    }

    if (strpos(strtolower($superCage->server->getRaw('HTTP_USER_AGENT')),'iemobile')>0) {
        $mobile_browser++;
    }

    if($mobile_browser == 0) {
        $mobile_browser_theme = 'water_drop';
        if (!$superCage->get->keyExists('theme') && $CONFIG['theme'] != $mobile_browser_theme) {
            $USER['theme'] = $mobile_browser_theme;
            user_save_profile();
            header('Location: '.$superCage->server->getRaw('REQUEST_URI'));
        }
    }

}

?>
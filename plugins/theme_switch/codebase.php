<?php
/**************************************************
  Coppermine 1.5.x Plugin - Theme switch
  *************************************************
  Copyright (c) 2010-2012 eenemeenemuu
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
    global $CONFIG, $USER, $CPG_PHP_SELF, $REFERER;

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

    if ($mobile_browser > 0) {
        define('MOBILE_BROWSER', TRUE);
        if (!$superCage->cookie->keyExists($CONFIG['TABLE_PREFIX'].'mobile_theme')) {
            define('MOBILE_VIEW', TRUE);
            if ($CONFIG['theme'] != $CONFIG['theme_switch_mobile_theme']) {
                $USER['theme'] = $CONFIG['theme_switch_mobile_theme'];
                user_save_profile();
                header('Location: '.$CPG_PHP_SELF); // TODO: add referer
            }
        }
    }

}


// TODO: find better location for button
$thisplugin->add_filter('admin_menu', 'theme_switch_admin_menu');

function theme_switch_admin_menu($html) {
    global $CONFIG;

    if (defined('MOBILE_BROWSER')) {
        if (defined('MOBILE_VIEW')) {
            $switch_button['text'] = 'Switch to normal view';
            $switch_button['href'] = 'normal';
        } else {
            $switch_button['text'] = 'Switch to mobile view';
            $switch_button['href'] = 'mobile';
        }

        if (stripos($CONFIG['theme'], 'curve') !== FALSE) {
            // one of the curve themes
            if ($html == '') {
                $html = '<ul class="dropmenu"></ul>';
            }
            if (stripos($html, '</ul>')) {
                $html = str_replace('</ul>', '<li><a href="index.php?file=theme_switch/'.$switch_button['href'].'" class="firstlevel"><span class="firstlevel">'.cpg_fetch_icon('web', 0).$switch_button['text'].'</span></a></li></ul>', $html);
            }
        } else {
            // other themes
            $html .= '<div class="admin_menu admin_float"><a href="index.php?file=theme_switch/'.$switch_button['href'].'">'.cpg_fetch_icon('web', 0).$switch_button['text'].'</a></div>';
        }
    }

    return $html;
}


$thisplugin->add_action('plugin_install', 'theme_switch_install');

function theme_switch_install () {
    global $CONFIG;
    cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value) VALUES ('theme_switch_mobile_theme', 'water_drop')");

    return true;
}


$thisplugin->add_action('plugin_uninstall', 'theme_switch_uninstall');

function theme_switch_uninstall () {
    global $CONFIG;
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'theme_switch_mobile_theme'");

    return true;
}

?>
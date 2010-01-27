<?php
/**
 * Coppermine Photo Gallery
 *
 * Copyright (c) 2003-2009 Coppermine Dev Team
 * v1.1 originally written by Gregory DEMAR
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Coppermine version: 1.4.25
 * reCAPTCHA Plugin ver 2.6
 * Based on Mod by Abbas ali(http://coppermine-gallery.net/forum/index.php?topic=29564.0)
 * Based on Plugin Writen by bmossavari at gmail dot com
 * Plugin Written by Joe Carver - http://gallery.josephcarver.com/natural/ - http://i-imagine.net
 *  22 January 2010
*/

//reCAPTCHA plugin Config file v2.6

// Add, edit your - user info + recaptcha style + recaptcha language in this file

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (file_exists("plugins/recaptcha/lang/{$CONFIG['lang']}.php")) {
  require "plugins/recaptcha/lang/{$CONFIG['lang']}.php";
} else {require "plugins/recaptcha/lang/english.php";}


$key_public = ($CONFIG['new_recaptcha_pubkey']);
$key_private = ($CONFIG['new_recaptcha_privkey']);



// OPTIONS TO CHANGE ARE BELOW HERE - EDIT ONLY AFTER INSTALLATION SUCCESS!!!

/* reCAPTCHA language display option

Default is en, options are: de, en, es, fr, nl, pt, ru, tr  

See API Guide http://recaptcha.net/apidocs/captcha/client.html */

$recapt_lang = 'en';


//reCAPTCHA theme options Plugin default is white, options are: blackglass, clean, red and white - See API guide 

$recapt_thme = 'white';



    /**
     * CAPTCHA Enable/Disable array
     *
     * Set which USER group should NOT see Captcha on each page
     * ''=> Captcha Enable for all users
     * Coppermine Standard Group Name:
     * Administrators,Registered,Guests,Banned
     * You can add your custom group names too
	 *
     * Separate by ','
	 *
	 * Default for login is OFF for ALL and  SHOULD NOT BE CHANGED
	 * UNTIL AFTER INSTALLATION OF PLUGIN
	 *
	 * Default for register makes little difference
     */

	    $CAPTCHA_DISABLE = array('login' => 'Guests',
        'register' => 'Administrators,Registered',
        'comment' => 'Administrators,Registered',
        'report' => 'Registered,Administrators',
        'ecard' => 'Registered,Administrators',
        );
 
?>
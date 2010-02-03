<?php
/**************************************************
  Coppermine 1.5.x Plugin - sef_urls
  *************************************************
  Copyright (c) 2003-2007 Coppermine Dev Team
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

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// Add plugin_install action
$thisplugin->add_action('plugin_install','sef_urls_install');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','sef_urls_uninstall');

// Add plugin_configure action
$thisplugin->add_action('plugin_configure','sef_urls_configure');

// Add plugin_cleanup action
$thisplugin->add_action('plugin_cleanup','sef_urls_cleanup');

// Add page_html filter
$thisplugin->add_filter('page_html','sef_urls_convert');


/**
 * Convert urls to search-engine friendly (SEF) urls
 */
function sef_urls_convert($html) {
    
    $sef_language = 'english';
    
    // Language translation
    if ($sef_language == 'german')
    {
        $str_thumbnails = 'uebersicht';
        $str_displayimage = 'bild';
        $str_toprated = 'beste';
        $str_topn = 'beliebteste';
        $str_lastcomby = 'kommentiertvon';
        $str_lastcom = 'kommentierte';
        $str_page = 'seite';
        $str_profile = 'benutzer';
        $str_lastupby = 'neuestevon';
        $str_lastup = 'neueste';
        $str_search = 'suche';
        $str_contact = 'kontakt';
        $str_tdm = 'oben';
        $str_usermgr = 'benutzerliste';
    }
    else
    {
        $str_thumbnails = 'thumbnails';
        $str_displayimage = 'displayimage';
        $str_toprated = 'toprated';
        $str_topn = 'topn';
        $str_lastcomby = 'lastcomby';
        $str_lastcom = 'lastcom';
        $str_page = 'page';
        $str_profile = 'profile';
        $str_lastupby = 'lastupby';
        $str_lastup = 'lastup';
        $str_search = 'search';
        $str_contact = 'contact';
        $str_tdm = 'top_display_media';
        $str_usermgr = 'usermgr';
    }

    // Rewrite usermgr.php
    $html = preg_replace('/usermgr\.php\?page=([0-9]+)/i',$str_usermgr.'-'.$str_page.'-$1.html',$html);
    $html = preg_replace('/usermgr\.php/i',$str_usermgr.'.html',$html);

    // Rewrite index.php
    $html = preg_replace('/index\.php\?cat=([0-9]+)(\&|\&amp;)page=([0-9]+)/i','index-$1-'.$str_page.'-$3.html',$html);
    $html = preg_replace('/index\.php\?cat=0/i','/index.html',$html);
    $html = preg_replace('/index\.php\?cat=([0-9]+)/i','index-$1.html',$html);
    $html = preg_replace('/index\.php/i','/index.html',$html);
    
    // Rewrite thumbnails.php
    $html = preg_replace('/thumbnails\.php\?album=lastupby(\&|\&amp;)uid=([0-9]+)/i',$str_thumbnails.'-'.$str_lastupby.'-$2.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=lastcomby(\&|\&amp;)uid=([0-9]+)/i',$str_thumbnails.'-'.$str_lastcomby.'-$2.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=([a-z0-9]+)(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)page=([0-9]+)/i',$str_thumbnails.'-$1-$3-'.$str_page.'-$5.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=([a-z0-9]+)(\&|\&amp;)cat=([\-0-9]+)/i',$str_thumbnails.'-$1-$3.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=([a-z0-9]+)(\&|\&amp;)page=([0-9]+)/i',$str_thumbnails.'-$1-'.$str_page.'-$3.html',$html);
    $html = preg_replace('/thumbnails\.php\?search=([^"]+)(\&|\&amp;)album=search/i',$str_thumbnails.'-'.$str_search.'-$1.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=search(\&|\&amp;)search=([^"]+)/i',$str_thumbnails.'-'.$str_search.'-$2.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=([a-z0-9]+)/i',$str_thumbnails.'-$1.html',$html);

    // Rewrite displayimage.php
    $html = preg_replace('/displayimage\.php\?album=lastcom(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)pid=([\-0-9]+)(\&|\&amp;)msg_id=([\-0-9]+)(\&|\&amp;)page=([\-0-9]+)/i',$str_displayimage.'-lastcom-$2-$4-$6-'.$str_page.'-$8.html',$html);
    $html = preg_replace('/displayimage\.php\?album=lastcomby(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)pid=([\-0-9]+)(\&|\&amp;)uid=([\-0-9]+)(\&|\&amp;)msg_id=([\-0-9]+)(\&|\&amp;)page=([\-0-9]+)/i',$str_displayimage.'-'.$str_lastcomby.'-$2-$4-$6-$8-$10.html',$html);
    $html = preg_replace('/displayimage\.php\?album=lastupby(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)pid=([\-0-9]+)(\&|\&amp;)uid=([\-0-9]+)/i',$str_displayimage.'-'.$str_lastupby.'-$2-$4-$6.html',$html);
    $html = preg_replace('/displayimage\.php\?album=([a-z0-9]+)(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)pid=([\-0-9]+)/i',$str_displayimage.'-$1-$3-$5.html',$html);
    $html = preg_replace('/displayimage\.php\?album=search(\&|\&amp;)pid=([\-0-9]+)/i',$str_displayimage.'-'.$str_search.'-$2.html',$html);
    $html = preg_replace('/displayimage\.php\?album=([a-z0-9]+)(\&|\&amp;)pid=([\-0-9]+)/i',$str_displayimage.'-$1-$3.html',$html);
    $html = preg_replace('/displayimage\.php\?pid=([0-9]+)/i',$str_displayimage.'-$1.html',$html);
    
    // Rewrite profile.php
    $html = preg_replace('/profile\.php\?uid=([0-9]+)/i',$str_profile.'-$1.html',$html);
    $html = preg_replace('/profile\.php\?op=([a-z0-9_]+)/i',$str_profile.'-op-$1.html',$html);
    
    // language specific replacements
    if ($sef_language != 'english')
    { 
        $html = preg_replace('/-toprated/i','-'.$str_toprated,$html);
        $html = preg_replace('/-topn/i','-'.$str_topn,$html);
        $html = preg_replace('/-lastcom/i','-'.$str_lastcom,$html);
        $html = preg_replace('/-lastup/i','-'.$str_lastup,$html);
        $html = preg_replace('/top_display_media/i',$str_tdm,$html);
        $html = preg_replace('/'.$str_displayimage.'-search-/i',$str_displayimage.'-'.$str_search.'-',$html);
    }
    
    // contact and search.php
    $html = preg_replace('/contact.php/i',$str_contact.'.html',$html);
    $html = preg_replace('/search.php/i',$str_search.'.html',$html);
    
    // albums in cat=0
    $html = preg_replace('/'.$str_thumbnails.'-([a-z0-9]+)-0\.html/i',$str_thumbnails.'-$1.html',$html);
    
    // Return modified HTML
    return $html;
}


/**
 * Configure plugin for install
 */
function sef_urls_configure($action) {
    global $thisplugin;

    if ($action===1) {
        $code = implode('',file($thisplugin->fullpath.'/ht.txt'));
        echo <<< EOT
    <form name="cpgform" id="cpgform" action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            You already have a .htaccess file in your root Coppermine folder.<br />
            Is it ok to overwrite it?
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="create" value="1" /></td>
                <td>Yes</td>
            </tr>
            <tr>
                <td><input type="radio" name="create" checked="checked" value="0" /></td>
                <td>No</td>
            </tr>
        </table>
        </div>
        <span>
           <input type="submit" name="submit" value="Submit" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="Cancel" />
        </span>

        <p>&nbsp;</p>

        <p style="color:red;font-weight:bold;">STOP! READ THE FOLLOWING!</p>

        <p>
            If you don't want your .htaccess file to be overwritten, you'll have to insert the following code:
        </p>

        <div align="right">
            <a class="link" href="{$thisplugin->fullpath}/ht.txt" target="_blank">Open in a seperate window</a>
        </div>
        <pre style="border:1;border-color:black;background-color:white;font-family:fixedsys;">
            $code
        </pre>
    </form>
EOT;
    }
}


/**
 * Display cleanup options for uninstall
 */
function sef_urls_cleanup($action) {
    if ($action===1) {
        echo <<< EOT
    <form name="cpgform" id="cpgform" action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            Delete the .htaccess file in your Coppermine root? (If this file was created by this plugin,
            It's ok to delete it.)
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="delete" value="1" /></td>
                <td>Yes</td>
            </tr>
            <tr>
                <td><input type="radio" name="delete" checked="checked" value="0" /></td>
                <td>No</td>
            </tr>
        </table>
        </div>
        <span>
           <input type="submit" name="submit" value="Submit" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="Cancel" />
        </span>
    </form>
EOT;
    }
}


/**
 * Install the plugin'
 */
function sef_urls_install() {
    global $thisplugin;
    $sef_language = 'english';
    $sef_superCage = Inspekt::makeSuperCage();
    if ($sef_superCage->post->keyExists('create')) 
    {
      $create = $sef_superCage->post->getInt('create');
    }
      

    // There's no .htaccess file or user has clicked 'yes' on the create form
    if (!file_exists('.htaccess') || $create) {
        copy($thisplugin->fullpath.'/ht-'.$sef_language.'.txt','.htaccess');
        return true;

    // An htaccess file exists; display the configure form
    } elseif (!isset($create)) {
        return 1;

    // User has clicked 'no' on the configure form. Install plugin. Don't create .htaccess file
    } else {
        return true;
    }
}


/**
 * Uninstall the plugin
 */
function sef_urls_uninstall() {
    global $thisplugin;

    $sef_superCage = Inspekt::makeSuperCage();
    if ($sef_superCage->post->keyExists('delete')) 
    {
      $delete = $sef_superCage->post->getInt('delete');
    }

    // There's an .htaccess file and user has clicked 'yes' on the cleanup form; delete the .htaccess file
    if (file_exists('.htaccess') && $delete) {
        unlink('.htaccess');
        return true;

    // An .htaccess file exists; display the cleanup form
    } elseif (file_exists('.htaccess') && !isset($delete)) {
        return 1;

    // User has clicked 'no' on the cleanup form. Uninstall plugin. Don't delete '.htaccess' file
    } else {
        return true;
    }
}
?>
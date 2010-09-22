<?php
/**************************************************
  Coppermine 1.5.x Plugin - sef_urls
  *************************************************
  Copyright (c) 2003-2010 Coppermine Dev Team
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

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

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
 * Convert urls to search-engine friendly (SEF) and speaking urls
 */
function sef_urls_convert($html) {
    global $CONFIG;
    
    // Configure here
    $sef_language              = 'english';  // set to english, german, french, italian or spanish
    $speakingpic_placeholder   = '-9b6o4';  // set to '' (empty string) to disable speaking URL functionality for files
    $speakingalbum_placeholder = '-65o4c';  // set to '' (empty string) to disable speaking URL functionality for albums
    $speakinguser_placeholder  = '-89occ';  // set to '' (empty string) to disable speaking URL functionality for users
    $number_of_url_chars       = 42;        // max number of chars in speaking URL functionality
    
    // Language translation
    if ($sef_language == 'german') {
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
        $str_tdm = '#oben';
        $str_usermgr = 'benutzerliste';
    } elseif ($sef_language == 'french') {
        $str_thumbnails = 'apercu';
        $str_displayimage = 'photo';
        $str_toprated = 'tresbien';
        $str_topn = 'populaire';
        $str_lastcomby = 'comentairede';
        $str_lastcom = 'comentaire';
        $str_page = 'page';
        $str_profile = 'client';
        $str_lastupby = 'neuvede';
        $str_lastup = 'neuve';
        $str_search = 'recherche';
        $str_contact = 'contacter';
        $str_tdm = '#enhaut';
        $str_usermgr = 'fichierclient';
    } elseif ($sef_language == 'spanish') {
        $str_thumbnails = 'resumen';
        $str_displayimage = 'cromo';
        $str_toprated = 'mejor';
        $str_topn = 'querido';
        $str_lastcomby = 'comentarde';
        $str_lastcom = 'comentar';
        $str_page = 'pagina';
        $str_profile = 'usuario';
        $str_lastupby = 'nuevode';
        $str_lastup = 'nuevo';
        $str_search = 'busca';
        $str_contact = 'contacto';
        $str_tdm = '#alto';
        $str_usermgr = 'usuariolistado';
    } elseif ($sef_language == 'italian') {
        $str_thumbnails = 'miniature';
        $str_displayimage = 'mostra';
        $str_toprated = 'migliore';
        $str_topn = 'popolari';
        $str_lastcomby = 'osservazionedi';
        $str_lastcom = 'osservazione';
        $str_page = 'pagina';
        $str_profile = 'profilo';
        $str_lastupby = 'novitadi';
        $str_lastup = 'novita';
        $str_search = 'cerca';
        $str_contact = 'contacto';
        $str_tdm = '#inalto';
        $str_usermgr = 'listautenti';
    } elseif ($sef_language == 'swedish') {
        $str_thumbnails = 'miniatyrer';
        $str_displayimage = 'bild';
        $str_toprated = 'topplista';
        $str_topn = 'mestvisade';
        $str_lastcomby = 'kommenteradeav';
        $str_lastcom = 'kommenterade';
        $str_page = 'sida';
        $str_profile = 'anvaendare';
        $str_lastupby = 'senasteav';
        $str_lastup = 'senaste';
        $str_search = 'soek';
        $str_contact = 'kontakt';
        $str_tdm = 'upp';
        $str_usermgr = 'anvaendarlista';
    } else {
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
        $str_tdm = '#top_display_media';
        $str_usermgr = 'usermgr';
    }

    // Rewrite usermgr.php
    $html = preg_replace('/usermgr\.php\?page=([0-9]+)/i',$str_usermgr.'-'.$str_page.'-$1.html',$html);
    $html = str_replace('usermgr.php',$str_usermgr.'.html',$html);

    // Rewrite index.php
    $html = preg_replace('/index\.php\?cat=([0-9]+)(\&|\&amp;)page=([0-9]+)/i','index-$1-'.$str_page.'-$3.html',$html);
    $html = preg_replace('/index\.php\?cat=0/i','index.html',$html);
    $html = preg_replace('/index\.php\?cat=([0-9]+)/i','index-$1.html',$html);
    $html = str_replace('index.php','index.html',$html);
    
    // Rewrite thumbnails.php
    $html = preg_replace('/thumbnails\.php\?album=lastupby(\&|\&amp;)uid=([0-9]+)/i',$str_thumbnails.'-'.$str_lastupby.'-$2.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=lastcomby(\&|\&amp;)uid=([0-9]+)/i',$str_thumbnails.'-'.$str_lastcomby.'-$2.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=([a-z0-9]+)(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)page=([0-9]+)/i',$str_thumbnails.'-$1-$3-'.$str_page.'-$5.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=([a-z0-9]+)(\&|\&amp;)cat=([\-0-9]+)/i',$str_thumbnails.'-$1-$3.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=([a-z0-9]+)(\&|\&amp;)page=([0-9]+)/i',$str_thumbnails.'-'.$str_page.'-$3-$1'.$speakingalbum_placeholder.'.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=search(\&|\&amp;)keywords=on(\&|\&amp;)search=([^"]+)/i',$str_thumbnails.'-'.$str_search.'-keyword-$3.html',$html);
    $html = preg_replace('/thumbnails\.php\?search=([^"]+)(\&|\&amp;)album=search/i',$str_thumbnails.'-'.$str_search.'-$1.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=search(\&|\&amp;)search=([^"]+)/i',$str_thumbnails.'-'.$str_search.'-$2.html',$html);
    $html = str_replace('thumbnails.php?album=favpics',$str_thumbnails.'-favpics.html',$html);
    $html = preg_replace('/thumbnails\.php\?album=([a-z0-9]+)/i',$str_thumbnails.'-$1'.$speakingalbum_placeholder.'.html',$html);

    // Rewrite displayimage.php
    $html = preg_replace('/displayimage\.php\?album=lastcom(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)pid=([\-0-9]+)(\&|\&amp;)msg_id=([\-0-9]+)(\&|\&amp;)page=([\-0-9]+)/i',$str_displayimage.'-lastcom-$2-$4-$6-'.$str_page.'-$8.html',$html);
    $html = preg_replace('/displayimage\.php\?album=lastcomby(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)pid=([\-0-9]+)(\&|\&amp;)uid=([\-0-9]+)(\&|\&amp;)msg_id=([\-0-9]+)(\&|\&amp;)page=([\-0-9]+)/i',$str_displayimage.'-'.$str_lastcomby.'-$2-$4-$6-$8-$10.html',$html);
    $html = preg_replace('/displayimage\.php\?album=lastupby(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)pid=([\-0-9]+)(\&|\&amp;)uid=([\-0-9]+)/i',$str_displayimage.'-'.$str_lastupby.'-$2-$4-$6.html',$html);
    $html = preg_replace('/displayimage\.php\?album=([a-z0-9]+)(\&|\&amp;)cat=([\-0-9]+)(\&|\&amp;)pid=([\-0-9]+)/i',$str_displayimage.'-$1-$3-$5'.$speakingpic_placeholder.'.html',$html);
    $html = preg_replace('/displayimage\.php\?album=search(\&|\&amp;)pid=([\-0-9]+)/i',$str_displayimage.'-'.$str_search.'-$2'.$speakingpic_placeholder.'.html',$html);
    $html = preg_replace('/displayimage\.php\?album=([a-z0-9]+)(\&|\&amp;)pid=([\-0-9]+)/i',$str_displayimage.'-$1-$3'.$speakingpic_placeholder.'.html',$html);
    $html = preg_replace('/displayimage\.php\?pid=([0-9]+)/i',$str_displayimage.'-$1'.$speakingpic_placeholder.'.html',$html);

    // Rewrite profile.php
    $html = preg_replace('/profile\.php\?uid=([0-9]+)/i',$str_profile.'-$1'.$speakinguser_placeholder.'.html',$html);
    $html = preg_replace('/profile\.php\?op=([a-z0-9_]+)/i',$str_profile.'-op-$1.html',$html);

    
    // speaking URL functionality for files
    if ($speakingpic_placeholder)
    {
        $searchstring = "#-([0-9]+)".$speakingpic_placeholder."#i";
        preg_match_all($searchstring, $html, $foundit, PREG_SET_ORDER);
        foreach($foundit as $nexturl) 
        {
            $current_picid = $nexturl[1];
            $titles_result = cpg_db_query("SELECT filename, title FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = $current_picid LIMIT 1");
            $the_pic = mysql_fetch_array($titles_result);
            mysql_free_result($titles_result);
            if ($the_pic['title']) $urlname = $the_pic['title'];
            else $urlname = $the_pic['filename'];
            $urlname = str_replace(' ','_',$urlname);
            $urlname = str_replace('.','_',$urlname);
            $urlname = str_replace('-','_',$urlname);
            $urlname = rawurlencode($urlname);
            if ($sef_language == 'german')
            {
              $urlname = str_replace('%C3%B6','oe',$urlname);
              $urlname = str_replace('%C3%BC','ue',$urlname);
              $urlname = str_replace('%C3%9F','ss',$urlname);
              $urlname = str_replace('%C3%A4','ae',$urlname);
              $urlname = str_replace('%C3%9C','Ue',$urlname);
              $urlname = str_replace('%C3%84','Ae',$urlname);
              $urlname = str_replace('%C3%96','Oe',$urlname);
            }
            $urlname = str_replace('%26quot%3B','',$urlname);
            $urlname = str_replace('%26%23039%3B','',$urlname);
            $urlname = preg_replace('/%[A-Za-z0-9]{2}/', '', $urlname);
            $urlname = '_'.$urlname.'_';
            while (stristr($urlname, '__'))
            {
                $urlname=(str_replace("__", "_", $urlname));
            }
            $html = str_replace($nexturl[0],'-'.$nexturl[1].'-'.substr($urlname,0,$number_of_url_chars),$html);
        }
    }

    // speaking URL functionality for albums
    if ($speakingalbum_placeholder)
    {
        $searchstring = "#-([0-9]+)".$speakingalbum_placeholder."#i";
        preg_match_all($searchstring, $html, $foundit, PREG_SET_ORDER);
        foreach($foundit as $nexturl) 
        {
            $current_albid = $nexturl[1];
            $titles_result = cpg_db_query("SELECT title FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = $current_albid LIMIT 1");
            $the_alb = mysql_fetch_array($titles_result);
            mysql_free_result($titles_result);
            $urlname = $the_alb['title'];
            $urlname = str_replace(' ','_',$urlname);
            $urlname = str_replace('.','_',$urlname);
            $urlname = str_replace('-','_',$urlname);
            $urlname = rawurlencode($urlname);
            if ($sef_language == 'german')
            {
              $urlname = str_replace('%C3%B6','oe',$urlname);
              $urlname = str_replace('%C3%BC','ue',$urlname);
              $urlname = str_replace('%C3%9F','ss',$urlname);
              $urlname = str_replace('%C3%A4','ae',$urlname);
              $urlname = str_replace('%C3%9C','Ue',$urlname);
              $urlname = str_replace('%C3%84','Ae',$urlname);
              $urlname = str_replace('%C3%96','Oe',$urlname);
            }
            $urlname = str_replace('%26quot%3B','',$urlname);
            $urlname = str_replace('%26%23039%3B','',$urlname);
            $urlname = preg_replace('/%[A-Za-z0-9]{2}/', '', $urlname);
            $urlname = '_'.$urlname.'_';
            while (stristr($urlname, '__'))
            {
                $urlname=(str_replace("__", "_", $urlname));
            }
            $html = str_replace($nexturl[0],'-'.$nexturl[1].'-'.substr($urlname,0,$number_of_url_chars),$html);
        }
    }

    // speaking URL functionality for users
    if ($speakinguser_placeholder)
    {
        $searchstring = "#-([0-9]+)".$speakinguser_placeholder."#i";
        preg_match_all($searchstring, $html, $foundit, PREG_SET_ORDER);
        foreach($foundit as $nexturl) 
        {
            $current_userid = $nexturl[1];
            $titles_result = cpg_db_query("SELECT user_name FROM {$CONFIG['TABLE_USERS']} WHERE user_id = $current_userid LIMIT 1");
            $the_user = mysql_fetch_array($titles_result);
            mysql_free_result($titles_result);
            $urlname = $the_user['user_name'];
            $urlname = str_replace(' ','_',$urlname);
            $urlname = str_replace('.','_',$urlname);
            $urlname = str_replace('-','_',$urlname);
            $urlname = rawurlencode($urlname);
            if ($sef_language == 'german')
            {
              $urlname = str_replace('%C3%B6','oe',$urlname);
              $urlname = str_replace('%C3%BC','ue',$urlname);
              $urlname = str_replace('%C3%9F','ss',$urlname);
              $urlname = str_replace('%C3%A4','ae',$urlname);
              $urlname = str_replace('%C3%9C','Ue',$urlname);
              $urlname = str_replace('%C3%84','Ae',$urlname);
              $urlname = str_replace('%C3%96','Oe',$urlname);
            }
            $urlname = str_replace('%26quot%3B','',$urlname);
            $urlname = str_replace('%26%23039%3B','',$urlname);
            $urlname = preg_replace('/%[A-Za-z0-9]{2}/', '', $urlname);
            $urlname = '_'.$urlname.'_';
            while (stristr($urlname, '__'))
            {
                $urlname=(str_replace("__", "_", $urlname));
            }
            $html = str_replace($nexturl[0],'-'.$nexturl[1].'-'.substr($urlname,0,$number_of_url_chars),$html);
        }
    }
    
    // language specific replacements
    if ($sef_language != 'english')
    { 
        $html = str_replace('-toprated','-'.$str_toprated,$html);
        $html = str_replace('-topn','-'.$str_topn,$html);
        $html = str_replace('-lastcom','-'.$str_lastcom,$html);
        $html = str_replace('-lastup','-'.$str_lastup,$html);
        $html = str_replace('#top_display_media',$str_tdm,$html);
        $html = str_replace($str_displayimage.'-search-',$str_displayimage.'-'.$str_search.'-',$html);
    }
    
    // contact and search.php
    $html = str_replace('contact.php',$str_contact.'.html',$html);
    $html = str_replace('search.php',$str_search.'.html',$html);
    
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
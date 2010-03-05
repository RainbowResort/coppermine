<?php
/*********************************************
  Coppermine 1.4 Plugin - Easy RSS
  ********************************************
  Copyright (c) 2007 Brent Gerig

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','easyrss_install');
$thisplugin->add_action('plugin_configure','easyrss_configure');
$thisplugin->add_action('plugin_uninstall','easyrss_uninstall');
$thisplugin->add_action('plugin_cleanup','easyrss_cleanup');
$thisplugin->add_filter('page_meta','easyrss_header');
$thisplugin->add_filter('gallery_footer','easyrss_footer');

function easyrss_install() {
    global $CONFIG, $lang_plugin_easyrss_config;
    require ('plugins/easy_rss/include/init.inc.php');

    if($_POST['submit'] == $lang_plugin_easyrss_config['button_install']) {

        // delete previous plugin config options if necessary (just in case)
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name REGEXP '^plugin_easyrss_'");

        $title = "title";
        switch($_POST['title'])
        {
            case "filename":
                $title = "filename";
                break;
            case "caption":
                $title = "caption";
                break;
            case "title":
            default:
                $title = "title";
                break;
        }

	if(!isset($_POST['num']) || !is_numeric($_POST['num']))
	    $num = 10;
	else
	    $num = $_POST['num'];

	$show_meta = 0;
	$show_rss = 0;
	$show_google = 0;
	$show_yahoo = 0;

	if(isset($_POST['show'])) {
	    $show = $_POST['show'];
	    if(in_array("meta",$show))
	        $show_meta = 1;
            if(in_array("rss",$show))
	        $show_rss = 1;
	    if(in_array("google",$show))
	        $show_google = 1;
	    if(in_array("yahoo",$show))
	        $show_yahoo = 1;
	}

        $sql = "INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value)"
                    ." VALUES"
                    ." ('plugin_easyrss_titlefield','$title')"
		    .",('plugin_easyrss_num','$num')"
		    .",('plugin_easyrss_showmeta','$show_meta')"
		    .",('plugin_easyrss_showrss','$show_rss')"
		    .",('plugin_easyrss_showgoogle','$show_google')"
		    .",('plugin_easyrss_showyahoo','$show_yahoo')";
        cpg_db_query($sql);

	if(!file_exists("rss.php"))
	    copy("plugins/easy_rss/rss.php","rss.php");

        return true;
    } else {
        return 1;
    }
}

function easyrss_configure() {
    global $lang_plugin_easyrss, $lang_plugin_easyrss_config;
    require ('plugins/easy_rss/include/init.inc.php');

    echo <<< EOT
    {$lang_plugin_easyrss_config['question_title']}<br />
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <input type="radio" name="title" value="title" checked>{$lang_plugin_easyrss['label_title']}<br />
        <input type="radio" name="title" value="caption">{$lang_plugin_easyrss['label_caption']}<br />
        <input type="radio" name="title" value="filename">{$lang_plugin_easyrss['label_filename']}<br /><br />
	{$lang_plugin_easyrss_config['question_num']}
	<input type="text" name="num" size="3" value="10"><br /><br />
	{$lang_plugin_easyrss_config['question_show']}<br />
	<input type="checkbox" name="show[]" value="meta" checked> {$lang_plugin_easyrss_config['show_meta']}<br />
	<input type="checkbox" name="show[]" value="rss" checked> {$lang_plugin_easyrss_config['show_rss']}<br />
	<input type="checkbox" name="show[]" value="google" checked> {$lang_plugin_easyrss_config['show_google']}<br />
	<input type="checkbox" name="show[]" value="yahoo" checked> {$lang_plugin_easyrss_config['show_yahoo']}<br /><br />
        <input type="submit" name="submit" value="{$lang_plugin_easyrss_config['button_install']}" />
	<input type="button" name="cancel" onclick="window.location='pluginmgr.php';" value="{$lang_plugin_easyrss_config['button_cancel']}" />
    </form>
EOT;
}

function easyrss_uninstall() {
    global $CONFIG;

    if (!isset($_POST['remove'])) return 1;

    if ($_POST['remove']) {
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name REGEXP '^plugin_easyrss_'");
        unlink("rss.php");
    }

    return true;
}

function easyrss_cleanup($action) {
    global $lang_plugin_customhome_config;
    require ('plugins/easy_rss/include/init.inc.php');

    if ($action === 1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            {$lang_plugin_easyrss_config['cleanup_question']}<br />
            <font color="red">{$lang_plugin_easyrss_config['cleanup_note']}</font>
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="remove" value="1" /></td>
                <td>{$lang_plugin_easyrss_config['yes']}</td>
            </tr>
            <tr>
                <td><input type="radio" name="remove" checked="checked" value="0" /></td>
                <td>{$lang_plugin_easyrss_config['no']}</td>
            </tr>
        </table>
        </div>
        <br />
        <span>
           <input type="submit" name="submit" value="{$lang_plugin_easyrss_config['button_submit']}" />
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="{$lang_plugin_easyrss_config['button_cancel']}" />
        </span>
    </form>
EOT;
    }
}

function easyrss_header() {
    global $CONFIG,$lang_plugin_easyrss;
    require ('plugins/easy_rss/include/init.inc.php');

    if($CONFIG['plugin_easyrss_showmeta'] && 
                in_array($_SERVER[SCRIPT_NAME],array('index.php','thumbnails.php','displayimage.php'))) {
        global $CONFIG;
        $album=$_GET['album'];
        $cat=$_GET['cat'];

	$name = "";
	if(is_numeric($album)) {
	    $name = get_album_name($album);
	    $name = $CONFIG[gallery_name]. " - " . $name['title'];
	} else if(isset($cat) && $cat > 0) {
		if($cat<10000) {
		    $name = easyrss_get_cat_name($cat);
		    $name = $CONFIG[gallery_name]. " - " . $name['name'];
		} else {
		    $name = $CONFIG[gallery_name]. " - " . get_username($cat-10000);
		}
	} else if(isset($cat) && $cat < 0) {
		$name = get_album_name(-$cat);
		$name = $CONFIG[gallery_name]. " - " . $name['name'];
	} else
	    $name = $CONFIG[gallery_name];
    
        $html = '<link rel="alternate" type="application/rss+xml" ';
        $html .= 'title="'.$name.' - '.$lang_plugin_easyrss['last_additions'].'"';
        $html .= ' href="'.$CONFIG[ecards_more_pic_target].'rss.php';
        if($album)
            $html .= "?album=".$album;
	else
		$html .= "?album=lastup";
        if($cat)
            if($cat > 10000)
    	    $html .= "?album=lastupby&uid=".($cat-10000);
    	else
                $html .= "&cat=".$cat;
        $html .="\" />";

        return $html;
    }
}

function easyrss_footer($html) {
    global $CONFIG,$lang_plugin_easyrss;
    require ('plugins/easy_rss/include/init.inc.php');

    if(($CONFIG['plugin_easyrss_showrss'] || $CONFIG['plugin_easyrss_showgoogle']) &&
                in_array($_SERVER[SCRIPT_NAME],array('index.php','thumbnails.php','displayimage.php'))) {
        global $CONFIG;
        $album=$_GET['album'];
        $cat=$_GET['cat'];

	$feed = str_replace("http://","",$CONFIG[ecards_more_pic_target])."rss.php";
        if($album)
            $feed .= "?album=".$album;
	else
		$feed .= "?album=lastup";

        if($cat)
            if($cat > 10000)
    	    $feed .= "?album=lastupby&uid=".($cat-10000);
    	else
                $feed .= "&cat=".$cat;
    
        $html .= "<center>\n";

	if($CONFIG['plugin_easyrss_showrss']) {
	    $html .= '<img src="images/spacer.gif" border=0 width=12 height=17>';
	    $rss_ico = '<a href="http://'.$feed.'">';
	    $rss_ico .= '<img src="plugins/easy_rss/rss.gif" border=0 alt="'.$lang_plugin_easyrss['alt_rss_feed'].'"></a>';
	    $html .= "$rss_ico\n";
	    $html .= '<img src="images/spacer.gif" border=0 width=12 height=17>';
	}
	
	if($CONFIG['plugin_easyrss_showgoogle']) {
	    $html .= '<img src="images/spacer.gif" border=0 width=12 height=17>';
            $goog_ico = '<a href="http://fusion.google.com/add?feedurl=';
	    $goog_ico .= 'http%3A//'.$feed;
            $goog_ico .= '"><img src="http://buttons.googlesyndication.com/fusion/add.gif" width="104" height="17" border="0" alt="'.$lang_plugin_easyrss['alt_google'].'"></a>';
	    $html .= "$goog_ico\n";
	    $html .= '<img src="images/spacer.gif" border=0 width=12 height=17>';
	}
	
	if($CONFIG['plugin_easyrss_showyahoo']) {
	    $html .= '<img src="images/spacer.gif" border=0 width=12 height=17>';
	    $name = "";
	    if(is_numeric($album)) {
	        $name = get_album_name($album);
	        $name = $CONFIG[gallery_name]. " - " . $name['title'];
	    } else if(isset($cat) && $cat > 0) {
		if($cat<10000) {
		    $name = easyrss_get_cat_name($cat);
		    $name = $CONFIG[gallery_name]. " - " . $name['name'];
		} else {
		    $name = $CONFIG[gallery_name]. " - " . get_username($cat-10000);
		}
	    } else
	        $name = $CONFIG[gallery_name];
    
	    $yahoo_ico = '<a href="http://us.rd.yahoo.com/my/atm/';
	    $yahoo_ico .= $CONFIG[gallery_name] . '/';
	    $yahoo_ico .= $name;
	    $yahoo_ico .= '/*http://add.my.yahoo.com/rss?url=http%3A//';
	    $yahoo_ico .= $feed;
	    $yahoo_ico .= '"><img src="http://us.i1.yimg.com/us.yimg.com/i/us/my/addtomyyahoo4.gif" width="91" height="17" border="0" alt="'.$lang_plugin_easyrss['alt_yahoo'].'"></a>';
	    $html .= "$yahoo_ico\n";
	    $html .= '<img src="images/spacer.gif" border=0 width=12 height=17>';
	}
	
	$html .= "</center>\n";
    }

    return $html;
}

function easyrss_get_cat_name($cid)
{
        global $CONFIG;
        global $lang_errors;

        $result = cpg_db_query("SELECT name from {$CONFIG['TABLE_CATEGORIES']} WHERE cid='$cid'");
        $count = mysql_num_rows($result);
        if ($count > 0) {
                $row = mysql_fetch_array($result);
                return $row;
        } else {
                cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
        }
}
?>

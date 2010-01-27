<?php
  /**
 *
 * BrainFeeder for CPG
 * Version 1.0 RC
 * written  by Hallvard Natvik <hallvard@natvik.com>
 * Send me a mail if you use it
 * 
 * This is free software made available to you without any guarantees or obligations
 * You can use this sofware anyway you like.
 *------------------------------------------------------------
 * This file manages the installation process
 */

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
require_once ('include/init.inc.php'); 

$thisplugin->add_action('page_start','brainfeeder_page_start');

// Add an install action
$thisplugin->add_action('plugin_install','brainfeeder_install');

// Add a configure action
$thisplugin->add_action('plugin_configure','brainfeeder_configure');

$CONFIG['feed_info']['icons'] = $CONFIG['feed_info']['mainfeed'] = FALSE;
$query = "SELECT name, value FROM {$CONFIG['TABLE_CONFIG']} WHERE name like 'cpg_brainfeeder_%' ORDER BY name";
$result = cpg_db_query($query);
while (list($name, $value) = cpg_db_fetch_row($result)) { 
    $$name = $value;
}
if (isset($cpg_brainfeeder_icons) && $cpg_brainfeeder_icons == "Yes") $CONFIG['feed_info']['icons']= TRUE;
if (isset($cpg_brainfeeder_main) && $cpg_brainfeeder_main != 0) $CONFIG['feed_info']['mainfeed'] = $cpg_brainfeeder_main;
if (isset($cpg_brainfeeder_rsstext)) $CONFIG['feed_info']['rsstext'] = $cpg_brainfeeder_rsstext;

$situation = 'start'; 
if (isset($_GET['cat']) && $_GET['cat']>0) $situation = "cat";
if (isset($_GET['album'])) {
    switch ($_GET['album']) {
        case is_numeric($_GET['album']):
            $situation = "album";  
            break;
        case "lastup":
            $situation = "lastup";  //last uploads
            break;
        case "topn":
            $situation = "topn";
            break;
        case "toprated":
            $situation ="toprated";
            break;
        case "random";
            $situation = "random";
            break;
    }
}
if (isset($_GET['pos'])) $situation = "pos";  //if album == 'random' no icon should be displayed

switch ($situation) {
    case 'start':
        $thisplugin->add_filter('gallery_header','brainfeeder_header'); // (shows just above the gallery)
        $thisplugin->add_filter('gallery_footer','brainfeeder_footer'); // (allows data just above the &quot;powered by coppermine&quot; notice)
        break;
    case 'album':
        $thisplugin->add_filter('post_breadcrumb','brainfeeder_post_breadcrumb'); 
        break;
    case 'cat':
        $thisplugin->add_filter('plugin_block','brainfeeder_plugin_alblist'); 
        break;
    case 'pos':
        break;
    case "lastup":
        $thisplugin->add_filter('thumb_caption_lastup','brainfeeder_thumb_caption_lastup'); 
        break;
    case "topn":
        $thisplugin->add_filter('thumb_caption_topn','brainfeeder_thumb_caption_topn'); 
        break;
    case "toprated":
        $thisplugin->add_filter('thumb_caption_toprated','brainfeeder_thumb_caption_toprated'); 
        break;
    case "random":
        $thisplugin->add_filter('thumb_caption_random','brainfeeder_thumb_caption_random'); 
        break;
    case "pos":
        break;
}

function brainfeeder_install() {
   global $CONFIG;
   require_once 'plugins/brainfeeder/init.inc.php'; 
   $query =  "SHOW TABLES LIKE '{$CONFIG['TABLE_brainfeeder']}'";
    $results=cpg_db_query($query);
    if (!$row=mysql_fetch_row($results)) {
        return 1;
    } else {
        return TRUE;
    }
}

function brainfeeder_configure ($inst_return) {
    global $CONFIG;
    switch ($inst_return) {
        case 1: 
            $query=
              "CREATE TABLE `".$CONFIG['TABLE_PREFIX']."brainfeeder` (                         
              `fid` int(11) NOT NULL AUTO_INCREMENT,                    
              `feed_name` varchar(50) DEFAULT NULL,        
              `logo_keyw` varchar(10) DEFAULT NULL,        
              `feed_description` varchar(250) DEFAULT NULL,    
              `feed_type` varchar(20) DEFAULT NULL,        
              `items_to_include` smallint(4) DEFAULT NULL,                 
              `feed_title` varchar(60) DEFAULT NULL,        
              `feed_category_opt` varchar(10) DEFAULT NULL,    
              `feed_enclosure` varchar(15) DEFAULT NULL,      
              `feed_mode` varchar(10) DEFAULT NULL,        
              `feed_link` varchar(200) DEFAULT NULL,        
              `feed_copyright` varchar(100) DEFAULT NULL,     
              `feed_keywords` varchar(200) DEFAULT NULL,      
              `feed_source` varchar(50) DEFAULT NULL,       
              `feed_parameter` varchar(100) DEFAULT NULL,     
              `file_name` varchar(30) DEFAULT NULL,        
              `item_def_title` varchar(100) DEFAULT NULL,     
              `item_comments` varchar(5) DEFAULT NULL,       
              `feed_refresh` smallint(8) DEFAULT NULL,                   
              `feed_incl_restr` varchar(5) DEFAULT NULL,      
              `item_cms` varchar(5) DEFAULT NULL, 
              `feed_random` varchar(10)  DEFAULT NULL, 
              `feed_media` varchar(20)  DEFAULT NULL, 
              `pic_size` VARCHAR(15) DEFAULT NULL,
              `item_content` VARCHAR(250) DEFAULT NULL,
               UNIQUE KEY `fid` (`fid`)
             )";
             if ($results=cpg_db_query($query)) {
                 cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE  name='BF_db_ver'");
                 cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} values ('BF_db_ver', 5)");
                 echo "Table crated";
             } else {
                 echo "Table already in place";
             }
             break;
        default:
              break;
    }
   echo <<< EOT

        <form action="{$_SERVER['REQUEST_URI']}" method="post">
            <input type="submit" value="Ok" name="submit" />
        </form>
EOT;
       return;
}


function brainfeeder_add_admin_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;

  $new_template=$template_gallery_admin_menu;
  $button=template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}

       
function brainfeeder_page_start(){
 global $CONFIG;
 require ('plugins/brainfeeder/init.inc.php');
  if (GALLERY_ADMIN_MODE) {
      brainfeeder_add_admin_button('index.php?file=brainfeeder/brainfeeder_config','BrainFeeder config','','BrainFeeder config');
  }
}

/**
* Displays RSS icons on album views (thunmbnails)
* 
*/
function brainfeeder_post_breadcrumb() {
    global $CONFIG;
    $dispbutt = FALSE;
    $feed_info=$CONFIG['feed_info'];
    $album = $_GET['album'];
    if ($feed_info['icons']) {
        $query = "SELECT fid, feed_mode, file_name FROM {$CONFIG[TABLE_brainfeeder]} WHERE feed_type='Album' AND feed_parameter =".$album;
        if ($html = make_rss_icon($query)) {
            echo $html;
        } elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
        }
    } elseif (GALLERY_ADMIN_MODE) {
        $dispbutt = TRUE;
    }
    if ($dispbutt) echo '<a href="index.php?file=brainfeeder/brainfeeder_config&amp;cf_op=catfeed&amp;albf='.$album.'">
                         <button>Create RSS for this album</button></a>';
    return;
}                                                                    

/**
* Shows RSS icon for the main feed (parameter in the Brainfeeder config screen)
* 
* @param mixed $html
*/
function brainfeeder_header($html) {
    global $CONFIG;
    $feed_info=$CONFIG['feed_info'];
    if ($feed_info['mainfeed']>0) {
        $fid = $feed_info['mainfeed'];
        $query = "SELECT fid, feed_mode, file_name FROM {$CONFIG['TABLE_brainfeeder']} WHERE fid=".$fid;
        $string = make_rss_icon($query);
        return $string.$html;
    }
    return $html;
}

/**
* Shows RSS icon for the main feed (parameter in the Brainfeeder config screen)
* 
* @param mixed $html
* @return mixed
*/
function brainfeeder_footer($html) {
    return brainfeeder_header($html);
}

/**
* Displays RSS icon on category thumbnail views.
* Displays Make RSS-feed button for Admin if no feed is already defined
* 
* @param mixed $data
*/
function brainfeeder_plugin_alblist($data) {
    if ($data[0]=='catlist') {
        global $CONFIG;
        $dispbutt = FALSE;
        $cat = $_GET['cat'];
        $feed_info=$CONFIG['feed_info'];
        if ($feed_info['icons']) { 
            $query = "SELECT fid, feed_mode, file_name FROM {$CONFIG[TABLE_brainfeeder]} WHERE feed_type='Category' AND feed_parameter =".$cat;
            if ($html = make_rss_icon($query)) {
                echo $html;
                $dispbutt = FALSE;
            }  elseif (GALLERY_ADMIN_MODE) {
                $dispbutt = TRUE;
            }   
        }  elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
        }
        if ($dispbutt) echo '<a href="index.php?file=brainfeeder/brainfeeder_config&amp;cf_op=catfeed&amp;catf='.$cat.'">
                             <button>Create RSS for this category</button></a>';
        }
    return $data;
}

/**
* Displays RSS-icon on thumbnail view of last uploaded pictures
* 
* @param mixed $data
*/
function brainfeeder_thumb_caption_lastup($data) {
    global $CONFIG;
    $dispbutt = FALSE;
    $feed_info=$CONFIG['feed_info'];
    $album = $_GET['album'];
    if ($feed_info['icons']) {
        $query = "SELECT fid, feed_mode, file_name FROM {$CONFIG[TABLE_brainfeeder]} WHERE feed_type='Any' AND feed_random ='Last'";
        if ($html = make_rss_icon($query)) {
                echo $html;
                $dispbutt = FALSE;
        }  elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
        }
    } elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
        }
    if ($dispbutt) echo '<a href="index.php?file=brainfeeder/brainfeeder_config&amp;cf_op=catfeed&amp;specf='.$album.'">
                             <button>Create RSS for this album</button></a>';

    return $data;
}

/**
* Displays RSS-icon on thumbnail view of most viewed pictures
* 
* @param mixed $data
*/
function brainfeeder_thumb_caption_topn($data) {
    global $CONFIG;
    $dispbutt = FALSE;
    $feed_info=$CONFIG['feed_info'];
    $album = $_GET['album'];
    if ($feed_info['icons']) {
        $query = "SELECT fid, feed_mode, file_name FROM {$CONFIG[TABLE_brainfeeder]} WHERE feed_type='Hits'";
        if ($html = make_rss_icon($query)) {
                echo $html;
                $dispbutt = FALSE;
        }  elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
        }
    } elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
    }
    if ($dispbutt) echo '<a href="index.php?file=brainfeeder/brainfeeder_config&amp;cf_op=catfeed&amp;specf='.$album.'">
                             <button>Create RSS for this album</button></a>';

    return $data;
}

/**
* Displays RSS-icon on thumbnail view of the toprated pictures
* 
* @param mixed $data
*/
function brainfeeder_thumb_caption_toprated($data) {
    global $CONFIG;
    $dispbutt = FALSE;
    $feed_info=$CONFIG['feed_info'];
    $album = $_GET['album'];
    if ($feed_info['icons']) {
        $query = "SELECT fid, feed_mode, file_name FROM {$CONFIG[TABLE_brainfeeder]} WHERE feed_type='Rating'";
        if ($html = make_rss_icon($query)) {
                echo $html;
                $dispbutt = FALSE;
        }  elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
        }
    } elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
    }
    if ($dispbutt) echo '<a href="index.php?file=brainfeeder/brainfeeder_config&amp;cf_op=catfeed&amp;specf='.$album.'">
                             <button>Create RSS for this album</button></a>';

    return $data;
}

/**
* Displays RSS-icon on thumbnail view of random pictures
* 
* @param mixed $data
*/
function brainfeeder_thumb_caption_random($data) {
    global $CONFIG;
    $dispbutt = FALSE;
    $feed_info=$CONFIG['feed_info'];
    $album = $_GET['album'];
    if ($feed_info['icons']) {
        $query = "SELECT fid, feed_mode, file_name FROM {$CONFIG[TABLE_brainfeeder]} WHERE feed_type = 'Any' AND feed_random='Random'";
        if ($html = make_rss_icon($query)) {
                echo $html;
                $dispbutt = FALSE;
        }  elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
        }
    } elseif (GALLERY_ADMIN_MODE) {
            $dispbutt = TRUE;
    }
    if ($dispbutt) echo '<a href="index.php?file=brainfeeder/brainfeeder_config&amp;cf_op=catfeed&amp;specf='.$album.'">
                             <button>Create RSS for this album</button></a>';

    return $data;
}

function make_rss_icon($query) {
    global $CONFIG;
    $feed_info=$CONFIG['feed_info'];
    if ($data = cpg_db_fetch_row(cpg_db_query($query))) {
        list ($fid, $mode, $file) = $data;
    } else {
        return FALSE;  //no feed found, nothing to show
    }
    switch ($mode) {
        case "Batch": 
            $xmlurl = $file{0}=='.' ? substr($file,2) : $file;
            $xmlurl = $file{0}=='/' ? substr($file,1) : $file;
            break;
        case "Realtime":
            $xmlurl = "rss.php?fid=".$fid;
            break;
    }
    $url = $CONFIG['ecards_more_pic_target'].$xmlurl;
    return '<a href="'.$url.'" title="'.$feed_info['rsstext'].'"><img src="images/rss.gif" alt="RSS"></a>';
}


?>
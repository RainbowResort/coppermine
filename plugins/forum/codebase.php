<?php
/**************************************************
  Coppermine 1.5.x Plugin - forum
  *************************************************
  Copyright (c) 2010 foulu (Le Hoai Phuong), eenemeenemuu
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

// coppermine default
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
if (!defined('CORE_PLUGIN')) define('CORE_PLUGIN', true); // 15x
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
// install - uninstall stuff
$thisplugin->add_action('plugin_install',   'codebase_install');
$thisplugin->add_action('plugin_configure', 'codebase_configure');
$thisplugin->add_action('plugin_uninstall', 'codebase_uninstall');
$thisplugin->add_action('plugin_cleanup',   'codebase_cleanup');
// start
$thisplugin->add_action('page_start', 'forum_start');
function forum_start() {
    global $CONFIG;
    include('forum'.DS.'languages'.DS.'english'.DS.'codebase.php');
    codebase_admin_button('forum.php?c=admin', $lang['fr_mgr'], '', $lang['fr_mgr']);
    codebase_sys_user_button('forum.php', $lang['fr'], '', $lang['fr']);
    // Atom feed
    $superCage = Inspekt::makeSuperCage();
    if ($superCage->get->getAlpha('feed') == 'atom') {
        function atomdate($timestamp) {
            return(date("Y-m-d", $timestamp - date('Z')) . "T" . date("H:i:s", $timestamp - date('Z') ) . "Z");
        }
        header ("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>
          <feed xmlns=\"http://www.w3.org/2005/Atom\">
            <id>{$CONFIG['ecards_more_pic_target']}</id>
            <updated>".atomdate(time())."</updated>
            <title>{$CONFIG['gallery_name']} - {$CONFIG['fr_title']}</title>";
        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}fr_messages ORDER BY msg_id DESC LIMIT 100");
        while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $link = $CONFIG['ecards_more_pic_target']."forum.php?c=message&amp;id={$row['msg_id']}";
            echo "
              <entry>
                <id>$link</id>
                <title>{$row['subject']} - by {$row['poster_name']}</title>
                <updated>".atomdate($row['poster_time'])."</updated>
                <author><name>{$row['poster_name']}</name></author>
                <link href=\"$link\" />
                <summary type=\"html\">{$row['body']}</summary>
              </entry>";
        }
        echo "</feed>";
    }
}
// inject addon css & javascript & Atom to DOM
global $CPG_PHP_SELF;
if ($CPG_PHP_SELF == 'forum.php') { // only inject when viewing forum
    $thisplugin->add_filter('gallery_header', 'forum_gallery_header');
}
function forum_gallery_header($template_header) {
    global $CONFIG;
    $html = '<script type="text/javascript" src="plugins/forum/forum/html/js/scripts.js"></script>'.PHP_EOL;
    $forum_css_file = 'plugins/forum/forum/templates/'.$CONFIG['theme'].'/style.css';
    if (file_exists($forum_css_file)) {
        $html .= '<link rel="stylesheet" href="'.$forum_css_file.'" type="text/css" />'.PHP_EOL;
    }
    // Atom button
    $html .= '<link rel="alternate" type="application/atom+xml" title="'.$CONFIG['gallery_name'].' | '.$CONFIG['fr_title'].' - Atom" href="'.$CONFIG[ecards_more_pic_target].'forum.php?feed=atom" />'.PHP_EOL;
    $template_header = str_replace('</head>', $html.'</head>', $template_header);
    return $template_header;
}

function codebase_query($title, $sql_file) {
    global $CONFIG;
    if (!function_exists('remove_comments')) {
        include('include'.DS.'sql_parse.php');
    }
    $sql_query = fread(fopen($sql_file, 'r'), filesize($sql_file));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');
    echo <<<EOT
        <table class="maintable" width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr><td class="tableh1" colspan="2"><b>{$title}</b></td></tr>
EOT;
    foreach($sql_query as $q) {
        echo "<tr><td class='tableb' style='color: black;'>{$q}</td>";
        if (mysql_query($q)) {
            echo "<td class='tableb' style='color: green;'><b>OK</b></td></tr>";
        } else {
            echo "<td class='tableb' style='color: red;'><b>Already Done</b></td></tr>";
        }
    }
    echo '</table>';
}
    
function codebase_install() {
    $superCage = Inspekt::makeSuperCage();
    if ($superCage->post->keyExists('submit')) {
        $forumphp = <<<EOT
<?php
// define some basic element
define('NBSP', '&nbsp;'); // mass use
define('BR', '<br />'); // mass use
define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', str_replace('\\\\', DS, dirname(__FILE__)).DS);
// load coppermine
define('IN_COPPERMINE', true);
include(BASE_DIR.'include'.DS.'init.inc.php');
//\$fr_time_start = cpgGetMicroTime();
// load class and file
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'import.php');
// init the forum
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'initialize.php');
//\$fr_time_end = cpgGetMicroTime();
//echo round(\$fr_time_end - \$fr_time_start, 3);
if (!USER_ID && (\$CONFIG['fr_guest_browse'] == 0)) {
    header("Location: login.php?force_login=1&referer=forum.php");
    exit();
}
EOT;
        if (!function_exists('file_put_contents')) {
            function file_put_contents($filename, $data) {
               if (($h = @fopen($filename, 'w')) === false) {
                   return false;
               }
               if (($bytes = @fwrite($h, $data)) === false) {
                   return false;
               }
               fclose($h);
               return $bytes;
           }
        }
        file_put_contents('forum.php', $forumphp);
        return true;
    } else {
        return 1;
    }
}

function codebase_configure($stop = TRUE) {
    global $errors, $CONFIG;
    global $lang_common;
    $superCage = Inspekt::makeSuperCage();
    $plugin_name = $superCage->get->getRaw('p');
    $install_sql_file = 'plugins'.DS.$plugin_name.DS.'sql'.DS.'install.sql';
    $update_sql_file  = 'plugins'.DS.$plugin_name.DS.'sql'.DS.'update.sql';
    codebase_query('Performing database updates', $install_sql_file);
    codebase_query('Performing database updates', $update_sql_file);
    if ($stop) {
        echo '
        <form action="'.$superCage->server->getEscaped('REQUEST_URI').'" method="post">
            <input class="button" type="submit" name="submit" value="'.$lang_common['go'].'" name="submit" />
        </form>
';
    }
}

function codebase_uninstall() {
    global $CONFIG;
    $superCage = Inspekt::makeSuperCage();
    if (!$superCage->post->keyExists('drop')) {
        return 1;
    }
    @unlink('forum.php');
    if ($superCage->post->getInt('drop') == 0) {
        return true;
    } else {
        $plugin_id = $superCage->get->getInt('p');
        $result = cpg_db_query("SELECT path FROM `{$CONFIG['TABLE_PREFIX']}plugins` WHERE plugin_id='{$plugin_id}';");
        $row = cpg_db_fetch_row($result);
        $plugin_name = $row['path'];
        $uninstall_sql_file = 'plugins'.DS.$plugin_name.DS.'sql'.DS.'uninstall.sql';
        codebase_query('Drop the database', $uninstall_sql_file);
        return true;
    }
}

function codebase_cleanup($action) {
    global $lang_common;
    $superCage = Inspekt::makeSuperCage();
    if ($action === 1) {
        echo '<form action="'.$superCage->server->getEscaped('REQUEST_URI').'" method="post">';
        echo <<< EOT
        <table class="maintable" width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr><td class="tableh1"><b>Do you want to drop the plugin's current database ?</b></td></tr>
            <tr><td class="tableb">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <input type="radio" name="drop" id="drop_yes" value="1" />
                            <label for="drop_yes" class="clickable_option">{$lang_common['yes']}</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" name="drop" id="drop_no" checked="checked" value="0" />
                            <label for="drop_no" class="clickable_option">{$lang_common['no']}</label>
                        </td>
                    </tr>
                </table>
            </td></tr>
            <tr>
                <td class="tableb">
                    <input class="button" type="submit" name="submit" value="{$lang_common['go']}" />
                    <input class="button" type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="cancel" />
                </td>
            </tr>
        </table>
        </form>
EOT;
    }
}

function codebase_admin_button($href, $title, $target, $link, $before = 'documentation') {
    global $template_gallery_admin_menu;
    $new_emplate = $template_gallery_admin_menu;
    $button = template_extract_block($new_emplate, $before);
    $uc_before = strtoupper($before);
    $params = array(
        "{{$uc_before}_HREF}"    => $href,
        "{{$uc_before}_TITLE}"   => $title,
        "target=\"cpg_$before\"" => $target,
        "{{$uc_before}_LNK}"     => $link,
    );
    $new_button="<!-- BEGIN $link -->".template_eval($button, $params)."<!-- END $link -->\n";
    template_extract_block($template_gallery_admin_menu, $before, "<!-- BEGIN $before -->" . $button . "<!-- END $before -->\n" . $new_button);
}

function codebase_sub_user_button($href, $title, $target, $link, $before = 'custom_link') {
    global $template_sub_menu;
    $new_template = $template_sub_menu;
    $button = template_extract_block($new_template, $before);
    switch ($before) {
        case 'custom_link':
            $uc_before = 'CUSTOM_LNK';
            break;
        case 'album_list':
            $uc_before = 'ALB_LIST';
            break;
        case 'favpics':
            $uc_before = 'FAV';
            break;
        default:
            $uc_before = strtoupper($before);
    }
    $params = array(
        "{{$uc_before}_LNK}"   => $link,
        "{{$uc_before}_TITLE}" => $title,
        "{{$uc_before}_TGT}"   => $href,
    );
    $new_button="<!-- BEGIN $link -->".template_eval($button, $params)."<!-- END $link -->\n";
    template_extract_block($template_sub_menu, $before, "<!-- BEGIN $before -->" . $button . "<!-- END $before -->\n" . $new_button);
}

function codebase_sys_user_button($href, $title, $target, $link, $before = 'home') {
    global $template_sys_menu;
    $new_template = $template_sys_menu;
    $button = template_extract_block($new_template, $before);
    switch ($before) {
        case 'my_gallery':
            $uc_before = 'MY_GAL';
            break;
        case 'allow_memberlist':
            $uc_before = 'MEMBERLIST';
            break;
        case 'upload_approval':
            $uc_before = 'UPL_APP';
            break;
        case 'enter_admin_mode':
            $uc_before = 'ADM_MODE';
            break;
        case 'leave_admin_mode':
            $uc_before = 'ADM_MODE';
            break;
        case 'leave_admin_mode':
            $uc_before = 'USR_MODE';
            break;
        case 'upload_pic':
            $uc_before = 'UPL_PIC';
            break;
        case 'my_profile':
            $uc_before = 'MY_PROF';
        default:
            $uc_before = strtoupper($before);
    }
    $params = array(      
        "{{$uc_before}_LNK}"   => $link,
        "{{$uc_before}_TITLE}" => $title,      
        "{{$uc_before}_TGT}"   => $href,
    );
    $new_button = "<!-- BEGIN $link -->".template_eval($button, $params)."<!-- END $link -->\n";
    $new_button = preg_replace('/<ul>.*<\/ul>/s', '', $new_button);
    template_extract_block($template_sys_menu, $before, "<!-- BEGIN $before -->" . $button . "<!-- END $before -->\n" . $new_button);
}

function codebase_redirect($link, $type='js') {
    switch ($type) {
        case 'php':
            header("Location: $link");
            break;
        case 'js':
            echo "<script language=\"javascript\" type=\"text/javascript\">window.location='$link';</script>";
            break;
        default:
            echo "<html><head><meta http-equive=\"refresh\" content=\"0; URL=$link\"></head></html>";
    }
}
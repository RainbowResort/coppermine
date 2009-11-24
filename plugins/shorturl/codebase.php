<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/fav_button/codebase.php $
  $Revision: 6770 $
  $LastChangedBy: eenemeenemuu $
  $Date: 2009-11-23 15:05:21 +0100 (Mo, 23 Nov 2009) $
**********************************************/
/*********************************************
  Coppermine Plugin - Short URL
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start', 'shorturl_page_start');

function shorturl_page_start() {
    if(defined('INDEX_PHP')) {
        global $CONFIG;
        $superCage = Inspekt::MakeSuperCage();
        if ($superCage->get->keyExists('c')) header("Location: index.php?cat=".$superCage->get->getInt('c'));
        if ($superCage->get->keyExists('a')) header("Location: thumbnails.php?album=".$superCage->get->getInt('a'));
        if ($superCage->get->keyExists('p')) header("Location: displayimage.php?pid=".$superCage->get->getInt('p'));
        if ($superCage->get->keyExists('r')) {
            $result = cpg_db_query("SELECT url FROM {$CONFIG['TABLE_PREFIX']}plugin_shorturl WHERE rid = ".$superCage->get->getInt('r'));
            $url = mysql_result($result, 0);
            mysql_free_result($result);
            header("Location: $url");
        }
        if ($superCage->get->keyExists('shorturl')) {
            if ($superCage->get->getAlpha('shorturl') == 'config') {
                // Maybe here will be a config screen later
            }
            if ($superCage->get->getAlpha('shorturl') == 'add' && USER_ID > 0) {
                if ($superCage->post->keyExists('url')) {
                    js_include('plugins/shorturl/jquery.copy.js');
                    load_template();
                    pageheader('Your short url');
                    starttable('100%', 'Your short url', 2);
                    echo <<< EOT
                        <tr>
                            <td class="tableb">
EOT;
                    $regex = '^'
                            .'(https?://){1,1}' // leading 'http://' or 'https://'
                            .'(([0-9a-z_!~*\'().&=+$%-]+: ){0,1}' //password, separated with a colon
                            .'[0-9a-z_!~*\'().&=+$%-]+@){0,1}' //username, separated with an @
                            .'(([0-9]{1,3}\.){3}[0-9]{1,3}' // IP- 199.194.52.184
                            .'|' // allows either IP or domain
                            .'(' // domain start
                            .'([0-9a-z_!~*\'()-]+\.)*' // tertiary domain(s)- www.
                            .'([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.' // second level domain
                            .'[a-z]{2,6}' // first level domain- .com or .museum
                            .')' // domain end
                            .')' // end of domain / IP address
                            .'(:[0-9]{1,4}){0,1}' // port number- :80
                            .'((/?)|' // a slash isn't required if there is no file name
                            .'(/[0-9a-zA-Z_!~*\'().;?:@&=+$,%\#-]+)+/?)'
                            .'$';
                    $url = $superCage->post->getRaw('url');
                    if(!preg_match('#' . $regex . '#i', $url)) {
                        echo "Invalid url: <tt>$url</tt> <br/> <a href=\"javascript:history.back();\"><button class=\"button\">Back</button></a>";
                    } else {
                        $result = cpg_db_query("SELECT rid FROM {$CONFIG['TABLE_PREFIX']}plugin_shorturl WHERE url = '$url'");
                        if (mysql_num_rows($result) > 0) {
                            $rid = mysql_result($result, 0);
                        } else {
                            cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_shorturl (url) VALUES ('$url')");
                            $result = cpg_db_query("SELECT rid FROM {$CONFIG['TABLE_PREFIX']}plugin_shorturl WHERE url = '$url'");
                            $rid = mysql_result($result, 0);
                        }
                        mysql_free_result($result);
                        $length = strlen($CONFIG['ecards_more_pic_target']."?r=$rid") + 5;
                        echo <<< EOT
                            <input id="shorturl" type="text" name="url" size="$length" class="textinput" value="{$CONFIG['ecards_more_pic_target']}?r=$rid" readonly="readonly" />
                            <button class="button" onclick="$('#shorturl').select().copy();$('#copy_success').show().fadeOut('slow');">Copy to clipboard</button>
                            <span id="copy_success" class="important" style="display:none;">Copied to clipboard</span>
                            <script type="text/javascript">$(document).ready(function() { $('#shorturl').select(); });</script>
EOT;
                    }
                    echo <<< EOT
                            </td>
                        </tr>
EOT;
                    endtable();
                    pagefooter();
                    exit;
                } else {
                    load_template();
                    pageheader('Create short url');
                    echo '<form method="post">';
                    starttable('100%', 'Enter url', 2);
                    list($timestamp, $form_token) = getFormToken();
                    echo <<< EOT
                        <tr>
                            <td class="tableb">
                                <input type="text" id="url" name="url" size="40" class="textinput" style="width:100%;" />
                                <input type="hidden" name="form_token" value="{$form_token}" />
                                <input type="hidden" name="timestamp" value="{$timestamp}" />
                            </td>
                            <td class="tableb">
                                <input type="submit" name="commit" class="button" value="Shorten" />
                            </td>
                        </tr>
EOT;
                    endtable();
                    echo '</form>';
                    echo '<script type="text/javascript">$(document).ready(function() { $("#url").select(); });</script>';
                    pagefooter();
                    exit;
                }
            }
        }
    }
}


$thisplugin->add_filter('sys_menu', 'shorturl_sys_menu');

function shorturl_sys_menu($menu) {
    if (!USER_ID) {
        return $menu;
    }

    global $template_sys_menu_spacer;

    $new_button = array();
    $new_button[0][0] = 'Short URL';
    $new_button[0][1] = 'Create short url';
    $new_button[0][2] = './?shorturl=add';
    $new_button[0][3] = '';
    $new_button[0][5] = '';
    $new_button[0][4] = $template_sys_menu_spacer;

    array_splice($menu, count($menu)-1, 0, $new_button);

    return $menu;
}


$thisplugin->add_action('plugin_install', 'shorturl_install');

function shorturl_install() {
    global $CONFIG;
    return cpg_db_query("CREATE TABLE IF NOT EXISTS {$CONFIG['TABLE_PREFIX']}plugin_shorturl (rid int(11) unsigned NOT NULL auto_increment PRIMARY KEY, url text NOT NULL) TYPE=MyISAM  COMMENT='Contains the data for the shorturl plugin';");
}


$thisplugin->add_action('plugin_uninstall', 'shorturl_uninstall');

function shorturl_uninstall() {
    $superCage = Inspekt::makeSuperCage();

    if (!$superCage->post->keyExists('drop')) {
        return 1;
    }

    if (!checkFormToken()) {
        global $lang_errors;
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }

    if ($superCage->post->getInt('drop') == 1) {
        global $CONFIG;
        return cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_shorturl");
    }
}


$thisplugin->add_action('plugin_cleanup', 'shorturl_cleanup');

function shorturl_cleanup($action) {
    $superCage = Inspekt::makeSuperCage();
    $cleanup = $superCage->server->getEscaped('REQUEST_URI');
    if ($action == 1) {
        global $lang_common;
        list($timestamp, $form_token) = getFormToken();
        echo <<< EOT
            <form action="{$cleanup}" method="post">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="tableb">
                            Drop database table?
                        </td>
                        <td class="tableb">
                            <input type="radio" name="drop" id="drop_yes" value="1" checked="checked" />
                            <label for="drop_yes" class="clickable_option">{$lang_common['yes']}</label>
                        </td>
                        <td class="tableb">
                            <input type="radio" name="drop" id="drop_no"  value="0" />
                            <label for="drop_no" class="clickable_option">{$lang_common['no']}</label>
                        </td>
                        <td class="tableb">
                            <input type="hidden" name="form_token" value="{$form_token}" />
                            <input type="hidden" name="timestamp" value="{$timestamp}" />
                            <input type="submit" name="submit" value="{$lang_common['go']}" class="button" />
                        </td>
                    </tr>
                </table>
            </form>
EOT;
    }
}
?>

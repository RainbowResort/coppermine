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
  Coppermine version: 1.5.0
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/include/functions.inc.php $
  $Revision: 5193 $
  $LastChangedBy: nibbler999 $
  $Date: 2008-10-28 04:28:22 +0530 (Tue, 28 Oct 2008) $
**********************************************/

/**
* Coppermine Photo Gallery functions.inc.php
*
* This file has almost all the functions of Coppermine
*
* @copyright 2002-2007 Gregory DEMAR, Coppermine Dev Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
* @package Coppermine
* @version  $Id: functions.inc.php 5193 2008-10-27 22:58:22Z nibbler999 $
*/

/**
* get_meta_album_set()
*
* Generates a WHERE statement that reflects the meta album
* Incorporates restrictions based on visibility and album passwords
*
* @param integer $cat Category
* @return void
**/
// TODO: add in INNER JOIN {$CONFIG['TABLE_CATEGORIES']} ON cid = category 
// only add when we are at the top level, cat == 0
function get_meta_album_set($cat)
{
    global $CONFIG, $lft, $rgt, $RESTRICTEDWHERE, $FORBIDDEN_SET_DATA, $CURRENT_ALBUM_KEYWORD, $CURRENT_CAT_DEPTH;
    ############################     DB     ################################
    global $cpg_db_functions_inc;
    $cpgdb =& cpgDB::getInstance();
    $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
    ##################################################################
    if ($cat == USER_GAL_CAT){
 	
        $RESTRICTEDWHERE = "WHERE (category > " . FIRST_USER_CAT;
        $CURRENT_CAT_DEPTH = -1;
	
    } elseif ($cat > FIRST_USER_CAT){
 	
        $RESTRICTEDWHERE = "WHERE (category = $cat";
        $CURRENT_CAT_DEPTH = -1;

    } elseif ($cat > 0){

        /*$sql = "SELECT rgt, lft, depth FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = $cat LIMIT 1";
        $result = cpg_db_query($sql);
        list($rgt, $lft, $CURRENT_CAT_DEPTH) = mysql_fetch_row($result);*/	
        #############################    DB   #############################
        $cpgdb->query($cpg_db_functions_inc['get_rgt_lft_depth'], $cat);
        $row = $cpgdb->fetchRow();
        $rgt = $row['rgt'];
        $lft = $row['lft'];
        $CURRENT_CAT_DEPTH = $row['depth'];
        ##############################################################

        $RESTRICTEDWHERE = "INNER JOIN {$CONFIG['TABLE_CATEGORIES']} AS c2 ON c2.cid = category
                                    WHERE (c2.lft BETWEEN $lft AND $rgt";

	 } elseif ($cat < 0) {
	 
        $RESTRICTEDWHERE = "WHERE (r.aid = " . -$cat;
	 
    } else {
        $RESTRICTEDWHERE = "WHERE (1=1";	########	cpgdbAL
        $CURRENT_CAT_DEPTH = 0;
    }

    if (!empty($CURRENT_ALBUM_KEYWORD)) {
        $RESTRICTEDWHERE .= "OR keywords like '%$CURRENT_ALBUM_KEYWORD%'";
    }

    $RESTRICTEDWHERE .= ')';

    if ($FORBIDDEN_SET_DATA) {
        $RESTRICTEDWHERE .= "\nAND r.aid NOT IN (" . implode(', ', $FORBIDDEN_SET_DATA) . ")";
    }
}


/**
 * user_get_profile()
 *
 * Decode the user profile contained in a cookie
 *
 **/

function user_get_profile()
{
        global $CONFIG, $USER;

        $superCage = Inspekt::makeSuperCage();

        /**
         * TODO: Use the md5 # to verify integrity of cookie string
         * At the time of installation we write a randonmly generated secret salt in config.inc
         * This secret salt will be appended to the encoded string and the resulting md5 # of this string will
         * be appended to the encoded string with @ separator
         * e.g. $encoded_string_with_md5 = "asdfkhasdf987we89rfadfjhasdfklj@^@".md5("asdfkhasdf987we89rfadfjhasdfklj".$secret_salt)
         */	// Using getRaw() for getting cookie data
        if ($superCage->cookie->keyExists($CONFIG['cookie_name'].'_data')) {
            $USER = @unserialize(@base64_decode($superCage->cookie->getRaw($CONFIG['cookie_name'].'_data')));
            $USER['lang'] = strtr($USER['lang'], '$/\\:*?"\'<>|`', '____________');
        }

        if (!isset($USER['ID']) || strlen($USER['ID']) != 32) {
                list($usec, $sec) = explode(' ', microtime());
                $seed = (float) $sec + ((float) $usec * 100000);
                srand($seed);
                $USER=array('ID' => md5(uniqid(rand(),1)));
        } else {
                $USER['ID'] = addslashes($USER['ID']);
        }

        if (!isset($USER['am'])) {
            $USER['am'] = 1;
        }
}

// Save the user profile in a cookie


/**
 * user_save_profile()
 *
 * Save the user profile in a cookie
 *
 **/

function user_save_profile()
{
        global $CONFIG, $USER;

        /**
         * TODO: Use the md5 # to verify integrity of cookie string
         * At the time of installation we write a randonmly generated secret salt in config.inc
         * This secret salt will be appended to the encoded string and the resulting md5 # of this string will
         * be appended to the encoded string with @ separator
         * e.g. $encoded_string_with_md5 = "asdfkhasdf987we89rfadfjhasdfklj@^@".md5("asdfkhasdf987we89rfadfjhasdfklj".$secret_salt)
         */
        $data = base64_encode(serialize($USER));
        setcookie($CONFIG['cookie_name'].'_data', $data, time()+86400*30, $CONFIG['cookie_path']);
}

/**************************************************************************
   Database functions
 **************************************************************************/
####################        DB      ####################
/*function cpgdbal_connect()
{
	global $CONFIG;
	if ($CONFIG['dbservername'] == 'mysql') {
		$result = @mysql_connect($CONFIG['dbserver'], $CONFIG['dbuser'], $CONFIG['dbpass']);
		if (!$result) {
				die("ERROR IN CONNECTION".mysql_error());
		}
		if (!mysql_select_db($CONFIG['dbname'])) {
			exit("{$CONFIG['dbname']} not found, session halted");
		}
	} elseif ($CONFIG['dbservername'] == 'mssql') {
		$connectioninfo = array();
		if ($CONFIG['auth_mode'] == 'sqlserver') {
			$connectioninfo['UID'] = $CONFIG['dbuser'];
			$connectioninfo['PWD'] = $CONFIG['dbpass'];
		}
		$connectioninfo['Database'] = $CONFIG['dbname'];
		$result = @sqlsrv_connect($CONFIG['dbserver'], $connectioninfo);
		if (!$result) {
			$err = sqlsrv_errors();
			foreach ($err as $error){
					echo "<br />SQLSTATE: ".$error['SQLSTATE']."<br/>";
					echo "Code: ".$error['code']."<br/>";
					echo "Message: ".($error['message'])."<br/>";
			}
			die('error in connection');
		}
	}
	return $result;
}*/
################################################

// Connect to the database

/**
 * cpg_db_connect()
 *
 * Connect to the database
 **/
/*##################    commented for cpgdbal ###################
function cpg_db_connect()
{
		global $CONFIG;
		$result = @mysql_connect($CONFIG['dbserver'], $CONFIG['dbuser'], $CONFIG['dbpass']);
		if (!$result) {
				return false;
		}
		if (!mysql_select_db($CONFIG['dbname']))
				return false;
		return $result;
}
#####################################################*/
// Perform a database query

/**
 * cpg_db_query()
 *
 * Perform a database query
 *
 * @param $query
 * @param integer $link_id
 * @return
 **/
/*#############################     commented for cpgdbal    ##############################
function cpg_db_query($query, $link_id = 0)
{
        global $CONFIG, $query_stats, $queries;

        $query_start = cpgGetMicroTime();

        if ($link_id) {
                                $result = mysql_query($query, $link_id);
        } else {
                                $result = mysql_query($query, $CONFIG['LINK_ID']);
        }
        $query_end = cpgGetMicroTime();
        if (isset($CONFIG['debug_mode']) && (($CONFIG['debug_mode']==1) || ($CONFIG['debug_mode']==2) )) {
                $duration = round($query_end - $query_start, 3);
                $query_stats[] = $duration;
                $queries[] = "$query ({$duration}s)";
        }
        if (!$result) cpg_db_error("While executing query \"$query\" on $link_id");

        return $result;
}
################################################################################*/
// Error message if a query failed


/**
 * cpg_db_error()
 *
 * Error message if a query failed
 *
 * @param $the_error
 * @return
 **/
/*##############################    commented for cpgdbal   #################################
function cpg_db_error($the_error)
{
        global $CONFIG,$lang_errors;
print($the_error);
        if ($CONFIG['debug_mode'] === '0' || (!GALLERY_ADMIN_MODE)) {
            cpg_die(CRITICAL_ERROR, $lang_errors['database_query'], __FILE__, __LINE__);
        } else {
                $the_error .= "\n\nmySQL error: ".mysql_error()."\n";
                $out = "<br />".$lang_errors['database_query'].".<br /><br/>
                    <form name=\"mysql\" id=\"mysql\"><textarea rows=\"8\" cols=\"60\">".htmlspecialchars($the_error)."</textarea></form>";
            cpg_die(CRITICAL_ERROR, $out, __FILE__, __LINE__);
        }
}
###############################################################################*/
// Fetch all rows in an array

/**
 * cpg_db_fetch_rowset()
 *
 * Fetch all rows in an array
 *
 * @param $result
 * @return
 **/
/*################     commented for cpgdbal  ###############
function cpg_db_fetch_rowset($result)
{
        $rowset = array();

        while ($row = mysql_fetch_assoc($result)) $rowset[] = $row;

        return $rowset;
}
###############################################*/
/**
 * cpg_db_fetch_row()
 *
 * Fetch row in an array
 *
 * @param $result
 * @return
 **/
/*#########    comented for cpgdbal   ##########
function cpg_db_fetch_row($result)
{

        $row = mysql_fetch_assoc($result);

        return $row;
}
#################################*/
/**
 * cpg_db_last_insert_id()
 *
 * Get the last inserted id of a query
 *
 * @return integer $id
 **/
/*######    commented for cpgdbal   ######
function cpg_db_last_insert_id()
{
        return mysql_insert_id();
}
############################*/
/**************************************************************************
   Sanitization functions
 **************************************************************************/

/**
 * cpgSanitizeUserTextInput()
 *
 * Function to sanitize the data which cannot be directly sanitized with Inspekt
 *
 * @param string $string
 * @return string Return sanitized data
 */
function cpgSanitizeUserTextInput($string)
{
        //TODO: Add some sanitization code
    return $string;
}

/**************************************************************************
   Utilities functions
 **************************************************************************/

// Replacement for the die function

/**
 * cpg_die()
 *
 * Replacement for the die function
 *
 * @param $msg_code
 * @param $msg_text
 * @param $error_file
 * @param $error_line
 * @param boolean $output_buffer
 * @return
 **/

function cpg_die($msg_code, $msg_text,  $error_file, $error_line, $output_buffer = false)
{
        global $CONFIG, $lang_cpg_die, $template_cpg_die, $lang_common;
        ####################    DB   ####################
        $cpgdb =& cpgDB::getInstance();
        $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
        #############################################

        // Simple output if theme file is not loaded
        if (!function_exists('pageheader')) {
                echo 'Fatal error :<br />'.$msg_text;
                exit;
        }

        $ob = ob_get_contents();
        if ($ob) ob_end_clean();

        if (function_exists('theme_cpg_die')) {
            theme_cpg_die($msg_code, $msg_text,  $error_file, $error_line, $output_buffer);
            return;
        }

        $params = array(
                '{MESSAGE}' => $msg_text,
                '{FILE_TXT}' => $lang_cpg_die['file'],
                '{FILE}' => $error_file,
                '{LINE_TXT}' => $lang_cpg_die['line'],
                '{LINE}' => $error_line,
                '{OUTPUT_BUFFER}' => $ob,
        );

        if (!($CONFIG['debug_mode'] == 1 || ($CONFIG['debug_mode'] == 2 && GALLERY_ADMIN_MODE))) template_extract_block($template_cpg_die, 'file_line');
        //if (!$output_buffer && !$CONFIG['debug_mode'])
        template_extract_block($template_cpg_die, 'output_buffer');

        pageheader($lang_cpg_die[$msg_code]);
        starttable(-1, cpg_fetch_icon('warning', 2) . $lang_cpg_die[$msg_code]);
        echo "<!-- cpg_die -->";
        echo template_eval($template_cpg_die, $params);
        endtable();
        pagefooter();
        $cpgdb->free();
        exit;
}

// Display a localised date

/**
 * localised_date()
 *
 * Display a localised date
 *
 * @param integer $timestamp
 * @param $datefmt
 * @return
 **/

function localised_date($timestamp = -1, $datefmt)
{
        global $lang_month, $lang_day_of_week, $CONFIG;

        $timestamp = localised_timestamp($timestamp);

    $date = ereg_replace('%[aA]', $lang_day_of_week[(int)strftime('%w', $timestamp)], $datefmt);
    $date = ereg_replace('%[bB]', $lang_month[(int)strftime('%m', $timestamp)-1], $date);

    return strftime($date, $timestamp);
}

/**
 * localised_timestamp()
 *
 * Display a localised timestamp
 *
 * @return
 **/
function localised_timestamp($timestamp = -1)
{
        global $CONFIG;

        if ($timestamp == -1) {
                $timestamp = time();
        }

        $diff_to_GMT = date("O") / 100;

        $timestamp += ($CONFIG['time_offset'] - $diff_to_GMT) * 3600;

        return $timestamp;
}

// Function to create correct URLs for image name with space or exotic characters

/**
 * path2url()
 *
 * Function to create correct URLs for image name with space or exotic characters
 *
 * @param $path
 * @return
 **/

function path2url($path)
{
        return str_replace("%2F","/",rawurlencode($path));
}

// Display a 'message box like' table

/**
 * msg_box()
 *
 * Display a 'message box like' table
 *
 * @param $title
 * @param $msg_text
 * @param string $button_text
 * @param string $button_link
 * @param string $width
 * @return
 **/

function msg_box($title, $msg_text, $button_text="", $button_link="", $width="-1")
{
    if (function_exists('theme_msg_box'))
    {
        theme_msg_box($title, $msg_text, $button_text, $button_link, $width);
        return;
    }
        global $template_msg_box;

        if (!$button_text) {
            template_extract_block($template_msg_box, 'button');
        }

        $params = array(
                '{MESSAGE}' => $msg_text,
                '{LINK}' => $button_link,
                '{TEXT}' => $button_text
        );

        starttable($width, $title);
        echo template_eval($template_msg_box, $params);
        endtable();
}


/**
 * create_tabs()
 *
 * @param $items
 * @param $curr_page
 * @param $total_pages
 * @param $template
 * @return
 **/

function create_tabs($items, $curr_page, $total_pages, $template)
{
        global $CONFIG, $lang_create_tabs;

        // TO-DO: Need to add theme_create_tabs() to sample/theme.php
        // Maybe this function create_tabs() should be moved to themes.inc.php and renamed theme_create_tabs()?
        if (function_exists('theme_create_tabs')) {
            return theme_create_tabs($items, $curr_page, $total_pages, $template);
        }

        // Code for future: to implement 'previous' and 'next' tabs
        // Everything is set - just need to put in correct place and use correct prev & next page numbers
        // $tabs .= strtr( sprintf($template['inactive_prev_tab'],#PREV_PAGE_NUMBER#) , array('{PREV}' => $lang_create_tabs['previous']) );
        // $tabs .= strtr( sprintf($template['inactive_next_tab'],#NEXT_PAGE_NUMBER#) , array('{NEXT}' => $lang_create_tabs['next']) );

        $maxTab = $CONFIG['max_tabs'];

        if ($total_pages == '') {
        	$total_pages = $curr_page;
        }

        $tabs = sprintf($template['left_text'], $items, $total_pages);
        if (($total_pages == 1)) return $tabs;

        $tabs .= $template['tab_header'];
        if ($curr_page == 1) {
                $tabs .= sprintf($template['active_tab'], 1);
        } else {
                $tabs .= sprintf($template['inactive_tab'], 1, 1);
        }
        if ($total_pages > $maxTab) {
                $start = max(2, $curr_page - floor(($maxTab -2)/2));
                $start = min($start, $total_pages - $maxTab +2);
                $end = $start + $maxTab -3;
        } else {
                $start = 2;
                $end = $total_pages-1;
        }
        for ($page = $start ; $page <= $end; $page++) {
                if ($page == $curr_page) {
                        $tabs .= sprintf($template['active_tab'], $page);
                } else {
                        $tabs .= sprintf($template['inactive_tab'], $page, $page);
                }
        }
        if ($total_pages > 1) {
                if ($curr_page == $total_pages) {
                        $tabs .= sprintf($template['active_tab'], $total_pages);
                } else {
                        $tabs .= sprintf($template['inactive_tab'], $total_pages, $total_pages);
                }
        }
        return $tabs.$template['tab_trailer'];
}

/**
 * Rewritten by Nathan Codding - Feb 6, 2001. Taken from phpBB code
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 *         to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 *         to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 *                to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a line
 *
 * Notes: the email one might get annoying - it's easy to make it more restrictive, though.. maybe
 * have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */

/**
 * make_clickable()
 *
 * @param $text
 * @return
 **/

function make_clickable($text)
{
        $ret = ' '.$text;
        $ret = preg_replace("#([\n ])([a-z]+?)://([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]+)#i", "\\1<a href=\"\\2://\\3\" rel=\"external\">\\2://\\3</a>", $ret);
        $ret = preg_replace("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]*)?)#i", "\\1<a href=\"http://www.\\2.\\3\\4\" rel=\"external\">www.\\2.\\3\\4</a>", $ret);
        $ret = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
        return substr($ret, 1);
}

// Allow the use of a limited set of phpBB bb codes in albums and image descriptions
// Taken from phpBB code

/**
 * bb_decode()
 *
 * @param $text
 * @return
 **/

function bb_decode($text)
{
        $text = nl2br($text);

        static $bbcode_tpl = array();
        static $patterns = array();
        static $replacements = array();

        // First: If there isn't a "[" and a "]" in the message, don't bother.
        if ((strpos($text, "[") === false || strpos($text, "]") === false))
        {
                return $text;
        }

        // [b] and [/b] for bolding text.
        $text = str_replace("[b]", '<strong>', $text);
        $text = str_replace("[/b]", '</strong>', $text);

        // [u] and [/u] for underlining text.
        $text = str_replace("[u]", '<u>', $text);
        $text = str_replace("[/u]", '</u>', $text);

        // [i] and [/i] for italicizing text.
        $text = str_replace("[i]", '<i>', $text);
        $text = str_replace("[/i]", '</i>', $text);

        // colours
        $text = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z]+)\]/", '<span style="color:$1">', $text);
        $text = str_replace("[/color]", '</span>', $text);

        // [i] and [/i] for italicizing text.
        //$text = str_replace("[i:$uid]", $bbcode_tpl['i_open'], $text);
        //$text = str_replace("[/i:$uid]", $bbcode_tpl['i_close'], $text);

        if (!count($bbcode_tpl)) {
                                // We do URLs in several different ways..
                $bbcode_tpl['url']  = '<span class="bblink"><a href="{URL}" %s>{DESCRIPTION}</a></span>';

                $bbcode_tpl['url1'] = str_replace('{URL}', '\\1\\2', $bbcode_tpl['url']);
                $bbcode_tpl['url1'] = str_replace('{DESCRIPTION}', '\\1\\2', $bbcode_tpl['url1']);

                                // [url]xxxx://www.phpbb.com[/url] code..
                $patterns['link'][1] = "#\[url\]([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/url\]#si";
                $replacements['link'][1] = $bbcode_tpl['url1'];
                                $text = check_link_type_and_replace($patterns['link'][1], $replacements['link'][1], $text, 1);

                $bbcode_tpl['url2'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
                $bbcode_tpl['url2'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);

                                // [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
                $patterns['link'][2] = "#\[url\]([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/url\]#si";
                $replacements['link'][2] = $bbcode_tpl['url2'];
                                $text = check_link_type_and_replace($patterns['link'][2], $replacements['link'][2], $text, 2);

                $bbcode_tpl['url3'] = str_replace('{URL}', '\\1\\2', $bbcode_tpl['url']);
                $bbcode_tpl['url3'] = str_replace('{DESCRIPTION}', '\\3', $bbcode_tpl['url3']);

                                // [url=xxxx://www.phpbb.com]phpBB[/url] code..
                $patterns['link'][3] = "#\[url=([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#si";
                $replacements['link'][3] = $bbcode_tpl['url3'];
                                $text = check_link_type_and_replace($patterns['link'][3], $replacements['link'][3], $text, 3);

                $bbcode_tpl['url4'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
                $bbcode_tpl['url4'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url4']);

                                // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
                $patterns['link'][4] = "#\[url=([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#si";
                $replacements['link'][4] = $bbcode_tpl['url4'];
                                $text = check_link_type_and_replace($patterns['link'][4], $replacements['link'][4], $text, 4);


                                $bbcode_tpl['email']= '<span class="bblink"><a href="mailto:{EMAIL}">{EMAIL}</a></span>';
                $bbcode_tpl['email'] = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']);

                                // [email]user@domain.tld[/email] code..
                $patterns['other'][1] = "#\[email\]([a-z0-9\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
                $replacements['other'][1] = $bbcode_tpl['email'];

                // [img]xxxx://www.phpbb.com[/img] code..
                $bbcode_tpl['img']  = '<img src="{URL}" alt="" />';
                $bbcode_tpl['img']  = str_replace('{URL}', '\\1\\2', $bbcode_tpl['img']);

                $patterns['other'][2] = "#\[img\]([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/img\]#si";
                $replacements['other'][2] = $bbcode_tpl['img'];

        }

        $text = preg_replace($patterns['other'], $replacements['other'], $text);

        return $text;
}

/**
* check_link_type_and_replace()
*
* Checks if the text contains this pattern and replace it accordingly
*
* @param string $pattern
* @param string $replacement
* @param string $text
* @param integer $stage
*
* @return string $text
*/
function check_link_type_and_replace ($pattern, $replacement, $text, $stage) {
        $ext_rel = 'rel="external nofollow" onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;"';
        $int_rel = '';

        if (preg_match($pattern, $text, $url) != 0) {
                switch ($stage) {
                        case 1:
                        case 3:
                                $url = $url[1] . $url[2];
                                break;
                        case 2:
                                $url = $url[1];
                                break;
                        case 4:
                                $url = 'http://' . $url[1];
                }
                if (is_link_local($url)) {
                        //apply regular formatting
                        $replacement_sprintfed = sprintf($replacement, $int_rel);
                } else {
                        //add rel attribute to link
                        $replacement_sprintfed = sprintf($replacement, $ext_rel);
                }

                $text = preg_replace($pattern, $replacement_sprintfed, $text, 1);
                $text = check_link_type_and_replace ($pattern, $replacement, $text, $stage);
        }

        return $text;
}

/**
* is_link_local()
*
* Determines if a URL is local or external. FROM phpBB MOD: prime links (by Ken F. Innes IV)
*
* @param string $url
* @param boolean $cpg_url
*
* @return boolean $is_local
*/
function is_link_local($url, $cpg_url = false)
{
        if ($cpg_url === false)
        {
                $cpg_url = generate_cpg_url();
        }
        $subdomain_remove_regex = '#^(http|https)://[^/]+?\.((?:[a-z0-9-]+\.[a-z]+)|localhost/)#i';
        $cpg_url = preg_replace($subdomain_remove_regex, '$1://$2', $cpg_url);
        $url          = preg_replace($subdomain_remove_regex, '$1://$2', $url);

        $is_local = (strpos($url, $cpg_url) === 0);
        if (!$is_local)
        {
                $protocol = substr($url, 0, strpos($url, ':'));
                $is_local = !$protocol || ($protocol && !in_array($protocol, array('http', 'https', 'mailto', 'ftp', 'gopher')));
        }
        return($is_local);
}


/**
* generate_cpg_url()
*
* Generate board url (example: http://www.foo.bar/cpg) FROM PHPBB 3.0.0
*
* @return string $cpg_url
*/
function generate_cpg_url()
{
                $superCage = Inspekt::makeSuperCage();
                $server_name = $superCage->server->keyExists('server_name') ? $superCage->server->getEscaped('server_name') : getenv('SERVER_NAME');
                $server_port = $superCage->server->keyExists('server_port') ? $superCage->server->getInt('server_port') : getenv('SERVER_PORT');

        // Do not rely on cookie_secure, users seem to think that it means a secured cookie instead of an encrypted connection
        $cookie_secure = ($superCage->server->keyExists('HTTPS') && $superCage->server->getAlpha('HTTPS') == 'on') ? 1 : 0;
        $cpg_url = (($cookie_secure) ? 'https://' : 'http://') . $server_name;


        if ($server_port && $cookie_secure)
        {
                $cpg_url .= ':' . $server_port;
        }

        // Strip / from the end
        if (substr($cpg_url, -1, 1) == '/')
        {
                $cpg_url = substr($cpg_url, 0, -1);
        }

        return $cpg_url;
}

/**************************************************************************
   Template functions
 **************************************************************************/

// Load and parse the template.html file

/**
 * load_template()
 *
 * Load and parse the template.html file
 *
 * @return
 **/

function load_template()
{
        global $THEME_DIR, $CONFIG, $template_header, $template_footer;

        if (file_exists($THEME_DIR . TEMPLATE_FILE)) {
            $template_file = $THEME_DIR . TEMPLATE_FILE;
        } else die("Coppermine critical error:<br />Unable to load template file ".TEMPLATE_FILE."!");

        $template = fread(fopen($template_file, 'r'), filesize($template_file));

        $template = CPGPluginAPI::filter('template_html',$template);

        $gallery_pos = strpos($template, '{LANGUAGE_SELECT_FLAGS}');
        $template = str_replace('{LANGUAGE_SELECT_FLAGS}', languageSelect('flags') ,$template);
        $gallery_pos = strpos($template, '{LANGUAGE_SELECT_LIST}');
        $template = str_replace('{LANGUAGE_SELECT_LIST}', languageSelect('list') ,$template);
        $gallery_pos = strpos($template, '{THEME_DIR}');
        $template = str_replace('{THEME_DIR}', $THEME_DIR ,$template);
        $gallery_pos = strpos($template, '{THEME_SELECT_LIST}');
        $template = str_replace('{THEME_SELECT_LIST}', themeSelect('list') ,$template);
        $gallery_pos = strpos($template, '{SOCIAL_BOOKMARKS}');
        $template = str_replace('{SOCIAL_BOOKMARKS}', theme_social_bookmark() ,$template);
        $gallery_pos = strpos($template, '{GALLERY}');
        if (!strstr($template, '{CREDITS}')) {
            $template = str_replace('{GALLERY}', '{CREDITS}' ,$template);
        } else {
            $template = str_replace('{GALLERY}', '' ,$template);
        }

        $template_header = substr($template, 0, $gallery_pos);
        $template_header = str_replace('{META}','{META}'.CPGPluginAPI::filter('page_meta',''),$template_header);

        // Filter gallery header and footer
        $template_header .= CPGPluginAPI::filter('gallery_header','');
        $template_footer = CPGPluginAPI::filter('gallery_footer','').substr($template, $gallery_pos);

        $add_version_info = "<!--Coppermine Photo Gallery ".COPPERMINE_VERSION." (".COPPERMINE_VERSION_STATUS.")-->\n</body>";
        $template_footer = ereg_replace("</body[^>]*>",$add_version_info,$template_footer);
}

// Eval a template (substitute vars with values)

/**
 * template_eval()
 *
 * @param $template
 * @param $vars
 * @return
 **/

function template_eval(&$template, &$vars)
{
        return strtr($template, $vars);
}


// Extract and return block '$block_name' from the template, the block is replaced by $subst

/**
 * template_extract_block()
 *
 * @param $template
 * @param $block_name
 * @param string $subst
 * @return
 **/

function template_extract_block(&$template, $block_name, $subst='')
{
        $pattern = "#(<!-- BEGIN $block_name -->)(.*?)(<!-- END $block_name -->)#s";
        if ( !preg_match($pattern, $template, $matches)) {
                die('<strong>Template error<strong><br />Failed to find block \''.$block_name.'\'('.htmlspecialchars($pattern).') in :<br /><pre>'.htmlspecialchars($template).'</pre>');
        }
        $template = str_replace($matches[1].$matches[2].$matches[3], $subst, $template);
        return $matches[2];
}

/**************************************************************************
   Functions for album/picture management
 **************************************************************************/

// Get the list of albums that the current user can't see

/**
 * get_private_album_set()
 *
 * @param string $aid_str
 * @return
 **/

//TODO: only load restricted albums in the currently viewed category filtering

function get_private_album_set($aid_str="")
{
        if (GALLERY_ADMIN_MODE) return;

        global $CONFIG, $USER_DATA, $FORBIDDEN_SET, $FORBIDDEN_SET_DATA;
        $superCage = Inspekt::makeSuperCage();
        ############################     DB     ################################
        global $cpg_db_functions_inc, $CONFIG;
        $cpgdb =& cpgDB::getInstance();
        $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
        ##################################################################

        $FORBIDDEN_SET_DATA = array();

        if ($USER_DATA['can_see_all_albums']) return;

        //Stuff for Album level passwords
        if ($superCage->cookie->keyExists($CONFIG['cookie_name']."_albpw") && empty($aid_str)) {

          //Using getRaw(). The data is sanitized in the foreach running just below
          $tmpStr = $superCage->cookie->getRaw($CONFIG['cookie_name']."_albpw");
          $alb_pw = unserialize(stripslashes($tmpStr));

          foreach($alb_pw as $aid => $value) {
            $aid_str .= (int)$aid . ",";
          }

          $aid_str = substr($aid_str, 0, -1);

          /*$sql = "SELECT aid, alb_password FROM ".$CONFIG['TABLE_ALBUMS']
                ." WHERE aid IN ($aid_str)";
          $result = cpg_db_query($sql);
          $albpw_db = array();
          if (mysql_num_rows($result)) {
            while ($data = mysql_fetch_array($result)) {
              $albpw_db[$data['aid']] = $data['alb_password'];
            }
          }*/
		  ###############################     DB    ################################
		  $cpgdb->query($cpg_db_functions_inc['get_private_alb_set_pwrd'], $aid_str);
		  $rowset = $cpgdb->fetchRowSet();
		  $albpw_db = array();
		  if (count($rowset)) {
			foreach ($rowset as $data) {
				$albpw_db[$data['aid']] = $data['alb_password'];
			}	//foreach
		  }
		  #####################################################################
          $valid = array_intersect($albpw_db, $alb_pw);
          if (is_array($valid)) {
            $aid_str = implode(",",array_keys($valid));
          } else {
            $aid_str = "";
          }
        }

        // restrict the private album set to only those in current cat tree branch

        $RESTRICTEDWHERE = "WHERE (1=1 ";	#####	cpgdbAL

        if (defined('RESTRICTED_PRIV')){

            if ($superCage->get->keyExists('cat')) {
                $cat = $superCage->get->getInt('cat');
            } else {
                $cat = 0;
            }

            if ($cat == USER_GAL_CAT){

                $RESTRICTEDWHERE = "WHERE (category > " . FIRST_USER_CAT;

            } elseif ($cat > FIRST_USER_CAT){

                $RESTRICTEDWHERE = "WHERE (category = $cat";

            } elseif ($cat > 0){

                /*$sql = "SELECT rgt, lft, depth FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = $cat LIMIT 1";
                $result = cpg_db_query($sql);
                list($rgt, $lft, $CURRENT_CAT_DEPTH) = mysql_fetch_row($result);*/	
                #############################    DB   #############################
                $cpgdb->query($cpg_db_functions_inc['get_rgt_lft_depth'], $cat);
                $row = $cpgdb->fetchRow();
                $rgt = $row['rgt'];
                $lft = $row['lft'];
                $CURRENT_CAT_DEPTH = $row['depth'];
                ##############################################################

                $RESTRICTEDWHERE = "INNER JOIN {$CONFIG['TABLE_CATEGORIES']} AS c2 ON c2.cid = category
                                        WHERE (c2.lft BETWEEN $lft AND $rgt";
            }
        }

        /*$sql = "SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} $RESTRICTEDWHERE "
                ." AND visibility != '0' AND visibility !='".(FIRST_USER_CAT + USER_ID)."'"
                ." AND visibility NOT IN ".USER_GROUP_SET.')';
        if (!empty($aid_str)) {
            $sql .= " AND aid NOT IN ($aid_str)";
        }

        $result = cpg_db_query($sql);
        if ((mysql_num_rows($result))) {
                $set ='';
            while ($album=mysql_fetch_array($result)) {
                    $set .= $album['aid'].',';
                    $FORBIDDEN_SET_DATA[] = $album['aid'];
            } // while	
            $FORBIDDEN_SET = "AND p.aid NOT IN (".substr($set, 0, -1).') ';
        } else {
                  $FORBIDDEN_SET_DATA = array();
                  $FORBIDDEN_SET = "";
        }
        mysql_free_result($result);*/
		##################################       DB      ####################################
		if (!empty($aid_str)) {
          $str_aid= " AND aid NOT IN ($aid_str)";
        } else {
			$str_aid = "";
		}

		$cpgdb->query($cpg_db_functions_inc['get_private_alb_set'], $RESTRICTEDWHERE, (FIRST_USER_CAT + USER_ID), USER_GROUP_SET, $str_aid);
		$rowset = $cpgdb->fetchRowSet();
		if (count($rowset)) {
			$set = '';
			foreach ($rowset as $album) {
				$set .= $album['aid'].',';
				$FORBIDDEN_SET_DATA[] = $album['aid'];
			}	//foreach
                $FORBIDDEN_SET = "AND p.aid NOT IN (".substr($set, 0, -1).') ';
        } else {
                  $FORBIDDEN_SET_DATA = array();
                  $FORBIDDEN_SET = "";
        }
		$cpgdb->free();
		##############################################################################
}

// Generate the thumbnail caption based on admin preference and thumbnail page requirements

/**
 * build_caption()
 *
 * @param array $rowset by reference
 * @param array $must_have
 **/
function build_caption(&$rowset,$must_have=array())
{
    global $CONFIG, $THEME_DIR;
    global $album_date_fmt, $lastcom_date_fmt, $lastup_date_fmt, $lasthit_date_fmt, $cat;
    global $lang_get_pic_data, $lang_meta_album_names, $lang_errors;

    foreach ($rowset as $key => $row) {
        $caption='';
        if ($CONFIG['display_filename']) {
          $caption .='<span class="thumb_filename">' . $row['filename'] . '</span>';
        }

        $caption .= ($row['title']) ? '<span class="thumb_title">' . $row['title'] . '</span>' : '';

        if ($CONFIG['views_in_thumbview'] || in_array('hits',$must_have)) {
            $caption .= '<span class="thumb_title">' . sprintf($lang_get_pic_data['n_views'], $row['hits']).'</span>';
        }
        if ($CONFIG['caption_in_thumbview']) {
            $caption .= $row['caption'] ? "<span class=\"thumb_caption\">".strip_tags(bb_decode($row['caption']))."</span>" : '';
        }
        if ($CONFIG['display_comment_count']) {
            $comments_nr = count_pic_comments($row['pid']);
            if ($comments_nr > 0) {
                $caption .= "<span class=\"thumb_num_comments\">".sprintf($lang_get_pic_data['n_comments'], $comments_nr )."</span>";
            }
        }
        if ($CONFIG['display_uploader'] /*&& !in_array($row['owner_id'],$CONFIG['ADMIN_USERS']) *|| ($CONFIG['display_admin_uploader'] && in_array($row['owner_id'],$CONFIG['ADMIN_USERS']))*/) {
            $caption .= ($row['owner_id'] && $row['owner_name']) ? '<span class="thumb_title"><a href ="profile.php?uid='.$row['owner_id'].'">'.$row['owner_name'].'</a></span>' : '';
        }

        if (in_array('msg_date',$must_have)) {
            $caption .= '<span class="thumb_caption">'.localised_date($row['msg_date'], $lastcom_date_fmt).'</span>';
        }
        if (in_array('msg_body',$must_have)) {
            $msg_body = strip_tags(bb_decode($row['msg_body'])); // I didn't want to fully bb_decode the message where report to admin isn't available. -donnoman
            $msg_body = utf_strlen($msg_body) > 50 ? utf_substr($msg_body,0,50).'...': $msg_body;
            if ($CONFIG['enable_smilies']) $msg_body = process_smilies($msg_body);
            if ($row['author_id']) {
                $caption .= '<span class="thumb_caption"><a href ="profile.php?uid='.$row['author_id'].'">'.$row['msg_author'].'</a>: '.$msg_body.'</span>';
            } else {
                    $caption .= '<span class="thumb_caption">'.$row['msg_author'].': '.$msg_body.'</span>';
            }
        }
        if (in_array('ctime',$must_have)) {
            $caption .= '<span class="thumb_caption">'.localised_date($row['ctime'], $lastup_date_fmt).'</span>';
        }
        if (in_array('pic_rating',$must_have)) {
            if (defined('THEME_HAS_RATING_GRAPHICS')) {
                $prefix= $THEME_DIR;
            } else {
                $prefix= '';
            }
      //calculate required amount of stars in picinfo
      $i = 1;
      $rating = round(($row['pic_rating'] / 2000) / (5/$CONFIG['rating_stars_amount']));
      $rating_images = '';
      while ($i <= $CONFIG['rating_stars_amount']) {
        if ($i <= $rating) {
          $rating_images .= '<img src="' . $prefix . 'images/rate_full.gif" alt="' . $rating . '"/>';
        } else {
          $rating_images .= '<img src="' . $prefix . 'images/rate_empty.gif" alt="' . $rating . '"/>';
        }
        $i++;
      }
            $caption .= "<span class=\"thumb_caption\">". $rating_images .'<br />'.sprintf($lang_get_pic_data['n_votes'], $row['votes']).'</span>';
        }
        if (in_array('mtime',$must_have)) {
                $caption .= "<span class=\"thumb_caption\">".localised_date($row['mtime'], $lasthit_date_fmt);
                if (GALLERY_ADMIN_MODE) {
                  $caption .="<br/>".$row['lasthit_ip'];
                }
                $caption .='</span>';
        }

        $rowset[$key]['caption_text'] = $caption;
    }
    $rowset = CPGPluginAPI::filter('thumb_caption',$rowset);
}

// Retrieve the data for a picture or a set of picture

/**
 * get_pic_data()
 *
 * @param $album
 * @param $count
 * @param $album_name
 * @param integer $limit1
 * @param integer $limit2
 * @param boolean $set_caption
 * @return
 **/

function get_pic_data($album, &$count, &$album_name, $limit1=-1, $limit2=-1, $set_caption = true) 
{
    global $USER, $CONFIG, $CURRENT_CAT_NAME, $CURRENT_ALBUM_KEYWORD, $HTML_SUBST, $THEME_DIR, $FAVPICS, $FORBIDDEN_SET_DATA, $USER_DATA;
    global $album_date_fmt, $lastcom_date_fmt, $lastup_date_fmt, $lasthit_date_fmt, $cat;
    global $lang_common, $lang_get_pic_data, $lang_meta_album_names, $lang_errors;
    global $lft, $rgt, $RESTRICTEDWHERE, $FORBIDDEN_SET;
    ############################     DB     ################################
    global $cpg_db_functions_inc, $CONFIG;
    $cpgdb =& cpgDB::getInstance();
    $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
    ##################################################################

    $superCage = Inspekt::makeSuperCage();

    $sort_array = array(
        'na' => 'filename ASC',
        'nd' => 'filename DESC',
        'ta'=>'title ASC',
        'td'=>'title DESC',
        'da' => 'pid ASC',
        'dd' => 'pid DESC',
        'pa' => 'position ASC',
        'pd' => 'position DESC',
    );

    $sort_code = isset($USER['sort'])? $USER['sort'] : $CONFIG['default_sort_order'];
    $sort_order = isset($sort_array[$sort_code]) ? $sort_array[$sort_code] : $sort_array[$CONFIG['default_sort_order']];
    //$limit = ($limit1 != -1) ? ' LIMIT '. $limit1 : '';
    //$limit .= ($limit2 != -1) ? ' ,'. $limit2 : '';
    #################       DB       ############   Added for mssql   ##############
    //$first_record = ($limit1 != -1) ? 'TOP '.$limit1 : 'TOP 0';		
    //$records_per_page = ($limit2 != -1) ? 'TOP '.$limit2 : '';
    ##############################################################
	$limit = $cpgdb->getLimits($limit1, $limit2);
	if (is_array($limit)) {
		$first_record = $limit[0];
		$records_per_page = $limit[1];
	}

    if ($limit2 == 1) {
        $select_columns = '*';
    } else {
        $select_columns = 'pid, filepath, filename, url_prefix, filesize, pwidth, pheight, ctime, aid, keywords, title';
    }

    if (count($FORBIDDEN_SET_DATA) > 0 ) {
        $forbidden_set_string =" AND aid NOT IN (".implode(",", $FORBIDDEN_SET_DATA).")";
    } else {
        $forbidden_set_string = '';
    }

    // Keyword
    if (!empty($CURRENT_ALBUM_KEYWORD)) {
        $keyword = "OR (keywords like '%$CURRENT_ALBUM_KEYWORD%' $forbidden_set_string )";
    } else {
        $keyword = '';
    }

    // Regular albums
    if ((is_numeric($album))) {
        $album_name_keyword = get_album_name($album);
        $album_name = $album_name_keyword['title'];
        $album_keyword = addslashes($album_name_keyword['keyword']);

        if (!empty($album_keyword)) {
            $keyword = "OR (keywords like '%$album_keyword%' $forbidden_set_string )";
        } else {
            $keyword = '';
        }

        if (array_key_exists('allowed_albums',$USER_DATA) && is_array($USER_DATA['allowed_albums']) 
                && in_array($album,$USER_DATA['allowed_albums'])) {
            $approved = '';
        } else {
            $approved = GALLERY_ADMIN_MODE ? '' : 'AND approved=\'YES\'';
        }

        $approved = GALLERY_ADMIN_MODE ? '' : 'AND approved=\'YES\'';

        /*$query = "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} 
                    WHERE ((aid='$album' $forbidden_set_string ) $keyword) $approved";
        $result = cpg_db_query($query);
        $nbEnr = mysql_fetch_array($result);
        $count = $nbEnr[0];
        mysql_free_result($result);

        if ($select_columns != '*') {
            $select_columns .= ', title, caption, hits, owner_id, owner_name, pic_rating, votes, approved';
        }

        $query = "SELECT $select_columns from {$CONFIG['TABLE_PICTURES']}
                    WHERE ((aid='$album' $forbidden_set_string ) $keyword) $approved
                    ORDER BY $sort_order $limit";
        $result = cpg_db_query($query);
        $rowset = cpg_db_fetch_rowset($result);
        mysql_free_result($result);*/
        ##############################################################
        $cpgdb->query($cpg_db_functions_inc['count_get_pic_data'], $album, $forbidden_set_string, $keyword, $approved);
        $nbEnr = $cpgdb->fetchRow();
        $count = $nbEnr['count'];
        $cpgdb->free();

        if ($select_columns != '*') {
            $select_columns .= ', caption, hits, owner_id, owner_name, pic_rating, votes, approved';	######	cpgdbAL
        }

        $cpgdb->query($cpg_db_functions_inc['get_pic_data'], $select_columns, $album, $forbidden_set_string, $keyword, 
        $approved, $sort_order, $limit, $first_record, $records_per_page);
        $rowset = $cpgdb->fetchRowSet();
        $cpgdb->free();
        ####################################################################
        // Set picture caption
        if ($set_caption) {
            if ($CONFIG['display_thumbnail_rating'] == 1) {
                build_caption($rowset, array('pic_rating'));
            } else {
                build_caption($rowset);
            }
        }
        $rowset = CPGPluginAPI::filter('thumb_caption_regular',$rowset);
        return $rowset;
    }


    // Meta albums
    switch($album) {
        case 'lastcom': // Last comments
            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('comment', 2) . $album_name = $lang_meta_album_names['lastcom'].' - '. $CURRENT_CAT_NAME;
            } else {
                $album_name = cpg_fetch_icon('comment', 2) . $lang_meta_album_names['lastcom'];
            }

            /*$query = "SELECT COUNT(*)
                	FROM {$CONFIG['TABLE_COMMENTS']} AS c
                	INNER JOIN {$CONFIG['TABLE_PICTURES']} AS r ON r.pid = c.pid
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON a.aid = r.aid
                	$RESTRICTEDWHERE
                	AND r.approved = 'YES'
                	AND c.approval = 'YES'";
                	
            $result = cpg_db_query($query);
            $nbEnr = mysql_fetch_array($result);
            $count = $nbEnr[0];
            mysql_free_result($result);	
            $select_columns = '*'; //allows building any data into any thumbnail caption
            if ($select_columns == '*') {
                $select_columns = 'r.*, msg_id, author_id, msg_author, UNIX_TIMESTAMP(msg_date) as msg_date, msg_body, r.aid';
            } else {
                $select_columns = str_replace('pid', 'c.pid', $select_columns).', msg_id, author_id, msg_author, UNIX_TIMESTAMP(msg_date) as msg_date, msg_body, aid';
            }

            $query = "SELECT $select_columns
                	FROM {$CONFIG['TABLE_COMMENTS']} AS c
                	INNER JOIN {$CONFIG['TABLE_PICTURES']} AS r ON r.pid = c.pid
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON a.aid = r.aid
                	$RESTRICTEDWHERE
                	AND r.approved = 'YES'
                	AND c.approval = 'YES'
                	ORDER BY msg_id DESC
                	$limit";

            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);*/
			####################################      DB     ######################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_lastcom'], $RESTRICTEDWHERE);
			$nbEnr = $cpgdb->fetchRow();
			$count = $nbEnr['count'];
			$cpgdb->free();

			$select_columns = '*'; //allows building any data into any thumbnail caption
			if($select_columns == '*'){
			  $select_columns = 'r.*, msg_id, author_id, msg_author, '.$msg_date = $cpgdb->timestamp('msg_date').'  as msg_date, msg_body, r.aid';
			} else {
			  $select_columns = str_replace('pid', 'c.pid', $select_columns).', msg_id, author_id, msg_author, '.$msg_date = $cpgdb->timestamp('msg_date').' as msg_date, msg_body, aid';
			}

			$cpgdb->query($cpg_db_functions_inc['get_pic_data_lastcom'], $select_columns, $RESTRICTEDWHERE, $limit, $first_record, $records_per_page);
			$rowset = $cpgdb->fetchRowSet();
			$cpgdb->free();
			#################################################################################

            if ($set_caption) {
                build_caption($rowset,array('msg_body','msg_date'));
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_lastcom',$rowset);

            return $rowset;
            break;

        case 'lastcomby': // Last comments by a specific user
            if (isset($USER['uid'])) {
                $uid = (int)$USER['uid'];
            } else {
                $uid = -1;
            }

            $user_name = get_username($uid);
            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('comment', 2) . $album_name = $lang_meta_album_names['lastcom'].' - '. $CURRENT_CAT_NAME .' - '. $user_name;
            } else {
                $album_name = cpg_fetch_icon('comment', 2) . $lang_meta_album_names['lastcom'].' - '. $user_name;
            }

            /*$query = "SELECT COUNT(*)
                	FROM {$CONFIG['TABLE_COMMENTS']} AS c
                	INNER JOIN {$CONFIG['TABLE_PICTURES']} AS r ON r.pid = c.pid
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON a.aid = r.aid
                	$RESTRICTEDWHERE
                	AND author_id = '$uid'
                	AND r.approved = 'YES'
                	AND c.approval = 'YES'";

            $result = cpg_db_query($query);
            $nbEnr = mysql_fetch_array($result);
            $count = $nbEnr[0];
            mysql_free_result($result);

            $select_columns = 'r.*, c.*, UNIX_TIMESTAMP(msg_date) AS msg_date'; //allows building any data into any thumbnail caption
            $query = "SELECT $select_columns
                	FROM {$CONFIG['TABLE_COMMENTS']} AS c
                	INNER JOIN {$CONFIG['TABLE_PICTURES']} AS r ON r.pid = c.pid
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON a.aid = r.aid
                	$RESTRICTEDWHERE
                	AND author_id = '$uid'
                	AND r.approved = 'YES'
                	AND c.approval = 'YES'
                	ORDER BY msg_id DESC
                	$limit";
                	
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);*/
			##################################      DB     ###################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_lastcomby'], $RESTRICTEDWHERE, $uid);
			$nbEnr = $cpgdb->fetchRow();
			$count = $nbEnr['count'];
			$cpgdb->free();

			$select_columns = 'r.*, c.*, '.$cpgdb->timestamp('msg_date').' AS msg_date'; //allows building any data into any thumbnail caption
			$cpgdb->query($cpg_db_functions_inc['get_pic_data_lastcomby'], $select_columns, $RESTRICTEDWHERE, $uid, $limit, $first_record, $records_per_page);
			$rowset = $cpgdb->fetchRowSet();
			$cpgdb->free();
			############################################################################

            if ($set_caption) {
                build_caption($rowset,array('msg_body','msg_date'));
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_lastcomby',$rowset);

            return $rowset;
            break;

        case 'lastup': // Last uploads
            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('last_uploads', 2) . $lang_meta_album_names['lastup'].' - '. $CURRENT_CAT_NAME;
            } else {
                $album_name = cpg_fetch_icon('last_uploads', 2) . $lang_meta_album_names['lastup'];
            }

            /*$query = "SELECT COUNT(*)
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'";

            //$query = "SELECT COUNT(pid) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $META_ALBUM_SET";
            $result = cpg_db_query($query);
            $nbEnr = mysql_fetch_array($result);
            $count = $nbEnr[0];
            mysql_free_result($result);

            //if ($select_columns != '*' ) $select_columns .= ',title, caption, owner_id, owner_name, aid';
            $select_columns = '*'; //allows building any data into any thumbnail caption
            $query = "SELECT $select_columns
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				ORDER BY p.pid DESC $limit";

            // $query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $META_ALBUM_SET ORDER BY pid DESC $limit";

            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);*/
			################################            DB           ###################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_lastup'], $RESTRICTEDWHERE);
			$nbEnr = $cpgdb->fetchRow();
			$count = $nbEnr['count'];
			$cpgdb->free();
			
			$select_columns = '*'; //allows building any data into any thumbnail caption
			$cpgdb->query($cpg_db_functions_inc['get_pic_data_lastup'], $select_columns, $RESTRICTEDWHERE, $limit, $first_record, $records_per_page);
			$rowset = $cpgdb->fetchRowSet();
			$cpgdb->free();
			###############################################################################

            if ($set_caption) {
                build_caption($rowset,array('ctime'));
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_lastup',$rowset);

            return $rowset;
            break;

        case 'lastupby': // Last uploads by a specific user
            if (isset($USER['uid'])) {
                $uid = (int)$USER['uid'];
            } else {
                $uid = -1;
            }

            $user_name = get_username($uid);
            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('last_uploads', 2) . $lang_meta_album_names['lastup'].' - '. $CURRENT_CAT_NAME .' - '. $user_name;
            } else {
                $album_name = cpg_fetch_icon('last_uploads', 2) . $lang_meta_album_names['lastup'] .' - '. $user_name;
            }

            /*$query = "SELECT COUNT(*)
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND p.owner_id = '$uid'
       				AND approved = 'YES'";

            $result = cpg_db_query($query);
            $nbEnr = mysql_fetch_array($result);
            $count = $nbEnr[0];
            mysql_free_result($result);

            //if ($select_columns != '*' ) $select_columns .= ', owner_id, owner_name, aid';
            $select_columns = 'p.*'; //allows building any data into any thumbnail caption
            $query = "SELECT $select_columns
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND p.owner_id = '$uid'
       				AND approved = 'YES'
       				ORDER BY pid DESC
       				$limit";
       				
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);*/
			#####################################         DB        #####################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_lastupby'], $RESTRICTEDWHERE, $uid);
			$nbEnr = $cpgdb->fetchRow();
			$count = $nbEnr['count'];
			$cpgdb->free();
			
			$select_columns = 'p.*'; //allows building any data into any thumbnail caption
			
			$cpgdb->query($cpg_db_functions_inc['get_pic_data_lastupby'], $select_columns, $RESTRICTEDWHERE, $uid, $limit, $first_record, $records_per_page);
			$rowset = $cpgdb->fetchRowSet();
			$cpgdb->free();
			####################################################################################

            if ($set_caption) {
                build_caption($rowset,array('ctime'));
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_lastupby',$rowset);

            return $rowset;
            break;

        case 'topn': // Most viewed pictures
            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('most_viewed', 2) . $lang_meta_album_names['topn'].' - '. $CURRENT_CAT_NAME;
            } else {
                $album_name = cpg_fetch_icon('most_viewed', 2) . $lang_meta_album_names['topn'];
            }

            /*$query = "SELECT COUNT(*)
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				AND hits > 0";

            $result = cpg_db_query($query);
            $nbEnr = mysql_fetch_array($result);
            $count = $nbEnr[0];
            mysql_free_result($result);

            //if ($select_columns != '*') $select_columns .= ', hits, aid, filename, owner_id, owner_name';
            $select_columns = 'p.*'; //allows building any data into any thumbnail caption

            $query = "SELECT $select_columns
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				AND hits > 0
       				ORDER BY hits DESC, pid
       				$limit";
       				
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);*/
			######################################        DB        #####################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_topn'], $RESTRICTEDWHERE);
			$nbEnr = $cpgdb->fetchRow();
			$count = $nbEnr['count'];
			$cpgdb->free();
			
			$select_columns = 'p.*'; //allows building any data into any thumbnail caption
			
			$cpgdb->query($cpg_db_functions_inc['get_pic_data_topn'], $select_columns, $RESTRICTEDWHERE, $limit, $first_record, $records_per_page);
			$rowset = $cpgdb->fetchRowSet();
			$cpgdb->free();
			####################################################################################

            if ($set_caption) {
                build_caption($rowset,array('hits'));
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_topn',$rowset);

            return $rowset;
            break;

        case 'toprated': // Top rated pictures
            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('top_rated', 2) . $lang_meta_album_names['toprated'].' - '. $CURRENT_CAT_NAME;
            } else {
                $album_name = cpg_fetch_icon('top_rated', 2) . $lang_meta_album_names['toprated'];
            }

            /*$query = "SELECT COUNT(*)
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				AND p.votes > '{$CONFIG['min_votes_for_rating']}'";
       				
            $result = cpg_db_query($query);
            $nbEnr = mysql_fetch_array($result);
            $count = $nbEnr[0];
            mysql_free_result($result);

            //if ($select_columns != '*') $select_columns .= ', pic_rating, votes, aid, owner_id, owner_name';
            $select_columns = 'p.*'; //allows building any data into any thumbnail caption

            $query = "SELECT $select_columns
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				AND p.votes > '{$CONFIG['min_votes_for_rating']}'
       				ORDER BY pic_rating DESC, p.votes DESC, pid DESC
       				$limit";
       				
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);*/
			######################################        DB        #####################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_toprated'], $RESTRICTEDWHERE, $CONFIG['min_votes_for_rating']);
			$nbEnr = $cpgdb->fetchRow();
			$count = $nbEnr['count'];
			$cpgdb->free();
			
			$select_columns = 'p.*'; //allows building any data into any thumbnail caption
			
			$cpgdb->query($cpg_db_functions_inc['get_pic_data_toprated'], $select_columns, $RESTRICTEDWHERE, $CONFIG['min_votes_for_rating'], $limit, $first_record, $records_per_page);
			$rowset = $cpgdb->fetchRowSet();
			$cpgdb->free();
			####################################################################################

            if ($set_caption) {
                build_caption($rowset,array('pic_rating'));
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_toprated',$rowset);

            return $rowset;
            break;

        case 'lasthits': // Last viewed pictures
            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('last_viewed', 2) . $lang_meta_album_names['lasthits'].' - '. $CURRENT_CAT_NAME;
            } else {
                $album_name = cpg_fetch_icon('last_viewed', 2) . $lang_meta_album_names['lasthits'];
            }

            /*$query = "SELECT COUNT(*)
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				AND hits > 0";
       				
            $result = cpg_db_query($query);
            $nbEnr = mysql_fetch_array($result);
            $count = $nbEnr[0];
            mysql_free_result($result);

            //if ($select_columns != '*') $select_columns .= ', UNIX_TIMESTAMP(mtime) as mtime, aid, hits, lasthit_ip, owner_id, owner_name';
            $select_columns = 'p.*, UNIX_TIMESTAMP(mtime) as mtime'; //allows building any data into any thumbnail caption

            $query = "SELECT $select_columns
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				AND hits > 0
       				ORDER BY mtime DESC
       				$limit";
       				
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);*/
			#######################################        DB       ######################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_lasthits'], $RESTRICTEDWHERE);
			$nbEnr = $cpgdb->fetchRow();
			$count = $nbEnr['count'];
			$cpgdb->free();
			
			$select_columns = 'p.*, '.$cpgdb->timestamp('mtime').' as mtime'; //allows building any data into any thumbnail caption
			
			$cpgdb->query($cpg_db_functions_inc['get_pic_data_lasthits'], $select_columns, $RESTRICTEDWHERE, $limit, $first_record, $records_per_page);
			$rowset = $cpgdb->fetchRowSet();
			$cpgdb->free();
			#####################################################################################

            if ($set_caption) {
                build_caption($rowset,array('mtime','hits'));
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_lasthits',$rowset);

            return $rowset;
            break;

        case 'random': // Random pictures
            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('random', 2) . $lang_meta_album_names['random'].' - '. $CURRENT_CAT_NAME;
            } else {
                $album_name = cpg_fetch_icon('random', 2) . $lang_meta_album_names['random'];
            }

            /*$query = "SELECT COUNT(*)
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'";

            $result = cpg_db_query($query);
            $nbEnr = mysql_fetch_array($result);
            $pic_count = $nbEnr[0];
            mysql_free_result($result);

            $query = "SELECT pid
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				ORDER BY RAND()
       				$limit";
       				
            //$query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $META_ALBUM_SET ORDER BY RAND() LIMIT $limit2";

            $result = cpg_db_query($query);
            $pidlist = array();
            while ($row = mysql_fetch_assoc($result)) {
                $pidlist[] = $row['pid'];
            }
            mysql_free_result($result);
            
            sort($pidlist);
            
            //if ($select_columns != '*') $select_columns .= ', aid, owner_id, owner_name';
            $select_columns = '*'; //allows building any data into any thumbnail caption

            $query = "SELECT $select_columns
                    FROM {$CONFIG['TABLE_PICTURES']} AS p
                    INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                    WHERE pid IN (" . implode(', ', $pidlist) . ")";

            //$query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $META_ALBUM_SET ORDER BY RAND() LIMIT $limit2";
            $rowset = array();
            // Fire the query if at least one pid is in pidlist array
            if (count($pidlist)) {
                $result = cpg_db_query($query);
                while ($row = mysql_fetch_array($result)) {
                    $rowset[-$row['pid']] = $row;
                }
                mysql_free_result($result);
            }*/
			#####################################         DB         #######################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_random'], $RESTRICTEDWHERE);
			$nbEnr = $cpgdb->fetchRow();
			$count = $nbEnr['count'];
			$cpgdb->free();

			$cpgdb->query($cpg_db_functions_inc['get_random_pid'], $RESTRICTEDWHERE, $limit, $first_record, $records_per_page);
			$pidlist = array();
			while ($row = $cpgdb->fetchRow()) {
				$pidlist[] = $row['pid'];
			}
			$cpgdb->free();

            sort($pidlist);

            $rowset = array();
            // Fire the query if at least one pid is in pidlist array
            if (count($pidlist)) {
                //if ($select_columns != '*') $select_columns .= ', aid, owner_id, owner_name';
                $select_columns = '*'; //allows building any data into any thumbnail caption
                $cpgdb->query($cpg_db_functions_inc['get_pic_data_random'], $select_columns, implode(', ', $pidlist));

                while($row = $cpgdb->fetchRow()) {
                    $rowset[-$row['pid']] = $row;
                }
                $cpgdb->free();
            }
			######################################################################################

            if ($set_caption) {
                build_caption($rowset);
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_random',$rowset);

            return $rowset;
            break;

        case 'search': // Search results
            if (isset($USER['search']['search'])) {
                $search_string = $USER['search']['search'];
            } else {
                $search_string = '';
            }

            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('search', 2) . $lang_meta_album_names['search'].' - '. $CURRENT_CAT_NAME;
            } else {
                $album_name = cpg_fetch_icon('search', 2) . $lang_meta_album_names['search'].' - "'. strip_tags($search_string) . '"';
            }

            include 'include/search.inc.php';

            $rowset = CPGPluginAPI::filter('thumb_caption_search',$rowset);

            return $rowset;
            break;

        case 'lastalb': // Last albums to which uploads
            if ($cat && $CURRENT_CAT_NAME) {
                $album_name = cpg_fetch_icon('last_created', 2) . $lang_meta_album_names['lastalb'].' - '. $CURRENT_CAT_NAME;
            } else {
                $album_name = cpg_fetch_icon('last_created', 2) . $lang_meta_album_names['lastalb'];
            }

            /*$query = "SELECT COUNT(*)
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				GROUP BY p.aid";

            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            mysql_free_result($result);

            $query = "SELECT *, r.title AS title, r.aid AS aid 
                	FROM {$CONFIG['TABLE_PICTURES']} AS p
                	INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       				$RESTRICTEDWHERE
       				AND approved = 'YES'
       				GROUP BY p.aid
       				ORDER BY p.ctime DESC
       				$limit";
       				
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);*/
			##########################################       DB       ##########################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_lastalb'], $RESTRICTEDWHERE);
			$count = count($cpgdb->fetchRowSet);
			$cpgdb->free();
			
			$cpgdb->query($cpg_db_functions_inc['get_pic_data_lastalb'], $RESTRICTEDWHERE, $limit, $first_record, $records_per_page);
			$rowset = $cpgdb->fetchRowSet();
			$cpgdb->free();
			############################################################################################

            if ($set_caption) {
                build_caption($rowset,array('ctime'));
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_lastalb',$rowset);

            return $rowset;
            break;

        case 'favpics': // Favourite Pictures
            $album_name = cpg_fetch_icon('favorites', 2) . $lang_meta_album_names['favpics'];
            $rowset = array();
            if (count($FAVPICS)>0) {
                $favs = implode(",",$FAVPICS);

                /*$query = "SELECT COUNT(*)
                				FROM {$CONFIG['TABLE_PICTURES']} AS p
                				INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       							$RESTRICTEDWHERE
       							AND approved = 'YES'
       							AND pid IN ($favs)";
       							
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                $select_columns = '*';

                $query = "SELECT $select_columns
                				FROM {$CONFIG['TABLE_PICTURES']} AS p
                				INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
       							$RESTRICTEDWHERE
       							AND approved = 'YES'
       							AND pid IN ($favs)
       							$limit";
       							
                $result = cpg_db_query($query);
                $rowset = cpg_db_fetch_rowset($result);

                mysql_free_result($result);*/
				####################################       DB       ######################################
				$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_favpics'], $RESTRICTEDWHERE, $favs);
				$nbEnr = $cpgdb->fetchRow();
				$count = $nbEnr['count'];
				$cpgdb->free();
				
				$select_columns = '*';
				$cpgdb->query($cpg_db_functions_inc['get_pic_data_favpics'],$select_columns, $RESTRICTEDWHERE, $favs, $limit, $first_record, $records_per_page);
				$rowset = $cpgdb->fetchRowSet();
				$cpgdb->free();
				##################################################################################

                if ($set_caption) {
                    build_caption($rowset,array('ctime'));
                }
            }

            $rowset = CPGPluginAPI::filter('thumb_caption_favpics',$rowset);

            return $rowset;
            break;

        case 'datebrowse': // Browsing by uploading date
            //Using getRaw(). The date is sanitized in the called function
            $date = $superCage->get->keyExists('date') ? cpgValidateDate($superCage->get->getEscaped('date')) : null;
            $album_name = cpg_fetch_icon('calendar', 2) . $lang_common['date'] . ': '. $date;
            $rowset = array();

            /*$query = "SELECT COUNT(*)
                    FROM {$CONFIG['TABLE_PICTURES']} AS p
                    INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                    $RESTRICTEDWHERE
                    AND approved = 'YES'
                    AND substring(from_unixtime(ctime),1,10) = '".substr($date,0,10)."'";

            $result = cpg_db_query($query);
            $nbEnr = mysql_fetch_array($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            $select_columns = '*';

            $query = "SELECT $select_columns
                    FROM {$CONFIG['TABLE_PICTURES']} AS p
                    INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                    $RESTRICTEDWHERE
                    AND approved = 'YES'
                    AND substring(from_unixtime(ctime),1,10) = '".substr($date,0,10)."'
                    $limit";

            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);*/
			####################################       DB       ######################################
			$cpgdb->query($cpg_db_functions_inc['count_get_pic_data_datebrowse'], $RESTRICTEDWHERE, substr($date,0,10));
			$nbEnr = $cpgdb->fetchRow();
			$count = $nbEnr['count'];
			$cpgdb->free();
			$select_columns = '*';
			$cpgdb->query($cpg_db_functions_inc['get_pic_data_datebrowse'],$select_columns, $RESTRICTEDWHERE, substr($date,0,10), $limit, $first_record, $records_per_page);
			$rowset = $cpgdb->fetchRowSet();
			$cpgdb->free();
			##################################################################################

            if ($set_caption) {
                build_caption($rowset,array('ctime'));
            }
            return $rowset;
            break;
        default : // Invalid meta album
            cpg_die(ERROR, $lang_errors['non_exist_ap']." - $album", __FILE__, __LINE__);
    } // switch
} // function get_pic_data

// Copy of get_pic_data, created to obtain position for the given pid in the given album
function get_pic_pos($album, $pid) 
{
    global $USER, $CONFIG, $CURRENT_CAT_NAME, $CURRENT_ALBUM_KEYWORD, $HTML_SUBST, $THEME_DIR, $FAVPICS, $FORBIDDEN_SET_DATA, $USER_DATA;
    global $album_date_fmt, $lastcom_date_fmt, $lastup_date_fmt, $lasthit_date_fmt, $cat;
    global $lang_common, $lang_get_pic_data, $lang_meta_album_names, $lang_errors;
    global $lft, $rgt, $RESTRICTEDWHERE, $FORBIDDEN_SET;
    ####################     DB     ###################
    global $cpg_db_functions_inc;
    $cpgdb =& cpgDB::getInstance();
    $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
    ############################################

    $superCage = Inspekt::makeSuperCage();

    $sort_array = array(
        'na' => 'filename <',
        'nd' => 'filename >',
        'ta' => 'title <',
        'td' => 'title >',
        'da' => 'pid <',
        'dd' => 'pid >',
        'pa' => 'position <',
        'pd' => 'position >',
    );

    $sort_code = isset($USER['sort'])? $USER['sort'] : $CONFIG['default_sort_order'];
    $comp_order = isset($sort_array[$sort_code]) ? $sort_array[$sort_code] : $sort_array[$CONFIG['default_sort_order']];

    if (count($FORBIDDEN_SET_DATA) > 0 ) {
        $forbidden_set_string =" AND aid NOT IN (".implode(",", $FORBIDDEN_SET_DATA).")";
    } else {
        $forbidden_set_string = '';
    }

    // Keyword
    if (!empty($CURRENT_ALBUM_KEYWORD)) {
        $keyword = "OR (keywords like '%$CURRENT_ALBUM_KEYWORD%' $forbidden_set_string )";
    } else {
        $keyword = '';
    }

    // Regular albums
    if ((is_numeric($album))) {
        $album_name_keyword = get_album_name($album);
        $album_name = $album_name_keyword['title'];
        $album_keyword = addslashes($album_name_keyword['keyword']);

        if (!empty($album_keyword)) {
            $keyword = "OR (keywords like '%$album_keyword%' $forbidden_set_string )";
        } else {
            $keyword = '';
        }

        if (array_key_exists('allowed_albums',$USER_DATA) && is_array($USER_DATA['allowed_albums']) 
                && in_array($album,$USER_DATA['allowed_albums'])) {
            $approved = '';
        } else {
            $approved = GALLERY_ADMIN_MODE ? '' : 'AND approved=\'YES\'';
        }

        $approved = GALLERY_ADMIN_MODE ? '' : 'AND approved=\'YES\'';

			list($param) = explode(' ', $comp_order);

    		/*$result = cpg_db_query("SELECT filename, title, pid, position FROM {$CONFIG['TABLE_PICTURES']}  WHERE pid = $pid");
    		
    	
    		$pic = mysql_fetch_assoc($result);

			
        $query = "SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']}
                    WHERE ((aid='$album' $forbidden_set_string ) $keyword) $approved
                    AND $comp_order '{$pic[$param]}'";
                    
        $result = cpg_db_query($query);
        list($pos) = mysql_fetch_row($result);
        mysql_free_result($result);*/
        ############################################      DB     #######################################
        $result = $cpgdb->query($cpg_db_functions_inc['get_pic_pos'], $pid);

        $pic = $cpgdb->fetchRow();

        $result = $cpgdb->query($cpg_db_functions_inc['count_get_pic_pos'], $album, $forbidden_set_string, 
                                    $keyword, $approved, $comp_order, $pic[$param]);

        $row = $cpgdb->fetchRow();
        $pos = $row['count'];
        $cpgdb->free();
        unset($row);
        #########################################################################################

        return $pos;
    }


    // Meta albums
    switch($album) {

        case 'lastup': // Last uploads

            /*$query = "SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} AS p
                    INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                    $RESTRICTEDWHERE
                    AND approved = 'YES'
						  AND pid > $pid";
	                    
	         $result = cpg_db_query($query);
	         list($pos) = mysql_fetch_row($result);
	         mysql_free_result($result);*/
             #######################################     DB     #####################################
             $cpgdb->query($cpg_db_functions_inc['get_pic_pos_lastup'], $RESTRICTEDWHERE, $pid);
             $row = $cpgdb->fetchRow();
             $pos = $row['count'];
             $cpgdb->free();
             unset($row);
             #################################################################################

            return $pos;
            break;

        default : // Invalid meta album
            return FALSE;
    } // switch
} // function get_pic_pos

// Get the name of an album

/**
 * get_album_name()
 *
 * @param $aid
 * @return
 **/

/*function get_album_name($aid)
{
    global $CONFIG;
    global $lang_errors;

    $result = cpg_db_query("SELECT title,keyword from {$CONFIG['TABLE_ALBUMS']} WHERE aid='$aid'");
    $count = mysql_num_rows($result);
    if ($count > 0) {
        $row = mysql_fetch_array($result);
        return $row;
    } else {
        cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    }
} // function get_album_name*/

###############################     DB     ################################
function get_album_name($aid)
{
	    global $CONFIG;
	    global $lang_errors;
		global $cpg_db_functions_inc;
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);

		$cpgdb->query($cpg_db_functions_inc['get_album_name'], $aid);
		$rowset = $cpgdb->fetchRowSet();
		$count = count($rowset);

		if ($count > 0) {
				$row = $rowset[0]; 
				return $row;
		} else {
				cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
		}
} // function get_album_name
########################################################################


// Return the name of a user

/**
 * get_username()
 *
 * @param $uid
 * @return
 **/
function get_username($uid)
{
    global $CONFIG, $cpg_udb;

    $uid = (int)$uid;

    if (!$uid) {
        return 'Anonymous';
    } elseif (defined('UDB_INTEGRATION')) {
        return $cpg_udb->get_user_name($uid);
    /*
    } else {
        $result = cpg_db_query("SELECT user_name FROM {$CONFIG['TABLE_USERS']} WHERE user_id = '".$uid."'");
        if (mysql_num_rows($result) == 0) {
            return '';
        }
        $row = mysql_fetch_array($result);
        mysql_free_result($result);
        return $row['user_name'];
    */
    }
} // function get_username


// Return the ID of a user

/**
 * get_userid()
 *
 * @param $username
 * @return
 **/
function get_userid($username)
{
        global $CONFIG, $cpg_udb;

        $username = addslashes($username);

        if (!$username) {
            return 0;
        } elseif (defined('UDB_INTEGRATION')) { // (Altered to fix banning w/ bb integration - Nibbler)
           return $cpg_udb->get_user_id($username);
        /*} else {
                $result = cpg_db_query("SELECT user_id FROM {$CONFIG['TABLE_USERS']} WHERE user_name = '".$username."'");
                if (mysql_num_rows($result) == 0) return 0;
                $row = mysql_fetch_array($result);
                mysql_free_result($result);
                return $row['user_id'];*/
        }
}

// get number of pending approvals

/**
 * cpg_get_pending_approvals()
 *
 * @return
 **/
/*function cpg_get_pending_approvals()
{
    global $CONFIG;
    $result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'NO'");
    if (mysql_num_rows($result) == 0) return 0;
    $row = mysql_fetch_array($result);
    mysql_free_result($result);
    return $row[0];
}	*/
###################################       DB        ###################################
function cpg_get_pending_approvals()
{
    global $CONFIG;
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
    $cpgdb->query($cpg_db_functions_inc['get_pending_approvals']);
	$rowset = $cpgdb->fetchRowSet();
    if (count($rowset) == 0) return 0;
    $row = $rowset[0];
    $cpgdb->free();
    return $row['count'];
}
##############################################################################
// Return the total number of comments for a certain picture

/**
 * count_pic_comments()
 *
 * @param $pid
 * @param integer $skip
 * @return
 **/
/*function count_pic_comments($pid, $skip=0)
{
        global $CONFIG;
        $result = cpg_db_query("SELECT count(msg_id) from {$CONFIG['TABLE_COMMENTS']} where pid=$pid and msg_id!=$skip");
        $nbEnr = mysql_fetch_array($result);
        $count = $nbEnr[0];
        mysql_free_result($result);

        return $count;
}	*/
###################################       DB      ####################################
function count_pic_comments($pid, $skip=0)
{
        global $CONFIG;
		global $cpg_db_functions_inc;
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
        $cpgdb->query($cpg_db_functions_inc['count_pic_comments'], $pid, $skip);
        $nbEnr = $cpgdb->fetchRow();
        $count = $nbEnr['count'];
        $cpgdb->free();
        return $count;
}
##############################################################################

/******************
/**
 * cpg_determine_client()
 *
 * @param
 * @return $return_array
 **/
function cpg_determine_client($pid)
{
        global $CONFIG;

        //Making Cage
        $superCage = Inspekt::makeSuperCage();

        /**
         * Populate the client stats
         */
        // Get the details of user browser, IP, OS, etc
        $os = 'Unknown';
        $server_agent = $superCage->server->getEscaped('HTTP_USER_AGENT');
        if (eregi('Ubuntu',$server_agent)) {
            $os = 'Linux Ubuntu';
        } elseif (eregi('Debian',$server_agent)) {
            $os = 'Linux Debian';
        } elseif (eregi('CentOS',$server_agent)) {
            $os = 'Linux CentOS';
        } elseif (eregi('Fedora',$server_agent)) {
            $os = 'Linux Fedora';
        } elseif (eregi('Mandrake',$server_agent)) {
            $os = 'Linux Mandrake';
        } elseif (eregi('RedHat',$server_agent)) {
            $os = 'Linux RedHat';
        } elseif (eregi('Suse',$server_agent)) {
            $os = 'Linux Suse';
        } elseif (eregi('Linux',$server_agent)) {
            $os = 'Linux';
        } elseif (eregi('Windows NT 5.0',$server_agent)) {
            $os = 'Windows 2000';
        } elseif (eregi('win98|Windows 98',$server_agent)) {
            $os = 'Windows 98';
        } elseif (eregi('Windows NT 5.1',$server_agent)) {
            $os = 'Windows XP';
        } elseif (eregi('Windows NT 5.2',$server_agent)) {
            $os = 'Windows 2003 Server';
        } elseif (eregi('Windows NT 6.0',$server_agent)) {
            $os = 'Windows Vista';
        } elseif (eregi('Windows CE',$server_agent)) {
            $os = 'Windows CE';
        } elseif (eregi('Windows',$server_agent)) {
            $os = 'Windows';
        } elseif (eregi('SunOS',$server_agent)) {
            $os = 'Sun OS';
        } elseif (eregi('Macintosh',$server_agent)) {
            $os = 'Macintosh';
        } elseif (eregi('Mac_PowerPC',$server_agent)) {
            $os = 'Mac OS';
        } elseif (eregi('Mac_PPC',$server_agent)) {
            $os = 'Macintosh';
        } elseif (eregi('OS/2',$server_agent)) {
            $os = 'OS/2';
		} elseif (eregi('aix',$server_agent)) {
            $os = 'aix';
		} elseif (eregi('FreeBSD',$server_agent)) {
            $os = 'BSD FreeBSD';
		} elseif (eregi('Unix',$server_agent)) {
            $os = 'Unix';
		} elseif (eregi('iphone',$server_agent)) {
            $os = 'iPhone';
        }

        $browser = 'Unknown';
        if (eregi('MSIE',$server_agent)) {
            if (eregi('MSIE 5.5',$server_agent)) {
                $browser = 'IE5.5';
            } elseif (eregi('MSIE 6.0',$server_agent)) {
                $browser = 'IE6';
            } elseif (eregi('MSIE 7.0',$server_agent)) {
                $browser = 'IE7';
            } elseif (eregi('MSIE 8.0',$server_agent)) {
                $browser = 'IE8';
            } elseif (eregi('MSIE 3.0',$server_agent)) {
                $browser = 'IE3';
            } elseif (eregi('MSIE 4.0',$server_agent)) {
                $browser = 'IE4';
            } elseif (eregi('MSIE 5.0',$server_agent)) {
                $browser = 'IE5.0';
            }
        } elseif (eregi('Epiphany',$server_agent)) {
            $browser = 'Epiphany';
        } elseif (eregi('Phoenix',$server_agent)) {
            $browser = 'Phoenix';        
        } elseif (eregi('Firebird',$server_agent)) {
            $browser = 'Mozilla Firebird';
        } elseif (eregi('netscape',$server_agent)) {
            $browser = 'Netscape';
        } elseif (eregi('Chrome',$server_agent)) {
            $browser = 'Chrome';
        } elseif (eregi('Firefox',$server_agent)) {
            $browser = 'Firefox';
        } elseif (eregi('Galeon',$server_agent)) {
            $browser = 'Galeon';
        } elseif (eregi('Camino',$server_agent)) {
            $browser = 'Camino';
        } elseif (eregi('Konqueror',$server_agent)) {
            $browser = 'Konqueror';
        } elseif (eregi('Safari',$server_agent)) {
            $browser = 'Safari';
        } elseif (eregi('OmniWeb',$server_agent)) {
            $browser = 'OmniWeb';
        } elseif (eregi('Opera',$server_agent)) {
            $browser = 'Opera';
        } elseif (eregi('HTTrack',$server_agent)) {
        	$browser = 'HTTrack';
        } elseif (eregi('OffByOne',$server_agent)) {
            $browser = 'Off By One';
        } elseif (eregi('amaya',$server_agent)) {
            $browser = 'Amaya';
        } elseif (eregi('iCab',$server_agent)) {
            $browser = 'iCab';
        } elseif (eregi('Lynx',$server_agent)) {
            $browser = 'Lynx';
        } elseif (eregi('Googlebot',$server_agent)) {
            $browser = 'Googlebot';
        } elseif (eregi('Lycos_Spider',$server_agent)) {
            $browser = 'Lycos Spider';
        } elseif (eregi('Firefly',$server_agent)) {
            $browser = 'Fireball Spider';
        } elseif (eregi('Advanced Browser',$server_agent)) {
            $browser = 'Avant';
        } elseif (eregi('Amiga-AWeb',$server_agent)) {
            $browser = 'AWeb';
        } elseif (eregi('Cyberdog',$server_agent)) {
            $browser = 'Cyberdog';
        } elseif (eregi('Dillo',$server_agent)) {
            $browser = 'Dillo';
        } elseif (eregi('DreamPassport',$server_agent)) {
            $browser = 'DreamCast';
        } elseif (eregi('eCatch',$server_agent)) {
            $browser = 'eCatch';
        } elseif (eregi('ANTFresco',$server_agent)) {
            $browser = 'Fresco';
        } elseif (eregi('RSS',$server_agent)) {
            $browser = 'RSS';
        } elseif (eregi('Avant',$server_agent)) {
            $browser = 'Avant';
        } elseif (eregi('HotJava',$server_agent)) {
            $browser = 'HotJava';
        } elseif (eregi('W3C-checklink|W3C_Validator|Jigsaw',$server_agent)) {
            $browser = 'W3C';
        } elseif (eregi('K-Meleon',$server_agent)) {
            $browser = 'K-Meleon';
        }
        
        //Code to get the search string if the referrer is any of the following
        $search_engines = array('google', 'lycos', 'yahoo');

        foreach ($search_engines as $engine) {
          if ( is_referer_search_engine($engine)) {
            $query_terms = get_search_query_terms($engine);
            break;
          }
        }
        $return_array = array('os' => $os, 'browser' => $browser, 'query_term' => $query_terms);
        return $return_array;
}


// Add 1 everytime a picture is viewed.

/**
 * add_hit()
 *
 * @param $pid
 * @return
 **/
function add_hit($pid)
{
        global $CONFIG, $raw_ip, $HTML_SUBST;
		###################       DB      ######################
		global $cpg_db_functions_inc;
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
		################################################
      if ($CONFIG['count_file_hits']) {
          //cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET hits=hits+1, lasthit_ip='$raw_ip', mtime=CURRENT_TIMESTAMP WHERE pid='$pid'");
          ######################      DB      ########################
          $cpgdb->query($cpg_db_functions_inc['add_hit_update_pics'], $raw_ip, $pid);
          #####################################################
      }
        /**
         * Code to record the details of hits for the picture, if the option is set in CONFIG
         */
        if ($CONFIG['hit_details']) {
        // Get the details of user browser, IP, OS, etc
        $client_details = cpg_determine_client();


        //Making Cage
        $superCage = Inspekt::makeSuperCage();
        
        $time = time();

        //Sanitize the referer
        //Used getRaw() method but sanitized immediately
        if ($superCage->server->keyExists('HTTP_REFERER')) {
            $referer = urlencode(htmlentities($superCage->server->getEscaped('HTTP_REFERER')));
        } else {
                $referer= '';
        }

        // Insert the record in database
        $hitUserId = USER_ID;
        /*$query = "INSERT INTO {$CONFIG['TABLE_HIT_STATS']}
                          SET
                            pid = $pid,
                            search_phrase = '{$client_details['query_term']}',
                            Ip   = '$raw_ip',
                            sdate = '$time',
                            referer='$referer',
                            browser = '{$client_details['browser']}',
                            os = '{$client_details['os']}',
                            uid ='$hitUserId'";
        cpg_db_query($query);	*/
		################################      DB       ###################################
		$cpgdb->query($cpg_db_functions_inc['add_hit_record'], $pid, $client_details['query_term'], $raw_ip, $time, $referer, 
					$client_details['browser'], $client_details['os'], $hitUserId);
		###########################################################################
     }
}

/**
 * add_album_hit()
 * Add a hit to the album.
 * @param $pid
 * @return
 **/
function add_album_hit($aid)
{
        global $CONFIG, $USER;
        #######################      DB     #####################
		global $cpg_db_functions_inc;
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
		##################################################
        if ($CONFIG['count_album_hits']) {
			$aid = (int)$aid;
			//cpg_db_query("UPDATE {$CONFIG['TABLE_ALBUMS']} SET alb_hits=alb_hits+1 WHERE aid='$aid'");
			#######################       DB      #######################
			$cpgdb->query($cpg_db_functions_inc['add_album_hit'], $aid);
			#####################################################
        }
}	

/**
 * breadcrumb()
 *
 * Build the breadcrumb navigation
 *
 * @param integer $cat
 * @param string $breadcrumb
 * @param string $BREADCRUMB_TEXT
 * @return
 **/

function breadcrumb($cat, &$breadcrumb, &$BREADCRUMB_TEXT)
{
    global $album, $lang_errors, $lang_list_categories, $lang_common;
    global $CONFIG,$CURRENT_ALBUM_DATA, $CURRENT_CAT_NAME;
	######################     DB     ######################
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################
    $category_array = array();

    // first we build the category path: names and id
    if ($cat != 0) { //Categories other than 0 need to be selected

        if ($cat >= FIRST_USER_CAT) {

            /*$sql = "SELECT name FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = " . USER_GAL_CAT;
            $result = cpg_db_query($sql);
            $row = mysql_fetch_assoc($result);*/
			################################      DB     ############################
			$cpgdb->query($cpg_db_functions_inc['get_user_gal_cat_name'], USER_GAL_CAT);
			$row = $cpgdb->fetchRow();
			##################################################################

            $category_array[] = array(USER_GAL_CAT, $row['name']);
                           
            $user_name = get_username($cat - FIRST_USER_CAT);
            if (!$user_name) {
                $user_name = $lang_common['username_if_blank'];
            }

            $category_array[] = array($cat, $user_name);
            $CURRENT_CAT_NAME = sprintf($lang_list_categories['xx_s_gallery'], $user_name);
            $row['parent'] = 1;

        } else {

            /*$result = cpg_db_query("SELECT p.cid, p.name FROM {$CONFIG['TABLE_CATEGORIES']} AS c, 
                {$CONFIG['TABLE_CATEGORIES']} AS p 
                WHERE c.lft BETWEEN p.lft AND p.rgt
                AND c.cid = $cat
                ORDER BY p.lft");

            while ($row = mysql_fetch_assoc($result)) {
                $category_array[] = array($row['cid'], $row['name']);
                $CURRENT_CAT_NAME = $row['name'];
            }

            mysql_free_result($result);*/
			##############################     DB     ##############################
			$result = $cpgdb->query($cpg_db_functions_inc['get_current_cat_name'], $cat);
			while ($row = $cpgdb->fetchRow()) {
				$category_array[] = array($row['cid'], $row['name']);
				$CURRENT_CAT_NAME = $row['name'];
			}
			$cpgdb->free();
			##################################################################
        }
    }

    $breadcrumb_links = array();
    $BREADCRUMB_TEXTS = array();

    // Add the Home link  to breadcrumb
    $breadcrumb_links[0] = '<a href="index.php">'.$lang_list_categories['home'].'</a>';
    $BREADCRUMB_TEXTS[0] = $lang_list_categories['home'];

    $cat_order = 1;
    foreach ($category_array as $category) {
        $breadcrumb_links[$cat_order] = "<a href=\"index.php?cat={$category[0]}\">{$category[1]}</a>";
        $BREADCRUMB_TEXTS[$cat_order] = $category[1];
        $cat_order += 1;
    }

    //Add Link for album if aid is set
    if (isset($CURRENT_ALBUM_DATA['aid'])) {
        $breadcrumb_links[$cat_order] = "<a href=\"thumbnails.php?album=".$CURRENT_ALBUM_DATA['aid']."\">".$CURRENT_ALBUM_DATA['title']."</a>";
        $BREADCRUMB_TEXTS[$cat_order] = $CURRENT_ALBUM_DATA['title'];
    }

    // we check if the theme_breadcrumb exists...
    if (function_exists('theme_breadcrumb')) {
        theme_breadcrumb($breadcrumb_links, $BREADCRUMB_TEXTS, $breadcrumb, $BREADCRUMB_TEXT);
        return;
    }

    // otherwise we have a default breadcrumb builder:
    $breadcrumb = '';
    $BREADCRUMB_TEXT = '';
    foreach ($breadcrumb_links as $breadcrumb_link) {
        $breadcrumb .= ' > ' . $breadcrumb_link;
    }
    foreach ($BREADCRUMB_TEXTS as $BREADCRUMB_TEXT_elt) {
        $BREADCRUMB_TEXT .= ' > ' . $BREADCRUMB_TEXT_elt;
    }
    // We remove the first ' > '
    $breadcrumb = substr_replace($breadcrumb,'', 0, 3);
    $BREADCRUMB_TEXT = substr_replace($BREADCRUMB_TEXT,'', 0, 3);
}  // function breadcrumb


/**************************************************************************

 **************************************************************************/

// Compute image geometry based on max width / height

/**
 * compute_img_size()
 *
 * Compute image geometry based on max, width / height
 *
 * @param integer $width
 * @param integer $height
 * @param integer $max
 * @return array
 **/
function compute_img_size($width, $height, $max, $system_icon=false, $normal=false)
{
    global $CONFIG;
    $thumb_use=$CONFIG['thumb_use'];
    if ($thumb_use=='ht') {
        $ratio = $height / $max;
    } elseif ($thumb_use=='wd') {
        $ratio = $width / $max;
    } else {
        $ratio = max($width, $height) / $max;
    }
    if ($ratio > 1.0) {
        $image_size['reduced'] = true;
    }
    $ratio = max($ratio, 1.0);
    $image_size['width'] =  (int) ($width / $ratio);
    $image_size['height'] = (int) ($height / $ratio);
    $image_size['whole'] = 'width="'.$image_size['width'].'" height="'.$image_size['height'].'"';
    if ($thumb_use=='ht') {
        $image_size['geom'] = ' height="'.$image_size['height'].'"';
    } elseif ($thumb_use=='wd') {
        $image_size['geom'] = 'width="'.$image_size['width'].'"';

    //thumb cropping
    } elseif ($thumb_use=='ex') {
        if ($normal=="normal") {
            $image_size['geom'] = 'width="'.$image_size['width'].'" height="'.$image_size['height'].'"';
        } elseif ($normal=="cat_thumb") {
            $image_size['geom'] = 'width="'.$max.'" height="'.($CONFIG['thumb_height'])*$max/$CONFIG['thumb_width'].'"';
        } else {
            $image_size['geom'] = 'width="'.$CONFIG['thumb_width'].'" height="'.$CONFIG['thumb_height'].'"';
        }
        //if we have a system icon we override the previous calculation and take 'any' as base for the calc
        if ($system_icon) {
            $image_size['geom'] = 'width="'.$image_size['width'].'" height="'.$image_size['height'].'"';
        }

    } else {
        $image_size['geom'] = 'width="'.$image_size['width'].'" height="'.$image_size['height'].'"';
    }

    return $image_size;
} // function compute_img_size

// Prints thumbnails of pictures in an album

/**
 * display_thumbnails()
 *
 * Generates data to display thumbnails of pictures in an album
 *
 * @param mixed $album Either the album ID or the meta album name
 * @param integer $cat Either the category ID or album ID if negative
 * @param integer $page Page number to display
 * @param integer $thumbcols
 * @param integer $thumbrows
 * @param boolean $display_tabs
 **/

function display_thumbnails($album, $cat, $page, $thumbcols, $thumbrows, $display_tabs)
{
        global $CONFIG, $AUTHORIZED, $USER;
        global $album_date_fmt, $lang_display_thumbnails, $lang_errors, $lang_byte_units, $lang_common;

        $superCage = Inspekt::makeSuperCage();

        $thumb_per_page = $thumbcols * $thumbrows;
        $lower_limit = ($page-1) * $thumb_per_page;

        $pic_data = get_pic_data($album, $thumb_count, $album_name, $lower_limit, $thumb_per_page);

        $total_pages = ceil($thumb_count / $thumb_per_page);

        $i = 0;
        if (count($pic_data) > 0) {
                foreach ($pic_data as $key => $row) {
                        $i++;
                        $pic_title = $lang_common['filename'].'='.$row['filename']."\n".
                                $lang_common['filesize'].'='.($row['filesize'] >> 10).$lang_byte_units[1]."\n".
                                $lang_display_thumbnails['dimensions'].$row['pwidth']."x".$row['pheight']."\n".
                                $lang_display_thumbnails['date_added'].localised_date($row['ctime'], $album_date_fmt);

                        $pic_url = get_pic_url($row, 'thumb');
                        if (!is_image($row['filename'])) {
                                $image_info = cpg_getimagesize(urldecode($pic_url));
                                $row['pwidth'] = $image_info[0];
                                $row['pheight'] = $image_info[1];
                        }
						// thumb cropping - if we display a system thumb we calculate the dimension by any and not ex
                        if (array_key_exists('system_icon', $row) && ($row['system_icon'] == true)) {
							$image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width'], true);
						} else {
							$image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width']);
						}
                        $thumb_list[$i]['pos'] = $key < 0 ? $key : $i - 1 + $lower_limit;
                        $thumb_list[$i]['pid'] = $row['pid'];
                        $thumb_list[$i]['image'] = "<img src=\"" . $pic_url . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"{$row['filename']}\" title=\"$pic_title\"/>";
                        $thumb_list[$i]['caption'] = bb_decode($row['caption_text']);
                        $thumb_list[$i]['admin_menu'] = '';
                        $thumb_list[$i]['aid'] = $row['aid'];
                        $thumb_list[$i]['pwidth'] = $row['pwidth'];
                        $thumb_list[$i]['pheight'] = $row['pheight'];
                }

                // Add a hit to album counter if it is a numeric album
                if (is_numeric($album)) {
                        // Create an array to hold the album id for hits (if not created)
                        if (!isset($USER['liv_a']) || !is_array($USER['liv_a'])) {
                                $USER['liv_a'] = array();
                        }
                        // Add 1 to album hit counter
                        if (!USER_IS_ADMIN && !in_array($album, $USER['liv_a']) && $superCage->cookie->keyExists($CONFIG['cookie_name'] . '_data')) {
                                add_album_hit($album);
                                if (count($USER['liv_a']) > 4) array_shift($USER['liv_a']);
                                array_push($USER['liv_a'], $album);
                                user_save_profile();
                        }
                }

                //Using getRaw(). The date is sanitized in the called function.
                $date = $superCage->get->keyExists('date') ? cpgValidateDate($superCage->get->getEscaped('date')) : null;
                theme_display_thumbnails($thumb_list, $thumb_count, $album_name, $album, $cat, $page, $total_pages, is_numeric($album), $display_tabs, 'thumb', $date);
        } else {
                theme_no_img_to_display($album_name);
        }
}

 /**
 * cpg_get_system_thumb_list()
 *
 * Return an array containing the system thumbs in a directory

 * @param string $search_folder
 * @return array
 **/
function cpg_get_system_thumb_list($search_folder = 'images/')
{
        global $CONFIG;
        static $thumbs = array();

        $folder = 'images/';

        $thumb_pfx =& $CONFIG['thumb_pfx'];
        // If thumb array is empty get list from coppermine 'images' folder
        if ((count($thumbs) == 0) && ($folder == $search_folder)) {
                $dir = opendir($folder);
                while (($file = readdir($dir))!==false) {
                        if (is_file($folder . $file) && strpos($file,$thumb_pfx) === 0) {
                                // Store filenames in an array
                                $thumbs[] = array('filename' => $file);
                        }
                }
                closedir($dir);
                return $thumbs;
        } elseif ($folder == $search_folder) {
                // Search folder is the same as coppermine images folder; just return the array
                return $thumbs;
        } else {
                // Search folder is the different; check for files in the given folder
                $results = array();
                foreach ($thumbs as $thumb) {
                        if (is_file($search_folder.$thumb['filename'])) {
                                $results[] = array('filename' => $thumb['filename']);
                        }
                }
                return $results;
        }
}


/**
 * cpg_get_system_thumb()
 *
 * Gets data for system thumbs
 *
 * @param string $filename
 * @param integer $user
 * @return array
 **/

function& cpg_get_system_thumb($filename,$user=10001)
{
        global $CONFIG,$USER_DATA;

        // Correct user_id
        if ($user<10000)
        {
                $user += 10000;
        }

        if ($user==10000) {
                $user = 10001;
        }

        // Get image data for thumb
        $picdata = array('filename'=>$filename,
                         'filepath'=>$CONFIG['userpics'].$user.'/',
                         'url_prefix'=>0);
        $pic_url = get_pic_url($picdata, 'thumb', true);
        $picdata['thumb'] = $pic_url;
        $image_info = cpg_getimagesize(urldecode($pic_url));
        $picdata['pwidth'] = $image_info[0];
        $picdata['pheight'] = $image_info[1];
        $image_size = compute_img_size($picdata['pwidth'], $picdata['pheight'], $CONFIG['alb_list_thumb_size']);
        $picdata['whole'] = $image_size['whole'];
        $picdata['reduced'] = (isset($image_size['reduced']) && $image_size['reduced']);
        return $picdata;
} // function cpg_get_system_thumb


/**
 * display_film_strip()
 *
 * gets data for thumbnails in an album for the film strip
 *
 * @param integer $album
 * @param integer $cat
 * @param integer $pos
 **/

function display_film_strip($album, $cat, $pos)
{
    global $CONFIG, $AUTHORIZED;
    global $album_date_fmt, $lang_display_thumbnails, $lang_errors, $lang_byte_units, $lang_common, $pic_count;

    $superCage = Inspekt::makeSuperCage();

    $max_item = $CONFIG['max_film_strip_items'];
    //$thumb_per_page = $pos + $CONFIG['max_film_strip_items'];
    $thumb_per_page = $max_item * 2;
    $l_limit = max(0, $pos - $CONFIG['max_film_strip_items']);
    $new_pos = max(0, $pos - $l_limit);

    $pic_data = get_pic_data($album, $thumb_count, $album_name, $l_limit, $thumb_per_page);

    if (count($pic_data) < $max_item ) {
        $max_item = count($pic_data);
    }
    $lower_limit = 3;

    if (!isset($pic_data[$new_pos + 1])) {
        $lower_limit = $new_pos - $max_item + 1;
    } elseif (!isset($pic_data[$new_pos + 2])) {
        $lower_limit = $new_pos - $max_item + 2;
    } elseif (!isset($pic_data[$new_pos - 1])) {
        $lower_limit = $new_pos;
    } else {
        $hf = $max_item / 2;
        $ihf = (int)($max_item / 2);
        if ($new_pos > $hf ) {
            //if ($max_item%2 == 0)
            $lower_limit = $new_pos - $ihf;
        } elseif ($new_pos <= $hf ) { 
            $lower_limit = 0; 
        }
    }

    $pic_data = array_slice($pic_data,$lower_limit,$max_item);
    $i = $l_limit;
    if (count($pic_data) > 0) {
        foreach ($pic_data as $key => $row) {
            $hi = (($pos == ($i + $lower_limit)) ? '1': '');
            $i++;
            $pic_title = $lang_common['filename'].'='.$row['filename']."\n".
                    $lang_common['filesize'].'='.($row['filesize'] >> 10).$lang_byte_units[1]."\n".
                    $lang_display_thumbnails['dimensions'].$row['pwidth']."x".$row['pheight']."\n".
                    $lang_display_thumbnails['date_added'].localised_date($row['ctime'], $album_date_fmt);

            $pic_url =  get_pic_url($row, 'thumb');
            if (!is_image($row['filename'])) {
                $image_info = cpg_getimagesize(urldecode($pic_url));
                $row['pwidth'] = $image_info[0];
                $row['pheight'] = $image_info[1];
            }

            //thumb cropping
            if (array_key_exists('system_icon', $row) && ($row['system_icon'] == true)) {
                $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width'], true);
            } else {
                $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width']);
            }

            $p = $i - 1 + $lower_limit;
            $p = ($p < 0 ? 0 : $p);
            $thumb_list[$i]['pos'] = $key < 0 ? $key : $p;
            $thumb_list[$i]['image'] = "<img src=\"" . $pic_url . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"{$row['filename']}\" title=\"$pic_title\" />";
            $thumb_list[$i]['caption'] = $CONFIG['display_film_strip_filename'] ? '<span class="thumb_filename">'.$row['filename'].'</span>' : '';
            $thumb_list[$i]['admin_menu'] = '';
            // Mark unapproved thumbnail as such
            if ($row['approved'] == 'NO') {
                $thumb_list[$i]['caption'] .= '<span style="font-weight:bold;">' . $lang_display_thumbnails['unapproved'] . '</span>';
            }
            ######### Added by Abbas #############
            $thumb_list[$i]['pid'] = $row['pid'];
            ######################################

        } // foreach $pic_data

        // Get the pos for next and prev links in filmstrip navigation
        $filmstrip_next_pos = $pos + $CONFIG['max_film_strip_items'];
        $filmstrip_prev_pos = $pos - $CONFIG['max_film_strip_items'];
        // If next pos is greater then total pics then make it pic_count - 1
        $filmstrip_next_pos = $filmstrip_next_pos >= $pic_count ? $pic_count - 1 : $filmstrip_next_pos;
        // If prev pos is less than 0 then make it 0
        $filmstrip_prev_pos = $filmstrip_prev_pos < 0 ? 0 : $filmstrip_prev_pos;

        //Using getRaw(). The date is sanitized in the called function.
        $date = $superCage->get->keyExists('date') ? cpgValidateDate($superCage->get->getEscaped('date')) : null;
        return theme_display_film_strip($thumb_list, $thumb_count, $album_name, $album, $cat, $pos, is_numeric($album), 'thumb', $date, $filmstrip_prev_pos, $filmstrip_next_pos);
    } else {
        theme_no_img_to_display($album_name);
    }
} // function display_film_strip


// Return the url for a picture, allows to have pictures spreaded over multiple servers
/**
 * get_pic_url()
 *
 * Return the url for a picture
 *
 * @param array $pic_row
 * @param string $mode
 * @param boolean $system_pic
 * @return string
 **/

function& get_pic_url(&$pic_row, $mode, $system_pic = false)
{
    global $CONFIG, $THEME_DIR;

    static $pic_prefix = array();
    static $url_prefix = array();

    if (!count($pic_prefix)) {
        $pic_prefix = array(
                'thumb' => $CONFIG['thumb_pfx'],
                'normal' => $CONFIG['normal_pfx'],
                'orig' => $CONFIG['orig_pfx'],
                'fullsize' => '',
        );

        $url_prefix = array(
                0 => $CONFIG['fullpath'],
        );
    }

    $mime_content = cpg_get_type($pic_row['filename']);
    // If $mime_content is empty there will be errors, so only perform the array_merge if $mime_content is actually an array
    if (is_array($mime_content)) {
        $pic_row = array_merge($pic_row,$mime_content);
    }

    $filepathname = null;

    // Code to handle custom thumbnails
    // If fullsize or normal mode use regular file
    if ($mime_content['content'] != 'image' && $mode== 'normal') {
        $mode = 'fullsize';
    } elseif (($mime_content['content'] != 'image' && $mode == 'thumb') || $system_pic) {
        $thumb_extensions = Array('.gif','.png','.jpg');
        // Check for user-level custom thumbnails
        // Create custom thumb path and erase extension using filename; Erase filename's extension
        $custom_thumb_path = array_key_exists('url_prefix',$pic_row) ? $url_prefix[$pic_row['url_prefix']] : ''
                . $pic_row['filepath']
                . array_key_exists($mode,$pic_prefix) ? $pic_prefix[$mode] : '';
        $file_base_name = str_replace('.'.$mime_content['extension'],'',basename($pic_row['filename']));
        // Check for file-specific thumbs
        foreach ($thumb_extensions as $extension) {
            if (file_exists($custom_thumb_path.$file_base_name.$extension)) {
                $filepathname = $custom_thumb_path.$file_base_name.$extension;
                break;
            }
        }
        if (!$system_pic) {
            // Check for extension-specific thumbs
            if (is_null($filepathname) or $filepathname == '') {
                foreach ($thumb_extensions as $extension) {
                    if (file_exists($custom_thumb_path.$mime_content['extension'].$extension)) {
                        $filepathname = $custom_thumb_path.$mime_content['extension'].$extension;
                        break;
                    }
                }
            }
            // Check for content-specific thumbs
            if (is_null($filepathname) or $filepathname == '') {
                foreach ($thumb_extensions as $extension) {
                    if (file_exists($custom_thumb_path.$mime_content['content'].$extension)) {
                        $filepathname = $custom_thumb_path.$mime_content['content'].$extension;
                        break;
                    }
                }
            }
        }
        // Use default thumbs
        if (is_null($filepathname) or $filepathname == '') {
            // Check for default theme- and global-level thumbs
            $thumb_paths[] = $THEME_DIR.'images/';                 // Used for custom theme thumbs
            $thumb_paths[] = 'images/thumbs/';                     // Default Coppermine thumbs
            foreach ($thumb_paths as $default_thumb_path) {
                if (is_dir($default_thumb_path)) {
                    if (!$system_pic) {
                        foreach ($thumb_extensions as $extension) {
                            // Check for extension-specific thumbs
                            if (file_exists($default_thumb_path.$CONFIG['thumb_pfx'].$mime_content['extension'].$extension)) {
                                $filepathname = $default_thumb_path.$CONFIG['thumb_pfx'].$mime_content['extension'].$extension;
                                //thumb cropping - if we display a system thumb we calculate the dimension by any and not ex
                                $pic_row['system_icon'] = true;
                                break 2;
                            }
                        }
                        foreach ($thumb_extensions as $extension) {
                            // Check for media-specific thumbs (movie,document,audio)
                            if (file_exists($default_thumb_path.$CONFIG['thumb_pfx'].$mime_content['content'].$extension)) {
                                $filepathname = $default_thumb_path.$CONFIG['thumb_pfx'].$mime_content['content'].$extension;
                                //thumb cropping
                                $pic_row['system_icon'] = true;
                                break 2;
                            }
                        }
                    } else {
                        // Check for file-specific thumbs for system files
                        foreach ($thumb_extensions as $extension) {
                            if (file_exists($default_thumb_path.$CONFIG['thumb_pfx'].$file_base_name.$extension)) {
                                $filepathname = $default_thumb_path.$CONFIG['thumb_pfx'].$file_base_name.$extension;
                                //thumb cropping
                                $pic_row['system_icon'] = true;
                                break 2;
                            }
                        } // foreach $thumb_extensions
                    } // else $system_pic
                } // if is_dir($default_thumb_path)
            } // foreach $thumbpaths
        } // if is_null($filepathname)
        $filepathname = path2url($filepathname);
    }

    if (is_null($filepathname) or $filepathname == '') {
        $filepathname = $url_prefix[$pic_row['url_prefix']]. path2url($pic_row['filepath']. $pic_prefix[$mode]. $pic_row['filename']);
    }

    // Added hack:  "&& !isset($pic_row['mode'])" thumb_data filter isn't executed for the fullsize image
    if ($mode == 'thumb' && !isset($pic_row['mode'])) {
        $pic_row['url'] = $filepathname;
        $pic_row['mode'] = $mode;
        $pic_row = CPGPluginAPI::filter('thumb_data',$pic_row);
    } elseif ($mode != 'thumb') {
        $pic_row['url'] = $filepathname;
        $pic_row['mode'] = $mode;
    } else {
        $pic_row['url'] = $filepathname;
    }
    $pic_row = CPGPluginAPI::filter('picture_url',$pic_row);
    return $pic_row['url'];
} // function get_pic_url


/**
 * cpg_get_default_lang_var()
 *
 * Return a variable from the default language file
 *
 * @param $language_var_name
 * @param unknown $override_language
 * @return
 **/
function& cpg_get_default_lang_var($language_var_name,$override_language = null) 
{
    global $CONFIG;
    if (is_null($override_language)) {
        if (isset($CONFIG['default_lang'])) {
            $language = $CONFIG['default_lang'];
        } else {
            global $$language_var_name;
            return $$language_var_name;
        }
    } else {
        $language = $override_language;
    }
    include('lang/'.$language.'.php');
    return $$language_var_name;
} // function cpg_get_default_lang_var

// Returns a variable from the current language file
// If variable doesn't exists gets value from english_us lang file

/**
 * cpg_lang_var()
 *
 * @param $varname
 * @param unknown $index
 * @return
 **/

function& cpg_lang_var($varname,$index=null) 
{
    global $$varname;

    $lang_var =& $$varname;

    if (isset($lang_var)) {
        if (!is_null($index) && !isset($lang_var[$index])) {
            include('lang/english.php');
            return $lang_var[$index];
        } elseif (is_null($index)) {
            return $lang_var;
        } else {
            return $lang_var[$index];
        }
    } else {
        include('lang/english.php');
        return $lang_var;
    }
} // function cpg_lang_var


/**
 * cpg_debug_output()
 *
 * defined new debug_output function here in functions.inc.php instead of theme.php with different function names to avoid incompatibilities with users not updating their themes as required. Advanced info is only output if (GALLERY_ADMIN_MODE == TRUE)
 *
 **/

function cpg_debug_output()
{
    global $USER, $USER_DATA, $CONFIG, $cpg_time_start, $query_stats, $queries, $lang_cpg_debug_output, $CPG_PHP_SELF, $superCage, $CPG_PLUGINS;

    $time_end = cpgGetMicroTime();
    $time = round($time_end - $cpg_time_start, 3);

    $query_count = count($query_stats);
    $total_query_time = array_sum($query_stats);

    $debug_underline = '&#0010;------------------&#0010;';
    $debug_separate = '&#0010;==========================&#0010;';
    $debug_toggle_link = ' <a href="javascript:;" onclick="show_section(\'debug_output_rows\');" class="admin_menu" id="debug_output_toggle" style="display:none;">'.$lang_cpg_debug_output['show_hide'].'</a>';
    echo '<form name="debug" action="'.$CPG_PHP_SELF.'" id="debug">';
    starttable('100%', cpg_fetch_icon('bug', 2) . $lang_cpg_debug_output['debug_info']. $debug_toggle_link,2);
    //echo '<div name="debug_output_rows" id="debug_output_rows" style="display:block;">';
    echo '<tr><td align="center" valign="top" width="100%" colspan="2">';
    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%" id="debug_output_rows">';
    echo '<tr><td align="center" valign="middle" class="tableh2" width="100">';
    echo '<script language="javascript" type="text/javascript">
<!--

// only hide the debug_output if the user is capable to display it, i.e. if JavaScript is enabled. If JavaScript is off, debug_output will be displayed and the toggle will remain invisible (as it would not do anything anyway with JS off)
addonload("document.getElementById(\'debug_output_rows\').style.display = \'none\'");
addonload("document.getElementById(\'debug_output_toggle\').style.display = \'inline\'");
//-->
</script>';
    echo <<< EOT
        <script type="text/javascript">
            document.write('<a href="javascript:HighlightAll(\'debug.debugtext\')" class="admin_menu">');
            document.write("{$lang_cpg_debug_output['select_all']}");
            document.write('</a>');
        </script>
        </td><td align="left" valign="middle" class="tableh2">
EOT;
    if (GALLERY_ADMIN_MODE) {
    	echo '<span class="album_stat">'.$lang_cpg_debug_output['copy_and_paste_instructions'].'</span><br />';
    } 
    echo '<span class="album_stat">'.$lang_cpg_debug_output['debug_output_explain'].'</span>';
    echo '</td></tr>';
    echo '<tr><td class="tableb" colspan="2">';
    echo '<textarea  rows="10" cols="60" class="debug_text" name="debugtext">';
    echo "USER: ";
    echo $debug_underline;
    print_r($USER);
    echo $debug_separate;
    echo "USER DATA:";
    echo $debug_underline;
    print_r($USER_DATA);
    echo $debug_separate;
    echo "Queries:";
    echo $debug_underline;
    print_r($queries);
    echo $debug_separate;
    echo "GET :";
    echo $debug_underline;
    print_r($superCage->get->_source);
    echo $debug_separate;
    echo "POST :";
    echo $debug_underline;
    print_r($superCage->post->_source);
    echo $debug_separate;
    echo "COOKIE :";
    echo $debug_underline;
    print_r($superCage->cookie->_source);
    echo $debug_separate;
    if ($superCage->cookie->keyExists('PHPSESSID')) {
        echo "SESSION :";
        echo $debug_underline;
        session_id($superCage->cookie->getAlnum('PHPSESSID'));
        session_start();
        print_r($_SESSION);
        echo $debug_separate;
    }
    if (GALLERY_ADMIN_MODE) {
        echo "VERSION INFO :";
        echo $debug_underline;
        $version_comment = ' - OK';
        if (strcmp('4.2.0', phpversion()) == 1) {
            $version_comment = ' - your PHP version isn\'t good enough! Minimum requirements: 4.2.0';
        }
        echo 'PHP version: ' . phpversion().$version_comment;
        echo "\n";
        $version_comment = ' - OK';
        /*$mySqlVersion = cpg_phpinfo_mysql_version();
        if (strcmp('3.23.23', $mySqlVersion) == 1) {$version_comment = ' - your MySQL version isn\'t good enough! Minimum requirements: 3.23.23';}
        echo 'MySQL version: ' . $mySqlVersion . $version_comment;*/
		#####################################         DB        #####################################
		$dbversion = cpg_phpinfo_dbserver_version();
		if ($CONFIG['dbservername'] == 'mysql') {
			if (strcmp('3.23.23', $dbversion) == 1) {
				$version_comment = ' - your MySQL version isn\'t good enough! Minimum requirements: 3.23.23';
			}
			echo 'MySQL version: '. $dbversion . $version_comment;
		} elseif ($CONFIG['dbservername'] == 'mssql') {
			if (strcmp('9.00.1399.06', $dbversion) == 1) {
				$version_comment = ' - your MSSQL version isn\'t good enough! Minimum requirements: 9.00.1399.06';
			}
			echo 'MSSQL version: '. $dbversion . $version_comment;
		}
		####################################################################################
        echo "\n";
        echo 'Coppermine version: ';
        echo COPPERMINE_VERSION . '(' . COPPERMINE_VERSION_STATUS . ')';
        echo "\n";
        echo $debug_separate;
        // error_reporting  (E_ERROR | E_WARNING | E_PARSE); // New maze's error report system
        if (function_exists('gd_info') == true) {
            echo 'Module: GD';
            echo $debug_underline;
            $gd_array = gd_info();
            foreach ($gd_array as $key => $value) {
                echo $key.': '.$value."\n";
            }
            echo $debug_separate;
        } else {
            echo cpg_phpinfo_mod_output('gd','text');
        }
        echo 'Key config settings';
        echo $debug_underline;
        echo cpg_config_output('allow_private_albums');
        echo cpg_config_output('cookie_name');
        echo cpg_config_output('cookie_path');
        echo cpg_config_output('ecards_more_pic_target');
        echo cpg_config_output('impath');
        echo cpg_config_output('lang');
        echo cpg_config_output('language_fallback');
        echo cpg_config_output('main_page_layout');
        echo cpg_config_output('silly_safe_mode');
        echo cpg_config_output('smtp_host');
        echo cpg_config_output('theme');
        echo cpg_config_output('thumb_method');
        echo $debug_separate;
        echo 'Plugins';
        echo $debug_underline;

        foreach ($CPG_PLUGINS as $plugin) {
            echo 'Plugin: ' . $plugin->name . "\n";
            echo 'Actions: ' . implode(', ', array_keys($plugin->actions)) . "\n";
            echo 'Filters: ' . implode(', ', array_keys($plugin->filters));
            echo $debug_underline;
        }

        echo $debug_separate;
        echo 'Server restrictions';
        echo $debug_underline;
        echo 'Directive | Local Value | Master Value';
        echo cpg_phpinfo_conf_output("safe_mode");
        echo cpg_phpinfo_conf_output("safe_mode_exec_dir");
        echo cpg_phpinfo_conf_output("safe_mode_gid");
        echo cpg_phpinfo_conf_output("safe_mode_include_dir");
        echo cpg_phpinfo_conf_output("safe_mode_exec_dir");
        echo cpg_phpinfo_conf_output("sql.safe_mode");
        echo cpg_phpinfo_conf_output("disable_functions");
        echo cpg_phpinfo_conf_output("file_uploads");
        echo cpg_phpinfo_conf_output("include_path");
        echo cpg_phpinfo_conf_output("open_basedir");
        echo cpg_phpinfo_conf_output("allow_url_fopen");
        echo "\n$debug_separate";
        echo 'Resource limits';
        echo $debug_underline;
        echo 'Directive | Local Value | Master Value';
        echo cpg_phpinfo_conf_output("max_execution_time");
        echo cpg_phpinfo_conf_output("max_input_time");
        echo cpg_phpinfo_conf_output("upload_max_filesize");
        echo cpg_phpinfo_conf_output("post_max_size");
        echo cpg_phpinfo_conf_output("memory_limit");
        echo "\n$debug_separate";
        
        if (ini_get('suhosin.post.max_vars')){
        
	        echo 'Suhosin limits';
	        echo $debug_underline;
	        echo 'Directive | Local Value | Master Value';
	        echo cpg_phpinfo_conf_output("suhosin.post.max_vars");
	        echo cpg_phpinfo_conf_output("suhosin.request.max_vars");
	        echo "\n$debug_separate";
        }
    }

    echo <<<EOT
Page generated in $time seconds - $query_count queries in $total_query_time seconds;
EOT;
    echo '</textarea>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</td></tr>';
    if (GALLERY_ADMIN_MODE) {
        echo '<tr><td class="tablef" colspan="2">';
        echo '<a href="phpinfo.php" class="admin_menu">' . $lang_cpg_debug_output['phpinfo'] . '</a>';
        // error_reporting  (E_ERROR | E_WARNING | E_PARSE); // New maze's error report system
        echo '</td></tr>';
    } 

    // Maze's new error report system
    global $cpgdebugger;
    $report = $cpgdebugger->stop();
    if (GALLERY_ADMIN_MODE) {
    	$notices_help =  $lang_cpg_debug_output['notices_help_admin'];
    } else {
    	$notices_help =  $lang_cpg_debug_output['notices_help_non_admin'];
    }
    $notices_help = '&nbsp;' . cpg_display_help('f=empty.htm&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_cpg_debug_output['notices']))).'&amp;t='.urlencode(base64_encode(serialize($notices_help))),470,245);
    if (is_array($report) && $CONFIG['debug_notice']!= 0) {
        echo '<tr><td class="tableh1" colspan="2">';
        echo '<strong>';
        echo cpg_fetch_icon('text_left', 2) . $lang_cpg_debug_output['notices'].$notices_help;
        echo '</strong>';
        echo '</td></tr>';
        echo '<tr><td class="tableb" colspan="2">';
        foreach($report AS $file => $errors) {
            echo '<strong>'.substr($file, $strstart).'</strong><ul>';
            foreach($errors AS $error) { 
                echo "<li>$error</li>"; 
            }
            echo '</ul>';
        }
        echo '</td></tr>';
    }
    endtable();
    echo "</form>";

} // function cpg_debug_output


/**
 * cpg_phpinfo_mod()
 *
 * phpinfo-related functions:
 *
 * @param $search
 * @return
 **/

function cpg_phpinfo_mod($search)
{
    // this could be done much better with regexpr - anyone who wants to change it: go ahead
    ob_start();
    phpinfo(INFO_MODULES);
    $string = ob_get_contents();
    $module = $string;
    $delimiter = '#cpgdelimiter#';
    ob_end_clean();
    // find out the first occurence of "<h2" and throw the superfluos stuff away
    $string = stristr($string, 'module_' . $search);
    $string = eregi_replace('</table>(.*)', '', $string);
    $string = stristr($string, '<tr');
    $string = str_replace('</td>', '|', $string);
    $string = str_replace('</tr>', $delimiter, $string);
    $string = chop(strip_tags($string));
    $pieces = explode($delimiter, $string);
    foreach($pieces as $key => $val) {
        $bits[$key] = explode("|", $val);
    }
    return $bits;
} // function cpg_phpinfo_mod


/**
 * cpg_phpinfo_mod_output()
 *
 * @param $search
 * @param $output_type
 * @return
 **/

function cpg_phpinfo_mod_output($search,$output_type)
{
// first parameter is the module name, second parameter is the way you want your output to look like: table or text
    $pieces = cpg_phpinfo_mod($search);
    $summ = '';
    $return = '';
    $debug_underline = '&#0010;------------------&#0010;';
    $debug_separate = '&#0010;==========================&#0010;';

    if ($output_type == 'table') {
        ob_start();
        starttable('100%', 'Module: '.$search, 2);
        $return.= ob_get_contents();
        ob_end_clean();
    }
    else {
        $return.= 'Module: '.$search.$debug_underline;
    }
    foreach($pieces as $val) {
        if ($output_type == 'table') {
            $return.= '<tr><td>';
        }
        $return.= $val[0];
        if ($output_type == 'table') {
            $return.= '</td><td>';
        }
        if (isset($val[1])) {
            $return.= $val[1];
        }
        if ($output_type == 'table') {
            $return.= '</td></tr>';
        }
        $summ .= $val[0];
    }
    if (!$summ) {
        if ($output_type == 'table') {
            $return.= '<tr><td colspan="2">';
        }
        $return.= 'module doesn\'t exist';
        if ($output_type == 'table') {
            $return.= '</td></tr>';
        }
    }
    if ($output_type == 'table') {
        ob_start();
        endtable();
        $return.= ob_get_contents();
        ob_end_clean();
    } else {
        $return.= $debug_separate;
    }
    return $return;
} // function cpg_phpinfo_mod_output


/**
 * cpg_phpinfo_mysql_version()
 *
 * @return
 **/

/*function cpg_phpinfo_mysql_version()
{
    $result = mysql_query("SELECT VERSION() as version");
    $row = mysql_fetch_row($result);
    return $row[0];
} // function cpg_phpinfo_mysql_version*/
########################     DB     #########################
function cpg_phpinfo_dbserver_version()
{
	global $cpg_db_functions_inc, $CONFIG;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
    $cpgdb->query($cpg_db_functions_inc['get_dbversion']);
    $row = $cpgdb->fetchRow();
    return $row['version'];
}
#######################################################


/**
 * cpg_phpinfo_conf()
 *
 * @param $search
 * @return
 **/

function cpg_phpinfo_conf($search)
{
    // this could be done much better with regexpr - anyone who wants to change it: go ahead
    $string ='';
    $pieces = '';
    $delimiter = '#cpgdelimiter#';
    $bits = '';

    ob_start();
    phpinfo(INFO_CONFIGURATION);
    $string = ob_get_contents();
    ob_end_clean();
    // find out the first occurence of "</tr" and throw the superfluos stuff in front of it away
    $string = strchr($string, '</tr>');
    $string = str_replace('</td>', '|', $string);
    $string = str_replace('</tr>', $delimiter, $string);
    $string = chop(strip_tags($string));
    $pieces = explode($delimiter, $string);
    foreach($pieces as $val) {
        $bits = explode("|", $val);
        if (strchr($bits[0], $search)) {
            return $bits;
        }
    }
} // function cpg_phpinfo_conf


/**
 * cpg_phpinfo_conf_output()
 *
 * @param $search
 * @return
 **/

function cpg_phpinfo_conf_output($search)
{
    $pieces = cpg_phpinfo_conf($search);
    $return= $pieces[0] . ' | ' . $pieces[1] . ' | ' . $pieces[2];
    return $return;
} // function cpg_phpinfo_conf_output


function cpg_config_output($key)
{
    global $CONFIG;
    return "$key: {$CONFIG[$key]}\n";
} // function cpg_config_output


// THEME AND LANGUAGE SELECTION

/**
 * languageSelect()
 *
 * @param $parameter
 * @return
 **/

function languageSelect($parameter) 
{
    global $CONFIG, $lang_language_selection, $lang_common, $CPG_PHP_SELF;
    ####################   DB   ##################
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
    ##########################################
    $superCage = Inspekt::makeSuperCage();
    $return= '';
    $lineBreak = "\n";

    //check if language display is enabled
    if ($CONFIG['language_list'] == 0 && $parameter == 'list') {
        return;
    }
    if ($CONFIG['language_flags'] == 0 && $parameter == 'flags') {
        return;
    }

    // get the current language
    //use the default language of the gallery
    $cpgCurrentLanguage = $CONFIG['lang'];
    
    // Forget all the nonsense sanitization code that used to reside here - redefine the variable for the base URL using the function that we already have for that purpose
    $cpgChangeUrl = cpgGetScriptNameParams('lang').'lang=';
    
    // Make sure that the language table exists in the first place - 
    // return without return value if the table doesn't exist because 
    // the upgrade script hasn't been run
    /*$results = cpg_db_query("SHOW TABLES LIKE '{$CONFIG['TABLE_LANGUAGE']}'");
    if (!mysql_num_rows($results)) {
    	return;
    }
    mysql_free_result($results);
    unset($results);*/
    ############################   DB   #########################
    $results = $cpgdb->query($cpg_db_functions_inc['chk_langtbl_exists']);
    $rowset = $cpgdb->fetchRowSet();
    if (count($rowset) == 0) {
        return;
    }
    $cpgdb->free();
    unset($results);
    unset($rowset);
    #########################################################
    
    // get list of available languages
    /*$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_LANGUAGE']}");
    while ($row = mysql_fetch_array($results)) {
        if ($row['available'] == 'YES' && $row['enabled'] == 'YES' && file_exists ('lang/'.$row['lang_id'].'.php') == TRUE) {
            $lang_language_data[$row['lang_id']] = $row;
        }
    } // while
    mysql_free_result($results);*/
    ##########################################      DB     #########################################
    $results = $cpgdb->query($cpg_db_functions_inc['get_language']);
    while ($row = $cpgdb->fetchRow()) {
        if($row['available'] == 'YES' && $row['enabled'] == 'YES' && file_exists ('lang/'.$row['lang_id'].'.php') == TRUE) {
            $lang_language_data[$row['lang_id']] = $row;
        }
    } // while
    $cpgdb->free();
    #########################################################################################
    unset($results);
    // sort the array by English name
    ksort($lang_language_data);
    
    $value = strtolower($CONFIG['lang']);


    //start the output
    switch ($parameter) {
        case 'flags':
            $return.= '<div id="cpgChooseFlags" class="inline">';
            if ($CONFIG['language_flags'] == 2) {
                $return.= $lang_language_selection['choose_language'].': ';
            }
            foreach ($lang_language_data as $language) {
                $return.= $lineBreak .  '<a href="' .$cpgChangeUrl. $language['lang_id'] . '" rel="nofollow"><img src="images/flags/' . $language['flag'] . '.gif" border="0" width="16" height="11" alt="" title="';
                $return.= $language['english_name'];
                if ($language['english_name'] != $language['native_name'] && $language['native_name'] != '') {
                    $return.= ' / ' . $language['native_name'] ;
                }
                $return.= '" /></a>' . $lineBreak;
            }
            if ($CONFIG['language_reset'] == 1) {
                $return.=  '<a href="' .$cpgChangeUrl. 'xxx" rel="nofollow"><img src="images/flags/reset.gif" border="0" width="16" height="11" alt="" title="';
                $return.=  $lang_language_selection['reset_language'] . '" /></a>' . $lineBreak;
            }
            $return.= '</div>';
            break;
        case 'table':
            $return = 'not yet implemented';
            break;
        default:
            $return.= $lineBreak . '<div id="cpgChooseLanguageWrapper">' . $lineBreak . '<form name="cpgChooseLanguage" id="cpgChooseLanguage" action="' . $CPG_PHP_SELF . '" method="get" class="inline">' . $lineBreak;
            $return.= '<select name="lang" class="listbox_lang" onchange="if (this.options[this.selectedIndex].value) window.location.href=\'' . $cpgChangeUrl . '\' + this.options[this.selectedIndex].value;">' . $lineBreak;
            $return.='<option>' . $lang_language_selection['choose_language'] . '</option>' . $lineBreak;
            foreach ($lang_language_data as $language) {
                $return.=  '<option value="' . $language['lang_id']  . '" >';
                $return.= $language['english_name'];
                if ($language['english_name'] != $language['native_name'] && $language['native_name'] != '') {
                    $return.= ' / ' . $language['native_name'] ;
                }
                $return.= ($value == $language['lang_id'] ? '*' : '');
                $return.= '</option>' . $lineBreak;
            }
            if ($CONFIG['language_reset'] == 1) {
                $return.=  '<option value="xxx">' . $lang_language_selection['reset_language'] . '</option>' . $lineBreak;
            }
            $return.=  '</select>' . $lineBreak;
            $return.=  '<noscript>'. $lineBreak;
            $return.=  '<input type="submit" name="language_submit" value="'.$lang_common['go'].'" class="listbox_lang" />&nbsp;'. $lineBreak;
            $return.=  '</noscript>'. $lineBreak;
            $return.=  '</form>' . $lineBreak;
            $return.=  '</div>' . $lineBreak;
    } // switch $parameter

    return $return;
} // function languageSelect


/**
 * themeSelect()
 *
 * @param $parameter
 * @return
 **/

function themeSelect($parameter)
{
    global $CONFIG,$lang_theme_selection, $lang_common, $CPG_PHP_SELF;

    $superCage = Inspekt::makeSuperCage();

    $return= '';
    $lineBreak = "\n";

    if ($CONFIG['theme_list'] == 0) {
        return;
    }


    $cpgCurrentTheme = cpgGetScriptNameParams('theme').'theme=';

    // get list of available themes
    $value = $CONFIG['theme'];
    $theme_dir = 'themes/';

    $dir = opendir($theme_dir);
    while ($file = readdir($dir)) {
        if (is_dir($theme_dir . $file) && $file != "." && $file != ".." && $file != '.svn' && $file != 'sample') {
            $theme_array[] = $file;
        }
    }
    closedir($dir);

    natcasesort($theme_array);

    //start the output
    switch ($parameter) {
        default:
            $return.= $lineBreak . '<div id="cpgChooseThemeWrapper">' . $lineBreak . '<form name="cpgChooseTheme" id="cpgChooseTheme" action="' . $CPG_PHP_SELF . '" method="get" class="inline">' . $lineBreak;
            $return.= '<select name="theme" class="listbox_lang" onchange="if (this.options[this.selectedIndex].value) window.location.href=\'' . $cpgCurrentTheme . '\' + this.options[this.selectedIndex].value;">' . $lineBreak;
            $return.='<option selected="selected">' . $lang_theme_selection['choose_theme'] . '</option>';
            foreach ($theme_array as $theme) {
                $return.= '<option value="' . $theme . '"'.($value == $theme ? '  selected="selected"' : '').'>' . strtr(ucfirst($theme), '_', ' ') . ($value == $theme ? '  *' : ''). '</option>' . $lineBreak;
            }
            if ($CONFIG['theme_reset'] == 1) {
                $return.=  '<option value="xxx">' . $lang_theme_selection['reset_theme'] . '</option>' . $lineBreak;
            }
            $return.=  '</select>' . $lineBreak;
            $return.=  '<noscript>'. $lineBreak;
            $return.=  '<input type="submit" name="theme_submit" value="'.$lang_common['go'].'" class="listbox_lang" />&nbsp;'. $lineBreak;
            $return.=  '</noscript>'. $lineBreak;
            $return.=  '</form>' . $lineBreak;
            $return.=  '</div>' . $lineBreak;
    } // switch $parameter 

    return $return;
} // function themeSelect


/**
 * cpg_alert_dev_version()
 *
 * @return
 **/

function cpg_alert_dev_version() 
{
    global $lang_version_alert, $lang_common, $CONFIG, $REFERER;
    $return = '';
    if (COPPERMINE_VERSION_STATUS != 'stable') {
        ob_start();
        starttable('100%', cpg_fetch_icon('warning', 2) . $lang_version_alert['version_alert']);
        print '<tr><td class="tableb">';
        print sprintf($lang_version_alert['no_stable_version'], COPPERMINE_VERSION, COPPERMINE_VERSION_STATUS);
        print '</td></tr>';
        endtable();
        print '<br />';
        $return = ob_get_contents();
        ob_end_clean();
    }
    // check if gallery is offline
    if ($CONFIG['offline'] == 1 && GALLERY_ADMIN_MODE) {
        ob_start();
        starttable('100%', $lang_common['information']);
        print '<tr><td class="tableb">';
        print '<span style="color:red;font-weight:bold">'.$lang_version_alert['gallery_offline'].'</span>';
        print '</td></tr>';
        endtable();
        print '<br />';
        $return .= ob_get_contents();
        ob_end_clean();
    }
    // display news from coppermine-gallery.net
    if ($CONFIG['display_coppermine_news'] == 1 && GALLERY_ADMIN_MODE) {
        $help_news = '&nbsp;'.cpg_display_help('f=configuration.htm&amp;as=admin_general_coppermine_news&amp;ae=admin_general_coppermine_news_end&amp;top=1', '600', '300');
        $news_icon = cpg_fetch_icon('news_show', 2);
        $news_icon_hide = cpg_fetch_icon('news_hide', 1);
        ob_start();
        starttable('100%');
        print <<< EOT
            <tr>
              <td>
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                  <tr>
                    <td class="tableh1">
                      {$news_icon}{$lang_version_alert['coppermine_news']}{$help_news}
                    </td>
                    <td class="tableh1" align="right">
                      <a href="mode.php?what=news&amp;referer={$REFERER}" class="admin_menu">{$news_icon_hide}{$lang_version_alert['hide']}</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tableb" colspan="2">
EOT;
        // Try to retrieve the news directly
        $result = cpgGetRemoteFileByURL('http://coppermine-gallery.net/cpg15x_news.htm', 'GET','','200');
        if (strlen($result['body']) < 200) { // retrieving the file failed - let's display it in an iframe then
            print <<< EOT
                      <iframe src="http://coppermine-gallery.net/cpg15x_news.htm" align="left" frameborder="0" scrolling="auto" marginheight="0" marginwidth="0" width="100%" height="100" name="coppermine_news" id="coppermine_news" class="textinput">
                        {$lang_version_alert['no_iframe']}
                      </iframe>
EOT;
        } else { // we have been able to retrieve the remote URL, let's chop the unneeded data and then display it
            unset($result['headers']);
            unset($result['error']);
            // drop everything before the starting body-tag
            //$result['body'] = substr($result['body'], strpos($result['body'], '<body>'));
            $result['body'] = strstr($result['body'], '<body>');
            // drop the starting body tag itself
            $result['body'] = str_replace('<body>', '', $result['body']);
            // drop the ending body tag and everything after it
            $result['body'] = str_replace(strstr($result['body'], '</body>'), '', $result['body']);
            // The result should now contain everything between the body tags - let's print it
            print $result['body'];
        }
        print <<< EOT
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
EOT;
        endtable();
        print '<br />';
        $return .= ob_get_contents();
        ob_end_clean();
    }
    return $return;
} // function cpg_alert_dev_version

/**
 * cpg_display_help()
 *
 * @param string $reference
 * @param string $width
 * @param string $height
 * @return
 **/

function cpg_display_help($reference = 'f=index.htm', $width = '600', $height = '350', $icon = 'help') 
{
    global $CONFIG, $USER;
    if ($reference == '' || $CONFIG['enable_help'] == '0') {
        return; 
    }
    if ($CONFIG['enable_help'] == '2' && GALLERY_ADMIN_MODE == false) {
        return; 
    }
    $help_theme = $CONFIG['theme'];
    if (isset($USER['theme'])) {
        $help_theme = $USER['theme'];
    }
    if ($icon == '*') {
        $icon == '*';
    } elseif ($icon == '?') {
        $icon = '?';
    } else {
        $icon = '<img src="images/help.gif" width="13" height="11" border="0" alt="" title="" />';
    }

    $help_html = "<a href=\"javascript:;\" onclick=\"coppermine_help_window=window.open('help.php?css=" . $help_theme . "&amp;" . $reference . "','coppermine_help','scrollbars=yes,toolbar=no,status=no,resizable=yes,width=" . $width . ",height=" . $height . "'); coppermine_help_window.focus()\" style=\"cursor:help\">" . $icon . "</a>";
    return $help_html;
} // function cpg_display_help


/**
* Multi-dim array sort, with ability to sort by two and more dimensions
* Coded by Ichier2003, available at php.net
* syntax:
* $array = array_csort($array [, 'col1' [, SORT_FLAG [, SORT_FLAG]]]...);
**/
function array_csort() 
{
   $args = func_get_args();
   $marray = array_shift($args);

   $msortline = "return(array_multisort(";
   $i = 0;
   foreach ($args as $arg) {
       $i++;
       if (is_string($arg)) {
           foreach ($marray as $row) {
               $sortarr[$i][] = $row[$arg];
           }
       } else {
           $sortarr[$i] = $arg;
       }
       $msortline .= "\$sortarr[".$i."],";
   }
   $msortline .= "\$marray));";

   eval($msortline);
   return $marray;
} // function array_csort


/*function cpg_get_bridge_db_values() 
{
    global $CONFIG;
    // Retrieve DB stored configuration
    $results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_BRIDGE']}");
    while ($row = mysql_fetch_array($results)) {
        $BRIDGE[$row['name']] = $row['value'];
    } // while
    mysql_free_result($results);
    return $BRIDGE;
} // function cpg_get_bridge_db_values*/
#########################       DB       #########################
function cpg_get_bridge_db_values() 
{
	global $CONFIG;
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	// Retrieve DB stored configuration
	$cpgdb->query($cpg_db_functions_inc['get_bridge_db_values']);
	while ($row = $cpgdb->fetchRow()) {
	    $BRIDGE[$row['name']] = $row['value'];
	} // while
	$cpgdb->free();
	return $BRIDGE;
} // function cpg_get_bridge_db_values
###########################################################


function cpg_get_webroot_path() 
{
    global $CPG_PHP_SELF;

    $superCage = Inspekt::makeSuperCage();
    // get the webroot folder out of a given PHP_SELF of any coppermine page

    // what we have: we can say for sure where we are right now: $PHP_SELF (if the server doesn't even have it, there will be problems everywhere anyway)

    // let's make those into an array:
    if ($matches = $superCage->server->getMatched('SCRIPT_FILENAME', '/^[a-z,A-Z0-9_-\/\\:.]+$/')) {
        $path_from_serverroot[] = $matches[0];
    }
    /*
    $path_from_serverroot[] = $_SERVER["SCRIPT_FILENAME"];
    if (isset($_SERVER["PATH_TRANSLATED"])) {
       $path_from_serverroot[] = $_SERVER["PATH_TRANSLATED"];
    }
    */
    if ($matches = $superCage->server->getMatched('PATH_TRANSLATED', '/^[a-z,A-Z0-9_-\/\\:.]+$/')) {
        $path_from_serverroot[] = $matches[0];
    }
    //$path_from_serverroot[] = $HTTP_SERVER_VARS["SCRIPT_FILENAME"];
    //$path_from_serverroot[] = $HTTP_SERVER_VARS["PATH_TRANSLATED"];

    // we should be able to tell the current script's filename by removing everything before and including the last slash in $PHP_SELF
    $filename = ltrim(strrchr($CPG_PHP_SELF, '/'), '/');

    // let's eliminate all those vars that don't contain the filename (and replace the funny notation from windows machines)
    foreach($path_from_serverroot as $key) {
        $key = str_replace('\\', '/', $key); // replace the windows notation
        $key = str_replace('//', '/', $key); // replace duplicate forwardslashes
        if (strstr($key, $filename) != FALSE) { // eliminate all that don't contain the filename
            $path_from_serverroot2[] = $key;
        }
    }

    // remove double entries in the array
    $path_from_serverroot3 = array_unique($path_from_serverroot2);

    // in the best of all worlds, the array is not empty
    if (is_array($path_from_serverroot3)) {
        $counter = 0;
        foreach($path_from_serverroot3 as $key) {
            // easiest possible solution: $PHP_SELF is contained in the array - if yes, we're lucky (in fact we could have done this before, but I was going to leave room for other checks to be inserted before this one)
            if (strstr($key, $CPG_PHP_SELF) != FALSE) { // eliminate all that don't contain $PHP_SELF
                $path_from_serverroot4[] = $key;
                $counter++;
            }
        }
    } else {
        // we're f***ed: the array is empty, there's no server var we could actually use
        $return = '';
    }

    if ($counter == 1) { //we have only one entry left - we're happy
        $return = $path_from_serverroot4[0];
    } elseif ($counter == 0) { // we're f***ed: the array is empty, there's no server var we could actually use
        $return = '';
    } else { // there is more than one entry, and they differ. For now, let's use the first one. Maybe we could do some advanced checking later
        $return = $path_from_serverroot4[0];
    }

    // strip the content from $PHP_SELF from the $return var and we should (hopefully) have the absolute path to the webroot
    $return = str_replace($CPG_PHP_SELF, '', $return);

    // the return var should at least contain a slash - if it doesn't, add it (although this is more or less wishfull thinking)
    if ($return == '') {
        $return = '/';
    }

    return $return;
} // function cpg_get_webroot_path


/**
 * Function to get the search string if the picture is viewed from google, lycos or yahoo search engine
 */

function get_search_query_terms($engine = 'google') 
{
    global $s, $s_array;

    $superCage = Inspekt::makeSuperCage();

    //Using getRaw(). $referer is sanitized below wherever needed
    $referer = urldecode($superCage->server->getEscaped('HTTP_REFERER'));
    $query_array = array();
    switch ($engine) {
        case 'google':
            // Google query parsing code adapted from Dean Allen's
            // Google Hilite 0.3. http://textism.com
            $query_terms = preg_replace('/^.*q=([^&]+)&?.*$/i','$1', $referer);
            $query_terms = preg_replace('/\'|"/', '', $query_terms);
            $query_array = preg_split ("/[\s,\+\.]+/", $query_terms);
            break;

        case 'lycos':
            $query_terms = preg_replace('/^.*query=([^&]+)&?.*$/i','$1', $referer);
            $query_terms = preg_replace('/\'|"/', '', $query_terms);
            $query_array = preg_split ("/[\s,\+\.]+/", $query_terms);
            break;

        case 'yahoo':
            $query_terms = preg_replace('/^.*p=([^&]+)&?.*$/i','$1', $referer);
            $query_terms = preg_replace('/\'|"/', '', $query_terms);
            $query_array = preg_split ("/[\s,\+\.]+/", $query_terms);
            break;
    } // switch $engine
    return $query_array;
} // function get_search_query_terms


function is_referer_search_engine($engine = 'google') 
{
    //$siteurl = get_settings('home');
    $superCage = Inspekt::makeSuperCage();

    //Using getRaw(). $referer is sanitized below wherever needed
    $referer = urldecode($superCage->server->getEscaped('HTTP_REFERER'));
    //echo "referer is: $referer<br />";
    if ( ! $engine ) {
        return 0;
    }

    switch ($engine) {
        case 'google':
            if (preg_match('|^http://(www)?\.?google.*|i', $referer)) {
                return 1;
            }
            break;

        case 'lycos':
            if (preg_match('|^http://search\.lycos.*|i', $referer)) {
                return 1;
            }
            break;

        case 'yahoo':
            if (preg_match('|^http://search\.yahoo.*|i', $referer)) {
                return 1;
            }
            break;
    } // switch $engine
    return 0;
} // end is_referer_search_engine


/**
 * cpg_get_custom_include()
 *
 * @param string $path
 * @return
 **/
function cpg_get_custom_include($path = '')
{
    global $CONFIG;
    $return = '';
    // check if path is set in config
    if ($path == '') {
        return $return;
    }
    // check if the include file exists
    if (!file_exists($path)) {
        return $return;
    }
    ob_start();
    include($path);
    $return = ob_get_contents();
    ob_end_clean();
    // crude sub-routine to remove the most basic "no-no" stuff from possible includes
    // could need improvement
    $return = str_replace('<html>', '', $return);
    $return = str_replace('<head>', '', $return);
    $return = str_replace('<body>', '', $return);
    $return = str_replace('</html>', '', $return);
    $return = str_replace('</head>', '', $return);
    $return = str_replace('</body>', '', $return);
    return $return;
} // function cpg_get_custom_include


/**
 * filter_content()
 *
 * Replace strings that match badwords with tokens indicating it has been filtered.
 *
 * @param string or array $str
 * @return string or array
 **/
function filter_content($str)
{
    global $lang_bad_words, $CONFIG, $ercp;
    if ($CONFIG['filter_bad_words']) {
        static $ercp=array();
        if (!count($ercp)) foreach($lang_bad_words as $word) {
            $ercp[] = '/' . ($word[0] == '*' ? '': '\b') . str_replace('*', '', $word) . ($word[(strlen($word)-1)] == '*' ? '': '\b') . '/i';
        }
        if (is_array($str)) {
            $new_str=array();
            foreach ($str as $key=>$element) {
                $new_str[$key]=filter_content($element);
            }
            $str=$new_str;
        } else {
        $stripped_str = strip_tags($str);
        $str = preg_replace($ercp, '(...)', $stripped_str);
        }
    }
    return $str;
} // function filter_content


/*
function get_post_var($name, $default = '')
{
    return isset($_POST[$name]) ? $_POST[$name] : $default;
}
*/


function utf_strtolower($str)
{
    if (!function_exists('mb_strtolower')) { 
        require 'include/mb.inc.php'; 
    }
    return mb_strtolower($str);
} // function utf_strtolower

function utf_substr($str, $start, $end=null)
{
    if (!function_exists('mb_substr')) {
        require 'include/mb.inc.php'; 
    }
    return mb_substr($str, $start, $end);
} // function utf_substr

function utf_strlen($str)
{
    if (!function_exists('mb_strlen')) {
        require 'include/mb.inc.php'; 
    }
    return mb_strlen($str);
} // function utf_strlen

function utf_ucfirst($str)
{
    if (!function_exists('mb_strtoupper')) {
        require 'include/mb.inc.php'; 
    }
    return mb_strtoupper(mb_substr($str, 0, 1)).mb_substr($str, 1);
} // function utf_ucfirst


/*
  This function replaces special UTF characters to their ANSI equivelant for
  correct processing by MySQL, keywords, search, etc. since a bug has been
  found:  http://coppermine-gallery.net/forum/index.php?topic=17366.0
*/
function utf_replace($str)
{
    # replace unicode spaces
    $str = preg_replace('#[\xC2\xA0]|[\xE3][\x80][\x80]#', ' ', $str);
    return $str;
} // function utf_replace


function replace_forbidden($str)
{
    static $forbidden_chars;
    if (!is_array($forbidden_chars)) {
        global $CONFIG, $mb_utf8_regex;
        if (function_exists('html_entity_decode')) {
            $chars = html_entity_decode($CONFIG['forbiden_fname_char'], ENT_QUOTES, 'UTF-8');
        } else {
            $chars = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;', '&nbsp;', '&#39;'), array('&', '"', '<', '>', ' ', "'"), $CONFIG['forbiden_fname_char']);
        }
        preg_match_all("#$mb_utf8_regex".'|[\x00-\x7F]#', $chars, $forbidden_chars);
    }
    /**
     * $str may also come from $_POST, in this case, all &, ", etc will get replaced with entities.
     * Replace them back to normal chars so that the str_replace below can work.
     */
    $str = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $str);

    $return = str_replace($forbidden_chars[0], '_', $str);

    /**
     * Fix the obscure, misdocumented "feature" in Apache that causes the server
     * to process the last "valid" extension in the filename (rar exploit): replace all
     * dots in the filename except the last one with an underscore.
     */
    // This could be concatenated into a more efficient string later, keeping it in three
    // lines for better readability for now.
    $extension = ltrim(substr($return,strrpos($return,'.')),'.');
    $filenameWithoutExtension = str_replace('.' . $extension, '', $return);
    $return = str_replace('.', '_', $filenameWithoutExtension) . '.' . $extension;

    return $return;
} // function replace_forbidden


/**
 * resetDetailHits()
 *
 * Reset the detailed hits stored in hit_stats table for the given pid
 *
 * @param int or array $pid
 **/
function resetDetailHits($pid)
{
    global $CONFIG;
	####################     DB     ##################
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	############################################
    if (is_array($pid)) {
        if (!count($pid)) {
            return;
        } else {
            $clause = "pid IN (".implode(',', $pid).")";
        }
    } else {
        $clause = "pid = '$pid'";
    }

    /*$query = "DELETE FROM {$CONFIG['TABLE_HIT_STATS']} WHERE $clause";
    cpg_db_query($query);*/
    ####################     DB     ###################
    $cpgdb->query($cpg_db_functions_inc['reset_detail_hits'], $clause);
    #############################################
} // function resetDetailHits


/**
 * resetDetailVotes()
 *
 * Reset the detailed votes stored in vote_stats table for the given pid
 *
 * @param int or array $pid
 **/
function resetDetailVotes($pid)
{
	global $CONFIG;
	####################     DB     ##################
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	############################################

    if (is_array($pid)) {
        if (!count($pid)) {
            return;
        } else {
            $clause = "pid IN (".implode(',', $pid).")";
        }
    } else {
        $clause = "pid = '$pid'";
    }

    /*$query = "DELETE FROM {$CONFIG['TABLE_VOTE_STATS']} WHERE $clause";
    cpg_db_query($query);*/
    ####################     DB     ###################
    $cpgdb->query($cpg_db_functions_inc['reset_detail_votes'], $clause);
    #############################################
} // function resetDetailVotes


/**
* cpgValidateColor()
*
* Validate a string: is a color code in x11 or hex?
*
* Returns the validated color string (hex with a leading #-sign or x11 color-code, or nothing if not valid)
*
* @param string $color
* @return $color
**/
function cpgValidateColor($color) 
{
    $x11ColorNames = array('white', 'ivory', 'lightyellow', 'yellow', 'snow', 'floralwhite', 'lemonchiffon', 'cornsilk', 'seashell', 'lavenderblush', 'papayawhip', 'blanchedalmond', 'mistyrose', 'bisque', 'moccasin', 'navajowhite', 'peachpuff', 'gold', 'pink', 'lightpink', 'orange', 'lightsalmon', 'darkorange', 'coral', 'hotpink', 'tomato', 'orangered', 'deeppink', 'fuchsia', 'magenta', 'red', 'oldlace', 'lightgoldenrodyellow', 'linen', 'antiquewhite', 'salmon', 'ghostwhite', 'mintcream', 'whitesmoke', 'beige', 'wheat', 'sandybrown', 'azure', 'honeydew', 'aliceblue', 'khaki', 'lightcoral', 'palegoldenrod', 'violet', 'darksalmon', 'lavender', 'lightcyan', 'burlywood', 'plum', 'gainsboro', 'crimson', 'palevioletred', 'goldenrod', 'orchid', 'thistle', 'lightgrey', 'tan', 'chocolate', 'peru', 'indianred', 'mediumvioletred', 'silver', 'darkkhaki', 'rosybrown', 'mediumorchid', 'darkgoldenrod', 'firebrick', 'powderblue', 'lightsteelblue', 'paleturquoise', 'greenyellow', 'lightblue', 'darkgray', 'brown', 'sienna', 'yellowgreen', 'darkorchid', 'palegreen', 'darkviolet', 'mediumpurple', 'lightgreen', 'darkseagreen', 'saddlebrown', 'darkmagenta', 'darkred', 'blueviolet', 'lightskyblue', 'skyblue', 'gray', 'olive', 'purple', 'maroon', 'aquamarine', 'chartreuse', 'lawngreen', 'mediumslateblue', 'lightslategray', 'slategray', 'olivedrab', 'slateblue', 'dimgray', 'mediumaquamarine', 'cornflowerblue', 'cadetblue', 'darkolivegreen', 'indigo', 'mediumturquoise', 'darkslateblue', 'steelblue', 'royalblue', 'turquoise', 'mediumseagreen', 'limegreen', 'darkslategray', 'seagreen', 'forestgreen', 'lightseagreen', 'dodgerblue', 'midnightblue', 'aqua', 'cyan', 'springgreen', 'lime', 'mediumspringgreen', 'darkturquoise', 'deepskyblue', 'darkcyan', 'teal', 'green', 'darkgreen', 'blue', 'mediumblue', 'darkblue', 'navy', 'black');
    if (in_array(strtolower($color), $x11ColorNames) == TRUE) {
        return $color;
    } else {
        $color = ltrim($color, '#'); // strip a leading #-sign if there is one
        if (preg_match('/^[a-f\d]+$/i', strtolower($color)) == TRUE && strlen($color)<=6) {
            $color = '#'.strtoupper($color);
            return $color;
        }
    }
} // function cpgValidateColor


/**
* cpgStoreTempMessage()
*
* Store a temporary message to the database to carry over from one page to the other
*
* @param string $message
* @return $message_id
**/
function cpgStoreTempMessage($message) 
{
    global $CONFIG;
    ####################     DB     ##################
    global $cpg_db_functions_inc;
    $cpgdb =& cpgDB::getInstance();
    $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
    ############################################
    $message = urlencode($message);
    // come up with a unique message id
    $message_id = ereg_replace("[^A-Za-z0-9]", "",
        base64_encode(rand(10000,30000).time().USER_ID.md5($message)));
    // write the message to the database
    $user_id = USER_ID;
    $time = time();

    // Insert the record in database
    /*$query = "INSERT INTO {$CONFIG['TABLE_TEMP_MESSAGES']} "
                ." SET "
                    ." message_id = '$message_id', "
                    ." user_id = '$user_id', "
                    ." time   = '$time', "
                    ." message = '$message'";
    cpg_db_query($query);*/
    ###################      DB     ###################
    $cpgdb->query($cpg_db_functions_inc['store_temp_message'],$message_id, $user_id, $time, $message);
    ############################################
    // return the message_id
    return $message_id;
} // function cpgStoreTempMessage


/**
* cpgFetchTempMessage()
*
* Fetch a temporary message from the database and then delete it.
*
*
*
* @param string $message_id
* @return $message
**/
function cpgFetchTempMessage($message_id)
{
    global $CONFIG;
    ####################     DB     ##################
    global $cpg_db_functions_inc;
    $cpgdb =& cpgDB::getInstance();
    $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
    ############################################
    $user_id = USER_ID;
    $time = time();
    $message = '';

    /*// Read the record in database
    $query = "SELECT message AS message FROM {$CONFIG['TABLE_TEMP_MESSAGES']} "
            ." WHERE message_id = '$message_id' LIMIT 1";
    $result = cpg_db_query($query);
    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_row($result);
        $message = urldecode($row[0]);
    }
    // delete the message once fetched
    $query = "DELETE FROM {$CONFIG['TABLE_TEMP_MESSAGES']} WHERE message_id = '$message_id'";
    cpg_db_query($query);*/
    ############################     DB     ###########################
    // Read the record in database
    $cpgdb->query($cpg_db_functions_inc['read_temp_message'], $message_id);
    $rowset = $cpgdb->fetchRowSet();
    if (count($rowset) > 0) {
        $row = $rowset[0];
        $message = urldecode($row['message']);
    }
    // delete the message once fetched
    $cpgdb->query($cpg_db_functions_inc['delete_temp_message'], $message_id);
    ##############################################################
    // return the message
    return $message;
} // function cpgFetchTempMessage


/**
* cpgCleanTempMessage()
*
* Clean up the temporary messages table (garbage collection).
*
* @param string $seconds
* @return void
**/
/*function cpgCleanTempMessage($seconds = 3600) 
{
    global $CONFIG;
    $time = time() - (int)$seconds;
    // delete the messages older than the specified amount
    $query = "DELETE FROM {$CONFIG['TABLE_TEMP_MESSAGES']} WHERE time < '$time'";
    cpg_db_query($query);	
} // function cpgCleanTempMessage*/
########################     DB     #######################
function cpgCleanTempMessage($seconds = 3600) 
{
	global $CONFIG;
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	$time = time() - (int)$seconds;
	// delete the messages older than the specified amount
	$cpgdb->query($cpg_db_functions_inc['clean_temp_message'], $time);
} // function cpgCleanTempMessage
#######################################################


/**
* cpgRedirectPage()
*
* Redirect to the target page or display an info screen first and then redirect
*
* @param string $targetAddress
* @param string $caption
* @param string $message
* @param string $countdown
* @return void
**/
function cpgRedirectPage($targetAddress = '', $caption = '', $message = '', $countdown = 0) 
{
    global $CONFIG, $lang_common;
    if ($CONFIG['display_redirection_page'] == 0) {
        $header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
        if (strpos($targetAddress, '?') == FALSE) {
            $separator = '?';
        } else {
            $separator = '&';
        }
        header($header_location . $targetAddress.$separator.'message_id='.cpgStoreTempMessage($message).'#cpgMessageBlock');
        pageheader($caption, "<META http-equiv=\"refresh\" content=\"1;url=$targetAddress\">");
        msg_box($caption, $message, $lang_common['continue'], $location);
        pagefooter();
        ob_end_flush();
        exit;
    } else {
        pageheader($caption, "<META http-equiv=\"refresh\" content=\"1;url=$targetAddress\">");
        msg_box($caption, $message, $lang_common['continue'], $location);
        pagefooter();
        ob_end_flush();
        exit;
    }
} // function cpgRedirectPage


/**
* cpgGetScriptNameParams()
*
* Returns the script name and all vars except the ones defined in exception (which could be an array or a var).
* Particularly helpfull to create links
*
* @param mixed $exception
* @return $return
**/
function cpgGetScriptNameParams($exception = '') 
{
    $superCage = Inspekt::makeSuperCage();

    if (!is_array($exception)) {
        $exception = array(0 => $exception);
    }

    // get the file name first
    $match = $superCage->server->getRaw('SCRIPT_NAME'); // We'll sanitize the script path later
    $filename = ltrim(strrchr($match,'/'), '/'); // Drop everything untill (and including) the last slash, this results in the file name only
    if (!preg_match('/^(([a-zA-Z0-9_\-]){1,})((\.){1,1})(([a-zA-Z]){2,6})+$/', $filename)) { // the naming pattern we check against: an infinite number of lower and upper case alphanumerals plus allowed special chars dash and underscore, then one (and only one!) dot, then between two and 6 alphanumerals in lower or upper case
       $filename = 'index.php'; // If this doesn't match, default to the index page
    }
    $return = $filename . '?';

    // Now get the parameters.
    // WARNING: as this function is meant to just return the URL parameters
    // (minus the one mentioned in $exception), neither the parameter names 
    // nor the the values should be sanitized, as we simply don't know here 
    // against what we're suppossed to sanitize.
    // For now, I have chosen the safe method, sanitizing the parameters. 
    // Not sure if this is a bright idea for the future.
    // So, use the parameters returned from this function here with the same 
    // caution that applies to anything the user could tamper with. 
    // The function is meant to help you generate links (in other words: 
    // something the user could come up with by typing them just as well), 
    // so don't abuse this function for anything else.
     $matches = $superCage->server->getMatched('QUERY_STRING', '/^[a-zA-Z0-9&=_\/.]+$/');
     if ($matches) {
        $queryString = explode('&', $matches[0]);
     } else {
        $queryString = array();
     }

     foreach ($queryString as $val) {
        list($key, $value) = explode('=', $val);
        if (!in_array($key,$exception)) {
            $return .= $key . "=" . $value . "&";
        }
     }

    return $return;
} // function cpgGetScriptNameParams


/**
 * cpgValidateDate()
 *
 * Returns $date if $date contains a valid date string representation (yyyy-mm-dd). Returns an empty string if not.
 *
 * @param mixed $date
 * @return $return
**/
function cpgValidateDate($date) 
{
    $pattern = '^(19|20)([0-9]{2}-((0[13-9]|1[0-2])-(0[1-9]|[12][0-9]|30)|(0[13578]|1[02])-31|02-(0[1-9]|1[0-9]|2[0-8]))|([2468]0|[02468][48]|[13579][26])-02-29)$';
    if (ereg($pattern, $date) == TRUE) {
        $return = $date;
    } else {
        $return = '';
    }
    return $return;
} // function cpgValidateDate


/**
 * cpgGetRemoteFileByURL()
 *
 * Returns array that contains content of a file (URL) retrieved by curl, fsockopen or fopen (fallback). Array consists of:
 * $return['headers'] = header array,
 * $return['error'] = error number and messages array (if error)
 * $return['body'] = actual content of the fetched file as string
 *
 * @param mixed $url, $method, $data, $redirect
 * @return array
 **/
function cpgGetRemoteFileByURL($remoteURL, $method = "GET", $redirect = 10, $minLength = '0') 
{
    global $lang_get_remote_File_by_url;
    // FSOCK code snippets taken from http://jeenaparadies.net/weblog/2007/jan/get_remote_file
    $url = parse_url($remoteURL); // chop the URL into protocol, domain, port, folder, file, parameter
    if (!isset($url['host'])) {
        $url['host'] = '';
    }
    if (!isset($url['scheme'])) {
        $url['scheme'] = '';
    }
    if (!isset($url['port'])) {
        $url['port'] = '';
    }
    $body = '';
    $headers = '';
    $error = '';
    $lineBreak = "<br />\r\n";
    // Let's try CURL first
    if (function_exists('curl_init') == TRUE) { // don't bother to try curl if it isn't there in the first place
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $remoteURL);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        ob_start();
        curl_exec($curl);
        $body = ob_get_contents();
        ob_end_clean();
        ob_end_flush();
        $headers = curl_getinfo($curl);
        curl_close($curl);
        if (strlen($body) < $minLength ) {
            // Fetching the data by CURL obviously failed
            $error .= sprintf($lang_get_remote_File_by_url['no_data_returned'], $lang_get_remote_File_by_url['curl']) . $lineBreak;
        } else {
            // Fetching the data by CURL was successfull. Let's return the data
            return array("headers" => $headers, "body" => $body);
        }
    } else {
        // Curl is not available
        $error .= $lang_get_remote_File_by_url['curl_not_available'] . $lineBreak;
    }
    // Now let's try FSOCKOPEN
    if ($url['host'] != '') {
        $fp = @fsockopen ($url['host'], (!empty($url['port']) ? (int)$url['port'] : 80), $errno, $errstr, 30);
        if ($fp) { // fsockopen file handle success - start
            $path = (!empty($url['path']) ? $url['path'] : "/").(!empty($url['query']) ? "?".$url['query'] : "");
            $header = "\r\nHost: ".$url['host'];
            fputs ($fp, $method." ".$path." HTTP/1.0".$header."\r\n\r\n".("post" == strtolower($method) ? $data : ""));
            if (!feof($fp)) {
                $scheme = fgets($fp);
                //list(, $code ) = explode(" ", $scheme);
                $headers = explode(" ", $scheme);
                //$headers = array("Scheme" => $scheme);
            }
            while ( !feof($fp) ) {
                $h = fgets($fp);
                if ($h == "\r\n" OR $h == "\n") {
                    break;
                }
                list($key, $value) = explode(":", $h, 2);
                $key = strtolower($key);
                $value = trim($value);
                if (isset($headers[$key])) {
                    $headers[$key] .= ','.trim($value);
                } else {
                    $headers[$key] = trim($value);
                }
            }
            $body = '';
            while ( !feof($fp) ) {
                $body .= fgets($fp);
            }
            fclose($fp);
            if (strlen($body) < $minLength) {
                // Fetching the data by FSOCKOPEN obviously failed
                $error .= sprintf($lang_get_remote_File_by_url['no_data_returned'], $lang_get_remote_File_by_url['fsockopen']) . $lineBreak;
            } elseif (in_array('404', $headers) == TRUE) {
                // We got a 404 error
                $error .= sprintf($lang_get_remote_File_by_url['error_number'], '404') . $lineBreak;
            } else {
                // Fetching the data by FSOCKOPEN was successfull. Let's return the data
                return array("headers" => $headers, "body" => $body, "error" => $error);
            }
        } else {  // fsockopen file handle failure - start
            $error .= $lang_get_remote_File_by_url['fsockopen'] . ': ';
            $error .= sprintf($lang_get_remote_File_by_url['error_number'], $errno);
            $error .= sprintf($lang_get_remote_File_by_url['error_message'], $errstr);
        }
    } else {
        //$error .= 'No Hostname set. In other words: we\'re trying to retrieve a local file';
    }
    // Finally, try FOPEN
    @ini_set('allow_url_fopen','1'); // Try to override the existing policy
    if ($url['scheme'] != '') {
        $protocol = $url['scheme'].'://';
    }  else {
        $protocol = '';
    }
    if ($url['port'] != '') {
        $port = ':'.(int)$url['port'];
    } elseif ($url['host'] != '') {
        $port = ':80';
    } else {
        $port = '';
    }
    $handle  = @fopen($protocol.$url['host'].$port.$url['path'], 'r');
    if ($handle) {
        while (!feof($handle)) {
            $body .= fread($handle, 1024);
        }
        fclose($handle);
        if (strlen($body) < $minLength) {
            $error .= sprintf($lang_get_remote_File_by_url['no_data_returned'], $lang_get_remote_File_by_url['fopen']) . $lineBreak;
        } else {
            // Fetching the data by FOPEN was successfull. Let's return the data
            return array("headers" => $headers, "body" => $body, "error" => $error);
        }
    } else { // opening the fopen handle failed as well
        // if the script reaches this stage, all available methods failed, so let's return the error messages and give up
        return array("headers" => $headers, "body" => $body, "error" => $error);
    }
} // function cpgGetRemoteFileByURL


/**
 * user_is_allowed()
 *
 * Check if a user is allowed to edit pictures/albums
 *
 * @return boolean $check_approve
 */
function user_is_allowed() 
{
    if (GALLERY_ADMIN_MODE) {
        return true;
    }
    $check_approve = false;
    global $USER_DATA, $CONFIG;
	####################     DB     ##################
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	############################################
    $superCage = Inspekt::makeSuperCage();

    //get albums this user can edit
    if ($superCage->get->keyExists('album')) {
        $album_id = $superCage->get->getInt('album');
    } elseif ($superCage->post->keyExists('aid')) {
        $album_id = $superCage->post->getInt('aid');
    } else {
        //workaround when going straight to modifyalb.php and no album is set in superglobals
        if (defined('MODIFYALB_PHP')) {
            //check if the user has any album available
            /*$result = cpg_db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE owner = " . $USER_DATA['user_id'] . " LIMIT 1");
            $temp_album_id = cpg_db_fetch_row($result);*/
			#########################      DB      ########################
			$cpgdb->query($cpg_db_functions_inc['check_alb_available'], $USER_DATA['user_id']);
			$temp_album_id = $cpgdb->fetchRow();
			########################################################
            $album_id = $temp_album_id['aid'];
        } else {
            $album_id = 0;
        }

    }

    /*$result = cpg_db_query("SELECT DISTINCT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE owner = '" . $USER_DATA['user_id'] . "' AND aid='$album_id'");
    $allowed_albums = cpg_db_fetch_rowset($result);*/
	#########################      DB      ########################
	$cpgdb->query($cpg_db_functions_inc['get_available_alb'], $USER_DATA['user_id'], $album_id);
	$allowed_albums = $cpgdb->fetchRowSet();
	########################################################
    $cat = $allowed_albums[0]['category'];
    if ($cat != '') {
        $check_approve = true;
    }

    //check if admin allows editing after closing category
    if ($CONFIG['allow_user_edit_after_cat_close'] == 0){
        //Disallowed -> Check if album is in such a category
        /*$result = cpg_db_query("SELECT DISTINCT aid FROM {$CONFIG['TABLE_ALBUMS']} AS alb INNER JOIN {$CONFIG['TABLE_CATMAP']} AS catm ON alb.category=catm.cid WHERE alb.owner = '" . $USER_DATA['user_id'] . "' AND alb.aid='$album_id' AND catm.group_id='" . $USER_DATA['group_id'] . "'");
        $allowed_albums = cpg_db_fetch_rowset($result);*/
		#########################      DB      ########################
		$cpgdb->query($cpg_db_functions_inc['check_edit_allowed'], $USER_DATA['user_id'], $album_id, $USER_DATA['group_id']);
		$allowed_albums = $cpgdb->fetchRowSet();
		########################################################
        if ($allowed_albums[0]['aid'] == '' && $cat != (FIRST_USER_CAT + USER_ID)) {
            $check_approve = false;
        } elseif ($cat == (FIRST_USER_CAT + USER_ID)) {
            $check_approve = true;
        }
    }
    return $check_approve;
} // function user_is_allowed


/**
 * Function to set/output js files to be included.
 *
 * This function sets a js file to be included in the head section of the html (in theme_javascript_head() function).
 * This function should be called before pageheader function since the js files are included in pageheader.
 * If the optional second paramter is passed as true then instead of setting it for later use the html for
 * js file inclusion is returned right away
 *
 * @param string $filename Relative path, from the root of cpg, to the js file
 * @param boolean $inline If true then the html is returned
 * @return mixed Returns the html for js inclusion or null if inline is false
 */
function js_include($filename, $inline = false)
{
    global $JS;

    // Proceed with inclusion only if the file exists
    if (!file_exists($filename)) {
        return;
    }

    // If we need to show the html inline then return the required html
    if ($inline) {
        return '<script type="text/javascript" src="' . $filename . '"></script>';
    } else {
        // Else add the file to js includes array which will later be used in head section
        $JS['includes'][] = $filename;
    }
} // function js_include


/**
 * Function to set a js var from php
 *
 * This function sets a js var in an array. This array is later converted to json string and outputted
 * in the head section of html (in theme_javascript_head function).
 * All variables which are set using this function can be accessed in js using the json object named js_vars.
 *
 * Ex: If you set a variable: set_js_var('myvar', 'myvalue')
 * then you can access it in js using : js_vars.myvar
 *
 * @param string $var Name of the variable by which the value will be accessed in js
 * @param mixed $val Value which can be string, int, array or boolean
 */
function set_js_var($var, $val) 
{
    global $JS;

    // Add the variable to global array which will be used in theme_javascript_head() function
    $JS['vars'][$var] = $val;
} // function set_js_var


/**
 * Function to convert php array to json
 *
 * This function is equivalent to PHP 5.2 's json_encode. PHP's native function will be used if the
 * version is greater than equal to 5.2
 *
 * @param array $arr Array which is to be converted to json string
 * @return string json string
 */
if (!function_exists('json_encode')) {
function json_encode($arr) 
{
    // If the arr is object then gets its variables
    if (is_object($arr)) {
        $arr = get_object_vars($arr);
    }

    $out = array();
    $keys = array();
    // If arr is array then get its keys
    if (is_array($arr)) {
        $keys = array_keys($arr);
    }

    $numeric = true;
    // Find whether the keys are numeric or not
    if (!empty($keys)) {
        $numeric = (array_values($keys) === array_keys(array_values($keys)));
    }

    foreach ($arr as $key => $val) {
        // If the value is array or object then call json_encode recursively
        if (is_array($val) || is_object($val)) {
            $val = json_encode($val);
        } else {
            // If the value is not numeric and boolean then escape and quote it
            if ((!is_numeric($val) && !is_bool($val))) {
                $escape = array("\r\n" => '\n', "\r" => '\n', "\n" => '\n', '"' => '\"', "'" => "\\'");
                $val = str_replace(array_keys($escape), array_values($escape), $val);
                $val = '"' . $val . '"';
            }
            if ($val === null) {
                $val = 'null';
            }
            if (is_bool($val)) {
                $val = $val ? 'true' : 'false';
            }
        }
        // If key is not numeric then quote it
        if (!$numeric) {
            $val = '"' . $key . '"' . ':' . $val;
        }

        $out[] = $val;
    }

    if (!$numeric) {
        $return = '{' . implode(', ', $out) . '}';
    } else {
        $return = '[' . implode(', ', $out) . ']';
    }

    return $return;
} // function json_encode
} // if !function_exists(json_encode)


/**
 * function cpg_getimagesize()
 *
 * Try to get the size of an image, this is custom built as some webhosts disable this function or do weird things with it
 *
 * @param string $image
 * @param boolean $force_cpg_function
 * @return array $size
 */
function cpg_getimagesize($image, $force_cpg_function = false)
{
    if (!function_exists('getimagesize') || $force_cpg_function) {
        // custom function borrowed from http://www.wischik.com/lu/programmer/get-image-size.html
        $f = @fopen($image, 'rb');
        if ($f === false) {
            return false;
        }
        fseek($f, 0, SEEK_END);
        $len = ftell($f);
        if ($len < 24) {
            fclose($f);
            return false;
        }
        fseek($f, 0);
        $buf = fread($f, 24);
        if ($buf === false) {
            fclose($f);
            return false;
        }
        if (ord($buf[0]) == 255 && ord($buf[1]) == 216 && ord($buf[2]) == 255 && ord($buf[3]) == 224 && $buf[6] == 'J' && $buf[7] == 'F' && $buf[8] == 'I' && $buf[9] == 'F') {
            $pos=2;
            while (ord($buf[2]) == 255) {
                if (ord($buf[3]) == 192 || ord($buf[3]) == 193 || ord($buf[3]) == 194 || ord($buf[3]) == 195 || ord($buf[3]) == 201 || ord($buf[3]) == 202 || ord($buf[3]) == 203) {
                    break; // we've found the image frame
                }
                $pos += 2 + (ord($buf[4]) << 8) + ord($buf[5]);
                if ($pos+12>$len) {
                    break; // too far
                }
                fseek($f,$pos);
                $buf = $buf[0] . $buf[1] . fread($f,12);
            }
        }
        fclose($f);

        // GIF:
        if ($buf[0] == 'G' && $buf[1] == 'I' && $buf[2] == 'F') {
            $x = ord($buf[6]) + (ord($buf[7])<<8);
            $y = ord($buf[8]) + (ord($buf[9])<<8);
            $type = 1;
        }

        // JPEG:
        if (ord($buf[0]) == 255 && ord($buf[1]) == 216 && ord($buf[2]) == 255) {
            $y = (ord($buf[7])<<8) + ord($buf[8]);
            $x = (ord($buf[9])<<8) + ord($buf[10]);
            $type = 2;
        }

        // PNG:
        if (ord($buf[0]) == 0x89 && $buf[1] == 'P' && $buf[2] == 'N' && $buf[3] == 'G' && ord($buf[4]) == 0x0D && ord($buf[5]) == 0x0A && ord($buf[6]) == 0x1A && ord($buf[7]) == 0x0A && $buf[12] == 'I' && $buf[13] == 'H' && $buf[14] == 'D' && $buf[15] == 'R') {
            $x = (ord($buf[16])<<24) + (ord($buf[17])<<16) + (ord($buf[18])<<8) + (ord($buf[19])<<0);
            $y = (ord($buf[20])<<24) + (ord($buf[21])<<16) + (ord($buf[22])<<8) + (ord($buf[23])<<0);
            $type = 3;
        }

        // added ! from source line since it doesn't work otherwise
        if (!isset($x, $y, $type)) {
            return false;
        }
        return array($x, $y, $type, 'height="' . $x . '" width="' . $y . '"');
    } else {
        $size = getimagesize($image);
        if (!$size) {
            //false was returned
            return cpg_getimagesize($image, true/*force the use of custom function*/);
        } elseif (!isset($size[0]) || !isset($size[1])) {
            //webhost possibly changed getimagesize functionality
            return cpg_getimagesize($image, true/*force the use of custom function*/);
        } else {
            //function worked as expected, return the results
            return $size;
        }
    }
} // function cpg_getimagesize


function check_rebuild_tree()
{
    global $CONFIG;
	############################     DB     ################################
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################################
	
    /*$sql = "SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}categories WHERE lft = 0";
    $result = cpg_db_query($sql);
    list($count) = mysql_fetch_row($result);*/
	###########################     DB     ###########################
	$cpgdb->query($cpg_db_functions_inc['get_cat_lft_zero']);
	$row = $cpgdb->fetchRow();
	$count = $row['count'];
	############################################################
	
    if ($count) {
        return rebuild_tree(0,0,0,0);
    } else {
        return false;
    }
} // function check_rebuild_tree


function rebuild_tree($parent, $left, $depth, $pos) {

    global $CONFIG;
	############################     DB     ################################
	global $cpg_db_functions_inc;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################################
	
   // the right value of this node is the left value + 1
   $right = $left+1;

	$thispos = $pos;

    if ($CONFIG['categories_alpha_sort'] == 1) {
        $sort_query = 'name';
    } else {
        $sort_query = 'pos';
    }

    // get all children of this node
    /*$result = cpg_db_query("SELECT cid FROM {$CONFIG['TABLE_PREFIX']}categories WHERE parent = $parent ORDER BY $sort_query, cid");
    while ($row = mysql_fetch_array($result)) {
        // recursive execution of this function for each
        // child of this node
        // $right is the current right value, which is
        // incremented by the rebuild_tree function
        if ($row['cid']) $right = rebuild_tree($row['cid'], $right, $depth+1, $pos++);
   }*/
    ################################      DB     ##############################
    $result = $cpgdb->query($cpg_db_functions_inc['get_child'], $parent, $sort_query);
    $rowset = $cpgdb->fetchRowSet();
    foreach ($rowset as $row) {
	    // recursive execution of this function for each
        // child of this node
        // $right is the current right value, which is
        // incremented by the rebuild_tree function
        if ($row['cid']) $right = rebuild_tree($row['cid'], $right, $depth+1, $pos++);
    }
    ####################################################################

    // we've got the left value, and now that we've processed
    // the children of this node we also know the right value
    //cpg_db_query("UPDATE {$CONFIG['TABLE_PREFIX']}categories SET lft = $left, rgt = $right, depth = $depth, pos = $thispos WHERE cid = $parent LIMIT 1");
    ######################################       DB      ####################################
    $cpgdb->query($cpg_db_functions_inc['update_cat'], $left, $right, $depth, $thispos, $parent);
    ################################################################################

    // return the right value of this node + 1
    return $right+1;
} // function rebuild_tree

/**
 * Function to fetch an icon
 *
 *
 * @param string $icon_name: the name of the icon to fetch
 * @param string $title string: to populate the title attribute of the <img>-tag
 * @param string $config_level boolean: If populated, the config option that allows toggling icons on/off will be ignored and the icon will be displayed no matter what
 * @param string $check boolean: If populated, the icon will be checked first if it exists
 * @param string $extension: name of the extension, default being 'png'
 * @return string: the fully populated <img>-tag
 */
function cpg_fetch_icon($icon_name, $config_level = 0, $title = '', $check = '', $extension = 'png')
{
    global $CONFIG, $THEME_DIR;
    if ($CONFIG['enable_menu_icons'] < $config_level) {
      return;
    }
    $return = '';
    if (defined('THEME_HAS_MENU_ICONS')) {
      $folder = $THEME_DIR . 'images/icons/';
    } else {
      $folder = 'images/icons/';
    }
    // sanitize extension
    if ($extension != 'jpg' && $extension != 'gif') {
      $extension = 'png';
    }
    $relative_path = $folder . $icon_name . '.' . $extension;
    // check if file exists
    if ($check != '') {
      if (file_exists($relative_path) != TRUE) {
        return;
      }
    }
    $return .= '<img src="';
    $return .= $relative_path;
    $return .= '" border="0" alt="" ';
    // Add width and height attributes. 
    // Actually reading the dimensions would be too time-consuming,
    // so we assume 16 x 16 pixels unless specified otherwise in
    // the custom theme
    if (defined('THEME_HAS_MENU_ICONS')) {
      $return .= 'width="' . THEME_HAS_MENU_ICONS . '" height="' . THEME_HAS_MENU_ICONS . '" ';
    } else {
      $return .= 'width="16" height="16" ';
    }
    if ($title != '') {
      $return .= 'title="' . $title . '" ';
    }
    $return .= 'class="icon" />';
    return $return;
}

/**
 * Function to convert numbers (floats) into formatted strings
 * Example: cpg_float2decimal(100000) will return the string 100,000 for English and 100.000 for German
 *
 * @param float $float: the value that should be converted
 * @return string: the fully populated string
 */
function cpg_float2decimal($float) {
    global $lang_decimal_separator;
    $value = floor($float);
    $decimal_page = ltrim(strstr($float, '.'),'.');
    
    // initialize some vars start
        $return = '';
        $fit = 3; // how many digits to use
        $fill = "0"; // what to fill
    // initialize some vars end
    $remainder = floor($value);

    while ($remainder >= 1000) {
        $chop = $remainder - (floor($remainder/pow(10,3)) * pow(10,3));
        $chop = sprintf ("%'{$fill}{$fit}s", $chop); // fill the chop with leading zeros if needed
        $remainder = floor($remainder/pow(10,3));
        $return = $lang_decimal_separator[0].$chop.$return;
    }
    $return = $remainder.$return;
    if ($decimal_page != 0) {
        $return .= $lang_decimal_separator[1].$decimal_page;
    }
    return $return;
}

/**
 * Function get the contents of a folder
  *
 * @param string $foldername: the relative path
 * @param string $fileOrFolder: what should be returned: files or sub-folders. Specify 'file' or 'folder'.
 * @param string $validextension: What file extension should be filtered. Specify 'gif' or 'html' or similar.
 * @param array $exception_array: optional: specify values that should not be taken into account.
 * @return array: a list of file names (without extension)
 */
if (!function_exists('form_get_foldercontent')) {
    function form_get_foldercontent ($foldername, $fileOrFolder = 'folder', $validextension = '', $exception_array = array('')) 
    {
        global $CONFIG;
        $dir = opendir($foldername);
        while ($file = readdir($dir)) {
            if ($fileOrFolder == 'file') {
                $extension = ltrim(substr($file,strrpos($file,'.')),'.');
                $filenameWithoutExtension = str_replace('.' . $extension, '', $file);
                if (is_file($foldername . $file) && $extension == $validextension && in_array($filenameWithoutExtension, $exception_array) != TRUE) {
                    $return_array[$filenameWithoutExtension] = $filenameWithoutExtension;
                }
            } elseif ($fileOrFolder == 'folder') {
                if ($file != '.' && $file != '..' && in_array($file, $exception_array) != TRUE && is_dir($foldername.$file)) {
                    $return_array[$file] = $file;
                }
            }
        }
        closedir($dir);
        natcasesort($return_array);
        //unset($return_array);
        //$return_array = array('foo' => 'foo1', 'bar' => 'b a r');
        return $return_array;
    }
}

/**
 * Function get a list of available languages
  *
  * @return array: an ascotiative array of language file names (without extension) and language names
 */
if (!function_exists('cpg_get_available_languages')) {
    function cpg_get_available_languages() 
    {
        // Work in progress - GauGau
        global $CONFIG;
        ############################     DB     ################################
        global $cpg_db_functions_inc;
        $cpgdb =& cpgDB::getInstance();
        $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
        ##################################################################
        // Make sure that the language table exists in the first place - 
        // return without return value if the table doesn't exist because 
        // the upgrade script hasn't been run
        /*$results = cpg_db_query("SHOW TABLES LIKE '{$CONFIG['TABLE_LANGUAGE']}'");
        if (!mysql_num_rows($results)) {
        	// The update script has not been run - use the "old school" language file lookup and return the contents
            $language_array = form_get_foldercontent('lang/','file', 'php');
            ksort($language_array);
            return $language_array;
        }
        mysql_free_result($results);*/
        ##############################      DB     ##############################
        $results = $cpgdb->query($cpg_db_functions_inc['chk_langtbl_exists']);
        $rowset = $cpgdb->fetchRowSet();
        if (count($rowset) == 0) {
        	// The update script has not been run - use the "old school" language file lookup and return the contents
            $language_array = form_get_foldercontent('lang/','file', 'php');
            ksort($language_array);
            return $language_array;
        }
        $cpgdb->free();
        unset($rowset);
        ##################################################################
        unset($results);
        
        // get list of available languages
        /*$results = cpg_db_query("SELECT lang_id, english_name, native_name, custom_name FROM {$CONFIG['TABLE_LANGUAGE']} WHERE available='YES' AND enabled='YES' ");
        while ($row = mysql_fetch_array($results)) {*/
        ###############################    DB   ###############################
        $results = $cpgdb->query($cpg_db_functions_inc['list_available_languages']);
        while ($row = $cpgdb->fetchRow()) {
        ##################################################################
            if (file_exists ('lang/'.$row['lang_id'].'.php') == TRUE) {
                if ($row['custom_name'] != '') {
                    $language_array[$row['lang_id']] = $row['custom_name'];
                } elseif ($row['english_name'] != '') {
                    $language_array[$row['lang_id']] = $row['english_name'];
                } else {
                    $language_array[$row['lang_id']] = str_replace('_', ' ', ucfirst($row['lang_id']));
                }
                if ($row['native_name'] != '' && $row['native_name'] != $language_array[$row['lang_id']]) {
                    $language_array[$row['lang_id']] .= ' - ' . $row['native_name'];
                }
            }
        } // while
        //mysql_free_result($results);
        $cpgdb->free(); #####   cpgdbal
        unset($results);
        unset($row);
        if (count($language_array) == 0) {
            unset($language_array);
            $language_array = form_get_foldercontent('lang/','file', 'php');
        }
        // sort the array by English name
        ksort($language_array);        
        return $language_array;
    }
}

if (!function_exists('array_is_associative')) { // make sure that this will not break in future PHP versions
    function array_is_associative($array) 
    {
        if (is_array($array) && ! empty($array)) {
            for ( $iterator = count($array) - 1; $iterator; $iterator-- ) {
                if (!array_key_exists($iterator, $array)) { 
                    return true; 
                }
            }
            return !array_key_exists(0, $array);
        }
        return false;
    }
}

function cpg_config_set($name, $value) {

	global $CONFIG, $USER_DATA;
    ##################     DB     ###################
    global $cpg_db_functions_inc;
    $cpgdb =& cpgDB::getInstance();
    $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
    ##########################################
	
	$value = addslashes($value);
	
	if ($CONFIG[$name] === $value) {
		return;
	}
	
	/*$sql = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$value' WHERE name = '$name'";
	
	cpg_db_query($sql);*/
    ###############################    DB    #############################
    $sql = sprintf($cpg_db_functions_inc['update_config_data'], $value, $name);
    $cpgdb->query($sql);
    #################################################################

	$CONFIG[$name] = $value;
	
	if ($CONFIG['log_mode'] == CPG_LOG_ALL) {
	
		log_write(
			"CONFIG UPDATE SQL: $sql\n".
			'TIME: '.date("F j, Y, g:i a")."\n".
			'USER: '.$USER_DATA['user_name'],
			CPG_DATABASE_LOG
		);
	}      
}

function cpg_format_bytes($bytes) {

	global $lang_byte_units, $lang_decimal_separator;
	
	foreach ($lang_byte_units as $unit) {

		if ($bytes < 1024) {
			break;
		}
				
		$bytes /= 1024;
	}
	
	return number_format($bytes, 2, $lang_decimal_separator[1], $lang_decimal_separator[0]) . ' ' . $unit;
}

?>

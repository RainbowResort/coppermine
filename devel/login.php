<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- // 

define('IN_COPPERMINE', true);
define('LOGIN_PHP', true);

require('include/init.inc.php');

if (USER_ID) cpg_die(ERROR, $lang_login_php['err_already_logged_in'], __FILE__, __LINE__);

if (defined('UDB_INTEGRATION')) udb_login_page();

$referer = $HTTP_GET_VARS['referer'] ? $HTTP_GET_VARS['referer'] : 'index.php';
$login_failed = '';
$cookie_warning = '';

if (isset($HTTP_POST_VARS['submitted'])) {
    $results = db_query("SELECT user_id, user_name, user_password FROM {$CONFIG['TABLE_USERS']} WHERE user_name = '" . addslashes($HTTP_POST_VARS['username']) . "' AND BINARY user_password = '" . addslashes($HTTP_POST_VARS['password']) . "' AND user_active = 'YES'");
    if (mysql_num_rows($results)) {
        $USER_DATA = mysql_fetch_array($results);
        if (isset($HTTP_POST_VARS['remember_me'])) {
            $cookie_life_time = 86400 * 30;
        } else {
            $cookie_life_time = 86400;
        } 
        setcookie($CONFIG['cookie_name'] . '_uid', $USER_DATA['user_id'], time() + $cookie_life_time, $CONFIG['cookie_path']);
        setcookie($CONFIG['cookie_name'] . '_pass', md5($HTTP_POST_VARS['password']), time() + $cookie_life_time, $CONFIG['cookie_path']);

        pageheader($lang_login_php['login'], "<META http-equiv=\"refresh\" content=\"3;url=$referer\">");
        msg_box($lang_login_php['login'], sprintf($lang_login_php['welcome'], $USER_DATA['user_name']), $lang_continue, $referer);
        pagefooter();
        exit;
    } else {
        $login_failed = <<<EOT
		  <tr>
		  	<td colspan="2" align="center" class="tableh2">
			<font size="1" color="red"><b>{$lang_login_php['err_login']}<b></font>
			</td>
		  </tr>

EOT;
    } 
} 

if (!isset($HTTP_COOKIE_VARS[$CONFIG['cookie_name'] . '_data'])) {
    $cookie_warning = <<<EOT
		  <tr>
		  	<td colspan="2" align="center" class="tableh2">
			<font size="1" color="red"><b>Warning your browser does not accept script's cookies<b></font>
			</td>
		  </tr>

EOT;
} 

pageheader($lang_login_php['login']);
$referer = urlencode($referer);
starttable('-1', $lang_login_php['enter_login_pswd'], 2);
echo <<< EOT
		  $login_failed
		  $cookie_warning
		  <tr>
		    <form action="login.php?referer=$referer" method="post">
			<td class="tableb" width="40%">{$lang_login_php['username']}</td>
			<td class="tableb" width="60%"><input type="text" class="textinput" name="username" style="width: 100%"></td>
		  </tr>
		  <tr>
		  	<td class="tableb">{$lang_login_php['password']}</td>
			<td class="tableb"><input type="password" class="textinput" name="password" style="width: 100%"></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" class="tableb">{$lang_login_php['remember_me']} <input name="remember_me" type="checkbox" class="checkbox" value="1"></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" class="tablef"><input name="submitted" type="submit" class="button" value="{$lang_login_php['login']}"></td>
		    </form>
		  </tr>

EOT;

endtable();
pagefooter();
ob_end_flush();

?>
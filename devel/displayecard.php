<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.4.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //
// $Id$
// ------------------------------------------------------------------------- //

define('IN_COPPERMINE', true);
define('DISPLAYECARD_PHP', true);

require('include/init.inc.php');
require('include/smilies.inc.php');

if (!isset($_GET['data'])) cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);

$data = array();
$data = @unserialize(@base64_decode($_GET['data']));

// attempt to obtain full link from db if ecard logging enabled and min 12 chars of data is provided and only 1 match
if ((!is_array($data)) && $CONFIG['log_ecards'] && (strlen($_GET['data']) > 12)) {
	$result = cpg_db_query("SELECT link FROM {$CONFIG['TABLE_ECARDS']} WHERE link LIKE '{$_GET['data']}%'");
	if (mysql_num_rows($result) === 1) {
		$row = mysql_fetch_assoc($result);
		$data = @unserialize(@base64_decode($row['link']));
	}
}

if (is_array($data)) {

// Remove HTML tags as we can't trust what we receive
foreach($data as $key => $value) $data[$key] = strtr($value, $HTML_SUBST);
// Load template parameters
$params = array('{LANG_DIR}' => $lang_text_dir,
    '{TITLE}' => sprintf($lang_ecard_php['ecard_title'], $data['sn']),
    '{CHARSET}' => $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset'],
    '{VIEW_ECARD_TGT}' => '',
    '{VIEW_ECARD_LNK}' => '',
    '{PIC_URL}' => $data['p'],
    '{URL_PREFIX}' => '',
    '{GREETINGS}' => $data['g'],
    '{MESSAGE}' => nl2br(process_smilies($data['m'])),
    '{SENDER_EMAIL}' => $data['se'],
    '{SENDER_NAME}' => $data['sn'],
    '{VIEW_MORE_TGT}' => $CONFIG['ecards_more_pic_target'],
    '{VIEW_MORE_LNK}' => $lang_ecard_php['view_more_pics'],
    );
// Parse template
echo template_eval($template_ecard, $params);

} else {
	cpg_die(CRITICAL_ERROR, $lang_displayecard_php['invalid_data'], __FILE__, __LINE__);
}
?>
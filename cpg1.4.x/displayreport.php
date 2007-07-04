<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.13
  $Source$
  $Revision$
  $Author$
  $Date$
**********************************************/

define('IN_COPPERMINE', true);
define('DISPLAYREPORT_PHP', true);

require('include/init.inc.php');
require('include/smilies.inc.php');

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

if (!isset($_GET['data'])) cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);

$data = array();
$data = @unserialize(@base64_decode($_GET['data']));

if (is_array($data)) {

// Remove HTML tags as we can't trust what we receive
//foreach($data as $key => $value) $data[$key] = strtr($value, $HTML_SUBST);
// Load template parameters
	if ($data['t'] == 'comment') {
		$params = array('{LANG_DIR}' => $lang_text_dir,
			'{TITLE}' => sprintf($lang_report_php['report_subject'], $data['sn'], $data['t']),
			'{CHARSET}' => $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset'],
			'{VIEW_REPORT_TGT}' => '',
			'{VIEW_REPORT_LNK}' => '',
			'{URL_PREFIX}' => '',
			'{SUBJECT}' => $data['su'],
			'{MESSAGE}' => nl2br(process_smilies($data['m'])),
			'{SENDER_EMAIL}' => $data['se'],
			'{SENDER_NAME}' => $data['sn'],
			'{VIEW_MORE_TGT}' => $CONFIG['ecards_more_pic_target'],
			'{VIEW_MORE_LNK}' => $lang_report_php['view_more_pics'],
			'{REASON}' => $data['r'],
			'{COMMENT}' => $data['c'],
			'{COMMENT_ID}' => $data['cid'],
			'{VIEW_COMMENT_LNK}' => $lang_report_php['view_comment'],
			'{COMMENT_LNK}' => $lang_report_php['go_comment'],
			'{COMMENT_TGT}' => "{$CONFIG['ecards_more_pic_target']}displayimage.php?pos=-" . $data['pid'] . "#comment" . $data['cid'],
			'{PID}' => $data['pid'],
			);
		// Parse template if report is on a comment
		echo template_eval($template_report_comment, $params);

	} else {
			$params = array('{LANG_DIR}' => $lang_text_dir,
				'{TITLE}' => sprintf($lang_report_php['report_subject'], $data['sn'], $data['t']),
				'{CHARSET}' => $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset'],
				'{VIEW_REPORT_TGT}' => '',
				'{VIEW_REPORT_LNK}' => '',
				'{PIC_URL}' => $data['p'],
				'{PIC_TGT}' => "{$CONFIG['ecards_more_pic_target']}displayimage.php?pos=-" . $data['pid'],
				'{URL_PREFIX}' => '',
				'{SUBJECT}' => $data['su'],
				'{MESSAGE}' => nl2br(process_smilies($data['m'])),
				'{SENDER_EMAIL}' => $data['se'],
				'{SENDER_NAME}' => $data['sn'],
				'{VIEW_MORE_TGT}' => $CONFIG['ecards_more_pic_target'],
				'{VIEW_MORE_LNK}' => $lang_report_php['view_more_pics'],
				'{REASON}' => $data['r'],
				'{PID}' => $data['pid'],
				);
			// Parse template
			echo template_eval($template_report, $params);
	}
} else {
        cpg_die(CRITICAL_ERROR, $lang_report_php['invalid_data'], __FILE__, __LINE__);
}
?>
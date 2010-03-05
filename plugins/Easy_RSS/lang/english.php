<?php
/**************************************************
  Coppermine 1.4 Plugin - Easy RSS
  *************************************************
  Copyright (c) 2007 Brent Gerig
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_easyrss = array(
  'label_title'   => 'Title',
  'label_caption' => 'Caption',
  'label_filename' => 'Filename',
  'last_additions'=> 'Last additions',
  'alt_rss_feed'  => 'RSS feed',
  'alt_google'    => 'Add to Google',
  'alt_yahoo'     => 'Add to My Yahoo!',
  'views'         => 'views',
  'no'            => 'No ',
);

$lang_plugin_easyrss_config = array(
  'question_title'=> 'Should we use the image title or the caption for the RSS feed title?',
  'question_num'  => 'Number of items to display in the feed: ',
  'question_show' => 'Which items should be displayed?',
  'show_meta'     => 'Add RSS meta link to head',
  'show_rss'      => 'Add direct RSS link to footer',
  'show_google'   => 'Add "Add to Google" button to footer',
  'show_yahoo'    => 'Add "Add to My Yahoo!" button to footer',
  'cleanup_question' => 'Remove rss.php and settings?',
  'cleanup_note'  => '** This will break any feed readers that use this RSS feed.',
  'button_install'=> 'Install',
  'button_cancel' => 'Cancel',
  'button_submit' => 'Uninstall',
  'yes'           => 'Yes',
  'no'            => 'No',
);
?>

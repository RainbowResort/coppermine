##  ********************************************
##  Coppermine Photo Gallery
##  ************************
##  Copyright (c) 2003-2007 Coppermine Dev Team
##  v0.1 originally written by Nitin Gupta
##
##  This program is free software; you can redistribute it and/or modify
##  it under the terms of the GNU General Public License as published by
##  the Free Software Foundation; either version 2 of the License, or
##  (at your option) any later version.
##  ********************************************
##  Coppermine version: 1.5.0
##  $HeadURL$
##  $Revision: 1 $
##  $LastChangedBy: xnitingupta $
##  $Date: 6:02 PM 6/2/2007 $
##  ********************************************

#
# Table structure for table `CPG_sessions`
#

CREATE TABLE IF NOT EXISTS CPG_sessions (
  session_id varchar(40) NOT NULL default '',
  user_id int(11) default '0',
  time int(11) default NULL,
  remember int(1) default '0',
  PRIMARY KEY (session_id)
) TYPE=MyISAM COMMENT='Used to store sessions';
# --------------------------------------------------------

#
# Table structure for table `CPG_albums`
#

CREATE TABLE CPG_albums (
  aid int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  description text NOT NULL,
  visibility int(11) NOT NULL default '0',
  uploads enum('YES','NO') NOT NULL default 'NO',
  comments enum('YES','NO') NOT NULL default 'YES',
  votes enum('YES','NO') NOT NULL default 'YES',
  pos int(11) NOT NULL default '0',
  category int(11) NOT NULL default '0',
  thumb int(11) NOT NULL default '0',
  keyword VARCHAR( 50 ),
  alb_password VARCHAR( 32 ),
  alb_password_hint TEXT,
  moderator_group INT NOT NULL default 0,
  alb_hits INT( 10 ) NOT NULL default 0,
  PRIMARY KEY  (aid),
  KEY alb_category (category)
) TYPE=MyISAM COMMENT='Used to store albums';
# --------------------------------------------------------

#
# Table structure for table `CPG_categories`
#

CREATE TABLE CPG_categories (
  cid int(11) NOT NULL auto_increment,
  owner_id int(11) NOT NULL default '0',
  name varchar(255) NOT NULL default '',
  description text NOT NULL,
  pos int(11) NOT NULL default '0',
  parent int(11) NOT NULL default '0',
  thumb int(11) NOT NULL default '0',
  PRIMARY KEY  (cid),
  KEY cat_parent (parent),
  KEY cat_pos (pos),
  KEY cat_owner_id (owner_id)
) TYPE=MyISAM COMMENT='Used to store categories';
# --------------------------------------------------------

#
# Table structure for table `CPG_comments`
#

CREATE TABLE CPG_comments (
  pid mediumint(10) NOT NULL default '0',
  msg_id mediumint(10) NOT NULL auto_increment,
  msg_author varchar(25) NOT NULL default '',
  msg_body text NOT NULL,
  msg_date datetime NOT NULL default '0000-00-00 00:00:00',
  msg_raw_ip tinytext,
  msg_hdr_ip tinytext,
  author_md5_id varchar(32) NOT NULL default '',
  author_id int(11) NOT NULL default '0',
  approval enum('YES','NO') NOT NULL default 'YES',
  PRIMARY KEY  (msg_id),
  KEY com_pic_id (pid)
) TYPE=MyISAM COMMENT='Used to store comments made on pics';
# --------------------------------------------------------

#
# Table structure for table `CPG_config`
#

CREATE TABLE CPG_config (
  name varchar(40) NOT NULL default '',
  value varchar(255) NOT NULL default '',
  PRIMARY KEY  (name)
) TYPE=MyISAM COMMENT='Used to store the configuration options';
# --------------------------------------------------------

#
# Table structure for table `CPG_pictures`
#

CREATE TABLE CPG_pictures (
  pid int(11) NOT NULL auto_increment,
  aid int(11) NOT NULL default '0',
  filepath varchar(255) NOT NULL default '',
  filename varchar(255) NOT NULL default '',
  filesize int(11) NOT NULL default '0',
  total_filesize int(11) NOT NULL default '0',
  pwidth smallint(6) NOT NULL default '0',
  pheight smallint(6) NOT NULL default '0',
  hits int(10) NOT NULL default '0',
  mtime datetime NOT NULL default '0000-00-00 00:00:00' ,
  ctime int(11) NOT NULL default '0',
  owner_id int(11) NOT NULL default '0',
  owner_name varchar(40) NOT NULL default '',
  pic_rating int(11) NOT NULL default '0',
  votes int(11) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  caption text NOT NULL,
  keywords varchar(255) NOT NULL default '',
  approved enum('YES','NO') NOT NULL default 'NO',
  galleryicon int(11) NOT NULL default '0',
  user1 varchar(255) NOT NULL default '',
  user2 varchar(255) NOT NULL default '',
  user3 varchar(255) NOT NULL default '',
  user4 varchar(255) NOT NULL default '',
  url_prefix tinyint(4) NOT NULL default '0',
#  randpos int(11) NOT NULL default '0',
  pic_raw_ip tinytext,
  pic_hdr_ip tinytext,
  lasthit_ip tinytext,
  PRIMARY KEY  (pid),
  KEY owner_id (owner_id),
  KEY pic_hits (hits),
  KEY pic_rate (pic_rating),
  KEY aid_approved (aid,approved),
#  KEY randpos (randpos),
  KEY pic_aid (aid),
  position INT(11) NOT NULL default '0',
  FULLTEXT KEY search (title,caption,keywords,filename)
) TYPE=MyISAM COMMENT='Used to store data about individual pics';
# --------------------------------------------------------

#
# Table structure for table `CPG_usergroups`
#

CREATE TABLE CPG_usergroups (
  group_id int(11) NOT NULL auto_increment,
  group_name varchar(255) NOT NULL default '',
  group_quota int(11) NOT NULL default '0',
  has_admin_access tinyint(4) NOT NULL default '0',
  can_rate_pictures tinyint(4) NOT NULL default '0',
  can_send_ecards tinyint(4) NOT NULL default '0',
  can_post_comments tinyint(4) NOT NULL default '0',
  can_upload_pictures tinyint(4) NOT NULL default '0',
  can_create_albums tinyint(4) NOT NULL default '0',
  pub_upl_need_approval tinyint(4) NOT NULL default '1',
  priv_upl_need_approval tinyint(4) NOT NULL default '1',
  upload_form_config tinyint(4) NOT NULL default '3',
  custom_user_upload tinyint(4) NOT NULL default '0',
  num_file_upload tinyint(4) NOT NULL default '5',
  num_URI_upload tinyint(4) NOT NULL default '3',
  PRIMARY KEY  (group_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `CPG_users`
#

CREATE TABLE CPG_users (
  user_id int(11) NOT NULL auto_increment,
  user_group int(11) NOT NULL default '2',
  user_active enum('YES','NO') NOT NULL default 'NO',
  user_name varchar(25) NOT NULL default '',
  user_password varchar(40) NOT NULL default '',
  user_lastvisit datetime NOT NULL default '0000-00-00 00:00:00',
  user_regdate datetime NOT NULL default '0000-00-00 00:00:00',
  user_group_list varchar(255) NOT NULL default '',
  user_email varchar(255) NOT NULL default '',
  user_profile1 varchar(255) NOT NULL default '',
  user_profile2 varchar(255) NOT NULL default '',
  user_profile3 varchar(255) NOT NULL default '',
  user_profile4 varchar(255) NOT NULL default '',
  user_profile5 varchar(255) NOT NULL default '',
  user_profile6 text NOT NULL,
  user_actkey varchar(32) NOT NULL default '',

  PRIMARY KEY  (user_id),
  UNIQUE KEY user_name (user_name)
) TYPE=MyISAM COMMENT='Used to store users, not used when bridged';
# --------------------------------------------------------

#
# Table structure for table `CPG_votes`
#

CREATE TABLE CPG_votes (
  pic_id mediumint(9) NOT NULL default '0',
  user_md5_id varchar(32) NOT NULL default '',
  vote_time int(11) NOT NULL default '0',
  PRIMARY KEY  (pic_id,user_md5_id)
) TYPE=MyISAM COMMENT='Stores votes for individual pics';
#---------------------------------------------------------

#
# Table structure for table `CPG_banned`
#

CREATE TABLE CPG_banned (
        ban_id int(11) NOT NULL auto_increment,
        user_id int(11) DEFAULT NULL,
        ip_addr tinytext,
        expiry datetime DEFAULT NULL,
        brute_force tinyint(5) NOT NULL default '0',
        PRIMARY KEY  (ban_id)
) TYPE=MyISAM COMMENT='Data about banned users';
#---------------------------------------------------------

#
# Table structure for table `CPG_exif`
#

CREATE TABLE CPG_exif (
  `filename` varchar(255) NOT NULL default '',
  `exifData` text NOT NULL,
  UNIQUE KEY `filename` (`filename`)
) TYPE=MyISAM COMMENT='Stores EXIF data from individual pics';
# --------------------------------------------------------

#
# Table structure for table `CPG_filetypes`
#

CREATE TABLE IF NOT EXISTS CPG_filetypes (
  extension char(7) NOT NULL default '',
  mime char(30) default NULL,
  content char(15) default NULL,
  player varchar(5) default NULL,
  PRIMARY KEY (extension)
) TYPE=MyISAM COMMENT='Used to store the file extensions';
# --------------------------------------------------------

#
# Table structure for table `CPG_ecards`
#

CREATE TABLE CPG_ecards (
  eid int(11) NOT NULL auto_increment,
  sender_name varchar(50) NOT NULL default '',
  sender_email text NOT NULL,
  recipient_name varchar(50) NOT NULL default '',
  recipient_email text NOT NULL,
  link text NOT NULL,
  date tinytext NOT NULL,
  sender_ip tinytext NOT NULL,
  PRIMARY KEY  (eid)
) TYPE=MyISAM COMMENT='Used to log ecards';
# --------------------------------------------------------

#
# Table structure for table `CPG_plugins`
#

CREATE TABLE CPG_plugins (
  plugin_id int(10) unsigned NOT NULL auto_increment,
  name varchar(64) NOT NULL default '',
  path varchar(128) NOT NULL default '',
  priority int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (plugin_id),
  UNIQUE KEY name (name),
  UNIQUE KEY path (path)
) TYPE=MyISAM COMMENT='Stores the plugins';
# --------------------------------------------------------

#
# Table structure for table `CPG_temp_data`
#

CREATE TABLE IF NOT EXISTS `CPG_temp_data` (
`unique_ID` CHAR( 8 ) NOT NULL ,
`encoded_string` BLOB NOT NULL ,
`timestamp` INT( 11 ) UNSIGNED NOT NULL ,
PRIMARY KEY ( `unique_ID` )
) TYPE = MyISAM COMMENT = 'Holds temporary file data for multiple file uploads';

#
# Table structure for table `CPG_favpics`
#

CREATE TABLE `CPG_favpics` (
`user_id` INT( 11 ) NOT NULL ,
`user_favpics` TEXT NOT NULL ,
PRIMARY KEY ( `user_id` )
) TYPE = MyISAM COMMENT = 'Stores the server side favourites';
# --------------------------------------------------------

#
# Table structure for table `CPG_dict`
#
CREATE TABLE CPG_dict (
  keyId bigint(20) NOT NULL auto_increment,
  keyword varchar(60) NOT NULL default '',
  PRIMARY KEY  (keyId)
) TYPE=MyISAM COMMENT = 'Holds the keyword dictionary';
# --------------------------------------------------------

#
# Table structure for table `CPG_bridge`
#

CREATE TABLE CPG_bridge (
  name varchar(40) NOT NULL default '0',
  value varchar(255) NOT NULL default '',
  UNIQUE KEY name (name)
) TYPE=MyISAM COMMENT='Stores the bridging data, not used when unbridged';
# --------------------------------------------------------

#
# Table structure for table `CPG_vote_stats`
#
CREATE TABLE `CPG_vote_stats` (
  `sid` int(11) NOT NULL auto_increment,
  `pid` varchar(100) NOT NULL default '',
  `rating` smallint(6) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `sdate` bigint(20) NOT NULL default '0',
  `referer` text NOT NULL,
  `browser` varchar(255) NOT NULL default '',
  `os` varchar(50) NOT NULL default '',
  `uid` INT(11) NOT NULL default '0',
  PRIMARY KEY  (`sid`)
) TYPE=MyISAM COMMENT='Detailed stats about votes, only used when enabled';
# --------------------------------------------------------

CREATE TABLE `CPG_hit_stats` (
  `sid` int(11) NOT NULL auto_increment,
  `pid` varchar(100) NOT NULL default '',
  `ip` varchar(20) NOT NULL default '',
  `search_phrase` varchar(255) NOT NULL default '',
  `sdate` bigint(20) NOT NULL default '0',
  `referer` text NOT NULL,
  `browser` varchar(255) NOT NULL default '',
  `os` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`sid`)
) TYPE = MyISAM COMMENT='Detailed stats about hits, only used when enabled';
# --------------------------------------------------------

CREATE TABLE IF NOT EXISTS CPG_temp_messages (
  message_id varchar(80) NOT NULL default '',
  user_id int(11) default '0',
  time int(11) default NULL,
  message text NOT NULL default '',
  PRIMARY KEY (message_id)
) TYPE=MyISAM COMMENT='Used to store messages from one page to the other';
# --------------------------------------------------------

#
# Dumping data for table `CPG_config`
#

INSERT INTO CPG_config VALUES ('enable_api', '1');
INSERT INTO CPG_config VALUES ('site_url', '');
INSERT INTO CPG_config VALUES ('allow_get_api', '1');
INSERT INTO CPG_config VALUES ('albums_per_page', '12');
INSERT INTO CPG_config VALUES ('album_list_cols', '2');
INSERT INTO CPG_config VALUES ('display_pic_info', '0');
INSERT INTO CPG_config VALUES ('alb_list_thumb_size', '50');
INSERT INTO CPG_config VALUES ('allowed_mov_types', 'ALL');
INSERT INTO CPG_config VALUES ('allowed_doc_types', 'doc/txt/rtf/pdf/xls/pps/ppt/zip/gz/mdb');
INSERT INTO CPG_config VALUES ('allowed_snd_types', 'mp3/midi/mid/wma/wav/ogg');
INSERT INTO CPG_config VALUES ('allowed_img_types', 'ALL');
INSERT INTO CPG_config VALUES ('allow_private_albums', '1');
INSERT INTO CPG_config VALUES ('allow_user_registration', '0');
INSERT INTO CPG_config VALUES ('user_registration_disclaimer', '1');
INSERT INTO CPG_config VALUES ('allow_unlogged_access', '1');
INSERT INTO CPG_config VALUES ('allow_duplicate_emails_addr', '0');
INSERT INTO CPG_config VALUES ('caption_in_thumbview', '1');
INSERT INTO CPG_config VALUES ('views_in_thumbview', '1');
INSERT INTO CPG_config VALUES ('charset', 'utf-8');
INSERT INTO CPG_config VALUES ('cookie_name', 'cpg150');
INSERT INTO CPG_config VALUES ('cookie_path', '/');
INSERT INTO CPG_config VALUES ('debug_mode', '0');
INSERT INTO CPG_config VALUES ('debug_notice', '0');
INSERT INTO CPG_config VALUES ('default_dir_mode', '0755');
INSERT INTO CPG_config VALUES ('default_file_mode', '0644');
INSERT INTO CPG_config VALUES ('default_sort_order', 'na');
INSERT INTO CPG_config VALUES ('ecards_more_pic_target', 'http://change-this-to-your-gallery-url.tld/');
INSERT INTO CPG_config VALUES ('home_target', 'index.php');
INSERT INTO CPG_config VALUES ('custom_lnk_name', '');
INSERT INTO CPG_config VALUES ('custom_lnk_url', '');
INSERT INTO CPG_config VALUES ('enable_smilies', '1');
INSERT INTO CPG_config VALUES ('filter_bad_words', '0');
INSERT INTO CPG_config VALUES ('forbiden_fname_char', '$/\\\\:*?&quot;\'&lt;&gt;|` &amp;#');
INSERT INTO CPG_config VALUES ('fullpath', 'albums/');
INSERT INTO CPG_config VALUES ('gallery_admin_email', 'you@somewhere.com');
INSERT INTO CPG_config VALUES ('gallery_description', 'Your online photo album');
INSERT INTO CPG_config VALUES ('gallery_name', 'Coppermine Photo Gallery');
INSERT INTO CPG_config VALUES ('im_options', '-antialias');
INSERT INTO CPG_config VALUES ('impath', '');
INSERT INTO CPG_config VALUES ('jpeg_qual', '80');
INSERT INTO CPG_config VALUES ('keep_votes_time', '30');
INSERT INTO CPG_config VALUES ('lang', 'english');
INSERT INTO CPG_config VALUES ('main_page_layout', 'breadcrumb/catlist/alblist/random,2/lastup,2');
INSERT INTO CPG_config VALUES ('main_table_width', '100%');
INSERT INTO CPG_config VALUES ('make_intermediate', '1');
INSERT INTO CPG_config VALUES ('max_com_lines', '10');
INSERT INTO CPG_config VALUES ('max_com_size', '512');
INSERT INTO CPG_config VALUES ('max_com_wlength', '38');
INSERT INTO CPG_config VALUES ('max_img_desc_length', '512');
INSERT INTO CPG_config VALUES ('max_tabs', '12');
INSERT INTO CPG_config VALUES ('max_upl_size', '1024');
INSERT INTO CPG_config VALUES ('max_upl_width_height', '2048');
INSERT INTO CPG_config VALUES ('auto_resize', '0');
INSERT INTO CPG_config VALUES ('min_votes_for_rating', '1');
INSERT INTO CPG_config VALUES ('normal_pfx', 'normal_');
INSERT INTO CPG_config VALUES ('offline', '0');
INSERT INTO CPG_config VALUES ('picture_table_width', '600');
INSERT INTO CPG_config VALUES ('picture_width', '400');
# INSERT INTO CPG_config VALUES ('randpos_interval', '1063623637');
INSERT INTO CPG_config VALUES ('read_exif_data', '0');
INSERT INTO CPG_config VALUES ('reg_requires_valid_email', '1');
INSERT INTO CPG_config VALUES ('subcat_level', '2');
INSERT INTO CPG_config VALUES ('theme', 'core');
INSERT INTO CPG_config VALUES ('thumbcols', '4');
INSERT INTO CPG_config VALUES ('thumbrows', '3');
INSERT INTO CPG_config VALUES ('thumb_method', 'im');
INSERT INTO CPG_config VALUES ('thumb_pfx', 'thumb_');
INSERT INTO CPG_config VALUES ('thumb_width', '100');
INSERT INTO CPG_config VALUES ('userpics', 'userpics/');
INSERT INTO CPG_config VALUES ('vanity_block','1');
INSERT INTO CPG_config VALUES ('user_profile1_name', 'Location');
INSERT INTO CPG_config VALUES ('user_profile2_name', 'Interests');
INSERT INTO CPG_config VALUES ('user_profile3_name', 'Website');
INSERT INTO CPG_config VALUES ('user_profile4_name', 'Occupation');
INSERT INTO CPG_config VALUES ('user_profile5_name', '');
INSERT INTO CPG_config VALUES ('user_profile6_name', 'Biography');
INSERT INTO CPG_config VALUES ('user_field1_name', '');
INSERT INTO CPG_config VALUES ('user_field2_name', '');
INSERT INTO CPG_config VALUES ('user_field3_name', '');
INSERT INTO CPG_config VALUES ('user_field4_name', '');
INSERT INTO CPG_config VALUES ('display_comment_count', '0');
INSERT INTO CPG_config VALUES ('show_private', '0');
INSERT INTO CPG_config VALUES ('first_level', '1');
INSERT INTO CPG_config VALUES ('display_film_strip', '1');
INSERT INTO CPG_config VALUES ('display_film_strip_filename', '0');
INSERT INTO CPG_config VALUES ('max_film_strip_items', '5');
INSERT INTO CPG_config VALUES ('thumb_use', 'any');
#INSERT INTO CPG_config VALUES ('comment_email_notification', '0');
INSERT INTO CPG_config VALUES ('read_iptc_data', '0');
INSERT INTO CPG_config VALUES ('reg_notify_admin_email', '0');
INSERT INTO CPG_config VALUES ('disable_comment_flood_protect', '0');
INSERT INTO CPG_config VALUES ('upl_notify_admin_email', '0');
INSERT INTO CPG_config VALUES ('display_uploader', '0');
# INSERT INTO CPG_config VALUES ('display_admin_uploader','0');
INSERT INTO CPG_config VALUES ('display_filename','0');
INSERT INTO CPG_config VALUES ('language_list', '0');
INSERT INTO CPG_config VALUES ('language_flags', '0');
INSERT INTO CPG_config VALUES ('theme_list', '0');
INSERT INTO CPG_config VALUES ('language_reset', '1');
INSERT INTO CPG_config VALUES ('theme_reset', '1');
INSERT INTO CPG_config VALUES ('allow_memberlist', '0');
INSERT INTO CPG_config VALUES ('display_faq', '0');
INSERT INTO CPG_config VALUES ('show_bbcode_help', '1');
INSERT INTO CPG_config VALUES ('log_ecards', '0');
INSERT INTO CPG_config VALUES ('email_comment_notification', '0');
INSERT INTO CPG_config VALUES ('enable_zipdownload', '1');
INSERT INTO CPG_config VALUES ('slideshow_interval', '5000');
INSERT INTO CPG_config VALUES ('log_mode', '0');
INSERT INTO CPG_config VALUES ('media_autostart', '1');
INSERT INTO CPG_config VALUES ('enable_encrypted_passwords','1');
INSERT INTO CPG_config VALUES ('time_offset', '0');
INSERT INTO CPG_config VALUES ('ban_private_ip', '0');
INSERT INTO CPG_config VALUES ('smtp_host', '');
INSERT INTO CPG_config VALUES ('smtp_username', '');
INSERT INTO CPG_config VALUES ('smtp_password', '');
INSERT INTO CPG_config VALUES ('enable_plugins', '1');
INSERT INTO CPG_config VALUES ('enable_help', '2');
INSERT INTO CPG_config VALUES ('categories_alpha_sort', '0');
INSERT INTO CPG_config VALUES ('login_threshold', '5');
INSERT INTO CPG_config VALUES ('login_expiry', '10');
INSERT INTO CPG_config VALUES ('allow_email_change', '0');
INSERT INTO CPG_config VALUES ('clickable_keyword_search', '1');
INSERT INTO CPG_config VALUES ('users_can_edit_pics', '0');
INSERT INTO CPG_config VALUES ('language_fallback', '1');
INSERT INTO CPG_config VALUES ('vote_details', '0');
INSERT INTO CPG_config VALUES ('hit_details', '0');
INSERT INTO CPG_config VALUES ('browse_batch_add', '1');
INSERT INTO CPG_config VALUES ('custom_header_path', '');
INSERT INTO CPG_config VALUES ('custom_footer_path', '');
INSERT INTO CPG_config VALUES ('comments_sort_descending', '0');
INSERT INTO CPG_config VALUES ('report_post', '0');
INSERT INTO CPG_config VALUES ('comments_anon_pfx', 'Guest_');
INSERT INTO CPG_config VALUES ('admin_activation', '0');
INSERT INTO CPG_config VALUES ('display_thumbnail_rating', '0');
INSERT INTO CPG_config VALUES ('thumbnail_to_fullsize', '0');
INSERT INTO CPG_config VALUES ('global_registration_pw','');
INSERT INTO CPG_config VALUES ('silly_safe_mode', '0');
###### watermark ########
INSERT INTO CPG_config (name, value) values ('enable_watermark', '0');
INSERT INTO CPG_config (name, value) values ('where_put_watermark', 'southeast');
INSERT INTO CPG_config (name, value) values ('watermark_file', 'images/watermark.png');
INSERT INTO CPG_config (name, value) values ('which_files_to_watermark', 'both');
INSERT INTO CPG_config (name, value) values ('orig_pfx', 'orig_');
INSERT INTO CPG_config (name, value) values ('watermark_transparency', '40');
INSERT INTO CPG_config (name, value) values ('reduce_watermark', '0');
INSERT INTO CPG_config (name, value) values ('watermark_transparency_featherx', '0');
INSERT INTO CPG_config (name, value) values ('watermark_transparency_feathery', '0');
INSERT INTO CPG_config (name, value) values ('enable_thumb_watermark', '1');
####################

###### thumb sharpening and cropping ########
INSERT INTO CPG_config (name, value) values ('enable_unsharp', '0');
INSERT INTO CPG_config (name, value) values ('unsharp_amount', '120');
INSERT INTO CPG_config (name, value) values ('unsharp_radius', '0.5');
INSERT INTO CPG_config (name, value) values ('unsharp_threshold', '3');
INSERT INTO CPG_config (name, value) values ('thumb_height', '140');
#########################

#movie download link -> to picinfo
INSERT INTO CPG_config VALUES ('picinfo_movie_download_link', '1');
#########################

#
# Dumping data for table `CPG_filetypes`
#

INSERT INTO CPG_filetypes VALUES ('jpg', 'image/jpg', 'image', '');
INSERT INTO CPG_filetypes VALUES ('jpeg', 'image/jpeg', 'image', '');
INSERT INTO CPG_filetypes VALUES ('jpe', 'image/jpe', 'image', '');
INSERT INTO CPG_filetypes VALUES ('gif', 'image/gif', 'image', '');
INSERT INTO CPG_filetypes VALUES ('png', 'image/png', 'image', '');
INSERT INTO CPG_filetypes VALUES ('bmp', 'image/bmp', 'image', '');
INSERT INTO CPG_filetypes VALUES ('jpc', 'image/jpc', 'image', '');
INSERT INTO CPG_filetypes VALUES ('jp2', 'image/jp2', 'image', '');
INSERT INTO CPG_filetypes VALUES ('jpx', 'image/jpx', 'image', '');
INSERT INTO CPG_filetypes VALUES ('jb2', 'image/jb2', 'image', '');
INSERT INTO CPG_filetypes VALUES ('swc', 'image/swc', 'image', '');
INSERT INTO CPG_filetypes VALUES ('iff', 'image/iff', 'image', '');
INSERT INTO CPG_filetypes VALUES ('psd', 'image/psd', 'image', '');

INSERT INTO CPG_filetypes VALUES ('asf', 'video/x-ms-asf', 'movie', 'WMP');
INSERT INTO CPG_filetypes VALUES ('asx', 'video/x-ms-asx', 'movie', 'WMP');
INSERT INTO CPG_filetypes VALUES ('mpg', 'video/mpeg', 'movie', 'WMP');
INSERT INTO CPG_filetypes VALUES ('mpeg', 'video/mpeg', 'movie', 'WMP');
INSERT INTO CPG_filetypes VALUES ('wmv', 'video/x-ms-wmv', 'movie', 'WMP');
INSERT INTO CPG_filetypes VALUES ('swf', 'application/x-shockwave-flash', 'movie', 'SWF');
INSERT INTO CPG_filetypes VALUES ('avi', 'video/avi', 'movie', 'WMP');
INSERT INTO CPG_filetypes VALUES ('mov', 'video/quicktime', 'movie', 'QT');

INSERT INTO CPG_filetypes VALUES ('mp3', 'audio/mpeg3', 'audio', 'WMP');
INSERT INTO CPG_filetypes VALUES ('midi', 'audio/midi', 'audio', 'WMP');
INSERT INTO CPG_filetypes VALUES ('mid', 'audio/midi', 'audio', 'WMP');
INSERT INTO CPG_filetypes VALUES ('wma', 'audio/x-ms-wma', 'audio', 'WMP');
INSERT INTO CPG_filetypes VALUES ('wav', 'audio/wav', 'audio', 'WMP');
INSERT INTO CPG_filetypes VALUES ('ogg', 'audio/ogg', 'audio', '');

INSERT INTO CPG_filetypes VALUES ('ram', 'audio/x-pn-realaudio', 'document', 'RMP');
INSERT INTO CPG_filetypes VALUES ('ra', 'audio/x-realaudio', 'document', 'RMP');
INSERT INTO CPG_filetypes VALUES ('rm', 'audio/x-realmedia', 'document', 'RMP');
INSERT INTO CPG_filetypes VALUES ('tiff', 'image/tiff', 'document', '');
INSERT INTO CPG_filetypes VALUES ('tif', 'image/tif', 'document', '');
INSERT INTO CPG_filetypes VALUES ('doc', 'application/msword', 'document', '');
INSERT INTO CPG_filetypes VALUES ('xls', 'application/excel', 'document', '');
INSERT INTO CPG_filetypes VALUES ('pps', 'application/powerpoint', 'document', '');
INSERT INTO CPG_filetypes VALUES ('ppt', 'application/powerpoint', 'document', '');
INSERT INTO CPG_filetypes VALUES ('mdb', 'application/msaccess', 'document', '');
INSERT INTO CPG_filetypes VALUES ('txt', 'text/plain', 'document', '');
INSERT INTO CPG_filetypes VALUES ('rtf', 'text/richtext', 'document', '');
INSERT INTO CPG_filetypes VALUES ('pdf', 'application/pdf', 'document', '');
INSERT INTO CPG_filetypes VALUES ('zip', 'application/zip', 'document', '');
INSERT INTO CPG_filetypes VALUES ('rar', 'application/rar', 'document', '');
INSERT INTO CPG_filetypes VALUES ('gz', 'application/gz', 'document', '');
INSERT INTO CPG_filetypes VALUES ('001', 'application/001', 'document', '');
INSERT INTO CPG_filetypes VALUES ('7z', 'application/7z', 'document', '');
INSERT INTO CPG_filetypes VALUES ('arj', 'application/arj', 'document', '');
INSERT INTO CPG_filetypes VALUES ('bz2', 'application/bz2', 'document', '');
INSERT INTO CPG_filetypes VALUES ('cab', 'application/cab', 'document', '');
INSERT INTO CPG_filetypes VALUES ('lzh', 'application/lzh', 'document', '');
INSERT INTO CPG_filetypes VALUES ('rpm', 'application/rpm', 'document', '');
INSERT INTO CPG_filetypes VALUES ('tar', 'application/tar', 'document', '');
INSERT INTO CPG_filetypes VALUES ('z', 'application/z', 'document', '');
INSERT INTO CPG_filetypes VALUES ('odt', 'application/vnd.oasis.opendocument.text', 'document', '');
INSERT INTO CPG_filetypes VALUES ('ods', 'application/vnd.oasis.opendocument.spreadsheet', 'document', '');
INSERT INTO CPG_filetypes VALUES ('odp', 'application/vnd.oasis.opendocument.presentation', 'document', '');
INSERT INTO CPG_filetypes VALUES ('odg', 'application/vnd.oasis.opendocument.graphics', 'document', '');
INSERT INTO CPG_filetypes VALUES ('odc', 'application/vnd.oasis.opendocument.chart', 'document', '');
INSERT INTO CPG_filetypes VALUES ('odf', 'application/vnd.oasis.opendocument.formula', 'document', '');
INSERT INTO CPG_filetypes VALUES ('odi', 'application/vnd.oasis.opendocument.image', 'document', '');
INSERT INTO CPG_filetypes VALUES ('odm', 'application/vnd.oasis.opendocument.text-master', 'document', '');
INSERT INTO CPG_filetypes VALUES ('ott', 'application/vnd.oasis.opendocument.text-template', 'document', '');
INSERT INTO CPG_filetypes VALUES ('ots', 'application/vnd.oasis.opendocument.spreadsheet-template', 'document', '');
INSERT INTO CPG_filetypes VALUES ('otp', 'application/vnd.oasis.opendocument.presentation-template', 'document', '');
INSERT INTO CPG_filetypes VALUES ('otg', 'application/vnd.oasis.opendocument.graphics-template', 'document', '');
INSERT INTO CPG_filetypes VALUES ('otc', 'application/vnd.oasis.opendocument.chart-template', 'document', '');
INSERT INTO CPG_filetypes VALUES ('otf', 'application/vnd.oasis.opendocument.formula-template', 'document', '');
INSERT INTO CPG_filetypes VALUES ('oti', 'application/vnd.oasis.opendocument.image-template', 'document', '');
INSERT INTO CPG_filetypes VALUES ('oth', 'application/vnd.oasis.opendocument.text-web', 'document', '');


#
# Dumping data for table `CPG_usergroups`
#

INSERT INTO CPG_usergroups VALUES (1, 'Administrators', 0, 1, 1, 1, 1, 1, 1, 0, 0, 3, 0, 5, 3);
INSERT INTO CPG_usergroups VALUES (2, 'Registered', 1024, 0, 1, 1, 1, 1, 1, 1, 0, 3, 0, 5, 3);
INSERT INTO CPG_usergroups VALUES (3, 'Anonymous', 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 5, 3);
INSERT INTO CPG_usergroups VALUES (4, 'Banned', 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 5, 3);

#
# Dumping data for table `CPG_categories`
#

INSERT INTO CPG_categories (cid, name, description) VALUES (1, 'User galleries', 'This category contains albums that belong to Coppermine users.');

INSERT INTO CPG_config VALUES ('show_which_exif', '|0|0|0|0|0|0|0|0|1|0|1|1|0|0|0|0|0|0|0|0|0|0|0|1|0|0|0|1|0|0|0|1|1|0|0|0|0|1|0|0|0|1|0|0|1|1|0|0|0|0|0|1|0|1|1');
INSERT INTO CPG_config VALUES ('alb_desc_thumb', '1');
INSERT INTO CPG_config VALUES ('link_pic_count', '0');

INSERT INTO CPG_config VALUES ('bridge_enable', '0');

#
# Data for table `CPG_bridge`
# Used for bridging by user interface
#

INSERT INTO CPG_bridge VALUES ('short_name', '');
INSERT INTO CPG_bridge VALUES ('license_number', '');
INSERT INTO CPG_bridge VALUES ('db_database_name', '');
INSERT INTO CPG_bridge VALUES ('db_hostname', '');
INSERT INTO CPG_bridge VALUES ('db_username', '');
INSERT INTO CPG_bridge VALUES ('db_password', '');
INSERT INTO CPG_bridge VALUES ('full_forum_url', '');
INSERT INTO CPG_bridge VALUES ('relative_path_of_forum_from_webroot', '');
INSERT INTO CPG_bridge VALUES ('relative_path_to_config_file', '');
INSERT INTO CPG_bridge VALUES ('logout_flag', '');
INSERT INTO CPG_bridge VALUES ('use_post_based_groups', '');
INSERT INTO CPG_bridge VALUES ('cookie_prefix', '');
INSERT INTO CPG_bridge VALUES ('table_prefix', '');
INSERT INTO CPG_bridge VALUES ('user_table', '');
INSERT INTO CPG_bridge VALUES ('session_table', '');
INSERT INTO CPG_bridge VALUES ('group_table', '');
INSERT INTO CPG_bridge VALUES ('group_relation_table', '');
INSERT INTO CPG_bridge VALUES ('group_mapping_table', '');
INSERT INTO CPG_bridge VALUES ('use_standard_groups', '1');
INSERT INTO CPG_bridge VALUES ('validating_group', '');
INSERT INTO CPG_bridge VALUES ('guest_group', '');
INSERT INTO CPG_bridge VALUES ('member_group', '');
INSERT INTO CPG_bridge VALUES ('admin_group', '');
INSERT INTO CPG_bridge VALUES ('banned_group', '');
INSERT INTO CPG_bridge VALUES ('global_moderators_group', '');
INSERT INTO CPG_bridge VALUES ('recovery_logon_failures', '0');
INSERT INTO CPG_bridge VALUES ('recovery_logon_timestamp', '');

# Comment approval
INSERT INTO CPG_config VALUES ('comment_approval', '0');
INSERT INTO CPG_config VALUES ('display_comment_approval_only', '0');
INSERT INTO CPG_config VALUES ('comment_placeholder', '1');
INSERT INTO CPG_config VALUES ('comment_user_edit', '1');
INSERT INTO CPG_config VALUES ('comment_captcha', '1');

# Registration captcha
INSERT INTO CPG_config VALUES ('registration_captcha', '0');

# Flash in ecards
INSERT INTO CPG_config VALUES ('ecard_flash', '0');

# Create user album in personal gallery on registration
INSERT INTO CPG_config VALUES ('personal_album_on_registration', '0');

# Count hits in slideshow
INSERT INTO CPG_config VALUES ('slideshow_hits', '1');

# Display transparent overlay on images
INSERT INTO CPG_config VALUES ('transparent_overlay', '0');

# Ask guests to log in to post comments
INSERT INTO CPG_config VALUES ('comment_promote_registration', '0');

# Allow users to delete their own user account
INSERT INTO CPG_config VALUES ('allow_user_account_delete', '0');

# Display statistics on index page
INSERT INTO CPG_config VALUES ('display_stats_on_index', '1');

# Enable "browse by date" meta album
INSERT INTO CPG_config VALUES ('browse_by_date', '0');

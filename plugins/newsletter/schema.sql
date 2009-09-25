INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_guest_subscriptions', '0');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_salutation_for_guests', 'Dear subscriber,');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_from_email', 'ADMIN_EMAIL');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_from_name', 'ADMIN_USERNAME');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_mails_per_page', '1');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_page_refresh_delay', '10');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_admin_menu_links', '1');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_visitor_menu_links', '2');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_retries', '2');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_newsletter_default_on_register', '0');


CREATE TABLE IF NOT EXISTS `CPG_plugin_newsletter_subscriptions` (
  subscriber_id int(11) NOT NULL auto_increment,
  user_id int(11) default NULL,
  subscriber_active enum('YES','NO') NOT NULL default 'NO',
  subscriber_name varchar(25) NOT NULL default '',
  subscriber_password varchar(40) NOT NULL default '',
  subscriber_regdate int(11) NOT NULL default '0',
  subscriber_email varchar(255) NOT NULL default '',
  subscriber_actkey varchar(32) NOT NULL default '',
  category_list varchar(255) NOT NULL default '',
  PRIMARY KEY  (subscriber_id),
  UNIQUE KEY subscriber_name (subscriber_name),
  UNIQUE KEY user_id (user_id),
  UNIQUE KEY subscriber_email (subscriber_email)
) TYPE=MyISAM COMMENT='Contains the subscribers of the newsletters';

CREATE TABLE IF NOT EXISTS `CPG_plugin_newsletter_categories` (
  category_id int(11) NOT NULL auto_increment,
  name varchar(25) NOT NULL default '',
  description text NOT NULL,
  open_for_subscription enum('YES','NO') NOT NULL default 'NO',
  public_view enum('YES','NO') NOT NULL default 'NO',
  frequency_year INT( 10 ) NOT NULL default 360,
  PRIMARY KEY  (category_id)
) TYPE=MyISAM COMMENT='Contains the categories of newsletters';

INSERT IGNORE INTO CPG_plugin_newsletter_categories ( `category_id`, `name` , `open_for_subscription`, `public_view`, `frequency_year` ) VALUES ('1', 'COPPERMINE_SITE_NAME', 'YES', 'YES', '360');

CREATE TABLE IF NOT EXISTS `CPG_plugin_newsletter_mailings` (
  mailing_id int(11) NOT NULL auto_increment,
  subject varchar(100) NOT NULL default '',
  salutation varchar(100) NOT NULL default '',
  body text NOT NULL,
  date_sent int(11) NOT NULL default '0',
  category_id int(11) NOT NULL,
  completed int(11) NOT NULL,
  recipients int(11) NOT NULL,
  PRIMARY KEY  (mailing_id)
) TYPE=MyISAM COMMENT='Contains the individual mails sent by the newsletter plugin';

CREATE TABLE IF NOT EXISTS `CPG_plugin_newsletter_queue` (
  queue_id int(11) NOT NULL auto_increment,
  mailing_id int(11) NOT NULL,
  subscriber_id int(11) NOT NULL,
  time int(11) default NULL,
  attempts int(11) NOT NULL default '0',
  PRIMARY KEY  (queue_id)
) TYPE=MyISAM COMMENT='Temporary table that contains the records scheduled for sending';
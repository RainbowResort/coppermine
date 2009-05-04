INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_maxrotation', '15');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_bgcolor', '#EFEFEF');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_borderwidth', '10');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_bordercolor', '#FFFFFF');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_delete_cache', '1');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_thumb_pfx', 'rotate_');

CREATE TABLE IF NOT EXISTS `CPG_plugin_thumb_rotate` (
  `pid` mediumint(10) NOT NULL default '0',
  `filepath` varchar(255) NOT NULL default ''
) TYPE=MyISAM COMMENT='Contains the rotated thumbnail cache settings';
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_maxrotation', '15');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_bgcolor', '#EFEFEF');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_borderwidth', '10');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_bordercolor', '#FFFFFF');
INSERT IGNORE INTO CPG_config ( `name` , `value` ) VALUES ('plugin_thumb_rotate_delete_cache', '1');
CREATE TABLE IF NOT EXISTS `CPG_plugin_thumb_rotate` (
  `orig` varchar(127) default '',
  `modified` varchar(127) default '',
  `width` int(2) NOT NULL default '0',
  `height` int(2) NOT NULL default '0',
  `pid` int(2) NOT NULL default '0'
);
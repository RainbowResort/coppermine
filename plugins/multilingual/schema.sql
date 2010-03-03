CREATE TABLE IF NOT EXISTS `CPG_lang_strings` (
  `id` int(11) NOT NULL auto_increment,
  `original` text NOT NULL,
  `translated` text NOT NULL,
  `lang` text NOT NULL,
  `type` enum('catName','catDesc','albName','albDesc','picTitle','picDesc') NOT NULL,
  `origId` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);
DROP TABLE IF EXISTS `phpcms_shenjian_setting`;
CREATE TABLE IF NOT EXISTS `phpcms_shenjian_setting` (
  `siteid` smallint(5) NOT NULL default '0',
  `web_password` varchar(256) default 'shenjianshou.cn',
  `image_refer` tinyint(1) default '0',
  PRIMARY KEY  (`siteid`)
) TYPE=MyISAM;
INSERT INTO `phpcms_shenjian_setting` (`siteid`, `web_password`, `image_refer`) VALUES (1, "shenjianshou.cn", 0);

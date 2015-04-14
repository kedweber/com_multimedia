-- ----------------------------
--  Table structure for `#__multimedia_sources`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__multimedia_sources` (
  `multimedia_source_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `resource_id` varchar(255) NOT NULL,
  `adapter` varchar(255) NOT NULL,
  PRIMARY KEY (`multimedia_source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `#__multimedia_videos`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__multimedia_videos` (
  `multimedia_video_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` varchar(20) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'video',
  `source` varchar(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` text NOT NULL COMMENT '@Filter("raw")',
  `publish_up` date NOT NULL DEFAULT '0000-00-00',
  `publish_down` date NOT NULL DEFAULT '0000-00-00',
  `ordering` bigint(20) unsigned NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`multimedia_video_id`),
  UNIQUE KEY `unique` (`resource_id`,`source`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

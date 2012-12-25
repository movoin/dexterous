-- Dexterous
-- version 0.1.0
-- http://www.movoin.com
--
-- created: 2012/12/19
--


--
-- 栏目管理表 `dex_columns`
--

CREATE TABLE IF NOT EXISTS `dex_columns` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '栏目编号',
    `site` char(10) NOT NULL DEFAULT '' COMMENT '站点标识',
    `identifier` char(50) NOT NULL DEFAULT '' COMMENT '栏目识别符',
    `parent` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父栏目编号',
    `module` char(50) NOT NULL DEFAULT 0 COMMENT '模块编号',
    `position` int(11) UNSIGNED NOT NULL DEFAULT 1 COMMENT '栏目位置',
    `name` char(100) NOT NULL DEFAULT '' COMMENT '栏目名称',
    `route` char(50) NOT NULL DEFAULT '' COMMENT '路由',
    PRIMARY KEY (`id`),
    KEY `idx_site_identifier_position` (`site`,`identifier`,`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='栏目管理表' AUTO_INCREMENT=1;


--
-- 站点配置表 `dex_options`
--

CREATE TABLE IF NOT EXISTS `dex_options` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置编号',
    `site` char(10) NOT NULL DEFAULT '' COMMENT '站点标识',
    `scope` char(50) NOT NULL DEFAULT '' COMMENT '范围',
    `name` char(30) NOT NULL DEFAULT '' COMMENT '配置名',
    `value` char(255) NOT NULL DEFAULT '' COMMENT '配置内容',
    `decode` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否需要解析',
    PRIMARY KEY (`id`),
    KEY `idx_site_scope_name` (`site`,`scope`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='站点配置表' AUTO_INCREMENT=1;

--
-- 模块管理表 `dex_modules`
--

CREATE TABLE IF NOT EXISTS `dex_modules` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '模块编号',
    `site` char(10) NOT NULL DEFAULT '' COMMENT '站点标识',
    `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '激活状态',
    `identifier` char(50) NOT NULL DEFAULT '' COMMENT '模块识别符',
    `name` char(50) NOT NULL DEFAULT '' COMMENT '模块名称',
    `shortName` char(20) NOT NULL DEFAULT '' COMMENT '名称缩写',
    `description` char(100) NOT NULL DEFAULT '' COMMENT '描述',
    `version` char(10) NOT NULL DEFAULT '' COMMENT '版本',
    `updated` int(9) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新日期',
    PRIMARY KEY (`id`),
    KEY `idx_site_active_identifier` (`site`,`active`,`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块管理表' AUTO_INCREMENT=1;


--
-- 栏目数据 `dex_columns`
--
INSERT INTO `dex_columns` (`id`,`site`, `identifier`, `parent`, `module`, `position`, `name`, `route`) VALUES
('1', 'zhcn', 'home', '0', 'content', '1', '首页', 'content/column/view'),
('2', 'zhcn', 'about', '0', 'content', '2', '关于', 'content/page/view'),
('3', 'zhcn', 'project', '0', 'content', '3', '项目', 'content/column/view'),
('4', 'zhcn', 'feature', '0', 'content', '4', '特性', 'content/page/view'),
('5', 'zhcn', 'service', '0', 'content', '5', '服务', 'content/page/view'),
('6', 'zhcn', 'contact', '0', 'content', '6', '联系', 'content/contact/view'),
('7', 'zhcn', 'profile', '2', 'content', '1', '介绍', 'content/page/view'),
('8', 'zhcn', 'history', '2', 'content', '2', '历程', 'content/page/view'),
('9', 'zhcn', 'honner', '2', 'content', '3', '荣誉', 'content/page/view'),
('10', 'zhcn', 'webdesign', '3', 'content', '1', '网页设计', 'content/page/list'),
('11', 'zhcn', 'development', '3', 'content', '2', '程序开发', 'content/page/list'),
('12', 'zhcn', 'app', '3', 'content', '3', '手机应用', 'content/page/list'),
('13', 'en', 'home', '0', 'content', '1', 'Home', 'content/column/view'),
('14', 'en', 'about', '0', 'content', '2', 'About', 'content/page/view'),
('15', 'en', 'project', '0', 'content', '3', 'Our Projects', 'content/column/view'),
('16', 'en', 'feature', '0', 'content', '4', 'Features', 'content/page/view'),
('17', 'en', 'service', '0', 'content', '5', 'Service', 'content/page/view'),
('18', 'en', 'contact', '0', 'content', '6', 'Contact', 'content/contact/view'),
('19', 'en', 'profile', '14', 'content', '1', 'Profile', 'content/page/view'),
('20', 'en', 'history', '14', 'content', '2', 'History', 'content/page/view'),
('21', 'en', 'honner', '14', 'content', '3', 'Our Honner', 'content/page/view'),
('22', 'en', 'webdesign', '15', 'content', '1', 'Web Design', 'content/page/list'),
('23', 'en', 'development', '15', 'content', '2', 'Web Development', 'content/page/list'),
('24', 'en', 'app', '15', 'content', '3', 'App', 'content/page/list');


--
-- 配置数据 `dex_options`
--
INSERT INTO `dex_options` (`site`, `scope`, `name`, `value`, `decode`) VALUES
('zhcn', 'settings.global', 'title', 'Dexterous', '0'),
('zhcn', 'settings.global', 'keyword', 'Dexterous', '0'),
('zhcn', 'settings.global', 'description', 'Dexterous', '0'),
('zhcn', 'settings.global', 'translate', 'zh_cn', '0'),
('zhcn', 'settings.global', 'theme', 'default', '0'),
('zhcn', 'settings.global', 'timezone', 'Asia/Shanghai', '0'),
('zhcn', 'settings.global', 'cookie_key', 'dex', '0'),
('zhcn', 'settings.global', 'session_key', 'dex', '0'),
('zhcn', 'settings.global', 'upload_dir', '', '0'),
('en', 'settings.global', 'title', 'Dexterous', '0'),
('en', 'settings.global', 'keyword', 'Dexterous', '0'),
('en', 'settings.global', 'description', 'Dexterous', '0'),
('en', 'settings.global', 'translate', 'en', '0'),
('en', 'settings.global', 'theme', 'default', '0'),
('en', 'settings.global', 'timezone', 'America/Los_Angeles', '0'),
('en', 'settings.global', 'cookie_key', 'dex', '0'),
('en', 'settings.global', 'session_key', 'dex', '0'),
('en', 'settings.global', 'upload_dir', '', '0');


--
-- 模块数据 `dex_modules`
--
INSERT INTO `dex_modules` (`site`, `active`, `identifier`, `name`, `shortName`, `description`, `version`, `updated`) VALUES
('default', '1', 'cms', '系统核心模块', '系统', '提供系统核心功能', '0.1.0', UNIX_TIMESTAMP(NOW()));

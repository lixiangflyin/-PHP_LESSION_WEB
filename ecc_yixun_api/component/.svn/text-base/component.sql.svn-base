#DROP DATABASE IF EXISTS `icson_event_component`;                  
CREATE DATABASE `icson_event_component` DEFAULT CHARACTER SET latin1 DEFAULT COLLATE latin1_bin;
USE `icson_event_component`;
set names latin1;

DROP TABLE IF EXISTS `t_rank`;
CREATE TABLE IF NOT EXISTS `t_rank` (
   `id`          		  int(11) unsigned not null AUTO_INCREMENT,	
   `type`                 tinyint(3) not null,  						#排序商品类目
   `sort`          	      tinyint(3) not null,							#排序类别
   `num`          	      tinyint(3) not null,							#选取商品数
   `c3_id`                int(11) unsigned not null,					#3级小类
   `c2_id`                int(11) unsigned not null,
   `c1_id`                int(11) unsigned not null,
   `html`				  varchar(2048),		
   `status`               tinyint(3) not null,
   `createtime`           datetime,										#创建时间
   `updatetime`           datetime,										#修改时间
   `user_id`              int(11)  unsigned,  							#更新人 
   primary key (id)
) 
comment = "排行榜组件配置表" 
ENGINE = MYISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_bin
AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `t_comment`;
CREATE TABLE IF NOT EXISTS `t_comment` (
  `id` int(11) NOT NULL auto_increment,
  `is_reply` tinyint(1) NOT NULL,
  `page_size` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='评论组件配置表' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `t_information`;
CREATE TABLE IF NOT EXISTS `t_information` (
  `id` int(11) NOT NULL auto_increment,
  `content` text NOT NULL,
  `page_size` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='资讯组件配置表' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `t_information_list`;
CREATE TABLE IF NOT EXISTS `t_information_list` (
  `id` int(11) NOT NULL auto_increment,
  `infoconfig_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL default '1' COMMENT '0:删除 1:正常',
  `order_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='咨询组件明细表' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `t_coupon`;
CREATE TABLE IF NOT EXISTS `t_coupon` (
  `id` int(11) NOT NULL auto_increment,
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `update_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='领取优惠券活动' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `t_orderlottery`;
CREATE TABLE IF NOT EXISTS `t_orderlottery` (
  `id` int(11) NOT NULL auto_increment,
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `update_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='订单抽奖' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `t_countdown`
CREATE TABLE `t_countdown` (
`id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Auto ID' ,
`future_time`  varchar(50) NOT NULL COMMENT 'future time for countdown, split by commas' ,
`callback` varchar(50) NOT NULL COMMENT 'Using for callback JS func',
`create_time`  datetime NULL ,
`update_time`  datetime NULL ,
`user_id`  int(10) UNSIGNED NULL COMMENT 'UserID' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM DEFAULT CHARACTER SET=latin1 COLLATE=latin1_general_ci ;
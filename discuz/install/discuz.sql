-- phpMyAdmin SQL Dump
-- version 2.6.3-rc1
-- http://www.phpmyadmin.net
--
-- ����: localhost
-- ��������: 2005 �� 09 �� 28 �� 09:51
-- �������汾: 4.1.12
-- PHP �汾: 5.0.2
--
-- ���ݿ�: `dbname`
--

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_access`
--

DROP TABLE IF EXISTS cdb_access;
CREATE TABLE cdb_access (
  uid mediumint(8) unsigned NOT NULL default '0',
  fid smallint(6) unsigned NOT NULL default '0',
  allowview tinyint(1) NOT NULL default '0',
  allowpost tinyint(1) NOT NULL default '0',
  allowreply tinyint(1) NOT NULL default '0',
  allowgetattach tinyint(1) NOT NULL default '0',
  allowpostattach tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (uid,fid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_access`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_adminactions`
--

DROP TABLE IF EXISTS cdb_adminactions;
CREATE TABLE cdb_adminactions (
  admingid smallint(6) unsigned NOT NULL default '0',
  disabledactions text NOT NULL,
  PRIMARY KEY  (admingid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_adminactions`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_admingroups`
--

DROP TABLE IF EXISTS cdb_admingroups;
CREATE TABLE cdb_admingroups (
  admingid smallint(6) unsigned NOT NULL default '0',
  alloweditpost tinyint(1) NOT NULL default '0',
  alloweditpoll tinyint(1) NOT NULL default '0',
  allowstickthread tinyint(1) NOT NULL default '0',
  allowmodpost tinyint(1) NOT NULL default '0',
  allowdelpost tinyint(1) NOT NULL default '0',
  allowmassprune tinyint(1) NOT NULL default '0',
  allowrefund tinyint(1) NOT NULL default '0',
  allowcensorword tinyint(1) NOT NULL default '0',
  allowviewip tinyint(1) NOT NULL default '0',
  allowbanip tinyint(1) NOT NULL default '0',
  allowedituser tinyint(1) NOT NULL default '0',
  allowmoduser tinyint(1) NOT NULL default '0',
  allowbanuser tinyint(1) NOT NULL default '0',
  allowpostannounce tinyint(1) NOT NULL default '0',
  allowviewlog tinyint(1) NOT NULL default '0',
  disablepostctrl tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (admingid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_admingroups`
--

INSERT INTO cdb_admingroups VALUES (1, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO cdb_admingroups VALUES (2, 1, 0, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO cdb_admingroups VALUES (3, 1, 0, 1, 1, 1, 0, 0, 0, 1, 0, 0, 1, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_adminnotes`
--

DROP TABLE IF EXISTS cdb_adminnotes;
CREATE TABLE cdb_adminnotes (
  id mediumint(8) unsigned NOT NULL auto_increment,
  admin varchar(15) NOT NULL default '',
  access tinyint(3) NOT NULL default '0',
  adminid tinyint(3) NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  expiration int(10) unsigned NOT NULL default '0',
  message text NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- �������е����� `cdb_adminnotes`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_adminsessions`
--

DROP TABLE IF EXISTS cdb_adminsessions;
CREATE TABLE cdb_adminsessions (
  uid mediumint(8) unsigned NOT NULL default '0',
  ip char(15) NOT NULL default '',
  dateline int(10) unsigned NOT NULL default '0',
  errorcount tinyint(1) NOT NULL default '0'
) TYPE=MyISAM;

--
-- �������е����� `cdb_adminsessions`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_advertisements`
--

DROP TABLE IF EXISTS cdb_advertisements;
CREATE TABLE cdb_advertisements (
  advid mediumint(8) unsigned NOT NULL auto_increment,
  available tinyint(1) NOT NULL default '0',
  `type` varchar(50) NOT NULL default '0',
  displayorder tinyint(3) NOT NULL default '0',
  title varchar(50) NOT NULL default '',
  targets text NOT NULL,
  parameters text NOT NULL,
  `code` text NOT NULL,
  starttime int(10) unsigned NOT NULL default '0',
  endtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (advid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_advertisements`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_announcements`
--

DROP TABLE IF EXISTS cdb_announcements;
CREATE TABLE cdb_announcements (
  id smallint(6) unsigned NOT NULL auto_increment,
  author varchar(15) NOT NULL default '',
  `subject` varchar(250) NOT NULL default '',
  displayorder tinyint(3) NOT NULL default '0',
  starttime int(10) unsigned NOT NULL default '0',
  endtime int(10) unsigned NOT NULL default '0',
  message text NOT NULL,
  PRIMARY KEY  (id),
  KEY timespan (starttime,endtime)
) TYPE=MyISAM;

--
-- �������е����� `cdb_announcements`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_attachments`
--

DROP TABLE IF EXISTS cdb_attachments;
CREATE TABLE cdb_attachments (
  aid mediumint(8) unsigned NOT NULL auto_increment,
  tid mediumint(8) unsigned NOT NULL default '0',
  pid int(10) unsigned NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  readperm tinyint(3) unsigned NOT NULL default '0',
  filename char(100) NOT NULL default '',
  description char(100) NOT NULL default '',
  filetype char(50) NOT NULL default '',
  filesize int(10) unsigned NOT NULL default '0',
  attachment char(100) NOT NULL default '',
  downloads mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (aid),
  KEY tid (tid),
  KEY pid (pid,aid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_attachments`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_attachtypes`
--

DROP TABLE IF EXISTS cdb_attachtypes;
CREATE TABLE cdb_attachtypes (
  id smallint(6) unsigned NOT NULL auto_increment,
  extension char(12) NOT NULL default '',
  maxsize int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- �������е����� `cdb_attachtypes`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_banned`
--

DROP TABLE IF EXISTS cdb_banned;
CREATE TABLE cdb_banned (
  id smallint(6) unsigned NOT NULL auto_increment,
  ip1 smallint(3) NOT NULL default '0',
  ip2 smallint(3) NOT NULL default '0',
  ip3 smallint(3) NOT NULL default '0',
  ip4 smallint(3) NOT NULL default '0',
  admin varchar(15) NOT NULL default '',
  dateline int(10) unsigned NOT NULL default '0',
  expiration int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- �������е����� `cdb_banned`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_bbcodes`
--

DROP TABLE IF EXISTS cdb_bbcodes;
CREATE TABLE cdb_bbcodes (
  id mediumint(8) unsigned NOT NULL auto_increment,
  available tinyint(1) NOT NULL default '0',
  tag varchar(100) NOT NULL default '',
  replacement text NOT NULL,
  example varchar(255) NOT NULL default '',
  explanation text NOT NULL,
  params tinyint(1) unsigned NOT NULL default '1',
  nest tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- �������е����� `cdb_bbcodes`
--

INSERT INTO cdb_bbcodes VALUES (1, 0, 'fly', '<marquee width="90%" behavior="alternate" scrollamount="3">{1}</marquee>', '[fly]This is sample text[/fly]', 'Make text move horizontal, the same effect as html tag <marquee>. NOTE: Only Internet Explorer supports this feature', 1, 1);
INSERT INTO cdb_bbcodes VALUES (2, 0, 'flash', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="550" height="400"><param name="allowScriptAccess" value="sameDomain"><param name="movie" value="{1}"><param name="quality" value="high"><param name="bgcolor" value="#ffffff"><embed src="{1}" quality="high" bgcolor="#ffffff" width="550" height="400" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>', 'Flash Movie', 'Insert flash movie to thread page', 1, 1);
INSERT INTO cdb_bbcodes VALUES (3, 1, 'qq', '<a href="http://wpa.qq.com/msgrd?V=1&Uin={1}&Site=[Discuz!]&Menu=yes" target="_blank"><img src="http://wpa.qq.com/pa?p=1:{1}:1" border="0"></a>', '[qq]688888[/qq]', 'Show online status of specified QQ UIN and chat with him/her simply by clicking the icon', 1, 1);
INSERT INTO cdb_bbcodes VALUES (4, 0, 'ra', '<object classid="clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA" width="400" height="30" id="Player" border="0"><param name="_ExtentX" value="10583"><param name="_ExtentY" value="794"><param name="AUTOSTART" value="0"><param name="SHUFFLE" value="0"><param name="PREFETCH" value="0"><param name="NOLABELS" value="0"><param name="CONTROLS" value="controlpanel"><param name="CONSOLE" value="_master"><param name="LOOP" value="0"><param name="NUMLOOP" value="0"><param name="CENTER" value="0"><param name="MAINTAINASPECT" value="0"><param name="BACKGROUNDCOLOR" value="#000000"><param name="SRC" value="{1}"></object>', '[ra]rtsp://your.com/example.ra[/ra]', 'Embed Real Audio in thread page', 1, 1);
INSERT INTO cdb_bbcodes VALUES (5, 0, 'rm', '<object classid="clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA" width="500" height="400" id="RealMoviePlayer" border="0"><param name="_ExtentX" value="13229"><param name="_ExtentY" value="10583"><param name="AUTOSTART" value="0"><param name="SHUFFLE" value="0"><param name="PREFETCH" value="0"><param name="NOLABELS" value="0"><param name="CONTROLS" value="ImageWindow"><param name="CONSOLE" value="_master"><param name="LOOP" value="0"><param name="NUMLOOP" value="0"><param name="CENTER" value="0"><param name="MAINTAINASPECT" value="0"><param name="BACKGROUNDCOLOR" value="#000000"><param name="SRC" value="{1}"></object><br><object classid="clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA" width="500" height="40" id="RealMoviePlayer" border="0"><param name="_ExtentX" value="13229"><param name="_ExtentY" value="1058"><param name="AUTOSTART" value="0"><param name="SHUFFLE" value="0"><param name="PREFETCH" value="0"><param name="NOLABELS" value="0"><param name="CONTROLS" value="controlpanel"><param name="CONSOLE" value="_master"><param name="LOOP" value="0"><param name="NUMLOOP" value="0"><param name="CENTER" value="0"><param name="MAINTAINASPECT" value="0"><param name="BACKGROUNDCOLOR" value="#000000"><param name="SRC" value="{1}"></object>', '[rm]rtsp://your.com/example.rm[/rm]', 'Embed Real Audio/Vidio in thread page', 1, 1);
INSERT INTO cdb_bbcodes VALUES (6, 0, 'wma', '<object height="64" width="260" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" align="center" border="0"><param name="AutoStart" value="0"><param name="Balance" value="0"><param name="enabled" value="-1"><param name="EnableContextMenu" value="-1"><param name="url" value="{1}"><param name="PlayCount" value="1"><param name="rate" value="1"><param name="currentPosition" value="0"><param name="currentMarker" value="0"><param name="defaultFrame" value=""><param name="invokeURLs" value="0"><param name="baseURL" value=""><param name="stretchToFit" value="0"><param name="volume" value="100"><param name="mute" value="0"><param name="uiMode" value="mini"><param name="windowlessVideo" value="-1"><param name="fullScreen" value="0"><param name="enableErrorDialogs" value="-1"><param name="SAMIStyle" value><param name="SAMILang" value><param name="SAMIFilename" value><param name="captioningID" value></object>', '[wma]mms://your.com/example.wma[/wma]', 'Embed Windows media audio in thread page', 1, 1);
INSERT INTO cdb_bbcodes VALUES (7, 0, 'wmv', '<object height="400" width="500" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" align="center" border="0"><param name="AutoStart" value="0"><param name="Balance" value="0"><param name="enabled" value="-1"><param name="EnableContextMenu" value="-1"><param name="url" value="{1}"><param name="PlayCount" value="1"><param name="rate" value="1"><param name="currentPosition" value="0"><param name="currentMarker" value="0"><param name="defaultFrame" value=""><param name="invokeURLs" value="0"><param name="baseURL" value=""><param name="stretchToFit" value="0"><param name="volume" value="100"><param name="mute" value="0"><param name="uiMode" value="mini"><param name="windowlessVideo" value="0"><param name="fullScreen" value="0"><param name="enableErrorDialogs" value="-1"><param name="SAMIStyle" value><param name="SAMILang" value><param name="SAMIFilename" value><param name="captioningID" value></object>', '[wmv]mms://your.com/example.wmv[/wmv]', 'Embed Windows media audio/video in thread page', 1, 1);

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_blogcaches`
--

DROP TABLE IF EXISTS cdb_blogcaches;
CREATE TABLE cdb_blogcaches (
  uid mediumint(8) unsigned NOT NULL default '0',
  variable varchar(10) NOT NULL default '',
  `value` text NOT NULL,
  PRIMARY KEY  (uid,variable)
) TYPE=MyISAM;

--
-- �������е����� `cdb_blogcaches`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_buddys`
--

DROP TABLE IF EXISTS cdb_buddys;
CREATE TABLE cdb_buddys (
  uid mediumint(8) unsigned NOT NULL default '0',
  buddyid mediumint(8) unsigned NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  description char(255) NOT NULL default '',
  KEY uid (uid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_buddys`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_creditslog`
--

DROP TABLE IF EXISTS cdb_creditslog;
CREATE TABLE cdb_creditslog (
  uid mediumint(8) unsigned NOT NULL default '0',
  fromto char(15) NOT NULL default '',
  sendcredits tinyint(1) NOT NULL default '0',
  receivecredits tinyint(1) NOT NULL default '0',
  send int(10) unsigned NOT NULL default '0',
  receive int(10) unsigned NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  operation char(3) NOT NULL default '',
  KEY uid (uid,dateline)
) TYPE=MyISAM;

--
-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_crons`
--

DROP TABLE IF EXISTS cdb_crons;
CREATE TABLE cdb_crons (
  cronid smallint(6) unsigned NOT NULL auto_increment,
  available tinyint(1) NOT NULL default '0',
  type enum('user','system') NOT NULL default 'user',
  name char(50) NOT NULL default '',
  filename char(50) NOT NULL default '',
  lastrun int(10) unsigned NOT NULL default '0',
  nextrun int(10) unsigned NOT NULL default '0',
  weekday tinyint(1) NOT NULL default '0',
  day tinyint(2) NOT NULL default '0',
  hour tinyint(2) NOT NULL default '0',
  minute char(36) NOT NULL default '',
  PRIMARY KEY  (cronid),
  KEY nextrun (available,nextrun)
) Type=MyISAM;

--
-- �������е����� `cdb_crons`
--

INSERT INTO cdb_crons VALUES (1, 1, 'system', '��ս��շ�����', 'todayposts_daily.inc.php', 1130139337, 1130169600, -1, -1, 0, '0');
INSERT INTO cdb_crons VALUES (2, 1, 'system', '��ձ�������ʱ��', 'onlinetime_monthly.inc.php', 1130139557, 1130774400, -1, 1, 0, '0');
INSERT INTO cdb_crons VALUES (3, 1, 'system', 'ÿ����������', 'cleanup_daily.inc.php', 1130142545, 1130189400, -1, -1, 5, '30');
INSERT INTO cdb_crons VALUES (4, 1, 'system', '����ͳ�����ʼ�ף��', 'birthdays_daily.inc.php', 1130139241, 1130169600, -1, -1, 0, '0');
INSERT INTO cdb_crons VALUES (5, 1, 'system', '����ظ�֪ͨ', 'notify_daily.inc.php', 1130142545, 1130189400, -1, -1, 5, '00');
INSERT INTO cdb_crons VALUES (6, 1, 'system', 'ÿ�չ�������', 'announcements_daily.inc.php', 0, 1131284204, -1, -1, 0, '0');
INSERT INTO cdb_crons VALUES (7, 1, 'system', '��ʱ��������', 'threadexpiries_daily.inc.php',0,1138464000, -1, -1, 5, 0);
INSERT INTO cdb_crons VALUES (8, 1, 'system', '��̳�ƹ�����', 'promotions_hourly.inc.php', 0,1130169600, -1, -1, 0, '00');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_failedlogins`
--

DROP TABLE IF EXISTS cdb_failedlogins;
CREATE TABLE cdb_failedlogins (
  ip char(15) NOT NULL default '',
  count tinyint(1) unsigned NOT NULL default '0',
  lastupdate int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (ip)
) TYPE=MyISAM;

--
-- �������е����� `cdb_failedlogins`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_favorites`
--

DROP TABLE IF EXISTS cdb_favorites;
CREATE TABLE cdb_favorites (
  uid mediumint(8) unsigned NOT NULL default '0',
  tid mediumint(8) unsigned NOT NULL default '0',
  KEY uid (uid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_favorites`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_forumfields`
--

DROP TABLE IF EXISTS cdb_forumfields;
CREATE TABLE cdb_forumfields (
  fid smallint(6) unsigned NOT NULL default '0',
  description text NOT NULL,
  `password` varchar(12) NOT NULL default '',
  icon varchar(255) NOT NULL default '',
  postcredits varchar(255) NOT NULL default '',
  replycredits varchar(255) NOT NULL default '',
  redirect varchar(255) NOT NULL default '',
  attachextensions varchar(255) NOT NULL default '',
  moderators text NOT NULL,
  rules text NOT NULL,
  threadtypes text NOT NULL,
  viewperm text NOT NULL,
  postperm text NOT NULL,
  replyperm text NOT NULL,
  getattachperm text NOT NULL,
  postattachperm text NOT NULL,
  PRIMARY KEY  (fid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_forumfields`
--

INSERT INTO cdb_forumfields VALUES (1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_forumlinks`
--

DROP TABLE IF EXISTS cdb_forumlinks;
CREATE TABLE cdb_forumlinks (
  id smallint(6) unsigned NOT NULL auto_increment,
  displayorder tinyint(3) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  note varchar(200) NOT NULL default '',
  logo varchar(100) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- �������е����� `cdb_forumlinks`
--

INSERT INTO cdb_forumlinks VALUES (1, 0, 'Discuz! �ٷ���̳', 'http://www.discuz.com', '�ṩ���� Discuz! ��Ʒ���š���������뼼������', 'images/logo.gif');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_forums`
--

DROP TABLE IF EXISTS cdb_forums;
CREATE TABLE cdb_forums (
  fid smallint(6) unsigned NOT NULL auto_increment,
  fup smallint(6) unsigned NOT NULL default '0',
  `type` enum('group','forum','sub') NOT NULL default 'forum',
  `name` char(50) NOT NULL default '',
  `status` tinyint(1) NOT NULL default '0',
  displayorder tinyint(3) NOT NULL default '0',
  styleid smallint(6) unsigned NOT NULL default '0',
  threads mediumint(8) unsigned NOT NULL default '0',
  posts mediumint(8) unsigned NOT NULL default '0',
  todayposts mediumint(8) unsigned NOT NULL default '0',
  lastpost char(110) NOT NULL default '',
  allowsmilies tinyint(1) NOT NULL default '0',
  allowhtml tinyint(1) NOT NULL default '0',
  allowbbcode tinyint(1) NOT NULL default '0',
  allowimgcode tinyint(1) NOT NULL default '0',
  allowanonymous tinyint(1) NOT NULL default '0',
  allowblog tinyint(1) NOT NULL default '0',
  allowtrade tinyint(1) NOT NULL default '0',
  alloweditrules tinyint(1) NOT NULL default '0',
  recyclebin tinyint(1) NOT NULL default '0',
  modnewposts tinyint(1) NOT NULL default '0',
  jammer tinyint(1) NOT NULL default '0',
  disablewatermark tinyint(1) NOT NULL default '0',
  inheritedmod tinyint(1) NOT NULL default '0',
  autoclose smallint(6) NOT NULL default '0',
  PRIMARY KEY  (fid),
  KEY forum (`status`,`type`,displayorder),
  KEY fup (fup)
) TYPE=MyISAM;

--
-- �������е����� `cdb_forums`
--

INSERT INTO cdb_forums VALUES (1, 0, 'forum', 'Ĭ����̳', 1, 0, 0, 0, 0, 0,'			', 1, 0, 1, 1, 0, 1, 3, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_medals`
--

DROP TABLE IF EXISTS cdb_medals;
CREATE TABLE cdb_medals (
  medalid smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  available tinyint(1) NOT NULL default '0',
  image varchar(30) NOT NULL default '',
  PRIMARY KEY  (medalid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_medals`
--

INSERT INTO cdb_medals VALUES (1, 'Medal No.1', 0, 'medal1.gif');
INSERT INTO cdb_medals VALUES (2, 'Medal No.2', 0, 'medal2.gif');
INSERT INTO cdb_medals VALUES (3, 'Medal No.3', 0, 'medal3.gif');
INSERT INTO cdb_medals VALUES (4, 'Medal No.4', 0, 'medal4.gif');
INSERT INTO cdb_medals VALUES (5, 'Medal No.5', 0, 'medal5.gif');
INSERT INTO cdb_medals VALUES (6, 'Medal No.6', 0, 'medal6.gif');
INSERT INTO cdb_medals VALUES (7, 'Medal No.7', 0, 'medal7.gif');
INSERT INTO cdb_medals VALUES (8, 'Medal No.8', 0, 'medal8.gif');
INSERT INTO cdb_medals VALUES (9, 'Medal No.9', 0, 'medal9.gif');
INSERT INTO cdb_medals VALUES (10, 'Medal No.10', 0, 'medal10.gif');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_memberfields`
--

DROP TABLE IF EXISTS cdb_memberfields;
CREATE TABLE cdb_memberfields (
  uid mediumint(8) unsigned NOT NULL default '0',
  nickname varchar(30) NOT NULL default '',
  site varchar(75) NOT NULL default '',
  alipay varchar(50) NOT NULL default '',
  icq varchar(12) NOT NULL default '',
  qq varchar(12) NOT NULL default '',
  yahoo varchar(40) NOT NULL default '',
  msn varchar(40) NOT NULL default '',
  taobao varchar(40) NOT NULL default '',
  location varchar(30) NOT NULL default '',
  customstatus varchar(30) NOT NULL default '',
  medals varchar(255) NOT NULL default '',
  avatar varchar(255) NOT NULL default '',
  avatarwidth tinyint(3) unsigned NOT NULL default '0',
  avatarheight tinyint(3) unsigned NOT NULL default '0',
  bio text NOT NULL,
  signature text NOT NULL,
  sightml text NOT NULL,
  ignorepm text NOT NULL,
  groupterms text NOT NULL,
  authstr varchar(20) NOT NULL default '',
  PRIMARY KEY  (uid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_memberfields`
--

INSERT INTO cdb_memberfields VALUES (1, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_members`
--

DROP TABLE IF EXISTS cdb_members;
CREATE TABLE cdb_members (
  uid mediumint(8) unsigned NOT NULL auto_increment,
  username char(15) NOT NULL default '',
  `password` char(32) NOT NULL default '',
  secques char(8) NOT NULL default '',
  gender tinyint(1) NOT NULL default '0',
  adminid tinyint(1) NOT NULL default '0',
  groupid smallint(6) unsigned NOT NULL default '0',
  groupexpiry int(10) unsigned NOT NULL default '0',
  extgroupids char(60) NOT NULL default '',
  regip char(15) NOT NULL default '',
  regdate int(10) unsigned NOT NULL default '0',
  lastip char(15) NOT NULL default '',
  lastvisit int(10) unsigned NOT NULL default '0',
  lastactivity int(10) unsigned NOT NULL default '0',
  lastpost int(10) unsigned NOT NULL default '0',
  posts mediumint(8) unsigned NOT NULL default '0',
  digestposts smallint(6) unsigned NOT NULL default '0',
  oltime smallint(6) unsigned NOT NULL default '0',
  pageviews mediumint(8) unsigned NOT NULL default '0',
  credits int(10) NOT NULL default '0',
  extcredits1 int(10) NOT NULL default '0',
  extcredits2 int(10) NOT NULL default '0',
  extcredits3 int(10) NOT NULL default '0',
  extcredits4 int(10) NOT NULL default '0',
  extcredits5 int(10) NOT NULL default '0',
  extcredits6 int(10) NOT NULL default '0',
  extcredits7 int(10) NOT NULL default '0',
  extcredits8 int(10) NOT NULL default '0',
  avatarshowid int(10) unsigned NOT NULL default '0',
  email char(50) NOT NULL default '',
  bday date NOT NULL default '0000-00-00',
  sigstatus tinyint(1) NOT NULL default '0',
  tpp tinyint(3) unsigned NOT NULL default '0',
  ppp tinyint(3) unsigned NOT NULL default '0',
  styleid smallint(6) unsigned NOT NULL default '0',
  dateformat char(10) NOT NULL default '',
  timeformat tinyint(1) NOT NULL default '0',
  pmsound tinyint(1) NOT NULL default '0',
  showemail tinyint(1) NOT NULL default '0',
  newsletter tinyint(1) NOT NULL default '0',
  invisible tinyint(1) NOT NULL default '0',
  timeoffset char(4) NOT NULL default '',
  newpm tinyint(1) NOT NULL default '0',
  accessmasks tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (uid),
  UNIQUE KEY username (username),
  KEY email (email)
) TYPE=MyISAM;

--
-- �������е����� `cdb_members`
--

INSERT INTO cdb_members VALUES (1, 'admin', '0cc175b9c0f1b6a831c399e269772661', '', 0, 1, 1, 0, '', 'hidden', 1127871817, '', 1127871817, 0, 1127871817, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'name@domain.com', '0000-00-00', 0, 0, 0, 0, '', 0, 0, 1, 1, 0, '9999', 0, 0);

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_moderators`
--

DROP TABLE IF EXISTS cdb_moderators;
CREATE TABLE cdb_moderators (
  uid mediumint(8) unsigned NOT NULL default '0',
  fid smallint(6) unsigned NOT NULL default '0',
  displayorder tinyint(3) NOT NULL default '0',
  inherited tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (uid,fid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_moderators`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_modworks`
--
DROP TABLE IF EXISTS cdb_modworks;
CREATE TABLE cdb_modworks (
  uid mediumint(8) unsigned NOT NULL default '0',
  modaction char(3) NOT NULL default '',
  dateline date NOT NULL default '2006-1-1',
  count smallint(6) unsigned NOT NULL default '0',
  posts smallint(6) unsigned NOT NULL default '0',
  KEY uid (uid,dateline)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_onlinelist`
--

DROP TABLE IF EXISTS cdb_onlinelist;
CREATE TABLE cdb_onlinelist (
  groupid smallint(6) unsigned NOT NULL default '0',
  displayorder tinyint(3) NOT NULL default '0',
  title varchar(30) NOT NULL default '',
  url varchar(30) NOT NULL default ''
) TYPE=MyISAM;

--
-- �������е����� `cdb_onlinelist`
--

INSERT INTO cdb_onlinelist VALUES (1, 1, '����Ա', 'online_admin.gif');
INSERT INTO cdb_onlinelist VALUES (2, 2, '��������', 'online_supermod.gif');
INSERT INTO cdb_onlinelist VALUES (3, 3, '����', 'online_moderator.gif');
INSERT INTO cdb_onlinelist VALUES (0, 4, '��Ա', 'online_member.gif');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_onlinetime`
--

DROP TABLE IF EXISTS cdb_onlinetime;
CREATE TABLE cdb_onlinetime (
  uid mediumint(8) unsigned NOT NULL default '0',
  thismonth smallint(6) unsigned NOT NULL default '0',
  total mediumint(8) unsigned NOT NULL default '0',
  lastupdate int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (uid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_onlinetime`
--

INSERT INTO cdb_onlinetime VALUES (1, 30, 30, 0);

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_orders`
--

DROP TABLE IF EXISTS cdb_orders;
CREATE TABLE cdb_orders (
  orderid char(32) NOT NULL default '',
  `status` char(3) NOT NULL default '',
  buyer char(50) NOT NULL default '',
  admin char(15) NOT NULL default '',
  uid mediumint(8) unsigned NOT NULL default '0',
  amount int(10) unsigned NOT NULL default '0',
  price float(7,2) unsigned NOT NULL default '0.00',
  submitdate int(10) unsigned NOT NULL default '0',
  confirmdate int(10) unsigned NOT NULL default '0',
  UNIQUE KEY orderid (orderid),
  KEY submitdate (submitdate),
  KEY uid (uid,submitdate)
) TYPE=MyISAM;

--
-- �������е����� `cdb_orders`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_paymentlog`
--

DROP TABLE IF EXISTS cdb_paymentlog;
CREATE TABLE cdb_paymentlog (
  uid mediumint(8) unsigned NOT NULL default '0',
  tid mediumint(8) unsigned NOT NULL default '0',
  authorid mediumint(8) unsigned NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  amount int(10) unsigned NOT NULL default '0',
  netamount int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (tid,uid),
  KEY uid (uid),
  KEY authorid (authorid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_paymentlog`
--


-- --------------------------------------------------------

--
-- �������е����� `cdb_pluginhooks`
--

DROP TABLE IF EXISTS cdb_pluginhooks;
CREATE TABLE cdb_pluginhooks (
  pluginhookid mediumint(8) unsigned NOT NULL auto_increment,
  pluginid smallint(6) unsigned NOT NULL default '0',
  available tinyint(1) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  description mediumtext NOT NULL,
  `code` mediumtext NOT NULL,
  PRIMARY KEY  (pluginhookid),
  KEY pluginid (pluginid),
  KEY available (available)
) TYPE=MyISAM;
-- ��Ľṹ `cdb_plugins`
--

DROP TABLE IF EXISTS cdb_plugins;
CREATE TABLE cdb_plugins (
  pluginid smallint(6) unsigned NOT NULL auto_increment,
  available tinyint(1) NOT NULL default '0',
  adminid tinyint(1) unsigned NOT NULL default '0',
  `name` varchar(40) NOT NULL default '',
  identifier varchar(40) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  datatables varchar(255) NOT NULL default '',
  `directory` varchar(100) NOT NULL default '',
  copyright varchar(100) NOT NULL default '',
  modules text NOT NULL,
  PRIMARY KEY  (pluginid),
  UNIQUE KEY identifier (identifier)
) TYPE=MyISAM;

--
-- �������е����� `cdb_plugins`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_pluginvars`
--

DROP TABLE IF EXISTS cdb_pluginvars;
CREATE TABLE cdb_pluginvars (
  pluginvarid mediumint(8) unsigned NOT NULL auto_increment,
  pluginid smallint(6) unsigned NOT NULL default '0',
  displayorder tinyint(3) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  variable varchar(40) NOT NULL default '',
  `type` varchar(20) NOT NULL default 'text',
  `value` text NOT NULL,
  extra text NOT NULL,
  PRIMARY KEY  (pluginvarid),
  KEY pluginid (pluginid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_pluginvars`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_pms`
--

DROP TABLE IF EXISTS cdb_pms;
CREATE TABLE cdb_pms (
  pmid int(10) unsigned NOT NULL auto_increment,
  msgfrom varchar(15) NOT NULL default '',
  msgfromid mediumint(8) unsigned NOT NULL default '0',
  msgtoid mediumint(8) unsigned NOT NULL default '0',
  folder enum('inbox','outbox') NOT NULL default 'inbox',
  `new` tinyint(1) NOT NULL default '0',
  `subject` varchar(75) NOT NULL default '',
  dateline int(10) unsigned NOT NULL default '0',
  message text NOT NULL,
  PRIMARY KEY  (pmid),
  KEY msgtoid (msgtoid,folder,dateline),
  KEY msgfromid (msgfromid,folder,dateline)
) TYPE=MyISAM;

--
-- �������е����� `cdb_pms`
--

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_pmsearchindex`
--

DROP TABLE IF EXISTS cdb_pmsearchindex;
CREATE TABLE cdb_pmsearchindex (
  searchid int(10) unsigned NOT NULL auto_increment,
  keywords varchar(255) NOT NULL default '',
  searchstring varchar(255) NOT NULL default '',
  uid mediumint(8) unsigned NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  expiration int(10) unsigned NOT NULL default '0',
  pms smallint(6) unsigned NOT NULL default '0',
  pmids text NOT NULL,
  PRIMARY KEY  (searchid)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_polls`
--

DROP TABLE IF EXISTS cdb_polls;
CREATE TABLE cdb_polls (
  tid mediumint(8) unsigned NOT NULL default '0',
  pollopts mediumtext NOT NULL,
  PRIMARY KEY  (tid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_polls`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_posts`
--

DROP TABLE IF EXISTS cdb_posts;
CREATE TABLE cdb_posts (
  pid int(10) unsigned NOT NULL auto_increment,
  fid smallint(6) unsigned NOT NULL default '0',
  tid mediumint(8) unsigned NOT NULL default '0',
  `first` tinyint(1) NOT NULL default '0',
  author varchar(15) NOT NULL default '',
  authorid mediumint(8) unsigned NOT NULL default '0',
  `subject` varchar(80) NOT NULL default '',
  dateline int(10) unsigned NOT NULL default '0',
  message mediumtext NOT NULL,
  useip varchar(15) NOT NULL default '',
  invisible tinyint(1) NOT NULL default '0',
  anonymous tinyint(1) NOT NULL default '0',
  usesig tinyint(1) NOT NULL default '0',
  htmlon tinyint(1) NOT NULL default '0',
  bbcodeoff tinyint(1) NOT NULL default '0',
  smileyoff tinyint(1) NOT NULL default '0',
  parseurloff tinyint(1) NOT NULL default '0',
  attachment tinyint(1) NOT NULL default '0',
  rate smallint(6) NOT NULL default '0',
  ratetimes tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (pid),
  KEY fid (fid),
  KEY authorid (authorid),
  KEY dateline (dateline),
  KEY invisible (invisible),
  KEY displayorder (tid,invisible,dateline),
  KEY `first` (tid,`first`)
) TYPE=MyISAM;

--
-- �������е����� `cdb_posts`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_profilefields`
--

DROP TABLE IF EXISTS cdb_profilefields;
CREATE TABLE cdb_profilefields (
  fieldid smallint(6) unsigned NOT NULL auto_increment,
  available tinyint(1) NOT NULL default '0',
  invisible tinyint(1) NOT NULL default '0',
  title varchar(50) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  size tinyint(3) unsigned NOT NULL default '0',
  displayorder smallint(6) NOT NULL default '0',
  required tinyint(1) NOT NULL default '0',
  unchangeable tinyint(1) NOT NULL default '0',
  showinthread tinyint(1) NOT NULL default '0',
  selective tinyint(1) NOT NULL default '0',
  choices text NOT NULL,
  PRIMARY KEY  (fieldid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_profilefields`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_polls`
--

DROP TABLE IF EXISTS cdb_promotions;
CREATE TABLE cdb_promotions (
  ip char(15) NOT NULL default '',
  uid mediumint(8) NOT NULL default '0',
  username char(15) NOT NULL default '',
  PRIMARY KEY  (ip)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_ranks`
--

DROP TABLE IF EXISTS cdb_ranks;
CREATE TABLE cdb_ranks (
  rankid smallint(6) unsigned NOT NULL auto_increment,
  ranktitle varchar(30) NOT NULL default '',
  postshigher mediumint(8) unsigned NOT NULL default '0',
  stars tinyint(3) NOT NULL default '0',
  color varchar(7) NOT NULL default '',
  PRIMARY KEY  (rankid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_ranks`
--

INSERT INTO cdb_ranks VALUES (1, '������ѧ', 0, 1, '');
INSERT INTO cdb_ranks VALUES (2, 'С��ţ��', 50, 2, '');
INSERT INTO cdb_ranks VALUES (3, 'ʵϰ����', 300, 5, '');
INSERT INTO cdb_ranks VALUES (4, '����׫����', 1000, 4, '');
INSERT INTO cdb_ranks VALUES (5, '��Ƹ����', 3000, 5, '');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_ratelog`
--

DROP TABLE IF EXISTS cdb_ratelog;
CREATE TABLE cdb_ratelog (
  pid int(10) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL default '0',
  username char(15) NOT NULL default '',
  extcredits tinyint(1) unsigned NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  score smallint(6) NOT NULL default '0',
  reason char(40) NOT NULL default '',
  KEY pid (pid,dateline),
  KEY dateline (dateline)
) TYPE=MyISAM;

--
-- �������е����� `cdb_ratelog`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_regips`
--

DROP TABLE IF EXISTS cdb_regips;
CREATE TABLE cdb_regips (
  ip char(15) NOT NULL default '',
  dateline int(10) unsigned NOT NULL default '0',
  count smallint(6) NOT NULL default '0',
  KEY ip (ip)
) TYPE=MyISAM;

--
-- �������е����� `cdb_regips`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_relatedthreads`
--

DROP TABLE IF EXISTS cdb_relatedthreads;
CREATE TABLE cdb_relatedthreads (
  tid mediumint(8) NOT NULL default '0',
  expiration int(10) NOT NULL default '0',
  keywords varchar(255) NOT NULL default '',
  relatedthreads text NOT NULL,
  PRIMARY KEY  (tid)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_rsscaches`
--

DROP TABLE IF EXISTS cdb_rsscaches;
CREATE TABLE cdb_rsscaches (
  lastupdate int(10) unsigned NOT NULL default '0',
  fid smallint(6) unsigned NOT NULL default '0',
  tid mediumint(8) unsigned NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  forum char(50) NOT NULL default '',
  author char(15) NOT NULL default '',
  `subject` char(80) NOT NULL default '',
  description char(255) NOT NULL default '',
  KEY fid (fid,dateline)
) TYPE=MyISAM;

--
-- �������е����� `cdb_rsscaches`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_searchindex`
--

DROP TABLE IF EXISTS cdb_searchindex;
CREATE TABLE cdb_searchindex (
  searchid int(10) unsigned NOT NULL auto_increment,
  keywords varchar(255) NOT NULL default '',
  searchstring varchar(255) NOT NULL default '',
  useip varchar(15) NOT NULL default '',
  uid mediumint(10) unsigned NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  expiration int(10) unsigned NOT NULL default '0',
  threads smallint(6) unsigned NOT NULL default '0',
  tids text NOT NULL,
  PRIMARY KEY  (searchid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_searchindex`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_sessions`
--

DROP TABLE IF EXISTS cdb_sessions;
CREATE TABLE cdb_sessions (
  sid char(6) binary NOT NULL default '',
  ip1 tinyint(3) unsigned NOT NULL default '0',
  ip2 tinyint(3) unsigned NOT NULL default '0',
  ip3 tinyint(3) unsigned NOT NULL default '0',
  ip4 tinyint(3) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL default '0',
  username char(15) NOT NULL default '',
  groupid smallint(6) unsigned NOT NULL default '0',
  styleid smallint(6) unsigned NOT NULL default '0',
  invisible tinyint(1) NOT NULL default '0',
  `action` tinyint(1) unsigned NOT NULL default '0',
  lastactivity int(10) unsigned NOT NULL default '0',
  lastolupdate int(10) unsigned NOT NULL default '0',
  pageviews smallint(6) unsigned NOT NULL default '0',
  seccode smallint(6) unsigned NOT NULL default '0',
  fid smallint(6) unsigned NOT NULL default '0',
  tid mediumint(8) unsigned NOT NULL default '0',
  bloguid mediumint(8) unsigned NOT NULL default '0',
  UNIQUE KEY sid (sid),
  KEY uid (uid),
  KEY bloguid (bloguid)
) TYPE=Heap;

--
-- �������е����� `cdb_sessions`
--

INSERT INTO cdb_sessions VALUES (0x6d364758636b, 127, 0, 0, 1, 0, '', 7, 1, 0, 1, 1125560676, 0, 0, 8712, 0, 0, 0);

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_settings`
--

DROP TABLE IF EXISTS cdb_settings;
CREATE TABLE cdb_settings (
  variable varchar(32) NOT NULL default '',
  `value` text NOT NULL,
  PRIMARY KEY  (variable)
) TYPE=MyISAM;

--
-- �������е����� `cdb_settings`
--

INSERT INTO cdb_settings VALUES ('adminipaccess', '');
INSERT INTO cdb_settings VALUES ('archiverstatus', '1');
INSERT INTO cdb_settings VALUES ('attachimgpost', '1');
INSERT INTO cdb_settings VALUES ('attachrefcheck', '');
INSERT INTO cdb_settings VALUES ('attachsave', '0');
INSERT INTO cdb_settings VALUES ('authkey', 'BBsrBEukdwdbmCV');
INSERT INTO cdb_settings VALUES ('avatarshowdefault', '0');
INSERT INTO cdb_settings VALUES ('avatarshowheight', '200');
INSERT INTO cdb_settings VALUES ('avatarshowlink', '1');
INSERT INTO cdb_settings VALUES ('avatarshowpos', '3');
INSERT INTO cdb_settings VALUES ('avatarshowstatus', '1');
INSERT INTO cdb_settings VALUES ('avatarshowwidth', '135');
INSERT INTO cdb_settings VALUES ('bannedmessages', '1');
INSERT INTO cdb_settings VALUES ('bbclosed', '');
INSERT INTO cdb_settings VALUES ('bbinsert', '1');
INSERT INTO cdb_settings VALUES ('bbname', 'Discuz! Board');
INSERT INTO cdb_settings VALUES ('bbrules', '');
INSERT INTO cdb_settings VALUES ('bbrulestxt', '');
INSERT INTO cdb_settings VALUES ('bdaystatus', '1');
INSERT INTO cdb_settings VALUES ('boardlicensed', '0');
INSERT INTO cdb_settings VALUES ('censoremail', '');
INSERT INTO cdb_settings VALUES ('censoruser', '');
INSERT INTO cdb_settings VALUES ('closedreason', '');
INSERT INTO cdb_settings VALUES ('creditsformula', 'extcredits1');
INSERT INTO cdb_settings VALUES ('creditsformulaexp', '');
INSERT INTO cdb_settings VALUES ('creditsnotify', '');
INSERT INTO cdb_settings VALUES ('creditspolicy', 'a:7:{s:4:"post";a:0:{}s:5:"reply";a:0:{}s:6:"digest";a:1:{i:1;i:10;}s:10:"postattach";a:0:{}s:9:"getattach";a:0:{}s:2:"pm";a:0:{}s:6:"search";a:0:{}}');
INSERT INTO cdb_settings VALUES ('creditstax', '0.2');
INSERT INTO cdb_settings VALUES ('creditstrans', '0');
INSERT INTO cdb_settings VALUES ('custombackup', '');
INSERT INTO cdb_settings VALUES ('dateformat', 'Y-n-j');
INSERT INTO cdb_settings VALUES ('debug', '1');
INSERT INTO cdb_settings VALUES ('delayviewcount', '0');
INSERT INTO cdb_settings VALUES ('deletereason', '');
INSERT INTO cdb_settings VALUES ('dotfolders', '');
INSERT INTO cdb_settings VALUES ('doublee', '1');
INSERT INTO cdb_settings VALUES ('dupkarmarate', '0');
INSERT INTO cdb_settings VALUES ('ec_account', '');
INSERT INTO cdb_settings VALUES ('ec_maxcredits', '1000');
INSERT INTO cdb_settings VALUES ('ec_maxcreditspermonth', '0');
INSERT INTO cdb_settings VALUES ('ec_mincredits', '0');
INSERT INTO cdb_settings VALUES ('ec_ratio', '0');
INSERT INTO cdb_settings VALUES ('ec_securitycode', '');
INSERT INTO cdb_settings VALUES ('editedby', '1');
INSERT INTO cdb_settings VALUES ('edittimelimit', '');
INSERT INTO cdb_settings VALUES ('exchangemincredits', '100');
INSERT INTO cdb_settings VALUES ('extcredits', 'a:2:{i:1;a:3:{s:5:"title";s:4:"����";s:12:"showinthread";s:0:"";s:9:"available";i:1;}i:2;a:3:{s:5:"title";s:4:"��Ǯ";s:12:"showinthread";s:0:"";s:9:"available";i:1;}}');
INSERT INTO cdb_settings VALUES ('fastpost', '1');
INSERT INTO cdb_settings VALUES ('floodctrl', '15');
INSERT INTO cdb_settings VALUES ('forumjump', '1');
INSERT INTO cdb_settings VALUES ('fullmytopics', '1');
INSERT INTO cdb_settings VALUES ('globalstick', '0');
INSERT INTO cdb_settings VALUES ('gzipcompress', '');
INSERT INTO cdb_settings VALUES ('hideprivate', '1');
INSERT INTO cdb_settings VALUES ('hottopic', '10');
INSERT INTO cdb_settings VALUES ('initcredits', '0,0,0,0,0,0,0,0,0');
INSERT INTO cdb_settings VALUES ('ipaccess', '');
INSERT INTO cdb_settings VALUES ('ipregctrl', '');
INSERT INTO cdb_settings VALUES ('jscachelife', '1800');
INSERT INTO cdb_settings VALUES ('jsrefdomains', '');
INSERT INTO cdb_settings VALUES ('jsstatus', '0');
INSERT INTO cdb_settings VALUES ('karmaratelimit', '0');
INSERT INTO cdb_settings VALUES ('loadctrl', '');
INSERT INTO cdb_settings VALUES ('losslessdel', '365');
INSERT INTO cdb_settings VALUES ('maxavatarpixel', '120');
INSERT INTO cdb_settings VALUES ('maxavatarsize', '20000');
INSERT INTO cdb_settings VALUES ('maxchargespan', '0');
INSERT INTO cdb_settings VALUES ('maxincperthread', '0');
INSERT INTO cdb_settings VALUES ('maxmodworksmonths', '3');
INSERT INTO cdb_settings VALUES ('maxonlines', '5000');
INSERT INTO cdb_settings VALUES ('maxpolloptions', '10');
INSERT INTO cdb_settings VALUES ('maxpostsize', '10000');
INSERT INTO cdb_settings VALUES ('maxsearchresults', '500');
INSERT INTO cdb_settings VALUES ('maxsigrows', '20');
INSERT INTO cdb_settings VALUES ('maxsmilies', '3');
INSERT INTO cdb_settings VALUES ('maxspm', '0');
INSERT INTO cdb_settings VALUES ('maxthreadads', '0');
INSERT INTO cdb_settings VALUES ('membermaxpages', '100');
INSERT INTO cdb_settings VALUES ('memberperpage', '25');
INSERT INTO cdb_settings VALUES ('memliststatus', '1');
INSERT INTO cdb_settings VALUES ('minpostsize', '0');
INSERT INTO cdb_settings VALUES ('moddisplay', 'flat');
INSERT INTO cdb_settings VALUES ('modratelimit', '0');
INSERT INTO cdb_settings VALUES ('modreasons', '���/SPAM\r\n�����ˮ\r\nΥ������\r\n�Ĳ�����\r\n�ظ�����\r\n\r\n�Һ���ͬ\r\n��Ʒ����\r\nԭ������');
INSERT INTO cdb_settings VALUES ('modworkstatus', '0');
INSERT INTO cdb_settings VALUES ('newbiespan', '0');
INSERT INTO cdb_settings VALUES ('newsletter', '');
INSERT INTO cdb_settings VALUES ('nocacheheaders', '');
INSERT INTO cdb_settings VALUES ('oltimespan', '10');
INSERT INTO cdb_settings VALUES ('onlinerecord', '1	1040034649');
INSERT INTO cdb_settings VALUES ('passport_expire', '3600');
INSERT INTO cdb_settings VALUES ('passport_extcredits', '0');
INSERT INTO cdb_settings VALUES ('passport_key', '');
INSERT INTO cdb_settings VALUES ('passport_login_url', '');
INSERT INTO cdb_settings VALUES ('passport_logout_url', '');
INSERT INTO cdb_settings VALUES ('passport_register_url', '');
INSERT INTO cdb_settings VALUES ('passport_status', '');
INSERT INTO cdb_settings VALUES ('passport_url', '');
INSERT INTO cdb_settings VALUES ('postbanperiods', '');
INSERT INTO cdb_settings VALUES ('postmodperiods', '');
INSERT INTO cdb_settings VALUES ('postperpage', '10');
INSERT INTO cdb_settings VALUES ('pvfrequence', '60');
INSERT INTO cdb_settings VALUES ('qihoo_adminemail', '');
INSERT INTO cdb_settings VALUES ('qihoo_keywords', '');
INSERT INTO cdb_settings VALUES ('qihoo_maxtopics', '10');
INSERT INTO cdb_settings VALUES ('qihoo_relatedthreads', '5');
INSERT INTO cdb_settings VALUES ('qihoo_summary', '1');
INSERT INTO cdb_settings VALUES ('qihoo_searchbox', '0');
INSERT INTO cdb_settings VALUES ('qihoo_status', '0');
INSERT INTO cdb_settings VALUES ('qihoo_topics', '');
INSERT INTO cdb_settings VALUES ('qihoo_validity', '1');
INSERT INTO cdb_settings VALUES ('regctrl', '0');
INSERT INTO cdb_settings VALUES ('regfloodctrl', '0');
INSERT INTO cdb_settings VALUES ('regstatus', '1');
INSERT INTO cdb_settings VALUES ('regverify', '0');
INSERT INTO cdb_settings VALUES ('reportpost', '1');
INSERT INTO cdb_settings VALUES ('rssstatus', '1');
INSERT INTO cdb_settings VALUES ('rssttl', '60');
INSERT INTO cdb_settings VALUES ('searchbanperiods', '');
INSERT INTO cdb_settings VALUES ('searchctrl', '30');
INSERT INTO cdb_settings VALUES ('seccodestatus', '0');
INSERT INTO cdb_settings VALUES ('seodescription', '');
INSERT INTO cdb_settings VALUES ('seohead', '');
INSERT INTO cdb_settings VALUES ('seokeywords', '');
INSERT INTO cdb_settings VALUES ('seotitle', '');
INSERT INTO cdb_settings VALUES ('showemail', '');
INSERT INTO cdb_settings VALUES ('sitename', 'Comsenz Inc.');
INSERT INTO cdb_settings VALUES ('siteurl', 'http://www.comsenz.com/');
INSERT INTO cdb_settings VALUES ('smcols', '3');
INSERT INTO cdb_settings VALUES ('smileyinsert', '1');
INSERT INTO cdb_settings VALUES ('starthreshold', '2');
INSERT INTO cdb_settings VALUES ('statscachelife', '180');
INSERT INTO cdb_settings VALUES ('statstatus', '');
INSERT INTO cdb_settings VALUES ('styleid', '1');
INSERT INTO cdb_settings VALUES ('stylejump', '0');
INSERT INTO cdb_settings VALUES ('subforumsindex', '');
INSERT INTO cdb_settings VALUES ('threadmaxpages', '1000');
INSERT INTO cdb_settings VALUES ('timeformat', 'h:i A');
INSERT INTO cdb_settings VALUES ('timeoffset', '8');
INSERT INTO cdb_settings VALUES ('topicperpage', '20');
INSERT INTO cdb_settings VALUES ('transfermincredits', '1000');
INSERT INTO cdb_settings VALUES ('transsidstatus', '0');
INSERT INTO cdb_settings VALUES ('userstatusby', '1');
INSERT INTO cdb_settings VALUES ('visitbanperiods', '');
INSERT INTO cdb_settings VALUES ('visitedforums', '10');
INSERT INTO cdb_settings VALUES ('vtonlinestatus', '1');
INSERT INTO cdb_settings VALUES ('wapcharset', '2');
INSERT INTO cdb_settings VALUES ('wapdateformat', 'n/j');
INSERT INTO cdb_settings VALUES ('wapmps', '500');
INSERT INTO cdb_settings VALUES ('wapppp', '5');
INSERT INTO cdb_settings VALUES ('wapstatus', '1');
INSERT INTO cdb_settings VALUES ('waptpp', '10');
INSERT INTO cdb_settings VALUES ('watermarkstatus', '0');
INSERT INTO cdb_settings VALUES ('watermarktrans', '65');
INSERT INTO cdb_settings VALUES ('welcomemsg', '');
INSERT INTO cdb_settings VALUES ('welcomemsgtxt', '');
INSERT INTO cdb_settings VALUES ('whosonlinestatus', '1');
INSERT INTO cdb_settings VALUES ('rewritestatus', '0');
INSERT INTO cdb_settings VALUES ('watermarkquality', '80');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_smilies`
--

DROP TABLE IF EXISTS cdb_smilies;
CREATE TABLE cdb_smilies (
  id smallint(6) unsigned NOT NULL auto_increment,
  displayorder tinyint(1) NOT NULL default '0',
  `type` enum('smiley','icon') NOT NULL default 'smiley',
  `code` varchar(30) NOT NULL default '',
  url varchar(30) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- �������е����� `cdb_smilies`
--

INSERT INTO cdb_smilies VALUES (1, 0, 'smiley', ':)', 'smile.gif');
INSERT INTO cdb_smilies VALUES (2, 0, 'smiley', ':(', 'sad.gif');
INSERT INTO cdb_smilies VALUES (3, 0, 'smiley', ':D', 'biggrin.gif');
INSERT INTO cdb_smilies VALUES (4, 0, 'smiley', ':''(', 'cry.gif');
INSERT INTO cdb_smilies VALUES (5, 0, 'smiley', ':@', 'huffy.gif');
INSERT INTO cdb_smilies VALUES (6, 0, 'smiley', ':o', 'shocked.gif');
INSERT INTO cdb_smilies VALUES (7, 0, 'smiley', ':P', 'tongue.gif');
INSERT INTO cdb_smilies VALUES (8, 0, 'smiley', ':$', 'shy.gif');
INSERT INTO cdb_smilies VALUES (9, 0, 'smiley', ';P', 'titter.gif');
INSERT INTO cdb_smilies VALUES (10, 0, 'smiley', ':L', 'sweat.gif');
INSERT INTO cdb_smilies VALUES (11, 0, 'smiley', ':Q', 'mad.gif');
INSERT INTO cdb_smilies VALUES (12, 0, 'smiley', ':lol', 'lol.gif');
INSERT INTO cdb_smilies VALUES (13, 0, 'smiley', ':hug:', 'hug.gif');
INSERT INTO cdb_smilies VALUES (14, 0, 'smiley', ':victory:', 'victory.gif');
INSERT INTO cdb_smilies VALUES (15, 0, 'smiley', ':time:', 'time.gif');
INSERT INTO cdb_smilies VALUES (16, 0, 'smiley', ':kiss:', 'kiss.gif');
INSERT INTO cdb_smilies VALUES (17, 0, 'smiley', ':handshake', 'handshake.gif');
INSERT INTO cdb_smilies VALUES (18, 0, 'smiley', ':call:', 'call.gif');
INSERT INTO cdb_smilies VALUES (19, 0, 'icon', '', 'icon1.gif');
INSERT INTO cdb_smilies VALUES (20, 0, 'icon', '', 'icon2.gif');
INSERT INTO cdb_smilies VALUES (21, 0, 'icon', '', 'icon3.gif');
INSERT INTO cdb_smilies VALUES (22, 0, 'icon', '', 'icon4.gif');
INSERT INTO cdb_smilies VALUES (23, 0, 'icon', '', 'icon5.gif');
INSERT INTO cdb_smilies VALUES (24, 0, 'icon', '', 'icon6.gif');
INSERT INTO cdb_smilies VALUES (25, 0, 'icon', '', 'icon7.gif');
INSERT INTO cdb_smilies VALUES (26, 0, 'icon', '', 'icon8.gif');
INSERT INTO cdb_smilies VALUES (27, 0, 'icon', '', 'icon9.gif');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_stats`
--

DROP TABLE IF EXISTS cdb_stats;
CREATE TABLE cdb_stats (
  `type` char(10) NOT NULL default '',
  variable char(10) NOT NULL default '',
  count int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`type`,variable)
) TYPE=MyISAM;

--
-- �������е����� `cdb_stats`
--

INSERT INTO cdb_stats VALUES ('total', 'hits', 1);
INSERT INTO cdb_stats VALUES ('total', 'members', 0);
INSERT INTO cdb_stats VALUES ('total', 'guests', 1);
INSERT INTO cdb_stats VALUES ('os', 'Windows', 1);
INSERT INTO cdb_stats VALUES ('os', 'Mac', 0);
INSERT INTO cdb_stats VALUES ('os', 'Linux', 0);
INSERT INTO cdb_stats VALUES ('os', 'FreeBSD', 0);
INSERT INTO cdb_stats VALUES ('os', 'SunOS', 0);
INSERT INTO cdb_stats VALUES ('os', 'OS/2', 0);
INSERT INTO cdb_stats VALUES ('os', 'AIX', 0);
INSERT INTO cdb_stats VALUES ('os', 'Spiders', 0);
INSERT INTO cdb_stats VALUES ('os', 'Other', 0);
INSERT INTO cdb_stats VALUES ('browser', 'MSIE', 1);
INSERT INTO cdb_stats VALUES ('browser', 'Netscape', 0);
INSERT INTO cdb_stats VALUES ('browser', 'Mozilla', 0);
INSERT INTO cdb_stats VALUES ('browser', 'Lynx', 0);
INSERT INTO cdb_stats VALUES ('browser', 'Opera', 0);
INSERT INTO cdb_stats VALUES ('browser', 'Konqueror', 0);
INSERT INTO cdb_stats VALUES ('browser', 'Other', 0);
INSERT INTO cdb_stats VALUES ('week', '0', 0);
INSERT INTO cdb_stats VALUES ('week', '1', 1);
INSERT INTO cdb_stats VALUES ('week', '2', 0);
INSERT INTO cdb_stats VALUES ('week', '3', 0);
INSERT INTO cdb_stats VALUES ('week', '4', 0);
INSERT INTO cdb_stats VALUES ('week', '5', 0);
INSERT INTO cdb_stats VALUES ('week', '6', 0);
INSERT INTO cdb_stats VALUES ('hour', '00', 0);
INSERT INTO cdb_stats VALUES ('hour', '01', 0);
INSERT INTO cdb_stats VALUES ('hour', '02', 0);
INSERT INTO cdb_stats VALUES ('hour', '03', 0);
INSERT INTO cdb_stats VALUES ('hour', '04', 0);
INSERT INTO cdb_stats VALUES ('hour', '05', 0);
INSERT INTO cdb_stats VALUES ('hour', '06', 0);
INSERT INTO cdb_stats VALUES ('hour', '07', 0);
INSERT INTO cdb_stats VALUES ('hour', '08', 0);
INSERT INTO cdb_stats VALUES ('hour', '09', 0);
INSERT INTO cdb_stats VALUES ('hour', '10', 1);
INSERT INTO cdb_stats VALUES ('hour', '11', 0);
INSERT INTO cdb_stats VALUES ('hour', '12', 0);
INSERT INTO cdb_stats VALUES ('hour', '13', 0);
INSERT INTO cdb_stats VALUES ('hour', '14', 0);
INSERT INTO cdb_stats VALUES ('hour', '15', 0);
INSERT INTO cdb_stats VALUES ('hour', '16', 0);
INSERT INTO cdb_stats VALUES ('hour', '17', 0);
INSERT INTO cdb_stats VALUES ('hour', '18', 0);
INSERT INTO cdb_stats VALUES ('hour', '19', 0);
INSERT INTO cdb_stats VALUES ('hour', '20', 0);
INSERT INTO cdb_stats VALUES ('hour', '21', 0);
INSERT INTO cdb_stats VALUES ('hour', '22', 0);
INSERT INTO cdb_stats VALUES ('hour', '23', 0);

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_statvars`
--

DROP TABLE IF EXISTS cdb_statvars;
CREATE TABLE cdb_statvars (
  `type` varchar(20) NOT NULL default '',
  variable varchar(20) NOT NULL default '',
  `value` mediumtext NOT NULL,
  PRIMARY KEY  (`type`,variable)
) TYPE=MyISAM;

--
-- �������е����� `cdb_statvars`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_styles`
--

DROP TABLE IF EXISTS cdb_styles;
CREATE TABLE cdb_styles (
  styleid smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  available tinyint(1) NOT NULL default '1',
  templateid smallint(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (styleid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_styles`
--

INSERT INTO cdb_styles VALUES (1, 'Ĭ�Ϸ��', 1, 1);

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_stylevars`
--

DROP TABLE IF EXISTS cdb_stylevars;
CREATE TABLE cdb_stylevars (
  stylevarid smallint(6) unsigned NOT NULL auto_increment,
  styleid smallint(6) unsigned NOT NULL default '0',
  variable text NOT NULL,
  substitute text NOT NULL,
  PRIMARY KEY  (stylevarid),
  KEY styleid (styleid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_stylevars`
--

INSERT INTO cdb_stylevars VALUES (1, 1, 'bgcolor', '#9EB6D8');
INSERT INTO cdb_stylevars VALUES (2, 1, 'altbg1', '#F8F8F8');
INSERT INTO cdb_stylevars VALUES (3, 1, 'altbg2', '#FFFFFF');
INSERT INTO cdb_stylevars VALUES (4, 1, 'link', '#003366');
INSERT INTO cdb_stylevars VALUES (5, 1, 'bordercolor', '#698CC3');
INSERT INTO cdb_stylevars VALUES (6, 1, 'headercolor', '#698CC3');
INSERT INTO cdb_stylevars VALUES (7, 1, 'headertext', '#FFFFFF');
INSERT INTO cdb_stylevars VALUES (8, 1, 'catcolor', '#EFEFEF');
INSERT INTO cdb_stylevars VALUES (9, 1, 'tabletext', '#000000');
INSERT INTO cdb_stylevars VALUES (10, 1, 'text', '#000000');
INSERT INTO cdb_stylevars VALUES (11, 1, 'borderwidth', '1');
INSERT INTO cdb_stylevars VALUES (12, 1, 'tablewidth', '98%');
INSERT INTO cdb_stylevars VALUES (13, 1, 'tablespace', '4');
INSERT INTO cdb_stylevars VALUES (14, 1, 'font', 'Tahoma, Verdana');
INSERT INTO cdb_stylevars VALUES (15, 1, 'fontsize', '12px');
INSERT INTO cdb_stylevars VALUES (16, 1, 'msgfontsize', '12px');
INSERT INTO cdb_stylevars VALUES (17, 1, 'nobold', '0');
INSERT INTO cdb_stylevars VALUES (18, 1, 'boardimg', 'logo.gif');
INSERT INTO cdb_stylevars VALUES (19, 1, 'imgdir', 'images/default');
INSERT INTO cdb_stylevars VALUES (20, 1, 'smdir', 'images/smilies');
INSERT INTO cdb_stylevars VALUES (21, 1, 'cattext', '#000000');
INSERT INTO cdb_stylevars VALUES (22, 1, 'smfontsize', '11px');
INSERT INTO cdb_stylevars VALUES (23, 1, 'smfont', 'Arial, Tahoma');
INSERT INTO cdb_stylevars VALUES (25, 1, 'maintablewidth', '98%');
INSERT INTO cdb_stylevars VALUES (26, 1, 'maintablecolor', '#FFFFFF');
INSERT INTO cdb_stylevars VALUES (27, 1, 'innerborderwidth', '1');
INSERT INTO cdb_stylevars VALUES (28, 1, 'innerbordercolor', '#D6E0EF');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_subscriptions`
--

DROP TABLE IF EXISTS cdb_subscriptions;
CREATE TABLE cdb_subscriptions (
  uid mediumint(8) unsigned NOT NULL default '0',
  tid mediumint(8) unsigned NOT NULL default '0',
  lastpost int(10) unsigned NOT NULL,
  lastnotify int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (tid,uid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_subscriptions`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_templates`
--

DROP TABLE IF EXISTS cdb_templates;
CREATE TABLE cdb_templates (
  templateid smallint(6) unsigned NOT NULL auto_increment,
  name varchar(30) NOT NULL default '',
  `directory` varchar(100) NOT NULL default '',
  copyright varchar(100) NOT NULL default '',
  PRIMARY KEY  (templateid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_templates`
--

INSERT INTO cdb_templates VALUES (1, 'Ĭ��ģ����ϵ', './templates/default', '������ʢ���ͿƼ����޹�˾');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_threads`
--

DROP TABLE IF EXISTS cdb_threads;
CREATE TABLE cdb_threads (
  tid mediumint(8) unsigned NOT NULL auto_increment,
  fid smallint(6) unsigned NOT NULL default '0',
  iconid smallint(6) unsigned NOT NULL default '0',
  typeid smallint(6) unsigned NOT NULL default '0',
  readperm tinyint(3) unsigned NOT NULL default '0',
  price smallint(6) NOT NULL default '0',
  author char(15) NOT NULL default '',
  authorid mediumint(8) unsigned NOT NULL default '0',
  `subject` char(80) NOT NULL default '',
  dateline int(10) unsigned NOT NULL default '0',
  lastpost int(10) unsigned NOT NULL default '0',
  lastposter char(15) NOT NULL default '',
  views int(10) unsigned NOT NULL default '0',
  replies mediumint(8) unsigned NOT NULL default '0',
  displayorder tinyint(1) NOT NULL default '0',
  highlight tinyint(1) NOT NULL default '0',
  digest tinyint(1) NOT NULL default '0',
  rate tinyint(1) NOT NULL default '0',
  blog tinyint(1) NOT NULL default '0',
  poll tinyint(1) NOT NULL default '0',
  attachment tinyint(1) NOT NULL default '0',
  subscribed tinyint(1) NOT NULL,
  moderated tinyint(1) NOT NULL default '0',
  closed mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (tid),
  KEY digest (digest),
  KEY displayorder (fid,displayorder,lastpost),
  KEY blog (blog,authorid,dateline),
  KEY typeid (fid,typeid,displayorder,lastpost)
) TYPE=MyISAM;

--
-- �������е����� `cdb_threads`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_threadsmod`
--

DROP TABLE IF EXISTS cdb_threadsmod;
CREATE TABLE cdb_threadsmod (
  tid mediumint(8) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL default '0',
  username char(15) NOT NULL default '',
  dateline int(10) unsigned NOT NULL default '0',
  expiration int(10) unsigned NOT NULL default '0',
  `action` char(3) NOT NULL default '',
  `status` tinyint(1) NOT NULL default '0',
  KEY tid (tid,dateline),
  KEY expiration (expiration,`status`)
) TYPE=MyISAM;

--
-- �������е����� `cdb_threadsmod`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_threadtypes`
--

DROP TABLE IF EXISTS cdb_threadtypes;
CREATE TABLE cdb_threadtypes (
  typeid smallint(6) unsigned NOT NULL auto_increment,
  displayorder tinyint(3) NOT NULL default '0',
  name varchar(255) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  PRIMARY KEY  (typeid)
) TYPE=MyISAM;

--
-- �������е����� `cdb_threadtypes`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_usergroups`
--

DROP TABLE IF EXISTS cdb_usergroups;
CREATE TABLE cdb_usergroups (
  groupid smallint(6) unsigned NOT NULL auto_increment,
  radminid tinyint(3) NOT NULL default '0',
  `type` enum('system','special','member') NOT NULL default 'member',
  system char(8) NOT NULL default 'private',
  grouptitle char(30) NOT NULL default '',
  creditshigher int(10) NOT NULL default '0',
  creditslower int(10) NOT NULL default '0',
  stars tinyint(3) NOT NULL default '0',
  color char(7) NOT NULL default '',
  groupavatar char(60) NOT NULL default '',
  readaccess tinyint(3) unsigned NOT NULL default '0',
  allowvisit tinyint(1) NOT NULL default '0',
  allowpost tinyint(1) NOT NULL default '0',
  allowreply tinyint(1) NOT NULL default '0',
  allowpostpoll tinyint(1) NOT NULL default '0',
  allowdirectpost tinyint(1) NOT NULL default '0',
  allowgetattach tinyint(1) NOT NULL default '0',
  allowpostattach tinyint(1) NOT NULL default '0',
  allowvote tinyint(1) NOT NULL default '0',
  allowmultigroups tinyint(1) NOT NULL default '0',
  allowsearch tinyint(1) NOT NULL default '0',
  allowavatar tinyint(1) NOT NULL default '0',
  allowcstatus tinyint(1) NOT NULL default '0',
  allowuseblog tinyint(1) NOT NULL default '0',
  allowinvisible tinyint(1) NOT NULL default '0',
  allowtransfer tinyint(1) NOT NULL default '0',
  allowsetreadperm tinyint(1) NOT NULL default '0',
  allowsetattachperm tinyint(1) NOT NULL default '0',
  allowhidecode tinyint(1) NOT NULL default '0',
  allowhtml tinyint(1) NOT NULL default '0',
  allowcusbbcode tinyint(1) NOT NULL default '0',
  allowanonymous tinyint(1) NOT NULL default '0',
  allownickname tinyint(1) NOT NULL default '0',
  allowsigbbcode tinyint(1) NOT NULL default '0',
  allowsigimgcode tinyint(1) NOT NULL default '0',
  allowviewpro tinyint(1) NOT NULL default '0',
  allowviewstats tinyint(1) NOT NULL default '0',
  disableperiodctrl tinyint(1) NOT NULL default '0',
  reasonpm tinyint(1) NOT NULL default '0',
  maxprice smallint(6) unsigned NOT NULL default '0',
  maxpmnum smallint(6) unsigned NOT NULL default '0',
  maxsigsize smallint(6) unsigned NOT NULL default '0',
  maxattachsize mediumint(8) unsigned NOT NULL default '0',
  maxsizeperday int(10) unsigned NOT NULL default '0',
  attachextensions char(100) NOT NULL default '',
  raterange char(150) NOT NULL default '',
  PRIMARY KEY  (groupid),
  KEY creditsrange (creditshigher,creditslower)
) TYPE=MyISAM;

--
-- �������е����� `cdb_usergroups`
--

INSERT INTO cdb_usergroups VALUES (1, 1, 'system', 'private', '����Ա', 0, 0, 9, '', '', 200, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 30, 200, 500, 2048000, 0, '', '1	-30	30	500');
INSERT INTO cdb_usergroups VALUES (2, 2, 'system', 'private', '��������', 0, 0, 8, '', '', 150, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 20, 120, 300, 2048000, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '1	-15	15	50');
INSERT INTO cdb_usergroups VALUES (3, 3, 'system', 'private', '����', 0, 0, 7, '', '', 100, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 10, 80, 200, 2048000, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '1	-10	10	30');
INSERT INTO cdb_usergroups VALUES (4, 0, 'system', 'private', '��ֹ����', 0, 0, 0, '', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '');
INSERT INTO cdb_usergroups VALUES (5, 0, 'system', 'private', '��ֹ����', 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '');
INSERT INTO cdb_usergroups VALUES (6, 0, 'system', 'private', '��ֹ IP', 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '');
INSERT INTO cdb_usergroups VALUES (7, 0, 'system', 'private', '�ο�', 0, 0, 0, '', '', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '');
INSERT INTO cdb_usergroups VALUES (8, 0, 'system', 'private', '�ȴ���֤��Ա', 0, 0, 0, '', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 50, 0, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '');
INSERT INTO cdb_usergroups VALUES (9, 0, 'member', 'private', '��ؤ', -9999999, 0, 0, '', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '');
INSERT INTO cdb_usergroups VALUES (10, 0, 'member', 'private', '������·', 0, 50, 1, '', '', 10, 1, 1, 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 20, 80, 0, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '');
INSERT INTO cdb_usergroups VALUES (11, 0, 'member', 'private', 'ע���Ա', 50, 200, 2, '', '', 20, 1, 1, 1, 1, 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 30, 100, 0, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '0	-4	4	10');
INSERT INTO cdb_usergroups VALUES (12, 0, 'member', 'private', '�м���Ա', 200, 500, 3, '', '', 30, 1, 1, 1, 1, 0, 1, 0, 1, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 1, 0, 0, 0, 50, 150, 256000, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '0	-6	6	15');
INSERT INTO cdb_usergroups VALUES (13, 0, 'member', 'private', '�߼���Ա', 500, 1000, 4, '', '', 50, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 3, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 60, 200, 512000, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '1	-10	10	30');
INSERT INTO cdb_usergroups VALUES (14, 0, 'member', 'private', '���ƻ�Ա', 1000, 3000, 6, '', '', 70, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 3, 1, 0, 0, 0, 1, 1, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 80, 300, 1024000, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '1	-15	15	40');
INSERT INTO cdb_usergroups VALUES (15, 0, 'member', 'private', '��̳Ԫ��', 3000, 9999999, 8, '', '', 90, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 3, 1, 0, 1, 0, 1, 1, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 100, 500, 2048000, 0, 'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png', '1	-20	20	50');

-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_validating`
--

DROP TABLE IF EXISTS cdb_validating;
CREATE TABLE cdb_validating (
  uid mediumint(8) unsigned NOT NULL default '0',
  submitdate int(10) unsigned NOT NULL default '0',
  moddate int(10) unsigned NOT NULL default '0',
  admin varchar(15) NOT NULL default '',
  submittimes tinyint(3) unsigned NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '0',
  message text NOT NULL,
  remark text NOT NULL,
  PRIMARY KEY  (uid),
  KEY `status` (`status`)
) TYPE=MyISAM;

--
-- �������е����� `cdb_validating`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `cdb_words`
--

DROP TABLE IF EXISTS cdb_words;
CREATE TABLE cdb_words (
  id smallint(6) unsigned NOT NULL auto_increment,
  admin varchar(15) NOT NULL default '',
  find varchar(255) NOT NULL default '',
  replacement varchar(255) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- �������е����� `cdb_words`
--


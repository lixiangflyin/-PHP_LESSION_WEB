<?php

if ( !defined('LOG_ROOT') ) {
    define('LOG_ROOT', '/data/log/csi/');
}


$_IP_CFG = array();

/*评论导入功能*/
$_IP_CFG['Review_IDGenerator'] = "10.180.76.18:10100";
$_IP_CFG['reviewSystem']  = "10.180.76.19:10606";
$_TTC_CFG = array();


########################## DB 配置 #############################
$_DB_CFG = array();


$_DB_CFG['b2b2c_kf_admin'] = array('IP' => '10.152.23.179', 'PORT' => '9007', 'DB' => 'b2b2c_kf_admin', 'USER' => 'root', 'PASSWD' => 'rootcdb');
$_DB_CFG['b2b2c_kf_stat'] = array('IP' => '10.152.23.179', 'PORT' => '9007', 'DB' => 'b2b2c_kf_stat', 'USER' => 'root', 'PASSWD' => 'rootcdb');

//beta环境
//$_DB_CFG['b2b2c_kf_web'] = array('IP' => '10.187.19.247', 'PORT' => '9015', 'DB' => 'b2b2c_kf_web', 'USER' => 'root', 'PASSWD' => 'rootcdb');
//gamma环境
$_DB_CFG['b2b2c_kf_web'] = array('IP' => '10.152.23.179', 'PORT' => '9003', 'DB' => 'b2b2c_kf_web', 'USER' => 'user_icson', 'PASSWD' => 'icson');

######################## Cache 配置 ############################
$_TMEM_CFG = array();
$_TMEM_CFG['service_statistic'] = array(
    'IP' => array(
        '10.191.131.146:9101', 
        '10.191.132.12:9101', 
        '10.191.131.162:9101',
        '10.191.131.147:9101', 
        '10.191.132.11:9101'
    )
);
$_TMEM_CFG['service_center_unread_message'] = array(
    'IP' => array(
        '10.191.131.146:9101',
        '10.191.131.162:9101',
        '10.191.131.147:9101'
    )
);
define('TMEM_BID_SERVICE_STATISTIC', 102030219);
define('TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE', 102030233);

define('WEB_ROOT_URL',		'http://csi.ecc.com/');
define('ICSON_LOGIN_WEB',	'http://login.icson.com/Account/Logon?ReturnUrl=');
define('ICSON_LOGIN_API',	'http://10.179.21.21:53042');
define('COOKIE_SECURE_KEY',	'EFYS@#^&!BSFQD*&');



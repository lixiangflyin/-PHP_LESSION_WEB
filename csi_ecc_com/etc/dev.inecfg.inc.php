<?php

if ( !defined('LOG_ROOT') ) {
    define('LOG_ROOT', '/data/log/csi/');
}


$_IP_CFG = array();


$_TTC_CFG = array();


########################## DB 配置 #############################
$_DB_CFG = array();

$_DB_CFG['b2b2c_kf_web'] = array('IP' => '10.152.23.179', 'PORT' => '9007', 'DB' => 'b2b2c_kf_web', 'USER' => 'root', 'PASSWD' => 'rootcdb');
$_DB_CFG['b2b2c_kf_admin'] = array('IP' => '10.152.23.179', 'PORT' => '9007', 'DB' => 'b2b2c_kf_admin', 'USER' => 'root', 'PASSWD' => 'rootcdb');
$_DB_CFG['b2b2c_kf_stat'] = array('IP' => '10.152.23.179', 'PORT' => '9007', 'DB' => 'b2b2c_kf_stat', 'USER' => 'root', 'PASSWD' => 'rootcdb');

######################## Cache 配置 ############################
$_TMEM_CFG = array();
$_TMEM_CFG['service_center_unread_message'] = array(
		'IP' => '10.136.9.77:9101'
);
$_TMEM_CFG['service_statistic'] = array(
        'IP' => '10.136.9.77:9101'
);
define('TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE', 20120381);
define('TMEM_BID_SERVICE_STATISTIC', 20120381);

define('WEB_ROOT_URL',		'http://csi.ecc.com/');
define('ICSON_LOGIN_WEB',	'http://10.24.68.7:8040/Account/Logon?ReturnUrl=');
define('ICSON_LOGIN_API',	'http://10.24.68.7:8041');
define('COOKIE_SECURE_KEY',	'EFYS@#^&!BSFQD*&');



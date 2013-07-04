<?php

error_reporting(E_ALL ^ E_NOTICE);
@set_magic_quotes_runtime(0);

$magic_quotes_gpc = get_magic_quotes_gpc();
date_default_timezone_set('Asia/Shanghai');

$path_info = pathinfo(__FILE__);
$parent_dir = substr($path_info['dirname'], 0, strrpos($path_info['dirname'], DIRECTORY_SEPARATOR) + 1);

define('ROOT_DIR', $parent_dir);

$new_include = ROOT_DIR . 'lib' . PATH_SEPARATOR . ROOT_DIR . 'etc';
set_include_path(get_include_path() . PATH_SEPARATOR . $new_include);

define('LIB_PATH', ROOT_DIR . 'lib/');
define('API_PATH', ROOT_DIR . 'api/');
define('DAO_PATH', ROOT_DIR . 'dao/');
define('CACHE_PATH', ROOT_DIR . 'cache/');

require_once LIB_PATH . 'Config.php';

require_once LIB_PATH . 'TMAutoload.php';
//TMAutoload::getInstance()->setDirs(array(LIB_PATH, API_PATH, DAO_PATH, ROOT_DIR . 'lib/'))
//    ->setSavePath(CACHE_PATH.'autoload/')->execute();
require_once LIB_PATH . 'Logger.php';

require_once ROOT_DIR . 'inc/constant_web.inc.php';
require_once ROOT_DIR . 'inc/global.func.php';

// 获得 biz名
if (!empty($_REQUEST['biz'])){
	$biz_name =preg_replace("/[^a-zA-Z]/", '',trim($_REQUEST['biz']));
} else {
	$biz_name = 'admin';
}

define('BIZ_API_ROOT', ROOT_DIR . 'api/' . '/');
define('BIZ_MOD_ROOT', ROOT_DIR . 'mod/' . $biz_name . '/');
define('BIZ_INC_ROOT', ROOT_DIR . 'inc/' . $biz_name . '/');
define('BIZ_ETC_ROOT', ROOT_DIR . 'etc/' . $biz_name . '/');
define('BIZ_DAO_ROOT', ROOT_DIR . 'dao/' . $biz_name . '/');
define('BIZ_LIB_ROOT', ROOT_DIR . 'lib/' . $biz_name . '/');


/*
if ($biz_name == 'admin') {
	require_once(BIZ_DAO_ROOT . 'ITransaction.php');
}
*/

if ( !in_array($biz_name, $biz_list, true) || !file_exists(BIZ_MOD_ROOT) ){
	$queryString = $_SERVER['REQUEST_URI'] . '?' . $_SERVER['QUERY_STRING'];
	$referer = empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
	Logger::err('CRI-UNEXPECTED-VISITOR:' . $queryString . '-refer:' . $referer);
	ToolUtil::redirect("http://csi.ecc.com/");
}

// 获得 module名称
if (!empty($_REQUEST['mod'])){
	$mod_name =preg_replace("/[^a-zA-Z]/", '',trim($_REQUEST['mod']));
} else {
	$mod_name = 'main';
}

//业务操作初始化
$biz_initial_file = BIZ_INC_ROOT . 'init.php';
if(file_exists($biz_initial_file))
{
    include $biz_initial_file;
}
include BIZ_INC_ROOT . 'constant_web.inc.php';
$mod_file = BIZ_MOD_ROOT. $mod_name . '.php';

if ( !in_array($mod_name, $mod_list, true) || !file_exists($mod_file) ){
	// 记录访问非法url
	$queryString = $_SERVER['REQUEST_URI'] . '?' . $_SERVER['QUERY_STRING'];
	$referer = empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
	Logger::err('CRI-UNEXPECTED-VISITOR:' . $queryString . '-refer:' . $referer);
	
	ToolUtil::redirect("http://csi.ecc.com/");
}

// 获得 act 名
if (!empty($_REQUEST['act'])){
	$act_name = preg_replace("/[^a-zA-Z0-9]/", '', trim($_REQUEST['act']));
} else {
	$act_name = 'page';
}

$func_name = 'page_' . $mod_name . '_' . $act_name;

require_once $mod_file;

if (!function_exists($func_name)){
	$func_name = $mod_name . '_page';
	if(!function_exists($func_name)){
		$queryString = $_SERVER['REQUEST_URI'] . '?' . $_SERVER['QUERY_STRING'];
		$referer = empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
		Logger::err('CRI-UNEXPECTED-VISITOR:' . $queryString . '-refer:' . $referer);
		ToolUtil::redirect("http://csi.ecc.com/");
	}
}

ToolUtil::noCacheHeader();
$func_name();

<?php

//error_reporting(E_ALL ^ E_NOTICE);

@set_magic_quotes_runtime(0);

$magic_quotes_gpc = get_magic_quotes_gpc();
date_default_timezone_set('Asia/Shanghai');

define("DEFAULT_CACHE_TIME", 300);

$path_info = pathinfo(__FILE__);
$parent_dir = substr($path_info['dirname'], 0, strrpos($path_info['dirname'], DIRECTORY_SEPARATOR) + 1);

define('ROOT_DIR', $parent_dir);

$new_include = ROOT_DIR . 'lib' . PATH_SEPARATOR . ROOT_DIR . 'etc';
set_include_path(get_include_path() . PATH_SEPARATOR . $new_include);

define('LIB_PATH', ROOT_DIR . 'lib/');
define('API_PATH', ROOT_DIR . 'api/');
define('DAO_PATH', ROOT_DIR . 'dao/');
define('CACHE_PATH', ROOT_DIR . 'cache/');

include(ROOT_DIR . 'inc/constant_web.inc.php');
include(LIB_PATH . 'Config.php');
include(API_PATH . 'IUser.php');

IUser::init();
if(!IUser::checkLogin()){
	IUser::loginRedirect();
	return;
}



$menu	= intval($_GET['menu']);
$biz	= trim($_GET['biz']);
$mod	= trim($_GET['mod']);
$act	= trim($_GET['act']);

$frame	= $biz . '/' .$mod . '_' . $act . '.html';
if(!file_exists($frame)){
	exit($frame . ' not exist;');
}
$frame_url = str_replace(array('page.php?menu=2', 'page.php?menu=1'), array('page.php?menu=0', 'page.php?menu=0'), $_SERVER['REQUEST_URI']);

$html = '';
if($menu === 2){
	$html = file_get_contents('admin/page_with_menu.html');
	//$html = str_replace('{frame_url}', $frame_url, $html);
	$html = str_replace('{frame_content}', file_get_contents($frame), $html);
}elseif($menu === 1){
	$html = file_get_contents('admin/page_no_menu.html');
	//$html = str_replace('{frame_url}', $frame_url, $html);
	$html = str_replace('{frame_content}', file_get_contents($frame), $html);
}else{
	$html = file_get_contents($frame);
}

$html = str_replace('{biz}', $biz, $html);
$html = str_replace('{mod}', $mod, $html);
$html = str_replace('{act}', $act, $html);


echo $html;
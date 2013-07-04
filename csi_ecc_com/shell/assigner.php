<?php

error_reporting(E_ALL ^ E_NOTICE);

set_time_limit(60);
date_default_timezone_set('Asia/Shanghai');

$path_info = pathinfo(__FILE__);
$parent_dir = substr($path_info['dirname'], 0, strrpos($path_info['dirname'], DIRECTORY_SEPARATOR) + 1);

define('ROOT_DIR', $parent_dir);

$new_include = ROOT_DIR . 'lib' . PATH_SEPARATOR . ROOT_DIR . 'etc';
set_include_path(get_include_path() . PATH_SEPARATOR . $new_include);

define('LIB_PATH', ROOT_DIR . 'lib/');
define('API_PATH', ROOT_DIR . 'api/');

require_once LIB_PATH . 'Config.php';
require_once LIB_PATH . 'Logger.php';

require ROOT_DIR . 'inc/constant_web.inc.php';
require API_PATH . 'IAssign.php';

//检查完成状态
IAssign::checkAssignedStatus();

//开始分单，一次一单
IAssign::Assign();
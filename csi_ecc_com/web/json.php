<?php

error_reporting(E_ALL ^ E_NOTICE);
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

require_once LIB_PATH . 'Config.php';

require_once LIB_PATH . 'TMAutoload.php';
//TMAutoload::getInstance()->setDirs(array(LIB_PATH, API_PATH, DAO_PATH, ROOT_DIR . 'lib/'))
//    ->setSavePath(CACHE_PATH.'autoload/')->execute();
require_once LIB_PATH . 'Logger.php';

require_once ROOT_DIR . 'inc/constant_web.inc.php';
require_once ROOT_DIR . 'inc/global.func.php';


// 获得 biz 名
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

define('TIMESTAMP', time());

if ( !in_array($biz_name, $biz_list, true) || !file_exists(BIZ_MOD_ROOT) ){
	// 记录访问的 url
	$queryString = $_SERVER['REQUEST_URI'] . '?' . $_SERVER['QUERY_STRING'];
	$referer = empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
	//Logger::err('CRI-UNEXPECTED-VISITOR:' . $queryString . '-refer:' . $referer);
	//ToolUtil::redirect("http://kf.ecc.com/admin/");
	echo $biz_name;
}

// 获得 module 名
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

// 定义输出头的数组(以便 modules 中能够修改)
$wrap_header = array(
	"httpv1_0"	=> "HTTP/1.0 200 OK",
	//"httpv1_1"	=> "HTTP/1.1 200 OK",
	"cache"		=> "Cache-Control: max-age=" . DEFAULT_CACHE_TIME,
	"expires"	=> "Expires: " . gmdate( 'D, d M Y H:i:s', time() + -1) . ' GMT',
	"type"     => "Content-type:text/html; charset=" . (defined('CHARSET') ? CHARSET : 'UTF-8'),
);

if ( !in_array($mod_name, $mod_list, true) || !file_exists($mod_file) ){
	// 记录访问的 url
	//var_dump($mod_list);
}

// 获得 act 名
if (!empty($_REQUEST['act'])){
	$act_name = preg_replace("/[^a-zA-Z0-9]/", '', trim($_REQUEST['act']));
} else {
	$act_name = 'page';
}

$func_name = $mod_name.'_'. $act_name;

require_once $mod_file;


if (!function_exists($func_name)){
	$func_name = $mod_name . '_page';
	if(!function_exists($func_name)){
		$queryString = $_SERVER['REQUEST_URI'] . '?' . $_SERVER['QUERY_STRING'];
		$referer = empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
		Logger::err('CRI-UNEXPECTED-VISITOR:' . $queryString . '-refer:' . $referer);
		ToolUtil::redirect("http://csi.ecc.com/admin/");
	}
}

// 获得 json 字符串(因为函数中可能需要修改 $wrap_header ，所以需要先执行)
if (isset($_GET['jsontype']) && $_GET['jsontype'] === 'str'){
    $json_str = $func_name();
} else if(isset($_GET['jsonchar']) && $_GET['jsonchar'] === 'gbk'){
    $json_str = ToolUtil::gbJsonEncode($func_name());
}else{
	$json_str = json_encode($func_name());
}

// 从全局数组变量中输出 header
if (is_array($wrap_header))
{
    foreach ($wrap_header as $key => $header_line)
    {
        @header($header_line);
    }
}

// 获得请求的回调函数名
$callback_function = (empty($_REQUEST['callback']) || !preg_match("/^[a-zA-Z0-9_$\.]+$/", trim($_REQUEST['callback'])))
    ? '' : trim($_REQUEST['callback']);

$is_json_format = (empty($_REQUEST['fmt']) || !preg_match("/^[0-9]+$/", trim($_REQUEST['fmt'])))
    ? 0 : intval($_REQUEST['fmt']);

// 如果不是iframe方式，输出json信息
if ( $is_json_format == 0 )
{
    if ( empty( $callback_function ) )
    {
        echo $json_str;
    }
    else
    {
		if(isset($_REQUEST['exception'])){
			echo 'try{'."$callback_function($json_str)".';}catch(e){};';
		}
		else{
			echo "$callback_function($json_str);";
		}
    }
}
else
{
	$callback_function = empty($callback_function) ? 'frameElement.callback' : $callback_function;
    echo <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-cn" lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="utf-8" />
<meta name="robots" content="all" />
<meta name="author" content="Tencent-ISRD" />
<meta name="Copyright" content="Tencent" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>腾讯电商统一服务平台</title>
</head>
<body>
<script type="text/javascript">
<!--
document.domain = 'csi.ecc.com';
$callback_function($json_str);
//-->
</script>
</body>
</html>
EOT;
}
?>
<?php
/*
如何取回 Cookie 的值？
PHP 的 $_COOKIE 变量用于取回 cookie 的值。
 */
echo "ZDEDebuggerPresent: " . $_COOKIE["ZDEDebuggerPresent"] . "\r\n";

//输出所有COOKIE
echo "all COOKIE param:\r\n";

//$_COOKIE 就是个数组
foreach ($_COOKIE as $value)
{
	echo $value . "\r\n";
}
?>
<?php
/*
$_GET 变量
$_GET 变量是一个数组，内容是由 HTTP GET 方法发送的变量名称和值。
$_GET 变量用于收集来自 method="get" 的表单中的值。从带有 GET 方法的表单发送的信息，对任何人都是可见的（会显示在浏览器的地址栏），并且对发送的信息量也有限制（最多 100 个字符）。
 用法：$_GET[param],
取出请求的GET参数，如：URL： /loginCheck.php?name=ken&age=18
则 $_GET["name"] = 'ken';
则 $_GET["age"] = "18";
 */
$name = $_GET["name"];
$age = $_GET["age"];
echo "name: " . $_GET["name"] . ",";
echo "age: " . $_GET["age"],"; ";

echo "all GET param: ";

//$_GET 就是个数组
foreach ($_GET as $value)
{
	echo $value . ",";
}
?>
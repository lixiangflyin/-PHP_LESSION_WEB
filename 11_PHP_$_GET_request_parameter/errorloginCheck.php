<?php
/*
$_GET 变量
$_GET 变量是一个数组，内容是由 HTTP GET 方法发送的变量名称和值。
$_GET 变量用于收集来自 method="get" 的表单中的值。从带有 GET 方法的表单发送的信息，对任何人都是可见的（会显示在浏览器的地址栏），并且对发送的信息量也有限制（最多 100 个字符）。
 用法：$_GET[param],
取出请求的GET参数，如：URL： /loginCheck.php?name=&age=18
则 $_GET["name"] = '';
则 $_GET["age"] = "18";

注意了,如果参数name=&age=18,那name的值实际上是空字符串,string(0) ""
 */

function getParam(){
	
	$name = $_GET["name"];//$_GET,$_POST这些变量是全局的
	var_dump($name);//string(0) ""
	
	$age = $_GET["age"];
	var_dump($age);//string(2) "18"
	
}
$name = $_GET["name"];
var_dump($name);//string(0) ""

$age = $_GET["age"];
var_dump($age);//string(2) "18"

getParam();



echo "name: " . $_GET["name"] . ",";
echo "age: " . $_GET["age"],"; ";

echo "all GET param: ";

//$_GET 就是个数组
foreach ($_GET as $value)
{
	echo $value . ",";
}
?>
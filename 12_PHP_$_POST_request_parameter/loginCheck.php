<?php
/*
$_POST 变量
$_POST 变量是一个数组，内容是由 HTTP POST 方法发送的变量名称和值。
$_POST 变量用于收集来自 method="post" 的表单中的值。从带有 POST 方法的表单发送的信息，对任何人都是不可见的（不会显示在浏览器的地址栏），并且对发送信息的量也没有限制。
用法：$_GET[param],
取出请求的GET参数，如：URL： /loginCheck.php?name=ken&age=18
则 $_POST["name"] = 'ken';
则 $_POST["age"] = "18";
 */
echo "name: " . $_POST["name"] . ",";
echo "age: " . $_POST["age"];

echo "all POST param: ";

//$_POST 就是个数组
foreach ($_POST as $value)
{
	echo $value . ",";
}
?>
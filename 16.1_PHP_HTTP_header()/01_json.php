<?php
/**
定义和用法
header() 函数向客户端发送原始的 HTTP 报头。
认识到一点很重要，即必须在任何实际的输出被发送之前调用 header() 函数（在 PHP 4 以及更高的版本中，您可以使用输出缓存来解决此问题）：

语法
header(string,replace,http_response_code)
参数	描述
string	必需。规定要发送的报头字符串。
replace	
可选。指示该报头是否替换之前的报头，或添加第二个报头。
默认是 true（替换）。false（允许相同类型的多个报头）。
http_response_code	可选。把 HTTP 响应代码强制为指定的值。（PHP 4 以及更高版本可用）
 */

header("Content-Type:application/json");

$json = '{"name":"jack","age":18}';

echo $json;
?>
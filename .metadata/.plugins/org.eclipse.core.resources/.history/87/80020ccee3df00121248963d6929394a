<?php
/*
如何创建 cookie？
setcookie() 函数用于设置 cookie。
注释：setcookie() 函数必须位于 <html> 标签之前。
 */
$name = "little_cookie";
$value = "xxx_vale";
$expire = time() + 3600; //超时时间： 3600S 后

//向client浏览器发送 HTTP响应头
//Set-Cookie: little_cookie=xxx_vale; expires=Fri, 28-Jun-2013 12:07:59 GMT

setcookie($name,$value,$expire);

//由于 echo 是向HTTP响应体输出数据，所以setcookie方法要在任意echo前执行，以便生成响应头Set-Cookie
echo "OK";
?>
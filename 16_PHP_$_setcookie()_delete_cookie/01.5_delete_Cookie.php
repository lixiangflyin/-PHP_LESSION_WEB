<?php
/*
如何删除 cookie？
当删除 cookie 时，您应当使过期日期变更为过去的时间点。。
 */

//向client浏览器发送 HTTP响应头
//Set-Cookie: little_cookie=deleted; expires=Thu, 28-Jun-2012 11:23:55 GMT

setcookie("little_cookie","",time() - 3600);

//由于 echo 是向HTTP响应体输出数据，所以setcookie方法要在任意echo前执行，以便生成响应头Set-Cookie
echo "OK";
?>
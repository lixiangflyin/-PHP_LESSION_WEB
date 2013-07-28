<?php
/**
http://www.php.net/manual/zh/function.ob-get-contents.php
注意: ob缓存 实际上只是响应体 的缓存,不缓存header信息
 */
//启用 output buffering
ob_start();

echo 'Hello'; //输出到output buffer
echo 'World';

//返回输出缓冲区的内容
$content = ob_get_contents();//HelloWorld


//清空（擦除）缓冲区并关闭输出缓冲
ob_end_clean();


var_dump($content);
/**
Content-type: text/html

string(10) "HelloWorld"
 */
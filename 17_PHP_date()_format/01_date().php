<?php
/*
PHP Date() 函数
PHP Date() 函数可把时间戳格式化为可读性更好的日期和时间。
语法
date(format,timestamp)
参数	描述
format	必需。规定时间戳的格式。
timestamp	可选。规定时间戳(秒)。默认是当前的日期和时间。
 */
echo "格式化输出当前时间：\r\n";

$time = date("Y/m/d");		//返回的是string类型 (string:10) 2013/06/28
echo $time;
echo "\r\n";

$time = date("Y.m.d");
echo $time;
echo "\r\n";

$time = date("Y-m-d");
echo $time;
echo "\r\n";

/**
格式化输出当前时间：
2013/06/28
2013.06.28
2013-06-28
*/
?>
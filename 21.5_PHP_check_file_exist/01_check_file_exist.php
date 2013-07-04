<?php 
/**
定义和用法
file_exists() 函数检查文件或目录是否存在。
如果指定的文件或目录存在则返回 true，否则返回 false。
语法
file_exists(path)
参数	描述
path	必需。规定要检查的路径。
 */

if(file_exists("welcome.txt")) 
	echo "welcome.txt exist \r\n";
else 
	echo 'welcome.txt not exist!!!';

if(file_exists("notexistfile.txt")) 
	echo 'notexistfile.txt exist';
else 
	echo 'notexistfile.txt not exist!!!';

/**
Content-type: text/html

welcome.txt exist 
notexistfile.txt not exist!!!
*/
?>
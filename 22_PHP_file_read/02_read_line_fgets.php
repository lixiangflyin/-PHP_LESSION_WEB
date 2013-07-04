<?php 
/**
逐行读取文件
fgets() 函数用于从文件中逐行读取文件。
注释：在调用该函数之后，文件指针会移动到下一行。

 */

$file = fopen("welcome.txt",'r'); //只读方式打开文件:	resource (2) of type ("stream")

while(!feof($file))
{
	$line = fgets($file);		//$line: (string:12) 0123456789\r\n
	
	echo $line;
}

fclose($file);		//resource (2) of type ("Unknown")

/**
 * 结果:
Content-type: text/html

0123456789
ABCDEFTGHI
 */
?>
<?php 
/**
逐行读取文件
fgets() 函数用于从文件中逐行读取文件。
注释：在调用该函数之后，文件指针会移动到下一行。

 */

$file = fopen("welcome.txt",'r'); //只读方式打开文件:	resource (2) of type ("stream")

while(!feof($file))
{
	$char = fgetc($file);		//$char: (string:1) A (PHP 里 char 就是长度为1的string)
	
	echo $char . '|';
}

fclose($file);		//resource (2) of type ("Unknown")

/**
 * 结果:
Content-type: text/html

0|1|2|3|4|5|6|7|8|9|
|
|A|B|C|D|E|F|T|G|H|I||
 */
?>
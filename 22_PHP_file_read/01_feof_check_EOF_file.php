<?php 
/**
检测 End-of-file
feof() 函数检测是否已达到文件的末端 (EOF)。
在循环遍历未知长度的数据时，feof() 函数很有用。
注释：在 w 、a 以及 x 模式，您无法读取打开的文件！
 */

$file = fopen("empty_file.txt",'r'); //只读方式成功打开存在的文件: $file: resource (2) of type ("stream")

if(feof($file)) 
	echo 'End of file';		//feof判断是否已经到文件末端

fclose($file);

?>
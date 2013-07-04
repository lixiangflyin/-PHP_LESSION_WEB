<?php
/**
上传限制
在这个脚本中，我们增加了对文件上传的限制。
用户只能上传 .gif 或 .jpeg 文件，文件大小必须小于 20 kb：
 */
if ($_FILES['myfile']['error'] > 0)
{
	echo 'Error: ' . $_FILES['myfile']['error'];
}
else 
{
	if(	
		($_FILES['myfile']['type'] == 'image/gif' 
	  || $_FILES['myfile']['type'] == 'image/jpeg' 
	  || $_FILES['myfile']['type'] == 'image/pjpeg'
	  || $_FILES['myfile']['type'] == 'image/x-png')
		
		&& $_FILES['myfile']['size'] < 20480)
	{	
		echo 'Upload: ' . $_FILES['myfile']['name'] . "\r\n";
		echo 'Type: ' .   $_FILES['myfile']['type'] . "\r\n";
		echo 'Size: ' .   $_FILES['myfile']['size'] . "Bytes\r\n";
		echo 'Stored in: ' . $_FILES['myfile']['tmp_name'] . "\r\n";
	}
	else 
	{
		echo 'invalid file';
	}
}
/**
Content-type: text/html

Upload: ikm_link.png
Type: image/x-png
Size: 7327Bytes
Stored in: F:\opt\tmp\uploadtemp\php1C89.tmp
*/
?>
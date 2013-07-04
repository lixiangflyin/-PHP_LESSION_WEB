<?php
/**
 第一个参数是表单的 input name，第二个下标可以是 "name", "type", "size", "tmp_name" 或 "error"。就像这样：
$_FILES["file"]["name"] - 被上传文件的名称
$_FILES["file"]["type"] - 被上传文件的类型
$_FILES["file"]["size"] - 被上传文件的大小，以字节计
$_FILES["file"]["tmp_name"] - 存储在服务器的文件的临时副本的名称
$_FILES["file"]["error"] - 由文件上传导致的错误代码
这是一种非常简单文件上传方式。基于安全方面的考虑，您应当增加有关什么用户有权上传文件的限制。

$_FILES是一个存在上传的文件信息的数组,
 */
echo "myfile1:\r\n";

if ($_FILES['myfile1']['error'] > 0)
{
	echo 'Error: ' . $_FILES['myfile1']['error'];
}
else 
{
	echo 'Upload: ' . $_FILES['myfile1']['name'] . "\r\n";
	echo 'Type: ' .   $_FILES['myfile1']['type'] . "\r\n";
	echo 'Size: ' .   $_FILES['myfile1']['size'] . "Bytes\r\n";
	echo 'Stored in: ' . $_FILES['myfile1']['tmp_name'] . "\r\n\r\n";
}


echo "myfile2:\r\n";
if ($_FILES['myfile2']['error'] > 0)
{
	echo 'Error: ' . $_FILES['myfile2']['error'];
}
else 
{
	echo 'Upload: ' . $_FILES['myfile2']['name'] . "\r\n";
	echo 'Type: ' .   $_FILES['myfile2']['type'] . "\r\n";
	echo 'Size: ' .   $_FILES['myfile2']['size'] . "Bytes\r\n";
	echo 'Stored in: ' . $_FILES['myfile2']['tmp_name'] . "\r\n";
}
/**
Content-type: text/html

myfile1:
Upload: psb.jpg
Type: image/pjpeg
Size: 251426Bytes
Stored in: F:\opt\tmp\uploadtemp\phpEEB1.tmp

myfile2:
Upload: new  2.txt
Type: text/plain
Size: 439Bytes
Stored in: F:\opt\tmp\uploadtemp\phpEEB2.tmp
*/
?>
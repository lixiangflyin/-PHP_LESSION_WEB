<?php
/**
保存被上传的文件
上面的例子在服务器的 PHP 临时文件夹创建了一个被上传文件的临时副本。

这个临时的复制文件会在脚本结束时消失。

要保存被上传的文件，我们需要把它拷贝到另外的位置：
 */
if ($_FILES['myfile']['error'] > 0)
{
	echo 'Error: ' . $_FILES['myfile']['error'];
}
else 
{
	echo 'Upload: ' . $_FILES['myfile']['name'] . "\r\n";
	echo 'Type: ' .   $_FILES['myfile']['type'] . "\r\n";
	echo 'Size: ' .   $_FILES['myfile']['size'] . "Bytes\r\n";
	echo 'Temp location: ' . $_FILES['myfile']['tmp_name'] . "\r\n";

	$destination = 'upload/' . $_FILES['myfile']['name'];
	
	if(file_exists($destination))
	{
		echo $_FILES['myfile']['name'] . ' already exist!';
	}
	else 
	{
		move_uploaded_file($_FILES['myfile']['tmp_name'], $destination);	
		//注意,这是移动操作,此行执行后,文件会从临时目录剪切到目标位置

		echo 'Stored in: ' . $destination;
	}
}
/**
Content-type: text/html

Upload: new  3.txt
Type: text/plain
Size: 2749Bytes
Temp location: F:\opt\tmp\uploadtemp\phpFC5F.tmp
Stored in: upload/new  3.txt
*/
?>
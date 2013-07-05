<?php
$mysqli = new mysqli('localhost', 'root', 'root', 'phpdb', 3306);

echo '$mysqli->errno : ' . $mysqli->errno;		//没有错误的话,返回0

if($mysqli->errno)
{
	echo 'unable to connect the database: ' . $mysqli->error;
	exit();
}


//关闭数据库连接
$mysqli->close();
?>
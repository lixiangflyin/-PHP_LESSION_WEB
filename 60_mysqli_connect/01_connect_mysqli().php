<?php
$mysqli = new mysqli('localhost', 'root', 'root', 'phpdb', 3306);
//如果这里连接错误,则  Debug Warning: Access denied for user 'root'@'localhost' (using password: YES)


//关闭数据库连接
$mysqli->close();
?>
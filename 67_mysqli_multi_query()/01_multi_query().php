<?php
//$mysqli 在概念上是连接对象
$mysqli = new mysqli('localhost', 'root', 'root', 'phpdb', 3306);


//语句间用;隔开
$query = "INSERT INTO user(id,username,password) VALUES(199,'Lucy','password');"
		."INSERT INTO user(id,username,password) VALUES(198,'Fancy','password');"
		."INSERT INTO user(id,username,password) VALUES(197,'Ben','password')";

$result = $mysqli->multi_query($query);


if($result)
{
	echo '多条语句执行成功!';
}


//关闭数据库连接
$mysqli->close();
?>
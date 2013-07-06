<?php
//$mysqli 在概念上是连接对象
$mysqli = new mysqli('localhost', 'root', 'root', 'phpdb', 3306);

//禁用自动提交功能
$mysqli->autocommit(false);


$query1 = "INSERT INTO user(id,username,password) VALUES(99,'Lucy','password')";

$query2 = "INSERT INTO user(id,username,password) VALUES(98,'Fancy','password')";

$result1 = $mysqli->query($query1);

$result2 = $mysqli->query($query2);

if($result1 && $result2)
{
	//提交事务
	$mysqli->commit();
	echo 'SUCCCESS';
}
else
{
	//回滚事务
	$mysqli->rollback();
	echo 'FAILE';
}

//关闭数据库连接
$mysqli->close();
?>
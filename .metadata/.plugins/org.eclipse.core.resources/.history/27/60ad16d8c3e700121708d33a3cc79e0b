<?php
//$con 在概念上是连接对象
$con = mysqli_connect('localhost', 'root', 'root', 'phpdb', 3306);


//禁用自动提交功能
mysqli_autocommit($con, false);


$query1 = "INSERT INTO user(id,username,password) VALUES(499,'Lucy','password')";

$query2 = "INSERT INTO user(id,username,password) VALUES(499,'Fancy','password')";

$result1 = mysqli_query($con,$query1);

$result2 = mysqli_query($con, $query2);


if($result1 && $result2)
{
	//提交事务
	mysqli_commit($con);
	echo 'SUCCCESS';
}
else
{
	//回滚事务
	mysqli_rollback($con);
	echo 'FAILE';
}


//关闭数据库连接
mysqli_close($con);
?>
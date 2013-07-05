<?php
//$mysqli 在概念上是连接对象
$mysqli = new mysqli('localhost', 'root', 'root', 'phpdb', 3306);


$query = "INSERT INTO user(id,username,password) VALUES(4,'PACK','001')";

$result = $mysqli->query($query);  //DML语句(INSERT,UPDATE,DELETE)执行后,成功返回true,失败返回false,

//解决错误
if(!$result)
{
	echo "Error: [$mysqli->errno],$mysqli->error";
}

if($mysqli->affected_rows > 0)		//DML语句执行后,受影响的行数由 [$mysqli->affected_rows] 返回
{
	echo "$mysqli->affected_rows have been INSERT!";
}


//关闭数据库连接
$mysqli->close();
?>
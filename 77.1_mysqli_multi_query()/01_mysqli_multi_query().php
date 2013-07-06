<?php
//$con 在概念上是连接对象
$con = mysqli_connect('localhost', 'root', 'root', 'phpdb', 3306);


//语句间用;隔开
$query = "INSERT INTO user(id,username,password) VALUES(299,'Lucy','password');"
		."INSERT INTO user(id,username,password) VALUES(298,'Fancy','password');"
		."INSERT INTO user(id,username,password) VALUES(297,'Ben','password')";


$result = mysqli_multi_query($con, $query);


if($result)
{
	echo '多条语句执行成功!';
}


//关闭数据库连接
mysqli_close($con);
?>
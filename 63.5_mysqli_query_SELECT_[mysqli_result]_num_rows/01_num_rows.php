<?php
//$mysqli 在概念上是连接对象
$mysqli = new mysqli('localhost', 'root', 'root', 'phpdb', 3306);


$query = 'SELECT id,username,password FROM user';

//以于查询操作(SELECT),query返回的是结果集[Object of: mysqli_result]
$result = $mysqli->query($query,MYSQLI_STORE_RESULT);//默认resultmode: MYSQLI_STORE_RESULT

$cnt = $result->num_rows;

echo "查询到的行数: $cnt";


//关闭数据库连接
$mysqli->close();
?>
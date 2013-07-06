<?php
//$mysqli 在概念上是连接对象
$mysqli = new mysqli('localhost', 'root', 'root', 'phpdb', 3306);


//创建查询及相应的占位符
$query = "INSERT INTO user(username,password) VALUES(?,?)";


//创建语句对象[mysqli_stmt]
$stmt = $mysqli->prepare($query);


//绑定参数:指定i,d,s,b类型
$stmt->bind_param('ss', $username,$password);  //注意,这里$id,$usename,$password,传的是引用


//操作1:
$username = 'stu5';
$password = '123';

$stmt->execute();		//执行

echo '$stmt->affected_rows: ' . $stmt->affected_rows;
echo '$stmt->insert_id' . $stmt->insert_id;



//操作1:
$username = 'stu6';
$password = '123';

$stmt->execute();

echo '$stmt->affected_rows: ' . $stmt->affected_rows;
echo '$stmt->insert_id' . $stmt->insert_id;



//操作1:
$username = 'stu7';
$password = '123';

$stmt->execute();

echo '$stmt->affected_rows: ' . $stmt->affected_rows;
echo '$stmt->insert_id' . $stmt->insert_id;


//关闭语句对象
$stmt->close();


//关闭数据库连接
$mysqli->close();
?>
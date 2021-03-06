<?php
//$con 在概念上是连接对象
$con = mysqli_connect('localhost', 'root', 'root', 'phpdb', 3306);


//创建查询及相应的占位符
$query = "INSERT INTO user(id,username,password) VALUES(?,?,?)";


//创建语句对象[mysqli_stmt]
$stmt = mysqli_stmt_init($con);

//准备语句
mysqli_stmt_prepare($stmt, $query);



//绑定参数:指定i,d,s,b类型
mysqli_stmt_bind_param($stmt,'iss', $id,$username,$password);  //注意,这里$id,$usename,$password,传的是引用


//操作1:
$id = 5;
$username = 'stu5';
$password = '123';

mysqli_stmt_execute($stmt);		//执行

echo '$stmt->affected_rows: ' . mysqli_stmt_affected_rows($stmt);



//操作1:
$id = 6;
$username = 'stu6';
$password = '123';

mysqli_stmt_execute($stmt);

echo '$stmt->affected_rows: ' . mysqli_stmt_affected_rows($stmt);



//操作1:
$id = 7;
$username = 'stu7';
$password = '123';

mysqli_stmt_execute($stmt);

echo '$stmt->affected_rows: ' . mysqli_stmt_affected_rows($stmt);


//关闭语句对象
mysqli_stmt_close($stmt);


//关闭数据库连接
mysqli_close($con);
?>
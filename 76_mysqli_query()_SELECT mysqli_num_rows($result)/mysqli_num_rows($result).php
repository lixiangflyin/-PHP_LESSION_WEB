<?php
//$con 在概念上是连接对象
$con = mysqli_connect('localhost', 'root', 'root', 'phpdb', 3306);


$query = 'SELECT id,username,password FROM user';


//以于查询操作(SELECT),query返回的是结果集[Object of: mysqli_result]
$result = mysqli_query($con, $query);


//
echo '查询到的行数:' . mysqli_num_rows($result);



//关闭数据库连接
mysqli_close($con);


/**
Content-type: text/html

查询到的行数:13
 */
?>
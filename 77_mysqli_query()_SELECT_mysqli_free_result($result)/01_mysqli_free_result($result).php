<?php
//$con 在概念上是连接对象
$con = mysqli_connect('localhost', 'root', 'root', 'phpdb', 3306);


$query = 'SELECT id,username,password FROM user';


//以于查询操作(SELECT),query返回的是结果集[Object of: mysqli_result]
$result = mysqli_query($con, $query);


while($user = mysqli_fetch_object($result))
{
	echo 'id: ' . $user->id . ',username: ' . $user->username . ',password: ' . $user->password . "\r\n";
}


//mysqli_result 使用完了,可以手动释放内存
mysqli_free_result($result);


//关闭数据库连接
mysqli_close($con);
?>
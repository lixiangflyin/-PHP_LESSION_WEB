<?php
//$con 在概念上是连接对象
$con = mysqli_connect('localhost', 'root', 'root', 'b2b2c_kf_web', 3306);


$query = 'SELECT * FROM `service_apply`';


//以于查询操作(SELECT),query返回的是结果集[Object of: mysqli_result]
$result = mysqli_query($con, $query);

echo memory_get_usage(true)/1024,"KB\r\n";
echo memory_get_peak_usage(true)/1024,"KB\r\n";
/**
512KB
512KB
 */

$rows = array();
while($row = mysqli_fetch_assoc($result))
{
	$rows[] = $row;
}

echo 'rows count: ',count($rows),"\r\n";

//关闭数据库连接
mysqli_close($con);
echo memory_get_usage(true)/1024,"KB\r\n";
echo memory_get_peak_usage(true)/1024,"KB\r\n";

/**
512KB
512KB
rows count: 514
3072KB
3072KB
*/

/**
SQL执行后,mysqli_fetch_assoc执行了,数据才真正
 */
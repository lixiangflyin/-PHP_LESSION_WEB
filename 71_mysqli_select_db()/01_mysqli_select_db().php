<?php
//建立MYSQL连接,成功返回 mysqli 对象,失败返回false
$con = @mysqli_connect('localhost', 'root', 'root');


//选择数据库
mysqli_select_db($con, 'phpdb');


//关闭数据库连接
mysqli_close($con);
?>
<?php
/**
存储 Session 变量
存储和取回 session 变量的正确方法是使用 PHP $_SESSION 变量：

isset() 函数检测是否已设置 "views" 变量。如果已设置 "views" 变量，我们累加计数器。如果 "views" 不存在，则我们创建 "views" 变量，并把它设置为 1：
 */
session_start();

if(isset($_SESSION['view_cnt']))
{
	$_SESSION['view_cnt']++;
}
else
{ 
	$_SESSION['view_cnt'] = 1;
}

echo 'View Count: ' . $_SESSION['view_cnt'];
/** 结果:
Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
Pragma: no-cache
Content-type: text/html

View Count: 4
 */
?>
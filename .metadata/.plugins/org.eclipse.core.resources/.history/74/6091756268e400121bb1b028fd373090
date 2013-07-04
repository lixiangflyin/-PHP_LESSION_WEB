<?php
/**
存储 Session 变量
存储和取回 session 变量的正确方法是使用 PHP $_SESSION 变量：
 */
session_start();//因为请求没有带上PHPSESSID(即没有Session),故新建一个Session,并将PHPSESSID返回给用户浏览器

if(!array_key_exists('view_cnt',$_SESSION))
{
	$_SESSION['view_cnt'] = 1;
}
else
{ 
	$_SESSION['view_cnt']++;
}

echo 'View Count: ' . $_SESSION['view_cnt'];
/** 结果:
Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
Pragma: no-cache
Content-type: text/html

View Count: 4
 */
?>
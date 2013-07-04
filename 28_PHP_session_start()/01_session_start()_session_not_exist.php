<?php
/**
PHP session 变量用于存储有关用户会话的信息，或更改用户会话的设置。Session 变量保存的信息是单一用户的，并且可供应用程序中的所有页面使用。
PHP Session 变量
当您运行一个应用程序时，您会打开它，做些更改，然后关闭它。这很像一次会话。计算机清楚你是谁。它知道你何时启动应用程序，并在何时终止。但是在因特网上，存在一个问题：服务器不知道你是谁以及你做什么，这是由于 HTTP 地址不能维持状态。
通过在服务器上存储用户信息以便随后使用，PHP session 解决了这个问题（比如用户名称、购买商品等）。不过，会话信息是临时的，在用户离开网站后将被删除。如果您需要永久储存信息，可以把数据存储在数据库中。
Session 的工作机制是：为每个访问者创建一个唯一的 id (UID)，并基于这个 UID 来存储变量。UID 存储在 cookie 中，亦或通过 URL 进行传导。
开始 PHP Session
在您把用户信息存储到 PHP session 中之前，首先必须启动会话。
注释：session_start() 函数必须位于 <html> 标签之前：(明显,因为需要返回PHPSESSID的COOKIE信息)
 */
session_start();//因为请求没有带上PHPSESSID(即没有Session),故新建一个Session,并将PHPSESSID返回给用户浏览器

/** 结果:
Set-Cookie: PHPSESSID=e58bd0bb3ef0c27c869a23399b7bc688; path=/
Expires: Thu, 19 Nov 1981 08:52:00 GMT
Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
Pragma: no-cache
Content-type: text/html
 */
?>
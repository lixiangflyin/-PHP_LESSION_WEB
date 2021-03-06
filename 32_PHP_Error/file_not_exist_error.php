<?php
/**
在 PHP 中，默认的错误处理很简单。一条消息会被发送到浏览器，这条消息带有文件名、行号以及一条描述错误的消息。
PHP 错误处理
在创建脚本和 web 应用程序时，错误处理是一个重要的部分。如果您的代码缺少错误检测编码，那么程序看上去很不专业，也为安全风险敞开了大门。
本教程介绍了 PHP 中一些最为重要的错误检测方法。
我们将为您讲解不同的错误处理方法：
简单的 "die()" 语句
自定义错误和错误触发器
错误报告


fopen 只读模式打开不存在的文件,

控制台: Debug Warning: No such file or directory
并且生成HTTP响应:
Content-type: text/html

<br />
<b>Warning</b>:  fopen(not_exist_file.txt) [<a href='function.fopen'>function.fopen</a>]: failed to open stream: No such file or directory in <b>F:\opt\www\32_PHP_Error\file_not_exist_error.php</b> on line <b>3</b><br />


 */
$file = fopen("not_exist_file.txt", 'r');

?>
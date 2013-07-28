<?php
/**
当PHP运行在FastCGI模式时,PHP FPM提供了一个名为fastcgi_finish_request的方法.
按照文档上的说法,此方法可以提高请求的处理速度,如果有些处理可以在页面生成完后再进行,就可以使用这个方法.
 */
echo 'hello';

fastcgi_finish_request();/* 响应完成, 关闭连接 */

sleep(5);

/* 记录日志 */
file_put_contents('log.txt', 'some log' . time());
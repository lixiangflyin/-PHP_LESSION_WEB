<?php
/**
PHP中的at(@)是用于屏蔽错误信息、抑制报错的(如在方法调用时),有时候你希望自己来处理错误，而不是由系统自动处理。


fopen 只读模式打开不存在的文件,

控制台: Debug Warning: No such file or directory
并且生成HTTP响应:
Content-type: text/html

<br />
<b>Warning</b>:  fopen(not_exist_file.txt) [<a href='function.fopen'>function.fopen</a>]: failed to open stream: No such file or directory in <b>F:\opt\www\32_PHP_Error\file_not_exist_error.php</b> on line <b>3</b><br />


使用@屏蔽错误信息后,控制台依然输出Warning信息,但不生成上面的HTTP响应

 */
$file = @fopen("not_exist_file.txt", 'r');			//文件不存在 fopen返回 false

?>
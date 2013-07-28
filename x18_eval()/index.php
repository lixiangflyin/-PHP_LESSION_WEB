<?php
/**
eval执行代码片段或php文件
 */

$title = 'Hello Every One!';
$message = 'Go to School.';

$php_code =
'<?php
echo $title;
echo $message;
?>';

eval('?>' . $php_code);


/**
Content-type: text/html

Hello Every One!Go to School.
 */
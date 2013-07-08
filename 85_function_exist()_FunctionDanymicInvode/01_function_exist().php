<?php
function sayHello()
{
	echo 'hello';
}

$function_name = 'sayHello';

if( function_exists($function_name) )
{
	echo '函数[' . $function_name . '] 存在!';
}
?>
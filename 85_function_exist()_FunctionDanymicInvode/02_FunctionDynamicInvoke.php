<?php
function sayHello()
{
	echo 'hello';
}

$function_name = 'sayHello';

if( function_exists($function_name) )
{
	//动态调用
	$function_name();
}
?>
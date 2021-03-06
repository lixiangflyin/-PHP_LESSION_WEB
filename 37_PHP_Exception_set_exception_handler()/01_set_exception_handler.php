<?php
/*

设置顶层异常处理器 （Top Level Exception Handler）
set_exception_handler() 函数可设置处理所有未捕获异常的用户定义函数。

 */


//顶层异常处理器 
function  myExceptionHandler($e)
{
	echo $e->getMessage();
}

//设置顶层异常处理器
set_exception_handler('myExceptionHandler');



//
$email = 'someone@example...come';


if(filter_var($email,FILTER_VALIDATE_EMAIL) == false )
{
	throw  new Exception("Exception: [$email] format error!", 400);
}


/**
Content-type: text/html

Exception: [someone@example...come] format error!
*/
?>
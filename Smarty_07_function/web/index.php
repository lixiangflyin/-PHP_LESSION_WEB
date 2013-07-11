<?php

require('../libs/Smarty.class.php');

$smarty = new Smarty;

//Smarty3的模板文件里,能直接调用 PHP的函数
function sayHello()
{
	return 'hello';
}

$smarty->display('index.html');
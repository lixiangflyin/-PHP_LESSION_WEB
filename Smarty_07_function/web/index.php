<?php

require('../libs/Smarty.class.php');

$smarty = new Smarty;

//Smarty3��ģ���ļ���,��ֱ�ӵ��� PHP�ĺ���
function sayHello()
{
	return 'hello';
}

$smarty->display('index.html');
<?php

require('../libs/Smarty.class.php');

$smarty = new Smarty;

// 传递键值对
$smarty->assign('title','hello Smarty!');
$smarty->assign('content','Smarty is easy to use!');


// 传递数组
$smarty->assign('user',array('name' => 'jack','age' => 18));

$smarty->display('index.html');
<?php

require('../libs/Smarty.class.php');

$smarty = new Smarty;

// ���ݼ�ֵ��
$smarty->assign('title','hello Smarty!');
$smarty->assign('content','Smarty is easy to use!');


// ��������
$smarty->assign('user',array('name' => 'jack','age' => 18));

$smarty->display('index.html');
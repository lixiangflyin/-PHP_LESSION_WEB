<?php

require('../libs/Smarty.class.php');

$smarty = new Smarty;


$smarty->assign('title','hello');
$smarty->assign('message','Today is good!');


$smarty->display('index.tpl');
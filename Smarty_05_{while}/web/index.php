<?php

require('../libs/Smarty.class.php');

$smarty = new Smarty;


$smarty->assign('count',10);


$smarty->display('index.html');
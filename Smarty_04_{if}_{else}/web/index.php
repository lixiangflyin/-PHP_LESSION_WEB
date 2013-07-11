<?php

require('../libs/Smarty.class.php');

$smarty = new Smarty;


$smarty->assign('random',rand(1, 100));


$smarty->display('index.html');
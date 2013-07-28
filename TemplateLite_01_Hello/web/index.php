<?php

require("../src/class.template.php");
$tpl = new Template_Lite;


$tpl->assign('title','hello');
$tpl->assign('content','Today is good!');


$tpl->display('index.tpl');
<?php

require("../src/class.template.php");
$tpl = new Template_Lite;


$tpl->assign('title','hello');
$tpl->assign('message','Today is good!');


$tpl->display('index.tpl');
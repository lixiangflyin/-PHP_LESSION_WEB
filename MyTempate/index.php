<?php

require("src/MyTemplate.php");
$tpl = new MyTemplate();


$tpl->assign('title','hello');
$tpl->assign('message','Today is good!');


$tpl->display('index.tpl');
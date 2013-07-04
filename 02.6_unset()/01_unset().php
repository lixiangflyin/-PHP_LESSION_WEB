<?php
$hello = 'hello';

unset($hello); //变量$hello被删除(在当前作用域已经不存在$hello此变量)

echo $hello;  //控制台输出: Notice: /02.6_unset()/01_unset().php line 6 - Undefined variable: hello
?>
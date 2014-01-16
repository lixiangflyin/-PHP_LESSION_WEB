<?php
$var = 'Hello';

//
xdebug_debug_zval('var');


$ref = &$var;//这个瞬间,$var 指向的 zval结构体 的 is_ref 变为1

//
xdebug_debug_zval('var');
xdebug_debug_zval('ref');



$ref = 'World';	 //$var 与 $ref 引用同一个zval结构体

//
xdebug_debug_zval('var');
xdebug_debug_zval('ref');
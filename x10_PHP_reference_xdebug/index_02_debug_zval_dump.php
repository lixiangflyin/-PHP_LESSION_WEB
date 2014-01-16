<?php
$var = 100;

//
xdebug_debug_zval('var');

$ref = &$var;

//
xdebug_debug_zval('var');
xdebug_debug_zval('ref');



$ref = 123;	 //$var 与 $ref 引用同一个值

//
xdebug_debug_zval('var');
xdebug_debug_zval('ref');

echo $var;   //

/**
Content-type: text/html

123
 */
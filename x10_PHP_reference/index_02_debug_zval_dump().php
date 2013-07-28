<?php
$var = 100;

//
debug_zval_dump($var);

$ref = &$var;

//
debug_zval_dump($var);
debug_zval_dump($ref);



$ref = 123;	 //$var 与 $ref 引用同一个值

//
debug_zval_dump($var);
debug_zval_dump($ref);

echo $var;   //

/**
Content-type: text/html

123
 */
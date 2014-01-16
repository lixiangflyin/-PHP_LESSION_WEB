<?php

$var = 100;
$ref = &$var;

$ref = 123;	 //$var 与 $ref 引用同一个值

echo $var;   //

/**
Content-type: text/html

123
 */
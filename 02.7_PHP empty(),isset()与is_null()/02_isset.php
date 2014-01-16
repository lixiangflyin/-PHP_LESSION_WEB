<?php

$a;
$e = null;

$b = false;
$c = '';
$d = 0;
$f = array();

var_dump(isset($a));//false
var_dump(isset($e));//false

var_dump(isset($b));//true
var_dump(isset($c));//true
var_dump(isset($d));//true
var_dump(isset($f));//true

/**
可以看出isset()只能用来判断是否为NULL和未定义。
 */
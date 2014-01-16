<?php

$a;
$b = false;
$c = '';
$d = 0;
$e = null;
$f = array();

var_dump(empty($a));
var_dump(empty($b));
var_dump(empty($c));
var_dump(empty($d));
var_dump(empty($e));
var_dump(empty($f));

$array = array('name' => 'asdg');

$age = $array['age'];//如果试图取数组不存在的属性,返回null

var_dump(empty($array['age']));

/**
只要数据类型是否为空或假，empty()就输出true。
结果:全为empty!
Content-type: text/html

bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
 */
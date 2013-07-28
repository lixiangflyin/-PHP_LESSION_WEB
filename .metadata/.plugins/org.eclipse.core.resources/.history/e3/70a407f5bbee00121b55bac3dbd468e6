<?php
var_dump(memory_get_usage());					//int(123872)

$big_array = array_fill(0, 100000, 'blank');

var_dump(memory_get_usage());					//int(5448416)

//写时复制（Copy on Write)
$big_array2 = $big_array;

var_dump(memory_get_usage());					//int(5448464)
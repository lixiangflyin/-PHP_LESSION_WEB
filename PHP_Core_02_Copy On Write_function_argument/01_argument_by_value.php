<?php
//以传值的方式传递一个大数组参数(函数里不修改这个参数)
function output($big_array2)
{
	var_dump(memory_get_usage());					//int(10767552)
	
	debug_zval_dump($big_array2);
}


var_dump(memory_get_usage());					//int(118048)

$big_array = array_fill(0, 100000, 'blank');

var_dump(memory_get_usage());					//int(5442592)

debug_zval_dump($big_array);


output($big_array);

var_dump(memory_get_usage());					//int(5442824)

debug_zval_dump($big_array);
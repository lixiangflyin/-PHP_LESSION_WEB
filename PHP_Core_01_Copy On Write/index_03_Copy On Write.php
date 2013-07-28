<?php
var_dump(memory_get_usage());					//int(124512)

$big_array = array_fill(0, 100000, 'blank');

var_dump(memory_get_usage());					//int(5449064)

//写时复制（Copy on Write)
$big_array2 = $big_array;

var_dump(memory_get_usage());					//int(5449112)


//now write $big_array2
//$big_array2[0] = 'BLANK';
$big_array2[0] = 'blank';					//实际上,即使这"修改"并未改变原值,但在此操作前,一样触发"Copy on Write"
var_dump(memory_get_usage());					//int(10773520)

/**
由于$big_array2 与 $big_array 是array类型,非对象类型
故$big_array2 = $big_array 在语意上是传值(复制的)

但由于"Copy On Write"的作用,这个复制是当$big_array2的值要被修改前才进行复制的

$big_array2[0] = 'BLANK' 将要执行前,$big_array2 马上Copy 一份数据,然后再修改
Copy on Write!
 */
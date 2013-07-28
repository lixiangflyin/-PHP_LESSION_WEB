<?php
//PHP可以指定参数的类型
function array_print(array $arry){
    print_r($arry);
}

$arr = array('abc','def','ghi');

array_print($arr);

array_print(1);
/**
 Notice: 
 Argument 1 passed to array_print() must be of the type array, integer given, 
 */

<?php
/**
is_numeric()，判断是否是⼀个数值或者可转换为数值的字符串
 */
$str = 'hello';
var_dump(is_numeric($str)); 

$num_str = '123';
var_dump(is_numeric($num_str)); 

$num = 123;
var_dump(is_numeric($num)); 


/**
function is_null ($var) {}

function is_resource ($var) {}

function is_bool ($var) {}

function is_long ($var) {}


function is_float ($var) {}


function is_int ($var) {}


function is_integer ($var) {}


function is_double ($var) {}


function is_real ($var) {}


function is_numeric ($var) {}


function is_string ($var) {}

function is_array ($var) {}

function is_object ($var) {}


function is_scalar ($var) {}

function is_callable ($name, $syntax_only = null, &$callable_name = null) {}

**/
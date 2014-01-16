<?php
//Copy On Write 起作用,这里只是简单使zval的refcount +1
function output($array2)
{
	xdebug_debug_zval('array2');
}



$array = array('abc','def','ghi');


xdebug_debug_zval('array');


output($array);


xdebug_debug_zval('array');
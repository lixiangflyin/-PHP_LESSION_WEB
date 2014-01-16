<?php
/**

refcount,和is_ref同时 +1,is_ref=1表示被&强制引用

refcount单独用于引用计数,

变量被&强制引用时,refcount依然会加1,然后is_ref变为1

*/
function output(&$array2)
{
	xdebug_debug_zval('array2');
}



$array = array('abc','def','ghi');


xdebug_debug_zval('array');


output($array);


xdebug_debug_zval('array');

/**
array: 
(refcount=1, is_ref=0),
array (size=3)
  0 => (refcount=1, is_ref=0),string 'abc' (length=3)
  1 => (refcount=1, is_ref=0),string 'def' (length=3)
  2 => (refcount=1, is_ref=0),string 'ghi' (length=3)

array2: 
(refcount=3, is_ref=1),
array (size=3)
  0 => (refcount=1, is_ref=0),string 'abc' (length=3)
  1 => (refcount=1, is_ref=0),string 'def' (length=3)
  2 => (refcount=1, is_ref=0),string 'ghi' (length=3)

array: 
(refcount=1, is_ref=0),
array (size=3)
  0 => (refcount=1, is_ref=0),string 'abc' (length=3)
  1 => (refcount=1, is_ref=0),string 'def' (length=3)
  2 => (refcount=1, is_ref=0),string 'ghi' (length=3)


 */
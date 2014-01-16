<?php

$array = array('php-internal_1','php-internal_2','php-internal_3');

xdebug_debug_zval('array');

echo "--------------------------------------------\r\n";

//写时复制（Copy on Write) zval 的 refcount+1
$array2 = $array;

xdebug_debug_zval('array');
xdebug_debug_zval('array2');

echo "--------------------------------------------\r\n";
/**
COW的粒度为zval结构，由PHP中变量全部基于zval，所以COW的作用范围是全部的变量，⽽对于
zval结构体组成的集合（如数组和对象等）， 在需要复制内存时，将复杂对象分解为最⼩粒度来处
理。这样可以使内存中复杂对象中某⼀部分做修改时， 不必将该对象的所有元素全部“分离复制”出
⼀份内存拷贝
 */
//这里发生复制分离,但只是被修改部分需要分离,未修改部分变为引用
$array2[2] = 'php-internal_4';

xdebug_debug_zval('array');
xdebug_debug_zval('array2');

/**
array: 
(refcount=1, is_ref=0),
array (size=3)
  0 => (refcount=1, is_ref=0),string 'php-internal_1' (length=14)
  1 => (refcount=1, is_ref=0),string 'php-internal_2' (length=14)
  2 => (refcount=1, is_ref=0),string 'php-internal_3' (length=14)

-------------------------------------------- array: 
(refcount=2, is_ref=0),
array (size=3)
  0 => (refcount=1, is_ref=0),string 'php-internal_1' (length=14)
  1 => (refcount=1, is_ref=0),string 'php-internal_2' (length=14)
  2 => (refcount=1, is_ref=0),string 'php-internal_3' (length=14)

array2: 
(refcount=2, is_ref=0),
array (size=3)
  0 => (refcount=1, is_ref=0),string 'php-internal_1' (length=14)
  1 => (refcount=1, is_ref=0),string 'php-internal_2' (length=14)
  2 => (refcount=1, is_ref=0),string 'php-internal_3' (length=14)

-------------------------------------------- array: 
(refcount=1, is_ref=0),
array (size=3)
  0 => (refcount=2, is_ref=0),string 'php-internal_1' (length=14)
  1 => (refcount=2, is_ref=0),string 'php-internal_2' (length=14)
  2 => (refcount=1, is_ref=0),string 'php-internal_3' (length=14)

array2: 
(refcount=1, is_ref=0),
array (size=3)
  0 => (refcount=2, is_ref=0),string 'php-internal_1' (length=14)
  1 => (refcount=2, is_ref=0),string 'php-internal_2' (length=14)
  2 => (refcount=1, is_ref=0),string 'php-internal_4' (length=14)


 */


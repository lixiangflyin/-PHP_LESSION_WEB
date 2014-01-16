<?php

$array = array('php-internal','php-internal','php-internal');

xdebug_debug_zval('array');


//写时复制（Copy on Write)
$array2 = $array;

xdebug_debug_zval('array');
xdebug_debug_zval('array2');

/**
array: 
(refcount=1, is_ref=0),
array (size=3)
  0 => (refcount=1, is_ref=0),string 'php-internal' (length=12)
  1 => (refcount=1, is_ref=0),string 'php-internal' (length=12)
  2 => (refcount=1, is_ref=0),string 'php-internal' (length=12)

array: 
(refcount=2, is_ref=0),
array (size=3)
  0 => (refcount=1, is_ref=0),string 'php-internal' (length=12)
  1 => (refcount=1, is_ref=0),string 'php-internal' (length=12)
  2 => (refcount=1, is_ref=0),string 'php-internal' (length=12)

array2: 
(refcount=2, is_ref=0),
array (size=3)
  0 => (refcount=1, is_ref=0),string 'php-internal' (length=12)
  1 => (refcount=1, is_ref=0),string 'php-internal' (length=12)
  2 => (refcount=1, is_ref=0),string 'php-internal' (length=12)
 */


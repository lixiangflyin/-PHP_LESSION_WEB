<?php

$var = 100;

xdebug_debug_zval('var');

$ref = &$var;

xdebug_debug_zval('var');

xdebug_debug_zval('ref');

$ref2 = &$var;

xdebug_debug_zval('var');

xdebug_debug_zval('ref');

xdebug_debug_zval('ref2');
/**
结论:无论引用多少次,is_ref的值只能为0或1
var: 
(refcount=1, is_ref=0),int 100

var: 
(refcount=2, is_ref=1),int 100

ref: 
(refcount=2, is_ref=1),int 100

var: 
(refcount=3, is_ref=1),int 100

ref: 
(refcount=3, is_ref=1),int 100

ref2: 
(refcount=3, is_ref=1),int 100



123
 */
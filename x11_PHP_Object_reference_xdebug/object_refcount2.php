<?php
class Person
{
	public $name;

	public $age;
}

$user = new Person();
$user->name = 'jack';
$user->age = 18;

xdebug_debug_zval('user');



//对象默认是以"传引用"的方式传递,只增加zval结构体的refcount,
$user2 = &$user;

xdebug_debug_zval('user');

xdebug_debug_zval('user2');

echo "--------Change the value of Person---------------\r\n";

$user2->name = 'Tom';

xdebug_debug_zval('user');

xdebug_debug_zval('user2');


/**
Content-type: text/html

object(Person)#1 (2) {
  ["name"]=>
  string(3) "Tom"
  ["age"]=>
  int(18)
}
object(Person)#1 (2) {
  ["name"]=>
  string(3) "Tom"
  ["age"]=>
  int(18)
}
 */
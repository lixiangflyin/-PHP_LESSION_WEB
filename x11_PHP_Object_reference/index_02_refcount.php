<?php
class Person
{
	public $name;

	public $age;
}

$user = new Person();
$user->name = 'jack';
$user->age = 18;

//--------------------------------
echo '$user:\r\n';
debug_zval_dump($user);
//



//对象是以"传引用"的方式传递
$user2 = $user;

//--------------------------------
echo '$user:\r\n';
debug_zval_dump($user);
//

//--------------------------------
echo '$user2:\r\n';
debug_zval_dump($user2);
//


$user2->name = 'Tom';

//$user 和 $user2 引用同一个实例
var_dump($user);
var_dump($user2);


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
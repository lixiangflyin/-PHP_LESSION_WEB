<?php
$user = array('name' => 'jack','age' => 18);

//数组默认是以"传值"的方式传递
$user2 = $user;

$user2['name'] = 'mike';
$user2['age'] = 25;
$user2['address'] = 'china gd';


var_dump($user);
var_dump($user2);


/**
Content-type: text/html

array(2) {
  ["name"]=>
  string(4) "jack"
  ["age"]=>
  int(18)
}
array(3) {
  ["name"]=>
  string(4) "mike"
  ["age"]=>
  int(25)
  ["address"]=>
  string(8) "china gd"
}
 */
<?php
$user = array('jack','18');

//数组默认是以"传值"的方式传递
$user2 = $user;

$user2[0] = 'mike';
$user2[1] = '25';
$user2[] = 'address';


var_dump($user);
var_dump($user2);


/**
Content-type: text/html

array(2) {
  [0]=>
  string(4) "jack"
  [1]=>
  string(2) "18"
}
array(3) {
  [0]=>
  string(4) "mike"
  [1]=>
  string(2) "25"
  [2]=>
  string(7) "address"
}
 */
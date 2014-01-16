<?php
$user = array('jack','18');

debug_zval_dump($user);

//数组默认是以"传值"的方式传递
$user2 = $user;

debug_zval_dump($user);
debug_zval_dump($user2);


$user = array();//尽管是引用,但这里$user被赋上新值后,$user2值不变,只是引用计数减1了而已

debug_zval_dump($user);
debug_zval_dump($user2);


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
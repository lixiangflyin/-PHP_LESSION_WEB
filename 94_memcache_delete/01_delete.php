<?php

$Memcache = new Memcache();

//非持久连接
$Memcache->pconnect('localhost',11211);


//memcache实际存储情况:a:3:{i:0;s:3:"aaa";i:1;s:3:"bbb";i:2;s:3:"ccc";}
$result = $Memcache->set('myarray', array('aaa','bbb','ccc'),MEMCACHE_COMPRESSED,3600);


$user = $Memcache->get('myarray');


var_dump($user);


$result2 = $Memcache->delete('myarray');


$user = $Memcache->get('myarray');

var_dump($user);


$Memcache->close();

/**
Content-type: text/html

array(3) {
  [0]=>
  string(3) "aaa"
  [1]=>
  string(3) "bbb"
  [2]=>
  string(3) "ccc"
}
 */
?>
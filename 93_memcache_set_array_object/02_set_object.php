<?php

class Person
{
	private $name = 'zhangsan';
	private $age = 18;
}

$Memcache = new Memcache();

$Memcache->pconnect('localhost',11211);


//在memcache的数据: O:6:"Person":2:{s:12:"Personname";s:8:"zhangsan";s:11:"Personage";i:18;}

$result = $Memcache->set('user', new Person(),MEMCACHE_COMPRESSED,3600);

echo $result;

$user = $Memcache->get('user');


var_dump($user);



$Memcache->close();

/**
Content-type: text/html

1object(Person)#2 (2) {
  ["name:private"]=>
  string(8) "zhangsan"
  ["age:private"]=>
  int(18)
}
 */
?>
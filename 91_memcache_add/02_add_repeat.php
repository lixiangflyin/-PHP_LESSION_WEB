<?php

$Memcache = new Memcache();

//非持久连接
$Memcache->pconnect('localhost',11211);
//$mem->addserver("www.ecc.com",11211);

//以压缩的文件 保存 <'mystr','this is a memcache test!'>,保存3600s,成功返回true,如果key已存在,返回false
$result1 = $Memcache->add('hello2', 'this is a memcache test!',MEMCACHE_COMPRESSED,3600);			//true

//以压缩的文件 保存 <'mystr','this is a memcache test!'>,保存3600s,成功返回true,如果key已存在,返回false
$result2 = $Memcache->add('hello2', 'xxxxxxxxxxxxxxxxxxxxxxxx',MEMCACHE_COMPRESSED,3600);			//false

$str = $Memcache->get('hello');

$Memcache->close();

echo $str;
/**
Content-type: text/html

this is a memcache test!
 */
?>
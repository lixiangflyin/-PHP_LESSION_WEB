<?php

$Memcache = new Memcache();

//非持久连接
$Memcache->pconnect('localhost',11211);

$str = $Memcache->get('mystr');

echo $str;


//以压缩的文件 保存 <'mystr','this is a memcache test!'>,保存3600s,成功返回true,如果key已存在,返回false
$result = $Memcache->replace('mystr', 'NEW again!',MEMCACHE_COMPRESSED,3600);


$str = $Memcache->get('mystr');

echo $str;


$Memcache->close();
?>
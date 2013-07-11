<?php

$mem = new Memcache();

//非持久连接
$mem->connect('localhost',11211);
//$mem->addserver("www.ecc.com",11211);

$mem->close();
?>
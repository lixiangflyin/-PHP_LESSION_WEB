<?php

$mem = new Memcache();

//持久连接
$mem->pconnect('localhost',11211);
//$mem->addserver("www.ecc.com",11211);

$mem->close();
?>
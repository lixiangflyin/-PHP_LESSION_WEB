<?php
$array = array(
    'format'   => 'json',
	'callerId' => 10000,
    'ReqSysNo' => 50010168,
	'method'   => 'install.getreqdetailbysysno'
);

var_dump($array);

ksort($array);//ksort 是区分大小写的

var_dump($array);



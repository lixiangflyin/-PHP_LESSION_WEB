<?php


$array = array("name" => '小明',
			   "age"  => 18,
			   "sex"  => '男');

$json1 = json_encode($array);	
$json2 = json_encode($array,JSON_UNESCAPED_UNICODE);	



header("Content-Type:application/json");
echo $json1,"\n";
echo $json2,"\n";


/**
Content-Type:application/json

{"name":"\u5c0f\u660e","age":18,"sex":"\u7537"}
{"name":"小明","age":18,"sex":"男"}
 */
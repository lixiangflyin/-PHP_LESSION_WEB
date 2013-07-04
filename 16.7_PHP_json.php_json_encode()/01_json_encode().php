<?php


$array = array("name" => 'jack',
			   "age"  => 18,
			   "sex"  => 'male');


$json = json_encode($array);	
//$json : (string:37) {"name":"jack","age":18,"sex":"male"}



header("Content-Type:application/json");
echo $json;


/**
Content-Type:application/json

{"name":"jack","age":18,"sex":"male"}
 */
?>
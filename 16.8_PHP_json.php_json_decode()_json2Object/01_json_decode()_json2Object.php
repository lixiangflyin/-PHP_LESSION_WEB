<?php
/**
 json_decode($json, $assoc, $depth)
 
Decodes a JSON string

Parameters:
  json string 
The json string being decoded. 

  assoc bool[optional] 
When true, returned objects will be converted into associative arrays. 

  depth int[optional] 
User specified recursion depth. 

Returns:
  mixed the value encoded in json in appropriate PHP type. Values true, false and null (case-insensitive) are returned as true, false and &null; respectively. &null; is returned if the json cannot be decoded or if the encoded data is deeper than the recursion limit. 

 */

$json = '{"name":"jack","age":18,"sex":"male"}';	

//$object : Object of: stdClass
$object = json_decode($json);	//默认情况下 assoc:null 或false, 转换成的是对象

echo $object->name . "\r\n";
echo $object->age . "\r\n";
echo $object->sex . "\r\n";

/**
Content-type: text/html

jack
18
male
 */
?>
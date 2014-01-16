<?php
$ids = array(123,456,789);

//[123,456,789] => '123,456,789'
$ids_string = implode(',', $ids);
$ids_string2 =   join(',', $ids);  //join() 是 implode()的别名,我更推荐join,一看就懂

var_dump($ids_string);
<?php
$ids = array(123,456,789);

//[123,456,789] => '123','456','789'
$ids_string = "'".join("','", $ids)."'";

$where = ' `id` IN ( ' . $ids_string .' ) ';//'123','456','789'

$sql = 'SELECT * FROM `Users` WHERE ' . $where;

echo $sql;
//SELECT * FROM `Users` WHERE  `id` IN ( '123','456','789' ) 
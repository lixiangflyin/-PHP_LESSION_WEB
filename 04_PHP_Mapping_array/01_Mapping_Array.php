<?php
/**
 关联数组，它的每个 ID 键都关联一个值。
在存储有关具体命名的值的数据时，使用数值数组不是最好的做法。
通过关联数组，我们可以把值作为键，并向它们赋值。
 * Enter description here ...
 * @var unknown_type
 */

$ages = array("Peter"=>32,"Hely"=>30, "Warth"=>28);//会自动分配 ID 键：

echo $ages["Peter"] . " ";
echo $ages["Hely"] . " ";
echo $ages["Warth"] . " ";  
//结果： 32 30 28 
?>

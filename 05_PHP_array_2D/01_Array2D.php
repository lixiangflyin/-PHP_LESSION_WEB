<?php
$teams = array();

$teams[0] = array("jack","ken","tom");
$teams[1] = array("mary","jack");

echo $teams[0][0] . " ";
echo $teams[0][1] . " ";
echo $teams[0][2] . " ";
echo "<tr>";
echo $teams[1][0] . " ";
echo $teams[1][1] . " ";

//结果： jack ken tom <tr>mary jack  
?>

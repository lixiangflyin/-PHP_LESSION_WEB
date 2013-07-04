<?php
$teams = array(
			"team1" => array("jack","ken","tom"),
			"team2" => array("mary","jack")
);

echo $teams["team1"][0] . " ";
echo $teams["team1"][1] . " ";
echo $teams["team1"][2] . " ";
echo "<tr>";
echo $teams["team2"][0] . " ";
echo $teams["team2"][1] . " ";

//结果： jack ken tom <tr>mary jack  
?>

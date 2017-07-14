<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php

$d1 = new DateTime("2017-11-14");
$d2 = new DateTime("2017-12-14");
$d3 = $d1->diff($d2);
$d4 = ($d3->y*12)+$d3->m;
echo "<pre>";
echo $d4."<br>";
var_dump($d2);
echo "</pre>";
?>
</body>
</html>

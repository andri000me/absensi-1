<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php

$d1 = new DateTime("2017-11-02");
$d2 = new DateTime("2017-12-31");
$d3 = $d1->diff($d2);
$d4 = ($d3->y*12)+$d3->m;
echo $d4;
?>
</body>
</html>

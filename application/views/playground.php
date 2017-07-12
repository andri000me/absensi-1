<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php


$d1 = new DateTime("2009-02");
$d2 = new DateTime("2011-02");

var_dump($d1->diff($d2)->m); // int(4)
var_dump($d1->diff($d2)->m + ($d1->diff($d2)->y*12)); // int(8)
?>
</body>
</html>

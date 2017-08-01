<div class="container">
<?php
echo "<pre>";
$d1 = date("Y-m");
$d2 = date("2017-07-30");
if ($d1 > $d2) {
    var_dump("expression");
}
else{
    var_dump("else");
}
$d1s = substr("2010-09-10",-10,7);
$d2s = substr("2010-01-1",-10,7);
echo "1 ".$d1s." 2 ".$d2s."<br>";
$d1 = new DateTime($d1s);
$d2 = new DateTime($d2s);
var_dump($d1->diff($d2)->m + ($d1->diff($d2)->y*12)); // int(8)
echo "</pre>";
?>
</div>
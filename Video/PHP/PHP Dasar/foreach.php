<?php 

$nama["joni"] = "surabaya";
$nama["budi"] = "malang raya";
$nama["tejo"] = "jakarta";
$nama["siti"] = "sidoarjo";
$nama["edi"] = "semarang";

var_dump($nama);

echo "<br>";

echo $nama["budi"];

foreach($nama as $k => $v) {

    echo $k. "=>". $v ;

    echo"<br>";
} 

?>
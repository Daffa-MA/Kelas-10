<?php 

//oprator matematika

$a = 2 ;
$b = 2 ;

$c = $a + $b;

echo $c.'<br>';

$c = $a - $b;

echo $c.'<br>';
$c = $a * $b;

echo $c.'<br>';
$c = $a / $b;

echo $c.'<br>';
$c = $a % $b;

echo $c.'<br>';

//operator logika

$c = $a < $b;
echo $c;
$c = $a > $b;
echo $c;
$c = $a == $b;
echo $c;
$c = $a != $b;
echo $c.'<br>';

//incerment

$a++;
echo $a.'<br>';

$a--;
echo $a.'<br>';

// operator string

$kata = 'Sura';
$kota = 'Baya';

$hasil = $kata.$kota;

$hasil .= 'Kota pahlawan';
echo $hasil;
?>
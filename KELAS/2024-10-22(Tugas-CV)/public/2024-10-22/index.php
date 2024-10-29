<?php

$data ="saya belajar PHP di SMKN 2 BUDURAN";
$isi = "Hari ini saya belajar php";
$materi = "Materi PHP";
$sekolah = ["TK Salsabila",
            "SDN Kemiri",
            "SMPN 6 Rangkah",
            "SMKN 2 Buduran"];

$identitases =
    [
        "Daffa Maulana A.",
        "X RPL ",
        "J.L Telaga RT 09 RW 03",
        "daffamau09@gmail.com"
    ];

$judul = "Curiculum Vitae";
$hobies = ["Main Game","Mancing"];

// $list1 ="variabel";
// $list2 ="Array";
// $list3 ="Pengujian";
// $list4 ="Pengulangan";
// $list5 ="Function";
// $list6 ="Class";
// $list7 ="Object";
// $list8 ="Framework";
// $list9= "PHP dan MySQL";
$list = ["Variabel","Array","Pengujian","Pengulangan","Function","Class","Object","Framework","PHP dan MySQL"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       .kamar {
          text-align: center;
        }
        .list{
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
 <div class="kamar">
    <h1><?php  echo $data; ?></h1>
    <p> <?php  echo $isi; ?></p>
    <h2><?php  echo $materi; ?></h2>

    <div class="list">
    <ol>
        <li><?= $list[0]; ?></li>
        <p>Variabel adalah wadah atau temapt untuk menyimpan data.</p>
        <p>Data bisa berupa text atau string, bisa juga berupa angka atau numerik, Data juga bisa gabungan antara text, angka, dan simbol</p>
        <li><?= $list[1]; ?></li>
        <li><?= $list[2]; ?></li>
        <li><?= $list[3]; ?></li>
        <li><?= $list[4]; ?></li>
        <li><?= $list[5]; ?></li>
        <li><?= $list[6]; ?></li>
        <li><?= $list[7]; ?></li>
        <li><?= $list[8]; ?></li>
    </ol>
    </div>
</div>

</body>
</html>
<?php
$sekolah=[
    "Tk Faqih Hasyim",
    "SDN Kemiri",
    "SMPN 6 Sidoarjo",
    "SMKN 2 Buduran"
];
$sekolahs=[
    "Tk" => "tk Faqih Hasyim",
    "SDN" => "SDN Kemiri",
    "SMPN" => "SMPN 6 Sidoarjo",
    "SMKN" => "SMKN 2 Buduran"
];

$skills=[
    "C++" => "Expert",
    "HTML" => "Newbie",
    "PHP" => "Intermediate",
    "JavaScript" => "Intermediate"
];

$identitas=[
    "nama" => "Daffa M.A",
    "alamat" => "J.L Telaga",
    "email" => "daffamau09@gmail.com",
    "status" => "Pelajar"
];

$hobi=[
    "Coding",
    "Mancing",
    "Main Game",
    "Berenang"
];

// echo $sekolah[0];
// echo "<br>";
// echo $sekolahs["Tk"];
// echo "<br>";
// echo $sekolah[1];
// echo "<br>";
// echo $sekolahs["SDN"];

// //menggunakan foreach loop
// for ($i=0; $i< 4; $i++){
//     echo $sekolah[$i];
//     echo "<br>";
// }

// echo "<br>";

// foreach ($sekolah as $key){
//     echo $key;
//     echo "<br>";
// }
// echo "<br>";
// foreach ($sekolahs as $key => $value){
//     echo $key;
//     echo "=";
//     echo $value;
//     echo "<br>";
// }

if (isset($_GET["menu"])) {
    $menu = $_GET["menu"];
    echo $menu;
}

// $menu = $_GET["menu"];
// echo $menu;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2024-10-29</title>
</head>
<body>
<ul>
    <li><a href="?menu=Home">Home</a></li>
    <li><a href="?menu=CV">CV</a></li>
    <li><a href="?menu=Project">Project</a></li>
    <li><a href="?menu=Contact">Contact</a></li>
</ul>

<table border="1">
    <h2>Identitas</h2>
    <thead>
        <tr>
          <th>Identitas</th>
          <th>Deskripsi</th>              
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($identitas as $key => $value){
            echo "<tr>";
            echo "<td>".$key."</td>";
            echo "<td>".$value. "</td>";
            echo "</tr>";
        }
       ?>
    </tbody>
</table>
<hr>
    <h2>Riwayat Sekolah</h2>
    <table border="">
        <thead>
            <th>Jenjang</th>
            <th>Nama Sekolah</th>
        </thead>
        <tbody>
            <?php
            foreach ($sekolahs as $key => $value){
                echo "<tr>";
                echo "<td>".$key."</td>";
                echo "<td>".$value. "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>Skil</h2>
    <table border="1">
        <thead>
            <th>Skill</th>
            <th>Level</th>
        </thead>
        <tbody>
            <?php
            foreach ($skills as $key => $value){
            ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $value ?></td>
            </tr>
            <?php 
            } 
            ?>
        </tbody>
    </table>
    <hr>
    <h2>Hobi</h2>
    <ul>
        <?php
        foreach ($hobi as $key){
            echo "<li>".$key."</li>";
        }
       ?>
    </ul>
</body>
</html>
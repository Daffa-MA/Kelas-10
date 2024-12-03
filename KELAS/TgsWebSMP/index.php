<?php 

$menu = ["Home",
         "Umpan Balik",
         "Profile",
         "BK",
         "Tautan",
         "Sekolah Penggerak",
];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="SMPN6-icon" href="logo.png">
    <title>SMP Negeri 6 Sidoarjo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="logo.png" alt="Logo SMPN-6-SDA">
            </div>
            <div class="title">
                <h1>SMP Negeri 6 Sidoarjo</h1>
            </div>
                <div class="nav">
                         <ul>
                             <li class="home"><a href="#"><?= $menu[0] ?></a></li>
                             <li><a href="#"><?= $menu[1] ?></a><i class="fas fa-caret-down"></i>
                                <ul>
                                    <li><i class="fas fa-thumbtack icon"></i><a href="#">Suling 6</a></li>
                                    <li><i class="fas fa-minus"></i><a href="#">Umpan balik</a></li>
                                </ul>
                            </li>
                             <li><a href="#"><?= $menu[2] ?></a><i class="fas fa-caret-down"></i>
                                <ul>
                                    <li><i class="fas fa-thumbtack icon"></i><a href="#">Visi Dan Misi</a></li>
                                    <li><i class="fas fa-minus"></i><a href="#">Struktur Organisasi</a></li>
                                    <li><i class="fas fa-minus"></i><a href="#">Penyelenggaraan Pendidikan</a></li>
                                </ul>
                             </li>
                             <li><a href="#"><?= $menu[3] ?></a></li>
                             <li><a href="#"><?= $menu[4] ?></a><i class="fas fa-caret-down"></i>
                                <ul>
                                    <li><i class="fas fa-thumbtack icon"></i><a href="#">Siswa</a></li>
                                    <li><i class="fas fa-minus"></i><a href="#">Publik</a></li>
                                    <li><i class="fas fa-minus"></i><a href="#">Admin</a></li>
                                </ul>
                            </li>
                             <li><a href="#"><?= $menu[5] ?></a></li>
                             <i class="fas fa-search"></i>
                         </ul>
                   </div>
            </div>
      </div>
</body>
</html>
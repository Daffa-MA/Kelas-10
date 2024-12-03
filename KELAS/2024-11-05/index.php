<?php 
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "sekolah";
$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2024-11-05</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
            </div>
        
        <div class="sekolah">
            <h2>SMKN 2 BUDURAN</h2>
        </div>
        <div class="nav">
            <ul>
                <li><a href="?menu=home">Home</a></li>
                <li><a href="?menu=sejarah">Sejarah</a></li>
                <li><a href="?menu=jadwal">Jadwal</a></li>
                <li><a href="?menu=jurusan">Jurusan</a></li>
                <li><a href="?menu=contact">Contact</a></li>
                <li><a href="?menu=tentang">Tentang</a></li>
            </ul>
        </div>
        </div>
        <div class="content">
            <?php
            if (isset($_GET["menu"])) {
                $menu = $_GET["menu"];
            } else {
                $menu = "home";
            }

            switch ($menu) {
                case "home":
                    require_once("pages/home.php");
                    break;
                case "sejarah":
                    require_once("pages/sejarah.php");
                    break;
                case "jadwal":
                    require_once("pages/jadwal.php");
                    break;
                case "jurusan":
                    require_once("pages/jurusan.php");
                    break;
                case "contact":
                    require_once("pages/contact.php");
                    break;
                case "tentang":
                    require_once("pages/tentang.php");
                    break;
                default:
                    require_once("pages/home.php");
            }
            ?>
        </div>
        <div class="footer">
            <p>Web ini dibuat oleh : Daffa Maulana Achmad</p>
        </div>
    </div>
</body>
</html>

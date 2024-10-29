<?php
$identitases =
    [
        "Daffa Maulana A.",
        "X RPL ",
        "J.L Telaga RT 09 RW 03",
        "daffamau09@gmail.com"
    ];

$status= "Pelajar";
$hobi = ["Main Game","Mancing","Ngoding"];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curiculum Vitae</title>
    <link rel="stylesheet" href="../src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-black text-white">
    <div class="max-w-lg mx-auto p-6 container">
        <div class="bg-gray-800 p-6 rounded-lg border border-green-500">
            <div class="flex justify-center mb-4">
                <img src="profile.jpeg" alt="Profile Picture" class="rounded-full border-4 border-green-500" width="100" height="100">
            </div>
            <div class="text-center mb-4">
                <h1 class="text-3xl font-bold text-green-500"><?=  $identitases[0] ?></h1>

                <p class="text-lg"><?=  $identitases[1] ?></p>

            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-gray-900 p-4 rounded-lg border border-green-500">
                    <h2 class="text-xl font-bold mb-2">TENTANG SAYA</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident placeat adipisci totam nobis, doloremque esse modi ea repudiandae ipsum? Sit aliquam sequi voluptas maiores nisi animi dolores consequuntur dolor delectus!.</p>
                </div>
                <div class="bg-gray-900 p-4 rounded-lg border border-green-500">
                    <h2 class="text-xl font-bold mb-2">KONTAK</h2>
                    <p><i class="fas fa-phone-alt text-green-500"></i> +628973128675</p>
                    <p><i class="fas fa-envelope text-green-500"></i> daffamau09@gmail.com</p>
                    <p><i class="fas fa-map-marker-alt text-green-500"></i> Kermiri,Sidoarjo </p>
                    <p><i class="fas fa-user  text-green-500"></i> <?= $status  ?></p>

                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-gray-900 p-4 rounded-lg border border-green-500">
                    <h2 class="text-xl font-bold mb-2">HOBI</h2>
                    <p>Mancing</p>
                    <P>Main Game</P>
                    <p></p>
                </div>
                <div class="bg-gray-900 p-4 rounded-lg border border-green-500">
                    <h2 class="text-xl font-bold mb-2">PENDIDIKAN</h2>
                    <p>SDN Kemiri<br>2014 - 2020</p>
                    <p>SMPN 6 SIDOARJO<br>2020 - 2024</p>
                </div>
            </div>
            <div class="bg-gray-900 p-4 rounded-lg border border-green-500">
                <h2 class="text-xl font-bold mb-2">KEAHLIAN</h2>
                <p><i class="fas fa-check-square text-green-500"></i> HTML</p>
                <p><i class="fas fa-check-square text-green-500"></i> CSS</p>
                <p><i class="fas fa-check-square text-green-500"></i> BOOTSTRAP</p>
                <p><i class="fas fa-check-square text-green-500"></i> PHP</p>
            </div>
        </div>
    </div>
</body>
</html>
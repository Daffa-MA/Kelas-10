<nav>
    <ul>
        <li><a href="$menu=kontak">Kontak</a></li>
        <li><a href="$menu=sejarah">Sejarah</a></li>
        <li><a href="$menu=jurusan">Jurusan</a></li>
    </ul>
</nav> 

<?php

    if (isset($_get['menu'])){
        $menu = $_GET['menu'];

        echo $menu;
    }



    // if(isset($_POST['kirim'])){

    //     $email = $_POST ['email'];
    //     $password = $_POST['password'];

    //     echo $email;
    //     echo "<br>";
    //     echo $password;

    // }

?>
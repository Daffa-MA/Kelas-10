<nav>
    <ul>
        <li><a href="?menu=isi">isi</a></li>
        <li><a href="?menu=hapus">hapus</a></li>
        <li><a href="?menu=destroy">destroy</a></li>
    </ul>
</nav>


<?php 

    session_start();

    var_dump($_SESSION);
    echo '<br>';

    if (isset($_GET['menu'])){
        $menu = $_GET['menu']; 

        echo $menu;

        switch ($menu){
            case 'isi':
                isi_session();
                break;
            case 'hapus':
                unset($_SESSION['user']);
                break;
            case 'destroy':
                session_destroy();
                break;

        }

    }
    
    
    


    function isi_session(){

    $_SESSION ['user'] = 'joni';

    $_SESSION ['nama'] = 'joni rambo';

    $_SESSION ['alamat'] = 'Sidoarjo';

    }

?>
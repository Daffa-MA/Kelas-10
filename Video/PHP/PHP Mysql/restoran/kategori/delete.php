<?php 

    require_once "../function.php";

    // $id = 2;

    $sql = "DELETE FROM tblkategori WHERE idkategori = $id";

    $result = mysqli_query($koneksi, $sql);

    echo $sql;

    header("Location:http://localhost/Kelas_10/Video/PHP/PHP%20Mysql/restoran/kategori/select.php?p=1");

?>
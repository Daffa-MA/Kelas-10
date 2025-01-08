<form action="" method="post">
    kategori :
    <input type="text" name= "Kategori">
    <br>
    <input type="submit" name="simpan" value="simpan">
</form>


<?php 

require_once "../function.php";

if (isset($_POST['simpan'])) {
    $Kategori = $_POST['Kategori'];

    $sql =   "INSERT INTO tblkategori VALUES ('','$Kategori')";

    $result= mysqli_query($koneksi, $sql);

    header ("location:http://localhost/Kelas_10/Video/PHP/PHP%20Mysql/restoran/kategori/select.php?p=1");
}

?>
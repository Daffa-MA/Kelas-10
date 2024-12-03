<form action="nav.php" method="get">

    nama :
    <input type="text" name="nama" placeholder="masukkan nama">
    alamat :
    <input type="text" name="alamat" placeholder="masukkan alamat">

    <input type="submit" name="kirim" value="kirim">
</form>
<?php 

if (isset($_POST['kirim'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    echo $nama;
    echo "<br>";
    echo $alamat;

}

?>
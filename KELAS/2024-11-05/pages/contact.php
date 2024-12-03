<?php 
$sql = "SELECT * FROM contac";
echo $sql;

$hasil = mysqli_query($koneksi, $sql );
while ($row = mysqli_fetch_array($hasil)) {

?>
<div class="contac">
    <h2><?= $row[1] ?></h2>
    <p><?= $row[2] ?></p>
</div>
<?php 
}
?>
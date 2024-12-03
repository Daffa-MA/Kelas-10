<?php
if(!isset($_SESSION['email'])){
    header('Location: index.php?menu=login');
}

if(!isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    unset($_SESSION['cart'][$id]);
}

$cart = count($_SESSION['cart']);
if ($cart == 0) {
    header('Location: index.php');
}


if(isset($_GET["add"])){
    $id = $_GET["add"];
    $sql = "SELECT * FROM produk  WHERE id = $id";
    echo $sql;
    $hasil = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($hasil);
    echo $row["id"];
    echo $row["produk"];
    echo $row["harga"];
    $_SESSION ['cart'][$row["id"]]=[
        'id' => $row['id'],
        'produk'=> $row['produk'],
        'harga'=> $row['harga'],
        'jumlah'=> isset($_SESSION['cart'][$row['id']]) ? $_SESSION['cart']['jumlah'] + 1 : 1
    ];
}
?>

<div class="cart">
    
    <h1>Cart</h1>

    <table border="1px">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php 
                
                foreach ($_SESSION['cart'] as $key){
                ?>
                    <tr>
                        <td><?php echo $key['id']; ?></td>
                        <td><?php echo $key['produk'];?></td>
                        <td><?php echo $key['harga'];?></td>
                        <td><?php echo $key['jumlah'];?></td>
                        <td><?php echo $key['harga']*$key['jumlah'];?></td>
                        <td><a href="?menu=cart&hapus=<?= $key['id']  ?>">Hapus</a></td>
                    </tr>
                <?php 
                }
                ?>  
            </tr>
        </tbody>
    </table>
</div>
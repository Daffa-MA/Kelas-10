<form action="" method="post" enctype="multipart/form-data">

pilih file gammbar :
<input type="file" name="upload">
<input type="submit" name="kirim" value="simpan">

</form>

<?php 

if(isset($_POST['kirim'])){

//     $file = $_FILES['upload'];

//    // var_dump($_FILES['upload']);

//     foreach($file as $key => $val){
//         echo $key. '= '.$val;
//         echo '<br>';
//     }

    $name=$_FILES['upload']['name'];
    $temp = $_FILES['upload']['tmp_name'];

    // echo $temp. '='.$temp ;

    move_uploaded_file($temp,'gambar/'.$name);


}

?>  
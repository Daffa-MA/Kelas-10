<form action="nav.php" method="post">

    Email :
    <input type="email" name="email" placeholder="Masukan Email">
    password :
    <input type="password" name="password" placeholder="Masukan Password">
    <input type="submit" name="Login" value="Login">
</form>

<?php 

    if(isset($_POST['kirim'])){

        $email = $_POST ['email'];
        $password = $_POST['password'];

        echo $email;
        echo "<br>";
        echo $password;

    }

?>
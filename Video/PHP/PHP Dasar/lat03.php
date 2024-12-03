<?php 
    function belajar(){
        echo "Saya sedang belajar PHP";
    }
    belajar();
    echo "<hr>";

    function luaspersegi($p = 5, $l = 3){
        $luas = $p * $l;

        echo $luas;
    }
    luaspersegi();
    echo "<hr>";

    function luas($p = 5, $l = 3){
        $luas = $p * $l;

        return $luas;
    }
    function output(){
        return "Belajar function";
    }

    echo luas(100,3) * 5;

?>
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "dbujian";

$koneksi = new mysqli("$host", "$username", "$password", "$database");

if(mysqli_connect_error()){
    echo "Koneksi Gagal". mysqli_connect_error();
    die;
} else {
    // echo "Koneksi Berhasil";
}

?>
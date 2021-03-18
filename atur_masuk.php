<?php

include('config/koneksi.php');

session_start();

if (isset($_POST['btn_masuk'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cekMasuk = $koneksi->query("SELECT * FROM users where username = '$username' and password ='$password'");

    if ($cekMasuk->num_rows > 0) {
        $dataUser = $cekMasuk->fetch_assoc();

        $_SESSION['status'] = 'masuk';
        $_SESSION['id'] = $dataUser['id'];
        $_SESSION['nama'] = $dataUser['nama'];
        $_SESSION['level'] = $dataUser['level'];

        header('location: index.php');
    } else {
        $_SESSION['masuk_error'] = "Username atau Password anda salah!";
        header('location:masuk.php');
    }
}

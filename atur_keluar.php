<?php
session_start();

session_destroy();

session_start();
$_SESSION['keluar_berhasil'] = "Anda berhasil keluar.";
header('location:masuk.php');
die;

?>
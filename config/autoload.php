<?php

session_start();
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$base_url = "http://localhost/ujian";

if ($_SESSION['status'] != 'masuk') {
    header("Location: masuk.php");
}

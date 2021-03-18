<?php
session_start();
include "../config/koneksi.php";

// Ambil ID Ujian
$id_ujian = $_GET["id_ujian"];

// Mengambil data ujian berdasarkan idnya
$getUjian = $koneksi->query("SELECT * FROM ujian WHERE id = $id_ujian");
$ujian = $getUjian->fetch_assoc();

// Cetak info ujian

echo $ujian["mapel"];

// Simpan session
$_SESSION["id_ujian"] = $id_ujian;
$_SESSION["waktu_ujian"] = $ujian["waktu"];

date_default_timezone_set("Asia/Jakarta");
$date = date("Y-m-d H:i:s");
$_SESSION["ujian_berakhir"] = date("Y-m-d H:i:s", strtotime($date . "+$_SESSION[waktu_ujian] minutes"));
$_SESSION["ujian_dimulai"] = "yes";

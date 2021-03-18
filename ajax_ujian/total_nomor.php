<?php
session_start();
include "../config/koneksi.php";
// Setting total nomor = 0
$total_nomor = 0;

// Ambil ID Ujian
$id_ujian = $_SESSION['id_ujian'];

// Query table ujian berdasarkan id ujian
$sql = $koneksi->query("SELECT * FROM ujian INNER JOIN bank_soal ON ujian.id = bank_soal.id_ujian WHERE ujian.id = $id_ujian");

// Total nomor = jumlah row dari query di atas
$total_nomor = $sql->num_rows;
echo $total_nomor;

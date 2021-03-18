<?php
session_start();
// Set timezone
date_default_timezone_set('Asia/Jakarta');

// Jika terdapat sesi ujian berakhir
if (isset($_SESSION["ujian_berakhir"])) {
    // Hitung waktunya
    $time1 = gmdate("H:i:s", strtotime($_SESSION["ujian_berakhir"]) - strtotime(date("Y-m-d H:i:s")));
    echo $time1;
}

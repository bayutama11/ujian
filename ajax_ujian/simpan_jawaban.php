<?php
session_start();
// Menyimpan jawaban
// Ambil nomor soal, dan jawabannya
$nomor_soal = $_GET["nomor_soal"];
$jawaban = $_GET["jawaban"];
$_SESSION["jawaban"][$nomor_soal] = $jawaban;

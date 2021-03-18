<?php

include('config/koneksi.php');
session_start();


if (isset($_POST['btn_daftar'])) {
    // print_r($_POST);

    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $telepon = $_POST['telepon'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $konfirmasi = md5($_POST['konfirmasi']);
    $nis    = $_POST['nis'];

    $cekNis = $koneksi->query("SELECT nis FROM siswa WHERE nis = '$nis'");

    if ($cekNis->num_rows > 0) {
        $_SESSION['error_regis'] = "NIS sudah digunakan.";

        header('location:daftar.php');
    } else {
        if ($password != $konfirmasi) {
            $_SESSION['error_regis'] = "Password dan konfirmasi password tidak cocok.";
            header('location:daftar.php');
        } else {
            // Insert ke database
            $insertUser = $koneksi->query("INSERT INTO users (nama, username, password, level) values ('$nama', '$username', '$password', 'siswa')");

            if ($insertUser) {
                $idUser = $koneksi->insert_id;

                $insertSiswa = $koneksi->query("INSERT INTO siswa (id_user, nis, kelas, jeniskelamin, telepon) values ($idUser, $nis, '$kelas', '$jeniskelamin', '$telepon')");

                if ($insertSiswa) {
                    $_SESSION['pesan_daftar'] = "Anda telah berhasil membuat akun, silahkan login menggunakan Username dan Password Anda.";

                    header('location:masuk.php');
                } else {
                    $_SESSION['pesan_daftar'] = "Error.";

                    header('location:masuk.php');
                }
            } else {
                $_SESSION['pesan_daftar'] = "Error.";

                header('location:masuk.php');
            }
        }
    }
}

<?php
session_start();
include "../config/koneksi.php";

// Mendeklarasikan variabel-variabel yang dibutuhkan
$nomor_soal = "";
$soal = "";
$opsi_a = "";
$opsi_b = "";
$opsi_c = "";
$opsi_d = "";
$count = 0;
$jawaban_siswa = "";
$queno = $_GET["nomor_soal"];
$id_ujian = $_SESSION["id_ujian"];

// Jika sudah ada jawaban
if (isset($_SESSION["jawaban"][$queno])) {
    // Isi jawaban siswa dengan jawaban yang sudah dijawab
    $jawaban_siswa = $_SESSION["jawaban"][$queno];
}

// Membuat query untuk mengambil soal dengan inner join ke table bank soal dari table ujian
$sql = $koneksi->query("SELECT * FROM ujian INNER JOIN bank_soal ON ujian.id = bank_soal.id_ujian WHERE ujian.id = $id_ujian AND bank_soal.nomor_soal = $queno");

// Menghitung jumlah soalnya
$count = $sql->num_rows;

// Jika jumlah soalnya 0, maka ujian selesai
if ($count == 0) {
    header("location: index.php?halaman=ujian&aksi=hasil");
} else {
    // Jika bukan 0, maka tampilkan soalnya
    while ($row = $sql->fetch_array()) {
        $nomor_soal = $row["nomor_soal"];
        $soal = $row["soal"];
        $opsi_a = $row["opsi_a"];
        $opsi_b = $row["opsi_b"];
        $opsi_c = $row["opsi_c"];
        $opsi_d = $row["opsi_d"];
    }
}

?>

<br>

<!-- html untuk menampilkan soal -->
<table>
    <tr>
        <td style="font-weight:bold; font-size: 18px; padding-left: 5px" colspan="2">
            <?php echo "( " . $nomor_soal . " ) " . $soal; ?>

        </td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td>
            <input type="radio" name="r1" id="r1" value="<?php echo $opsi_a; ?>" onclick="radioclick(this.value, <?php echo $nomor_soal ?>)" <?php
                                                                                                                                                if ($jawaban_siswa == $opsi_a) {
                                                                                                                                                    echo "checked";
                                                                                                                                                }
                                                                                                                                                ?>>
        </td>

        <td style="padding-left: 10px">
            <?php
            echo $opsi_a;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <input type="radio" name="r1" id="r1" value="<?php echo $opsi_b; ?>" onclick="radioclick(this.value, <?php echo $nomor_soal ?>)" <?php
                                                                                                                                                if ($jawaban_siswa == $opsi_b) {
                                                                                                                                                    echo "checked";
                                                                                                                                                }
                                                                                                                                                ?>>
        </td>

        <td style="padding-left: 10px">
            <?php
            echo $opsi_b;
            ?>
        </td>
    </tr>

    <tr>
        <td>
            <input type="radio" name="r1" id="r1" value="<?php echo $opsi_c; ?>" onclick="radioclick(this.value, <?php echo $nomor_soal ?>)" <?php
                                                                                                                                                if ($jawaban_siswa == $opsi_c) {
                                                                                                                                                    echo "checked";
                                                                                                                                                }
                                                                                                                                                ?>>
        </td>

        <td style="padding-left: 10px">
            <?php
            echo $opsi_c;
            ?>
        </td>
    </tr>

    <tr>
        <td>
            <input type="radio" name="r1" id="r1" value="<?php echo $opsi_d; ?>" onclick="radioclick(this.value, <?php echo $nomor_soal ?>)" <?php
                                                                                                                                                if ($jawaban_siswa == $opsi_d) {
                                                                                                                                                    echo "checked";
                                                                                                                                                }
                                                                                                                                                ?>>
        </td>

        <td style="padding-left: 10px">
            <?php
            echo $opsi_d;
            ?>
        </td>
    </tr>

</table>
<br>
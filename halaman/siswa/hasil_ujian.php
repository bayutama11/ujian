<?php
// Tanggal dan sekarang
$date = date("Y-m-d H:i:s");

// Set session waktu berakhir, isinya waktu sekarang + waktu ujian dari database
$_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date . "+ $_SESSION[waktu_ujian] minutes"));
// Mengambil ID yang login
$id = $_SESSION["id"];

$jawabanBenar = 0;
$jawabanSalah = 0;

$id_ujian = $_SESSION["id_ujian"];

if (isset($_SESSION["jawaban"])) {
    // Looping dari 1 sampe banyaknya jawaban yang udah dijawab
    for ($i = 1; $i <= sizeof($_SESSION["jawaban"]); $i++) {
        $jawaban = "";
        // Query dari table bank soal dengan join table ke table ujian yang id nya itu adalah id ujian yang sedang
        // dikerjakan dan nomor soal yang dilooping
        $res = $koneksi->query("SELECT * FROM bank_soal INNER JOIN ujian ON bank_soal.id_ujian = ujian.id WHERE ujian.id = $id_ujian AND bank_soal.nomor_soal = $i");

        // Proses menghitung jawaban
        while ($row = $res->fetch_assoc()) {
            // Mengambil jawaban pada soal ke- i (looping)
            $jawaban = $row["jawaban"];
        }

        // Jika ada jawaban
        if (isset($_SESSION["jawaban"][$i])) {
            // Jika jawaban benar (jawaban ke-i sama dengan jawaban siswa ke-i)
            if ($jawaban == $_SESSION["jawaban"][$i]) {
                $jawabanBenar++;
            } else {
                // Jika jawaban salah
                $jawabanSalah++;
            }
        } else {
            // Jika tidak dijawab, maka dihitung salah
            $jawabanSalah++;
        }
    }
}

$totalSoal = 0;

// Query dari tabel bank soal join table dengan table ujian di mana id ujian adalah ujian yang sedang dikerjakan
$res = $koneksi->query("SELECT * FROM bank_soal INNER JOIN ujian ON bank_soal.id_ujian = ujian.id WHERE ujian.id = $id_ujian");

// Total soal berisi dari banyaknya row atau baris dari query barusan
$totalSoal = $res->num_rows;
// Jawaban salah adalah totalSoal dikurangi jawaban benar
$jawabanSalah = $totalSoal - $jawabanBenar;

// Menghitung nilai
$totalNilai = ($jawabanBenar / $totalSoal) * 100;
?>
<div class="card shadow">
    <div class="card-header">Ujian Selesai</div>
    <div class="card-body">
        Berikut adalah hasil ujian Anda:

        <ul class="list-unstyled">
            <li>Benar: <?= $jawabanBenar; ?></li>
            <li>Salah: <?= $jawabanSalah; ?></li>
            <li>Nilai: <?= $totalNilai; ?></li>
        </ul>

        <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Selesai</button>

    </div>
</div>
<?php
// Menyimpan nilai ke tabel nilai
if (isset($_SESSION["ujian_dimulai"])) {
    $date = date("Y-m-d");

    $insertNilai = $koneksi->query("INSERT INTO nilai (id_siswa, id_ujian, total_pertanyaan, jawaban_benar, jawaban_salah, waktu_ujian, total_nilai) VALUES ($id, $id_ujian, $totalSoal, $jawabanBenar, $jawabanSalah, '$date', $totalNilai)");

    unset($_SESSION["jawaban"]);
}
?>
<div class="mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ujian</h1>
</div>

<div class="mb-4">
    <h4 class="h4 mb-0 text-gray-800">Ujian Tersedia</h4>
</div>

<div class="row">
    <?php
    // Ambil sesi siswa yang login
    $id_siswa = $_SESSION['id'];

    // Ambil ujian INNER JOIN ke table user yang mana idnya adalah id yang sedang login
    $getUjian = $koneksi->query("SELECT ujian.id, tanggal, nama, waktu, mapel FROM ujian INNER JOIN users ON users.id = ujian.id_user");
    $totalUjianTersedia = 0;
    while ($ujian = $getUjian->fetch_assoc()) :

        // Looping
        // Ambil ID Ujian
        $id_ujian = $ujian['id'];

        // Hanya tampilkan soal ujian yang soalnya > 1
        $soalUjian = $koneksi->query("SELECT * FROM bank_soal WHERE id_ujian = $id_ujian")->num_rows;

        if ($soalUjian > 1) {

            // Cek apakah sudah ikut ujian atau belum, dengan cara membuat query
            // dari table nilai dengan join table ke ujian yang mana id siswanya adalah siswa yang login
            $sudahIkutUjian = $koneksi->query("SELECT * FROM nilai INNER JOIN ujian ON nilai.id_ujian = ujian.id WHERE nilai.id_siswa = $id_siswa AND  nilai.id_ujian = $id_ujian");

            // Ambil jumlah row dari query d iatas
            $cek = $sudahIkutUjian->num_rows;

            // Ambil informasi dari query
            $tanggalUjian = date('d/m/Y', strtotime($ujian['tanggal']));
            $tanggalSekarang = date('d/m/Y');
            $waktuSekarang = date('H:i:s');
            $jamUjian = date(('H:i:s'), strtotime($ujian['tanggal']));
            $waktuUjian = $ujian['waktu'];
            $waktuBisaIkutUjian = date($jamUjian, strtotime("+{$waktuUjian} minutes"));

            // Pengecekan
            if ($cek == 0 && ($tanggalUjian == $tanggalSekarang && ($waktuSekarang >= $waktuBisaIkutUjian))) {
                $totalUjianTersedia++;
        ?>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header"><?= $ujian['mapel']; ?></div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li>Guru: <?= $ujian['nama']; ?></li>
                                <li>Waktu: <?= $ujian['waktu']; ?> menit</li>
                                <li>Tanggal: <?= $tanggalUjian; ?></li>
                                <li>Jam: <?= $jamUjian; ?></li>
                            </ul>
                        </div>
                        <input type="button" class="btn btn-primary btn-block btn-lg" value="Mulai" onclick="set_exam_type_session(<?= $ujian['id']; ?>);">
                    </div>
                </div>
            <?php
            }
        } // End if soal ujian > 1
    endwhile;
    if ($totalUjianTersedia == 0) {
        ?>
        <div class="col-lg text-center">
            Belum ada ujian tersedia.
        </div>
    <?php
    }
    ?>
</div>

<div class="mb-4 pt-4">
    <h4 class="h4 mb-0 text-gray-800">Ujian Selanjutnya</h4>
</div>

<div class="row">
    <?php
    // Ini sama aja kek di atas, cuma bedaanya ini buat ngambil ujian yang akan datang atau
    // yang tanggal dan waktunya lebih besar dari tanggal dan waktu sekarang
    $id_siswa = $_SESSION['id'];

    $getUjian = $koneksi->query("SELECT ujian.id, tanggal, nama, waktu, mapel FROM ujian INNER JOIN users ON ujian.id_user = users.id");
    $totalUjianSelanjutnya = 0;
    while ($ujian = $getUjian->fetch_assoc()) :

        $id_ujian = $ujian['id'];

        $sudahIkutUjian = $koneksi->query("SELECT * FROM nilai INNER JOIN ujian ON nilai.id_ujian = ujian.id WHERE nilai.id_siswa = $id_siswa AND  nilai.id_ujian = $id_ujian");
        $cek = $sudahIkutUjian->num_rows;

        $tanggalUjian = date('d/m/Y', strtotime($ujian['tanggal']));
        $tanggalSekarang = date('d/m/Y');
        $waktuSekarang = date('H:i:s');
        $jamUjian = date(('H:i:s'), strtotime($ujian['tanggal']));
        $waktuUjian = $ujian['waktu'];
        $waktuBisaIkutUjian = date($jamUjian, strtotime("+{$waktuUjian} minutes"));

        if ($cek == 0 && ($tanggalUjian > $tanggalSekarang || ($tanggalUjian == $tanggalSekarang && $waktuSekarang <= $waktuBisaIkutUjian))) {
            $totalUjianSelanjutnya++;
    ?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header"><?= $ujian['mapel']; ?></div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>Guru: <?= $ujian['nama']; ?></li>
                            <li>Waktu: <?= $ujian['waktu']; ?> menit</li>
                            <li>Tanggal: <?= $tanggalUjian; ?></li>
                            <li>Jam: <?= $jamUjian; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        }
    endwhile;
    if ($totalUjianSelanjutnya == 0) {
        ?>
        <div class="col-lg text-center">
            Belum ada data.
        </div>
    <?php
    }
    ?>
</div>

<script type="text/javascript">
    function set_exam_type_session(id_ujian) {
        var r = confirm("Apakah kamu sudah siap ikut ujian?");
        if (r == true) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    window.location = "index.php?halaman=ujian&aksi=proses";
                }
            };
            xmlhttp.open("GET", "ajax_ujian/set_ujian_session.php?id_ujian=" + id_ujian, true);
            xmlhttp.send(null);
        }
    }
</script>
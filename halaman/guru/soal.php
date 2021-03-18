<?php

// Ambil parameter id ujian
$id = $_GET['id'];

// Query ambil info ujiannya berdasarkan id ujian
$infoUjian = $koneksi->query("SELECT * FROM ujian INNER JOIN users ON ujian.id_user = users.id WHERE ujian.id = $id")->fetch_assoc();
?>

<h3 class="h3 mb-0 text-gray-800 mb-2">Informasi Ujian</h3>
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th width="30%"><strong>Nama Guru</strong></th>
                <td><?= $infoUjian['nama']; ?></td>
            </tr>
            <tr>
                <th width="30%"><strong>Mata Pelajaran</strong></th>
                <td><?= $infoUjian['mapel']; ?></td>
            </tr>
            <tr>
                <th width="30%"><strong>Waktu</strong></th>
                <td><?= $infoUjian['waktu']; ?> menit</td>
            </tr>
            <tr>
                <th width="30%"><strong>Tanggal</strong></th>
                <td><?= date(('Y-m-d'), strtotime($infoUjian['tanggal'])); ?></td>
            </tr>
            <tr>
                <th width="30%"><strong>Jam</strong></th>
                <td><?= date(('H:i'), strtotime($infoUjian['tanggal'])); ?></td>
            </tr>
        </table>
    </div>
</div>

<h3 class="h3 mb-0 text-gray-800 pt-4 mb-2">Soal</h3>
<div class="card">
    <div class="card-body">
        <div class="pb-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Soal</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Soal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ambil semua soal dari bank soal yang idnya adalah parameter id
                    $soal = $koneksi->query("SELECT * FROM bank_soal WHERE id_ujian = $id");
                    while ($soalUjian = $soal->fetch_assoc()) :
                    ?>
                        <tr>
                            <td><?= $soalUjian['nomor_soal']; ?></td>
                            <td><?= $soalUjian['soal']; ?></td>
                            <td class="text-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-info" id="tombolUbah" data-toggle="modal" data-target="#ubahModal" data-id="<?= $soalUjian['id']; ?>" data-nomor_soal="<?= $soalUjian['nomor_soal']; ?>" data-soal="<?= $soalUjian['soal']; ?>" data-opsi_a="<?= $soalUjian['opsi_a']; ?>" data-opsi_b="<?= $soalUjian['opsi_b']; ?>" data-opsi_c="<?= $soalUjian['opsi_c']; ?>" data-opsi_d="<?= $soalUjian['opsi_d']; ?>" data-jawaban="<?= $soalUjian['jawaban']; ?>">Ubah</button>

                                    <a href=" index.php?halaman=ujian&aksi=soal&id=<?= $id; ?>&hapus=<?= $soalUjian['id']; ?>" class="btn btn-danger" name="hapus" onclick="return confirm('Hapus soal?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade text-dark" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalData" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Tambah Soal
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nomor_soal">Nomor Soal</label>
                        <input type="number" class="form-control" name="nomor_soal">
                    </div>
                    <div class="form-group">
                        <label for="soal">Soal</label>
                        <textarea name="soal" cols="5" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="opsi_a">Pilihan A</label>
                        <input type="text" class="form-control" name="opsi_a">
                    </div>
                    <div class="form-group">
                        <label for="opsi_b">Pilihan B</label>
                        <input type="text" class="form-control" name="opsi_b">
                    </div>
                    <div class="form-group">
                        <label for="opsi_c">Pilihan C</label>
                        <input type="text" class="form-control" name="opsi_c">
                    </div>
                    <div class="form-group">
                        <label for="opsi_d">Pilihan D</label>
                        <input type="text" class="form-control" name="opsi_d">
                    </div>
                    <div class="form-group">
                        <label for="jawaban">Kunci Jawaban</label>
                        <select name="jawaban" class="form-control">
                            <option value="opsi_a">A</option>
                            <option value="opsi_b">B</option>
                            <option value="opsi_c">C</option>
                            <option value="opsi_d">D</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade text-dark" id="ubahModal" tabindex="-1" aria-labelledby="ubahModalData" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Ubah Soal
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="nomor_soal">Nomor Soal</label>
                        <input type="number" class="form-control" name="nomor_soal" id="nomor_soal">
                    </div>
                    <div class="form-group">
                        <label for="soal">Soal</label>
                        <textarea name="soal" id="soal" cols="5" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="opsi_a">Pilihan A</label>
                        <input type="text" class="form-control" name="opsi_a" id="opsi_a">
                    </div>
                    <div class="form-group">
                        <label for="opsi_b">Pilihan B</label>
                        <input type="text" class="form-control" name="opsi_b" id="opsi_b">
                    </div>
                    <div class="form-group">
                        <label for="opsi_c">Pilihan C</label>
                        <input type="text" class="form-control" name="opsi_c" id="opsi_c">
                    </div>
                    <div class="form-group">
                        <label for="opsi_d">Pilihan D</label>
                        <input type="text" class="form-control" name="opsi_d" id="opsi_d">
                    </div>
                    <div class="form-group">
                        <label for="jawaban">Kunci Jawaban</label>
                        <select name="jawaban" id="jawaban" class="form-control">
                            <option value="opsi_a">A</option>
                            <option value="opsi_b">B</option>
                            <option value="opsi_c">C</option>
                            <option value="opsi_d">D</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#tombolUbah", function() {

        let id = $(this).data('id');
        let nomor_soal = $(this).data('nomor_soal');
        let soal = $(this).data('soal');
        let opsi_a = $(this).data('opsi_a');
        let opsi_b = $(this).data('opsi_b');
        let opsi_c = $(this).data('opsi_c');
        let opsi_d = $(this).data('opsi_d');
        let jawaban = $(this).data('jawaban');

        if (jawaban == opsi_a) {
            jawaban = "opsi_a";
        } else if (jawaban == opsi_b) {
            jawaban = "opsi_b";
        } else if (jawaban == opsi_c) {
            jawaban = "opsi_c";
        } else {
            jawaban = "opsi_d";
        }

        $(".modal-body #id").val(id);
        $(".modal-body #nomor_soal").val(nomor_soal);
        $(".modal-body #soal").val(soal);
        $(".modal-body #opsi_a").val(opsi_a);
        $(".modal-body #opsi_b").val(opsi_b);
        $(".modal-body #opsi_c").val(opsi_c);
        $(".modal-body #opsi_d").val(opsi_d);
        $(".modal-body #jawaban").val(jawaban);
    })
</script>

<?php

if (isset($_POST['tambah'])) {

    $nomor_soal = $_POST['nomor_soal'];
    $soal = $_POST['soal'];
    $opsi_a = $_POST['opsi_a'];
    $opsi_b = $_POST['opsi_b'];
    $opsi_c = $_POST['opsi_c'];
    $opsi_d = $_POST['opsi_d'];
    $jawaban = $_POST['jawaban'];

    // Jika pilihan jawaban adalah opsi a, maka isi jawaban dengan inputan untuk opsi A
    // dst...
    if ($jawaban == "opsi_a") {
        $jawaban = $opsi_a;
    } else if ($jawaban == "opsi_b") {
        $jawaban = $opsi_b;
    } else if ($jawaban == "opsi_c") {
        $jawaban = $opsi_c;
    } else {
        $jawaban = $opsi_d;
    }

    // Masukin ke table bank soal
    $insertSoal = $koneksi->query("INSERT INTO bank_soal (id_ujian, nomor_soal, soal, opsi_a, opsi_b, opsi_c, opsi_d, jawaban) VALUES ($id, $nomor_soal, '$soal', '$opsi_a', '$opsi_b', '$opsi_c', '$opsi_d', '$jawaban')");

    if ($insertSoal) {
?>
        <script>
            alert('Berhasil menambahkan soal!');
            window.location.href = "index.php?halaman=ujian&aksi=soal&id=<?= $id; ?>";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Gagal menambahkan soal!');
            window.location.href = "index.php?halaman=ujian&aksi=soal&id=<?= $id; ?>";
        </script>
    <?php
    }
}

if (isset($_POST['ubah'])) {

    $id_soal = $_POST['id'];
    $nomor_soal = $_POST['nomor_soal'];
    $soal = $_POST['soal'];
    $opsi_a = $_POST['opsi_a'];
    $opsi_b = $_POST['opsi_b'];
    $opsi_c = $_POST['opsi_c'];
    $opsi_d = $_POST['opsi_d'];
    $jawaban = $_POST['jawaban'];

    if ($jawaban == "opsi_a") {
        $jawaban = $opsi_a;
    } else if ($jawaban == "opsi_b") {
        $jawaban = $opsi_b;
    } else if ($jawaban == "opsi_c") {
        $jawaban = $opsi_c;
    } else {
        $jawaban = $opsi_d;
    }

    $ubahSoal = $koneksi->query("UPDATE bank_soal SET nomor_soal = $nomor_soal, soal = '$soal', opsi_a = '$opsi_a', opsi_b = '$opsi_b', opsi_c = '$opsi_c', opsi_d = '$opsi_d', jawaban = '$jawaban' WHERE id = $id_soal");

    if ($ubahSoal) {
    ?>
        <script>
            alert('Berhasil mengubah soal!');
            window.location.href = "index.php?halaman=ujian&aksi=soal&id=<?= $id; ?>";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Gagal mengubah soal!');
            window.location.href = "index.php?halaman=ujian&aksi=soal&id=<?= $id; ?>";
        </script>
    <?php
    }
}

if (isset($_GET['hapus'])) {
    $id_soal = $_GET['hapus'];

    $hapusSoal = $koneksi->query("DELETE FROM bank_soal WHERE id = $id_soal");

    if ($hapusSoal) {
    ?>
        <script>
            alert('Berhasil menghapus soal!');
            window.location.href = "index.php?halaman=ujian&aksi=soal&id=<?= $id; ?>";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Gagal menghapus soal!');
            window.location.href = "index.php?halaman=ujian&aksi=soal&id=<?= $id; ?>";
        </script>
<?php
    }
}

?>
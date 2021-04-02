<?php
ini_set('display_errors', 1);
// Ambil ID user (Guru) yang sedang login
$id_user = $_SESSION['id'];
// Ambil data ujian (yang bikin ujiannya adalah orang yang login)
// Jadi tidak semua orang bisa melihat ujian yang sama, cuma yang bikin ujian saja yg bisa melihat ujiannya
$sql = $koneksi->query("SELECT * FROM ujian WHERE id_user = $id_user");

$dataUjian = [];

while ($ujian = $sql->fetch_assoc()) {
    $dataUjian[] = $ujian;
}

foreach ($dataUjian as $ujian) {
    // Mencacri ujian yang soalnya cuma satu
    $soalUjian = $koneksi->query("SELECT * FROM bank_soal WHERE id_ujian = " . $ujian['id'] . "")->num_rows;

    if ($soalUjian < 2) {
?>
        <div class="alert alert-danger" role="alert">
            Ujian dengan mapel <?= $ujian['mapel']; ?> masih memiliki satu soal. Ujian tidak akan ditampilkan ke siswa.
        </div>
<?php
    }
}

?>
<div class="card shadow">
    <div class="card-header">
        Data Ujian
    </div>
    <div class="card-body">
        <div class="pb-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Data</button>
        </div>
        <table id="dataTable" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mapel</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Waktu</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                foreach ($dataUjian as $ujian) :

                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $ujian['mapel']; ?></td>
                        <td><?= date('Y-m-d', strtotime($ujian['tanggal'])); ?></td>
                        <td><?= date('H:i', strtotime($ujian['tanggal'])); ?></td>
                        <td><?= $ujian['waktu']; ?> menit</td>
                        <td class="text-right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="index.php?halaman=ujian&aksi=soal&id=<?= $ujian['id']; ?>" class="btn btn-success">Soal</a>
                                <button type="button" class="btn btn-info" id="tombolUbah" data-toggle="modal" data-target="#ubahModal" data-id="<?= $ujian['id']; ?>" data-mapel="<?= $ujian['mapel']; ?>" data-waktu="<?= $ujian['waktu']; ?>" data-tanggal="<?= date('Y-m-d', strtotime($ujian['tanggal'])); ?>" data-jam="<?= date('H:i', strtotime($ujian['tanggal'])); ?>">Ubah</button>
                                <a href="index.php?halaman=ujian&id=<?= $ujian['id']; ?>" class="btn btn-danger" name="hapus" onclick="return confirm('Hapus ujian?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade text-dark" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalData" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Tambah Data Ujian
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="mapel">Mapel</label>
                            <input type="text" class="form-control" name="mapel" id="mapel">
                        </div>
                        <div class="col-md-6">
                            <label for="waktu">Waktu (menit)</label>
                            <input type="number" class="form-control" name="waktu" id="waktu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal">
                        </div>
                        <div class="col-md-6">
                            <label for="jam">Jam</label>
                            <input type="time" class="form-control" name="jam" id="jam">
                        </div>
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
                Ubah Data Ujian
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="mapel">Mapel</label>
                            <input type="text" class="form-control" name="mapel" id="mapel">
                        </div>
                        <div class="col-md-6">
                            <label for="waktu">Waktu (menit)</label>
                            <input type="number" class="form-control" name="waktu" id="waktu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal">
                        </div>
                        <div class="col-md-6">
                            <label for="jam">Jam</label>
                            <input type="time" class="form-control" name="jam" id="jam">
                        </div>
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
        let mapel = $(this).data('mapel');
        let waktu = $(this).data('waktu');
        let jam = $(this).data('jam');
        let tanggal = $(this).data('tanggal');

        $(".modal-body #id").val(id);
        $(".modal-body #mapel").val(mapel);
        $(".modal-body #waktu").val(waktu);
        $(".modal-body #jam").val(jam);
        $(".modal-body #tanggal").val(tanggal);
    })
</script>

<?php

if (isset($_POST['tambah'])) {

    $mapel = $_POST['mapel'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $waktu = $_POST['waktu'];

    // Karena di table itu tanggal dan waktu digabung, maka ini digabung terlebih dahulu
    $gabungTanggalJam = date('Y-m-d H:i:s', strtotime("$tanggal $jam"));

    // Memasukkan data ke table ujian
    $insertUjian = $koneksi->query("INSERT INTO ujian (id_user, mapel, waktu, tanggal) VALUES ($id_user, '$mapel', '$waktu', '$gabungTanggalJam')");

    if ($insertUjian) {
?>
        <script>
            alert('Berhasil menambahkan ujian!');
            window.location.href = "index.php?halaman=ujian";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Gagal menambahkan ujian!');
            window.location.href = "index.php?halaman=ujian";
        </script>
    <?php
    }
}

if (isset($_POST['ubah'])) {

    $id = $_POST['id'];
    $mapel = $_POST['mapel'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $waktu = $_POST['waktu'];

    // Karena di table itu tanggal dan waktunya digabung, maka ini digabung terlebih dulu
    $gabungTanggalJam = date('Y-m-d H:i:s', strtotime("$tanggal $jam"));

    // Simpan ke table ujian
    $ubahUjian = $koneksi->query("UPDATE ujian SET mapel = '$mapel', waktu = $waktu, tanggal = '$gabungTanggalJam' WHERE id = $id");

    if ($ubahUjian) {
    ?>
        <script>
            alert('Berhasil mengubah ujian!');
            window.location.href = "index.php?halaman=ujian";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Gagal mengubah ujian!');
            window.location.href = "index.php?halaman=ujian";
        </script>
    <?php
    }
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Hapus table ujian
    $hapusUjian = $koneksi->query("DELETE FROM ujian WHERE id = $id");
    // Lalu hapus semua soal dari ujian tersebut
    $hapusSoal = $koneksi->query("DELETE FROM bank_soal WHERE id_ujian = $id");

    if ($hapusSoal) {
    ?>
        <script>
            alert('Berhasil menghapus ujian!');
            window.location.href = "index.php?halaman=ujian";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Gagal menghapus ujian!');
            window.location.href = "index.php?halaman=ujian";
        </script>
<?php
    }
}



?>
<?php

// Query siswa
// Menggunakan join table karena data loginnya terdapat di table user
// Tapi, terdapat siswa yang ada di table siswa
// Jadi, di table siswa diarahkan ke table user
$sql = $koneksi->query("SELECT * FROM users INNER JOIN siswa ON users.id = siswa.id_user WHERE level = 'siswa'");

?>
<div class="card shadow">
    <div class="card-header">
        Data Siswa
    </div>
    <div class="card-body">
        <div class="pb-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Data</button>
        </div>
        <table id="dataTable" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telp</th>
                    <th>Username</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                while ($ds = $sql->fetch_assoc()) :

                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $ds['nis']; ?></td>
                        <td><?= $ds['nama']; ?></td>
                        <td><?= $ds['kelas']; ?></td>
                        <td><?= $ds['jeniskelamin']; ?></td>
                        <td><?= $ds['telepon']; ?></td>
                        <td><?= $ds['username']; ?></td>
                        <td class="text-right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-info" id="tombolUbah" data-toggle="modal" data-target="#ubahModal" data-id="<?= $ds['id_user']; ?>" data-nis="<?= $ds['nis']; ?>" data-nama="<?= $ds['nama']; ?>" data-kelas="<?= $ds['kelas']; ?>" data-jeniskelamin="<?= $ds['jeniskelamin']; ?>" data-telepon="<?= $ds['telepon']; ?>" data-username="<?= $ds['username']; ?>">Ubah</button>
                                <!-- <a href="index.php?halaman=data-siswa&id=<?= $ds['id_user']; ?>" class="btn btn-danger" onclick="return confirm('Hapus siswa?')">Hapus</a>                            -->
                                <a href="#modalHapus" data-toggle="modal" class="btn btn-danger" onclick="$('#modalHapus #formHapus').attr('action', 'index.php?halaman=data-siswa&id=<?= $ds['id_user']; ?>')">Hapus</a>
                        
                        </td>
                        <div class="modal fade" id="modalHapus">
    <div class="modal-dialog">
        <div class="modal-content">
             <div class="modal-body">
                Apakah Anda yakin ingin menghapus data siswa?
             </div>
                <div class="modal-footer">
                <form id="formHapus" action="" method="POST">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-success" type="submit">Yakin</button>
                </form> 
                </div>
         </div>
    </div>
</div>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>



<div class="modal fade text-dark" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalData" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Tambah Data Siswa
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                <div class="form-group">
                      <label for="kelas">NIS</label>
                      <input type="number" name="nis" class="form-control" placeholder="" maxlength="8" />
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="col-md-6">
                            <label for="nama">Kelas</label>
                            <input type="text" class="form-control" name="kelas" maxlength="10" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <div class="form-check">
                                <input type="radio" name="jeniskelamin" value="Laki-Laki" class="form-check-input">
                                <label for="laki" class="form-check-label">Laki-Laki</label>
                            </div>

                            <div class="form-check">
                                <input type="radio" name="jeniskelamin" value="Perempuan" class="form-check-input">
                                <label for="perempuan" class="form-check-label">Perempuan</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="telepon">Nomor Telepon</label>
                            <input type="text" name="telepon" class="form-control" maxlength="12" />
                        </div>

                        <div class="col-md-6 pt-3">
                            <label for="nama">Username</label>
                            <input type="text" class="form-control" name="username" maxlength="8" />
                        </div>
                        <div class="col-md-6 pt-3">
                            <label for="nama">Password</label>
                            <input type="password" class="form-control" name="password" maxlength="16"/>
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
                Ubah Data Siswa
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                <div class="form-group">
                      <label for="kelas">NIS</label>
                      <input type="number" name="nis" class="form-control" id="nis" placeholder="">
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-6">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" > 
                        </div>
                        <div class="col-md-6">
                            <label for="nama">Kelas</label>
                            <input type="text" class="form-control" name="kelas" id="kelas" maxlength="10" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <div class="form-check">
                                <input type="radio" name="jeniskelamin" value="Laki-Laki" class="form-check-input" id="jeniskelamin">
                                <label for="laki" class="form-check-label">Laki-Laki</label>
                            </div>

                            <div class="form-check">
                                <input type="radio" name="jeniskelamin" value="Perempuan" class="form-check-input" id="jeniskelamin">
                                <label for="perempuan" class="form-check-label">Perempuan</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="telepon">Nomor Telepon</label>
                            <input type="text" name="telepon" class="form-control" id="telepon" maxlength="12" />
                        </div>

                        <div class="col-md-6 pt-3">
                            <label for="nama">Username</label>
                            <input type="text" class="form-control" name="username" id="username" maxlength="8" />
                        </div>
                        <div class="col-md-6 pt-3">
                            <label for="nama">Password</label>
                            <input type="password" class="form-control" name="password" id="password" maxlength="16"/>
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
        let inputJK = document.querySelectorAll('#jeniskelamin');

        let id = $(this).data('id');
        let nis = $(this).data('nis');
        let nama = $(this).data('nama');
        let kelas = $(this).data('kelas');
        let jeniskelamin = $(this).data('jeniskelamin');
        let telepon = $(this).data('telepon');
        let username = $(this).data('username');

        for (let i = 0; i < inputJK.length; i++) {
            if (inputJK[i].value == jeniskelamin) {
                inputJK[i].checked = true;
                console.log(inputJK[i].value)
                console.log(jeniskelamin)
            }
        }

        $(".modal-body #id").val(id);
        $(".modal-body #nis").val(nis);
        $(".modal-body #nama").val(nama);
        $(".modal-body #kelas").val(kelas);
        $(".modal-body #telepon").val(telepon);
        $(".modal-body #username").val(username);
    })
</script>

<?php

if (isset($_POST['tambah'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $telepon = $_POST['telepon'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Insert ke database

    // Memasukkan data ke table user
    $insertUser = $koneksi->query("INSERT INTO users (nama, username, password, level) values ('$nama', '$username', '$password', 'siswa')");

    // Jika datanya sudah masuk ke table user
    if ($insertUser) {
        // Ambil id nya (id di table user)
        $idUser = $koneksi->insert_id;

        // Kemudian masukan data yang lain ke table siswa
        $insertSiswa = $koneksi->query("INSERT INTO siswa (id_user, nis, kelas, jeniskelamin, telepon) values ($idUser, '$nis', '$kelas', '$jeniskelamin', '$telepon')");

        if ($insertSiswa) {
?>
        <link href="assets/js/sweetalert2.min.css">
        <script src="assets/js/sweetalert2.all.min.js"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'SUKSES',
                    text: 'Berhasil menambahkan siswa!'
                }).then((result) => {
                    window.location.href = "index.php?halaman=data-siswa";
                })
            </script>
        <?php
        } else {
        ?>
            <script>
               Swal.fire({
                    icon: 'error',
                    title: 'GAGAL',
                    text: 'Gagal menambahkan siswa!'
                }).then((result) => {
                    window.location.href = "index.php?halaman=data-siswa";
                })
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            Swal.fire({
                    icon: 'error',
                    title: 'GAGAL',
                    text: 'Gagal menambahkan siswa!'
                }).then((result) => {
                    window.location.href = "index.php?halaman=data-siswa";
                })
        </script>
        <?php
    }
}

if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $telepon = $_POST['telepon'];
    $username = $_POST['username'];

    // Update table user dulu
    $updateUser = $koneksi->query("UPDATE users SET username = '$username', nama = '$nama' WHERE id = $id");

    // Jika berhasil update di table user
    if ($updateUser) {
        // Update table siswa
        $updateSiswa = $koneksi->query("UPDATE siswa SET
        nis = '$nis',
        kelas = '$kelas',
        jeniskelamin = '$jeniskelamin',
        telepon = '$telepon'
        WHERE id_user = $id");

        if ($updateSiswa) {
        ?>
        <link href="assets/js/sweetalert2.min.css">
        <script src="assets/js/sweetalert2.all.min.js"></script>
            <script>
               Swal.fire({
                    icon: 'success',
                    title: 'SUKSES',
                    text: 'Data siswa berhasil diubah!'
                }).then((result) => {
                    window.location.href = "index.php?halaman=data-siswa";
                })
            </script>
        <?php
        } else {
        ?>
            <script>
               Swal.fire({
                    icon: 'error',
                    title: 'GAGAL',
                    text: 'Data siswa gagal diubah!'
                }).then((result) => {
                    window.location.href = "index.php?halaman=data-siswa";
                })
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            Swal.fire({
                    icon: 'error',
                    title: 'GAGAL',
                    text: 'Data siswa gagal diubah!'
                }).then((result) => {
                    window.location.href = "index.php?halaman=data-siswa";
                })
        </script>
        <?php
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus dari table user
    $hapusUser = $koneksi->query("DELETE FROM users WHERE id = $id");

    // Jika berhasil hapus dari table user
    if ($hapusUser) {
        // Hapus table siswa
        $hapusSiswa = $koneksi->query("DELETE FROM siswa WHERE id_user = $id");

        if ($hapusSiswa) {
        ?>
        <link href="assets/js/sweetalert2.min.css">
        <script src="assets/js/sweetalert2.all.min.js"></script>
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        
            <script>
             Swal.fire({
                    icon: 'success',
                    title: 'SUKSES',
                    text: 'Data siswa berhasil dihapus!'
                }).then((result) => {
                    window.location.href = "index.php?halaman=data-siswa";
                })
            </script>
        <?php
        } else {
        ?>
            <script>
               alert('Gagal menghapus siswa!');
                window.location.href = "index.php?halaman=data-siswa";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert('Gagal menghapus siswa!');
            window.location.href = "index.php?halaman=data-siswa";
        </script>
<?php
    }
}

?>
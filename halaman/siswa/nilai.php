<div class="card shadow">
    <div class="card-header">
        Nilai Ujian Saya
    </div>
    <div class="card-body">
    <table id="dataTable" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Total Soal</th>
                    <th>Benar</th>
                    <th>Salah</th>
                    <th>Waktu Ujian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query ambil nilai ujian INNER JOIN ke table ujian berdasarkan id_ujiannya di mana id siswanya
                // adalah id yang login
                $sql = $koneksi->query("SELECT * FROM nilai INNER JOIN ujian ON nilai.id_ujian = ujian.id WHERE id_siswa = $_SESSION[id]");
                $no = 1;
                while ($nilai = $sql->fetch_assoc()) :

                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $nilai['mapel']; ?></td>
                        <td><?= $nilai['total_pertanyaan']; ?></td>
                        <td><?= $nilai['jawaban_benar']; ?></td>
                        <td><?= $nilai['jawaban_salah']; ?></td>
                        <td><?= $nilai['waktu_ujian']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
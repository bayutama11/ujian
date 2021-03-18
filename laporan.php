<?php
include('config/koneksi.php');
$id_ujian = $_POST['id_ujian'];

$sql = $koneksi->query("SELECT mapel FROM ujian WHERE id = $id_ujian");
$infoUjian = $sql->fetch_assoc();

?>
<link rel="icon" href="assets/gambar/logosmk.png">
<title>Laporan Ujian <?php echo $infoUjian['mapel']; ?></title>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    h1,
    h4 {
        text-align: center;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    @media print {
        #ngeprint {
            display: none;
        }
    }
</style>
<h1>Laporan Ujian <?php echo $infoUjian['mapel']; ?></h1>
<input type="button" value="Cetak" onclick="window.print();" id="ngeprint" />
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Total Pertanyaan</th>
            <th>Jawaban Benar</th>
            <th>Jawaban Salah</th>
            <th>Tanggal Ujian</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $nilai = $koneksi->query("SELECT * FROM nilai INNER JOIN users ON nilai.id_siswa = users.id WHERE id_ujian = $id_ujian");
        while ($data = $nilai->fetch_assoc()) :
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['total_pertanyaan']; ?></td>
                <td><?php echo $data['jawaban_benar']; ?></td>
                <td><?php echo $data['jawaban_salah']; ?></td>
                <td><?php echo $data['waktu_ujian']; ?></td>
            </tr>
        <?php
        endwhile;
        ?>
    </tbody>
</table>
<br />
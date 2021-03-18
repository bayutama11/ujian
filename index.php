<?php

include "config/autoload.php";

$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "";
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : "";

include "template/header.php";

?>
<div class="container-fluid">
    <?php

    if ($_SESSION['level'] == "guru") {
        if (!empty($halaman)) {
            switch ($halaman) {
                case "data-siswa":
                    include "halaman/guru/data_siswa.php";
                    break;
                case "ujian":
                    if ($aksi == 'soal') {
                        include "halaman/guru/soal.php";
                    } else {
                        include "halaman/guru/data_ujian.php";
                    }
                    break;
                default:
                    include "halaman/guru/dashboard_guru.php";
            }
        } else {
            include "halaman/guru/dashboard_guru.php";
        }
    } else {
        if (!empty($halaman)) {
            switch ($halaman) {
                case "ujian":
                    if ($aksi == 'proses') {
                        include "halaman/siswa/proses_ujian.php";
                    } else if ($aksi == 'hasil') {
                        include "halaman/siswa/hasil_ujian.php";
                    } else {
                        include "halaman/siswa/ujian.php";
                    }
                    break;
                case "nilai":
                    include "halaman/siswa/nilai.php";
                    break;
                default:
                    include "halaman/siswa/dashboard_siswa.php";
            }
        } else {
            include "halaman/siswa/dashboard_siswa.php";
        }
    }
    ?>
</div>
<?php

include "template/footer.php";

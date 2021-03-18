<div class="card shadow">
    <div class="card-header">
        <div class="text-rigt d-flex">
            <h4 id="current_que" class="ml-auto"></h4>
            <h4>/</h4>
            <h4 id="total_que"></h4>
            <h4 class="pl-4" id="waktu_ujian">Waktu</h4>
        </div>
    </div>
    <div class="card-body" id="load_questions">
    </div>
    <div class="card-footer text-right">
        <input type="button" id="kembali" class="btn btn-warning" value="Kembali" onclick="load_previous();">
        <input type="button" id="berikutnya" class="btn btn-success" value="Berikutnya" onclick="load_next();">
        <input type="button" id="selesai" class="btn btn-success" value="Selesai" onclick="load_done();">
    </div>
</div>

<script type="text/javascript">
    // Set questionno = Nomor soal menjadi 1
    var questionno = 1;
    // Set total soal = 0
    var totalquestion = 0;

    // Load total soal
    function load_total_que() {
        // Melakukan XMLHttp Request
        var xmlhttp = new XMLHttpRequest();
        // Jika XMLHttp sudah dapat
        xmlhttp.onreadystatechange = function() {
            // Cek statusnya
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // Ambil responsenya
                document.getElementById("total_que").innerHTML = xmlhttp.responseText;
                totalquestion = xmlhttp.responseText;
            }
        };
        // URL melakukan request
        xmlhttp.open("GET", "ajax_ujian/total_nomor.php", true);
        xmlhttp.send(null);

        // Jika nomor soal = 1
        if (questionno == 1) {
            // Sembunyikan tombol kembali
            document.getElementById("kembali").style = "display: none";
        } else {
            // Tampilkan tombol kembali
            document.getElementById("kembali").style = "display: inline-block";
        }

        // Jika nomor soal = banyaknya soal (soal terakhir)
        if (questionno == totalquestion) {
            // Sembunyikan tombol berikutnya, dan tampilkan tombol selesai
            document.getElementById("berikutnya").style = "display: none";
            document.getElementById("selesai").style = "display: inline-block";
        } else {
            // Tampilkan tombol berikutnya, dan sembunyikan tombol selesai
            document.getElementById("berikutnya").style = "display: inline-block";
            document.getElementById("selesai").style = "display: none";
        }
    }

    // Load waktu ujian
    function load_waktu_ujian() {
        // XMLHttpRequest lagi
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("waktu_ujian").innerHTML = xmlhttp.responseText;
                // Jika waktu habis, arahkan ke halaman hasil ujian
                if (xmlhttp.responseText == '00:00:00'){
                    window.location = "index.php?halaman=ujian&aksi=hasil";
                }
            }
        };
        xmlhttp.open("GET", "ajax_ujian/memuat_waktu_ujian.php", true);
        xmlhttp.send(null);
    }

    // Refresh waktu ujian setiap 100ms
    window.setInterval(function() {
        load_waktu_ujian();
    }, 100);

    // Ambil soal berdasarkan nomor soal yang sedang berjalan
    load_questions(questionno);

    // XMLHTTPRequest lagi untuk mengambil soal
    function load_questions(questionno) {
        document.getElementById("current_que").innerHTML = questionno;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
                load_total_que();
            }
        };
        xmlhttp.open("GET", "ajax_ujian/memuat_soal.php?nomor_soal=" + questionno, true);
        xmlhttp.send(null);
    }

    // Ketika jawaban dipilih
    function radioclick(radiovalue, questionno) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            }
        };
        // Simpan jawabannya, dengan mengambil nomor soal sekarang + jawabannya
        xmlhttp.open("GET", "ajax_ujian/simpan_jawaban.php?nomor_soal=" + questionno + "&jawaban=" + radiovalue, true);
        xmlhttp.send(null);
    }

    // Membuka soal sebelumnya
    function load_previous() {
        if (questionno == "1") {
            load_questions(questionno);
        } else {
            questionno = eval(questionno) - 1;
            load_questions(questionno);
        }
    }

    // Membuka soal berikutnya
    function load_next() {
        if (questionno < 0) {
            questionno = eval(questionno) + 0;
            load_questions(questionno);
        } else {
            questionno = eval(questionno) + 1;
            load_questions(questionno);
        }
    }

    // Ketika tombol "selesai" diklik
    function load_done() {
        window.location = "index.php?halaman=ujian&aksi=hasil";
    }
</script>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ASESMEN MEDIS PASIEN BEDAH</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

</head>

<body>

    <div class="container mt-5">
        <form action="<?= site_url('#') ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <h6 align="right">RMJ.2.4</h6>
            <table class="table table-bordered mb-2" style="border: 2px solid black">
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3" align="center">
                                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">

                                <p class="mt-2">Sehat-Amanah <br> Tanggung Jawab-Islami</p>
                            </div>
                            <div class="col-md-5 mt-2">
                                <h5>RS. PKU MUHAMMADIYAH SAMPANGAN</h5>
                                <p>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta <br> Telp 0271-633894 Fax. : 0271-630229 <br> Jawa Tengah 57117</p>
                            </div>
                            <div class="col-md-4 align-items-center">
                                <div class="container mt-1" style="border:1px solid black; padding-top:70px; height:160px; border-radius: 10px">
                                    <p class="text-center">Label Identitas Pasien</p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 2px solid black">
                    <td colspan="2">
                        <h5 class="text-center">ASESMEN MEDIS PASIEN BEDAH</h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Tanggal</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="date" name="v_01" id="v_01">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Jam</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="time" name="v_02" id="v_02">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <strong><label>Riwayat Alergi</label></strong>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_03" id="v_03">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <h6>ANAMNESIS</h6>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_01" id="t_01_autoanamnesis" value="1">
                                                <strong><label for="t_01_autoanamnesis">Autoanamnesis</label></strong>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_01" id="t_01_alloanamnesis" value="2">
                                                <strong><label for="t_01_alloanamnesis">Alloanamnesis</label></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Dengan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_04" id="v_04">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label>Hubungan dengan pasien</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="v_05" id="v_05">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="container">
                            <ul>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <strong><label>Keluhan Utama</label></strong>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="v_06" id="v_06" cols="6" rows="2"></textarea>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <strong><label>Riwayat Penyakit Sekarang</label></strong>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="v_07" id="v_07" cols="6" rows="3"></textarea>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <div class="row align-items-center">
                                                <div class="col-md-5">
                                                    <label>Alloanamnesis</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="v_08" id="v_08">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <label>Hubungan dengan pasien</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="v_09" id="v_09">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <strong><label>Riwayat Penyakit Dahulu</label></strong>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="v_10" id="v_10" cols="6" rows="3"></textarea>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <strong><label>Riwayat obat yang dikonsumsi</label></strong>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="v_11" id="v_11" cols="6" rows="4"></textarea>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>PEMERIKSAAN FISIK</h6>
                        <div class="container">
                            <strong>
                                <p>Vital Sign</p>
                            </strong>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">TD</span>
                                        <input type="text" class="form-control" name="tension_upper" id="tension_upper">
                                        <span class="input-group-text">/</span>
                                        <input type="text" class="form-control" name="tension_below" id="tension_below">
                                        <span class="input-group-text">mmHg</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">N</span>
                                        <input type="text" class="form-control" name="nadi" id="nadi">
                                        <span class="input-group-text">x/menit</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">S</span>
                                        <input type="text" class="form-control" name="temperature" id="temperature">
                                        <span class="input-group-text">C</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">RR</span>
                                        <input type="text" class="form-control" name="nafas" id="nafas">
                                        <span class="input-group-text">x/menit</span>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <h6>Status Lokalis</h6>
                        <br>
                        <div class="col-md-12 text-center align-items-center">
                            <div class="container" style="border:1px solid black">
                                <img class="mt-3" src="<?= base_url('assets/bedah.png') ?>" width="1000px">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>Pemeriksaan Penunjang</h6>
                        <textarea class="form-control" name="v_12" id="v_12" cols="6" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>Diagnosis Kerja</h6>
                        <textarea class="form-control" name="v_13" id="v_13" cols="6" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>Terapi</h6>
                        <textarea class="form-control" name="v_14" id="v_14" cols="6" rows="10"></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="15%">
                        <h6>RENCANA TINDAK LANJUT</h6>
                    </td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_03" id="t_03_rj" value="1">
                                    <label for="t_03_rj">Rawat Jalan</label>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="t_03" id="t_03_ri" value="2">
                                            <label for="t_03_ri">Rawat Inap, DPJP rawat Inap </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_15" id="v_15">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Ruang</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_16" id="v_16">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Indikasi</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_17" id="v_17">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label class="col-form-label">Pengantar Pasien</label>
                            </div>
                            <div class="col-md-7">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_04" id="t_04_ada" value="1">
                                    <strong><label for="t_04_ada">Ada</label></strong>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_04" id="t_04_tidak" value="0">
                                    <strong><label for="t_04_tidak">Tidak (Bila tidak, rujuk ke Dinas Sosial)</label></strong>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p>Rujuk Ke :</p>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="t_05" id="t_05_rs" value="1">
                                            <label for="t_05_rs">RS</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_18" id="v_18">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="t_05" id="t_05_puskesmas" value="2">
                                            <label for="t_05_puskesmas">Puskesmas</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_19" id="v_19">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_05" id="t_05_homecare" value="3">
                                    <label for="t_05_homecare">Homecare</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="t_05" id="t_05_keluarga" value="4">
                                            <label for="t_05_keluarga">Dokter Keluarga</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_20" id="v_20">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="t_05" id="t_05_dokter" value="5">
                                            <label for="t_05_dokter">Dokter</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_21" id="v_21">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <label for="t_05_klinik">Kontrol Klinik / Homecare </label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_22" id="v_22">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Tanggal</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input class="form-control" type="date" name="v_23" id="v_23">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>EDUKASI PASIEN</h6>
                    </td>
                    <td>
                        <p>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada :</p>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="t_06" id="t_06_pasien" value="1">
                                <label for="t_06_pasien">Pasien</label>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="t_06" id="t_06_keluarga" value="2">
                                        <label for="t_06_keluarga">Keluarga Pasien, nama</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="v_24" id="v_24">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_06" id="t_06_tidak" value="3">
                                    <label for="t_06_tidak">Tidak dapat memberi edukasi kepada pasien atau keluarga, Karena </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-input">
                                    <input class="form-control" type="text" name="v_25" id="v_25">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-enter">
                            <div class="col-md-6 text-center">
                                <p>Dokter</p>
                                <br>
                                <canvas id="canvas" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" id="ttd" name="ttd">
                                <br>
                                <br>
                                <div class="col-sm-6 mx-auto">
                                    <input type="text" class="form-control" id="v_26" name="v_26">
                                </div>
                                <p>TTD dan Nama Terang</p>
                            </div>
                            <div class="col-md-6 text-center align-items-center">
                                <p>Penerima Penjelasan</p>
                                <br>
                                <canvas id="canvas1" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" id="ttd_1" name="ttd_1">
                                <br>
                                <br>
                                <div class="col-sm-6 mx-auto">
                                    <input type="text" class="form-control" id="v_27" name="v_27">
                                </div>
                                <p>TTD dan Nama Terang</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

<script>
    var canvas = document.getElementById('canvas');
    const canvasDataInput = document.getElementById('ttd');
    var context = canvas.getContext('2d');

    var drawing = false;

    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context.lineWidth = 2;
        context.lineCap = 'round';
        context.strokeStyle = '#000';

        // Draw a line
        context.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
        context.stroke();
        context.beginPath();
        context.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context.beginPath();
    }

    function saveSignatureData() {
        const canvasData = canvas.toDataURL('image/png');
        canvasDataInput.value = canvasData;
    }
</script>

<script>
    var canvas1 = document.getElementById('canvas1');
    const canvasDataInput1 = document.getElementById('ttd_1');
    var context1 = canvas1.getContext('2d');
    var drawing = false;

    canvas1.addEventListener('mousedown', startDrawing);
    canvas1.addEventListener('mousemove', draw);
    canvas1.addEventListener('mouseup', stopDrawing);
    canvas1.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context1.lineWidth = 2;
        context1.lineCap = 'round';
        context1.strokeStyle = '#000';

        context1.lineTo(e.clientX - canvas1.getBoundingClientRect().left, e.clientY - canvas1.getBoundingClientRect().top);
        context1.stroke();
        context1.beginPath();
        context1.moveTo(e.clientX - canvas1.getBoundingClientRect().left, e.clientY - canvas1.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context1.beginPath();
    }

    function saveSignatureData1() {
        const canvasData1 = canvas1.toDataURL('image/png');

        canvasDataInput1.value = canvasData1;
    }
</script>

</html>
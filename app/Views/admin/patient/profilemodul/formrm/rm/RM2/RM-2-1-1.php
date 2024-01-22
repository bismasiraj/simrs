<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ASSESSMENT MEDIS PASIEN ANAK</title>

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
            <h6 align="right">RM 2.1.1</h6>
            <h4 class="text-center">REKAM MEDIS RAWAT INAP</h4>
            <table class="table table-bordered mb-2" style="border: 2px solid black">
                <tr>
                    <td width="20%" align="center">
                        <img class="mt-3" src="<?= base_url('assets/logopku.png') ?>" width="80px">

                        <p class="mt-3">Sehat-Amanah <br> Tanggung Jawab-Islami</p>
                    </td>
                    <td width="45%" style="padding-top: 40px;">
                        <h5>RS. PKU MUHAMMADIYAH SAMPANGAN</h5>
                        <p>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta <br> Telp 0271-633894 Fax. : 0271-630229 <br> Jawa Tengah 57117</p>
                    </td>
                    <td width="35%">
                        <div class="container mt-1" style="border:1px solid black; padding-top:30px; height:170px;">
                            <p class="text-center">Label Identitas Pasien</p>
                        </div>

                    </td>
                </tr>
                <tr style="border: 2px solid black">
                    <td colspan="3">
                        <h5 class="text-center">ASESMEN MEDIS PASIEN ANAK</h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h6 class="text-center">Diisi oleh Dokter</h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
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
                    <td colspan="3">
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
                                        <input class="form-control" type="text" name="v_03" id="v_03">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label>Hubungan dengan pasien</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="v_04" id="v_04">
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
                                            <label>Keluhan Utama</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="v_05" id="v_05">
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <label>Riwayat Penyakit Sekarang</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="v_06" id="v_06" cols="6" rows="3"></textarea>
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
                                                    <input class="form-control" type="text" name="v_07" id="v_07">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <label>Hubungan dengan pasien</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="v_08" id="v_08">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <label>Riwayat Penyakit Dahulu</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="v_09" id="v_09" cols="6" rows="2"></textarea>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <label>Obat-obatan yang Dikonsumsi</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="v_10" id="v_10" cols="6" rows="2"></textarea>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <label for="">Riwayat Penyakit Keluarga & Pohon Keluarga</label>
                                    <textarea class="form-control" name="v_11" id="v_11" cols="6" rows="2"></textarea>
                                </li>
                                <br>
                                <li>
                                    <label for="">Riwayat Kehamilan dan Persalinan</label>
                                    <textarea class="form-control" name="v_12" id="v_12" cols="6" rows="2"></textarea>
                                </li>
                                <br>
                                <li>
                                    <label for="">Riwayat Makanan</label>
                                    <input class="form-control" type="text" name="v_13" id="v_13">
                                </li>
                                <br>
                                <li>
                                    <label for="">Riwayat Pertumbuhan dan Perkembangan</label>
                                    <input class="form-control" type="text" name="v_14" id="v_14">
                                </li>
                                <br>
                                <li>
                                    <p>Riwayat Imunisasi</p>
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <label>a. Imunisasi Dasar</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="v_15" id="v_15">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <label>b. Imunisasi Lanjutan</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="v_16" id="v_16">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <br>

                        <h6>PEMERIKSAAN FISIK</h6>

                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <strong><label>A. Keadaan Umum</label></strong>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="v_17" id="v_17">
                                </div>
                            </div>
                            <div class="container">
                                <p>Tanda Vital</p>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">TD</span>
                                        <input type="text" class="form-control" name="tension_upper" id="tension_upper">
                                        <span class="input-group-text">/</span>
                                        <input type="text" class="form-control" name="tension_below" id="tension_below">
                                        <span class="input-group-text">mmHg</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Nadi</span>
                                        <input type="text" class="form-control" name="nadi" id="nadi">
                                        <span class="input-group-text">x/menit</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">R</span>
                                        <input type="text" class="form-control" name="nafas" id="nafas">
                                        <span class="input-group-text">x/menit</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">S</span>
                                        <input type="text" class="form-control" name="temperatre" id="temperatre">
                                        <span class="input-group-text">C</span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <strong><label>B. Status General</label></strong>
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>1. Status Gizi </label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">BB</span>
                                            <input type="text" class="form-control" name="weight" id="weight">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">TB</span>
                                            <input type="text" class="form-control" name="height" id="height">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">LK</span>
                                            <input type="text" class="form-control" name="head" id="head">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>2. Kepala</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_18" id="v_18">
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>3. Leher</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_19" id="v_19">
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>4. <i>Thorax</i></label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_20" id="v_20">
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>5. Jantung</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_21" id="v_21">
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>6. Paru-paru</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_22" id="v_22">
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>7. <i>Abdomen</i></label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_23" id="v_23">
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>8. Genitalia</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_24" id="v_24">
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>9. <i>Extremitas</i></label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_25" id="v_25">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <strong><label>C. Pemeriksaan Fisik Tambahan</label></strong>
                            <textarea class="form-control" name="v_26" id="v_26" cols="6" rows="2"></textarea>
                        </div>

                        <br>
                        <h6>PEMERIKSAAN PENUNJANG</h6>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label>1. Laboratorium</label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="v_27" id="v_27">
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label>2. Radiologi</label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="v_28" id="v_28">
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label>3. ECG</label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="v_29" id="v_29">
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label>4. lain-lain</label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="v_30" id="v_30">
                                </div>
                            </div>
                        </div>

                        <br>
                        <h6>DIAGNOSIS KERJA</h6>
                        <textarea class="form-control" name="v_31" id="v_31" cols="6" rows="3"></textarea>

                        <br>
                        <h6>DIAGNOSIS BANDING</h6>
                        <textarea class="form-control" name="v_32" id="v_32" cols="6" rows="2"></textarea>

                        <br>
                        <h6>MASALAH</h6>
                        <p>1. Medis : </p>
                        <textarea class="form-control" name="v_33" id="v_33" cols="6" rows="2"></textarea>
                        <p>2. Keperawatan</p>
                        <textarea class="form-control" name="v_34" id="v_34" cols="6" rows="2"></textarea>

                        <br>
                        <h6>SASARAN</h6>
                        <textarea class="form-control" name="v_35" id="v_35" cols="6" rows="2"></textarea>

                        <br>
                        <h6>RENCANA ASUHAN/ TERAPI/INSTRUKSI (standing order)</h6>
                        <textarea class="form-control" name="v_36" id="v_36" cols="6" rows="15"></textarea>
                        <br>
                        <br>
                        <br>
                        <div class="row align-items-enter">
                            <div class="col-md-6 text-center">
                                <p>Dokter</p>
                                <br>
                                <canvas id="canvas" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" id="ttd" name="ttd">
                                <br>
                                <br>
                                <div class="col-sm-6 mx-auto">
                                    <input type="text" class="form-control" id="v_37" name="v_37">
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
                                    <input type="text" class="form-control" id="v_38" name="v_38">
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
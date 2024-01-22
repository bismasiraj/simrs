<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assessment Medis Pasien Gigi dan Saraf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
</head>

<body>
    <div class="container">
        <a href="<?= base_url('pku/halamanform2') ?>" class="btn btn-success mt-3"><i class="bi bi-arrow-left"></i></a>
        <div class="row align-items-center">
            <p class="text-end">RMJ 2.8</p>
            <h6 class="text-center">REKAM MEDIS RAWAT JALAN</h6>
        </div>
        <form action="" method="">
            <table class="table table-bordered" style="border: 1px;">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-3" align='middle'>
                                <img src="<?= base_url('uploads/pku.png') ?>" alt="Gambar" width="90px">
                                <p style="font-size: 12px;">SEhat-aMANah-<br>tanGGungjawab-Islami</p>
                            </div>
                            <div class="col-6">
                                <h5><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h5>
                                <h6><b>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta</b></h6>
                                <p>Telp 0271-633894 Fax. : 0271-630229
                                    <br>Jawa Tengah 57117
                                </p>
                            </div>
                            <div class="col-3">
                                <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                                    <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <h6 style="text-align: center;">ASESMEN MEDIS PASIEN GIGI DAN MULUT</h6>
            <table class="table table-bordered mb-0" style="border: 1px;">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <label for="V_01">Tanggal:</label>
                            <input type="date" id="V_01" name="V_01">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="V_02">Riwayat alergi:</label>
                            <input type="text" id="V_02" name="V_02" style="width: 300px;">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_01" id="T_01_Autoanamnesis" value="1">
                                        <label class="form-check-label" for="T_01_Autoanamnesis">Autoanamnesis</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_01" id="T_01_Alloanamnesis" value="2">
                                        <label class="form-check-label" for="T_01_Alloanamnesis">Alloanamnesis</label>
                                    </div>
                                    <span style="margin-left:10px;">dengan:</span>
                                    <input type="text" name="V_03" id="V_03" style="width: 120px;">
                                    <span style="margin-left: 10px;">Hubungan dengan Pasien:</span>
                                    <input type="text" name="V_04" id="V_03" style="width: 222px;">
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-3">
                                        <p><strong><u>Keluhan utama (CC dan PI)</u>:</strong></p>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="V_04" name="V_04" style="width: 100%;">
                                    </div>
                                </div>
                                <p><u>Riwayat kesehatan (PDH dan PMH)</u></p>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <label for="V_05"><strong>Umum :</strong></label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="V_05" name="V_05" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <label for="V_06"><strong>Gigi dan Mulut :</strong></label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="V_06" name="V_06" style="width: 100%;">
                                    </div>
                                </div>
                                <p><u>Riwayat lain (FH dan SH)</u></p>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="V_07"><strong>Obat-obatan yang dikonsumsi :</strong></label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="V_07" name="V_07" style="width: 100%;">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" width="60%">
                            <p><u>Pemeriksaan Fisik :</u></p>

                            <div class="row">
                                <div class="col-2">
                                    <p><strong>Vital sign</strong> :</p>
                                </div>
                                <div class="col-3">
                                    <span style="margin-left: 10px;">TD:</span>
                                    <input type="text" id="V_08" name="V_08" style="width: 50px;">
                                    <span>/</span>
                                    <input type="text" id="V_09" name="V_09" style="width: 50px;">
                                    <span>mmHg</span>
                                </div>
                                <div class="col-2">
                                    <span>N:</span>
                                    <input type="text" id="V_10" name="V_10" style="width: 50px;">
                                    <span>x/menit</span>
                                </div>
                                <div class="col-2">
                                    <span>R:</span>
                                    <input type="text" id="V_11" name="V_11" style="width: 50px;">
                                    <span>x/menit</span>
                                </div>
                                <div class="col-2">
                                    <span style="margin-left: 10px;">S:</span>
                                    <input type="text" id="V_12" name="V_12" style="width: 50px;">
                                    <span>°C</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" width="40%">
                            <p><strong>STATUS INTRA ORAL</strong></p>

                            <div class="container">
                                <img class="mb-3" src="<?= base_url('uploads/intra_oral.png') ?>" alt="" width="90%">
                                <br>
                                <img src="<?= base_url('uploads/intra_oral2.png') ?>" alt="" style="width: 90%;">
                            </div>
                        </td>
                        <td>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label for="V_13">Mukosa bibir, pipi :</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="V_13" name="V_13" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label for="V_14">Dasar mulut :</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="V_14" name="V_14" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label for="V_15">Lidah :</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="V_15" name="V_15" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label for="V_16">Gingiva :</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="V_16" name="V_16" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label for="V_17">Orofaring :</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="V_17" name="V_17" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <label for="V_18">Oklusi :</label>
                                </div>
                                <div class="col-5">
                                    <input type="checkbox" class="form-check-input" id="T_02_normal" name="T_02" value="1">
                                    <label for="T_02_normal" class="form-check-label">normal bite</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" id="V_18" name="V_18" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="V_19">Torus palatinus :</label>
                                </div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_03_kecil" name="T_03" value="1">
                                    <label for="T_03_kecil" class="form-check-label">kecil</label>
                                </div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_03_sdg" name="T_03" value="2">
                                    <label for="T_03_sdg" class="form-check-label">Sdg</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6"></div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_03_bsr" name="T_03" value="3">
                                    <label for="T_03_bsr" class="form-check-label">Bsr</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" id="V_19" name="V_19" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>Torus mandibularis</label>
                                </div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_04_kecil" name="T_04" value="1">
                                    <label for="T_04_kecil" class="form-check-label">kecil</label>
                                </div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_04_sdg" name="T_04" value="2">
                                    <label for="T_0_sdg" class="form-check-label">sdg</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">

                                </div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_04_besar" name="T_04" value="3">
                                    <label for="T_04_besar" class="form-check-label">Bsr</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>Palatum :</label>
                                </div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_05_dalam" name="T_05" value="1">
                                    <label for="T_05_dalam" class="form-check-label">dlm</label>
                                </div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_05_sedang" name="T_05" value="2">
                                    <label for="T_05_sedang" class="form-check-label">sdg</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6"></div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_05_rendah" name="T_05" value="3">
                                    <label for="T_05_rendah" class="form-check-label">rndh</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="V_20">Super numary :</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" class="form-check-input" id="T_06_tidak" name="T_06" value="1">
                                    <label for="T_06_tidak" class="form-check-label">tdk ada</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6"></div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_06_ada" name="T_06" value="2">
                                    <label for="T_06_ada" class="form-check-label">ada</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" id="V_20" name="V_20" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="V_21">Gigi anomaly :</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" class="form-check-input" id="T_07_tidak" name="T_07" value="1">
                                    <label for="T_07_tidak" class="form-check-label">tdk ada</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6"></div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_07_ada" name="T_07" value="2">
                                    <label for="T_07_ada" class="form-check-label">ada</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" id="V_21" name="V_21" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="V_22">Diastema :</label>
                                </div>
                                <div class="col-5">
                                    <input type="radio" class="form-check-input" id="T_08_tidak" name="T_08" value="1">
                                    <label for="T_08_tidak" class="form-check-label">tdk ada</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6"></div>
                                <div class="col-3">
                                    <input type="radio" class="form-check-input" id="T_08_ada" name="T_08" value="2">
                                    <label for="T_08_ada" class="form-check-label">ada</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" id="V_22" name="V_22" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="V_23">Lain-lain</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="V_23" name="V_23" style="width: 100%;">
                                </div>
                            </div>
                        </td>
                    </tr>
            </table>
            <table class="table table-bordered mt-0" style="border: 1px;">
                <tr>
                    <td colspan="4">
                        <p><strong>Pemeriksaan Penunjang :</strong></p>
                        <textarea name="V_24" id="V_24" cols="30" rows="10" style="width: 100%;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p><strong>Diagnosa Kerja :</strong></p>
                        <textarea name="V_25" id="V_25" cols="30" rows="10" style="width: 100%;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p><strong>Terapi :</strong></p>
                        <textarea name="V_26" id="V_26" cols="30" rows="10" style="width: 100%;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td rowspan="4" width="10%">
                        <p><strong>RENCANA TINDAK LANJUT</strong></p>
                    </td>
                    <td>
                        <input type="radio" class="form-check-input" id="T_09_jalan" name="T_09" value="1">
                        <label for="T_09_jalan" class="form-check-label">Rawat Jalan</label>
                        <br>
                        <input type="radio" class="form-check-input" id="T_09_inap" name="T_09" value="2">
                        <label for="T_09_inap" class="form-check-label">Rawat Inap</label>
                        <br>
                        <label for="V_27">DPJP Rawat Inap</label>
                        <input type="text" id="V_27" name="V_27" style="width: 50%;">
                    </td>
                    <td class="text-center">
                        <label for="V_28">Ruang:</label>
                        <input type="text" id="V_28" name="V_28" style="width: 50%;">
                    </td>
                    <td class="text-center">
                        <label for="V_29">Indikasi:</label>
                        <input type="text" id="V_29" name="V_29" style="width: 50%;">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-3">
                                <p>Pengantar Pasien:</p>
                            </div>
                            <div class="col-2">
                                <input type="radio" class="form-check-input" id="T_010_ada" name="T_010" value="1">
                                <label for="T_010_ada">Ada</label>
                            </div>
                            <div class="col-2">
                                <input type="radio" class="form-check-input" id="T_010_tidak" name="T_010" value="2">
                                <label for="T_010_tidak" class="form-check-label">Tidak</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <label for="V_30">Rujuk ke :</label>
                        <input type="text" id="V_30" name="V_30" style="width: 50%;">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-3">
                                <input type="radio" class="form-check-input" id="T_011_klinik" name="T_011" value="1">
                                <label for="T_011_klinik" class="form-check-label">Kontrol klinik</label>
                            </div>
                            <div class="col-3">
                                <input type="radio" class="form-check-input" id="T_011_homecare" name="T_011" value="2">
                                <label for="T_011_homecare" class="form-check-label">homecare</label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <label for="V_31">Tanggal:</label>
                        <input type="date" id="V_31" name="V_31">
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><strong>EDUKASI PASIEN</strong></p>
                    </td>
                    <td colspan="3">
                        <div class="row">
                            <div class="col">
                                <p>Edukasi Awal, disampaikan tentang Diagnosis, Rencana Perawatan, dan Tujuan Perawatan kepada</p>
                                <input type="checkbox" class="form-check-input" id="T_012_pasien" name="T_012" value="1">
                                <label for="T_012_pasien" class="form-check-label">Pasien</label>
                                <br>
                                <input type="checkbox" class="form-check-input" id="T_013_keluarga" name="T_013" value="1">
                                <label for="T_013_keluarga" class="form-check-label">Keluarga Pasien, nama</label>
                                <input type="text" id="V_32" name="V_32">
                                <br>
                                <input type="checkbox" class="form-check-input" id="T_014_tidak" name="T_014" value="1">
                                <label for="T_014_tidak" class="form-check-label">Tidak dapat memberikan edukasi kepada</label>
                                <input type="radio" class="form-check-input" id="T_015_pasien" name="T_015" value="1">
                                <label for="T_015_pasien" class="form_check_label">Pasien</label>
                                <input type="radio" class="form-check-input" id="T_015_keluarga" name="T_015" value="2">
                                <label for="T_015_keluarga" class="form-check-label">Keluarga</label>
                                <label for="V_33">,karena</label>
                                <input type="text" id="V_33" name="V_33">
                                <br>
                                <input type="checkbox" class="form-check-input" id="T_016_materi" name="T_016" value="1">
                                <label for="T_016_materi" class="form-check-label">Materi Edukasi:</label>
                                <input type="text" id="V_34" name="V_34">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row mt-3">
                <div class="col-6 text-center">
                    <span>Dokter</span>
                </div>
                <div class="col-6 text-center">
                    Penerima Penjelasan
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-center">
                    <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD" id="TTD">
                </div>
                <div class="col-6 text-center">
                    <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD_1" id="TTD_1">
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-center">
                    <span>(<input type="text" id="V_35" name="V_35" placeholder="Masukan Nama" style="text-align: center;">)</span>
                </div>
                <div class="col-6 text-center">
                    <span>(<input type="text" id="V_36" name="V_36" placeholder="Masukan Nama" style="text-align: center;">)</span>
                </div>
        </form>
    </div>
</body>
<script>
    var canvas = document.getElementById('canvas');
    const canvasDataInput = document.getElementById('TTD');
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
    const canvasDataInput1 = document.getElementById('TTD_1');
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
<script>
    var canvas2 = document.getElementById('canvas2');
    const canvasDataInput2 = document.getElementById('TTD_2');
    var context2 = canvas2.getContext('2d');
    var drawing = false;

    canvas2.addEventListener('mousedown', startDrawing);
    canvas2.addEventListener('mousemove', draw);
    canvas2.addEventListener('mouseup', stopDrawing);
    canvas2.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context2.lineWidth = 2;
        context2.lineCap = 'round';
        context2.strokeStyle = '#000';

        context2.lineTo(e.clientX - canvas2.getBoundingClientRect().left, e.clientY - canvas2.getBoundingClientRect().top);
        context2.stroke();
        context2.beginPath();
        context2.moveTo(e.clientX - canvas2.getBoundingClientRect().left, e.clientY - canvas2.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context2.beginPath();
    }

    function saveSignatureData2() {
        const canvasData2 = canvas2.toDataURL('image/png');

        canvasDataInput2.value = canvasData2;
    }
</script>
<script>
    var canvas3 = document.getElementById('canvas3');
    const canvasDataInput3 = document.getElementById('TTD_3');
    var context3 = canvas3.getContext('2d');
    var drawing = false;

    canvas3.addEventListener('mousedown', startDrawing);
    canvas3.addEventListener('mousemove', draw);
    canvas3.addEventListener('mouseup', stopDrawing);
    canvas3.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context3.lineWidth = 2;
        context3.lineCap = 'round';
        context3.strokeStyle = '#000';

        context3.lineTo(e.clientX - canvas3.getBoundingClientRect().left, e.clientY - canvas3.getBoundingClientRect().top);
        context3.stroke();
        context3.beginPath();
        context3.moveTo(e.clientX - canvas3.getBoundingClientRect().left, e.clientY - canvas3.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context3.beginPath();
    }

    function saveSignatureData3() {
        const canvasData3 = canvas3.toDataURL('image/png');

        canvasDataInput3.value = canvasData3;
    }
</script>

</html>
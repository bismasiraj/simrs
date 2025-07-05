<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <title>Ringkasan Pulang</title>
</head>

<body>
    <div class="container my-5">
        <form action="" autocomplete="off">
            <table class="table table-bordered border-black mb-0">
                <tr>
                    <td style="text-align:center; width:20%;">
                        <img src="\img\logo_PKU.png" alt="" style="width:90px"><br>
                        <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                    </td>
                    <td style="font-family:'Times New Roman'">
                        <h4><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h4>
                        <h5>Semanggi RT 002 / RW 020 Pasar Kliwon<br>
                            <i class="bi bi-telephone-fill"></i> 0271-533894 Fax. : 0271-630229 <br>
                            SURAKARTA
                        </h5>
                    </td>
                    <td style="text-align:center; width:35%; vertical-align:middle">Label Identitas Pasien</td>
                </tr>
            </table>
            <table class="table table-bordered border-black mt-0">
                <tr>
                    <td colspan="2">
                        <p style="text-align:right; vertical-align:top; margin:0px"><b>RM 1.2</b></p>
                        <h4 style="text-align:center; margin:0px"><b>RINGKASAN PULANG</b></h4>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row mb-1">
                            <div class="col-md-2">
                                <label for="V_01" class="form-label">DIAGNOSA MASUK</label>
                            </div>
                            <div class="col-auto">:</div>
                            <div class="col-md-3">
                                <input class="form-control" type="text" id="V_01" name="V_01">
                            </div>
                            <div class="col-md-2">
                                <label for="V_02" class="form-label">Tgl. Masuk/Jam</label>
                            </div>
                            <div class="col-auto">:</div>
                            <div class="col-md-2">
                                <input class="form-control" type="date" id="V_02" name="V_02">
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="time" id="V_03" name="V_03">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-2">
                                <label for="V_04" class="form-label">INDIKASI RAWAT INAP</label>
                            </div>
                            <div class="col-auto">:</div>
                            <div class="col-md-3">
                                <input class="form-control" type="text" id="V_04" name="V_04">
                            </div>
                            <div class="col-md-2">
                                <label for="V_05" class="form-label">Tgl. Keluar/Jam</label>
                            </div>
                            <div class="col-auto">:</div>
                            <div class="col-md-2">
                                <input class="form-control" type="date" id="V_05" name="V_05">
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="time" id="V_06" name="V_06">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <b>1. RIWAYAT SINGKAT</b>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <div class="col">
                                <label for="V_07">a. Anamnesa</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <div class="col">
                                <label for="V_08">b. Pemeriksaan Fisik</label>
                            </div>
                        </div>
                    </td>
                    <td style="width:70%">
                        <div class="row mt-4">
                            <div class="col">
                                <input class="form-control" type="text" id="V_07" name="V_07">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_08" name="V_08">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <b>2. PEMERIKSAAN PENUNJANG</b>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <div class="col">
                                <label for="V_09">a. Laboratorium</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <div class="col">
                                <label for="V_10">b. Radiologi</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <div class="col">
                                <label for="V_11">c. Lain-lain</label>
                            </div>
                        </div>
                    </td>
                    <td style="width:70%">
                        <div class="row mt-4">
                            <div class="col">
                                <input class="form-control" type="text" id="V_09" name="V_09">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_10" name="V_10">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_11" name="V_11">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>3. DIAGNOSA AKHIR</b>
                    </td>
                    <td>
                        <input class="form-control" type="text" id="V_12" name="V_12">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>4. DIAGNOSA TAMBAHAN</b>
                    </td>
                    <td>
                        <textarea class="form-control" name="V_13" id="V_13" style="height:50px"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>5. TINDAKAN & TERAPI</b>
                    </td>
                    <td>
                        <textarea class="form-control" name="V_14" id="V_14" style="height:80px"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>6. STATUS KEPULANGAN(*)</b>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_01" name="T_01" value="1">
                                    <label class="form-check-label" for="T_01">Ijin Dokter</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_02" name="T_02" value="1">
                                    <label class="form-check-label" for="T_02">APS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_03" name="T_03" value="1">
                                    <label class="form-check-label" for="T_03">Meninggal Dunia</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_04" name="T_04" value="1">
                                    <label class="form-check-label" for="T_04">Pindah RS Lain</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_05" name="T_05" value="1">
                                    <label class="form-check-label" for="T_05">Rujuk</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <b>7. KONDISI PULANG(*)</b>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-1"></div>
                            <div class="col">
                                a. Pemeriksaan Fisik
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col">
                                b. Catatan Penting
                            </div>
                        </div>
                    </td>
                    <td style="width:70%">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="V_15">K/U :</label>
                                <input type="text" id="V_15" name="V_15" style="width:250px; height:35px">
                            </div>
                            <div class="col-md-5">
                                <label for="V_16">Kesadaran :</label>
                                <input type="text" id="V_16" name="V_16" style="width:150px; height:35px">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-6">
                                <label for="V_17">TD &nbsp; :</label>
                                <input type="text" id="V_17" name="V_17" style="width:70px; height:35px">mmHg;&nbsp;&nbsp;
                                <label for="V_18">N :</label>
                                <input type="text" id="V_18" name="V_18" style="width:70px; height:35px">x/m
                            </div>
                            <div class="col-md-5">
                                <label for="V_19">S :</label>
                                <input type="text" id="V_19" name="V_19" style="width:70px; height:35px">°C;&nbsp;&nbsp;
                                <label for="V_20">RR :</label>
                                <input type="text" id="V_20" name="V_20" style="width:70px; height:35px">x/m
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>8. OBAT PULANG</b>
                    </td>
                    <td>
                        <textarea class="form-control" name="V_21" id="V_21" style="height:80px"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <b>9. PERINTAH WAKTU PULANG</b>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-1"></div>
                            <div class="col">
                                <label for="V_22">a. Tindak Lanjut</label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-1"></div>
                            <div class="col">
                                <label for="V_23">b. Kontrol Kembali</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col">
                                <label for="V_24">c. Pemeriksaan Penunjang</label>
                            </div>
                        </div>
                    </td>
                    <td style="width:70%">
                        <div class="row mt-4">
                            <label for="V_22" class="col-sm-auto col-form-label">a.</label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_22" name="V_22">
                            </div>
                        </div>
                        <div class="row">
                            <label for="V_23" class="col-sm-auto col-form-label">b.</label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_23" name="V_23">
                            </div>
                        </div>
                        <div class="row">
                            <label for="V_24" class="col-sm-auto col-form-label">c.</label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_24" name="V_24">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row mb-1" style="text-align:center">
                <div class="col">
                    (*) Pilih dengan memberi tanda √
                </div>
                <div class="col">
                    Diserahkan Tgl <input type="date" id="V_25" name="V_25" style="width:150px">
                </div>
            </div>
            <div class="row" style="text-align:center">
                <div class="col">
                    Pasien / Keluarga Pasien
                </div>
                <div class="col">
                    Dokter Penanggung Jawab Pelayanan
                </div>
            </div>
            <div class="row" style="text-align:center">
                <div class="col">
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                    <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD" id="TTD"><br>
                    ( <input type="text" id="V_26" name="V_26" style="width:150px; text-align: center;"> )<br>
                    Ttd & Nama Terang
                </div>
                <div class="col">
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas1()">Clear Signature</button><br>
                    <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD_1" id="TTD_1"><br>
                    ( <input type="text" id="V_27" name="V_27" style="width:150px; text-align: center;"> )<br>
                    Ttd & Nama Terang
                </div>
            </div>
            <hr style="border: 3px solid black; margin:0px">
            Rangkap 3 : 1. RM, 2. PASIEN, 3. PENJAMIN
        </form>
    </div>
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

        function clearCanvas() {
            context.clearRect(0, 0, canvas.width, canvas.height);
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

        function clearCanvas1() {
            context1.clearRect(0, 0, canvas1.width, canvas1.height);
        }

        function saveSignatureData1() {
            const canvasData1 = canvas1.toDataURL('image/png');

            canvasDataInput1.value = canvasData1;
        }
    </script>
</body>

</html>
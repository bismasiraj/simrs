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
    <title>ASESMEN MEDIS PASIEN MATA</title>
</head>

<body>
    <div class="container">
        <h6 style="text-align:right">RM 2.2.11</h6>
        <form action="" autocomplete="off" style="vertical-align:middle">
            <h4 style="text-align: center"><b>REKAM MEDIS RAWAT INAP</b></h4>
            <table class="table table-bordered border-black">
                <tr style="vertical-align:middle; margin:0px; font-family:'Times New Roman'">
                    <td style="text-align:center; width:20%">
                        <img src="\img\logo_PKU.png" alt="" style="width:90px"><br>
                        <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                    </td>
                    <td>
                        <h4><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h4>
                        <h5>Semanggi RT 002 / RW 020 Pasar Kliwon<br>
                            Telp 0271-533894 Fax. : 0271-630229 <br>
                            Jawa Tengah 57117
                        </h5>
                    </td>
                    <td style="width:35%">
                        <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                            <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center">
                        <h5><b>ASESMEN MEDIS PASIEN MATA</b></h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center"><b>Diisi oleh Dokter</b></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <label for="V_01" class="col-sm-auto col-form-label">Tanggal :</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="V_01" name="V_01">
                            </div>
                            <div class="col-sm-1"></div>
                            <label for="V_02" class="col-sm-1 col-form-label">Jam :</label>
                            <div class="col-sm-4">
                                <input type="time" class="form-control" id="V_02" name="V_02">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-1">
                            <div class="col">
                                <b>ANAMNESIS : </b>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_01" id="T_01_0" value="0">
                                    <label class="form-check-label" for="T_01_0"><b>Autoanamnesis /</b></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_01" id="T_01_1" value="1">
                                    <label class="form-check-label" for="T_01_1"><b>Alloanamnesis</b></label>
                                </div> dengan :
                                <input type="text" id="V_03" name="V_03" style="width:90px">
                                Hubungan dengan pasien :
                                <input type="text" id="V_04" name="V_04" style="width:90px">
                            </div>
                        </div>
                        <div class="container mb-3">
                            <div class="row mb-1">
                                <label for="V_05" class="col-sm-4 col-form-label">
                                    <ul>
                                        <li>Keluhan Utama </li>
                                    </ul>
                                </label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_05" name="V_05">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_06" class="col-sm-4 col-form-label">
                                    <ul>
                                        <li>Riwayat Penyakit Sekarang </li>
                                    </ul>
                                </label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <textarea class="form-control" id="V_06" name="V_06" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_07" class="col-sm-4 col-form-label">
                                    <ul>
                                        <li>Alloanamnesis </li>
                                    </ul>
                                </label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <textarea class="form-control" id="V_07" name="V_07" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_08" class="col-sm-4 col-form-label">
                                    <ul>
                                        <li>Riwayat Penyakit Dahulu </li>
                                    </ul>
                                </label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <textarea class="form-control" id="V_08" name="V_08" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_09" class="col-sm-4 col-form-label">
                                    <ul>
                                        <li>Obat- obatan yang Dikonsumsi</li>
                                    </ul>
                                </label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_09" name="V_09">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"><b>PEMERIKSAAN FISIK</b></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>A. Keadaan Umum </b>
                            </div>
                        </div>
                        <div class="container mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_02" id="T_02_0" value="0">
                                        <label class="form-check-label" for="T_02_0">Baik </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_02" id="T_02_1" value="1">
                                        <label class="form-check-label" for="T_02_1">Sedang </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_02" id="T_02_2" value="2">
                                        <label class="form-check-label" for="T_02_2">Lemah </label>
                                    </div><br>
                                    <b>GCS</b>&nbsp;&nbsp;
                                    <label for="V_10"><b>E :</b></label>
                                    <input type="text" id="V_10" name="V_10" style="width:50px">&nbsp;&nbsp;
                                    <label for="V_11"><b>M :</b></label>
                                    <input type="text" id="V_11" name="V_11" style="width:50px">&nbsp;&nbsp;
                                    <label for="V_12"><b>V :</b></label>
                                    <input type="text" id="V_12" name="V_12" style="width:50px"> =
                                    <input type="text" id="V_13" name="V_13" style="width:50px">
                                </div>
                                <div class="col">
                                    <div class="row mb-1">
                                        <div class="col"><b>Tanda vital :</b></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-7">
                                            <label for="V_14">TD :</label>
                                            <input type="text" id="V_14" name="V_14" style="width:50px"> /
                                            <input type="text" id="V_15" name="V_15" style="width:50px"> mmHg
                                        </div>
                                        <div class="col">
                                            <label for="V_16">N :</label>
                                            <input type="text" id="V_16" name="V_16" style="width:70px"> x/menit
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label for="V_17">R :</label>
                                            <input type="text" id="V_17" name="V_17" style="width:100px"> x/menit
                                        </div>
                                        <div class="col">
                                            <label for="V_18">S :</label>
                                            <input type="text" id="V_18" name="V_18" style="width:70px"> °C
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>B. Status Oftalmologis :</b>
                            </div>
                        </div>
                        <div class="container mb-5" style="text-align:center; width:80%">
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col-md-6">
                                    <img src="/img/mata.png" alt="" style="width:35%"><br>
                                    OCULUS DEXTRA
                                </div>
                                <div class="col-md-6">
                                    <img src="/img/mata.png" alt="" style="width:35%"><br>
                                    OCULUS SINISTRA
                                </div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">VISUS</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">KOREKSI</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">SKIASKOPI</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">BULBUS OCULI</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">PARESE, PARALYSE</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">SUPERCILIA</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">PALPEBRA SUPERIOR</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">PALPEBRA INFERIOR</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">CONJUNCTIVA PALPEBRALIS</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">CONJUNCTIVA FORNICES</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">CONJUNCTIVA BULBI</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">SCLERA</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">CORNEA</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">CAMERA OCULI ANTERIOR</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">IRIS</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">PUPIL</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">LENSA</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">CORPUS VITREOUS </div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">FUNDUS REFLEKS</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">TENSIO OCULI</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">SISTEM CANALIS LACRIMARIS</div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid black;">
                                <div class="col">LAIN-LAIN</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"><b>C. FUNDUSCOPY :</b></div>
                        </div>
                        <div class="row mb-3" style="text-align:center">
                            <div class="col">
                                <img src="/img/FUNDUSCOPY.png" alt="" style="width:30%">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"><b>PEMERIKSAAN PENUNJANG </b></div>
                        </div>
                        <div class="container mb-3">
                            <div class="row mb-1">
                                <label for="V_19" class="col-sm-3 col-form-label">1. Laboratorium</label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_19" name="V_19">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_20" class="col-sm-3 col-form-label">2. Radiologi</label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_20" name="V_20">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_21" class="col-sm-3 col-form-label">3. ECG </label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_21" name="V_21">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_22" class="col-sm-3 col-form-label">4. Lain - lain </label>
                                <div class="col-sm-auto col-form-label">:</div>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_22" name="V_22">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <label for="V_23" class="form-label"><b>DIAGNOSIS KERJA : </b></label>
                                <textarea class="form-control" name="V_23" id="V_23" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <label for="V_24" class="form-label"><b>DIAGNOSIS BANDING :</b></label>
                                <textarea class="form-control" name="V_24" id="V_24" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col"><b>MASALAH :</b></div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <label for="V_25" class="col-sm-2 col-form-label">1. Medis</label>
                                <div class="col-sm-auto col-form-label">:</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <textarea class="form-control" id="V_25" name="V_25" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <label for="V_26" class="col-sm-2 col-form-label">2. Keperawatan</label>
                                <div class="col-sm-auto col-form-label">:</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <textarea class="form-control" id="V_26" name="V_26" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <label for="V_27" class="form-label"><b>SASARAN :</b></label>
                                <textarea class="form-control" name="V_27" id="V_27" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col">
                                <label for="V_28" class="form-label"><b>RENCANA ASUHAN / TERAPI / INSTRUKSI <i>(standing order): </i></b></label>
                                <textarea class="form-control" name="V_28" id="V_28" rows="15"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6" style="text-align: center;">
                                Dokter<br>
                                <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD"><br>
                                ( <input type="text" id="V_29" name="V_29" style="width:200px; text-align: center;"> )<br>
                                Ttd & Nama Terang
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                Penerima Penjelasan<br>
                                <button class="btn btn-outline-success" type="button" onclick="clearCanvas1()">Clear Signature</button><br>
                                <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD_1" id="TTD_1"><br>
                                ( <input type="text" id="V_30" name="V_30" style="width:200px; text-align: center;"> )<br>
                                Ttd & Nama Terang
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
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
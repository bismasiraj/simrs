<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <title>ASESMEN MEDIS PASIEN MATA</title>
</head>

<body>
    <div class="container">
        <h6 style="text-align:right">RMJ.2.9</h6>
        <form action="" autocomplete="off" style="vertical-align:middle; font-family:'Times New Roman'">
            <h4 style="text-align: center"><b>REKAM MEDIS RAWAT JALAN</b></h4>
            <table class="table table-bordered border-black">
                <tr style="vertical-align:middle; margin:0px">
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3" style="text-align:center">
                                <img src="\img\logo_PKU.png" alt="" style="width:90px"><br>
                                <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                            </div>
                            <div class="col">
                                <h4><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h4>
                                <p>Semanggi RT 02/20 Pasar Kliwon Surakarta<br>
                                    Telp. ( 0271 ) 633894 Fax: 0271- 630229 <br>
                                    Jawa Tengah 57117
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                                    <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">
                        <h5><b>ASESMEN MEDIS PASIEN MATA</b></h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
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
                    <td colspan="2">
                        <div class="row">
                            <label for="V_03" class="col-sm-auto col-form-label"><b>Riwayat Alergi :</b></label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_03" name="V_03">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
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
                                <input type="text" id="V_04" name="V_04" style="width:90px">
                                Hubungan dengan pasien :
                                <input type="text" id="V_05" name="V_05" style="width:90px">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_06" class="col-sm-4 col-form-label"><b>Keluhan Utama</b></label>
                            <div class="col-sm-auto col-form-label">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_06" name="V_06">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_07" class="col-sm-4 col-form-label"><b>Riwayat Penyakit Sekarang</b></label>
                            <div class="col-sm-auto col-form-label">:</div>
                            <div class="col">
                                <textarea class="form-control" id="V_07" name="V_07" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_08" class="col-sm-4 col-form-label"><b>Riwayat Penyakit Dahulu</b></label>
                            <div class="col-sm-auto col-form-label">:</div>
                            <div class="col">
                                <textarea class="form-control" id="V_08" name="V_08" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row mb-1">
                            <div class="col"><b>Riwayat Obat yang dikonsumsi :</b></div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_09" class="col-sm-auto col-form-label">1. </label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_09" name="V_09">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_10" class="col-sm-auto col-form-label">2. </label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_10" name="V_10">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col"><b>PEMERIKSAAN FISIK</b></div>
                        </div>
                        <div class="container mb-3">
                            <div class="row">
                                <div class="col">Vital Sign:
                                    <label for="V_11">TD :</label>
                                    <input type="text" id="V_11" name="V_11" style="width:50px"> /
                                    <input type="text" id="V_12" name="V_12" style="width:50px"> mmHg &nbsp;&nbsp;&nbsp;
                                    <label for="V_13">N :</label>
                                    <input type="text" id="V_13" name="V_13" style="width:100px"> x/menit &nbsp;&nbsp;&nbsp;
                                    <label for="V_14">R :</label>
                                    <input type="text" id="V_14" name="V_14" style="width:100px"> x/menit &nbsp;&nbsp;&nbsp;
                                    <label for="V_15">S :</label>
                                    <input type="text" id="V_15" name="V_15" style="width:70px"> °C
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Status Oftalmologis :</b>
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
                            <div class="col"><b>FUNDUSCOPY :</b></div>
                        </div>
                        <div class="row mb-3" style="text-align:center">
                            <div class="col">
                                <img src="/img/FUNDUSCOPY.png" alt="" style="width:30%">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row mb-1">
                            <div class="col">
                                <label for="V_16" class="form-label"><b>Pemeriksaan Penunjang :</b></label>
                                <textarea class="form-control" name="V_16" id="V_16" rows="3"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row mb-1">
                            <div class="col">
                                <label for="V_17" class="form-label"><b>Diagnosis Kerja :</b></label>
                                <textarea class="form-control" name="V_17" id="V_17" rows="3"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row mb-1">
                            <div class="col">
                                <label for="V_18" class="form-label"><b>Terapi :</b></label>
                                <textarea class="form-control" name="V_18" id="V_18" rows="5"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td rowspan="4" style="width:20%; text-align:center"><b>RENCANA TINDAK LANJUT</b></td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="T_02" id="T_02_0" value="0">
                                    <label class="form-check-label" for="T_02_0">Rawat Jalan </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="T_02" id="T_02_1" value="1">
                                    <label class="form-check-label" for="T_02_1">Rawat Inap</label>
                                </div>
                                DPJP Rawat Inap :
                                <input type="text" id="V_19" name="V_19" style="width:150px">
                            </div>
                            <div class="col">
                                <label for="V_20" class="form-label">Ruang </label>
                                <input type="text" class="form-control" id="V_20" name="V_20">
                            </div>
                            <div class="col">
                                <label for="V_21" class="form-label">Indikasi </label>
                                <input type="text" class="form-control" id="V_21" name="V_21">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Pengantar Pasien :
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="T_03" id="T_03_0" value="0">
                            <label class="form-check-label" for="T_03_0">Ada /</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="T_03" id="T_03_1" value="1">
                            <label class="form-check-label" for="T_03_1">Tidak* (Bila tidak, rujuk ke Dinas Sosial)</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col">
                                Rujuk ke :
                                <input class="form-check-input" type="radio" name="T_04" id="T_04_0" value="0">
                                <label class="form-check-label" for="T_04_0">RS</label>
                                <input type="text" id="V_22" name="V_22" style="width:150px"><br>
                                <input class="form-check-input" type="radio" name="T_04" id="T_04_1" value="1">
                                <label class="form-check-label" for="T_04_1">Dokter Keluarga : </label>
                                <input type="text" id="V_23" name="V_23" style="width:150px">
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="T_04" id="T_04_2" value="2">
                                <label class="form-check-label" for="T_04_2">Puskesmas </label>
                                <input type="text" id="V_24" name="V_24" style="width:150px"><br>
                                <input class="form-check-input" type="radio" name="T_04" id="T_04_3" value="3">
                                <label class="form-check-label" for="T_04_3">Dokter </label>
                                <input type="text" id="V_25" name="V_25" style="width:150px">
                                <input class="form-check-input" type="radio" name="T_04" id="T_04_4" value="4">
                                <label class="form-check-label" for="T_04_4">Homecare </label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="V_26">Kontrol Klinik / Homecare di :</label>
                        <input type="text" id="V_26" name="V_26" style="width:200px">&nbsp;&nbsp;&nbsp;
                        <label for="V_27">Tanggal :</label>
                        <input type="date" id="V_27" name="V_27" style="width:150px">
                    </td>
                </tr>
                <tr>
                    <td style="width:20%; text-align:center"><b>EDUKASI PASIEN</b></td>
                    <td>
                        Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada :<br>
                        <input class="form-check-input" type="radio" name="T_05" id="T_05_0" value="0">
                        <label class="form-check-label" for="T_05_0">Pasien </label><br>
                        <input class="form-check-input" type="radio" name="T_05" id="T_05_1" value="1">
                        <label class="form-check-label" for="T_05_1">Keluarga pasien, nama : </label>
                        <input type="text" id="V_28" name="V_28" style="width:250px"><br>
                        <input class="form-check-input" type="radio" name="T_05" id="T_05_2" value="2">
                        <label class="form-check-label" for="T_05_2">Tidak dapat memberi edukasi kepada pasien atau keluarga, Karena </label>
                        <input type="text" id="V_29" name="V_29" style="width:250px"><br>
                    </td>
                </tr>
            </table>
            <div class="row mb-3">
                <div class="col-md-6" style="text-align: center;">
                    Dokter<br>
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                    <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD" id="TTD"><br>
                    ( <input type="text" id="V_30" name="V_30" style="width:200px; text-align: center;"> )<br>
                    Ttd & Nama Terang
                </div>
                <div class="col-md-6" style="text-align: center;">
                    Penerima Penjelasan<br>
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas1()">Clear Signature</button><br>
                    <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD_1" id="TTD_1"><br>
                    ( <input type="text" id="V_31" name="V_31" style="width:200px; text-align: center;"> )<br>
                    Ttd & Nama Terang
                </div>
            </div>
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
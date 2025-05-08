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
    <title>ASESMEN PSIKIATRI</title>
</head>

<body>
    <div class="container">
        <h6 style="text-align:right">RMJ 2.13</h6>
        <form action="" autocomplete="off" style="vertical-align:middle">
            <h4 style="text-align: center"><b>REKAM MEDIS RAWAT JALAN</b></h4>
            <table class="table table-bordered border-black mb-0">
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
                        <div class="container" style="height:150px; border: 1px solid black; border-radius:10px">
                            <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center">
                        <h3><b>ASESMEN MEDIS PASIEN PSIKIATRI</b></h3>
                    </td>
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
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_01" id="T_01_0" value="0">
                                    <label class="form-check-label" for="T_01_0">Anamnesis /</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_01" id="T_01_1" value="1">
                                    <label class="form-check-label" for="T_01_1">Alloanamnesis*</label>
                                </div> dengan :
                                <input type="text" id="V_03" name="V_03" style="width:90px">
                                Hubungan dengan pasien :
                                <input type="text" id="V_04" name="V_04" style="width:90px">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_05" class="col-sm-auto col-form-label"><b>Keluhan Utama</b></label>
                            <div class="col-sm-auto col-form-label">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_05" name="V_05">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-1">
                            <label for="V_06" class="col-sm-auto col-form-label"><b>Riwayat Penyakit Sekarang</b></label>
                            <div class="col-sm-auto">:</div>
                            <div class="col">
                                <textarea class="form-control" name="V_06" id="V_06" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-1">
                            <div class="col-sm-auto"><b>Riwayat Penyakit Dahulu :</b></div>
                        </div>
                        <div class="container">
                            <div class="row mb-1">
                                <label for="V_07" class="col-sm-auto col-form-label">- Riwayat Penyakit Kronis : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_07" name="V_07">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_08" class="col-sm-auto col-form-label">- Riwayat Operasi : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_08" name="V_08">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_09" class="col-sm-auto col-form-label">- Riwayat Alergi : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_09" name="V_09">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_10" class="col-sm-auto col-form-label">- Riwayat Kejang :</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_10" name="V_10">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_11" class="col-sm-auto col-form-label">- Riwayat Pengobatan : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_11" name="V_11">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_12" class="col-sm-auto col-form-label">- Riwayat Penggunaan NAPZA : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_12" name="V_12">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-1">
                            <label for="V_13" class="col-sm-auto col-form-label"><b>Riwayat Penyakit Keluarga :</b></label>
                            <div class="col">
                                <textarea class="form-control" name="V_13" id="V_13" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col">
                                <b>Pemeriksaan Fisik : </b><br>
                                <b>KEADAAN UMUM : </b>
                            </div>
                        </div>
                        <div class="container">
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
                                    <label for="V_14"><b>E :</b></label>
                                    <input type="text" id="V_14" name="V_14" style="width:50px">&nbsp;&nbsp;
                                    <label for="V_15"><b>M :</b></label>
                                    <input type="text" id="V_15" name="V_15" style="width:50px">&nbsp;&nbsp;
                                    <label for="V_16"><b>V :</b></label>
                                    <input type="text" id="V_16" name="V_16" style="width:50px"> =
                                    <input type="text" id="V_17" name="V_17" style="width:50px">
                                </div>
                                <div class="col">
                                    <div class="row mb-1">
                                        <div class="col"><b>Tanda vital :</b></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-7">
                                            <label for="V_18">TD :</label>
                                            <input type="text" id="V_18" name="V_18" style="width:50px"> /
                                            <input type="text" id="V_19" name="V_19" style="width:50px"> mmHg
                                        </div>
                                        <div class="col">
                                            <label for="V_20">N :</label>
                                            <input type="text" id="V_20" name="V_20" style="width:70px"> x/menit
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label for="V_21">R :</label>
                                            <input type="text" id="V_21" name="V_21" style="width:130px"> x/menit
                                        </div>
                                        <div class="col">
                                            <label for="V_22">S :</label>
                                            <input type="text" id="V_22" name="V_22" style="width:70px"> °C
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col">
                                <b>Pemeriksaan Psikiatri </b>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row mb-1">
                                <label for="V_23" class="col-sm-auto col-form-label">1. Kesadaran : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_23" name="V_23">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_24" class="col-sm-auto col-form-label">2. Perilaku/Psikomotor : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_24" name="V_24">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_25" class="col-sm-auto col-form-label">3. Afek : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_25" name="V_25">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_26" class="col-sm-auto col-form-label">4. Mood : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_26" name="V_26">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">5. Gangguan Pikir </div>
                            </div>
                            <div class="container">
                                <div class="row mb-1">
                                    <label for="V_27" class="col-sm-auto col-form-label">a. Bentuk pikir : </label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="V_27" name="V_27">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="V_28" class="col-sm-auto col-form-label">b. Isi : </label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="V_28" name="V_28">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="V_29" class="col-sm-auto col-form-label">c. Arus : </label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="V_29" name="V_29">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_30" class="col-sm-auto col-form-label">6. Gangguan persepsi : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_30" name="V_30">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="V_31" class="col-sm-auto col-form-label">7. Insight/Tilikan diri : </label>
                                <div class="col">
                                    <input type="text" class="form-control" id="V_31" name="V_31">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-1">
                            <div class="col"><b>Pemeriksaan Penunjang :</b>
                                <textarea class="form-control" name="V_32" id="V_32" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-1">
                            <div class="col"><b>Diagnosis : </b>
                                <textarea class="form-control" name="V_33" id="V_33" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-1">
                            <div class="col"><b>Diferensial Diagnosis :</b>
                                <textarea class="form-control" name="V_34" id="V_34" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-1">
                            <div class="col"><b>Terapi :</b>
                                <textarea class="form-control" name="V_35" id="V_35" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered border-black mt-0">
                <tr>
                    <td style="width:20%; text-align:center"><b>RENCANA TINDAK LANJUT</b></td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="T_03" id="T_03_0" value="0">
                                    <label class="form-check-label" for="T_03_0">Rawat Jalan </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="T_03" id="T_03_1" value="1">
                                    <label class="form-check-label" for="T_03_1">Rawat Inap</label>
                                </div>
                                DPJP Rawat Inap :
                                <input type="text" id="V_36" name="V_36" style="width:150px">
                            </div>
                            <div class="col mt-4">
                                <label for="V_37" class="form-label">Ruang :</label>
                                <input type="text" id="V_37" name="V_37" style="width:100px">
                                <label for="V_38" class="form-label">Indikasi :</label>
                                <input type="text" id="V_38" name="V_38" style="width:100px">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                Pengantar Pasien :
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_04" id="T_04_0" value="0">
                                    <label class="form-check-label" for="T_04_0">Ada /</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_04" id="T_04_1" value="1">
                                    <label class="form-check-label" for="T_04_1">Tidak* (Bila tidak, rujuk ke Dinas Sosial)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                Rujuk ke :
                                <input class="form-check-input" type="radio" name="T_05" id="T_05_0" value="0">
                                <label class="form-check-label" for="T_05_0">RS</label>
                                <input type="text" id="V_39" name="V_39" style="width:175px"><br>
                                <input class="form-check-input" type="radio" name="T_05" id="T_05_1" value="1">
                                <label class="form-check-label" for="T_05_1">Dokter Keluarga : </label>
                                <input type="text" id="V_40" name="V_40" style="width:150px">
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="T_05" id="T_05_2" value="2">
                                <label class="form-check-label" for="T_05_2">Puskesmas </label>
                                <input type="text" id="V_41" name="V_41" style="width:150px"><br>
                                <input class="form-check-input" type="radio" name="T_05" id="T_05_3" value="3">
                                <label class="form-check-label" for="T_05_3">Dokter </label>
                                <input type="text" id="V_42" name="V_42" style="width:150px">
                                <input class="form-check-input" type="radio" name="T_05" id="T_05_4" value="4">
                                <label class="form-check-label" for="T_05_4">Homecare </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="V_43">Kontrol Klinik / Homecare di :</label>
                                <input type="text" id="V_43" name="V_43" style="width:200px">&nbsp;&nbsp;&nbsp;
                                <label for="V_44">Tanggal :</label>
                                <input type="date" id="V_44" name="V_44" style="width:150px">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%; text-align:center"><b>EDUKASI PASIEN</b></td>
                    <td>
                        Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada :<br>
                        <input class="form-check-input" type="radio" name="T_06" id="T_06_0" value="0">
                        <label class="form-check-label" for="T_06_0">Pasien </label><br>
                        <input class="form-check-input" type="radio" name="T_06" id="T_06_1" value="1">
                        <label class="form-check-label" for="T_06_1">Keluarga pasien, nama : </label>
                        <input type="text" id="V_45" name="V_45" style="width:200px"><br>
                        <input class="form-check-input" type="radio" name="T_06" id="T_06_2" value="2">
                        <label class="form-check-label" for="T_06_2">Tidak dapat memberi edukasi kepada pasien atau keluarga, Karena </label>
                        <input type="text" id="V_46" name="V_46" style="width:200px">
                    </td>
                </tr>
            </table>
            <div class="row mb-3">
                <div class="col-md-6" style="text-align: center;">
                    Dokter<br>
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                    <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD" id="TTD"><br>
                    ( <input type="text" id="V_47" name="V_47" style="width:200px; text-align: center;"> )
                </div>
                <div class="col-md-6" style="text-align: center;">
                    Penerima Penjelasan<br>
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas1()">Clear Signature</button><br>
                    <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD_1" id="TTD_1"><br>
                    ( <input type="text" id="V_48" name="V_48" style="width:200px; text-align: center;"> )
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
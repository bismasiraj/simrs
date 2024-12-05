<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evaluasi Awal Case Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <a href="<?= base_url('pku/halamanform2') ?>" class="btn btn-success mt-3"><i class="bi bi-arrow-left"></i></a>
        <div class="row align-items-center">
            <p class="text-end">RM.4.6</p>
        </div>
        <form action="" method="">
            <table class="table table-bordered mb-0" style="border: 1px;">
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-3" align='middle'>
                                <img class="mt-2" src="<?= base_url('uploads/pku.png') ?>" width="90px">
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
                <tr>
                    <td colspan="2">
                        <span><strong>Dokumentasi Case Manager</strong></span>
                        <br>
                        <span><strong>FORM A</strong></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <span><strong>EVALUASI AWAL CASE MANAGER</strong></span>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        <span><strong>SKRINING AWAL</strong></span>
                    </td>
                    <td width="50%">
                        <div class="row">
                            <div class="col-3">
                                <label for="V_01"><strong>Tanggal:</strong></label>
                            </div>
                            <div class="col-3">
                                <input class="form-control" type="date" id="V_01" name="V_01">
                            </div>
                            <div class="col-3">
                                <label for=" V_02"><strong>Jam:</strong></label>
                            </div>
                            <div class="col-3">
                                <input class="form-control" type="time" id="V_02" name="V_02">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span><strong>Beri tanda (√) pada pilihan data risiko yang sesuai !</strong></span>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mt-0 mb-0" style="border: 1px;">
                <thead>
                    <th class="text-center" style="vertical-align: middle;" width="10%">No</th>
                    <th class="text-center" style="vertical-align: middle;" width="50%">DATA RISIKO</th>
                    <th class="text-center" style="vertical-align: middle;" width="20%">PROBLEM<br>PELAYANAN</th>
                    <th class="text-center" style="vertical-align: middle;" width="25%">KET</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>1.</strong></td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_01_1" name="T_01" value="1">
                                    <label for="T_01_1">Pelayanan inadekuat</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_02_1" name="T_02" value="1">
                                    <label for="T_02_1">Risiko Readmisi</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_03_1" name="T_03" value="1">
                                    <label for="T_03_1">Risiko complain</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="T_04_1" name="T_04" value="1">
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="V_03" name="V_03">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle;">Risiko tinggi</td>
                        <td>
                            <textarea class="form-control" name="V_04" id="V_04" rows="4"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>2.</strong></td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_05_1" name="T_05" value="1">
                                    <label for="T_05_1">Pasien tanpa asuransi dengan kebutuhan sumber daya tinggi</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_06_1" name="T_06" value="1">
                                    <label for="T_06_1">Pasien dengan asuransi kesehatan dengan minimal coverage</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_07_1" name="T_07" value="1">
                                    <label for="T_07_1">Pasien dengan pembayar yang belum jelas</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="T_08_1" name="T_08" value="1">
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="V_05" name="V_05">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle;">Risiko permasalahan<br>pembiayaan</td>
                        <td>
                            <textarea class="form-control" name="V_06" id="V_06" rows="4"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>3.</strong></td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_09_1" name="T_09" value="1">
                                    <label for="T_09_1">Kasus multidiagnosis</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_010_1" name="T_010" value="1">
                                    <label for="T_010_1">Kasus multiprovider</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_011_1" name="T_011" value="1">
                                    <label for="T_011_1">Mendapatkan banyak tindakan medis</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="T_012_1" name="T_012" value="1">
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="V_07" name="V_07">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle;">Kasus komplek</td>
                        <td>
                            <textarea class="form-control" name="V_08" id="V_08" rows="4"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>4.</strong></td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_013_1" name="T_013" value="1">
                                    <label for="T_013_1"><i>Leng of stay</i> lebih dari rencana rawat</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="T_014_1" name="T_014" value="1">
                                        <label for="T_014_1">Kasus yang diprediksi membutuhkan waktu yang lebih dari</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="V_09" name="V_09">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle;">Risiko lama rawat</td>
                        <td>
                            <textarea class="form-control" name="V_10" id="V_10" rows="3"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>5.</strong></td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_015_1" name="T_015" value="1">
                                    <label for="T_015_1">Ada riwayat dan risiko penelantaran</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_016_1" name="T_016" value="1">
                                    <label for="T_016_1">Pasien tanpa identitas</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="T_017_1" name="T_017" value="1">
                                    <label for="T_017_1">Pasien dengan support yang rendah dari keluarga</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="T_018_1" name="T_018" value="1">
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="V_11" name="V_11">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle;">Risiko permasalahan<br>psikososial</td>
                        <td>
                            <textarea class="form-control" name="V_12" id="V_12" rows="4"></textarea>
                        </td>
                    </tr>
                </tbody>
                <tr>
                    <td colspan="4" class="text-center">
                        <span><strong>ASESMEN AWAL</strong></span>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mt-0" style="border: 1px;">
                <thead>
                    <th class="text-center" style="vertical-align: middle;" width="10%">No</th>
                    <th class="text-center" style="vertical-align: middle;" width="20%">DATA ASESMEN</th>
                    <th class="text-center" style="vertical-align: middle;" width="50%">PLAN</th>
                    <th class="text-center" style="vertical-align: middle;" width="25%">KET</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>1.</strong></td>
                        <td class="text-center" style="vertical-align: middle;">Kondisi Klinis</td>
                        <td>
                            <textarea class="form-control" name="V_13" id="V_13" rows="5"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control" name="V_14" id="V_14" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>2.</strong></td>
                        <td class="text-center" style="vertical-align: middle;">Aspek Psikososial dan spiritual</td>
                        <td>
                            <textarea class="form-control" name="V_15" id="V_15" rows="5"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control" name="V_16" id="V_16" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>3.</strong></td>
                        <td class="text-center" style="vertical-align: middle;">Aspek Psikososial dan spiritual</td>
                        <td>
                            <textarea class="form-control" name="V_17" id="V_17" rows="5"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control" name="V_18" id="V_18" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>4.</strong></td>
                        <td class="text-center" style="vertical-align: middle;">Aspek Psikososial dan spiritual</td>
                        <td>
                            <textarea class="form-control" name="V_19" id="V_19" rows="5"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control" name="V_20" id="V_20" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>5.</strong></td>
                        <td class="text-center" style="vertical-align: middle;">Asesmen caregiver</td>
                        <td>
                            <textarea class="form-control" name="V_21" id="V_21" rows="5"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control" name="V_22" id="V_22" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><strong>6.</strong></td>
                        <td class="text-center" style="vertical-align: middle;">Asesmen utilitas</td>
                        <td>
                            <textarea class="form-control" name="V_23" id="V_23" rows="5"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control" name="V_24" id="V_24" rows="5"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div align='right'>
                <div class="row">
                    <div class="col" style="margin-right: 37px;">
                        <span>Case Manager</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="margin-right: 15px;">
                        <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="TTD" id="TTD">
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="text-align: end;">
                        <input type="text" id="V_25" name="V_25">
                    </div>
                </div>
            </div>
            <table class="table table-bordered mt-3" style="border: 1px;">
                <tr>
                    <td colspan="4">
                        <div class="row">
                            <div class="col-3" align='middle'>
                                <img src="pku.jpg" alt="Gambar" width="90px">
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
                <tr>
                    <td colspan="4">
                        <span><strong>Dokumentasi Case Manager</strong></span>
                        <br>
                        <span><strong>FORM B</strong></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <span><strong>CATATAN IMPLEMENTASI CASE MANAGER</strong></span>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" style="vertical-align: middle;" width="5%">TGL/JAM</th>
                    <th class="text-center" style="vertical-align: middle;" width="40%">IMPLEMENTASI</th>
                    <th class="text-center" style="vertical-align: middle;" width="35%">PROGRESS NOTE</th>
                    <th class="text-center" style="vertical-align: middle;" width="20%">Ttd/nama terang</th>
                    <tbody id="addTable">
                        <td>
                            <input type="date" class="form-control" id="V_26" name="V_26">
                        </td>
                        <td>
                            <textarea class="form-control" name="V_27" id="V_27" rows="5"></textarea>
                        </td>
                        <td>
                            <textarea class="form-control" name="V_28" id="V_28" rows="5"></textarea>
                        </td>
                        <td class="text-center">
                            <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                            <input type="hidden" name="TTD_1" id="TTD_1">
                            <br>
                            <input type="text" class="form-control" id="V_29" name="V_29">
                        </td>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="container text-center mt-3">
                                    <button class="btn btn-primary" type="button" onclick="addrow1('addTable')">Tambah</button>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </tr>
            </table>
        </form>
    </div>
</body>
<script type="text/javascript">
    var i = 30;
    var canvas = 2;
    var TTD = 2;

    function addrow1(tableID) {

        i1 = i + 1;
        i2 = i + 2;
        i3 = i + 3;
        canvas1 = canvas + 1;
        TTD1 = TTD + 1

        $("#" + tableID).append($("<tr >")
            .append($("<td>").html('<input type="date" class="form-control" id="V_' + i + '" name="V_' + i + '" >'))
            .append($("<td>").html('<textarea class="form-control" name="V_' + i1 + '" id="V_' + i1 + '" rows="5" ></textarea>'))
            .append($("<td>").html('<textarea class="form-control" name="V_' + i2 + '" id="V_' + i2 + '" rows="5" ></textarea>'))
            .append($("<td class='text-center'>").html('<canvas width="150" height="90" style="border:1px solid #000;" id="canvas' + canvas1 + '"></canvas><input type="hidden" class="form-control" id="TTD_' + TTD1 + '"><br><input type="text" class="form-control"  id="V_' + i3 + '" name="V_' + i3 + '"></div>'))
        )

        i += 4;


    }
</script>
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
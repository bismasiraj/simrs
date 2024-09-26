<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assessment Gizi Anak</title>
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
            <p class="text-end">RM.2.1.10</p>
        </div>
        <form action="" method="">
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
                <div class="col-3 mb-3">
                    <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                        <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                    </div>
                </div>
            </div>

            <table class="table table-bordered" style="border: 1px;">
                <tr>
                    <td width="70%">
                        <h6><strong>FORMULIR ASUHAN GIZI DEWASA</strong></h6>
                    </td>
                    <td>
                        <span><strong>Bangsal:</strong></span>
                        <input type="text" id="V_01" name="V_01">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-2">
                                <label for="V_02">Tanggal</label>
                            </div>
                            <div class="col-10">
                                <span>:</span>
                                <input type="date" id="V_02" name="V_02">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="V_03">Diagnosa Medis</label>
                            </div>
                            <div class="col-10">
                                <span>:</span>
                                <input type="text" id="V_03" name="V_03">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <span><strong>ASESMEN GIZI</strong></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span>Antropometri</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="V_06">BB</label>
                                    </div>
                                    <div class="col-3">
                                        <span>:</span>
                                        <input type="text" id="V_06" name="V_06" style="width: 91%;">
                                    </div>
                                    <div class="col-1">
                                        <span>Kg</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="V_07">TB</label>
                                    </div>
                                    <div class="col-3">
                                        <span>:</span>
                                        <input type="text" id="V_07" name="V_07" style="width: 91%;">
                                    </div>
                                    <div class="col-1">
                                        <span>Cm</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="V_08">IMT</label>
                                    </div>
                                    <div class="col-3">
                                        <span>:</span>
                                        <input type="text" id="V_08" name="V_08" style="width: 91%;">
                                    </div>
                                    <div class="col-1">
                                        <span>Kg/cm<sup>2</sup></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="V_11">Lingkar Lengan Atas</label>
                                    </div>
                                    <div class="col-3">
                                        <span>:</span>
                                        <input type="text" id="V_11" name="V_11" style="width: 91%;">
                                    </div>
                                    <div class="col-1">
                                        <span>cm</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="V_12">Status Gizi</label>
                                    </div>
                                    <div class="col-3">
                                        <span>:</span>
                                        <input type="text" id="V_12" name="V_12" style="width: 91%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span>Biokimia</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="V_19" id="V_19" cols="30" rows="2" style="width: 100%;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span>Klinik/Fisik</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="V_20" id="V_20" cols="30" rows="2" style="width: 100%;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span>Riwayat Gizi</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="container">
                            <table class="table table-bordered" style="border: 1px;">
                                <tr>
                                    <td class="text-center">
                                        <span><strong>Alergi makanan</strong></span>
                                    </td>
                                    <td class="text-center" width="20%">
                                        <span><strong>Ya</strong></span>
                                    </td>
                                    <td class="text-center" width="20%">
                                        <span><strong>Tidak</strong></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Telur</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_01_telur" name="T_01" value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_01_telur" name="T_01" value="2">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Susu sapi dan produk olahannya</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_02_susu" name="T_02" value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_02_susu" name="T_02" value="2">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Kacang kedelai/tanah</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_03_kacang" name="T_03" value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_03_kacang" name="T_03" value="2">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Gluten/gandunm</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_04_gluten" name="T_04" value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_04_gluten" name="T_04" value="2">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Udang</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_05_udang" name="T_05" value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_05_udang" name="T_05" value="2">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Ikan</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_06_ikan" name="T_06" value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_06_ikan" name="T_06" value="2">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="V_16">Lain-lain:</label>
                                    </td>
                                    <td colspan="2">
                                        <input type="text" id="V_16" name="V_16" style="width: 100%;">
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered" style="border: 1px;">
                                <tr>
                                    <td class="text-center">
                                        <span><strong>Pola Makanan</strong></span>
                                    </td>
                                    <td class="text-center" width="20%">
                                    </td>
                                    <td class="text-center" width="20%">
                                    </td>
                                    <td class="text-center" width="20%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Makan teratur</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_07_ya" name="T_07" value="1">
                                        <label for="T_07_ya" class="form-check-label">Ya</label>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_07_tidak" name="T_07" value="2">
                                        <label for="T_07_tidak" class="form-check-label">Tidak</label>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Kesukaan makanan cemilan</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_08_manis" name="T_08" value="1">
                                        <label for="T_08_manis" class="form-check-label">Manis</label>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_08_tawar" name="T_08" value="2">
                                        <label for="T_08_tawar" class="form-check-label">Tawar</label>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_08_asin" name="T_08" value="3">
                                        <label for="T_08_asin" class="form-check-label">Asin</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Porsi makan</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_09_cukup" name="T_09" value="1">
                                        <label for="T_09_cukup" class="form-check-label">Cukup</label>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_09_kurang" name="T_09" value="2">
                                        <label for="T_09_kurang" class="form-check-label">Kurang</label>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" class="form-check-input" id="T_09_berlebihan" name="T_09" value="3">
                                        <label for="T_09_berlebihan" class="form-check-label">Berlebihan</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Kesimpulan</span>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" id="V_17" name="V_17" style="width: 100%;">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span>Riwayat personal</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="V_23" id="V_23" cols="30" rows="2" style="width: 100%;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <span><strong>DIAGNOSA GIZI</strong></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="V_24" id="V_24" cols="30" rows="2" style="width: 100%;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <span><strong>INTERVENSI GIZI</strong></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="V_25" id="V_25" cols="30" rows="2" style="width: 100%;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <span><strong>MONITORING DAN EVALUASI</strong></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-8">
                                <span><strong>Table Recall:</strong></span>
                                <table class="table table-bordered" style="border: 1px;">
                                    <thead>
                                        <tr>
                                            <td class="text-center" width="15px">
                                                <span>Tgl</span>
                                            </td>
                                            <td class="text-center" width="10px">
                                                <span>Energi(kcal)</span>
                                            </td>
                                            <td class="text-center" width="10px">
                                                <span>Protein(g)</span>
                                            </td>
                                            <td class="text-center" width="10px">
                                                <span>Cairan</span>
                                            </td>
                                            <td class="text-center" width="10px">
                                                <span>Keterangan</span>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody id="addTable">
                                        <tr>
                                            <td>
                                                <input class="form-control" type="date" id="V_26" name="V_26">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" id="V_27" name="V_27">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" id="V_28" name="V_28">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" id="V_29" name="V_29">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" id="V_30" name="V_30">
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <td colspan="5">
                                            <div class="container text-center mt-3">
                                                <button class="btn btn-primary" type="button" onclick="addrow1('addTable')">Tambah</button>
                                            </div>
                                        </td>
                                    </tfoot>
                                </table>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            Dietisien (Ahli Gizi)
                                        </p>
                                    </div>
                                    <div class="col-5">
                                        <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                        <input type="hidden" name="TTD" id="TTD">
                                        <input type="text" id="V_19" name="V_19" style="width: 150px; text-align: center;" placeholder="Nama">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <span>Evaluasi/Rujukan</span>
                                <br>
                                <textarea name="V_18" id="V_18" cols="30" rows="10" style="width: 100%;"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>


</body>
<script type="text/javascript">
    var i = 31;

    function addrow1(tableID) {

        i1 = i + 1;
        i2 = i + 2;
        i3 = i + 3;
        i4 = i + 4;

        $("#" + tableID).append($("<tr >")
            .append($("<td width='15px'>").html('<input type="date" class="form-control" id="V_' + i + '" name="V_' + i + '" >'))
            .append($("<td width='10px'>").html('<input type="text" class="form-control" id="V_' + i1 + '" name="V_' + i1 + '" >'))
            .append($("<td width='10px'>").html('<input type="text" class="form-control" id="V_' + i2 + '" name="V_' + i2 + '" >'))
            .append($("<td width='10px'>").html('<input type="text" class="form-control" id="V_' + i3 + '" name="V_' + i3 + '" >'))
            .append($("<td width='10px'>").html('<input type="text" class="form-control" id="V_' + i4 + '" name="V_' + i4 + '" >'))
        )

        i += 5;


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
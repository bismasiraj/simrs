<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>DIAGNOSA GANGGUAN CEMAS</title>

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
            <h6 align="right">RM 3.2.9</h6>
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
                    <div class="container mt-1" style="border:1px solid black; padding-top:70px; height:150px; border-radius: 10px">
                        <p class="text-center">Label Identitas Pasien</p>
                    </div>
                </div>
            </div>
            <br>
            <h5 class="text-center">DIAGNOSA GANGGUAN CEMAS</h5>
            <br>
            <div class="col-md-6 mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>DPJP</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="v_01" id="v_01">
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>PPJP</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="v_02" id="v_02">
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>RUANG</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="v_03" id="v_03">
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>KELAS</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="v_04" id="v_04">
                    </div>
                </div>
            </div>
            <br>


            <table class="table table-bordered mb-2" style="border: 2px solid black">
                <tr class="text-center">
                    <th width="18%">Tgl/Jam No. Dx</th>
                    <th width="20%">Diagnosa Keperawatan</th>
                    <th width="25%">NOC</th>
                    <th width="25%">NIC</th>
                    <th width="12%">Nama/TTD</th>
                </tr>
                <tr>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>1. </label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="date" name="v_05" id="v_05">
                            </div>
                        </div>
                    </td>
                    <td>
                        <p><strong>Cemas</strong> berhubungan dengan :</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_01" name="t_01" value="1">
                            <label for="t_01">Perubahan status kesehatan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_02" name="t_02" value="1">
                            <label for="t_02">Perubahan fungsi peran</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_03" name="t_03" value="1">
                            <label for="t_03">Infeksi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_04" name="t_04" value="1">
                            <label for="t_04">Stress</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_05" name="t_05" value="1">
                            <label for="t_05">Krisis situasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_06" name="t_06" value="1">
                            <label for="t_06">Perubahan konsep diri</label>
                        </div>
                    </td>
                    <td>
                        <p>Cemas ketika dilakukan tindakan keperawatan selama <input size="5px" type="text" name="v_06" id="v_06"> x 24 jam. Dengan kriteria hasil :</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_07" name="t_07" value="1">
                            <label for="t_07">Pasien mampu mengidentifikasi dan mengungkapkan gejala cemas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_08" name="t_08" value="1">
                            <label for="t_08">Pasien dapat mengungkapkan teknik mengotrol cemas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_09" name="t_09" value="1">
                            <label for="t_09">Vital Sign</label>
                        </div>
                        <div class="container">
                            <div class="input-group mb-3">
                                <span class="input-group-text">TD</span>
                                <input type="text" class="form-control" name="tension_upper" id="tension_upper">
                                <span class="input-group-text">/</span>
                                <input type="text" class="form-control" name="tension_below" id="tension_below">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Suhu</span>
                                <input type="text" class="form-control" name="temperature" id="temperature">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nadi</span>
                                <input type="text" class="form-control" name="nadi" id="nadi">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Pernafasan</span>
                                <input type="text" class="form-control" name="nafas" id="nafas">
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_010" name="t_010" value="1">
                            <label for="t_010">Postur tubuh, ekspresi wajah, bahasa tubuh, dan tingkat aktivitas menunjukkan relaksasi</label>
                        </div>
                    </td>
                    <td>
                        <strong>
                            <p>Managemen Cemas</p>
                        </strong>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_011" name="t_011" value="1">
                            <label for="t_011">Kaji penyebab kecemasan. Dengarkan keluhan pasien</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_012" name="t_012" value="1">
                            <label for="t_012">Tenangkan pasien</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_013" name="t_013" value="1">
                            <label for="t_013">Jelaskan prosedur yang akan dilakukan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_014" name="t_014" value="1">
                            <label for="t_014">Identifikasi tingkat kecemasan pasien</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_015" name="t_015" value="1">
                            <label for="t_015">Bantu pasien untuk mengungkapkan perasaan cemas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_016" name="t_016" value="1">
                            <label for="t_016">nstruksikan pasien menggunakan teknik relaksasi yang dipilih</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_017" name="t_017" value="1">
                            <label for="t_017">Kolaborasi untuk pemberian obat mengurangi cemas</label>
                        </div>
                        <br>
                        <strong>
                            <p>Pendidikan Kesehatan</p>
                        </strong>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_018" name="t_018" value="1">
                            <label for="t_018">Berikan informasi tentang proses peyakit</label>
                        </div>
                    </td>
                    <td>
                        <canvas id="canvas" width="200" height="100" style="border:1px solid #000;"></canvas>
                        <input type="hidden" id="ttd" name="ttd">
                        <br>
                        <input type="text" class="form-control" id="v_07" name="v_07">
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <table class="table table-bordered mb-2" style="border: 2px solid black">
                <tr>
                    <th colspan="2" class="text-center">RENTANG NILAI NORMAL</th>
                </tr>
                <tr>
                    <td width="30%">Tekanan darah</td>
                    <td>
                        <div class="row">
                            <div class="col-md-5">
                                Dewasa : Sistole 110 - 130 mmHg,
                            </div>
                            <div class="col-md-5">
                                Diastole : 70 - 90 mmHg
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="row">
                            <div class="col-md-5">
                                Dewasa : Sistole 110 - 130 mmHg,
                            </div>
                            <div class="col-md-5">
                                Diastole : 70 - 90 mmHg
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Suhu</td>
                    <td>36.5 C - 37.6 C</td>
                </tr>
                <tr>
                    <td>Respirasi</td>
                    <td>
                        <div class="row">
                            <div class="col-md-5">
                                Dewasa : 16 - 20 x/m,
                            </div>
                            <div class="col-md-5">
                                Anak-anak : 20 - 40 mmHg
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Nadi</td>
                    <td>
                        <div class="row">
                            <div class="col-md-5">
                                Dewasa : 55 - 90 x/m,
                            </div>
                            <div class="col-md-5">
                                Anak-anak : 70 - 150 mmHg
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

</html>
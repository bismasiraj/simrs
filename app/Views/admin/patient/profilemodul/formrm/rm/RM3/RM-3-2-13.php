<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>DIAGNOSA HIPERTERMINA</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

</head>

<body>

    <div class="container-fluid mt-5">
        <form action="<?= site_url('#') ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <h6 align="right">RM 3.2.13</h6>
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
            <h5 class="text-center">DIAGNOSA HIPERTERMINA</h5>
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
                        <p><strong>Hipertermia</strong> berhubungan dengan :</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_01" name="t_01" value="1">
                            <label for="t_01">Peningkatan metabolisme</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_02" name="t_02" value="1">
                            <label for="t_02">Penyakit</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_03" name="t_03" value="1">
                            <label for="t_03">Trauma</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_04" name="t_04" value="1">
                            <label for="t_04">Aktivitas yang berlebihan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_05" name="t_05" value="1">
                            <label for="t_05">Pengaruh pengobatan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_06" name="t_06" value="1">
                            <label for="t_06">Dehidrasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_07" name="t_07" value="1">
                            <label for="t_07">Terpapat lingkungan panas</label>
                        </div>
                    </td>
                    <td>
                        <p>Suhu tubuh dalam batas normal setelah dilakukan tindakan keperawatan selama <input size="5px" type="text" name="v_06" id="v_06"> x 24 jam. Dengan kriteria hasil :</p>
                        <div class="container">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Suhu</span>
                                <input type="text" class="form-control" name="temperature" id="temperature">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">TD</span>
                                <input type="text" class="form-control" name="tension_upper" id="tension_upper">
                                <span class="input-group-text">/</span>
                                <input type="text" class="form-control" name="tension_below" id="tension_below">
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
                            <input class="form-check-input" type="checkbox" id="t_08" name="t_08" value="1">
                            <label for="t_08">Tidak ada perubahan warna pada kulit</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_09" name="t_09" value="1">
                            <label for="t_09">Merasa nyaman</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_010" name="t_010" value="1">
                            <label for="t_010">Kulit teraba dingin</label>
                        </div>
                    </td>
                    <td>
                        <strong>
                            <p>Managemen Hipertermia</p>
                        </strong>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_011" name="t_011" value="1">
                            <label for="t_011">Kaji factor penyebab</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_012" name="t_012" value="1">
                            <label for="t_012">Kompres air hangat pada lipat paha dan axila</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_013" name="t_013" value="1">
                            <label for="t_013">Atur lingkungan yang nyaman berikan pakaian yang tipis dan menyerap keringat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_014" name="t_014" value="1">
                            <label for="t_014">Monitor lokasi pemasangan / tindakan invansive</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_015" name="t_015" value="1">
                            <label for="t_015">Monitor tanda – tanda vital</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_016" name="t_016" value="1">
                            <label for="t_016">Monitor balance cairan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_017" name="t_017" value="1">
                            <label for="t_017">Berikan ciran melalui oral yang cukup</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_018" name="t_018" value="1">
                            <label for="t_018">Berikan cairan parenteral</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_019" name="t_019" value="1">
                            <label for="t_019">Monitor suhu sesering mungkin</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_020" name="t_020" value="1">
                            <label for="t_020">Monitor warna dan suhu kulit</label>
                        </div>
                        <br>
                        <strong>
                            <p>Pendidikan Kesehatan</p>
                        </strong>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_021" name="t_021" value="1">
                            <label for="t_021">Definisi Hipertermia</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_022" name="t_022" value="1">
                            <label for="t_022">Penyebab Hipertermia</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_023" name="t_023" value="1">
                            <label for="t_023">Tanda gejala Hipertermia</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_024" name="t_024" value="1">
                            <label for="t_024">Penanganan Hipertermia dengan non Farmakologi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_025" name="t_025" value="1">
                            <label for="t_025">Penangan Hipertermia dengan Farmakologi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_026" name="t_026" value="1">
                            <label for="t_026">Komplikasi Hipertermia.</label>
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
                    <th colspan="2" class="text-center"><u>RENTANG NILAI NORMAL VITAL SIGN</u></th>
                </tr>
                <tr>
                    <td>Suhu</td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                Dewasa : 36.5 C - 37.5 C
                            </div>
                            <div class="col-md-4">
                                Anak : 36.5 C - 37.5 C
                            </div>
                            <div class="col-md-4">
                                Neonatus : 36.5 C - 37.5 C
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="15%">Tekanan darah</td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                Dewasa : (Sistol 110 - 130 mmHg dan diastole 70 - 90 mmHg)
                            </div>
                            <div class="col-md-6">
                                Anak : (Sistol 90 - 110 mmHg dan diastole 50 - 70 mmHg)
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Nadi</td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                Dewasa : (55 - 90 x/menit)
                            </div>
                            <div class="col-md-4">
                                Anak : (70 - 150 x/menit)
                            </div>
                            <div class="col-md-4">
                                Neonatus : (100 - 180 x/menit)
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Pernafasan</td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                Dewasa : (16 - 20 x/menit)
                            </div>
                            <div class="col-md-4">
                                Anak : (20 - 40 x/menit)
                            </div>
                            <div class="col-md-4">
                                Neonatus : (30 - 40 x/menit)
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
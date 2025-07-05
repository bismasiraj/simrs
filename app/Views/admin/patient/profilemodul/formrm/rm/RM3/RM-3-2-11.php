<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>DIAGNOSA KEBERSIHAN JALAN NAFAS TIDAK EFEKTIF</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

</head>

<body>

    <div class="container-fluid mt-5">
        <form action="<?= site_url('#') ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <h6 align="right">RM 3.2.11</h6>
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
            <h5 class="text-center">DIAGNOSA KEBERSIHAN JALAN NAFAS TIDAK EFEKTIF</h5>
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
                        <p><strong>Kebersihan Jalan Nafas Tidak Efektif</strong> berhubungan dengan :</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_01" name="t_01" value="1">
                            <label for="t_01">Infeksi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_02" name="t_02" value="1">
                            <label for="t_02">Spasme jalan nafas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_03" name="t_03" value="1">
                            <label for="t_03">Sekresi tertahan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_04" name="t_04" value="1">
                            <label for="t_04">Banyknya mucus</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_05" name="t_05" value="1">
                            <label for="t_05">Adanya jalan nafas buatan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_06" name="t_06" value="1">
                            <label for="t_06">Sekresi bronkus</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_07" name="t_07" value="1">
                            <label for="t_07">Eksudat alveolus</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_08" name="t_08" value="1">
                            <label for="t_08">Benda jalan di jalan nafas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_09" name="t_09" value="1">
                            <label for="t_09">Disfungsi neuromuscular</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_010" name="t_010" value="1">
                            <label for="t_010">Obstruksi jalan nafas oleh penumpukan lender, reflek batu</label>
                        </div>
                    </td>
                    <td>
                        <p>Kebersihan jalan nafas teratasi, setelah dilakukan tindakan keperawatan selama <input size="3px" type="text" name="v_06" id="v_06"> x 24 jam. Dengan kriteria hasil :</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_011" name="t_011" value="1">
                            <label for="t_011">Pasien dapat mendemontrasikan batuk efektif dan suara nafas yang bersih, tidak ada syanosis dan dipsnea, mampu mengeluarkan sputum mampu bernaas dengan mudah</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_012" name="t_012" value="1">
                            <label for="t_012">Pasien menunjukkan jalan nafas paten (irama nafas, suara nafas dalam rentang normal).</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_013" name="t_013" value="1">
                            <label for="t_013">Pasien mampu mengidentifikasikan dan mencegah factor yang menghambar jalan nafas</label>
                        </div>
                    </td>
                    <td>
                        <strong>
                            <p>Airway Suction</p>
                        </strong>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_014" name="t_014" value="1">
                            <label for="t_014">Auskultasi suara nafas sebelum dan sesudah suctioning</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_015" name="t_015" value="1">
                            <label for="t_015">Informasikan pada pasien dan keluarga tentang suctioning</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_016" name="t_016" value="1">
                            <label for="t_016">Minta pasien nafas dalam sebelum suction dilakukan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_017" name="t_017" value="1">
                            <label for="t_017">Berikan O2</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_018" name="t_018" value="1">
                            <label for="t_018">Monitor status oksigen pasien</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_019" name="t_019" value="1">
                            <label for="t_019">Hentikan suction dan berikan oksigen apabila pasien menunjukkan peningkatan saturasi O2</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_020" name="t_020" value="1">
                            <label for="t_020">Bersihkan mulut, hidung dan secret trakea.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_021" name="t_021" value="1">
                            <label for="t_021">Pertahankan jalan nafas yang paten</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_022" name="t_022" value="1">
                            <label for="t_022">Atur peralatan oksigenasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_023" name="t_023" value="1">
                            <label for="t_023">Monitor aliran oksigen</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_024" name="t_024" value="1">
                            <label for="t_024">Pertahankan posisi pasien</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_025" name="t_025" value="1">
                            <label for="t_025">Observasi adnya tanda-tanda hipoventilasi</label>
                        </div>
                        <br>
                        <strong>
                            <p>Airway Managemen</p>
                        </strong>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_026" name="t_026" value="1">
                            <label for="t_026">Buka jalan nafas menggunakan teknik chin lift atau jawthrust bila perlu</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_027" name="t_027" value="1">
                            <label for="t_027">Posisikan pasien untuk memaksimalkan ventilasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_028" name="t_028" value="1">
                            <label for="t_028">Identifikasi pasien perlunya pemasangan alat jalan nafas buatan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_029" name="t_029" value="1">
                            <label for="t_029">Pasang mayo bilaperlu</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_030" name="t_030" value="1">
                            <label for="t_030">Lakukan fisioterapi dada jika perlu</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_031" name="t_031" value="1">
                            <label for="t_031">Auskultasi suara nafas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_032" name="t_032" value="1">
                            <label for="t_032">Lakukan suction pada mayo</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_033" name="t_033" value="1">
                            <label for="t_033">Kolaborasikan pemberian bronkodilator bila perlu.</label>
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
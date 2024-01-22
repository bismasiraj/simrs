<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RM 3.2.1 dx perawat - diagnosa kelebihan volume cairan</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RM 3.2.1</b></h5>

            <br><br>
            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <img src="<?= base_url('img/logo.png') ?>" alt="logo" width="100px">
                            <div>
                                <label>SEhat-aMANah <br>tanGGungjawab-Islami</label>
                            </div>
                        </td>
                        <td>
                            <h3><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h3>
                            <h5>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>Telp 0271-633894 Fax. : 0271-630229 <br>Jawa Tengah 57117</h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 3px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>


            <br>
            <h5 style="text-align: center;"><b>DIAGNOSA KELEBIHAN VOLUME CAIRAN</b></h5>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>DPJP</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_01" id="v_01" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>PPJP</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_02" id="v_02" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>RUANG</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_03" id="v_03" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>KELAS</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_04" id="v_04" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>


            <br><br>
            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td style="text-align: center;"><b>Tgl/Jam <br>No.Dx</b></td>
                        <td style="text-align: center;"><b>Diagnosa<br>Keperawatan</b></td>
                        <td style="text-align: center;"><b>NOC</b></td>
                        <td style="text-align: center;"><b>NIC</b></td>
                        <td style="text-align: center;"><b>Nama/<br>Ttd</b></td>
                    </tr>

                    <tr>
                        <td>1. <input type="date" id="v_05" name="v_05" style="width: 110px"></td>
                        <td>
                            <div class="mb-1"><b>Kelebihan Volume Cairan</b><br> berhubungan dengan :</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_01" id="t_01_perfusi">
                                <label class="form-check-label" for="t_01_perfusi">Mekanisme pengaturan osmotic melemah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_02" id="t_02_risiko">
                                <label class="form-check-label" for="t_02_risiko">Asupan cairan berlebihan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_03" id="t_03_renal">
                                <label class="form-check-label" for="t_03_renal">Asupan natrium berlebihan</label>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1">Kelebihan cairan teratasi <br> dalam waktu
                                <input type="text" id="" name="" style="width: 50px"> x 24 jam<br>Dengan kriteria hasil :
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_04" id="t_04_perfusi">
                                <label class="form-check-label" for="t_04_perfusi">Bebas dari edema, effuse, anasarka.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_05" id="t_05_risiko">
                                <label class="form-check-label" for="t_05_risiko">Suara nafas bersih, tidak ada dispnoe, orthopnoe</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_06" id="t_06_renal">
                                <label class="form-check-label" for="t_06_renal">Tidak ada distensi vena leher</label>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1"><b>MANAJEMEN CAIRAN</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_07" id="t_07_ikterik">
                                <label class="form-check-label" for="t_07_ikterik">Timbang popok / pembalut jika diperlukan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_08" id="t_08_glukosa">
                                <label class="form-check-label" for="t_08_glukosa">Pertahankan catatan intake dan output yang akurat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_09" id="t_09_efektif">
                                <label class="form-check-label" for="t_09_efektif">Pasan DC bila perlu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_010" id="t_010_tidak">
                                <label class="form-check-label" for="t_010_tidak">Monitor CVP, MAP < PAP, PCWP</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_011" id="t_011_difisit">
                                <label class="form-check-label" for="t_011_difisit">Monitor vital sign kaji lokasi dan luas edema</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_012" id="t_012_disfungsi">
                                <label class="form-check-label" for="t_012_disfungsi">Monitor status nutrisi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_013" id="t_013_risiko">
                                <label class="form-check-label" for="t_013_risiko">Berikan diuritik sesuai instruksi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_014" id="t_014_kadar">
                                <label class="form-check-label" for="t_014_kadar">Batasi cairan yang masuk</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_015" id="t_015_syok">
                                    <label class="form-check-label" for="t_015_syok">Tentukan riwayat jumlah dan tipe intake cairan dan eliminasi</label>
                                </div>
                            </div>

                            <div class="mb-1"><b>MONITORING CAIRAN</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_016" id="t_016_ikterik">
                                <label class="form-check-label" for="t_016_ikterik">Tentukan kemungkinan factor risiko dan ketidakseimbangan cairan (Hypertermia, terapi diuretic, kelainan renal, gagal jantung, diaphoresis, disfungsi hati, dll)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_017" id="t_017_glukosa">
                                <label class="form-check-label" for="t_017_glukosa">Monitor berat badan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_018" id="t_018_efektif">
                                <label class="form-check-label" for="t_018_efektif">Monitor serum dan elektrolit dan elektrolit urine</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_019" id="t_019_tidak">
                                <label class="form-check-label" for="t_019_tidak">Monitor BP, HR, RR.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_020" id="t_020_difisit">
                                <label class="form-check-label" for="t_020_difisit">Catat intake dan output cairan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_021" id="t_021_disfungsi">
                                <label class="form-check-label" for="t_021_disfungsi">Monitor adanya distensi leher, edema perifer, penambahan BB.</label>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1" style="text-align: center;">
                                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD">
                                <br><input type="text" name="v_06" id="v_06" style="width: 130px" placeholder="Nama">
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
    </form>
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
</body>

</html>
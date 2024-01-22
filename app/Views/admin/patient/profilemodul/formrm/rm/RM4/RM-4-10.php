<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RM 4.10 KRITERIA PASIEN MASUK DAN KELUAR ICU</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RM 4.10</b></h5>

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

                    <tr>
                        <td colspan="3">
                            <h4 style="text-align: center;"><b>KRITERIA PASIEN MASUK DAN KELUAR RUANG INTESIVE CARE</b></h4>
                        </td>
                    </tr>


                </tbody>
            </table>

            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td style="text-align: center;"><b>PRIORITAS</b></td>
                        <td colspan="2" style="text-align: center;"><b>KRITERIA MASUK</b></td>
                        <td colspan="2" style="text-align: center;"><b>KRITERIA KELUAR</b></td>
                    </tr>

                    <tr>
                        <td><b>I (PERTAMA)</b></td>
                        <td colspan="2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_01">
                                <label class="form-check-label" for="t_01">Pasien gagal nafas berat : status asmaticus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_02">
                                <label class="form-check-label" for="t_02">Shock dengan berbagai penyebab</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_03">
                                <label class="form-check-label" for="t_03"> Trauma kapitis berat dengan peningkatan TIK</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_04">
                                <label class="form-check-label" for="t_04"> Gangguan asam basa dan elektrolit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_05">
                                <label class="form-check-label" for="t_05"> Hipotensi/hipoksemia</label>
                            </div>
                        </td>
                        <td colspan="2" rowspan="3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_06">
                                <label class="form-check-label" for="t_06">1. Kondisi membaik dan cukup stabil</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_07">
                                <label class="form-check-label" for="t_07">2. Pasien tidak memerlukan alat bantu mekanis khusus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_08">
                                <label class="form-check-label" for="t_08">3. Pasien / keluargan menolak di rawat lebih lanjut di ruang intensive</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_09">
                                <label class="form-check-label" for="t_09">4. Pasien hanya memerlukan observasi intensive saja dan ada pasien lain yang lebih gawat yang memerlukan perawatan intensive</label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td><b>II (Dua)</b> </td>
                        <td colspan="2">
                            <div class="mb-1"><b> Paska bedah mayor dan luas</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_010">
                                <label class="form-check-label" for="t_010">Bedah digestifus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_011">
                                <label class="form-check-label" for="t_011">Bedah tumor</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_012">
                                    <label class="form-check-label" for="t_012">Bedah syaraf</label>
                                </div>
                            </div>

                            <div class="mb-1"><b> Pasien dengan penyakit primer</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_013">
                                <label class="form-check-label" for="t_013">Jantung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_014">
                                <label class="form-check-label" for="t_014">Paru</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_015">
                                <label class="form-check-label" for="t_015">Ginjal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_016">
                                <label class="form-check-label" for="t_016">Syaraf</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_017">
                                    <label class="form-check-label" for="t_017">Gangguan metabolisme</label>
                                </div>
                            </div>

                            <div><b>Ket : untuk mengurangi atau menghindari komplikasi yang lebih berat</b></div>
                        </td>
                    </tr>


                    <tr>
                        <td rowspan="2"><b>III (Tiga)</b></td>
                        <td colspan="2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_018">
                                <label class="form-check-label" for="t_018">Pasien dengan metastase tumor ganas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_019">
                                <label class="form-check-label" for="t_019">Komplikasi gagal pernafasan dengan prognosa buruk untuk sembuh</label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-3">
                                        <label for="">Tanggal</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="v_01" name="v_01" style="width: 150px">
                                    </div>
                                </div>
                            </div> <br>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-3">
                                        <label for="">Jam</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="time" class="form-control" id="v_02" name="v_02" style="width: 150px">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-3">
                                        <label for="">Tanggal</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="v_03" name="v_03" style="width: 150px">
                                    </div>
                                </div>
                            </div> <br>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-3">
                                        <label for="">Jam</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="time" class="form-control" id="v_04" name="v_04" style="width: 150px">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td></td>
                        <td style="text-align: center;">
                            <div>DPJP</div>

                            <div class="mb-1">
                                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD">
                                <br><input type="text" name="v_05" id="v_05">
                                <br><label for="">Ttd & Nama Terang</label>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <div>Dokter Anastesi</div>

                            <div class="mb-1">
                                <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD_1" id="TTD_1">
                                <br><input type="text" name="v_06" id="v_06">
                                <br><label for="">Ttd & Nama Terang</label>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <div>Dokter Anastesi</div>

                            <div class="mb-1">
                                <canvas id="canvas2" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD_2" id="TTD_3">
                                <br><input type="text" name="v_07" id="v_07">
                                <br><label for="">Ttd & Nama Terang</label>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <div>DPJP</div>

                            <div class="mb-1">
                                <canvas id="canvas3" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD_3" id="TTD_3">
                                <br><input type="text" name="v_08" id="v_08">
                                <br><label for="">Ttd & Nama Terang</label>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>

            <br>
            <div>
                <b>
                    KETERANGAN : <br>
                    - Bila pasien PICU-NICU hanya tanda tangan dokter DPJP

                </b>
            </div>

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
</body>

</html>
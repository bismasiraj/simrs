<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RMJ 2 ASSESMEN MEDIS PASIEN UMUM</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RMJ.2</b></h5>

            <br><br>
            <h6 style="text-align: center;"><b>REKAM MEDIS RAWAT JALAN</b></h6>
            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <img src="<?= base_url('assets/img/logo.png') ?>" alt="logo" width="100px">
                            <div>
                                <label>Sehat-Amanah <br>Tanggungjawab-Islami</label>
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
                        <td colspan="3" style="text-align: center;">
                            <h5><b>ASESMEN MEDIS PASIEN UMUM</b></h5>
                        </td>
                    </tr>

                </tbody>
            </table>

            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td>
                            <div class="row">
                                <label class="col-sm-1 col-form-label">Tanggal :</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="V_01" name="V_01">
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-1 col-form-label">Jam :</label>
                                <div class="col-sm-4">
                                    <input type="time" class="form-control" id="v_02" name="v_02">
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Riwayat Alergi :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_24" name="v_24" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="row align-items-center">
                                        <div class="col-md-9">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <input type="radio" class="form-check-input" name="t_01" id="t_01_autoanamnesis" value="1">
                                                    <strong><label for="t_01_autoanamnesis">Anamnesa</label></strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="radio" class="form-check-input" name="t_01" id="t_01_alloanamnesis" value="2">
                                                    <strong><label for="t_01_alloanamnesis">Alloanamnesis*</label></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label>Dengan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="v_03" id="v_03">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label>Hubungan dengan pasien</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="v_04" id="v_04">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="container">
                                <ul>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label><b>Keluhan Utama</b></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="v_05" id="v_05">
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label><b>Riwayat Penyakit Sekarang</b></label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="v_06" id="v_06" cols="6" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <div class="row align-items-center">
                                                    <div class="col-md-5">
                                                        <label>Alloanamnesis* dengan</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="v_07" id="v_07">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Hubungan dengan pasien</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text" name="v_08" id="v_08">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label><b>Riwayat Penyakit Dahulu</b></label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="v_09" id="v_09" cols="6" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                </ul>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Riwayat obat yang dikonsumsi :</b></label>
                            <div class="mb-3">
                                <div class="col-md-2">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">1. </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_23" name="v_23" style="width: 900px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row text-align">
                                    <div class="col-md-4">
                                        <label for="">2. </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_23" name="v_23" style="width: 900px">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Pemeriksaan Fisik :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_24" name="v_24" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Pemeriksaan Penunjang :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_24" name="v_24" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Diagnosis Kerja :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_24" name="v_24" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Terapi :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_24" name="v_24" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>


            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>


                    <tr>
                        <td rowspan="4" style="text-align: center;"><br><br><br><b>Rencana Tindak Lanjut </b></td>
                        <td>
                            <div class="col-md-6">
                                <input type="radio" class="form-check-input" name="t_01" id="t_01_autoanamnesis" value="1">
                                <label for="t_01_autoanamnesis">Rawat Jalan</label>
                            </div>
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="row align-items-center">
                                            <div class="col-md-9">
                                                <div class="row align-items-center">

                                                    <div class="col-md-6">
                                                        <input type="radio" class="form-check-input" name="t_01" id="t_01_alloanamnesis" value="2">
                                                        <label for="t_01_alloanamnesis">Rawat Inap</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-4">
                                                <label>Ruang</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="v_03" id="v_03" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label>Indikasi</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_04" id="v_04" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label><b>DPJP Rawat Inap :</b></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="v_09" id="v_09" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label class="col-3" for="">Pengantar Pasien :</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_01" id="t_01_ya" value="0">
                                <label class="form-check-label" for="t_01_ya">Ada </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="t_01" id="t_01_tidak" value="0">
                                <label class="form-check-label" for="t_01_tidak">Tidak* (Bila tidak, rujuk ke Dinas Sosial) </label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="mb-2">
                                <label class="col-2" for="">Rujuk ke : </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_cm" value="0">
                                    <label class="form-check-label" for="t_028_cm">RS</label>
                                    <input type="text" id="" name="" style="width: 120px">
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_apatis" value="1">
                                    <label class="form-check-label" for="t_028_apatis">Dokter Keluarga</label>
                                    <input type="text" id="" name="" style="width: 120px">
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_somno" value="1">
                                    <label class="form-check-label" for="t_028_somno">Puskesmas</label>
                                    <input type="text" id="" name="" style="width: 120px">
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_sopor" value="1">
                                    <label class="form-check-label" for="t_028_sopor">Dokter</label>
                                    <input type="text" id="" name="" style="width: 120px">
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_coma" value="1">
                                    <label class="form-check-label" for="t_028_coma">Homecare</label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <div class="col-md-8">
                                        <div class="row text-align">
                                            <div class="col-md-9">
                                                <label for="">Kontrol Klinik / Homecare di :</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" id="v_23" name="v_23" style="width: 200px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-md-2">
                                        <div class="row text-align">
                                            <div class="col-md-8">
                                                <label for="">Tanggal</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="v_23" name="v_23" style="width: 100px">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td><b>Edukasi Pasien </b></td>
                        <td>
                            <div class="mb-1">Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada :</div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_041" id="t_041_perfusi">
                                <label class="form-check-label" for="t_041_perfusi">Pasien</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_041" id="t_041_risiko">
                                <label class="form-check-label" for="t_041_risiko">Keluarga pasien, nama :</label>
                                <input type="text" id="" name="" style="width: 250px">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_041" id="t_041_renal">
                                <label class="form-check-label" for="t_041_renal">Tidak dapat memberi edukasi kepada pasien atau keluarga, Karena </label>
                                <input type="text" id="" name="" style="width: 250px">
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="t_041" id="t_041_cerebral">
                                    <label class="form-check-label" for="t_041_cerebral">Risiko perfusi cerebral tidak efektif</label>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>


            <div class="row">
                <div class="col-6">
                    <div style="text-align: center;">Dokter</div>

                    <div class="mb-1" style="text-align: center;">
                        <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="TTD" id="TTD">
                        <br>(<input type="text" name="v_30" id="v_30">)
                    </div>
                </div>


                <div class="col-6">
                    <div style="text-align: center;">Penerima Penjelasan</div>

                    <div class="mb-1" style="text-align: center;">
                        <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="TTD_1" id="TTD_1">
                        <br>(<input type="text" name="v_31" id="v_31">)
                    </div>
                </div>
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

</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>2.2 LAPORAN PERSALINAN</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RM 2.2</b></h5>

            <div class="row mb-3">
                <div class="col-md-3" style="text-align:center">
                    <img src="<?= base_url('img/logo.png') ?>" alt="logo" width="130px"><br>
                    <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                </div>
                <div class="col" style="text-align: center;">
                    <br><br>
                    <h5><b>RS. PKU MUHAMMADIYAH SAMPANGAN</b></h5>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>
                        <i class="bi bi-telephone-fill"></i> Telp 0271-633894 Fax. : 0271-630229 <br>
                        Jawa Tengah 57117
                    </p>
                </div>
            </div>


            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td rowspan="2" style="text-align: center;"><br><b>LAPORAN PERSALINAN</b></td>
                        <td>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Ruangan</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_01" name="v_01" style="width: 250px" readonly>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">No.RM</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="no_Registration" name="no_Registration" style="width: 250px" readonly>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Nama</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="thename" name="thename" style="width: 250px" readonly>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Umur</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="ageyear " name="ageyear " style="width: 250px" readonly>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td> <textarea class="form-control" id="v_02" name="v_02" rows="15" cols="7"></textarea></td>
                        <td> <textarea class="form-control" id="v_03" name="v_03" rows="15" cols="7"></textarea></td>
                        <td> <textarea class="form-control" id="v_04" name="v_04" rows="15" cols="7"></textarea></td>
                    </tr>

                </tbody>
            </table>


            <br><br>
            <h5><b>IKHTISAR PERSALINAN</b></h5>
            <div class="row">
                <div class="col-6">
                    <div class="mb-2">
                        <label class="col-4" for="">KK Pecah :</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="t_01" id="t_01_ya" value="0">
                            <label class="form-check-label" for="t_01_ya">Spontan </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="t_01" id="t_01_tidak" value="0">
                            <label class="form-check-label" for="t_01_tidak">Dibuat </label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="col-4" for="">Bayi Lahir :</label>
                        <label>Tanggal</label>
                        <input type="date" id="v_05" name="v_05" style="width: 190px">
                    </div>
                    <div class="mb-2">
                        <label class="col-4" for="">Jenis Partus :</label>
                        <input type="text" id="v_06" name="v_06" style="width: 250px">
                    </div>
                    <div class="mb-2">
                        <label class="col-4" for="">Indikasi :</label>
                        <input type="text" id="v_07" name="v_07" style="width: 250px">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="col-3" for="">Tanggal/Jam :</label>
                        <input type="date" id="v_08" name="v_08" style="width: 120px"> ,
                        <input type="time" name="v_09" id="v_09" style="width: 80px">
                        Warna <input type="text" id="v_10" name="v_10" style="width: 100px">
                    </div>
                    <div class="mb-2">
                        <label class="col-3" for="">Jam :</label>
                        <input type="time" id="v_11" name="v_11" style="width: 100px">
                    </div>
                </div>
            </div>



            <br><br>
            <h5><b>PASCA PERSALINAN</b></h5>
            <div class="row">
                <div class="col-4">
                    <h5><b>KEADAAN UMUM</b></h5>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">TD</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="tension_upper  " name="tension_upper  " style="width: 50px"> /
                                <input type="text" id="tension_bellow" name="tension_bellow" style="width: 50px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">N</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="nadi" name="nadi" style="width: 100px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">S</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="temperature" name="temperature" style="width: 100px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">RR</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="nafas" name="nafas" style="width: 100px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">TFU</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="v_12" name="v_12" style="width: 100px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">Kontraksi Uterus</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="v_13" name="v_13" style="width: 100px">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-4">
                    <h5><b>PENDARAHAN</b></h5>
                    <div class="md-2">
                        <div class="input-group mb-3" style="width: 200px">
                            <span class="input-group-text">Kala I</span>
                            <input type="text" class="form-control" name="v_14" id="v_14">
                            <span class="input-group-text">cc</span>
                        </div>
                    </div>
                    <div class="md-2">
                        <div class="input-group mb-3" style="width: 200px">
                            <span class="input-group-text">II</span>
                            <input type="text" class="form-control" name="v_15" id="v_15">
                            <span class="input-group-text">cc</span>
                        </div>
                    </div>
                    <div class="md-2">
                        <div class="input-group mb-3" style="width: 200px">
                            <span class="input-group-text">III</span>
                            <input type="text" class="form-control" name="v_16" id="v_16">
                            <span class="input-group-text">cc</span>
                        </div>
                    </div>
                    <div class="md-2">
                        <div class="input-group mb-3" style="width: 200px">
                            <span class="input-group-text">IV</span>
                            <input type="text" class="form-control" name="v_17" id="v_17">
                            <span class="input-group-text">cc</span>
                        </div>
                    </div>
                </div>



                <div class="col-4">
                    <h5><b>PLACENTA</b></h5>
                    <div class="mb-2">
                        <label class="col-2" for="">Lahir :</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="t_02" id="t_02_ya" value="0">
                            <label class="form-check-label" for="t_02_ya">Spontan </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="t_02" id="t_02_tidak" value="0">
                            <label class="form-check-label" for="t_02_tidak">Tidak </label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="t_03" id="t_03_ya" value="0">
                            <label class="form-check-label" for="t_03_ya">Lengkap </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="t_03" id="t_03_tidak" value="0">
                            <label class="form-check-label" for="t_03_tidak">Tidak lengkap </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="t_03" id="t_03_tidak" value="0">
                            <label class="form-check-label" for="t_03_tidak">Retensi </label>
                        </div>
                    </div>
                    <div class="md-2">
                        <div class="input-group mb-3" style="width: 200px">
                            <span class="input-group-text">Berat</span>
                            <input type="text" class="form-control" name="v_15" id="v_15">
                            <span class="input-group-text">gr</span>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">Bentuk </label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="v_16" name="v_16" style="width: 100px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">Tali Pusat</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="v_17" name="v_17" style="width: 100px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">Selaput Ketuban</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="v_18" name="v_18" style="width: 100px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">Kotiledon</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="v_19" name="v_19" style="width: 100px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div class="col-md-6">
                                <label for="">Insersio</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="v_20" name="v_20" style="width: 100px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <br><br>
            <h5><b>KEADAAN ANAK</b></h5>
            <div class="mb-2">
                <label class="col-2" for="">Lahir :</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="t_04" id="t_04_ya" value="0">
                    <label class="form-check-label" for="t_04_ya">Hidup</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="t_04" id="t_04_tidak" value="0">
                    <label class="form-check-label" for="t_04_tidak">Mati</label>
                </div>
            </div>
            <div class="mb-2">
                <label class="col-2" for="">Jenis Kelamin :</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="t_05" id="t_05_ya" value="0">
                    <label class="form-check-label" for="t_05_ya">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="t_05" id="t_05_tidak" value="0">
                    <label class="form-check-label" for="t_05_tidak">Perempuan</label>
                </div>
            </div>
            <div class="mb-2">
                <label class="col-2" for="">BB :</label>
                <input type="text" id="weight" name="weight"> gram , PB :
                <input type="text" id="height" name="height">
            </div>

            <div class="mb-2">
                <label class="col-2" for="">Apgar Score :</label>
                1 menit :<input type="text" id="v_21" name="v_21"> 5 menit :
                <input type="text" id="v_22" name="v_22"> 10 menit :<input type="text" id="v_23" name="v_23">
            </div>


            <br><br>
            <h5><b>KELAINAN KONGENITAL</b></h5>
            <div class="mb-2">
                <label class="col-5" for="">Bayi yang keadaan jelek, lahir hidup lalu meninggal :</label>
                <input type="time" id="v_24" name="v_24"> menit / jam PP
            </div>
            <div class="mb-2">
                <label class="col-5" for="">Sebab bayi lahir mati / lahir lalu meninggal :</label>
                <input type="text" id="v_25" name="v_25">
            </div>



            <br><br><br>
            <div class="row">
                <div class="col-4">
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div style="text-align: center;"><b>DOKTER</b></div>
                            <div>
                                <div class="mb-1" style="text-align: center;">
                                    <canvas id="canvas" width="200" height="150" style="border:1px solid #000;"></canvas>
                                    <input type="hidden" name="TTD" id="TTD">
                                </div>
                                <div style="text-align: center;">
                                    <input type="text" name="v_26" id="v_26">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div style="text-align: center;"><b>BIDAN</b></div>
                            <div>
                                <div class="mb-1" style="text-align: center;">
                                    <canvas id="canvas1" width="200" height="150" style="border:1px solid #000;"></canvas>
                                    <input type="hidden" name="TTD_1" id="TTD_1">
                                </div>
                                <div style="text-align: center;">
                                    <input type="text" name="v_27" id="v_27">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="col-md-10">
                        <div class="row text-align">
                            <div style="text-align: center;"><b>TENAGA MEDIS LAIN</b></div>
                            <div>
                                <div class="mb-1" style="text-align: center;">
                                    <canvas id="canvas2" width="200" height="150" style="border:1px solid #000;"></canvas>
                                    <input type="hidden" name="TTD_2" id="TTD_2">
                                </div>
                                <div style="text-align: center;">
                                    <input type="text" name="v_28" id="v_28">
                                </div>
                            </div>
                        </div>
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
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>2.1.14 ASESMEN AWAL MEDIS PASIEN BEDAH ORTHOPEDI RAWAT INAP</title>
</head>

<body>
    <form>
        <div class="container mt-3">


            <br>
            <h3 style="text-align: right;"><b>RM 2.1.14</b></h3>

            <h6 style="text-align: center;"><b>REKAM MEDIS RAWAT INAP</b></h6>


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
                            <h5><b>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>Telp 0271-633894 Fax. : 0271-630229 <br>Jawa Tengah 57117</b></h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 3px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <h5><b>ASESMEN MEDIS PASIEN BEDAH ORTHOPEDI</b></h5>
                        </td>
                    </tr>

                </tbody>
            </table>


            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td>
                            <div class="row">
                                <label for="V_0" class="col-sm-1 col-form-label">Tanggal :</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" name="v_01" id="v_01">
                                </div>
                                <div class="col-sm-1"></div>
                                <label for="V_0" class="col-sm-1 col-form-label">Jam :</label>
                                <div class="col-sm-4">
                                    <input type="time" class="form-control" name="v_02" id="v_02">
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="mb-4">
                                <label><b>ANAMNESIS : Autoanamnesis / Alloanamnesis</b> dengan :</label>
                                <input type="text" name="v_03" id="v_03"> Hubungan dengan pasien : <input type="text" name="v_04" id="v_04">
                            </div>

                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">• Keluhan Utama </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_05" name="v_05" style="width: 700px">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">• Riwayat Penyakit Sekarang </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_06" name="v_06" style="width: 700px">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">• Alloanamnesis </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_07" name="v_07" style="width: 700px">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">• Riwayat Penyakit Dahulu </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_08" name="v_08" style="width: 700px">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">• Obat- obatan yang Dikonsumsi</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_09" name="v_09" style="width: 700px">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="mb-3"><label><b>PEMERIKSAAN FISIK <br>A. Keadaan Umum</b></label></div>
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_01" id="t_01_baik" value="option1">
                                            <label class="form-check-label" for="t_01_baik">Baik</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_01" id="t_01_sedang" value="option2">
                                            <label class="form-check-label" for="t_01_sedang">Sedang</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_01" id="t_02_lemah" value="option2">
                                            <label class="form-check-label" for="t_02_lemah">Lemah</label>
                                        </div>
                                    </div>

                                    <label><b>GCS</b></label>
                                    <b>E :</b><input type="text" name="v_10" id="v_10" style="width: 100px">
                                    <b>M :</b><input type="text" name="v_11" id="v_11" style="width: 100px">
                                    <b>V :</b><input type="text" name="v_12" id="v_12" style="width: 100px">
                                </div>


                                <div class="col-6">
                                    <label><b>Tanda vital :</b></label>
                                    <div class="mb-3">
                                        TD :<input type="text" name="tension_upper" id="tension_upper" style="width: 50px"> / <input type="text" name="tension_bellow" id="tension_bellow" style="width: 50px">mmHg , N :
                                        <input type="text" name="nadi" id="nadi" style="width: 100px">x/Menit
                                    </div>
                                    <div>
                                        R :<input type="text" name="nafas" id="nafas" style="width: 100px">x/Menit , S :
                                        <input type="text" name="saturasi" id="saturasi" style="width: 100px">°C
                                    </div>
                                </div>
                            </div>


                            <div class="mb-3"><label><b>B. Status General</b></label></div>
                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-3">
                                            <label for="">1. Kepala</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_13" name="v_13" style="width: 800px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-3">
                                            <label for="">2. Leher </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_14" name="v_14" style="width: 800px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-3">
                                            <label for="">3. Thorax </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_15" name="v_15" style="width: 800px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-3">
                                            <label for="">4. Abdomen</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_16" name="v_16" style="width: 800px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-3">
                                            <label for="">5. Genitalia </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_17" name="v_17" style="width: 800px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-1">
                                <label for="">6. Extremitas </label>
                            </div>
                            <div class="mb-1">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-3">
                                            <label for="">a. Extremitas Atas</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_18" name="v_18" style="width: 800px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-3">
                                            <label for="">a. Extremitas Bawah</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_19" name="v_19" style="width: 800px">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-3"><label><b>C. Status Lokalis</b></label></div>
                            <img src="<?= base_url('img/tulang.png') ?>" alt="logo" width="1000px">


                            <br><br><br><br>
                            <div class="mb-3"><label><b>PEMERIKSAAN PENUNJANG </b></label></div>
                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">1. Laboratorium</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_20" name="v_20" style="width: 750px">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">2. Radiologi</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_21" name="v_21" style="width: 750px">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">3. ECG</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_22" name="v_22" style="width: 750px">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">4. Lain – lain </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_23" name="v_23" style="width: 750px">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <label><b>DIAGNOSIS KERJA : </b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_24" name="v_24" rows="4" cols="7"></textarea>
                                </div>
                            </div>


                            <label><b>DIAGNOSIS BANDING :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_25" name="v_25" rows="4" cols="7"></textarea>
                                </div>
                            </div>


                            <label><b>Masalah :</b></label>
                            <div><label>a. Medis : </label></div>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_26" name="v_26" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                            <label>b. Keperawatan : </label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_27" name="v_27" rows="4" cols="7"></textarea>
                                </div>
                            </div>

                            <label><b>SASARAN :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_28" name="v_28" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                            <label><b>RENCANA ASUHAN/ TERAPI/INSTRUKSI (standing order):</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_29" name="v_29" rows="10" cols="7"></textarea>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-6">
                                    <div>Dokter</div>

                                    <div class="mb-1">
                                        <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                        <input type="hidden" name="TTD" id="TTD">
                                        <br><input type="text" name="v_30" id="v_30">
                                        <br><label for="">Ttd & Nama Terang</label>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div>Penerima Penjelasan</div>

                                    <div class="mb-1">
                                        <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                                        <input type="hidden" name="TTD_1" id="TTD_1">
                                        <br><input type="text" name="v_31" id="v_31">
                                        <br><label for="">Ttd & Nama Terang</label>
                                    </div>
                                </div>
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
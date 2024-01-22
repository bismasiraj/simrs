<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <title>ASESMEN PASIEN DENGAN RISIKO MENDAPATKAN KEKERASAN FISIK</title>
</head>

<body>
    <div class="container">
        <h6 style="text-align:right">RM.2.1.18</h6>
        <form action="" autocomplete="off" style="font-family:'Times New Roman';">
            <h4 style="text-align: center"><b>REKAM MEDIS RAWAT INAP</b></h4>
            <table class="table table-bordered border-black">
                <tr style="vertical-align:middle; margin:0px; font-family:'Times New Roman'">
                    <td>
                        <div class="row">
                            <div class="col-md-3" style="text-align:center">
                                <img src="\img\logo_PKU.png" alt="" style="width:90px"><br>
                                <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                            </div>
                            <div class="col">
                                <h4><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h4>
                                <p>Semanggi RT 02/20 Pasar Kliwon Surakarta<br>
                                    Telp. ( 0271 ) 633894 Fax: 0271- 630229 <br>
                                    Jawa Tengah 57117
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                                    <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 style="text-align:center; margin-top:0px"><b>ASESMEN PASIEN DENGAN RISIKO MENDAPATKAN KEKERASAN FISIK</b></h4>
                    </td>
                </tr>
                <tr>
                    <td>Beri tanda checklist (√) pada kolom yang anda anggap sesuai</td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label for="V_01" class="col-sm-auto col-form-label"><b>Tanggal :</b></label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="V_01" name="V_01">
                            </div>
                            <div class="col-sm-1"></div>
                            <label for="V_02" class="col-sm-1 col-form-label"><b>Jam :</b></label>
                            <div class="col-sm-4">
                                <input type="time" class="form-control" id="V_02" name="V_02">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <div class="col-md-4">1. Diperoleh dari</div>
                            <div class="col-md-auto">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_03" name="V_03">
                            </div>
                            <div class="col-md-2">hubungan dengan pasien </div>
                            <div class="col-md-auto">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_03" name="V_03">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4">2. Anamnesis</div>
                            <div class="col-md-auto">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_05" name="V_05">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-1"></div>
                            <div class="col-md-3">Keluhan utama</div>
                            <div class="col-md-auto">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_06" name="V_06">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-1"></div>
                            <div class="col-md-3">Riwayat penyakit sekarang</div>
                            <div class="col-md-auto">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_07" name="V_07">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4">3. Pemeriksaan fisik</div>
                            <div class="col-md-auto">:</div>
                            <div class="col">
                                <input type="text" class="form-control" id="V_08" name="V_08">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">a. Bentuk Kekerasan</div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_01" name="T_01" value="1">
                                    <label class="form-check-label" for="T_01">Kekerasan seksual</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_02" name="T_02" value="1">
                                    <label class="form-check-label" for="T_02">Kekerasan fisik</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_03" name="T_03" value="1">
                                    <label class="form-check-label" for="T_03">Kekerasan psikis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_04" name="T_04" value="1">
                                    <label class="form-check-label" for="T_04">Penelantaran (gizi, pendidikan, emosi)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">b. Tempat kejadian</div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_05" name="T_05" value="1">
                                    <label class="form-check-label" for="T_05">Dalam rumah tangga </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_06" name="T_06" value="1">
                                    <label class="form-check-label" for="T_06">Di tempat kerja/ sekolah </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_07" name="T_07" value="1">
                                    <label class="form-check-label" for="T_07">Di daerah konflik </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_08" name="T_08" value="1">
                                    <label class="form-check-label" for="T_08">Jalanan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_09" name="T_09" value="1">
                                    <label class="form-check-label" for="T_09">Lain lain</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">c. Dampak yang terjadi pada korban kekerasan perkosaan</div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_010" name="T_010" value="1">
                                    <label class="form-check-label" for="T_010">Rasa takut </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_011" name="T_011" value="1">
                                    <label class="form-check-label" for="T_011">Cemas </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_012" name="T_012" value="1">
                                    <label class="form-check-label" for="T_012">Gugup </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_013" name="T_013" value="1">
                                    <label class="form-check-label" for="T_013">Depresi </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_014" name="T_014" value="1">
                                    <label class="form-check-label" for="T_014">Tampak serba bingung</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_015" name="T_015" value="1">
                                    <label class="form-check-label" for="T_015">Tegang </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_016" name="T_016" value="1">
                                    <label class="form-check-label" for="T_016">Sulit bicara</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_017" name="T_017" value="1">
                                    <label class="form-check-label" for="T_017">Banyak melamun</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_018" name="T_018" value="1">
                                    <label class="form-check-label" for="T_018">Perasaan sensitif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_019" name="T_019" value="1">
                                    <label class="form-check-label" for="T_019">Mata tidak fokus</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_020" name="T_020" value="1">
                                    <label class="form-check-label" for="T_020">Penampilan tidak rapi/ tidak teratur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_021" name="T_021" value="1">
                                    <label class="form-check-label" for="T_021">Mudah curiga Pada orang lain</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_022" name="T_022" value="1">
                                    <label class="form-check-label" for="T_022">Ekspresi wajah tegang</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_023" name="T_023" value="1">
                                    <label class="form-check-label" for="T_023">Terlihat menunjukan kebencian dan kemarahan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">4. Dampak yang terjadi pada pasien dengan KDRT</div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_024" name="T_024" value="1">
                                    <label class="form-check-label" for="T_024">Cidera bilateral/ multilateral</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_025" name="T_025" value="1">
                                    <label class="form-check-label" for="T_025">Beberapa cidera dengan beberapa tampak penyembuhan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_026" name="T_026" value="1">
                                    <label class="form-check-label" for="T_026">Keterangan yang tidak sesuai dengan cideranya </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_027" name="T_027" value="1">
                                    <label class="form-check-label" for="T_027">Keterlambatan mendapatkan pertolongan medis/ berobat</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_028" name="T_028" value="1">
                                    <label class="form-check-label" for="T_028">Berulangnya mendapatkan kekerasan fisik dan berobat ke RS akibat dari trauma</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">5. Dampak kekerasan pada anak (psychological abuse)</div>
                            <div class="col">
                                Ekpresi wajah :
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_029" name="T_029" value="1">
                                    <label class="form-check-label" for="T_029">Sedih</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_030" name="T_030" value="1">
                                    <label class="form-check-label" for="T_030">Takut</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_031" name="T_031" value="1">
                                    <label class="form-check-label" for="T_031">Perubahan perilaku anak agresif atau penarikan diri yang berlebihan </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_032" name="T_032" value="1">
                                    <label class="form-check-label" for="T_032">Cerita yang berubah dari ucapan yang sebelumnya </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_033" name="T_033" value="1">
                                    <label class="form-check-label" for="T_033">Lari dari rumah atau melakukan kenakalan remaja</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_034" name="T_034" value="1">
                                    <label class="form-check-label" for="T_034">Menghindari kontak mata</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_035" name="T_035" value="1">
                                    <label class="form-check-label" for="T_035">Terlalu penurut/ pasif</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_036" name="T_036" value="1">
                                    <label class="form-check-label" for="T_036">Lari dari orang tua untuk minta tolong/ perlindungan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">6. Penelantaran Fisik pada anak</div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_037" name="T_037" value="1">
                                    <label class="form-check-label" for="T_037">Gagal tumbuh/ keterlambatan perkembangan fisik maupun mental</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_038" name="T_038" value="1">
                                    <label class="form-check-label" for="T_038">Luka/ penyakit yang di biarkan tidak diobati</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_039" name="T_039" value="1">
                                    <label class="form-check-label" for="T_039">KU lemah letargi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_040" name="T_040" value="1">
                                    <label class="form-check-label" for="T_040">Pakaian yang lusuh dan kotor</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">7. Tanda - tanda yang didapatkan pada korban kekerasan</div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_041" name="T_041" value="1" onclick="fungsi1()">
                                    <label class="form-check-label" for="T_041">Terdapat memar di </label>
                                    <input type="text" id="V_09" name="V_09" disabled>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_042" name="T_042" value="1" onclick="fungsi2()">
                                    <label class="form-check-label" for="T_042">Luka lecet dan luka robek di </label>
                                    <input type="text" id="V_10" name="V_10" disabled>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_043" name="T_043" value="1" onclick="fungsi3()">
                                    <label class="form-check-label" for="T_043">Patah tulang baru/ lama di </label>
                                    <input type="text" id="V_11" name="V_11" disabled>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_044" name="T_044" value="1">
                                    <label class="form-check-label" for="T_044">Gigi Patah/ Berdarah </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_045" name="T_045" value="1" onclick="fungsi4()">
                                    <label class="form-check-label" for="T_045">Terdapat luka bakar lokasi </label>
                                    <input type="text" id="V_12" name="V_12" disabled>
                                    <label for="V_13">derajat</label>
                                    <input type="text" id="V_13" name="V_13" disabled> %
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_046" name="T_046" value="1" onclick="fungsi5()">
                                    <label class="form-check-label" for="T_046">Cidera kepala ada/ tidak, ada di </label>
                                    <input type="text" id="V_14" name="V_14" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">8. Tanda kemungkinan kekerasan seksual abuse</div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_047" name="T_047" value="1">
                                    <label class="form-check-label" for="T_047">Adanya perlukaan/ jejas pada alat kelamin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_048" name="T_048" value="1">
                                    <label class="form-check-label" for="T_048">Adanya rasa nyeri, perdarahan dari vagina</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col" style="text-align:center">
                                Dokter<br>
                                <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD"><br>
                                ( <input type="text" id="V_15" name="V_15" style="width:250px; text-align: center;"> )<br>
                                Ttd & Nama Terang
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        function fungsi1() {
            if ($("#T_041").is(":checked")) {
                $("#V_09").removeAttr("disabled");
                $("#V_09").focus();
            } else {
                $("#V_09").attr("disabled", true);
                $("#V_09").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi2() {
            if ($("#T_042").is(":checked")) {
                $("#V_10").removeAttr("disabled");
                $("#V_10").focus();
            } else {
                $("#V_10").attr("disabled", true);
                $("#V_10").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi3() {
            if ($("#T_043").is(":checked")) {
                $("#V_11").removeAttr("disabled");
                $("#V_11").focus();
            } else {
                $("#V_11").attr("disabled", true);
                $("#V_11").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi4() {
            if ($("#T_045").is(":checked")) {
                $("#V_12, #V_13").removeAttr("disabled");
                $("#V_12").focus();
            } else {
                $("#V_12, #V_13").attr("disabled", true);
                $("#V_12, #V_13").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi5() {
            if ($("#T_046").is(":checked")) {
                $("#V_14").removeAttr("disabled");
                $("#V_14").focus();
            } else {
                $("#V_14").attr("disabled", true);
                $("#V_14").val("");
            }
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

        function clearCanvas() {
            context.clearRect(0, 0, canvas.width, canvas.height);
        }

        function saveSignatureData() {
            const canvasData = canvas.toDataURL('image/png');

            canvasDataInput.value = canvasData;
        }
    </script>
</body>

</html>
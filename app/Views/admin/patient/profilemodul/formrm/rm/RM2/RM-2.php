<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ASESMEN PERAWAT</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script type="text/javascript">
        // JavaScript Document
        var i = 13;
        var no = 1;
        var canvas = 1;

        function addRow(tableID) {

            i1 = no + 1;
            i2 = i + 1;
            i3 = i + 2;
            i4 = canvas + 1;

            $("#" + tableID).append($("<tr>")
                .append($("<td>").html(i1))
                .append($("<td>").html('<div class="form-group"><input type="datetime-local" class="form-control" name="v_' + i2 + '"  id="v_' + i2 + '" size="20px"></div>'))
                .append($("<td>").html('<div class="form-group"><textarea class="form-control" id="v_' + i3 + '" name="v_' + i3 + '" rows="2" cols="6" placeholder="Tindakan"></textarea></div>'))
                .append($("<td>").html('<canvas id="canvas' + i4 + '" width="150" height="75" style="border:1px solid #000;"></canvas><input type="hidden" id="ttd_' + i4 + '" name="ttd_' + i4 + '">'))
                .append($("<script>").html('var canvas' + i4 + ' = document.getElementById("canvas' + i4 + '");\
                                const canvasDataInput' + i4 + ' = document.getElementById("ttd_' + i4 + '");\
                                var context' + i4 + ' = canvas' + i4 + '.getContext("2d");\
                                var drawing = false;\
                                canvas' + i4 + '.addEventListener("mousedown", startDrawing); \
                                canvas' + i4 + '.addEventListener("mousemove", draw); \
                                canvas' + i4 + '.addEventListener("mouseup", stopDrawing); \
                                canvas' + i4 + '.addEventListener("mouseout", stopDrawing); \
                                function startDrawing(e) { drawing = true; draw(e);  } \
                                function draw(e) { if (!drawing) return;\
                                context' + i4 + '.lineWidth = 2; \
                                context' + i4 + '.lineCap = "round"; \
                                context' + i4 + '.strokeStyle = "#000"; \
                                context' + i4 + '.lineTo(e.clientX - canvas' + i4 + '.getBoundingClientRect().left, e.clientY - canvas' + i4 + '.getBoundingClientRect().top); \
                                context' + i4 + '.stroke(); \
                                context' + i4 + '.beginPath(); \
                                context' + i4 + '.moveTo(e.clientX - canvas' + i4 + '.getBoundingClientRect().left, e.clientY - canvas' + i4 + '.getBoundingClientRect().top); \
                                }\
                                 function stopDrawing() { drawing = false; context' + i4 + '.beginPath(); } \
                                function saveSignatureData' + i4 + '() { const canvasData' + i4 + ' = canvas' + i4 + '.toDataURL("image/png"); \
                                    canvasDataInput' + i4 + '.value = canvasData' + i4 + '; \
                                }'))

            )

            i += 2;
            canvas += 1;
            no += 1;
        }
    </script>

    <script type="text/javascript">
        // JavaScript Document
        var i = 25;
        var no = 1;
        var canvas = 11;

        function addRow1(tableID) {

            i1 = no + 1;
            i2 = i + 1;
            i3 = i + 2;
            i4 = canvas + 1;

            $("#" + tableID).append($("<tr>")
                .append($("<td>").html(i1))
                .append($("<td>").html('<div class="form-group"><input type="datetime-local" class="form-control" name="v_' + i2 + '"  id="v_' + i2 + '" size="20px"></div>'))
                .append($("<td>").html('<div class="form-group"><textarea class="form-control" id="v_' + i3 + '" name="v_' + i3 + '" rows="2" cols="6" placeholder="Tindakan"></textarea></div>'))
                .append($("<td>").html('<canvas id="canvas' + i4 + '" width="150" height="75" style="border:1px solid #000;"></canvas><input type="hidden" id="ttd_' + i4 + '" name="ttd_' + i4 + '">'))
                .append($("<script>").html('var canvas' + i4 + ' = document.getElementById("canvas' + i4 + '"); \
                                            const canvasDataInput' + i4 + ' = document.getElementById("ttd_' + i4 + '"); \
                                            var context' + i4 + ' = canvas.getContext("2d"); \
                                            var drawing = false; \
                                            canvas' + i4 + '.addEventListener("mousedown", startDrawing);\
                                            canvas' + i4 + '.addEventListener("mousemove", draw);\
                                            canvas' + i4 + '.addEventListener("mouseup", stopDrawing);\
                                            canvas' + i4 + '.addEventListener("mouseout", stopDrawing);\
                                            function startDrawing(e) { drawing = true;\
                                                draw(e);\
                                            }\
                                            function draw(e) { if (!drawing) return; \
                                                context' + i4 + '.lineWidth = 2; \
                                                context' + i4 + '.lineCap = "round"; \
                                                context' + i4 + '.strokeStyle = "#000"; \
                                                context' + i4 + '.lineTo(e.clientX - canvas' + i4 + '.getBoundingClientRect().left, e.clientY - canvas' + i4 + '.getBoundingClientRect().top); \
                                                context' + i4 + '.stroke(); \
                                                context' + i4 + '.beginPath(); \
                                                context' + i4 + '.moveTo(e.clientX - canvas' + i4 + '.getBoundingClientRect().left, e.clientY - canvas' + i4 + '.getBoundingClientRect().top); \
                                            } \
                                            function stopDrawing() { drawing = false; \
                                                context' + i4 + '.beginPath(); \
                                            } \
                                            function saveSignatureData' + i4 + '() { const canvasData' + i4 + ' = canvas' + i4 + '.toDataURL("image/png"); \
                                                canvasDataInput' + i4 + '.value = canvasData' + i4 + '; \
                                            }'))

            )

            i += 2;
            canvas += 1;
            no += 1;
        }
    </script>

</head>

<body>

    <div class="container-fluid mt-5">
        <form action="<?= site_url('#') ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <h6 align="right">RM 2</h6>
            <table class="table table-bordered mb-0" style="border: 2px solid black; border-bottom:0;">
                <tr>
                    <td width="15%" align="center">
                        <img class="mt-3" src="<?= base_url('assets/img/logo.png') ?>" width="80px">

                        <p class="mt-3">Sehat-Amanah <br> Tanggung Jawab-Islami</p>
                    </td>

                    <td>
                        <div class="row ml-5">
                            <div class="col-md-6" style="padding-top: 10px;">
                                <h5>RS. PKU MUHAMMADIYAH SAMPANGAN <br> SURAKARTA</h5>
                                <strong>
                                    <p>Semanggi RT 002 / RW 010 Pasar Kliwon, Surakarta <br> Telp 0271-633894 Fax. : 0271-630229 <br> Jawa Tengah 57117</p>
                                </strong>
                            </div>
                            <div class="col-md-6" style="padding-top:30px;">
                                <div class="container mt-1" style="border:1px solid black; padding-top:30px; height:100px;  width: 60%;">
                                    <p class="text-center">Label Identitas Pasien</p>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr style="border: 2px solid black">
                    <td colspan="3">
                        <h5 class="text-center">ASESMEN PERAWAT</h5>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mt-0 mb-0" style="border:2px solid black; border-bottom:0; border-top:0">
                <tr>
                    <td width="50%">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label>Tanggal Pengkajian</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="date" name="v_01" id="v_01">
                            </div>
                        </div>
                    </td>
                    <td width="50%">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Jam</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="time" name="v_02" id="v_02">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <p>Rujukan dari : </p>
                            </div>
                            <div class="col-md-3">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_01_rs" name="t_01" value="1">
                                            <label for="t_01_rs">Rumah Sakit</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="v_03" id="v_03">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_01_klinik" name="t_01" value="2">
                                            <label for="t_01_klinik">Klinik</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="v_04" id="v_04">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_01_puskesmas" name="t_01" value="3   ">
                                            <label for="t_01_puskesmas">Puskesmas</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="v_05" id="v_05">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mt-0 b-0" style="border: 2px solid black; border-top:0; border-bottom:0;">
                <tr>
                    <td width="25%" class="text-center">
                        <p>RIWAYAT ALERGI</p>
                    </td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_02_ya" name="t_02" value="1">
                                    <label for="t_02_ya">Ya, </label>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <input class="form-control" type="text" name="v_06" id="v_06">
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_02_tidak" name="t_02" value="2">
                            <label for="t_02_tidak">Tidak</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>
                            <p>Keluhan Utama</p>
                        </strong>
                        <textarea class="form-control" name="v_07" id="v_07" cols="6" rows="2"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>
                            <p>Riwayat Penyakit Sekarang</p>
                        </strong>
                        <textarea class="form-control" name="v_08" id="v_08" cols="6" rows="3"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <p>Keadaan Umum</p>
                            </div>
                            <div class="col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_03_baik" name="t_03" value="1">
                                    <label for="t_03_baik">Baik</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_03_sedang" name="t_03" value="2">
                                    <label for="t_03_sedang">Sedang</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_03_lemah" name="t_03" value="3">
                                    <label for="t_03_lemah">Lemah</label>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">BB</span>
                                    <input type="text" class="form-control" name="weight" id="weight">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">TB/PB</span>
                                    <input type="text" class="form-control" name="height" id="height">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">LLA</span>
                                    <input type="text" class="form-control" name="arm_diameter" id="arm_diameter">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>
                            <p>PENGKAJIAN PRIMER</p>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td>Circulasi</td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">TD</span>
                                    <input type="text" class="form-control" name="tension_upper" id="tension_upper">
                                    <span class="input-group-text">/</span>
                                    <input type="text" class="form-control" name="tension_below" id="tension_below">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">S</span>
                                    <input type="text" class="form-control" name="temperature" id="temperature">
                                    <span class="input-group-text">C</span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nadi</span>
                                    <input type="text" class="form-control" name="nadi" id="nadi">
                                    <span class="input-group-text">x/menit</span>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_04" id="t_04_kuat" value="1">
                                    <label for="t_04_kuat">Kuat</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_04" id="t_04_lemah" value="2">
                                    <label for="t_04_lemah">Lemah</label>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_05" id="t_05_teratur" value="1">
                                    <label for="t_05_teratur">Teratur</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_05" id="t_05_tidak" value="2">
                                    <label for="t_05_tidak">Tidak Teratur</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">CRT</span>
                                    <input type="text" class="form-control" name="t_06" id="t_06">
                                    <span class="input-group-text">detik</span>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">GDS</span>
                                    <input type="text" class="form-control" name="t_07" id="t_07">
                                    <span class="input-group-text">mg/dL</span>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">SPO2</span>
                                    <input type="text" class="form-control" name="saturasi" id="saturasi">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label class="col-form-label">Extremitas atas dan bawah</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_08" id="t_08_hangat" value="1">
                                    <label for="t_08_hangat">Hangat</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_08" id="t_08_dingin" value="2">
                                    <label for="t_08_dingin">Dingin</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_09" id="t_09_oedem" value="1">
                                    <label for="t_09_oedem">Oedem</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_09" id="t_09_tidak" value="2">
                                    <label for="t_09_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label class="col-form-label">Turgor Kulit</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_010" id="t_010_kurang" value="1">
                                    <label for="t_010_kurang">Kurang</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_010" id="t_010_baik" value="2">
                                    <label for="t_010_baik">Baik</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label class="col-form-label">Warna Kulit</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_011" id="t_011_pucat" value="1">
                                    <label for="t_011_pucat">Pucat</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_011" id="t_011_cyanosis" value="2">
                                    <label for="t_011_cyanosis">Cyaosis</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_012" id="t_012_ikterik" value="1">
                                    <label for="t_012_ikterik">Ikterik</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_012" id="t_012_tak" value="2">
                                    <label for="t_012_tak">TAK</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Airway</td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="t_013" id="t_013_fraktur" value="1">
                                    <label for="t_013_fraktur">Fraktur cervical</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="t_014" id="t_014_tidaktersumbat" value="1">
                                    <label for="t_014_tidaktersumbat">Jalan nafas tidak tersumbat</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="t_015" id="t_015_total" value="1">
                                    <label for="t_015_total">Sumbatan Total</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="t_016" id="t_016_sebagian" value="1">
                                    <label for="t_016_sebagian">Sumbatan Sebagian</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Breathing</td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label class="col-form-label">Sesak nafas</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_017" id="t_017_ya" value="1">
                                    <label for="t_017_ya">Ya</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_017" id="t_017_tidak" value="0">
                                    <label for="t_017_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Frekuensi</span>
                                    <input type="text" class="form-control" name="nafas" id="nafas">
                                    <span class="input-group-text">x/menit</span>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_018" id="t_018_teratur" value="1">
                                    <label for="t_018_teratur">Teratur</label>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_018" id="t_018_tidak" value="2">
                                    <label for="t_018_tidak">Tidak Teratur</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="t_019" id="t_019_aktivitas" value="1">
                                    <label for="t_019_aktivitas">Saat Aktivitas</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="t_020" id="t_020_tidak" value="1">
                                    <label for="t_020_tidak">Tidak Aktivitas</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="t_021" id="t_021_ototbantu" value="1">
                                    <label for="t_021_ototbantu">Otot bantu Nafas</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Disability</td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Kesadaran</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_09" id="v_09">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label for="">GCS </label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text">E</span>
                                            <input type="text" class="form-control" name="t_022" id="t_022">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text">M</span>
                                            <input type="text" class="form-control" name="t_023" id="t_023">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text">V</span>
                                            <input type="text" class="form-control" name="t_024" id="t_024">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="t_025" id="t_025" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Pupil</span>
                                    <input type="text" class="form-control" name="t_026" id="t_026">
                                    <span class="input-group-text">/</span>
                                    <input type="text" class="form-control" name="t_027" id="t_027">
                                    <span class="input-group-text">mm</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_028" id="t_028_isokor" value="1">
                                    <label for="t_028_isokor">Isokor</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_028" id="t_028_anisokor" value="2">
                                    <label for="t_028_anisokor">Anisokor</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Exposure</td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label class="col-form-label">Luka</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_029" id="t_029_ya" value="1">
                                    <label for="t_029_ya">Ya</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_029" id="t_029_tidak" value="0">
                                    <label for="t_029_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Keadaan Luka</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="v_10" id="v_10">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Kedalaman</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="v_11" id="v_11">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label class="col-form-label">Pendaharan</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_030" id="t_030_ya" value="1">
                                    <label for="t_030_ya">Ya</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_030" id="t_030_tidak" value="0">
                                    <label for="t_030_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label class="col-form-label">Fraktur/dislokasi</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_031" id="t_031_ya" value="1">
                                    <label for="t_031_ya">Ya</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_031" id="t_031_tidak" value="0">
                                    <label for="t_031_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_032" id="t_032_terbuka" value="1">
                                    <label for="t_032_terbuka">Terbuka</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_032" id="t_032_tertutup" value="2">
                                    <label for="t_032_tertutup">Tertutup</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>
                            <p>RESIKO JATUH</p>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <strong><label>Skor</label></strong>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="text" name="t_033" id="t_033">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label for="">Anak (Humpty Dumpty)</label> <br>
                                <label for="">Dewasa (Fall Morse)</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_034" id="t_034_low" value="1">
                                    <label for="t_034_low">Low, Skore : 7-11</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_034" id="t_034_rendah" value="2">
                                    <label for="t_034_rendah">Rendah, skore : 0-24</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_034" id="t_034_high" value="3">
                                    <label for="t_034_high">High Risk skore : ≥12</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_034" id="t_034_sedang" value="4">
                                    <label for="t_034_sedang">Sedang, skore : 25-44</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_034" id="t_034_tinggi" value="5">
                                    <label for="t_034_tinggi">Tinggi, skore : ≥45</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <h5 align="center">INSTALASI GAWAT DARURAT</h5>
            <table class="table table-bordered mt-0 b-0" style="border: 2px solid black; border-top:0; border-bottom:0;">
                <tr>
                    <td colspan="8">
                        <strong>
                            <p>NYERI</p>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;">Nyeri :</td>
                    <td>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_035" id="t_035_ya" value="1">
                            <label for="t_035_ya">Ya</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_035" id="t_035_tidak" value="0">
                            <label for="t_035_tidak">Tidak</label>
                        </div>
                    </td>
                    <td colspan="3" style="vertical-align:middle;">Onset :</td>
                    <td colspan="3">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_036" id="t_036_akut" value="1">
                            <label for="t_036_akut">Akut</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_036" id="t_036_kronik" value="2">
                            <label for="t_036_kronik">Kronik</label>
                        </div>
                    </td>
                </tr>
                <tr class="text-center" style="vertical-align:middle;">
                    <td colspan="2" rowspan="2" width="40%">Kelompok Umur</td>
                    <td rowspan="2" width="10%">Skor</td>
                    <td colspan="5">Kategori Nyeri</td>
                </tr>
                <tr class="text-center">
                    <td width="10%">Tidak</td>
                    <td width="10%">Ringan</td>
                    <td width="10%">Sedang</td>
                    <td width="10%">Berat</td>
                    <td width="10%">Tidak Tertahankan</td>
                </tr>
                <tr>
                    <td colspan="2">Pasien tidak sadar anak dan dewasa (CPOT)</td>
                    <td>
                        <input class="form-control" type="text" name="t_037" id="t_037">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_038" id="t_038_1" value="1">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_038" id="t_038_2" value="2">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_038" id="t_038_3" value="3">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_038" id="t_038_4" value="4">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_038" id="t_038_5" value="5">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Pasien dimensia (PAINAD)</td>
                    <td>
                        <input class="form-control" type="text" name="t_039" id="t_039">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_040" id="t_040_1" value="1">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_040" id="t_040_2" value="2">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_040" id="t_040_3" value="3">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_040" id="t_040_4" value="4">
                    </td>
                    <td rowspan="9" style="background-color:gray"> </td>
                </tr>
                <tr>
                    <td colspan="2">Pasien Neonatus usia 0 - 28 (NIPS)</td>
                    <td>
                        <input class="form-control" type="text" name="t_041" id="t_041">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_042" id="t_042_1" value="1">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_042" id="t_042_2" value="2">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_042" id="t_042_3" value="3">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_042" id="t_042_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Pasien Anak Usia 29 hari - 3 tahun (FLACC)</td>
                    <td>
                        <input class="form-control" type="text" name="t_043" id="t_043">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_044" id="t_044_1" value="1">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_044" id="t_044_2" value="2">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_044" id="t_044_3" value="3">
                    </td>
                    <td style="text-align: center; vertical-align:middle">
                        <input type="radio" class="form-check-input" name="t_044" id="t_044_4" value="4">
                    </td>
                </tr>
                <div class="container">
                    <tr>
                        <td colspan="2">Pasien Anak Usia 3 - 9tahun (WONG BAKER)</td>
                        <td>
                            <input class="form-control" type="text" name="t_045" id="t_045">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_046" id="t_046_1" value="1">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_046" id="t_046_2" value="2">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_046" id="t_046_3" value="3">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_046" id="t_046_4" value="4">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Pasien dewasa sadar dan anak > 9 tahun <br> (Numeric Scale)</td>
                        <td>
                            <input class="form-control" type="text" name="t_047" id="t_047">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_048" id="t_048_1" value="1">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_048" id="t_048_2" value="2">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_048" id="t_048_3" value="3">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_048" id="t_048_4" value="4">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="container">
                                <p>P : </p>
                            </div>
                        </td>
                        <td>
                            <input class="form-control" type="text" name="t_049" id="t_049">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_050" id="t_050_1" value="1">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_050" id="t_050_2" value="2">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_050" id="t_050_3" value="3">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_050" id="t_050_4" value="4">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="container">
                                <p>Q : </p>
                            </div>
                        </td>
                        <td>
                            <input class="form-control" type="text" name="t_051" id="t_051">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_052" id="t_052_1" value="1">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_052" id="t_052_2" value="2">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_052" id="t_052_3" value="3">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_052" id="t_052_4" value="4">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="container">
                                <p>R : </p>
                            </div>
                        </td>
                        <td>
                            <input class="form-control" type="text" name="t_053" id="t_053">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_054" id="t_054_1" value="1">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_054" id="t_054_2" value="2">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_054" id="t_054_3" value="3">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_054" id="t_054_4" value="4">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="container">
                                <p>T : </p>
                            </div>
                        </td>
                        <td>
                            <input class="form-control" type="text" name="t_055" id="t_055">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_056" id="t_056_1" value="1">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_056" id="t_056_2" value="2">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_056" id="t_056_3" value="3">
                        </td>
                        <td style="text-align: center; vertical-align:middle">
                            <input type="radio" class="form-check-input" name="t_056" id="t_056_4" value="4">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" colspan="3">
                            <h5>DAFTAR MASALAH KEPERAWATAN</h5>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_057" id="t_057_nafas" value="1">
                                <label for="t_057_nafas">Gangguan Nafas</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_058" id="t_058_darah" value="1">
                                <label for="t_058_darah">Gangguan sirkulasi/peredaran darah</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_059" id="t_059_nyeri" value="1">
                                <label for="t_059_nyeri">Nyeri</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_060" id="t_060_hipertensi" value="1">
                                <label for="t_060_hipertensi">Hipertermi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_061" id="t_061_cairan" value="1">
                                <label for="t_061_cairan">Vangguan volume cairan</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_062" id="t_062_nutrisi" value="1">
                                <label for="t_062_nutrisi">Nutrisi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_063" id="t_063_jatuh" value="1">
                                <label for="t_063_jatuh">Resiko jatuh</label>
                            </div>
                        </td>
                        <td width="50%" colspan="5">
                            <br>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_064" id="t_064_psikologi" value="1">
                                <label for="t_064_psikologi">Psikologi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_065" id="t_065_sosial" value="1">
                                <label for="t_065_sosial">Sosial</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_066" id="t_066_alergi" value="1">
                                <label for="t_066_alergi">Alergi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_067" id="t_067_kulit" value="1">
                                <label for="t_067_kulit">Kerusakan integrasi kulit</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_068" id="t_068_tulang" value="1">
                                <label for="t_068_tulang">Kerusakan kontinuitas tulang</label>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="t_069" id="t_069_lainnya" value="1">
                                        <label for="t_069_lainnya">Lainnya</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="v_12" id="v_12">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-center">
                            <strong>
                                <p>RENCANA TINDAKAN</p>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_070" id="t_070_onservasi" value="1">
                                <label for="t_070_onservasi">Observasi tanda vital : tekanan darah, nadi, suhu, pernapasan</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_071" id="t_071_frekuensi" value="1">
                                <label for="t_071_frekuensi">Pantau frekuensi, irama, kedalaman pernapasan</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_072" id="t_072_neurologic" value="1">
                                <label for="t_072_neurologic">Kaji status neurologic (tingkat kesadaran, GCS)</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_073" id="t_073_cyanosis" value="1">
                                <label for="t_073_cyanosis">Observasi adanya cyanosis</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_074" cyanosis id="t_074_cairan" value="1">
                                <label for="t_074_cairan">Kaji tanda-tanda kekurangan cairan, seperti: kulit kering, tidak elastis, mata cekung, bibir kering</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_075" id="t_075_cairan" value="1">
                                <label for="t_075_cairan">Kaji tanda-tanda kelebihan volume cairan, seperti: takipnea, sesak, edema, ronkhi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_076" id="t_076_intake" value="1">
                                <label for="t_076_intake">Pantau intake dan output pasien</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_077" id="t_077_batuk" value="1">
                                <label for="t_077_batuk">Ajarkan dan anjurkan pasien batuk efektif</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_078" id="t_078_jantung" value="1">
                                <label for="t_078_jantung">Pantau tanda dan gejala penurunan curah jantung, seperti: perubahan nadi, perubahan tekanan darah, cyanosis</label>
                            </div>
                        </td>
                        <td colspan="5">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_079" id="t_079_kompres" value="1">
                                <label for="t_079_kompres">Berikan kompres hangat</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_080" id="t_080_tidur" value="1">
                                <label for="t_080_tidur">Pasang pengaman tempat tidur (pagar tempat tidur)</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_081" id="t_081_edukasi" value="1">
                                <label for="t_081_edukasi">Berikan edukasi pada pasien dan atau keluarga tentang faktor risiko dan penatalaksanaannya</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_082" id="t_082_hipoglikemia" value="1">
                                <label for="t_082_hipoglikemia">Kaji adanya tanda dan gejala hipoglikemia/ hiperglikemia</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_083" id="t_083_infus" value="1">
                                <label for="t_083_infus">Kolaborasi dalam pemberian cairan infus</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_084" id="t_084_oksigen" value="1">
                                <label for="t_084_oksigen">Kolaborasi dalam pemberian oksigen</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_085" id="t_085_antipiretik" value="1">
                                <label for="t_085_antipiretik">Kolaborasi dalam pemberian obat Antipiretik, Analgetik, Antasida</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_086" id="t_086_laboratorium" value="1">
                                <label for="t_086_laboratorium">Kolaborasi dalam pemeriksaan laboratorium, radiologi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_087" id="t_087_elevasi" value="1">
                                <label for="t_087_elevasi">Berikan posisi elevasi kepala 30°</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="t_08" id="t_08_jatuh" value="1">
                                <label for="t_08_jatuh">Kaji risiko jatuh</label>
                            </div>
                        </td>
                    </tr>
                </div>
            </table>

            <h5>IMPLEMENTASI</h5>
            <strong>
                <p>a. Kolaborasi</p>
            </strong>
            <table class="table table-bordered mt-2 b-0 text-center" style="border: 2px solid black;">
                <thead>
                    <tr>
                        <th width="7%">No</th>
                        <th width="25%">Tgl/Jam</th>
                        <th width="45%">Tindakan</th>
                        <th>TTD</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr>
                        <td>1</td>
                        <td><input class=" form-control" type="datetime-local" name="weight" id="weight"></td>
                        <td><textarea class="form-control" name="v_13" id="v_13" cols="6" rows="2" placeholder="Tindakan"></textarea></td>
                        <td>
                            <canvas id="canvas1" width="150" height="75" style="border:1px solid #000;"></canvas>
                            <input type="hidden" id="ttd_1" name="ttd_1">
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <td colspan="10" align="center">
                        <button type="button" class="btn btn-primary" onclick="addRow('tbody')">Tambah Baris</button>
                    </td>
                </tfoot>
            </table>

            <strong>
                <p>b. Mandiri</p>
            </strong>
            <table class="table table-bordered mt-2 b-0 text-center" style="border: 2px solid black;">
                <thead>
                    <tr>
                        <th width="7%">No</th>
                        <th width="25%">Tgl/Jam</th>
                        <th width="45%">Tindakan</th>
                        <th>TTD</th>
                    </tr>
                </thead>
                <tbody id="tbody1">
                    <tr>
                        <td>1</td>
                        <td><input class="form-control" type="datetime-local" name="weight" id="weight"></td>
                        <td><textarea class="form-control" name="v_25" id="v_25" cols="6" rows="2" placeholder="Tindakan"></textarea></td>
                        <td>
                            <canvas id="canvas11" width="150" height="75" style="border:1px solid #000;"></canvas>
                            <input type="hidden" id="ttd_11" name="ttd_11">
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <td colspan="10" align="center">
                        <button type="button" class="btn btn-primary" onclick="addRow1('tbody1')">Tambah Baris</button>
                    </td>
                </tfoot>
            </table>
            <br>

            <div class="container text-center" style="width:25%">
                <p>Perawat IGD</p>
                <br>
                <canvas id="canvas" width="150" height="75" style="border:1px solid #000;"></canvas>
                <input type="hidden" id="ttd" name="ttd">
                <br>
                <input type="text" class="form-control" id="v_10" name="v_10">
                <p>Nama dan Tanda Tangan</p>
            </div>
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

<script>
    var canvas1 = document.getElementById('canvas1');
    const canvasDataInput1 = document.getElementById('ttd_1');
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
    var canvas11 = document.getElementById('canvas11');
    const canvasDataInput11 = document.getElementById('ttd_11');
    var context11 = canvas11.getContext('2d');
    var drawing = false;

    canvas11.addEventListener('mousedown', startDrawing);
    canvas11.addEventListener('mousemove', draw);
    canvas11.addEventListener('mouseup', stopDrawing);
    canvas11.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context11.lineWidth = 2;
        context11.lineCap = 'round';
        context11.strokeStyle = '#000';

        context11.lineTo(e.clientX - canvas11.getBoundingClientRect().left, e.clientY - canvas11.getBoundingClientRect().top);
        context11.stroke();
        context11.beginPath();
        context11.moveTo(e.clientX - canvas11.getBoundingClientRect().left, e.clientY - canvas11.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context11.beginPath();
    }

    function saveSignatureData11() {
        const canvasData11 = canvas11.toDataURL('image/png');

        canvasDataInput11.value = canvasData11;
    }
</script>

</html>
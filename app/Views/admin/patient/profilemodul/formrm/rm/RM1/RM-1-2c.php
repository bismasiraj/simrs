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
    <title>Ringkasan Pulang</title>
</head>

<body>
    <div class="container my-5" style="font-family:'Times New Roman'">
        <form action="" autocomplete="off">
            <h4 style="text-align:right; ">RM 1.2c</h4>
            <table class="table table-bordered border-black">
                <tr style="vertical-align:middle; margin:0px">
                    <td style="text-align:center; width:20%">
                        <img src="\img\logo_PKU.png" alt="" style="width:90px"><br>
                        <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                    </td>
                    <td>
                        <h4><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h4>
                        <h5>Semanggi RT 002 / RW 020 Pasar Kliwon<br>
                            Telp 0271-533894 Fax. : 0271-630229 <br>
                            Jawa Tengah 57117
                        </h5>
                    </td>
                    <td style="width:40%">
                        <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                            <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center">
                        <h3><b>PERENCANAAN PEMULANGAN PASIEN</b></h3>
                    </td>
                </tr>
                <tr style="font-size:22px;">
                    <td colspan="2">
                        <b>EDUKASI KESEHATAN</b>
                    </td>
                    <td style="text-align: center">
                        <b>TINDAK LANJUT</b>
                    </td>
                </tr>
                <tr style="font-size:22px">
                    <td colspan="2">
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_01" name="T_01" value="1" onclick="fungsi1()">
                                    <label class="form-check-label" for="T_01">Jadwal Kontrol</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_02" name="T_02" value="1" onclick="fungsi2()">
                                    <label class="form-check-label" for="T_02">Pemeriksaan laboratorium lanjutan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_03" name="T_03" value="1" onclick="fungsi3()">
                                    <label class="form-check-label" for="T_03">Pengobatan / obat-obatan yang sudah diresepkan untuk dilanjutkan di rumah</label>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_01" name="V_01" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_02" name="V_02" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_03" name="V_03" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="font-size:22px">
                    <td colspan="2">
                        <div class="row mb-1">
                            <b>PERAWATAN DI RUMAH</b>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_04" name="T_04" value="1" onclick="fungsi4()">
                                    <label class="form-check-label" for="T_04">Perawatan diri / Personal higiene</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_05" name="T_05" value="1" onclick="fungsi5()">
                                    <label class="form-check-label" for="T_05">Pemantauan pemberian obat</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_06" name="T_06" value="1" onclick="fungsi6()">
                                    <label class="form-check-label" for="T_06">Pemantauan Diit</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_07" name="T_07" value="1" onclick="fungsi7()">
                                    <label class="form-check-label" for="T_07">Latihan fisik lanjutan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_08" name="T_08" value="1" onclick="fungsi8()">
                                    <label class="form-check-label" for="T_08">Pendampingan tenaga khusus di rumah (home care)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_09" name="T_09" value="1" onclick="fungsi9()">
                                    <label class="form-check-label" for="T_09">Bantuan untuk melakukan aktifitas fisik (kursi roda, alat bantu jalan)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_010" name="T_010" value="1" onclick="fungsi10()">
                                    <label class="form-check-label" for="T_010">NGT</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_011" name="T_011" value="1" onclick="fungsi11()">
                                    <label class="form-check-label" for="T_011">DC</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_012" name="T_012" value="1" onclick="fungsi12()">
                                    <label class="form-check-label" for="T_012">Perawatan Luka</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_013" name="T_013" value="1" onclick="fungsi13()">
                                    <label class="form-check-label" for="T_013">Lain - lain :</label>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <br>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_04" name="V_04" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_05" name="V_05" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_06" name="V_06" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_07" name="V_07" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_08" name="V_08" disabled>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col">
                                <input class="form-control" type="text" id="V_09" name="V_09" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_10" name="V_10" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_11" name="V_11" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_12" name="V_12" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_13" name="V_13" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="font-size:22px">
                    <td colspan="2">
                        <div class="row mb-1">
                            <b>RINCIAN PEMULANGAN</b>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_014" name="T_014" value="1" onclick="fungsi14()">
                                    <label class="form-check-label" for="T_014">Tanggal pemulangan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_015" name="T_015" value="1" onclick="fungsi15()">
                                    <label class="form-check-label" for="T_015">Pendamping</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_016" name="T_016" value="1" onclick="fungsi16()">
                                    <label class="form-check-label" for="T_016">Transportasi yang digunakan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_017" name="T_017" value="1" onclick="fungsi17()">
                                    <label class="form-check-label" for="T_017">Keadaan umum saat pemulangan</label>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <br>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_14" name="V_14" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_15" name="V_15" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_16" name="V_16" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_17" name="V_17" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="font-size:22px">
                    <td colspan="2">
                        <div class="row mb-1">
                            <b>DIIT</b>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_018" name="T_018" value="1" onclick="fungsi18()">
                                    <label class="form-check-label" for="T_018">Anjuran pola makan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_019" name="T_019" value="1" onclick="fungsi19()">
                                    <label class="form-check-label" for="T_019">Batasan makanan</label>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <br>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_18" name="V_18" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_19" name="V_19" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="font-size:22px">
                    <td colspan="2">
                        <div class="row mb-1">
                            <b>Bantuan perawatan yang dibutuhkan setelah pulang</b>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_020" name="T_020" value="1" onclick="fungsi20()">
                                    <label class="form-check-label" for="T_020">Panti / rumah singgah</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_021" name="T_021" value="1" onclick="fungsi21()">
                                    <label class="form-check-label" for="T_021">Dokter keluarga / dokter praktek</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_022" name="T_022" value="1" onclick="fungsi22()">
                                    <label class="form-check-label" for="T_022">Rumah sakit</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_023" name="T_023" value="1" onclick="fungsi23()">
                                    <label class="form-check-label" for="T_023">Puskesmas</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_024" name="T_024" value="1" onclick="fungsi24()">
                                    <label class="form-check-label" for="T_024">Rehabilitasi rawat jalan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_025" name="T_025" value="1" onclick="fungsi25()">
                                    <label class="form-check-label" for="T_025">Home Care RS PKU Sampangan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="T_026" name="T_026" value="1" onclick="fungsi26()">
                                    <label class="form-check-label" for="T_026">Lainya (Sebutkan) </label>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row" style="text-align: center"><b>Tempat Perujukan</b></div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_20" name="V_20" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_21" name="V_21" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_22" name="V_22" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_23" name="V_23" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_24" name="V_24" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_25" name="V_25" disabled>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <input class="form-control" type="text" id="V_26" name="V_26" disabled>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="font-size:22px">
                    <td colspan="3">
                        <table align=right style="text-align: center;">
                            <tr>
                                <td>
                                    PPJA<br>
                                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                                    <canvas id="canvas" width="200" height="100" style="border:1px solid #000;"></canvas>
                                    <input type="hidden" name="TTD" id="TTD"><br>
                                    ( <input type="text" id="V_27" name="V_27" style="width:250px; text-align: center;"> )<br>
                                    Ttd & Nama Terang
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br><br>
            Beri tanda (√) pada kotak () sesuai pilihan<br>
            Beri tanda (-) untuk isian yang tidak ada keluhan
        </form>
    </div>
    <script type="text/javascript">
        function fungsi1() {
            if ($("#T_01").is(":checked")) {
                $("#V_01").removeAttr("disabled");
                $("#V_01").focus();
            } else {
                $("#V_01").attr("disabled", true);
                $("#V_01").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi2() {
            if ($("#T_02").is(":checked")) {
                $("#V_02").removeAttr("disabled");
                $("#V_02").focus();
            } else {
                $("#V_02").attr("disabled", true);
                $("#V_02").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi3() {
            if ($("#T_03").is(":checked")) {
                $("#V_03").removeAttr("disabled");
                $("#V_03").focus();
            } else {
                $("#V_03").attr("disabled", true);
                $("#V_03").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi4() {
            if ($("#T_04").is(":checked")) {
                $("#V_04").removeAttr("disabled");
                $("#V_04").focus();
            } else {
                $("#V_04").attr("disabled", true);
                $("#V_04").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi5() {
            if ($("#T_05").is(":checked")) {
                $("#V_05").removeAttr("disabled");
                $("#V_05").focus();
            } else {
                $("#V_05").attr("disabled", true);
                $("#V_05").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi6() {
            if ($("#T_06").is(":checked")) {
                $("#V_06").removeAttr("disabled");
                $("#V_06").focus();
            } else {
                $("#V_06").attr("disabled", true);
                $("#V_06").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi7() {
            if ($("#T_07").is(":checked")) {
                $("#V_07").removeAttr("disabled");
                $("#V_07").focus();
            } else {
                $("#V_07").attr("disabled", true);
                $("#V_07").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi8() {
            if ($("#T_08").is(":checked")) {
                $("#V_08").removeAttr("disabled");
                $("#V_08").focus();
            } else {
                $("#V_08").attr("disabled", true);
                $("#V_08").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi9() {
            if ($("#T_09").is(":checked")) {
                $("#V_09").removeAttr("disabled");
                $("#V_09").focus();
            } else {
                $("#V_09").attr("disabled", true);
                $("#V_09").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi10() {
            if ($("#T_010").is(":checked")) {
                $("#V_10").removeAttr("disabled");
                $("#V_10").focus();
            } else {
                $("#V_10").attr("disabled", true);
                $("#V_10").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi11() {
            if ($("#T_011").is(":checked")) {
                $("#V_11").removeAttr("disabled");
                $("#V_11").focus();
            } else {
                $("#V_11").attr("disabled", true);
                $("#V_11").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi12() {
            if ($("#T_012").is(":checked")) {
                $("#V_12").removeAttr("disabled");
                $("#V_12").focus();
            } else {
                $("#V_12").attr("disabled", true);
                $("#V_12").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi13() {
            if ($("#T_013").is(":checked")) {
                $("#V_13").removeAttr("disabled");
                $("#V_13").focus();
            } else {
                $("#V_13").attr("disabled", true);
                $("#V_13").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi14() {
            if ($("#T_014").is(":checked")) {
                $("#V_14").removeAttr("disabled");
                $("#V_14").focus();
            } else {
                $("#V_14").attr("disabled", true);
                $("#V_14").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi15() {
            if ($("#T_015").is(":checked")) {
                $("#V_15").removeAttr("disabled");
                $("#V_15").focus();
            } else {
                $("#V_15").attr("disabled", true);
                $("#V_15").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi16() {
            if ($("#T_016").is(":checked")) {
                $("#V_16").removeAttr("disabled");
                $("#V_16").focus();
            } else {
                $("#V_16").attr("disabled", true);
                $("#V_16").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi17() {
            if ($("#T_017").is(":checked")) {
                $("#V_17").removeAttr("disabled");
                $("#V_17").focus();
            } else {
                $("#V_17").attr("disabled", true);
                $("#V_17").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi18() {
            if ($("#T_018").is(":checked")) {
                $("#V_18").removeAttr("disabled");
                $("#V_18").focus();
            } else {
                $("#V_18").attr("disabled", true);
                $("#V_18").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi19() {
            if ($("#T_019").is(":checked")) {
                $("#V_19").removeAttr("disabled");
                $("#V_19").focus();
            } else {
                $("#V_19").attr("disabled", true);
                $("#V_19").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi20() {
            if ($("#T_020").is(":checked")) {
                $("#V_20").removeAttr("disabled");
                $("#V_20").focus();
            } else {
                $("#V_20").attr("disabled", true);
                $("#V_20").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi21() {
            if ($("#T_021").is(":checked")) {
                $("#V_21").removeAttr("disabled");
                $("#V_21").focus();
            } else {
                $("#V_21").attr("disabled", true);
                $("#V_21").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi22() {
            if ($("#T_022").is(":checked")) {
                $("#V_22").removeAttr("disabled");
                $("#V_22").focus();
            } else {
                $("#V_22").attr("disabled", true);
                $("#V_22").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi23() {
            if ($("#T_023").is(":checked")) {
                $("#V_23").removeAttr("disabled");
                $("#V_23").focus();
            } else {
                $("#V_23").attr("disabled", true);
                $("#V_23").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi24() {
            if ($("#T_024").is(":checked")) {
                $("#V_24").removeAttr("disabled");
                $("#V_24").focus();
            } else {
                $("#V_24").attr("disabled", true);
                $("#V_24").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi25() {
            if ($("#T_025").is(":checked")) {
                $("#V_25").removeAttr("disabled");
                $("#V_25").focus();
            } else {
                $("#V_25").attr("disabled", true);
                $("#V_25").val("");
            }
        }
    </script>
    <script type="text/javascript">
        function fungsi26() {
            if ($("#T_026").is(":checked")) {
                $("#V_26").removeAttr("disabled");
                $("#V_26").focus();
            } else {
                $("#V_26").attr("disabled", true);
                $("#V_26").val("");
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
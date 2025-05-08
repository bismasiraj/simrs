<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>TRIASE ANAK</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script type="text/javascript">
        $(function f10() {
            $("input[name='t_01']").click(function() {
                if ($("#t_01_sendiri").is(":checked")) {
                    $("#t_03_nontrauma").removeAttr("disabled");
                    $("#t_03_trauma").removeAttr("disabled");
                    $("#t_03_nontrauma").focus();
                } else {
                    $("#t_03_nontrauma").attr("disabled", true);
                    $("#t_03_nontrauma").prop("checked", false);
                    $("#t_03_trauma").attr("disabled", true);
                    $("#t_03_trauma").prop("checked", false);
                    $("#t_03_nontrauma").attr("disabled", true);
                    $("#t_03_nontrauma").val("");
                    $("#t_03_trauma").attr("disabled", true);
                    $("#t_03_trauma").val("");
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function f10() {
            $("input[name='t_01']").click(function() {
                if ($("#t_01_ambulan").is(":checked")) {
                    $("#t_04_air").removeAttr("disabled");
                    $("#t_04_pejalankaki").removeAttr("disabled");
                    $("#t_04_air").focus();
                } else {
                    $("#t_04_air").attr("disabled", true);
                    $("#t_04_air").prop("checked", false);
                    $("#t_04_pejalankaki").attr("disabled", true);
                    $("#t_04_pejalankaki").prop("checked", false);
                    $("#t_04_air").attr("disabled", true);
                    $("#t_04_air").val("");
                    $("#t_04_pejalankaki").attr("disabled", true);
                    $("#t_04_pejalankaki").val("");
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function f10() {
            $("input[name='t_01']").click(function() {
                if ($("#t_01_polisi").is(":checked")) {
                    $("#t_05_lalulintas").removeAttr("disabled");
                    $("#t_05_rumahtangga").removeAttr("disabled");
                    $("#t_05_lalulintas").focus();
                } else {
                    $("#t_05_lalulintas").attr("disabled", true);
                    $("#t_05_lalulintas").prop("checked", false);
                    $("#t_05_rumahtangga").attr("disabled", true);
                    $("#t_05_rumahtangga").prop("checked", false);
                    $("#t_05_lalulintas").attr("disabled", true);
                    $("#t_05_lalulintas").val("");
                    $("#t_05_rumahtangga").attr("disabled", true);
                    $("#t_05_rumahtangga").val("");
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function f10() {
            $("input[name='t_051']").click(function() {
                if ($("#t_051_makanan").is(":checked")) {
                    $("#v_07").removeAttr("disabled");
                    $("#v_07").focus();
                } else {
                    $("#v_07").attr("disabled", true);
                    $("#v_07").val("");
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function f10() {
            $("input[name='t_052']").click(function() {
                if ($("#t_052_obat").is(":checked")) {
                    $("#v_08").removeAttr("disabled");
                    $("#v_08").focus();
                } else {
                    $("#v_08").attr("disabled", true);
                    $("#v_08").val("");
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function f10() {
            $("input[name='t_053']").click(function() {
                if ($("#t_053_lain").is(":checked")) {
                    $("#v_09").removeAttr("disabled");
                    $("#v_09").focus();
                } else {
                    $("#v_09").attr("disabled", true);
                    $("#v_09").val("");
                }
            });
        });
    </script>

</head>

<body>

    <div class="container-fluid fixed mt-5">
        <form action="<?= site_url('#') ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <table class="table table-bordered mb-0">
                <h5 style="text-align: right;">RM 1.2a</h5>
                <tr>
                    <td width="12%" align="center">
                        <img class="mt-3" src="<?= base_url('assets/img/logo.png') ?>" width="80px">
                        <p class="mt-3">Sehat-Amanah <br> Tanggung Jawab-Islami</p>
                    </td>
                    <td width="25%" style="padding-top: 40px;">
                        <h6>RS. PKU MUHAMMADIYAH SAMPANGAN </h6>
                        <strong>
                            <p style="font-size: 12px;">Semanggi RT 02/20 Pasar Kliwon Surakarta <br> Telpon (0271) 633894 Jawa Tengah 57117</p>
                        </strong>
                    </td>
                    <td width="25%" style="padding-top: 40px; vertical-align: middle">
                        <h1>TRIASE ANAK </h1>
                    </td>
                    <td width="25%" class="text-center">
                        <div class="container mt-2" style="border:1px solid black; padding:5px; height:160px; vertical-align: middle">
                            <h5>LABEL IDENTITAS PASIEN</h5>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mt-0 mb-6" style="border: 2px solid black; border-top: 0;">
                <tr>
                    <th>Cara Datang</th>
                    <td>
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_sendiri" value="1">
                        <label for="t_01_sendiri">Sendiri</label>
                    </td>
                    <td>
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_ambulan" value="2">
                        <label for="t_01_ambulan">Ambulan</label>
                    </td>
                    <td>
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_polisi" value="3">
                        <label for="t_01_polisi">Diantar Polisi</label>
                    </td>
                    <td rowspan="2" colspan="2">
                        <div class="row">
                            <div class="col-4">
                                <label>Tanggal Datang</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" type="date" name="v_01" id="v_01">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-4">
                                <label>Jam</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" type="time" name="v_02" id="v_02">
                            </div>
                        </div>
                    </td>
                    <td rowspan="2">
                        <div class="row align-items-center mt-5">
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="t_02_doa" name="t_02" value="1">
                                    <label for="t_02_sedih">DOA</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Jenis Kasus</th>
                    <td>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_03" id="t_03_nontrauma" value="1" disabled>
                            <label for="t_03_nontrauma">Non Trauma</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_03" id="t_03_trauma" value="2" disabled>
                            <label for="t_03_trauma">Trauma</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_04" id="t_04_air" value="1" disabled>
                            <label for="t_04_air">Kecelakaan Air</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_04" id="t_04_pejalankaki" value="2" disabled>
                            <label for="t_04_pejalankaki">Kecelakaan Pejalan Kaki</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_05" id="t_05_lalulintas" value="1" disabled>
                            <label for="t_05_lalulintas">Kecelakaan Lalu Lintas</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="t_05" id="t_05_rumahtangga" value="2" disabled>
                            <label for="t_05_rumahtangga">Kecelakaan Rumah Tangga</label>
                        </div>
                    </td>
                </tr>
                <tr class="text-center">
                    <th width="10%">PEMERIKSAAN</th>
                    <th width="15%" class="bg-danger">KATEGORI I</th>
                    <th width="15%" class="bg-warning">KATEGORI II</th>
                    <th width="15%" class="bg-warning">KATEGORI III</th>
                    <th width="15%" class="bg-success">KATEGORI IV</th>
                    <th width="15%" class="bg-success">KATEGORI V</th>
                    <th>TANDA VITAL</th>
                </tr>
                <tr>
                    <th rowspan="4">SIRKULASI <i>(Circulation)</i></th>
                    <td rowspan="4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_06_sirkulasi" name="t_06" value="1">
                            <label for="sirkulasi">Sirkulasi (-)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_07_bradikardi" name="t_07" value="1">
                            <label for="bradikardi">Signifikan Bradikardi <br> (cth : < 60 pada bayi)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hemodinamik" name="t_08" value="1">
                            <label for="hemodinamik">Gangguan hemodinamik berat <br> (akral dingi, kulit pucat, kebiruan, perfusi buruk)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_09_bintik" name="t_09" value="1">
                            <label for="t_09_bintik">Bintik-bintik merah ada ekstermitas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_010_takikardi" name="t_010" value="1">
                            <label for="t_010_takikardi">Takikardi berat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_011_nadi" name="t_011" value="1">
                            <label for="t_011_nadi">Nadi Perifer (-)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_012_pendarahan" name="t_012" value="1">
                            <label for="t_012_pendarahan">Pendarahan hebat tidak terkontrol</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_013_kapiler" name="t_013" value="1">
                            <label for="t_013_kapiler">Pengisian kapiler > 4 detik</label>
                        </div>
                    </td>
                    <td rowspan="4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_014_sirkulasi" name="t_014" value="1">
                            <label for="t_014_sirkulasi">Sirkulasi (-)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_015_hemodinamik" name="t_015" value="1">
                            <label for="t_015_hemodinamik">Gangguan hemodinamik sedang <br> (akral dingi, kulit pucat)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_016_nadi" name="t_016" value="1">
                            <label for="t_016_nadi">Nadi brachii lemah</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_017_takikardi" name="t_017" value="1">
                            <label for="t_017_takikardi">Takikardi sedang</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_018_kapiler" name="t_018" value="1">
                            <label for="t_018_kapiler">Pengisian kapiler 2-4 detik</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_019_dehidrasi" name="t_019" value="1">
                            <label for="t_019_dehidrasi">Tanda dehidrasi berat <br> (> 6 tanda dehidrasi)</label>
                        </div>
                    </td>
                    <td rowspan="4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_020_sirkulasi" name="t_020" value="1">
                            <label for="t_020_sirkulasi">Sirkulasi (+)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_021_hemodinamik" name="t_021" value="1">
                            <label for="t_021_hemodinamik">Gangguan hemodinamik <br> (denyut nadi perifer teraba, kulit pucat, akral hangat)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_022_takikardi" name="t_022" value="1">
                            <label for="t_022_takikardi">Takikardi ringan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_023_dehidrasi" name="t_023" value="1">
                            <label for="t_023_dehidrasi">Tanda dehidrasi sedang <br> (4-6 tanda dehidrasi)</label>
                        </div>
                    </td>
                    <td rowspan="4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_024_sirkulasi" name="t_024" value="1">
                            <label for="t_024_sirkulasi">Sirkulasi (+)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_025_hemodinamik" name="t_025" value="1">
                            <label for="t_025_hemodinamik">Tanpa gangguan hemodinamik</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_026_nadi" name="t_026" value="1">
                            <label for="t_026_nadi">Nadi perifer teraba</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_027_kulit" name="t_027" value="1">
                            <label for="t_027_kulit">Kulit kemerahan, akral hangat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_028_dehidrasi" name="t_028" value="1">
                            <label for="t_028_dehidrasi">Tanda dehidrasi (< 3 dehidrasi)</label>
                        </div>
                    </td>
                    <td rowspan="4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_029_sirkulasi" name="t_029" value="1">
                            <label for="t_029_sirkulasi">Sirkulasi (+)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_030_hemodinamik" name="t_030" value="1">
                            <label for="t_030_hemodinamik">Gangguan hemodinamik (-)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_031_nadi" name="t_031" value="1">
                            <label for="t_031_nadi">Denyut nadi perifer teraba</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_032_kulit" name="t_032" value="1">
                            <label for="t_032_kulit">Kulit kemerahan, akral hangat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_033_dehidrasi" name="t_033" value="1">
                            <label for="t_033_dehidrasi">Tanda dehidrasi (-)</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Suhu</span>
                                <input type="text" class="form-control" name="temperature" id="temperature">
                                <span class="input-group-text">C</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text">SpO2</span>
                                <input type="text" class="form-control" name="saturasi" id="saturasi">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>
                            <p class="text-center">Frekuensi</p>
                        </strong>
                        <br>
                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nadi</span>
                                <input type="text" class="form-control" name="nadi" id="nadi">
                                <span class="input-group-text">x/mnt</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text">RR</span>
                                <input type="text" class="form-control" name="nafas" id="nafas">
                                <span class="input-group-text">x/mnt</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <label><br><br>TD</label>
                            </div>
                            <div class="col-5">
                                TU<input class="form-control" type="text" name="tension_upper" id="tension_upper">
                                TB<input class="form-control" type="text" name="tension_below" id="tension_below">
                            </div>
                            <div class="col-1">
                                <label><br><br>mmHg</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text">GDS</span>
                                <input type="text" class="form-control" name="t_091" id="t_091">
                                <span class="input-group-text">mg/dL</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>JALAN NAFAS <i>(Air Way)</i></th>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_034_total" name="t_034" value="1">
                            <label for="t_034_total">Sumbatan total</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_035_sebagian" name="t_035" value="1">
                            <label for="t_035_sebagian">Sumbatan sebagian disertai distress pernafasan</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_036_bebas" name="t_036" value="1">
                            <label for="t_036_bebas">Bebas</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_037_bebas" name="t_037" value="1">
                            <label for="t_037_bebas">Bebas</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_038_bebas" name="t_038" value="1">
                            <label for="t_038_bebas">Bebas</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_039_bebas" name="t_039" value="1">
                            <label for="t_039_bebas">Bebas</label>
                        </div>
                    </td>
                    <td>
                        <strong>
                            <p class="text-center">Keadaan Umum</p>
                        </strong>
                        <textarea class="form-control" name="v_06" id="v_06" cols="6" rows="3"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>PERNAFASAN <i>(Breathing)</i></th>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_040_nafas" name="t_040" value="1">
                            <label for="t_040_nafas">Nafas spontan (-)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_041_hipoventilasi" name="t_041" value="1">
                            <label for="t_041_hipoventilasi">Hipoventilasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_042_distres" name="t_042" value="1">
                            <label for="t_042_distres">Distres pernafasan berat (rektrasi otot diafragma berat, sinosis akut)</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_043_nafas" name="t_043" value="1">
                            <label for="t_043_nafas">Nafas Spontan (+)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_044_distres" name="t_044" value="1">
                            <label for="t_044_distres">Distres pernafasn sedang (rektrasi otot diafragma sedang, kulit pusat)</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_045_nafas" name="t_045" value="1">
                            <label for="t_045_nafas">Nafas Spontan (+)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_046_distres" name="t_046" value="1">
                            <label for="t_046_distres">Distres pernafasan sedang (reaksi otot diafragma sedikit, kulit pucat)</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_047_nafas" name="t_047" value="1">
                            <label for="t_047_nafas">Nafas Spontan (+)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_048_nodistres" name="t_048" value="1">
                            <label for="t_048_nodistres">Tidak ada distress pernafasan (otot ernafasan normal)</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_049_nafas" name="t_049" value="1">
                            <label for="t_049_nafas">Nafas Spontan (+)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_050_nodistres" name="t_050" value="1">
                            <label for="t_050_nodistres">Tidak ada distress pernafasan (otot pernafasan normal)</label>
                        </div>
                    </td>
                    <td rowspan="3">
                        <h6 class="text-center">RIWAYAT ALERGI</h6>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_051_makanan" name="t_051" value="1">
                            <label for="t_051_makanan">Makanan</label>
                        </div>
                        <textarea class="form-control" name="v_07" id="v_07" cols="6" rows="3" disabled></textarea>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_052_obat" name="t_052" value="1">
                            <label for="t_052_obat">Obat</label>
                        </div>
                        <textarea class="form-control" name="v_08" id="v_08" cols="6" rows="3" disabled></textarea>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_053_lain" name="t_053" value="1">
                            <label for="t_053_lain">Lain-lain</label>
                        </div>
                        <textarea class="form-control" name="v_09" id="v_09" cols="6" rows="3" disabled></textarea>
                        <br>
                    </td>
                </tr>
                <tr>
                    <th>KESADARAN <i>(Disability)</i></th>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_054_gcs9" name="t_054" value="1">
                            <label for="t_054_gcs9">GCS < 9</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_055_gcs10" name="t_055" value="1">
                            <label for="t_055_gcs10">GCS 10 - 12</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_056_gcs13" name="t_056" value="1">
                            <label for="t_056_gcs13">GCS > 13</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_057_gcs15" name="t_057" value="1">
                            <label for="t_057_gcs15">GCS 15</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_058_gcs15" name="t_058" value="1">
                            <label for="t_058_gcs15">GCS 15</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>TANDA LAIN</th>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_059_kejang" name="t_059" value="1">
                            <label for="t_059_kejang">Kejang sedang berlangsung</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_060_nyeri" name="t_060" value="1">
                            <label for="t_060_nyeri">Respon nyeri (+)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_061_sedih" name="t_061" value="1">
                            <label for="t_061_sedih">Trauma kepala berat</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_062_gelisah" name="t_062" value="1">
                            <label for="t_062_gelisah">Gelisah</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_063_iriritable" name="t_063" value="1">
                            <label for="t_063_iriritable">Iriritable</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_064_demam" name="t_064" value="1">
                            <label for="t_064_demam">Demam dengan tanda tanda kejang</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_065_sedih" name="t_065" value="1">
                            <label for="t_065_sedih">Sakit kepala</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_066_kaku" name="t_066" value="1">
                            <label for="t_066_kaku">Kaku leher</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_067_bayi" name="t_067" value="1">
                            <label for="t_067_bayi">Bayi usia < 28 hari</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_068_apatis" name="t_068" value="1">
                            <label for="t_068_apatis">Apatis</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_069_somnolent" name="t_069" value="1">
                            <label for="t_069_somnolent">Somnolent</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_070_nyeri" name="t_070" value="1">
                            <label for="t_070_nyeri">Nyeri perut hebat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_071_fraktur" name="t_071" value="1">
                            <label for="t_071_fraktur">Fraktur eksremitas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_072_laserasi" name="t_072" value="1">
                            <label for="t_072_laserasi">Laserasi kullit</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_073_luka" name="t_073" value="1">
                            <label for="t_073_luka">Luka kotor</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_074_cedera" name="t_074" value="1">
                            <label for="t_074_cedera">Cedera tanpa penurunan kesadaran</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_075_nyeri" name="t_075" value="1">
                            <label for="t_075_nyeri">Nyeri abadomen tidak hebat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_076_nyeri" name="t_076" value="1">
                            <label for="t_076_nyeri">Nyeri sedang</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_077_sendi" name="t_077" value="1">
                            <label for="t_077_sendi">Dislokasi sendi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_078_inflamasi" name="t_078" value="1">
                            <label for="t_078_inflamasi">Inflamasi/benda asing ada mata</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_079_infeksi" name="t_079" value="1">
                            <label for="t_079_infeksi">Infeksi paru</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_080_demam" name="t_080" value="1">
                            <label for="t_080_demam">Demam sub febris</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_081_klinis" name="t_081" value="1">
                            <label for="t_081_klinis">Gejala klinis (-)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_082_imunisasi" name="t_082" value="1">
                            <label for="t_082_imunisasi">Rencana imunisasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_083_nyeri" name="t_083" value="1">
                            <label for="t_083_nyeri">Nyeri ringan tanpa resiko</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_084_sakit" name="t_084" value="1">
                            <label for="t_084_sakit">Sakit dengan gejala ringan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_085_lecet" name="t_085" value="1">
                            <label for="t_085_lecet">Lecet/lebam post trauma</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>RESPON TIME</th>
                    <td>Immediate/segera</td>
                    <td>
                        < 10 menit </td>
                    <td>30 menit</td>
                    <td>60 menit</td>
                    <td>120 menit</td>
                    <td class="text-center" rowspan="7">
                        <p>PETUGAS TRIASE</p>
                        <br>
                        <canvas id="canvas" width="150" height="75" style="border:1px solid #000;"></canvas>
                        <input type="hidden" id="ttd" name="ttd">
                        <br>
                        <input type="text" class="form-control" id="v_10" name="v_10">
                        <p>Nama dan Tanda Tangan</p>
                    </td>
                </tr>
                <tr>
                    <th>OBSERVASI</th>
                    <td>R. Resusitasi</td>
                    <td>R. Resusitasi</td>
                    <td>R. observasi biasa/tindakan/medical bedah</td>
                    <td>R. observasi biasa/tindakan/medical bedah</td>
                    <td>R. observasi biasa/tindakan/medical bedah</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_086_resusitasi" name="t_086" value="1">
                            <label for="t_086_resusitasi">ATS 1 : RESUSITASI (SEGERA)</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_087_emergency" name="t_087" value="1">
                            <label for="t_087_emergency">ATS 2 : EMERGENCY (10 MENIT)</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_088_urgency" name="t_088" value="1">
                            <label for="t_088_urgency">ATS 3 : URGENCY (30 MENIT)</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_089_semiurgency" name="t_089" value="1">
                            <label for="t_089_semiurgency">ATS 4 : SEMIURGENCY (60 MENIT)</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_090_nonurgency" name="t_090" value="1">
                            <label for="t_090_nonurgency">ATS 5 : NONURGENCY (120 MENIT)</label>
                        </div>
                    </td>
                </tr>
            </table>
            <p style="text-align: right;">Rev. 1/VIII/2019</p>
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
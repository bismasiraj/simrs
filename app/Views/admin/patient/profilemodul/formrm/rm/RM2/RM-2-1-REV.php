<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ASESMEN MEDIS REV</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

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
                            <div class="col-md-6">
                                <div class=" container mt-1" style="border:1px solid black; padding-top:80px; height:200px;  width: 70%;">
                                    <p class="text-center">Label Identitas Pasien</p>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr style="border: 2px solid black">
                    <td colspan="3">
                        <h5 class="text-center">ASESMEN MEDIS</h5>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mt-0 mb-0" style="border:2px solid black; border-bottom:0; border-top:0">
                <tr>
                    <td width="50%">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <strong><label>Tanggal</label>
                                </strong>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="date" name="v_01" id="v_01">
                            </div>
                        </div>
                    </td>
                    <td width="50%">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <strong><label>Jam datang</label></strong>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="time" name="v_02" id="v_02">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Asal Pasien</label>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_01_sendiri" name="t_01" value="1">
                                    <label for="t_01_sendiri">Datang Sendiri</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_01_rujukan" name="t_01" value="2">
                                            <label for="t_01_rujukan">Rujukan</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_03" id="v_03">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Hamil</label>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_02_tidak" name="t_02" value="0">
                                    <label for="t_02_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_02_ya" name="t_02" value="1">
                                            <label for="t_02_ya">Ya</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Umur</span>
                                            <input type="text" class="form-control" name="t_03" id="t_03">
                                            <span class="input-group-text">minggu</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">G</span>
                                            <input type="text" class="form-control" name="t_04" id="t_04">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">P</span>
                                            <input type="text" class="form-control" name="t_05" id="t_05">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">A</span>
                                            <input type="text" class="form-control" name="t_06" id="t_06">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Riwayat Alergi</label>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_07_tidak" name="t_07" value="0">
                                    <label for="t_07_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_07_ya" name="t_07" value="1">
                                            <label for="t_07_ya">Ya, sebutkan</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="v_04" id="v_04">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_07_lainnya" name="t_07" value="2">
                                            <label for="t_07_lainnya">Lainnya</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_05" id="v_05">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <h6>ANAMNESIS</h6>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_08" id="t_08_autoanamnesis" value="1">
                                                <strong><label for="t_08_autoanamnesis">Autoanamnesis</label></strong>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_08" id="t_08_alloanamnesis" value="2">
                                                <strong><label for="t_08_alloanamnesis">Alloanamnesis</label></strong>
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
                                        <input class="form-control" type="text" name="v_06" id="v_06">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label>Hubungan dengan pasien</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="v_07" id="v_07">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <ul>
                            <li>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Keluhan Utama</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_08" id="v_08">
                                    </div>
                                </div>
                            </li>
                            <br>
                            <li>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Riwayat Penyakit Sekarang</label>
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
                                                <label>Alloanamnesis</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" name="v_09" id="v_09">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label>Hubungan dengan pasien</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_10" id="v_10">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <br>
                            <li>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Riwayat Penyakit Dahulu</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="v_11" id="v_11" cols="6" rows="3"></textarea>
                                    </div>
                                </div>
                            </li>
                            <br>
                            <li>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Obat-obatan yang dikonsumsi</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_12" id="v_12">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Keadaan Umum</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_13" id="v_13">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label for="">GCS </label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text">E</span>
                                            <input type="text" class="form-control" name="t_09" id="t_09">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text">M</span>
                                            <input type="text" class="form-control" name="t_010" id="t_010">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text">V</span>
                                            <input type="text" class="form-control" name="t_011" id="t_011">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <strong><label for="">Tanda Vital</label></strong>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">TD</span>
                                    <input type="text" class="form-control" name="tension_upper" id="tension_upper">
                                    <span class="input-group-text">/</span>
                                    <input type="text" class="form-control" name="tension_below" id="tension_below">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">N</span>
                                    <input type="text" class="form-control" name="nadi" id="nadi">
                                    <span class="input-group-text">x/mnt</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">T</span>
                                    <input type="text" class="form-control" name="temperature" id="temperature">
                                    <span class="input-group-text">C</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">RR</span>
                                    <input type="text" class="form-control" name="nafas" id="nafas">
                                    <span class="input-group-text">x/mnt</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">SpO2</span>
                                    <input type="text" class="form-control" name="saturasi" id="saturasi">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <strong><label for="">Status Gizi</label></strong>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">BB</span>
                                    <input type="text" class="form-control" name="weight" id="weight">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">TB</span>
                                    <input type="text" class="form-control" name="height" id="height">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                        </div>
                        <h6>PEMERIKSAAN FISIK</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>1. Kepala</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_14" id="v_14">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Mata</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_15" id="v_15">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Telinga</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_16" id="v_16">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Hidung</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_17" id="v_17">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Mulut</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_18" id="v_18">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Gigi</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_19" id="v_19">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>2. Leher</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_20" id="v_20">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>3. <i>Thorax</i></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_21" id="v_21">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Paru</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_22" id="v_22">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>4. <i>Abdomen</i></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_23" id="v_23">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Hepar</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_24" id="v_24">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label><i>Lien</i></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_25" id="v_25">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Ginjal</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_26" id="v_26">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>5. Genetalia</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_27" id="v_27">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>6. <i>Ekstremitas</i> Atas</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_28" id="v_28">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label><i>Ekstremitas</i> Bawah</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_29" id="v_29">
                                    </div>
                                </div>
                                <br>
                                <div class="row text-center">
                                    <div class="col-md-6">
                                        <p><i>Akral Hangat</i></p>
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_30" id="v_30">
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_31" id="v_31">
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_32" id="v_32">
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_33" id="v_33">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p><i>Oedema</i></p>
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_34" id="v_34">
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_35" id="v_35">
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_36" id="v_36">
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="v_37" id="v_37">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>PEMERIKSAAN FISIK TAMBAHAN</h6>
                        <p>Status Lokalis</p>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label>1. </label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" name="v_38" id="v_38">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label>2. </label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" name="v_39" id="v_39">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label>3. </label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" name="v_40" id="v_40">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label>4. </label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" name="v_41" id="v_41">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label>5. </label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" name="v_42" id="v_42">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label>6. </label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" name="v_43" id="v_43">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label>7. </label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" name="v_44" id="v_44">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label>8. </label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" name="v_45" id="v_45">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label>9. </label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control" type="text" name="v_46" id="v_46">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: flex; justify-content: center; align-items: center;">
                                <img src="<?= base_url('assets/pkugb1.png') ?>" alt="" style="width:400px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=" 2">
                        <h6>PEMERIKSAAN PENUNJANG</h6>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>Laboratorium</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_47" id="v_47">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>Radiologi</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_48" id="v_48">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>EKG</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_49" id="v_49">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>DIAGNOSA KERJA</h6>
                        <textarea class="form-control" name="v_50" id="v_50" cols="6" rows="2"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>DIAGNOSA BANDING</h6>
                        <textarea class="form-control" name="v_51" id="v_51" cols="6" rows="2"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>MASALAH</h6>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>1. Medis</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_52" id="v_52">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>2. Keperawatan</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_53" id="v_53">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <strong><label>Sasaran :</label></strong>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_54" id="v_54">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <strong><label>Rencana Asuhan dan Terapi (<i>Standing Order</i>)</label></strong>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="v_55" id="v_55" cols="6" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong><label>Tindakan :</label></strong>
                        <textarea class="form-control" name="v_56" id="v_56" cols="6" rows="10"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong><label>Kondisi Saat Keluar IGD</label></strong>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>Keadaan Umum</label>
                            </div>
                            <div class="col-md-5">
                                <input class="form-control" type="text" name="v_57" id="v_57">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <strong><label for="">Tanda Vital</label></strong>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">TD</span>
                                    <input type="text" class="form-control" name="tension_upper" id="tension_upper">
                                    <span class="input-group-text">/</span>
                                    <input type="text" class="form-control" name="tension_below" id="tension_below">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">N</span>
                                    <input type="text" class="form-control" name="nadi" id="nadi">
                                    <span class="input-group-text">x/mnt</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">RR</span>
                                    <input type="text" class="form-control" name="nafas" id="nafas">
                                    <span class="input-group-text">x/mnt</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">S</span>
                                    <input type="text" class="form-control" name="temperature" id="temperature">
                                    <span class="input-group-text">C</span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mt-0 mb-5" style="border:2px solid black; border-bottom:0; border-top:0">
                <tr>
                    <td rowspan="3" style="width:13%; vertical-align:middle">
                        <h5 class="text-center">RENCANA TINDAK LANJUT *</h5>
                    </td>
                    <td colspan="3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_012_rj" name="t_012" value="1">
                            <label for="t_012_rj">Rawat Jalan</label>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="t_012_ri" name="t_012" value="2">
                                    <label for="t_012_ri">Rawat Inap</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Ruang</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_58" id="v_58">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Indikasi</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_59" id="v_59">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <label>DPJP Rawat Inap</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input class="form-control" type="text" name="v_60" id="v_60">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%"></td>
                    <td style="vertical-align: middle;">
                        <p>Kebutuhan Pelayanan : </p>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_013_preventif" name="t_013" value="1">
                            <label for="t_013_preventif">Preventif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_013_kuratif" name="t_013" value="2">
                            <label for="t_013_kuratif">Kuratif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_013_paliatif" name="t_013" value="3">
                            <label for="t_013_paliatif">Paliatif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_013_rehabilitatif" name="t_013" value="4">
                            <label for="t_013_rehabilitatif">Rehabilitatif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_013_khusus" name="t_013" value="5">
                            <label for="t_013_khusus">Pelayanan Khusus/Spesialistik/Intensif</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_014_observasi" name="t_014" value="1">
                                    <label for="t_014_observasi">Observasi, keluar dari RS</label>
                                </div>
                            </div>
                            <div class="col-md-3 mt-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Jam</span>
                                    <input type="time" class="form-control" name="v_61" id="v_61">
                                    <span class="input-group-text">WIB</span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_014_rujuk" name="t_014" value="2">
                                    <label for="t_014_rujuk">Rujuk ke :</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_015_rs" name="t_015" value="1">
                                            <label for="t_015_rs">RS</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="v_62" id="v_62">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_015_keluarga" name="t_015" value="2">
                                            <label for="t_015_keluarga">Dokter Keluarga</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="v_63" id="v_63">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_015_puskesmas" name="t_015" value="3">
                                            <label for="t_015_puskesmas">Puskesmas</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <input class="form-control" type="text" name="v_64" id="v_64">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="t_015_homecare" name="t_015" value="4">
                                            <label for="t_015_homecare">Homecare</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <input class="form-control" type="text" name="v_65" id="v_65">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <p>Atas Dasar</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="t_016_kamar" name="t_016" value="1">
                                        <label for="t_016_kamar">Kamar Penuh</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="t_016_keluarga" name="t_016" value="2">
                                        <label for="t_016_keluarga">Permintaan Pasien/Keluarga</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="t_016_fasilitas" name="t_016" value="3">
                                        <label for="t_016_fasilitas">Perlu fasilitas / SDM</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <p>Diantar oleh</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="t_017_ambulanrs" name="t_017" value="1">
                                        <label for="t_017_ambulanrs">Ambulan RS</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="t_017_ambulanlain" name="t_017" value="2">
                                        <label for="t_017_ambulanlain">Ambulan Lain</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="t_017_kendaraan" name="t_017" value="3">
                                        <label for="t_017_kendaraan">Kendaraan umum</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="t_017_pribadi" name="t_017" value="4">
                                        <label for="t_017_pribadi">Pribadi</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <strong><label>INSTRUKSI</label></strong>
                        <textarea class="form-control" name="v_66" id="v_66" cols="6" rows="10"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>EDUKASI PASIEN</h5>
                    </td>
                    <td colspan="3">
                        <p>Edukasi Awal, disampaikan tentang Diagnosis, Rencana Perawatan, dan Tujuan Perawatan kepada</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_018_pasien" name="t_018" value="1">
                            <label for="t_018_pasien">Pasien</label>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_018_keluarga" name="t_018" value="2">
                                    <label for="t_018_keluarga">Keluarga Pasien, nama : </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_67" id="v_67">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="t_018_edukasi" name="t_018" value="3">
                                    <label for="t_018_edukasi">Tidak dapat memberikan edukasi kepada pasien / keluarga pasien*, karena</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input class="form-control" type="text" name="v_68" id="v_68">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <p>Materi Edukasi : sesuai instruksi pulang / lainnya</p>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" name="v_69" id="v_69">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="container" style="width:50%">
                                    <p>Dokter</p>
                                    <br>
                                    <canvas id="canvas" width="150" height="75" style="border:1px solid #000;"></canvas>
                                    <input type="hidden" id="ttd" name="ttd">
                                    <br>
                                    <input type="text" class="form-control" id="v_70" name="v_70">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="container" style="width:50%">
                                    <p>Penerima Penjelasan</p>
                                    <br>
                                    <canvas id="canvas1" width="150" height="75" style="border:1px solid #000;"></canvas>
                                    <input type="hidden" id="ttd_1" name="ttd_1">
                                    <br>
                                    <input type="text" class="form-control" id="v_71" name="v_71">
                                </div>
                            </div>
                        </div>
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

</html>
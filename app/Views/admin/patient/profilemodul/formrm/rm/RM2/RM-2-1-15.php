<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>2.1.15 ASESMEN AWAL KEPERAWATAN PASIEN NEONATUS RAWAT INAP</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h3 style="text-align: right;"><b>RM 2.1.15</b></h3>


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
                            <h5><b>ASESMEN AWAL KEPERAWATAN PASIEN NEONATUS RAWAT INAP</b></h5>
                        </td>
                    </tr>

                </tbody>
            </table>


            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td>
                            <div>
                                <label class="col-2" for="">Alergi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_01" id="t_01_tidak" value="0">
                                    <label class="form-check-label" for="t_01_tidak">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_01" id="t_01_ada" value="1">
                                    <label class="form-check-label" for="t_01_ada">Ya, bila ya jelaskan :</label>
                                    <input type="text" id="v_01" name="v_01" style="width: 250px">
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <h6><b>I. PENGKAJIAN KEPERAWATAN </b></h6>
                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for=""><b>1. Keluhan Utama :</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_02" name="v_02" style="width: 700px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for=""><b>Riwayat Intra natal :</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_03" name="v_03" style="width: 700px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-4">
                                        <label for=""><b>Riwayat Post natal :</b></label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_04" name="v_04" style="width: 700px">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <h6><b>2. Keadaan Umum :</b></h6>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Kondisi saat lahir </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_02" id="t_02_segera" value="0">
                                        <label class="form-check-label" for="t_02_segera">Segera menangis</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_02" id="t_02_tidak" value="1">
                                        <label class="form-check-label" for="t_02_tidak">Tidak segera menangis</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Gerak</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_03" id="t_03_normal" value="0">
                                        <label class="form-check-label" for="t_03_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_03" id="t_03_kelainan" value="1">
                                        <label class="form-check-label" for="t_03_kelainan">Kelainan :</label>
                                        <input type="text" name="v_05" id="v_05">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Tangis</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_04" id="t_04_normal" value="0">
                                        <label class="form-check-label" for="t_04_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_04" id="t_04_kelainan" value="1">
                                        <label class="form-check-label" for="t_04_kelainan">Kelainan :</label>
                                        <input type="text" name="v_06" id="v_06">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Warna Kulit</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_05" id="t_05_normal" value="0">
                                        <label class="form-check-label" for="t_05_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_05" id="t_05_kelainan" value="1">
                                        <label class="form-check-label" for="t_05_kelainan">Kelainan :</label>
                                        <input type="text" name="v_07" id="v_07">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">N</span>
                                        <input type="text" class="form-control" name="nadi" id="nadi">
                                        <span class="input-group-text">x/m</span>
                                    </div>
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">CRT</span>
                                        <input type="text" class="form-control" name="v_08" id="v_08">
                                        <span class="input-group-text">detik</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">S</span>
                                        <input type="text" class="form-control" name="v_09" id="v_09">
                                        <span class="input-group-text">°C</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">R</span>
                                        <input type="text" class="form-control" name="v_10" id="v_10">
                                        <span class="input-group-text">x/m</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">spO2</span>
                                        <input type="text" class="form-control" name="saturasi" id="saturasi">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2"><b>a. Antropometri</b></div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">BB</span>
                                        <input type="text" class="form-control" name="weight" id="weight">
                                        <span class="input-group-text">gram</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">PB</span>
                                        <input type="text" class="form-control" name="height" id="height">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">LK</span>
                                        <input type="text" class="form-control" name="head" id="head">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 150px">
                                        <span class="input-group-text">LD</span>
                                        <input type="text" class="form-control" name="v_11" id="v_11">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-2"><b>b. Reflek primitif Bayi</b></div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_moro" value="option1">
                                    <label class="form-check-label" for="t_06_moro">Moro </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_babin" value="option2">
                                    <label class="form-check-label" for="t_06_babin">Babinsky </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_root" value="option2">
                                    <label class="form-check-label" for="t_06_root">Rooting</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_palm" value="option2">
                                    <label class="form-check-label" for="t_06_palm">Palmergraps </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_genggam" value="option2">
                                    <label class="form-check-label" for="t_06_genggam">Menggenggam </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_06" id="t_06_sucking" value="option2">
                                    <label class="form-check-label" for="t_06_sucking">Sucking </label>
                                </div>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <div class="mb-2">
                                <h5><b>3. Pengkajian per system</b></h5>
                            </div>
                            <div><b>a. Pemeriksaan Fisik :</b></div>
                            <div>• Kepala :</div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Bentuk</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_07" id="t_07_normal" value="0">
                                        <label class="form-check-label" for="t_07_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_07" id="t_07_kelainan" value="1">
                                        <label class="form-check-label" for="t_07_kelainan">Kelainan :</label>
                                        <input type="text" name="v_12" id="v_12">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Sutura</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_08" id="t_08_normal" value="0">
                                        <label class="form-check-label" for="t_08_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_08" id="t_08_kelainan" value="1">
                                        <label class="form-check-label" for="t_08_kelainan">Kelainan :</label>
                                        <input type="text" name="v_13" id="v_13">
                                    </div>
                                </div>
                            </div>

                            <div>• Mata :</div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Sklera</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_09" id="t_09_normal" value="0">
                                        <label class="form-check-label" for="t_09_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_09" id="t_09_kelainan" value="1">
                                        <label class="form-check-label" for="t_09_kelainan">Kelainan :</label>
                                        <input type="text" name="v_14" id="v_14">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div>
                                    <label class="col-2" for="">- Konjuctiva</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_010" id="t_010_normal" value="0">
                                        <label class="form-check-label" for="t_010_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_010" id="t_010_kelainan" value="1">
                                        <label class="form-check-label" for="t_010_kelainan">Kelainan :</label>
                                        <input type="text" name="v_15" id="v_15">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">• Telinga</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_011" id="t_011_normal" value="0">
                                        <label class="form-check-label" for="t_011_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_011" id="t_011_kelainan" value="1">
                                        <label class="form-check-label" for="t_011_kelainan">Kelainan :</label>
                                        <input type="text" name="v_16" id="v_16">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">• Hidung</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_012" id="t_012_normal" value="0">
                                        <label class="form-check-label" for="t_012_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_012" id="t_012_kelainan" value="1">
                                        <label class="form-check-label" for="t_012_kelainan">Kelainan :</label>
                                        <input type="text" name="v_17" id="v_17">
                                    </div>
                                </div>
                            </div>

                            <div>• Mulut :</div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Reflek Hisap</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_013" id="t_013_normal" value="0">
                                        <label class="form-check-label" for="t_013_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_013" id="t_013_kelainan" value="1">
                                        <label class="form-check-label" for="t_013_kelainan">Kelainan :</label>
                                        <input type="text" name="v_18" id="v_18">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div>
                                    <label class="col-2" for="">- Reflek Telan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_014" id="t_014_normal" value="0">
                                        <label class="form-check-label" for="t_014_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_014" id="t_014_kalainan" value="1">
                                        <label class="form-check-label" for="t_014_kalainan">Kelainan :</label>
                                        <input type="text" name="v_19" id="v_19">
                                    </div>
                                </div>
                            </div>


                            <div>• Leher :</div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Dada</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_015" id="t_015_normal" value="0">
                                        <label class="form-check-label" for="t_015_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_015" id="t_015_kelainan" value="1">
                                        <label class="form-check-label" for="t_015_kelainan">Kelainan :</label>
                                        <input type="text" name="v_20" id="v_20">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div>
                                    <label class="col-2" for="">- Perut</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_016" id="t_016_normal" value="0">
                                        <label class="form-check-label" for="t_016_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_016" id="t_016_kelainan" value="1">
                                        <label class="form-check-label" for="t_016_kelainan">Kelainan :</label>
                                        <input type="text" name="v_21" id="v_21">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">• Bentuk</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_017" id="t_017_normal" value="0">
                                        <label class="form-check-label" for="t_017_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_017" id="t_017_kelainan" value="1">
                                        <label class="form-check-label" for="t_017_kelainan">Kelainan :</label>
                                        <input type="text" name="v_22" id="v_22">
                                    </div>
                                </div>
                            </div>


                            <div>• Tali Pusat </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Punggung</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_018" id="t_018_normal" value="0">
                                        <label class="form-check-label" for="t_018_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_018" id="t_018_kelainan" value="1">
                                        <label class="form-check-label" for="t_018_kelainan">Kelainan :</label>
                                        <input type="text" name="v_23" id="v_23">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Genitalis</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_019" id="t_019_normal" value="0">
                                        <label class="form-check-label" for="t_019_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_019" id="t_019_kelainan" value="1">
                                        <label class="form-check-label" for="t_019_kelainan">Kelainan :</label>
                                        <input type="text" name="v_24" id="v_24">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Anus</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_020" id="t_020_normal" value="0">
                                        <label class="form-check-label" for="t_020_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_020" id="t_020_kelainan" value="1">
                                        <label class="form-check-label" for="t_020_kelainan">Kelainan :</label>
                                        <input type="text" name="v_25" id="v_25">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Anggota gerak atas</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_021" id="t_021_oedema" value="0">
                                        <label class="form-check-label" for="t_021_oedema">Oedema</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_021" id="t_021_tidak" value="1">
                                        <label class="form-check-label" for="t_021_tidak">Tidak Oedema :</label>
                                        <input type="text" name="v_26" id="v_26">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">- Anggota gerak bawah</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_022" id="t_022_oedema" value="0">
                                        <label class="form-check-label" for="t_022_oedema">Oedema</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_022" id="t_022_tidak" value="1">
                                        <label class="form-check-label" for="t_022_tidak">Tidak Oedema :</label>
                                        <input type="text" name="v_27" id="v_27">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div><b>b. sistem respirasi</b></div>
                            <div class="mb-2">
                                <label class="col-2" for="">Usaha nafas</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_023" id="t_023_spontan" value="0">
                                    <label class="form-check-label" for="t_023_spontan">Spontan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_023" id="t_023_bagging" value="1">
                                    <label class="form-check-label" for="t_023_bagging">Bagging</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">Tipe nafas</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_024" id="t_024_perut" value="0">
                                    <label class="form-check-label" for="t_024_perut">Perut</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_024" id="t_024_dada" value="1">
                                    <label class="form-check-label" for="t_024_dada">Dada</label>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div><b>c. Sistem Sirkulasi</b></div>
                            <div class="mb-2">
                                <label class="col-2" for="">Bunyi jantung</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_025" id="t_025_normal" value="0">
                                    <label class="form-check-label" for="t_025_normal">Normal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_025" id="t_025_kelainan" value="1">
                                    <label class="form-check-label" for="t_025_kelainan">Kelainan</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">Nadi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_026" id="t_026_keras" value="0">
                                    <label class="form-check-label" for="t_026_keras">Keras</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_026" id="t_026_lemah" value="1">
                                    <label class="form-check-label" for="t_026_lemah">Lemah</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_026" id="t_026_teratur" value="1">
                                    <label class="form-check-label" for="t_026_teratur">Teratur</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">Akral</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_027" id="t_027_dingin" value="0">
                                    <label class="form-check-label" for="t_027_dingin">Dingin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_027" id="t_027_hangat" value="1">
                                    <label class="form-check-label" for="t_027_hangat">Hangat</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_027" id="t_027_cyanosis" value="1">
                                    <label class="form-check-label" for="t_027_cyanosis">Cyanosis</label>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div><b>d.Sistem Neurologis</b></div>
                            <div class="mb-2">
                                <label class="col-2" for="">Kesadaran</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_cm" value="0">
                                    <label class="form-check-label" for="t_028_cm">CM</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_apatis" value="1">
                                    <label class="form-check-label" for="t_028_apatis">Apatis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_somno" value="1">
                                    <label class="form-check-label" for="t_028_somno">Somnolen</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_sopor" value="1">
                                    <label class="form-check-label" for="t_028_sopor">Sopor</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_028" id="t_028_coma" value="1">
                                    <label class="form-check-label" for="t_028_coma">Coma</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">Pupil</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_029" id="t_029_isokor" value="0">
                                    <label class="form-check-label" for="t_029_isokor">Isokor</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_029" id="t_029_an" value="1">
                                    <label class="form-check-label" for="t_029_an">An Isokor</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">Kejang</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_030" id="t_030_ya" value="0">
                                    <label class="form-check-label" for="t_030_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_030" id="t_030_tidak" value="1">
                                    <label class="form-check-label" for="t_030_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">Pergerakan tangan</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_031" id="t_031_kuat" value="0">
                                    <label class="form-check-label" for="t_031_kuat">Kuat</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_031" id="t_031_lemah" value="1">
                                    <label class="form-check-label" for="t_031_lemah">Lemah</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">Pergerakan kaki</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_032" id="t_032_kuat" value="0">
                                    <label class="form-check-label" for="t_032_kuat">Kuat</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_032" id="t_032_lemah" value="1">
                                    <label class="form-check-label" for="t_032_lemah">Lemah</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">Hasil LAB Bilirubin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_033" id="t_033_sudah" value="0">
                                    <label class="form-check-label" for="t_033_sudah">Sudah</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_033" id="t_033_belum" value="1">
                                    <label class="form-check-label" for="t_033_belum">Belum</label>
                                </div>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <div class="mb-2">
                                <h5><b>4.Skrining Nyeri</b></h5>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="col-2" for="">Nyeri</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_034" id="t_034_tidak" value="0">
                                            <label class="form-check-label" for="t_034_tidak">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_034" id="t_034_ya" value="1">
                                            <label class="form-check-label" for="t_034_ya">Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="col-2" for="">Onset</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_035" id="t_035_akut" value="0">
                                            <label class="form-check-label" for="t_035_akut">Akut</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_035" id="t_035_kronik" value="1">
                                            <label class="form-check-label" for="t_035_kronik">Kronik</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label class="col-6">Asesmen Nyeri dengan</label>
                                        <input type="text" name="v_28" id="v_28" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label class="col-2">Skor</label>
                                        <input type="text" name="v_29" id="v_29" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label class="col-2">Kategori</label>
                                        <input type="text" name="v_30" id="v_30" style="width: 100px">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 150px">
                                        <span class="input-group-text">P</span>
                                        <input type="text" class="form-control" name="v_31" id="v_31">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 150px">
                                        <span class="input-group-text">Q</span>
                                        <input type="text" class="form-control" name="v_32" id="v_32">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 150px">
                                        <span class="input-group-text">R</span>
                                        <input type="text" class="form-control" name="v_33" id="v_33">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 150px">
                                        <span class="input-group-text">T</span>
                                        <input type="text" class="form-control" name="v_34" id="v_34">
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="mb-2">
                                <h5><b>5. Kebutuhan Nutrisi</b></h5>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="col-3" for="">Minum ASI/PASI :</label>
                                        <input type="text" name="v_35" id="v_35" style="width: 100px">cc/h
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="col-2" for="">Oedema</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_036" id="t_036_ya" value="0">
                                            <label class="form-check-label" for="t_036_ya">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_036" id="t_036_tidak" value="1">
                                            <label class="form-check-label" for="t_036_tidak">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="col-3" for="">Mukosa Mulut</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_037" id="t_037_kering" value="0">
                                            <label class="form-check-label" for="t_037_kering">Kering</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_037" id="t_037_normal" value="1">
                                            <label class="form-check-label" for="t_037_normal">Normal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="col-2" for="">Turgor Kulit</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_038" id="t_038_baik" value="0">
                                            <label class="form-check-label" for="t_038_baik">Baik</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_038" id="t_038_sedang" value="1">
                                            <label class="form-check-label" for="t_038_sedang">Sedang</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_038" id="t_038_buruk" value="1">
                                            <label class="form-check-label" for="t_038_buruk">Buruk</label>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="mb-2">
                                <h5><b>6. Kebutuhan eliminasi</b></h5>
                            </div>
                            <div class="mb-2">
                                Frekuensi BAK :<input type="text" name="v_36" id="v_36" style="width: 100px">x/h,
                                Jumlah :<input type="text" name="v_37" id="v_37" style="width: 100px">CC,
                                Keluhan :<input type="text" name="v_38" id="v_38" style="width: 100px">
                            </div>
                            <div class="mb-2">
                                Frekuensi BAB :<input type="text" name="v_39" id="v_39" style="width: 100px">x/h,
                                Warna :<input type="text" name="v_40" id="v_40" style="width: 100px">,
                                Bau :<input type="text" name="v_41" id="v_41" style="width: 100px">,
                                Konsistensi :<input type="text" name="v_42" id="v_42" style="width: 100px">
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="mb-2">
                                <h5><b>7.Alat yang terpasang</b></h5>
                            </div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_039" id="t_039_o2" value="option1">
                                    <label class="form-check-label" for="t_039_o2">O2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_039" id="t_039_infus" value="option2">
                                    <label class="form-check-label" for="t_039_infus">Infus</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_039" id="t_039_dc" value="option2">
                                    <label class="form-check-label" for="t_039_dc">DC</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_039" id="t_039_ngt" value="option2">
                                    <label class="form-check-label" for="t_039_ngt">NGT</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_039" id="t_039_cpap" value="option2">
                                    <label class="form-check-label" for="t_039_cpap">CPAP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_039" id="t_039_venti" value="option2">
                                    <label class="form-check-label" for="t_039_venti">Ventilator</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_039" id="t_039_tidak" value="option2">
                                    <label class="form-check-label" for="t_039_tidak">Tidak terpasang alat</label>
                                </div>
                            </div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_039" id="t_039_lainnya" value="option2">
                                    <label class="form-check-label" for="t_039_lainnya">Lainnya :</label>
                                    <input type="text" name="v_43" id="v_43">
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div>
                                <h5><b>II. MASALAH KEPERAWATAN</b></h5>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1"><b>1. Respirasi</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_040" id="t_040_bersih">
                                        <label class="form-check-label" for="t_040_bersih">Bersihkan jalan nafas tidak efektif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_040" id="t_040_pola">
                                        <label class="form-check-label" for="t_040_pola">Pola nafas tidak efektif</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_040" id="t_040_resiko">
                                            <label class="form-check-label" for="t_040_resiko">Resiko aspirasi</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>2. Sirkulasi</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_041" id="t_041_perfusi">
                                        <label class="form-check-label" for="t_041_perfusi">Perfusi perifer tidak efektif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_041" id="t_041_risiko">
                                        <label class="form-check-label" for="t_041_risiko">Risiko perfusi gastro intestinal tidak efektif </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_041" id="t_041_renal">
                                        <label class="form-check-label" for="t_041_renal">Risiko perfusi renal tidak efektif</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_041" id="t_041_cerebral">
                                            <label class="form-check-label" for="t_041_cerebral">Risiko perfusi cerebral tidak efektif</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>3. Nutrisi dan cairan</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_ikterik">
                                        <label class="form-check-label" for="t_042_ikterik">Ikterik neonatorum</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_glukosa">
                                        <label class="form-check-label" for="t_042_glukosa">Ketidakstabilan kadar glukosa darah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_efektif">
                                        <label class="form-check-label" for="t_042_efektif">Menyusui efektif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_tidak">
                                        <label class="form-check-label" for="t_042_tidak">Menyusui tidak efektif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_difisit">
                                        <label class="form-check-label" for="t_042_difisit">Resiko defisit nutrisi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_disfungsi">
                                        <label class="form-check-label" for="t_042_disfungsi">Risiko disfungsi motilitas gastro intestinal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_risiko">
                                        <label class="form-check-label" for="t_042_risiko">Risiko ikterik neonatus</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_02_kadar">
                                        <label class="form-check-label" for="t_02_kadar">Risiko ketidakstabilan kadar glukosa darah</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_042" id="t_042_syok">
                                            <label class="form-check-label" for="t_042_syok">Risiko syok</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>4. Eliminasi</b></div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_043" id="t_043_inkonti">
                                            <label class="form-check-label" for="t_043_inkonti">Inkontinensia fekal</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>5. Aktivitas dan istirahat</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_044" id="t_044_perilaku">
                                        <l0abel class="form-check-label" for="t_044_perilaku">Disorganisasi perilaku bayi</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_044" id="t_044_risiko">
                                            <l0abel class="form-check-label" for="t_044_risiko">Risiko disorganisasi perilaku bayi</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="mb-1"><b>6. Neurosensori</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_045" id="t_045_gangguan">
                                        <label class="form-check-label" for="t_045_gangguan">Gangguan memori</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_045" id="t_045_menelan">
                                        <label class="form-check-label" for="t_045_menelan">Gangguan menelan</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_045" id="t_045_kapasitas">
                                            <label class="form-check-label" for="t_045_kapasitas">Penurunan kapasitas adaptif intra kranial</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>7. Nyeri dan kenyamanan</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_046" id="t_046_nyeri">
                                        <label class="form-check-label" for="t_046_nyeri">Nyeri akut</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_046" id="t_046_kronis">
                                            <label class="form-check-label" for="t_046_kronis">Nyeri kronis</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>8. Interaksi sosial</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_047" id="t_047_peran">
                                        <label class="form-check-label" for="t_047_peran">Pencapaian peran menjadi orang tua</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_047" id="t_047_gangguan">
                                        <label class="form-check-label" for="t_047_gangguan">Risiko gangguan perlekatan</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_047" id="t_047_proses">
                                            <label class="form-check-label" for="t_047_proses">Risiko proses pengasuhan tidak efektif</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>9.Keamanan dan protektif</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_048" id="t_048_hiper">
                                        <label class="form-check-label" for="t_048_hiper">Hipertermi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_048" id="t_048_mia">
                                        <label class="form-check-label" for="t_048_mia">Hipotermia</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_048" id="t_048_cidera">
                                        <label class="form-check-label" for="t_048_cidera">Risiko cidera</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_048" id="t_048_resiko">
                                        <label class="form-check-label" for="t_048_resiko">Risiko hipotermia</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_048" id="t_048_infeksi">
                                        <label class="form-check-label" for="t_048_infeksi">Risiko infeksi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_048" id="t_048_tidak">
                                        <label class="form-check-label" for="t_048_tidak">Termoregulasi tidak efektif</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_048" id="t_048_kulit">
                                            <label class="form-check-label" for="t_048_kulit">Risiko gangguan integritas kulit/ jaringan</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>10. Lain-lain</b>
                                        <input type="text" name="v_44" id="v_44">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div>
                                <h5><b>III. PERENCANAAN PEMULANGAN PASIEN / DISCHARGE PLANNING</b></h5>
                            </div>
                            <b>Kriteria pasien yang memerlukan Disharge Planning</b>
                            <div class="mb-2">
                                <div>
                                    <label class="col-4" for="">Umur > 65 Tahun dengan dimensia</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_049" id="t_049_ya" value="1">
                                        <label class="form-check-label" for="t_049_ya">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_049" id="t_049_tidak" value="0">
                                        <label class="form-check-label" for="t_049_tidak">Tidak</label>
                                    </div>

                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Keterbatasan Mobilitas </label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_050" id="t_050_ya" value="1">
                                    <label class="form-check-label" for="t_050_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_050" id="t_050_tidak" value="0">
                                    <label class="form-check-label" for="t_050_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Perawatan atau pengobatan lanjutan </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_051" id="t_051_ya" value="1">
                                    <label class="form-check-label" for="t_051_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_051" id="t_051_tidak" value="0">
                                    <label class="form-check-label" for="t_051_tidak">Tidak</label>
                                </div>

                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-4" for="">Bantuan untuk melakukan aktifitas sehari-hari </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_052" id="t_052_ya" value="1">
                                        <label class="form-check-label" for="t_052_ya">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_052" id="t_052_tidak" value="0">
                                        <label class="form-check-label" for="t_052_tidak">Tidak</label>
                                    </div>

                                </div>
                            </div>
                            <div class="mb-3">
                                <div>
                                    <label class="col-4" for="">Bantuan pelayanan psikososial </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_053" id="t_053_ya" value="1">
                                        <label class="form-check-label" for="t_053_ya">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_053" id="t_053_tidak" value="0">
                                        <label class="form-check-label" for="t_053_tidak">Tidak</label>
                                    </div>

                                </div>
                            </div>


                            <h6><b>Jika ada salah satu atau lebih jawaban pada yang diatas maka termasuk pemulangan rumit, maka akan dilanjutkan dengan perencanaan <br> pulang sebagai berikut: </b></h6>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_054" id="t_054_diri">
                                        <label class="form-check-label" for="t_054_diri">Perawatan diri / personal higiene </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_054" id="t_054_obat">
                                        <label class="form-check-label" for="t_054_obat">Pemantauan pemberian obat </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_054" id="t_054_diit">
                                        <label class="form-check-label" for="t_054_diit">Pemantauan Diit </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_054" id="t_054_lanjutan">
                                        <label class="form-check-label" for="t_054_lanjutan">Latihan fisik lanjutan </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_054" id="t_054_tenaga">
                                        <label class="form-check-label" for="t_054_tenaga">Pendampingan tenaga khusus di rumah ( home care )</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_054" id="t_054_fisik">
                                        <label class="form-check-label" for="t_054_fisik">1 Bantuan untuk melakukan aktifitas fisik ( kursi roda, alat bantu jalan )</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_054" id="t_054_luka">
                                        <label class="form-check-label" for="t_054_luka">Perawatan luka </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_054" id="t_054_lain">
                                        <label class="form-check-label" for="t_054_lain">Lain-lain :</label>
                                        <input type="text" name="v_45" id="v_45">
                                    </div>
                                </div>

                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>


            <div class="row">
                <div class="col-6">
                    <table class="table table-bordered mt-3" style="border: 1px solid black; width: 60%">
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><b>TELAH DI BACA</b></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="col-md-10">
                                        <div class="row text-align">
                                            <div class="col-md-4">
                                                <label for="">Tgl/Jam :</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" id="v_46" name="v_46" style="width: 200px">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <div class="col-md-10">
                                        <div class="row text-align">
                                            <div class="col-md-4">
                                                <label for="">TTD/Nama :</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="v_47" name="v_47" style="width: 200px">
                                            </div>
                                            <div>
                                                <div class="mb-1" style="text-align: center;">
                                                    <canvas id="canvas" width="200" height="150" style="border:1px solid #000;"></canvas>
                                                    <input type="hidden" name="TTD" id="TTD">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>



                        </tbody>
                    </table>
                </div>

                <div class="col-6">
                    <div>
                        Surakarta ,<input type="date" name="">
                    </div>
                    <table class="table table-bordered mt-3" style="border: 1px solid black; width: 100%">
                        <tbody>
                            <tr>
                                <td style="text-align: center;">Perawat yang mengkaji</td>
                                <td style="text-align: center;">Dan memberi penjelasan</td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="col-2">Dinas</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_055" id="t_055_pagi" value="1">
                                        <label class="form-check-label" for="t_055_pagi">Pagi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_055" id="t_055_sore" value="0">
                                        <label class="form-check-label" for="t_055_sore">Sore</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_055" id="t_055_malam" value="1">
                                        <label class="form-check-label" for="t_055_malam">Malam</label> , Jam
                                        <input type="time" name="v_48" id="v_48" style="width: 100px">
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <div class="col-md-10">
                                        <div class="row text-align">
                                            <div><b>PASIEN/KELUARGA</b></div>
                                            <div>
                                                <div class="mb-1" style="text-align: center;">
                                                    <canvas id="canvas1" width="200" height="150" style="border:1px solid #000;"></canvas>
                                                    <input type="hidden" name="TTD_1" id="TTD_1">
                                                </div>
                                                <div style="text-align: center;">
                                                    <input type="text" name="v_49" id="v_49">
                                                    <br><label><b>Ttd dan nama terang</b></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="col-md-10">
                                        <div class="row text-align">
                                            <div><b>PERAWAT</b></div>
                                            <div>
                                                <div class="mb-1" style="text-align: center;">
                                                    <canvas id="canvas2" width="200" height="150" style="border:1px solid #000;"></canvas>
                                                    <input type="hidden" name="TTD_2" id="TTD_2">
                                                </div>
                                                <div style="text-align: center;">
                                                    <input type="text" name="v_50" id="v_50">
                                                    <br><label><b>Ttd dan nama terang</b></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <h7><b>Beri tanda (√) pada kotak () sesuai pilihan <br>Beri tanda (-) untuk isian yang tidak ada keluhan</b></h7>





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
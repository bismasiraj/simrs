<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ASSESSMENT MEDIS PASIEN NEONATUS</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

</head>

<body>



    <div class="container-fluid mt-5">
        <form action="<?= site_url('#') ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <h6 align="right">RM 2.1c</h6>
            <table class="table table-bordered mb-2" style="border: 2px solid black">
                <tr>
                    <td width="20%" align="center">
                        <img class="mt-3" src="<?= base_url('assets/img/logo.png') ?>" width="80px">

                        <p class="mt-3">Sehat-Amanah <br> Tanggung Jawab-Islami</p>
                    </td>
                    <td width="45%" style="padding-top: 40px;">
                        <h5>RS. PKU MUHAMMADIYAH SAMPANGAN</h5>
                        <p>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta <br> Telp 0271-633894 Fax. : 0271-630229 <br> Jawa Tengah 57117</p>
                    </td>
                    <td width="35%">
                        <div class="container mt-1" style="border:1px solid black; padding-top:30px; height:170px;"></div>

                    </td>
                </tr>
                <tr style="border: 2px solid black">
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h6>Jenis Kelamin</h6>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <input type="radio" class="form-check-input" name="t_01" id="t_01_laki" value="1">
                                        <strong><label for="t_01_laki">Laki-laki</label></strong>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" class="form-check-input" name="t_01" id="t_01_perempuan" value="2">
                                        <strong><label for="t_01_perempuan">Perempuan</label></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>Tgl masuk</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="date" name="v_01" id="v_01">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>DPJP</label>
                            </div>
                            <div class="col-md-7">
                                <input class="form-control" type="text" name="v_02" id="v_02">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Ruang</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_03" id="v_03">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Kelas</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_04" id="v_04">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>PPJP</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_05" id="v_05">
                            </div>
                        </div>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h6 class="text-center">ASSESMEN MEDIS RAWAT INAP PASIEN NEONATUS</h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h6 class="text-center">Diisi oleh Dokter</h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <strong><label>Tanggal</label>
                                        </strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="v_06" id="v_06">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <strong><label>Jam datang</label></strong>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="time" name="v_07" id="v_07">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-left: 20px; padding-right: 20px;">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>STATUS OBSTETRI</h6>
                                <div class="row align-items-center">
                                    <div class="col-md-5 mt-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Umur Ibu</span>
                                            <input type="text" class="form-control" name="t_02" id="t_02">
                                        </div>
                                    </div>
                                    <div class="col-md-7 mt-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">G</span>
                                                    <input type="text" class="form-control" name="t_03" id="t_03">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">P</span>
                                                    <input type="text" class="form-control" name="t_04" id="t_04">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">A</span>
                                                    <input type="text" class="form-control" name="t_05" id="t_05">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Riwayat Obsteri </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_08" id="v_08">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Umur kehamilan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_09" id="v_09">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Komplikasi selama kehamilan </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_10" id="v_10">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Komplikasi Persalinan </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_11" id="v_11">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6>STATUS NENONATUS</h6>
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label>Bayi Lahir Tanggal</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" type="date" name="v_12" id="v_12">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-4">
                                                <label>Jam</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control" type="time" name="v_13" id="v_13">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label>Jenis Kelamin</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_06" id="t_06_laki" value="1">
                                                <label for="t_06_laki">Laki-laki</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_06" id="t_06_perempuan" value="2">
                                                <label for="t_06_perempuan">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">BB Lahir</span>
                                            <input type="text" class="form-control" name="t_07" id="t_07">
                                            <span class="input-group-text">gram</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">LK</span>
                                            <input type="text" class="form-control" name="t_08" id="t_08">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">PB Lahir</span>
                                        <input type="text" class="form-control" name="t_09" id="t_09">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Resusitasi ( 0, intubasi Intra trachea/ pompa udara berulang)</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_14" id="v_14">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label for="">Gol Darah Ibu</label>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <input type="radio" class="form-check-input" name="t_010" id="t_010_A" value="1">
                                        <label for="t_010_A">A</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" class="form-check-input" name="t_010" id="t_010_B" value="2">
                                        <label for="t_010_B">B</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" class="form-check-input" name="t_010" id="t_010_O" value="3">
                                        <label for="t_010_O">O</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" class="form-check-input" name="t_010" id="t_010_AB" value="4">
                                        <label for="t_010_AB">AB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Rh</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_15" id="v_15">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label for="">Gol Darah Ayah</label>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <input type="radio" class="form-check-input" name="t_011" id="t_011_A" value="1">
                                        <label for="t_011_A">A</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" class="form-check-input" name="t_011" id="t_011_B" value="2">
                                        <label for="t_011_B">B</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" class="form-check-input" name="t_011" id="t_011_O" value="3">
                                        <label for="t_011_O">O</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" class="form-check-input" name="t_011" id="t_011_AB" value="4">
                                        <label for="t_011_AB">AB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Rh</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_16" id="v_16">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label>KK pecah jam</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="time" name="v_17" id="v_17">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>warna</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_18" id="v_18">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Indikasi</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_19" id="v_19">
                            </div>
                        </div>
                        <br>
                        <table class="tabel table-bordered" style="width:100%;">
                            <tr class="text-center">
                                <th width="15%">
                                    <p>0</p>
                                </th>
                                <th width="15%">
                                    <p>1</p>
                                </th>
                                <th width="15%">
                                    <p>2</p>
                                </th>
                                <th width="20%">
                                    <p>AGPAR SCORE</p>
                                </th>
                                <th width="10%">
                                    <p>1`</p>
                                </th>
                                <th width="10%">
                                    <p>5`</p>
                                </th>
                                <th width="10%">
                                    <p>10`</p>
                                </th>
                            </tr>
                            <tr>
                                <td style="padding-left:20px">
                                    <p>Tidak ada</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Tidak teratur</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Baik</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Pernafasan</p>
                                </td>
                                <td>
                                    <select class="form-select" name="t_012" id="t_012">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="t_013" id="t_013">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="t_014" id="t_014">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:20px">
                                    <p>Lemah</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Sedang</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Baik</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Tonus Otot</p>
                                </td>
                                <td>
                                    <select class="form-select" name="t_015" id="t_015">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="t_016" id="t_016">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="t_017" id="t_017">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:20px">
                                    <p>Tidak ada</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Meringis</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Menangis</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Peka rangsang</p>
                                </td>
                                <td>
                                    <select class="form-select" name="t_018" id="t_018">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="t_019" id="t_019">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="t_020" id="t_020">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:20px">
                                    <p>Biru/Putih</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Ujung-ujung biru</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Merah jambu</p>
                                </td>
                                <td style="padding-left:20px">
                                    <p>Warna</p>
                                </td>
                                <td>
                                    <select class="form-select" name="t_021" id="t_021">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="t_022" id="t_022">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="t_023" id="t_023">
                                        <option selected>Pilih</option>
                                        <option value="1">0</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="padding-left:20px">
                                    <p><strong>Nilai Total</strong></p>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="t_024" id="t_024" readonly>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="t_025" id="t_025" readonly>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="t_027" id="t_027" readonly>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div class="row">
                            <div class="col-md-7"></div>
                            <div class="col-md-5 text-center">
                                <p>Dokter</p>
                                <br>
                                <canvas id="canvas" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" id="ttd" name="ttd">
                                <br>
                                <br>
                                <div class="col-sm-8 mx-auto">
                                    <input type="text" class="form-control" id="v_20" name="v_20">
                                </div>
                                <p>TTD dan Nama Terang</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-left: 20px; padding-right: 20px;">
                        <h6>STATUS NEONATUS LANJUT</h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-left: 20px; padding-right: 20px;">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Tanggal</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="date" name="v_21" id="v_21">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Jam</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="time" name="v_22" id="v_22">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-left: 20px; padding-right: 20px;">
                        <h6>1. PEMERIKSAAN FISIK</h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p>A. Keadaan Umum</p>

                        <table class="tabel table-bordered" style="width:100%;">
                            <tr>
                                <td style="padding-left:20px; padding-right:20px; width:25%">
                                    <p>Nadi</p>
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:35%">
                                    <input class="form-control" type="text" name="v_23" id="v_23">
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:20%">
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text">Suhu</span>
                                        <input type="text" class="form-control" name="v_24" id="v_24">
                                    </div>
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:20%">
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text">Pernafasan</span>
                                        <input type="text" class="form-control" name="v_25" id="v_25">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:20px; padding-right:20px; width:25%">
                                    <p>Kesan Umum</p>
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:35%">
                                    <input class="form-control" type="text" name="v_26" id="v_26">
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:20%" colspan="2">
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text">Pergerakan</span>
                                        <input type="text" class="form-control" name="v_27" id="v_27">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:20px; padding-right:20px; width:25%">
                                    <p>Kulit warna</p>
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:35%">
                                    <input class="form-control" type="text" name="v_28" id="v_28">
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:20%" colspan="2">
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text">Tonus</span>
                                        <input type="text" class="form-control" name="v_29" id="v_29">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:20px; padding-right:20px; width:25%">
                                    <p>Turgor</p>
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:35%">
                                    <input class="form-control" type="text" name="v_30" id="v_30">
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:20%" colspan="2">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <label for="">Suara</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <input type="radio" class="form-check-input" name="t_028" id="t_028_min" value="1">
                                                    <label for="t_028_min">(-)</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="radio" class="form-check-input" name="t_028" id="t_028_merintih" value="2">
                                                    <label for="t_028_merintih">Merintih</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="radio" class="form-check-input" name="t_028" id="t_028_keras" value="3">
                                                    <label for="t_028_keras">Keras</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:20px; padding-right:20px; width:25%">
                                    <p>Sikap</p>
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:35%">
                                    <input class="form-control" type="text" name="v_31" id="v_31">
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:20%" colspan="2">
                                    <div class="input-group mb-3 mt-3">
                                        <input type="text" class="form-control" name="v_32" id="v_32">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:20px; padding-right:20px; width:25%">
                                    <p>Reflek : Mono</p>
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:35%">
                                    <input class="form-control" type="text" name="v_33" id="v_33">
                                </td>
                                <td style="padding-left:20px; padding-right:20px; width:20%" colspan="2">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <label for="">Memegang</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <input type="radio" class="form-check-input" name="t_029" id="t_029_plus" value="1">
                                                    <label for="t_029_plus">(+)</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="radio" class="form-check-input" name="t_029" id="t_029_min" value="2">
                                                    <label for="t_029_min">(-)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <p>B. Kepala</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Bentuk</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_34" id="v_34">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Saturae</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_35" id="v_35">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Fontanella</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_36" id="v_36">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Mata</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_37" id="v_37">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Hidung</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_38" id="v_38">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label for="">Caput succedaneum</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_030" id="t_030_plus" value="1">
                                                <label for="t_030_plus">(+)</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_030" id="t_030_min" value="2">
                                                <label for="t_030_min">(-)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label for="">Caphal hematom</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_031" id="t_031_plus" value="1">
                                                <label for="t_031_plus">(+)</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_031" id="t_031_min" value="2">
                                                <label for="t_031_min">(-)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Telinga</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_39" id="v_39">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Mulut</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="v_40" id="v_40">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>C. Leher</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_41" id="v_41">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>D. <i>Thorax</i></label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_42" id="v_42">
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label>Cor</label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="v_43" id="v_43">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label>Pulmp</label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="v_44" id="v_44">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>E. <i>Abdomen</i></label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_45" id="v_45">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label for="">F. Genitella</label>
                            </div>
                            <div class="col-md-10">
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label for="">L</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" class="form-check-input" name="t_032" id="t_032_plus" value="1">
                                        <label for="t_032_plus">(+)</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" class="form-check-input" name="t_032" id="t_032_min" value="2">
                                        <label for="t_032_min">(-)</label>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <label for="">P</label>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <label>Labia Mayora</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="v_46" id="v_46">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label for="">G. Anus/Rectum</label>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <input type="radio" class="form-check-input" name="t_033" id="t_033_plus" value="1">
                                        <label for="t_033_plus">(+)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" class="form-check-input" name="t_033" id="t_033_min" value="2">
                                        <label for="t_033_min">(-)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>H. Ekstremitas</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_47" id="v_47">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>I. Tulang Punggung</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_48" id="v_48">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>J. Anomali Lain</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="v_49" id="v_49">
                            </div>
                        </div>
                        <br>
                        <h6 class="text-center">STEMPEL TELAPAK KAMI</h6>
                        <table class="tabel table-bordered text-center" style="width:100%;">
                            <tr>
                                <th width="33%">KANAN</th>
                                <th width="33%">KIRI</th>
                                <th width="33%">STEMPEL IBU JARI TANGAN KANAN IBU</th>
                            </tr>
                            <tr>
                                <td rowspan="2" style="padding-left:20px; padding-right:20px;">
                                    <div class="mb-3">
                                        <label for="v_50" class="form-label">Upload File</label>
                                        <input class="form-control" type="file" id="v_50" multiple>
                                    </div>
                                </td>
                                <td rowspan="2" style="padding-left:20px; padding-right:20px;">
                                    <div class="mb-3">
                                        <label for="v_51" class="form-label">Upload File</label>
                                        <input class="form-control" type="file" id="v_51" multiple>
                                    </div>
                                </td>
                                <td style="padding-left:20px; padding-right:20px;">
                                    <div class="mb-3">
                                        <label for="v_52" class="form-label">Upload File</label>
                                        <input class="form-control" type="file" id="v_52" multiple>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:20px; padding-right:20px;">
                                    <strong>
                                        <p>PERAWAT/DOKTER</p>
                                    </strong>
                                    <br>
                                    <canvas id="canvas1" width="200" height="100" style="border:1px solid #000;"></canvas>
                                    <input type="hidden" id="ttd_1" name="ttd_1">
                                    <br>
                                    <br>
                                    <div class="col-sm-8 mx-auto">
                                        <input type="text" class="form-control" id="v_53" name="v_53">
                                    </div>
                                    <p>TTD dan Nama Terang</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <strong><label for="">2. ASSESMEN</label></strong>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="v_54" id="v_54" col="6" rows="3"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <strong><label for="">3. RENCANA PENGOLAHAN </label></strong>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="v_55" id="v_55" col="6" rows="3"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-7"></div>
                            <div class="col-md-5 text-center">
                                <p>Nama dan Tanda Tangan DPJP</p>
                                <br>
                                <canvas id="canvas2" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" id="ttd_2" name="ttd_2">
                                <br>
                                <br>
                                <div class="col-sm-8 mx-auto">
                                    <input type="text" class="form-control" id="v_56" name="v_56">
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

<script>
    var canvas2 = document.getElementById('canvas2');
    const canvasDataInput2 = document.getElementById('ttd_2');
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

    var img2 = new Image();
    img2.src = 'assets/gambar1.png';
    img2.onload = function() {
        context2.drawImage(img2, 0, 0, canvas2.width, canvas2.height);
    };

    function saveSignatureData2() {
        const canvasData2 = canvas2.toDataURL('image/png');

        canvasDataInput2.value = canvasData2;
    }
</script>

</html>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> 2.1.11 ASESMEN AWAL KEPERAWATAN PASIEN KRITIS</title>
</head>

<body>
    <form>
        <div class="container mt-3">



            <br>
            <h3 style="text-align: right;"><b>RM 2.1.11</b></h3>



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
                            <h5><b>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>Telp 0271-633894 Fax. : 0271-630229 <br>Jawa Tengah 57117</b></h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 8px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>


            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td style="text-align: center;">
                            <h4><b>ASESMEN AWAL KEPERAWATAN KRITIS </b></h4>
                        </td>
                    </tr>


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
                            <div class="row">
                                <label class="col-sm-3 col-form-label">Masuk rawat inap tanggal :</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" name="examination_date" id="examination_date" style="width: 150px">
                                </div>
                                <label class="col-sm-1 col-form-label">Jam :</label>
                                <div class="col-sm-4">
                                    <input type="time" class="form-control" name="examination_date" id="examination_date" style="width: 150px">
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
                                            <input type="text" class="form-control" id="anamnase" name="anamnase" style="width: 700px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-md-10">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for=""><b>Riwayat Penyakit Sekarang :</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_02" name="v_02" style="width: 700px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-4">
                                        <label for=""><b>Riwayat Penyakit Dahulu :</b></label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_03" name="v_03" style="width: 700px">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h6><b>2. Keadaan Umum :</b></h6>
                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">TD</span>
                                        <input type="text" class="form-control" id="tension_upper" name="tension_upper">
                                        <span class="input-group-text">mmHg</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">N</span>
                                        <input type="text" class="form-control" id="nadi" name="nadi">
                                        <span class="input-group-text">x/menit</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">R</span>
                                        <input type="text" class="form-control" id="nafas" name="nafas">
                                        <span class="input-group-text">x/menit</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 150px">
                                        <span class="input-group-text">S</span>
                                        <input type="text" class="form-control" id="temperature" name="temperature">
                                        <span class="input-group-text">oC </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h6><b>3. Skrining Nyeri :</b></h6>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row mb-2">
                                        <div>
                                            <label class="col-md-2">Nyeri</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_02" id="t_02_tidak" value="0" readonly>
                                                <label class="form-check-label" for="t_02_tidak">Tidak</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_02" id="t_02_ya" value="1" readonly>
                                                <label class="form-check-label" for="t_02_ya">Ya</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row mb-2">
                                        <div>
                                            <label class="col-md-2">Onset</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_03" id="t_03_akut" value="0" readonly>
                                                <label class="form-check-label" for="t_03_akut">Akut</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_03" id="t_03_kronik" value="1" readonly>
                                                <label class="form-check-label" for="t_03_kronik">Kronik</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6>Asesmen Nyeri dengan :</h6>
                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">P</span>
                                        <input type="text" class="form-control" id="v_04" name="v_04">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">Q</span>
                                        <input type="text" class="form-control" id="v_05" name="v_05">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">R</span>
                                        <input type="text" class="form-control" id="v_06" name="v_06">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 150px">
                                        <span class="input-group-text">T</span>
                                        <input type="text" class="form-control" id="v_07" name="v_07">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h6><b>4. Pengkajian Per Sistem :</b></h6>
                            <h6><b>a. Sistem Respirasi</b></h6>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Jalan napas</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_04" id="t_04_paten" value="0">
                                        <label class="form-check-label" for="t_04_paten">Paten</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_04" id="t_04_tidak" value="1">
                                        <label class="form-check-label" for="t_04_tidak">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_04" id="t_04_snoring" value="2">
                                        <label class="form-check-label" for="t_04_snoring">Snoring</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_04" id="t_04_gurling" value="3">
                                        <label class="form-check-label" for="t_04_gurling">Gurling</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_04" id="t_04_stidor" value="4">
                                        <label class="form-check-label" for="t_04_stidor">Stidor</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Endotracheal tube</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_05" id="t_05_tidak" value="0">
                                        <label class="form-check-label" for="t_05_tidak">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_05" id="t_05_ya" value="1">
                                        <label class="form-check-label" for="t_05_ya">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_05" id="t_05_ukuran" value="2">
                                        <label class="form-check-label" for="t_05_ukuran">Ukuran ETT</label>

                                        <label>Tgl Pasang :</label>
                                        <input type="date" name="v_08" id="v_08">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Tracheostomy tube</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_06" id="t_06_tidak" value="0">
                                        <label class="form-check-label" for="t_06_tidak">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_06" id="t_06_ya" value="1">
                                        <label class="form-check-label" for="t_06_ya">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_06" id="t_06_ukuran" value="2">
                                        <label class="form-check-label" for="t_06_ukuran">Ukuran TT</label>

                                        <label>Tgl Pasang :</label>
                                        <input type="date" name="v_09" id="v_09">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Pola napas </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_07" id="t_07_apneu" value="0">
                                        <label class="form-check-label" for="t_07_apneu">Apneu </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_07" id="t_07_spontan" value="1">
                                        <label class="form-check-label" for="t_07_spontan">Spontan </label>
                                        <label>Tgl Pasang :</label>
                                        <input type="date" name="v_10" id="v_10">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Irama</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_08" id="t_08_teratur" value="0">
                                        <label class="form-check-label" for="t_08_teratur">Teratur</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_08" id="t_08_tidak" value="1">
                                        <label class="form-check-label" for="t_08_tidak">Tidak teratur </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_08" id="t_08_frekuensi" value="2">
                                        <label class="form-check-label" for="t_08_frekuensi">Frekuensi napas </label>
                                        <input type="text" name="v_11" id="v_11" style="width: 100px"> x/menit
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Ekspansi dada </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_09" id="t_09_simetris" value="0">
                                        <label class="form-check-label" for="t_09_simetris">Simetris </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_09" id="t_09_asimetris" value="1">
                                        <label class="form-check-label" for="t_09_asimetris">Asimetris </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Otot bantu napas </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_010" id="t_010_tidak" value="0">
                                        <label class="form-check-label" for="t_010_tidak">Tidak ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_010" id="t_010_ada" value="1">
                                        <label class="form-check-label" for="t_010_ada">Ada, sebutkan</label>
                                        <input type="text" id="v_12" name="v_12" style="width: 150px">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Suara paru </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_011" id="t_011_vesi" value="0">
                                        <label class="form-check-label" for="t_011_vesi">Vesikuler </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_011" id="t_011_ronchi" value="1">
                                        <label class="form-check-label" for="t_011_ronchi">Ronchi </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_011" id="t_011_wheezing" value="2">
                                        <label class="form-check-label" for="t_011_wheezing">Wheezing </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-2" for="">Reflek batuk </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_012" id="t_012_spontan" value="0">
                                    <label class="form-check-label" for="t_012_spontan">Spontan </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_012" id="t_012_tidak" value="1">
                                    <label class="form-check-label" for="t_012_tidak">Tidak Spontan </label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Posisi trachea </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_013" id="t_013_midline" value="0">
                                        <label class="form-check-label" for="t_013_midline">Midline </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_013" id="t_013_deviasi" value="1">
                                        <label class="form-check-label" for="t_013_deviasi">Deviasi </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Retraksi dinding dada </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_014" id="t_014_tidak" value="0">
                                        <label class="form-check-label" for="t_014_tidak">Tidak ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_014" id="t_014_ada" value="1">
                                        <label class="form-check-label" for="t_014_ada">Ada</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Mukosa mulut & bibir </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_015" id="t_015_kering" value="0">
                                        <label class="form-check-label" for="t_015_kering">Kering </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_015" id="t_015_lembab" value="1">
                                        <label class="form-check-label" for="t_015_lembab">Lembab </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_015" id="t_015_cyano" value="2">
                                        <label class="form-check-label" for="t_015_cyano">Cyanosisn </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Lain-lain</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="no_Registration" name="no_Registration" style="width: 700px">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h6><b>b. Sistem kardiovaskular</b></h6>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">Nadi</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_016" id="t_016_tidak" value="0">
                                                <label class="form-check-label" for="t_016_tidak">Tidak ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_016" id="t_016_ada" value="1">
                                                <label class="form-check-label" for="t_016_ada">Ada</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">Irama jantung</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_017" id="t_017_tidak" value="0">
                                                <label class="form-check-label" for="t_017_tidak">Teratur</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_017" id="t_017_ada" value="1">
                                                <label class="form-check-label" for="t_017_ada">Tidak Teratur</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row text-align">
                                            <div class="col-md-3">
                                                <label for="">Tekanan darah</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="v_13" name="v_13" style="width: 100px">Mmhg
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">Arteri line</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_018" id="t_018_tidak" value="0">
                                                <label class="form-check-label" for="t_018_tidak">Tidak ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_018" id="t_018_ada" value="1">
                                                <label class="form-check-label" for="t_018_ada">Ada</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">IV Line</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_019" id="t_019_tidak" value="0">
                                                <label class="form-check-label" for="t_019_tidak">Tidak ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_019" id="t_019_ada" value="1">
                                                <label class="form-check-label" for="t_019_ada">Ada</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">CVC</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_020" id="t_020_tidak" value="0">
                                                <label class="form-check-label" for="t_020_tidak">Tidak ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_020" id="t_020_ada" value="1">
                                                <label class="form-check-label" for="t_020_ada">Ada</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row text-align">
                                            <div class="col-md-3">
                                                <label for="">Saturasi Oksigen</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="v_14" name="v_14" style="width: 100px">%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">Kuli</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_021" id="t_021_tidak" value="0">
                                                <label class="form-check-label" for="t_021_tidak">Cyanosis</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_021" id="t_021_ada" value="1">
                                                <label class="form-check-label" for="t_021_ada">Tidak Cyanosis</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">Oedema</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_022" id="t_022_tidak" value="0">
                                                <label class="form-check-label" for="t_022_tidak">Tidak</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_022" id="t_022_ada" value="1">
                                                <label class="form-check-label" for="t_022_ada">Ya</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">Perdarahan</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_023" id="t_023_tidak" value="0">
                                                <label class="form-check-label" for="t_023_tidak">Tidak</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_023" id="t_023_ada" value="1">
                                                <label class="form-check-label" for="t_023_ada">Ya</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <div class="col-md-10">
                                            <div class="row text-align">
                                                <div class="col-md-4">
                                                    <label for="">Hearth Rate</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="v_15" name="v_15" style="width: 100px">x/Menit
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-10">
                                            <div class="row text-align">
                                                <div class="col-md-4">
                                                    <label for="">Gambaran ECG</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="v_16" name="v_16" style="width: 100px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-10">
                                            <div class="row text-align">
                                                <div class="col-md-4">
                                                    <label for="">MAP Presure </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="v_17" name="v_17" style="width: 100px">Mmhg
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-10">
                                            <div class="row text-align">
                                                <div class="col-md-4">
                                                    <label for="">Tanggal Pasang</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" id="v_18" name="v_18" style="width: 130px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-10">
                                            <div class="row text-align">
                                                <div class="col-md-4">
                                                    <label for="">Tanggal Pasang</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="date" id="v_19" name="v_19" style="width: 130px">
                                                    <label>PIVAS</label>
                                                    <input type="text" name="v_20" id="v_20" style="width: 100px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-10">
                                            <div class="row text-align">
                                                <div class="col-md-4">
                                                    <label for="">Tanggal Pasang</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="date" id="v_21" name="v_21" style="width: 130px">
                                                    <label>CVP</label>
                                                    <input type="text" name="v_22" id="v_22" style="width: 100px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-10">
                                            <div class="row text-align">
                                                <div class="col-md-4">
                                                    <label for="">Capilarry reftil time </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" id="v_23" name="v_23" style="width: 100px">detik
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-4" for="">Akral</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_024" id="t_024_hangat" value="0">
                                                <label class="form-check-label" for="t_024_hangat">Hangat</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_024" id="t_024_dingin" value="1">
                                                <label class="form-check-label" for="t_024_dingin">Dingin</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-10">
                                            <div class="row text-align">
                                                <div class="col-md-4">
                                                    <label for="">Lokasi</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="v_24" name="v_24" style="width: 200px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-10">
                                            <div class="row text-align">
                                                <div class="col-md-4">
                                                    <label for="">Melalui</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="v_25" name="v_25" style="width: 130px">
                                                    <label>Vol.</label>
                                                    <input type="text" name="v_26" id="v_26" style="width: 100px">ml
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Lain-lain</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_27" name="v_27" style="width: 700px">
                                    </div>
                                </div>
                            </div>


                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h6><b>c. Sistem Persarafan</b></h6>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Tingkat Kesadaran</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_025" id="t_025_normal" value="0">
                                        <label class="form-check-label" for="t_025_normal">composmentis</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_025" id="t_025_cair" value="1">
                                        <label class="form-check-label" for="t_025_cair">soporcoma</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_025" id="t_025_hijau" value="2">
                                        <label class="form-check-label" for="t_025_hijau">apatis</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_025" id="t_025_dempul" value="3">
                                        <label class="form-check-label" for="t_025_dempul">somnolen</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_025" id="t_025_terdapatdarah" value="4">
                                        <label class="form-check-label" for="t_025_terdapatdarah">coma</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_025" id="t_025_lainlain" value="5">
                                        <label class="form-check-label" for="t_025_lainlain">soporn</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">GCS</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="input-group mb-3" style="width: 100px">
                                                <span class="input-group-text">P</span>
                                                <input type="text" class="form-control" id="v_28" name="v_28">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group mb-3" style="width: 100px">
                                                <span class="input-group-text">Q</span>
                                                <input type="text" class="form-control" id="v_29" name="v_29">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group mb-3" style="width: 100px">
                                                <span class="input-group-text">R</span>
                                                <input type="text" class="form-control" id="v_30" name="v_30">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group mb-3" style="width: 100px">
                                                <span class="input-group-text">T</span>
                                                <input type="text" class="form-control" id="v_31" name="v_31">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Pupil</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_026" id="t_026_normal" value="0">
                                        <label class="form-check-label" for="t_026_normal">isokor</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_026" id="t_026_cair" value="1">
                                        <label class="form-check-label" for="t_026_cair">anisokor</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_026" id="t_026_hijau" value="2">
                                        <label class="form-check-label" for="t_026_hijau">miosis</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_026" id="t_026_dempul" value="3">
                                        <label class="form-check-label" for="t_026_dempul">medriasis</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Reflek Cahaya</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_027" id="t_027_normal" value="0">
                                        <label class="form-check-label" for="t_027_normal">kanan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_027" id="t_027_cair" value="1">
                                        <label class="form-check-label" for="t_027_cair">kiri</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Ukuran pupil</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_030" id="t_030_normal" value="0">
                                        <label class="form-check-label" for="t_030_normal">kanan</label>
                                        <input type="text" name="v_32" id="v_32" style="width: 80px"> mm
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_030" id="t_030_cair" value="1">
                                        <label class="form-check-label" for="t_030_cair">kiri </label>
                                        <input type="text" name="v_33" id="v_33" style="width: 80px"> mm
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Lain-lain</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_34" name="v_34" style="width: 700px">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h6><b>d. Sistem gastrointestinals</b></h6>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Bibir</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_028" id="t_028_compos" value="0">
                                        <label class="form-check-label" for="t_028_compos">Lembab</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_028" id="t_028_apatis" value="1">
                                        <label class="form-check-label" for="t_028_apatis">Kering</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_028" id="t_028_somnolen" value="2">
                                        <label class="form-check-label" for="t_028_somnolen">Stomatitis</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Tenggorokan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_029" id="t_029_compos" value="0">
                                        <label class="form-check-label" for="t_029_compos">Sulit menelan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_029" id="t_029_apatis" value="1">
                                        <label class="form-check-label" for="t_029_apatis">Sakit menelan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_029" id="t_029_somnolen" value="2">
                                        <label class="form-check-label" for="t_029_somnolen">Normal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Abdomen</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_030" id="t_030_compos" value="0">
                                        <label class="form-check-label" for="t_030_compos">Kembung</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_030" id="t_030_apatis" value="1">
                                        <label class="form-check-label" for="t_030_apatis">Acites</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_030" id="t_030_somnolen" value="2">
                                        <label class="form-check-label" for="t_030_somnolen">Tegang</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_030" id="t_030_normal" value="2">
                                        <label class="form-check-label" for="t_030_normal">Normal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Nafsu makan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_031" id="t_031_compos" value="0">
                                        <label class="form-check-label" for="t_031_compos">Menurun</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_031" id="t_031_apatis" value="1">
                                        <label class="form-check-label" for="t_031_apatis">Normal, frekuensi</label>
                                        <input type="text" name="v_35" id="v_35" style="width: 100px">x/Hari
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Porsi makan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_032" id="t_032_compos" value="0">
                                        <label class="form-check-label" for="t_032_compos">Cukup</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_032" id="t_032_apatis" value="1">
                                        <label class="form-check-label" for="t_032_apatis">Kurang, jumlah</label>
                                        <input type="text" name="v_36" id="v_36" style="width: 100px">Ml/Hari
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Minum</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_033" id="t_033_compos" value="0">
                                        <label class="form-check-label" for="t_033_compos">Cukup</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_033" id="t_033_apatis" value="1">
                                        <label class="form-check-label" for="t_033_apatis">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Keluhan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_034" id="t_034_compos" value="0">
                                        <label class="form-check-label" for="t_034_compos">Anorexia</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_034" id="t_034_apatis" value="1">
                                        <label class="form-check-label" for="t_034_apatis">Mual</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_034" id="t_034_muntah" value="1">
                                        <label class="form-check-label" for="t_034_muntah">Muntah</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">Riwayat Diet :</div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Terpasang NGT</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_035" id="t_035_compos" value="0">
                                        <label class="form-check-label" for="t_035_compos">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_035" id="t_035_apatis" value="1">
                                        <label class="form-check-label" for="t_035_apatis">Ya, Ukuran :</label>
                                        <input type="text" name="v_37" id="v_37" style="width: 100px"> Terpasang hari ke :
                                        <input type="text" name="v_38" id="v_38" style="width: 100px">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Tujuan NGT</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_036" id="t_036_compos" value="0">
                                        <label class="form-check-label" for="t_036_compos">Cuci lambung</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_036" id="t_036_apatis" value="1">
                                        <label class="form-check-label" for="t_036_apatis">Pemenuhan nutrisi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_036" id="t_036_lambung" value="1">
                                        <label class="form-check-label" for="t_036_lambung">Pengosongan lambung</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Colostomy</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_037" id="t_037_compos" value="0">
                                        <label class="form-check-label" for="t_037_compos">Ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_037" id="t_037_apatis" value="1">
                                        <label class="form-check-label" for="t_037_apatis">Tidak, Produksi</label>
                                        <input type="text" name="v_39" id="v_39">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Lain-lain</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_40" name="v_40" style="width: 700px">
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h6><b>e. Sistem Genetalia dan Eliminasi</b></h6>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2">BAB</label>
                                    <input type="text" name="v_41" id="v_41" style="width: 100px">x/hari ,
                                    <label class="col-1">Konsistensi</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_038" id="t_038_compos" value="0">
                                        <label class="form-check-label" for="t_038_compos">Lunak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_038" id="t_038_apatis" value="1">
                                        <label class="form-check-label" for="t_038_apatis">Keras</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_038" id="t_038_cair" value="1">
                                        <label class="form-check-label" for="t_038_cair">Cair</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Warna</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_039" id="t_039_compos" value="0">
                                        <label class="form-check-label" for="t_039_compos">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_039" id="t_039_apatis" value="1">
                                        <label class="form-check-label" for="t_039_apatis">Hitam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_039" id="t_039_merah" value="1">
                                        <label class="form-check-label" for="t_039_merah">Merah</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Keluhan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_040" id="t_040_compos" value="0">
                                        <label class="form-check-label" for="t_040_compos">Kembung</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_040" id="t_040_apatis" value="1">
                                        <label class="form-check-label" for="t_040_apatis">Sebah</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_040" id="t_040_konsti" value="1">
                                        <label class="form-check-label" for="t_040_konsti">Konstipasi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_040" id="t_040_diare" value="1">
                                        <label class="form-check-label" for="t_040_diare">Diare</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2">Peristaltik usus</label>
                                    <input type="text" name="v_42" id="v_42" style="width: 100px">x/menit ,
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_041" id="t_041_compos" value="0">
                                        <label class="form-check-label" for="t_041_compos">Flatus</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2">BAK</label>
                                    <input type="text" name="v_43" id="v_43" style="width: 100px">x/hari ,
                                    <label class="col-1">Warna</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_compos" value="0">
                                        <label class="form-check-label" for="t_042_compos">Jernih</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_apatis" value="1">
                                        <label class="form-check-label" for="t_042_apatis">Merah</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_042" id="t_042_kuning" value="1">
                                        <label class="form-check-label" for="t_042_kuning">Kekuningan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Gangguan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_043" id="t_043_compos" value="0">
                                        <label class="form-check-label" for="t_043_compos">Incontinentia</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_043" id="t_043_apatis" value="1">
                                        <label class="form-check-label" for="t_043_apatis">Retensi Urine</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_043" id="t_043_dsituria" value="1">
                                        <label class="form-check-label" for="t_043_dsituria">Disuria</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_043" id="t_043_oli" value="1">
                                        <label class="form-check-label" for="t_043_oli">Oliguria</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_043" id="t_043_nokturia" value="1">
                                        <label class="form-check-label" for="t_043_nokturia">Nokturia</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_043" id="t_043_anuria" value="1">
                                        <label class="form-check-label" for="t_043_anuria">Anuria</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Kateter Urine</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_044" id="t_044_compos" value="0">
                                        <label class="form-check-label" for="t_044_compos">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_044" id="t_044_apatis" value="1">
                                        <label class="form-check-label" for="t_044_apatis">Ya, Tanggal pasang :</label>
                                        <input type="date" name="v_44" id="v_44">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Produk Urine</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_045" id="t_045_compos" value="0">
                                        <label class="form-check-label" for="t_045_compos">Jernih</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_045" id="t_045_merah" value="1">
                                        <label class="form-check-label" for="t_045_merah">Merah</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_045" id="t_045_keruh" value="1">
                                        <label class="form-check-label" for="t_045_keruh">Keruh</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_045" id="t_045_kuning" value="1">
                                        <label class="form-check-label" for="t_045_kuning">Kekuningan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Perdarahan uretra</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_046" id="t_046_compos" value="0">
                                        <label class="form-check-label" for="t_046_compos">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_046" id="t_046_apatis" value="1">
                                        <label class="form-check-label" for="t_046_apatis">Ya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-2" for="">Perdarahan vagina</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_047" id="t_047_compos" value="0">
                                        <label class="form-check-label" for="t_047_compos">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_047" id="t_047_apatis" value="1">
                                        <label class="form-check-label" for="t_047_apatis">Ya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Lain-lain</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_45" name="v_45" style="width: 700px">
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h6><b>f. Sistem Integumen dan Maskuloskeletal</b></h6>
                            <div class="mb-2">
                                <div>
                                    <label class="col-3" for="">Kemampuan gerak sendi</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_048" id="t_048_compos" value="0">
                                        <label class="form-check-label" for="t_048_compos">Bebas</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_048" id="t_048_apatis" value="1">
                                        <label class="form-check-label" for="t_048_apatis">Terbatas</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-3" for="">Kulit</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_049" id="t_049_compos" value="0">
                                        <label class="form-check-label" for="t_049_compos">Tidak ada luka</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_049" id="t_049_apatis" value="1">
                                        <label class="form-check-label" for="t_049_apatis">Ada luka, Lokasi :</label>
                                        <input type="text" name="v_46" id="v_46" style="width: 100px"> Kondisi luka :
                                        <input type="text" name="v_47" id="v_47" style="width: 100px">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-3" for="">Patah Tulang</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_050" id="t_050_compos" value="0">
                                        <label class="form-check-label" for="t_050_compos">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_050" id="t_050_apatis" value="1">
                                        <label class="form-check-label" for="t_050_apatis">Ada, Lokasi :</label>
                                        <input type="text" name="v_48" id="v_48" style="width: 200px">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-3" for="">Deformity</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_051" id="t_051_compos" value="0">
                                        <label class="form-check-label" for="t_051_compos">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_051" id="t_051_apatis" value="1">
                                        <label class="form-check-label" for="t_051_apatis">Ada, Lokasi :</label>
                                        <input type="text" name="v_49" id="v_49" style="width: 200px">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-3" for="">Tulang Belakang</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_052" id="t_052_compos" value="0">
                                        <label class="form-check-label" for="t_052_compos">Tidak Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_052" id="t_052_apatis" value="1">
                                        <label class="form-check-label" for="t_052_apatis">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_052" id="t_052_scolio" value="1">
                                        <label class="form-check-label" for="t_052_scolio">Scoliosis</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_052" id="t_052_kipo" value="1">
                                        <label class="form-check-label" for="t_052_kipo">Kiposis</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_052" id="t_052_lordosis" value="1">
                                        <label class="form-check-label" for="t_052_lordosis">Lordosis</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">Kekuatan otot :</div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-3" for="">Luka</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_053" id="t_053_compos" value="0">
                                        <label class="form-check-label" for="t_053_compos">Operasi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_053" id="t_053_apatis" value="1">
                                        <label class="form-check-label" for="t_053_apatis">WSD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_053" id="t_053_ulkus" value="1">
                                        <label class="form-check-label" for="t_053_ulkus">Ulkus</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_053" id="t_053_deku" value="1">
                                        <label class="form-check-label" for="t_053_deku">Dekubitus</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_053" id="t_053_cpad" value="1">
                                        <label class="form-check-label" for="t_053_cpad">CAPD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_053" id="t_053_double" value="1">
                                        <label class="form-check-label" for="t_053_double">Double Lumen</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_053" id="t_053_av" value="1">
                                        <label class="form-check-label" for="t_053_av">AV Shunt</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-3" for="">Tanda Rahang</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_054" id="t_054_compos" value="0">
                                    <label class="form-check-label" for="t_054_compos">Kemerahan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_054" id="t_054_apatis" value="1">
                                    <label class="form-check-label" for="t_054_apatis">Panas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_054" id="t_054_bengkak" value="1">
                                    <label class="form-check-label" for="t_054_bengkak">Bengkak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_054" id="t_054_nyeri" value="1">
                                    <label class="form-check-label" for="t_054_nyeri">Nyeri</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_054" id="t_054_fungsiola" value="1">
                                    <label class="form-check-label" for="t_054_fungsiola">Fungsiola</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row text-align">
                                    <div class="col-md-2">
                                        <label for="">Lain-lain</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_50" name="v_50" style="width: 700px">
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h5><b>II. MASALAH KEPERAWATAN</b></h5>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1"><b>1. Respirasi</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_055" id="t_055_bersih">
                                        <label class="form-check-label" for="t_055_bersih">Bersihkan jalan nafas tidak efektif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_055" id="t_055_gangguan">
                                        <label class="form-check-label" for="t_055_gangguan">Gangguan pertukaran gas</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_055" id="t_055_pola">
                                            <label class="form-check-label" for="t_055_pola">Pola nafas tidak efektif</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>2. Nutrisi & Cairan</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_056" id="t_056_hipo">
                                        <label class="form-check-label" for="t_056_hipo">Hipovolemia</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_056" id="t_056_hyper">
                                        <label class="form-check-label" for="t_056_hyper">Hypervolemia</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_056" id="t_056_risiko">
                                        <label class="form-check-label" for="t_056_risiko">Risiko defisit nutrisi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_056" id="t_056_ketidak">
                                        <label class="form-check-label" for="t_056_ketidak">Risiko ketidak seimbangan cairan & elektrolit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_056" id="t_056_diare">
                                        <label class="form-check-label" for="t_056_diare">Diare</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_056" id="t_056_nyusu">
                                        <label class="form-check-label" for="t_056_nyusu">Menyusui tidak efektif</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_056" id="t_056_syok">
                                            <label class="form-check-label" for="t_056_syok">Risiko Syok</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>3. Eliminasi</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_057" id="t_057_konsti">
                                        <label class="form-check-label" for="t_057_konsti">Konstipasi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_057" id="t_057_gangguan">
                                        <label class="form-check-label" for="t_057_gangguan">Gangguan eliminasi Urine</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_057" id="t_057_retensi">
                                            <label class="form-check-label" for="t_057_retensi">Retensi Urine</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>4. Aktifitas dan istirahat</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_058" id="t_058_tole">
                                        <label class="form-check-label" for="t_058_tole">Intoleransi aktifitas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_058" id="t_058_gangguan">
                                        <label class="form-check-label" for="t_058_gangguan">Gangguan mobilitas fisik</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_058" id="t_058_pola">
                                            <label class="form-check-label" for="t_058_pola">Gangguan pola tidur</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>5. Nyeri dan Kenyamanan</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_059" id="t_059_nyeri">
                                        <label class="form-check-label" for="t_059_nyeri">Nyeri Akut</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_059" id="t_059_kronis">
                                            <label class="form-check-label" for="t_059_kronis">Nyeri Kronis</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="mb-1"><b>6. Sirkulasi</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_060" id="t_060_nurun">
                                        <label class="form-check-label" for="t_060_nurun">Penurunan curah jantung</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_060" id="t_060_fusi">
                                        <label class="form-check-label" for="t_060_fusi">Perfusi miocard tidak efektif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_060" id="t_060_peri">
                                        <label class="form-check-label" for="t_060_peri">Perfusi perifer tidak efektif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_060" id="t_060_cere">
                                        <label class="form-check-label" for="t_060_cere">Risiko perfusi cerebral tidak efektif</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_060" id="t_060_risiko">
                                            <label class="form-check-label" for="t_060_risiko">Risiko Perdarahan</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>7. Integritass ego</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_061" id="t_061_berduka">
                                        <label class="form-check-label" for="t_061_berduka">Berduka</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_061" id="t_061_anci">
                                            <label class="form-check-label" for="t_061_anci">Ancietas</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>8. Pertumbuhan dan Perkembangan</b></div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_062" id="t_062_gangguan">
                                            <label class="form-check-label" for="t_062_gangguan">Gangguan Tumbuh Kembang</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>9. Kebersihan Diri</b></div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_063" id="t_063_perawatan">
                                            <label class="form-check-label" for="t_063_perawatan">Defisit Perawatan Diri</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>10. Penyuluhan dan Pembelajaran</b></div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_064" id="t_064_fisit">
                                            <label class="form-check-label" for="t_064_fisit">Defisit Pengetahuan</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>11. Interaksi Sosial</b></div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_065" id="t_065_komunikasi">
                                            <label class="form-check-label" for="t_065_komunikasi">Komunikasi verbal</label>
                                        </div>
                                    </div>


                                    <div class="mb-1"><b>12. Keamanan dan Proteksi</b></div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_066" id="t_066_cidera">
                                        <label class="form-check-label" for="t_066_cidera">Risiko cidera</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_066" id="t_066_infeksi">
                                        <label class="form-check-label" for="t_066_infeksi">Risiko infeksi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_066" id="t_066_kulit">
                                        <label class="form-check-label" for="t_066_kulit">Gangguan integritas kulit / jaringan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_066" id="t_066_hypo">
                                        <label class="form-check-label" for="t_066_hypo">Hypotermia</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_066" id="t_066_hyper">
                                        <label class="form-check-label" for="t_066_hyper">Hypertemia</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_066" id="t_066_lain">
                                            <label class="form-check-label" for="t_066_lain">Lain-lain : </label>
                                            <input type="text" name="v_51" id="v_51">
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </td>
                    </tr>



                    <tr>
                        <td><b>Perencanaan pemulangan pasien rumit / Disharge Planning <br>Kriteria pasien yang memerlukan Disharge Planning</b>
                            <div class="mb-2">
                                <div>
                                    <label class="col-4" for="">Umur > 65 Tahun dengan dimensia</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_067" id="t_067_apatis" value="1">
                                        <label class="form-check-label" for="t_067_apatis">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_067" id="t_067_compos" value="0">
                                        <label class="form-check-label" for="t_067_compos">Tidak</label>
                                    </div>

                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Keterbatasan Mobilitas </label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_068" id="t_068_apatis" value="1">
                                    <label class="form-check-label" for="t_068_apatis">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_068" id="t_068_compos" value="0">
                                    <label class="form-check-label" for="t_068_compos">Tidak</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Perawatan atau pengobatan lanjutan </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_069" id="t_069_apatis" value="1">
                                    <label class="form-check-label" for="t_069_apatis">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_069" id="t_069_compos" value="0">
                                    <label class="form-check-label" for="t_069_compos">Tidak</label>
                                </div>

                            </div>
                            <div class="mb-2">
                                <div>
                                    <label class="col-4" for="">Bantuan untuk melakukan aktifitas sehari-hari </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_070" id="t_070_apatis" value="1">
                                        <label class="form-check-label" for="t_070_apatis">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_070" id="t_070_compos" value="0">
                                        <label class="form-check-label" for="t_070_compos">Tidak</label>
                                    </div>

                                </div>
                            </div>
                            <div class="mb-5">
                                <div>
                                    <label class="col-4" for="">Bantuan pelayanan psikososial </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_071" id="t_071_apatis" value="1">
                                        <label class="form-check-label" for="t_071_apatis">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_071" id="t_071_compos" value="0">
                                        <label class="form-check-label" for="t_071_compos">Tidak</label>
                                    </div>

                                </div>
                            </div>


                            <h6><b>Jika ada salah satu atau lebih jawaban pada yang diatassa maka termasuk pemulangan rumit, maka akan dilanjutkan dengan perencanaan <br> pulang sebagai berikut: </b></h6>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_072" id="t_072_diri">
                                <label class="form-check-label" for="t_072_diri">Perawatan diri / personal higiene </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_072" id="t_072_mantau">
                                <label class="form-check-label" for="t_072_mantau">Pemantauan pemberian obat </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_072" id="t_072_diit">
                                <label class="form-check-label" for="t_072_diit">Pemantauan Diit </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_072" id="t_072_fisik">
                                <label class="form-check-label" for="t_072_fisik">Latihan fisik lanjutan </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_072" id="t_072_tenaga">
                                <label class="form-check-label" for="t_072_tenaga">Pendampingan tenaga khusus di rumah ( home care )</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_072" id="t_072_untuk">
                                <label class="form-check-label" for="t_072_untuk">1 Bantuan untuk melakukan aktifitas fisik ( kursi roda, alat bantu jalan )</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_072" id="t_072_luka">
                                <label class="form-check-label" for="t_072_luka">Perawatan luka </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="t_072" id="t_072_lain">
                                <label class="form-check-label" for="t_072_lain">Lain-lain :</label>
                                <input type="text" name="v_52" id="v_52">
                            </div>

                        </td>
                    </tr>



                    <tr>
                        <td>
                            <h5><b>III. RENCANA KEPERAWATAN INTERDISIPLIN </b></h5>
                            <div class="mb-2">
                                <label class="col-4" for="">Diet dan Nutrisi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_073" id="t_073_compos" value="0">
                                    <label class="form-check-label" for="t_073_compos">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_073" id="t_073_apatis" value="1">
                                    <label class="form-check-label" for="t_073_apatis">Ya ,</label>
                                    <input type="text" name="v_53" id="v_53">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Rehabilitasi Medik </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_074" id="t_074_compos" value="0">
                                    <label class="form-check-label" for="t_074_compos">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_074" id="t_074_apatis" value="1">
                                    <label class="form-check-label" for="t_074_apatis">Ya ,</label>
                                    <input type="text" name="v_54" id="v_54">
                                </div>

                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Farmasi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_075" id="t_075_compos" value="0">
                                    <label class="form-check-label" for="t_075_compos">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_075" id="t_075_apatis" value="1">
                                    <label class="form-check-label" for="t_075_apatis">Ya ,</label>
                                    <input type="text" name="v_55" id="v_55">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Kerohanian</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_076" id="t_076_compos" value="0">
                                    <label class="form-check-label" for="t_076_compos">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_076" id="t_076_apatis" value="1">
                                    <label class="form-check-label" for="t_076_apatis">Ya ,</label>
                                    <input type="text" name="v_56" id="v_56">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Psikologi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_077" id="t_077_compos" value="0">
                                    <label class="form-check-label" for="t_077_compos">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_077" id="t_077_apatis" value="1">
                                    <label class="form-check-label" for="t_077_apatis">Ya ,</label>
                                    <input type="text" name="v_57" id="v_57">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Lain-lain </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_078" id="t_078_compos" value="0">
                                    <label class="form-check-label" for="t_078_compos">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_078" id="t_078_apatis" value="1">
                                    <label class="form-check-label" for="t_078_apatis">Ya ,</label>
                                    <input type="text" name="v_58" id="v_58">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="col-4" for="">Diet dan Nutrisi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_079" id="t_079_compos" value="0">
                                    <label class="form-check-label" for="t_079_compos">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_079" id="t_079_apatis" value="1">
                                    <label class="form-check-label" for="t_079_apatis">Ya ,</label>
                                    <input type="text" name="v_59" id="v_59">
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>


            <br><br>
            <div style="text-align: right;">
                <div class="mb-3">
                    <label for="alasan" type="text">Surakarta , </label>
                    <input type="date" name="v_60" id="v_60">
                </div>
                <div>Perawat yang mengkaji,</div>

                <div class="mb-1">
                    <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD" id="TTD">
                    <br><input type="text" name="v_61" id="v_61">
                    <br><label for="">Ttd & Nama Terang</label>
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

</body>

</html>
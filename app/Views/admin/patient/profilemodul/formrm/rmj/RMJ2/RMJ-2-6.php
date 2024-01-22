<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RMJ 2.6 ASSESMEN MEDIS PASIEN SARAF</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RMJ.2.6</b></h5>

            <br><br>
            <h6 style="text-align: center;"><b>REKAM MEDIS RAWAT JALAN</b></h6>
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
                            <h5>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>Telp 0271-633894 Fax. : 0271-630229 <br>Jawa Tengah 57117</h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 3px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <h5><b>ASESMEN MEDIS PASIEN SARAF</b></h5>
                        </td>
                    </tr>

                </tbody>
            </table>

            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>
                    <tr>
                        <td>
                            <div class="row">
                                <label class="col-sm-1 col-form-label">Tanggal :</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="v_01" name="v_01">
                                </div>
                                <div class="col-sm-1"></div>
                                <label class="col-sm-1 col-form-label">Jam :</label>
                                <div class="col-sm-4">
                                    <input type="time" class="form-control" id="v_02" name="v_02">
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Riwayat Alergi :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_03" name="v_03" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="3">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="row align-items-center">
                                        <div class="col-md-9">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <input type="radio" class="form-check-input" name="t_01" id="t_01_autoanamnesis" value="1">
                                                    <strong><label for="t_01_autoanamnesis">Anamnesa</label></strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="radio" class="form-check-input" name="t_01" id="t_01_alloanamnesis" value="2">
                                                    <strong><label for="t_01_alloanamnesis">Alloanamnesis*</label></strong>
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
                                            <input class="form-control" type="text" name="v_03" id="v_03">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label>Hubungan dengan pasien</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="v_04" id="v_04">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="container">
                                <ul>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label><b>Keluhan Utama</b></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="v_05" id="v_05">
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label><b>Riwayat Penyakit Sekarang</b></label>
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
                                                        <label>Alloanamnesis* dengan</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="v_07" id="v_07">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Hubungan dengan pasien</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text" name="v_08" id="v_08">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label><b>Riwayat Penyakit Dahulu</b></label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="v_09" id="v_09" cols="6" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                </ul>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Riwayat obat yang dikonsumsi :</b></label>
                            <div class="mb-3">
                                <div class="col-md-2">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">1. </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_10" name="v_10" style="width: 900px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row text-align">
                                    <div class="col-md-4">
                                        <label for="">2. </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_11" name="v_11" style="width: 900px">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Pemeriksaan Fisik :</b></label>
                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">TD</span>
                                        <input type="text" class="form-control" name="tension_upper" id="tension_upper">
                                        <span class="input-group-text">/</span>
                                        <input type="text" class="form-control" name="tension_below" id="tension_below">
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


                            <div class="mb-3">
                                <div class="col-md-4">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">1. Cranium</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_12" name="v_12" style="width: 900px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-4">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">2. Leher</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_13" name="v_13" style="width: 900px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-4">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">3. Thorax</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_14" name="v_14" style="width: 900px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-md-4">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">4. Abdomen</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_15" name="v_15" style="width: 900px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-4">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">5. Genitalia</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_16" name="v_16" style="width: 900px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>6. Extremitas</label>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">a. Extremitas Atas</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_17" name="v_17" style="width: 850px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <div class="row text-align">
                                        <div class="col-md-4">
                                            <label for="">b. Extremitas Bawah</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="v_18" name="v_18" style="width: 850px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div><label><b>Pemeriksaan Neurologis :</b></label></div>
                            Kondisi Umum :<input type="text" id="v_19" name="v_19">
                            GCS :<input type="text" id="v_20" name="v_20">
                            VAS / NRS :<input type="text" id="v_21" name="v_21">
                            <div class="mb-3">
                                <label>• Kepala </label>
                            </div>
                            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                                <tbody>
                                    <tr>
                                        <td>Pupil</td>
                                        <td>Diameter : <input type="text" id="v_22" name="v_22"></td>
                                        <td>
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_02" id="t_02_isokor" value="1">
                                                <label for="t_02_isokor">Isokor</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_02" id="t_02_an" value="1">
                                                <label for="t_02_an">An Isokor</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Cahaya</td>
                                        <td><input type="text" class="form-control" id="v_23" name="v_23"></td>
                                        <td><input type="text" class="form-control" id="v_24" name="v_24"></td>
                                        <td><input type="text" class="form-control" id="v_25" name="v_25"></td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Kornea</td>
                                        <td><input type="text" class="form-control" id="v_26" name="v_26"></td>
                                        <td><input type="text" class="form-control" id="v_27" name="v_27"></td>
                                        <td><input type="text" class="form-control" id="v_28" name="v_28"></td>
                                    </tr>

                                </tbody>
                            </table>

                            <br>
                            <div class="mb-3">
                                <label>• Leher </label>
                                <table class="table table-bordered mb-0" style="border: 1px solid black;">
                                    <tbody>
                                        <tr>
                                            <td>Kaku kuduk</td>
                                            <td><input type="text" class="form-control" id="v_29" name="v_29"></td>
                                        </tr>
                                        <tr>
                                            <td>Meninggal sign</td>
                                            <td><input type="text" class="form-control" id="v_30" name="v_30"></td>
                                        </tr>
                                        <tr>
                                            <td>Brudzinki I-IV</td>
                                            <td><input type="text" class="form-control" id="v_31" name="v_31"></td>
                                        </tr>
                                        <tr>
                                            <td>Kernig sign</td>
                                            <td><input type="text" class="form-control" id="v_32" name="v_32"></td>
                                        </tr>
                                        <tr>
                                            <td>Doll’s eye phenomena</td>
                                            <td><input type="text" class="form-control" id="v_33" name="v_33"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <div class="row text-align">
                                    <div class="col-md-4">
                                        <label for="">• Vertebra </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_34" name="v_34" style="width: 850px">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <div class="row text-align">
                                    <div class="col-md-4">
                                        <label for="">• Extremitas </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_35" name="v_35" style="width: 850px">
                                    </div>
                                </div>
                            </div>


                            <br><br>
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <span>Gerak dan Kekuatan:</span>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_36" name="v_36" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_37" name="v_37" style="width: 100%;">
                                </div>
                                <div class="col-2"></div>
                                <div class="col-1">
                                    <input type="text" id="v_38" name="v_38" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_39" name="v_39" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <input type="text" id="v_40" name="v_40" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_41" name="v_41" style="width: 100%;">
                                </div>
                                <div class="col-2"></div>
                                <div class="col-1">
                                    <input type="text" id="v_42" name="v_42" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_43" name="v_43" style="width: 100%;">
                                </div>
                            </div>

                            <div class="row align-items-center mt-3">
                                <div class="col-3">
                                    <span>Reflek Fisiologi:</span>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_44" name="v_44" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_45" name="v_45" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <input type="text" id="v_46" name="v_46" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_47" name="v_47" style="width: 100%;">
                                </div>
                                          
                            </div>

                            <div class="row align-items-center mt-3">
                                <div class="col-3">
                                    <span>Reflek patologis :</span>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_48" name="v_48" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_49" name="v_49" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <input type="text" id="v_50" name="v_50" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="v_51" name="v_51" style="width: 100%;">
                                </div>
                                          
                            </div>

                            <br>
                            <div class="col-md-6">
                                <div class="row text-align">
                                    <div class="col-md-4">
                                        <label for="">Clonus </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_52" name="v_52" style="width: 850px">
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="col-md-6">
                                <div class="row text-align">
                                    <div class="col-md-4">
                                        <label for="">Sensibilitas </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="v_53" name="v_53" style="width: 850px">
                                    </div>
                                </div>
                            </div>

                    <tr>
                        <td>
                            <label><b>Pemeriksaan Penunjang :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_54" name="v_54" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label><b>Diagnosis Kerja :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_55" name="v_55" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Terapi :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="v_56" name="v_56" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>

                    </td>
                    </tr>


                    <table class="table table-bordered mb-0" style="border: 1px solid black;">
                        <tbody>


                            <tr>
                                <td rowspan="4" style="text-align: center;"><br><br><br><b>Rencana Tindak Lanjut </b></td>
                                <td>
                                    <div class="col-md-6">
                                        <input type="radio" class="form-check-input" name="t_01" id="t_01_autoanamnesis" value="1">
                                        <label for="t_01_autoanamnesis">Rawat Jalan</label>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <div class="row align-items-center">
                                                    <div class="col-md-9">
                                                        <div class="row align-items-center">

                                                            <div class="col-md-6">
                                                                <input type="radio" class="form-check-input" name="t_01" id="t_01_alloanamnesis" value="2">
                                                                <label for="t_01_alloanamnesis">Rawat Inap</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <label>Ruang</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="v_57" id="v_57" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Indikasi</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text" name="v_58" id="v_58" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label><b>DPJP Rawat Inap :</b></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="v_59" id="v_59" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label class="col-3" for="">Pengantar Pasien :</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_03" id="t_03_ya" value="0">
                                        <label class="form-check-label" for="t_03_ya">Ada </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="t_03" id="t_03_tidak" value="0">
                                        <label class="form-check-label" for="t_03_tidak">Tidak* (Bila tidak, rujuk ke Dinas Sosial) </label>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <div class="mb-2">
                                        <label class="col-2" for="">Rujuk ke : </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_cm" value="0">
                                            <label class="form-check-label" for="t_04_cm">RS</label>
                                            <input type="text" id="v_60" name="v_60" style="width: 120px">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_apatis" value="1">
                                            <label class="form-check-label" for="t_04_apatis">Dokter Keluarga</label>
                                            <input type="text" id="v_61" name="v_61" style="width: 120px">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_somno" value="1">
                                            <label class="form-check-label" for="t_04_somno">Puskesmas</label>
                                            <input type="text" id="v_62" name="v_62" style="width: 120px">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_sopor" value="1">
                                            <label class="form-check-label" for="t_04_sopor">Dokter</label>
                                            <input type="text" id="v_63" name="v_63" style="width: 120px">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_coma" value="1">
                                            <label class="form-check-label" for="t_04_coma">Homecare</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="col-md-8">
                                                <div class="row text-align">
                                                    <div class="col-md-9">
                                                        <label for="">Kontrol Klinik / Homecare di :</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" id="v_64" name="v_64" style="width: 200px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-md-2">
                                                <div class="row text-align">
                                                    <div class="col-md-8">
                                                        <label for="">Tanggal</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" id="v_65" name="v_65" style="width: 100px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>



                            <tr>
                                <td style="text-align: center;"><br><br><b>Edukasi Pasien </b></td>
                                <td>
                                    <div class="mb-1">Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada :</div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_05" id="t_05_perfusi">
                                        <label class="form-check-label" for="t_05_perfusi">Pasien</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_05" id="t_05_risiko">
                                        <label class="form-check-label" for="t_05_risiko">Keluarga pasien, nama :</label>
                                        <input type="text" id="v_66" name="v_66" style="width: 250px">
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="t_05" id="t_05_renal">
                                        <label class="form-check-label" for="t_05_renal">Tidak dapat memberi edukasi kepada pasien atau keluarga, Karena </label>
                                        <input type="text" id="v_67" name="v_67" style="width: 250px">
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="t_05" id="t_05_cerebral">
                                            <label class="form-check-label" for="t_05_cerebral">Risiko perfusi cerebral tidak efektif</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>


                </tbody>
            </table>

            <div class="row">
                <div class="col-6">
                    <div style="text-align: center;">Dokter</div>

                    <div class="mb-1" style="text-align: center;">
                        <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="TTD" id="TTD">
                        <br>(<input type="text" name="v_68" id="v_68">)
                    </div>
                </div>


                <div class="col-6">
                    <div style="text-align: center;">Penerima Penjelasan</div>

                    <div class="mb-1" style="text-align: center;">
                        <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="TTD_1" id="TTD_1">
                        <br>(<input type="text" name="v_69" id="v_69">)
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
</body>

</html>
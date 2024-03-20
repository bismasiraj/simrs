<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ASESMEN AWAL MEDIS PASIEN THT</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/datepicker/date.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>

</head>

<body>

    <div class="container mt-5">
        <form id="form" action="/admin/rekammedis/rmj2_7/ <?= base64_encode(json_encode($visit)); ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
            <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
            <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            <input type="hidden" name="body_id" id="body_id">
            <input type="hidden" name="org_unit_code" id="org_unit_code">
            <input type="hidden" name="pasien_diagnosa_id" id="pasien_diagnosa_id">
            <input type="hidden" name="diagnosa_id" id="diagnosa_id">
            <input type="hidden" name="no_registration" id="no_registration">
            <input type="hidden" name="visit_id" id="visit_id">
            <input type="hidden" name="bill_id" id="bill_id">
            <input type="hidden" name="clinic_id" id="clinic_id">
            <input type="hidden" name="class_room_id" id="class_room_id">
            <input type="hidden" name="in_date" id="in_date">
            <input type="hidden" name="exit_date" id="exit_date">
            <input type="hidden" name="keluar_id" id="keluar_id">
            <!-- <input type="hidden" name="examination_date" id="examination_date"> -->
            <input type="hidden" name="employee_id" id="employee_id">
            <input type="hidden" name="description" id="description">
            <input type="hidden" name="modified_date" id="modified_date">
            <input type="hidden" name="modified_by" id="modified_by">
            <input type="hidden" name="modified_from" id="modified_from">
            <input type="hidden" name="status_pasien_id" id="status_pasien_id">
            <input type="hidden" name="ageyear" id="ageyear">
            <input type="hidden" name="agemonth" id="agemonth">
            <input type="hidden" name="ageday" id="ageday">
            <input type="hidden" name="thename" id="thename">
            <input type="hidden" name="theaddress" id="theaddress">
            <input type="hidden" name="theid" id="theid">
            <input type="hidden" name="isrj" id="isrj">
            <input type="hidden" name="gender" id="gender">
            <input type="hidden" name="doctor" id="doctor">
            <input type="hidden" name="kal_id" id="kal_id">
            <input type="hidden" name="petugas_id" id="petugas_id">
            <input type="hidden" name="petugas" id="petugas">
            <input type="hidden" name="account_id" id="account_id">
            <h6 align="right">RMJ.2.7</h6>
            <table class="table table-bordered mb-2" style="border: 2px solid black">
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3" align="center">
                                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">

                                <p class="mt-2">Sehat-Amanah <br> Tanggung Jawab-Islami</p>
                            </div>
                            <div class="col-md-5 mt-2">
                                <h5>RS. PKU MUHAMMADIYAH SAMPANGAN</h5>
                                <p>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta <br> Telp 0271-633894 Fax. : 0271-630229 <br> Jawa Tengah 57117</p>
                            </div>
                            <div class="col-md-4 align-items-center">
                                <div class="container mt-1" style="border:1px solid black; padding-top:70px; height:160px; border-radius: 10px">
                                    <p class="text-center">Label Identitas Pasien</p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="border: 2px solid black">
                    <td colspan="2">
                        <h5 class="text-center">ASESMEN AWAL MEDIS PASIEN THT</h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Tanggal</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="date" name="examination_date" id="examination_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Jam</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="time" name="v_02" id="v_02">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <strong><label>Riwayat Alergi</label></strong>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="ana_imun_history" id="ana_imun_history">
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
                                                <input type="radio" class="form-check-input" name="t_01" id="t_01_autoanamnesis" value="1">
                                                <strong><label for="t_01_autoanamnesis">Autoanamnesis</label></strong>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="t_01" id="t_01_alloanamnesis" value="2">
                                                <strong><label for="t_01_alloanamnesis">Alloanamnesis</label></strong>
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
                                        <input class="form-control" type="text" name="v_04" id="v_04">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label>Hubungan dengan pasien</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="v_05" id="v_05">
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
                                            <strong><label>Keluhan Utama</label></strong>
                                        </div>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="ana_main_complaint" id="ana_main_complaint">
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <strong><label>Riwayat Penyakit Sekarang</label></strong>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="ana_auto_current_disease_history" id="ana_auto_current_disease_history" cols="6" rows="3"></textarea>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <div class="row align-items-center">
                                                <div class="col-md-5">
                                                    <strong><label>Alloanamnesis dengan</label></strong>
                                                </div>
                                                <div class="col-md-7">
                                                    <input class="form-control" type="text" name="ana_past_disease_history" id="ana_past_disease_history">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <label>Hubungan dengan pasien</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="ana_family_disease_history" id="ana_family_disease_history">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <strong><label>Riwayat Penyakit Dahulu</label></strong>
                                        </div>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="ana_past_desease_history" id="ana_past_desease_history">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <strong><label>Riwayat obat yang dikonsumsi</label></strong>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="ana_allergy_history_non_drugs" id="ana_allergy_history_non_drugs" cols="6" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>Pemeriksaan Fisik</h6>
                        <div class="container">
                            <div class="container">
                                <strong>
                                    <p>Tanda Vital</p>
                                </strong>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">TD</span>
                                            <input type="text" class="form-control" name="pf_vital_sign_bp" id="pf_vital_sign_bp">
                                            <!-- <span class="input-group-text">/</span>
                                            <input type="text" class="form-control" name="tension_below" id="tension_below"> -->
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">N</span>
                                            <input type="text" class="form-control" name="pf_vital_sign_n" id="pf_vital_sign_n">
                                            <span class="input-group-text">x/menit</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">S</span>
                                            <input type="text" class="form-control" name="pf_vital_sign_s" id="pf_vital_sign_s">
                                            <span class="input-group-text">C</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">RR</span>
                                            <input type="text" class="form-control" name="pf_vital_sign_rr" id="pf_vital_sign_rr">
                                            <span class="input-group-text">x/menit</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="container">
                                    <div class="row" align="center">
                                        <div class="col-md-4">
                                            <strong>
                                                <p>Struktur Telinga</p>
                                            </strong>
                                            <div class="mb-1" style="text-align: center;">
                                                <div style="position: relative;">
                                                    <img id="struktur_telinga" src="<?= base_url('assets/img/asesmen/tht/struktur_telinga.jpg') ?>" alt="" style="width: 100%; height: auto;">
                                                    <canvas id="canvas_pf_ls_ear" width="400" height="400" style="border: 1px solid #000;position: absolute; top: 0; left: 0;"></canvas>
                                                </div>
                                                <input type="hidden" name="pf_ls_ear" id="pf_ls_ear">
                                            </div>
                                            <div class="col-md-12">
                                                <button id="undo_pf_ls_ear" type="button" onclick="undoPfLsEar()"> Undo</button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>
                                                <p>Struktur Hidung</p>
                                            </strong>
                                            <div class="mb-1" style="text-align: center;">
                                                <div style="position: relative;">
                                                    <img id="struktur_hidung" src="<?= base_url('assets/img/asesmen/tht/struktur_hidung.jpg') ?>" alt="" style="width: 100%; height: auto;">
                                                    <canvas id="canvas_pf_ls_nose" width="400" height="400" style="border: 1px solid #000;position: absolute; top: 0; left: 0;"></canvas>
                                                </div>
                                                <input type="hidden" name="pf_ls_nose" id="pf_ls_nose">
                                            </div>
                                            <!-- <img src="data:image/jpeg;base64,<?= $val['pf_ls_nose']; ?>" width="150px"> -->
                                        </div>
                                        <div class="col-md-3">
                                            <strong>
                                                <p>Struktur Tenggorokan</p>
                                            </strong>
                                            <div class="mb-1" style="text-align: center;">
                                                <div style="position: relative;">
                                                    <img src="<?= base_url('assets/img/asesmen/tht/struktur_tenggorokan.jpg') ?>" alt="" style="width: 100%; height: auto;">
                                                    <canvas id="canvas_pf_ls_throat" width="400" height="400" style="border: 1px solid #000;position: absolute; top: 0; left: 0;"></canvas>
                                                </div>
                                                <input type="hidden" name="pf_ls_throat" id="pf_ls_throat">
                                            </div>
                                            <!-- <img src="data:image/jpeg;base64,<?= $val['pf_ls_throat']; ?>" width="130px"> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>Pemeriksaan Penunjang</h6>
                        <textarea class="form-control" name="v_12" id="v_12" cols="6" rows="2"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>Diagnosis Kerja</h6>
                        <textarea class="form-control" name="v_13" id="v_13" cols="6" rows="2"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>Terapi</h6>
                        <textarea class="form-control" name="v_14" id="v_14" cols="6" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="15%">
                        <h6>RENCANA TINDAK LANJUT</h6>
                    </td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="follow_up_plan" id="follow_up_plan_rj" value="rawat jalan">
                                    <label for="t_03_rj">Rawat Jalan</label>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="follow_up_plan" id="follow_up_plan_ri" value="rawat inap">
                                            <label for="t_03_ri">Rawat Inap, DPJP rawat Inap </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_15" id="v_15">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Ruang</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_16" id="v_16">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <label>Indikasi</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="v_17" id="v_17">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label class="col-form-label">Pengantar Pasien</label>
                            </div>
                            <div class="col-md-7">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_04" id="t_04_ada" value="1">
                                    <label for="t_04_ada">Ada</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="t_04" id="t_04_tidak" value="0">
                                    <label for="t_04_tidak">Tidak (Bila tidak, rujuk ke Dinas Sosial)</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p>Rujuk Ke :</p>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="t_05" id="t_05_rs" value="1">
                                            <label for="t_05_rs">RS</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_18" id="v_18">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="t_05" id="t_05_puskesmas" value="2">
                                            <label for="t_05_puskesmas">Puskesmas</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_19" id="v_19">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_05" id="t_05_homecare" value="3">
                                    <label for="t_05_homecare">Homecare</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="t_05" id="t_05_keluarga" value="4">
                                            <label for="t_05_keluarga">Dokter Keluarga</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_20" id="v_20">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="t_05" id="t_05_dokter" value="5">
                                            <label for="t_05_dokter">Dokter</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_21" id="v_21">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <label for="t_05_klinik">Kontrol Klinik / Homecare </label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="v_22" id="v_22">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label>Tanggal</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input class="form-control" type="date" name="v_23" id="v_23">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>EDUKASI PASIEN</h6>
                    </td>
                    <td>
                        <p>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada :</p>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="t_06" id="t_06_pasien" value="1">
                                <label for="t_06_pasien">Pasien</label>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_06" id="t_06_keluarga" value="2">
                                    <label for="t_06_keluarga">Keluarga Pasien, nama</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_24" id="v_24">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_06" id="t_06_tidak" value="3">
                                    <label for="t_06_tidak">Tidak dapat memberi edukasi kepada pasien atau keluarga, Karena </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-input">
                                    <input class="form-control" type="text" name="v_25" id="v_25">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-enter">
                            <div class="col-md-6 text-center">
                                <p>Dokter</p>
                                <br>
                                <canvas id="canvas" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" id="ttd" name="ttd">
                                <br>
                                <br>
                                <div class="col-sm-6 mx-auto">
                                    <input type="text" class="form-control" id="v_26" name="v_26">
                                </div>
                                <p>TTD dan Nama Terang</p>
                            </div>
                            <div class="col-md-6 text-center align-items-center">
                                <p>Penerima Penjelasan</p>
                                <br>
                                <canvas id="canvas1" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" id="ttd_1" name="ttd_1">
                                <br>
                                <br>
                                <div class="col-sm-6 mx-auto">
                                    <input type="text" class="form-control" id="v_27" name="v_27">
                                </div>
                                <p>TTD dan Nama Terang</p>
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
    <script>
        function undo(drawingHistory, ctx) {
            if (drawingHistory.length > 0) {
                // Remove last drawing operation from history
                drawingHistory.pop();
                // Restore previous state of canvas
                ctx.putImageData(drawingHistory[drawingHistory.length - 1], 0, 0);
            }
        }
    </script>
    <script>
        $("#canvas_pf_ls_ear").width($("#struktur_telinga").width())
        $("#canvas_pf_ls_ear").height($("#struktur_telinga").height())

        const canvas_pf_ls_ear = document.getElementById('canvas_pf_ls_ear');
        const context_pf_ls_ear = canvas_pf_ls_ear.getContext('2d');

        let drawingHistory = []; // Array to store drawing history

        canvas_pf_ls_ear.addEventListener('mousedown', startDrawing);
        canvas_pf_ls_ear.addEventListener('mousemove', draw);
        canvas_pf_ls_ear.addEventListener('mouseup', stopDrawing);

        // document.getElementById('undoButton').addEventListener('click', undo);
        // document.getElementById('clearButton').addEventListener('click', clearCanvas);

        var isDrawing = false;
        var line = []; // Store points for the current line being drawn

        function startDrawing(e) {
            isDrawing = true;
            draw(e)
            line = []; // Clear the current line
            line.push({
                x: e.offsetX,
                y: e.offsetY
            }); // Add the starting point of the line
        }

        function draw(e) {
            if (!isDrawing) return;
            context_pf_ls_ear.lineWidth = 2;
            context_pf_ls_ear.lineCap = 'round';
            context_pf_ls_ear.strokeStyle = '#000';
            const x = e.offsetX;
            const y = e.offsetY;
            context_pf_ls_ear.beginPath();
            context_pf_ls_ear.moveTo(line[line.length - 1].x, line[line.length - 1].y);
            context_pf_ls_ear.lineTo(x, y);
            context_pf_ls_ear.stroke();
            line.push({
                x,
                y
            }); // Add the current point to the line
        }

        function stopDrawing() {
            if (!isDrawing) return;
            isDrawing = false;
            drawingHistory.push(line); // Save the completed line to drawing history
        }

        function undoPfLsEar() {
            if (drawingHistory.length > 0) {
                // Remove the last line from the drawing history
                drawingHistory.pop();
                // Clear the canvas
                context_pf_ls_ear.clearRect(0, 0, canvas_pf_ls_ear.width, canvas_pf_ls_ear.height);
                // Redraw the remaining lines
                // console.log(drawingHistory)
                drawingHistory.forEach(line => {
                    for (let i = 1; i < line.length; i++) {
                        console.log(line[i].x)
                        context_pf_ls_ear.beginPath();
                        context_pf_ls_ear.moveTo(line[i - 1].x, line[i - 1].y);
                        context_pf_ls_ear.lineTo(line[i].x, line[i].y);
                        context_pf_ls_ear.stroke();
                    }
                });
            }
        }

        function clearCanvas() {
            context_pf_ls_ear.clearRect(0, 0, canvas_pf_ls_ear.width, canvas_pf_ls_ear.height);
            drawingHistory = []; // Clear the drawing history
        }
    </script>
    <script>
        $("#canvas_pf_ls_nose").width($("#struktur_hidung").width())
        $("#canvas_pf_ls_nose").height($("#struktur_hidung").height())

        const canvas_pf_ls_nose = document.getElementById('canvas_pf_ls_nose');
        const context_pf_ls_nose = canvas_pf_ls_nose.getContext('2d');

        let drawingHistoryTemplate = []; // Array to store drawing history

        canvas_pf_ls_nose.addEventListener('mousedown', startDrawingNose);
        canvas_pf_ls_nose.addEventListener('mousemove', drawNose);
        canvas_pf_ls_nose.addEventListener('mouseup', stopDrawingNose);

        // document.getElementById('undoButton').addEventListener('click', undo);
        // document.getElementById('clearButton').addEventListener('click', clearCanvas);

        var isDrawingNose = false;
        var lineNose = []; // Store points for the current line being drawn

        function startDrawingNose(e) {
            isDrawingNose = true;
            drawNose(e)
            lineNose = []; // Clear the current line
            lineNose.push({
                x: e.offsetX,
                y: e.offsetY
            }); // Add the starting point of the line
        }

        function drawNose(e) {
            if (!isDrawingNose) return;
            context_pf_ls_nose.lineWidth = 2;
            context_pf_ls_nose.lineCap = 'round';
            context_pf_ls_nose.strokeStyle = '#000';
            const x = e.offsetX;
            const y = e.offsetY;
            context_pf_ls_nose.beginPath();
            context_pf_ls_nose.moveTo(lineNose[lineNose.length - 1].x, lineNose[lineNose.length - 1].y);
            context_pf_ls_nose.lineTo(x, y);
            context_pf_ls_nose.stroke();
            lineNose.push({
                x,
                y
            }); // Add the current point to the line
        }

        function stopDrawingNose() {
            if (!isDrawingNose) return;
            isDrawingNose = false;
            drawingHistoryTemplate.push(lineNose); // Save the completed line to drawing history
        }

        function undoPfLsNose() {
            if (drawingHistoryTemplate.length > 0) {
                // Remove the last line from the drawing history
                drawingHistoryTemplate.pop();
                // Clear the canvas
                context_pf_ls_nose.clearRect(0, 0, canvas_pf_ls_nose.width, canvas_pf_ls_nose.height);
                // Redraw the remaining lines
                // console.log(drawingHistoryTemplate)
                drawingHistoryTemplate.forEach(line => {
                    for (let i = 1; i < lineNose.length; i++) {
                        console.log(lineNose[i].x)
                        context_pf_ls_nose.beginPath();
                        context_pf_ls_nose.moveTo(lineNose[i - 1].x, lineNose[i - 1].y);
                        context_pf_ls_nose.lineTo(lineNose[i].x, lineNose[i].y);
                        context_pf_ls_nose.stroke();
                    }
                });
            }
        }

        function clearCanvasNose() {
            context_pf_ls_nose.clearRect(0, 0, canvas_pf_ls_nose.width, canvas_pf_ls_nose.height);
            drawingHistoryTemplate = []; // Clear the drawing history
        }
    </script>
    <!-- <script>
        let drawingHistory_pf_ls_ear = [];
        var canvas_pf_ls_ear = document.getElementById('canvas_pf_ls_ear');
        const input_pf_ls_ear = document.getElementById('pf_ls_ear');
        var context_pf_ls_ear = canvas_pf_ls_ear.getContext('2d');

        let isDrawing = false;
        let line = []; // Store points for the current line being drawn

        canvas_pf_ls_ear.addEventListener('mousedown', startDrawing);
        canvas_pf_ls_ear.addEventListener('mousemove', draw);
        canvas_pf_ls_ear.addEventListener('mouseup', stopDrawing);
        canvas_pf_ls_ear.addEventListener('mouseout', stopDrawing);

        function startDrawing(e) {
            drawing = true;
            draw(e);
            [lastX, lastY] = [e.offsetX, e.offsetY];
            line = []; // Clear the current line
            line.push({
                x: e.offsetX,
                y: e.offsetY
            });
        }

        function draw(e) {
            if (!drawing) return;
            const x = e.offsetX;
            const y = e.offsetY;
            context_pf_ls_ear.lineWidth = 2;
            context_pf_ls_ear.lineCap = 'round';
            context_pf_ls_ear.strokeStyle = '#000';

            context_pf_ls_ear.beginPath();
            context_pf_ls_ear.moveTo(line[line.length - 1].x, line[line.length - 1].y);
            context_pf_ls_ear.lineTo(x, y);
            context_pf_ls_ear.stroke();
            line.push({
                x,
                y
            }); // Add the current point to the line


            // context_pf_ls_ear.lineWidth = 2;
            // context_pf_ls_ear.lineCap = 'round';
            // context_pf_ls_ear.strokeStyle = '#000';

            // // Draw a line
            // context_pf_ls_ear.beginPath();
            // context_pf_ls_ear.moveTo(lastX, lastY);
            // context_pf_ls_ear.lineTo(e.offsetX, e.offsetY);
            // // context_pf_ls_ear.moveTo(e.clientX - canvas_pf_ls_ear.getBoundingClientRect().left, e.clientY - canvas_pf_ls_ear.getBoundingClientRect().top);
            // // context_pf_ls_ear.lineTo(e.clientX - canvas_pf_ls_ear.getBoundingClientRect().left, e.clientY - canvas_pf_ls_ear.getBoundingClientRect().top);
            // context_pf_ls_ear.stroke();
            // [lastX, lastY] = [e.offsetX, e.offsetY];

            drawingHistory_pf_ls_ear.push(context_pf_ls_ear.getImageData(0, 0, canvas_pf_ls_ear.width, canvas_pf_ls_ear.height));
        }

        function stopDrawing() {
            if (!drawing) return;
            drawing = false;
            drawingHistory_pf_ls_ear.push(line);
        }

        function savePfLsEar() {
            const canvasData = canvas_pf_ls_ear.toDataURL('image/png');
            input_pf_ls_ear.value = canvasData;
        }

        function undoPfLsEar() {
            if (drawingHistory_pf_ls_ear.length > 0) {
                // Remove the last line from the drawing history
                drawingHistory_pf_ls_ear.pop();
                // Clear the canvas
                clearCanvasPfLsEar();
                // Redraw the remaining lines
                drawingHistory_pf_ls_ear.forEach(line => {
                    for (let i = 1; i < line.length; i++) {
                        context_pf_ls_ear.beginPath();
                        context_pf_ls_ear.moveTo(line[i - 1].x, line[i - 1].y);
                        context_pf_ls_ear.lineTo(line[i].x, line[i].y);
                        context_pf_ls_ear.stroke();
                    }
                });
            }
        }

        function clearCanvasPfLsEar() {
            context_pf_ls_ear.clearRect(0, 0, canvas_pf_ls_ear.width, canvas_pf_ls_ear.height);
            drawingHistory_pf_ls_ear = []; // Clear the drawing history
        }
    </script> -->

    <script>
        var canvas = document.getElementById('ttd');
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
        $(document).ready(function() {
            <?php if (isset($val)) {
            ?>
                if ("<?= $val['body_id']; ?>" != null && "<?= $val['body_id']; ?>" != '') {
                    $("#body_id").val("<?= $val['body_id']; ?>")
                    $("#org_unit_code").val("<?= $val['org_unit_code']; ?>")
                    $("#pasien_diagnosa_id").val("<?= $val['pasien_diagnosa_id']; ?>")
                    $("#diagnosa_id").val("<?= $val['diagnosa_id']; ?>")
                    $("#no_registration").val("<?= $val['no_registration']; ?>")
                    $("#visit_id").val("<?= $val['visit_id']; ?>")
                    $("#bill_id").val("<?= $val['bill_id']; ?>")
                    $("#clinic_id").val("<?= $val['clinic_id']; ?>")
                    $("#class_room_id").val("<?= $val['class_room_id']; ?>")
                    $("#in_date").val("<?= $val['in_date']; ?>")
                    $("#exit_date").val("<?= $val['exit_date']; ?>")
                    $("#keluar_id").val("<?= $val['keluar_id']; ?>")
                    $("#examination_date").val("<?= $val['examination_date']; ?>")
                    $("#employee_id").val("<?= $val['employee_id']; ?>")
                    $("#description").val("<?= $val['description']; ?>")
                    $("#modified_date").val("<?= $val['modified_date']; ?>")
                    $("#modified_by").val("<?= $val['modified_by']; ?>")
                    $("#modified_from").val("<?= $val['modified_from']; ?>")
                    $("#status_pasien_id").val("<?= $val['status_pasien_id']; ?>")
                    $("#ageyear").val("<?= $val['ageyear']; ?>")
                    $("#agemonth").val("<?= $val['agemonth']; ?>")
                    $("#ageday").val("<?= $val['ageday']; ?>")
                    $("#thename").val("<?= $val['thename']; ?>")
                    $("#theaddress").val("<?= $val['theaddress']; ?>")
                    $("#theid").val("<?= $val['theid']; ?>")
                    $("#isrj").val("<?= $val['isrj']; ?>")
                    $("#gender").val("<?= $val['gender']; ?>")
                    $("#doctor").val("<?= $val['doctor']; ?>")
                    $("#kal_id").val("<?= $val['kal_id']; ?>")
                    $("#petugas_id").val("<?= $val['petugas_id']; ?>")
                    $("#petugas").val("<?= $val['petugas']; ?>")
                    $("#account_id").val("<?= $val['account_id']; ?>")
                    $("#cpoe_emr_rel_id").val("<?= $val['cpoe_emr_rel_id']; ?>")
                    $("#cpoe_id").val("<?= $val['cpoe_id']; ?>")
                    $("#episode_categ").val("<?= $val['episode_categ']; ?>")
                    $("#date_order").val("<?= $val['date_order']; ?>")
                    $("#patient_id").val("<?= $val['patient_id']; ?>")
                    $("#patient_code").val("<?= $val['patient_code']; ?>")
                    $("#patient_age").val("<?= $val['patient_age']; ?>")
                    $("#patient_gender").val("<?= $val['patient_gender']; ?>")
                    $("#colorbar").val("<?= $val['colorbar']; ?>")
                    $("#physician_id").val("<?= $val['physician_id']; ?>")
                    $("#physician_speciality").val("<?= $val['physician_speciality']; ?>")
                    $("#payment_method").val("<?= $val['payment_method']; ?>")
                    $("#pricelist_id").val("<?= $val['pricelist_id']; ?>")
                    $("#currency_id").val("<?= $val['currency_id']; ?>")
                    $("#is_out_cppt").val("<?= $val['is_out_cppt']; ?>")
                    $("#soap_subjective").val("<?= $val['soap_subjective']; ?>")
                    $("#soap_objective").val("<?= $val['soap_objective']; ?>")
                    $("#ana_main_complaint").val("<?= $val['ana_main_complaint']; ?>")
                    $("#ana_auto_current_disease_history").val("<?= $val['ana_auto_current_disease_history']; ?>")
                    $("#ana_past_disease_history").val("<?= $val['ana_past_disease_history']; ?>")
                    $("#ana_family_disease_history").val("<?= $val['ana_family_disease_history']; ?>")
                    $("#ana_allergy_history_non_drugs").val("<?= $val['ana_allergy_history_non_drugs']; ?>")
                    $("#ana_allergy_history_drugs").val("<?= $val['ana_allergy_history_drugs']; ?>")
                    $("#ana_pregnancy_childbirth_history").val("<?= $val['ana_pregnancy_childbirth_history']; ?>")
                    $("#ana_diet_history").val("<?= $val['ana_diet_history']; ?>")
                    $("#ana_imun_history").val("<?= $val['ana_imun_history']; ?>")
                    $("#ana_drugs_consumed").val("<?= $val['ana_drugs_consumed']; ?>")
                    $("#pf_vital_sign_bp").val("<?= $val['pf_vital_sign_bp']; ?>")
                    $("#pf_vital_sign_n").val("<?= $val['pf_vital_sign_n']; ?>")
                    $("#pf_vital_sign_s").val("<?= $val['pf_vital_sign_s']; ?>")
                    $("#pf_vital_sign_rr").val("<?= $val['pf_vital_sign_rr']; ?>")
                    $("#pf_vital_sign_weight").val("<?= $val['pf_vital_sign_weight']; ?>")
                    $("#pf_vital_sign_height").val("<?= $val['pf_vital_sign_height']; ?>")
                    $("#pf_vital_sign_spo2").val("<?= $val['pf_vital_sign_spo2']; ?>")
                    $("#pf_vital_sign_bmi").val("<?= $val['pf_vital_sign_bmi']; ?>")
                    $("#pf_gcs_type").val("<?= $val['pf_gcs_type']; ?>")
                    $("#pf_gcs_e").val("<?= $val['pf_gcs_e']; ?>")
                    $("#pf_gcs_v").val("<?= $val['pf_gcs_v']; ?>")
                    $("#pf_gcs_m").val("<?= $val['pf_gcs_m']; ?>")
                    $("#pf_pgcs_e").val("<?= $val['pf_pgcs_e']; ?>")
                    $("#pf_pgcs_v_type").val("<?= $val['pf_pgcs_v_type']; ?>")
                    $("#pf_pgcs_v").val("<?= $val['pf_pgcs_v']; ?>")
                    $("#pf_pgcs_v_non").val("<?= $val['pf_pgcs_v_non']; ?>")
                    $("#pf_pgcs_m").val("<?= $val['pf_pgcs_m']; ?>")
                    $("#pf_general_condition").val("<?= $val['pf_general_condition']; ?>")
                    $("#pf_cranium").val("<?= $val['pf_cranium']; ?>")
                    $("#pf_eyes").val("<?= $val['pf_eyes']; ?>")
                    $("#pf_nose").val("<?= $val['pf_nose']; ?>")
                    $("#pf_mouth").val("<?= $val['pf_mouth']; ?>")
                    $("#pf_tooth").val("<?= $val['pf_tooth']; ?>")
                    $("#pf_neck").val("<?= $val['pf_neck']; ?>")
                    $("#pf_thorax").val("<?= $val['pf_thorax']; ?>")
                    $("#pf_thorax_image").val("<?= $val['pf_thorax_image']; ?>")
                    $("#pf_heart").val("<?= $val['pf_heart']; ?>")
                    $("#pf_heart_image").val("<?= $val['pf_heart_image']; ?>")
                    $("#pf_lungs").val("<?= $val['pf_lungs']; ?>")
                    $("#pf_abdomen").val("<?= $val['pf_abdomen']; ?>")
                    $("#pf_abdomen_image").val("<?= $val['pf_abdomen_image']; ?>")
                    $("#pf_hepar").val("<?= $val['pf_hepar']; ?>")
                    $("#pf_lien").val("<?= $val['pf_lien']; ?>")
                    $("#pf_kidney").val("<?= $val['pf_kidney']; ?>")
                    $("#pf_genitalia").val("<?= $val['pf_genitalia']; ?>")
                    $("#pf_upper_extremity").val("<?= $val['pf_upper_extremity']; ?>")
                    $("#pf_lower_extremity").val("<?= $val['pf_lower_extremity']; ?>")
                    $("#pf_ls_ear").val("<?= $val['pf_ls_ear']; ?>")
                    $("#pf_ls_nose").val("<?= $val['pf_ls_nose']; ?>")
                    $("#pf_ls_throat").val("<?= $val['pf_ls_throat']; ?>")
                    $("#cause_of_injury_poisoning").val("<?= $val['cause_of_injury_poisoning']; ?>")
                    $("#nursing_problem").val("<?= $val['nursing_problem']; ?>")
                    $("#medical_problem").val("<?= $val['medical_problem']; ?>")
                    $("#care_and_therapy_plan").val("<?= $val['care_and_therapy_plan']; ?>")
                    $("#follow_up_plan").val("<?= $val['follow_up_plan']; ?>")
                    $("#rtj_control").val("<?= $val['rtj_control']; ?>")
                    $("#rtj_time_of_death_emergency").val("<?= $val['rtj_time_of_death_emergency']; ?>")
                    $("#rtj_inpatient_indication").val("<?= $val['rtj_inpatient_indication']; ?>")
                    $("#rtj_inpatient_dpjp").val("<?= $val['rtj_inpatient_dpjp']; ?>")
                    $("#rtj_inpatient_classes").val("<?= $val['rtj_inpatient_classes']; ?>")
                    $("#rtj_inpatient_ward").val("<?= $val['rtj_inpatient_ward']; ?>")
                    $("#rtj_inpatient_room").val("<?= $val['rtj_inpatient_room']; ?>")
                    $("#rtj_inpatient_bed").val("<?= $val['rtj_inpatient_bed']; ?>")
                    $("#rtj_referenced").val("<?= $val['rtj_referenced']; ?>")
                    $("#rtj_referenced_to").val("<?= $val['rtj_referenced_to']; ?>")
                    $("#rtj_referenced_phys").val("<?= $val['rtj_referenced_phys']; ?>")
                    $("#rtj_referenced_based_on").val("<?= $val['rtj_referenced_based_on']; ?>")
                    $("#rtj_referenced_deliver_by").val("<?= $val['rtj_referenced_deliver_by']; ?>")
                    $("#patient_education").val("<?= $val['patient_education']; ?>")
                    $("#if_patient_family").val("<?= $val['if_patient_family']; ?>")
                    $("#if_can_not_give_edu").val("<?= $val['if_can_not_give_edu']; ?>")
                    $("#explanation_receipient_name").val("<?= $val['explanation_receipient_name']; ?>")
                    $("#doctor_name").val("<?= $val['doctor_name']; ?>")
                    $("#paraf_doctor").val("<?= $val['paraf_doctor']; ?>")
                    $("#episode_id").val("<?= $val['episode_id']; ?>")
                    $("#app_nmbr").val("<?= $val['app_nmbr']; ?>")
                    $("#code").val("<?= $val['code']; ?>")
                    $("#proc_order_id").val("<?= $val['proc_order_id']; ?>")
                    $("#open_header_flag").val("<?= $val['open_header_flag']; ?>")
                    $("#hide_action_button").val("<?= $val['hide_action_button']; ?>")
                    $("#lab_order_id").val("<?= $val['lab_order_id']; ?>")
                    $("#physio_order_id").val("<?= $val['physio_order_id']; ?>")
                    $("#radio_order_id").val("<?= $val['radio_order_id']; ?>")
                    $("#is_cppt_leads").val("<?= $val['is_cppt_leads']; ?>")
                    $("#refphysician_id").val("<?= $val['refphysician_id']; ?>")
                    $("#inpatient_physician_speciality").val("<?= $val['inpatient_physician_speciality']; ?>")
                    $("#is_fast_track").val("<?= $val['is_fast_track']; ?>")
                    $("#is_cito").val("<?= $val['is_cito']; ?>")
                    $("#is_rad_pending").val("<?= $val['is_rad_pending']; ?>")
                    $("#rad_pending_order").val("<?= $val['rad_pending_order']; ?>")
                    $("#is_lab_pending").val("<?= $val['is_lab_pending']; ?>")
                    $("#lab_pending_order").val("<?= $val['lab_pending_order']; ?>")
                    $("#is_phy_pending").val("<?= $val['is_phy_pending']; ?>")
                    $("#phy_pending_order").val("<?= $val['phy_pending_order']; ?>")
                    $("#has_drug_allergy").val("<?= $val['has_drug_allergy']; ?>")
                    $("#state").val("<?= $val['state']; ?>")
                    $("#standing_order").val("<?= $val['standing_order']; ?>")
                    $("#is_locked").val("<?= $val['is_locked']; ?>")
                    $("#text_diagnosis").val("<?= $val['text_diagnosis']; ?>")
                    $("#is_signed").val("<?= $val['is_signed']; ?>")
                    $("#last_notebook").val("<?= $val['last_notebook']; ?>")
                    $("#inv_vendor_lab_id").val("<?= $val['inv_vendor_lab_id']; ?>")
                    $("#lab_medical_checkup").val("<?= $val['lab_medical_checkup']; ?>")
                    $("#inv_vendor_radio_id").val("<?= $val['inv_vendor_radio_id']; ?>")
                    $("#inv_vendor_phy_id").val("<?= $val['inv_vendor_phy_id']; ?>")
                    $("#inv_vendor_id").val("<?= $val['inv_vendor_id']; ?>")
                    $("#inv_vendor_nurse_id").val("<?= $val['inv_vendor_nurse_id']; ?>")
                    $("#inv_vendor_midwife_id").val("<?= $val['inv_vendor_midwife_id']; ?>")
                    $("#has_pain_scale").val("<?= $val['has_pain_scale']; ?>")
                    $("#pain_scale_type").val("<?= $val['pain_scale_type']; ?>")
                    $("#numeric_scale").val("<?= $val['numeric_scale']; ?>")
                    $("#wong_baker_scale").val("<?= $val['wong_baker_scale']; ?>")
                    $("#cpot_ekspresi_wajah").val("<?= $val['cpot_ekspresi_wajah']; ?>")
                    $("#cpot_gerakan_tubuh").val("<?= $val['cpot_gerakan_tubuh']; ?>")
                    $("#cpot_options").val("<?= $val['cpot_options']; ?>")
                    $("#cpot_aktivasi_ventilator").val("<?= $val['cpot_aktivasi_ventilator']; ?>")
                    $("#cpot_berbicara").val("<?= $val['cpot_berbicara']; ?>")
                    $("#cpot_ketegangan_otot").val("<?= $val['cpot_ketegangan_otot']; ?>")
                    $("#nips_ekspresi_wajah").val("<?= $val['nips_ekspresi_wajah']; ?>")
                    $("#nips_tangisan").val("<?= $val['nips_tangisan']; ?>")
                    $("#nips_pola_nafas").val("<?= $val['nips_pola_nafas']; ?>")
                    $("#nips_tungkai").val("<?= $val['nips_tungkai']; ?>")
                    $("#nips_tingkat_kesadaran").val("<?= $val['nips_tingkat_kesadaran']; ?>")
                    $("#painad_pernafasan").val("<?= $val['painad_pernafasan']; ?>")
                    $("#painad_vokalisasi_negatif").val("<?= $val['painad_vokalisasi_negatif']; ?>")
                    $("#painad_ekspresi_wajah").val("<?= $val['painad_ekspresi_wajah']; ?>")
                    $("#painad_bahasa_tubuh").val("<?= $val['painad_bahasa_tubuh']; ?>")
                    $("#painad_konsabilitas").val("<?= $val['painad_konsabilitas']; ?>")
                    $("#flacc_wajah").val("<?= $val['flacc_wajah']; ?>")
                    $("#flacc_kaki").val("<?= $val['flacc_kaki']; ?>")
                    $("#flacc_aktivitas").val("<?= $val['flacc_aktivitas']; ?>")
                    $("#flacc_menangis").val("<?= $val['flacc_menangis']; ?>")
                    $("#flacc_konsabilitas").val("<?= $val['flacc_konsabilitas']; ?>")
                    $("#has_fall_risk").val("<?= $val['has_fall_risk']; ?>")
                    $("#fall_risk_desc").val("<?= $val['fall_risk_desc']; ?>")
                    $("#fall_risk_type").val("<?= $val['fall_risk_type']; ?>")
                    $("#hd_usia").val("<?= $val['hd_usia']; ?>")
                    $("#hd_jenis_kelamin").val("<?= $val['hd_jenis_kelamin']; ?>")
                    $("#hd_diagnosa").val("<?= $val['hd_diagnosa']; ?>")
                    $("#hd_gangguan_kognitif").val("<?= $val['hd_gangguan_kognitif']; ?>")
                    $("#hd_faktor_lingkungan").val("<?= $val['hd_faktor_lingkungan']; ?>")
                    $("#hd_respon_pembedahan_sedasi_anestesi").val("<?= $val['hd_respon_pembedahan_sedasi_anestesi']; ?>")
                    $("#hd_respon_penggunaan_medikamentosa").val("<?= $val['hd_respon_penggunaan_medikamentosa']; ?>")
                    $("#fm_riwayat_jatuh").val("<?= $val['fm_riwayat_jatuh']; ?>")
                    $("#fm_diagnosis_sekunder").val("<?= $val['fm_diagnosis_sekunder']; ?>")
                    $("#fm_menggunakan_alat_bantu").val("<?= $val['fm_menggunakan_alat_bantu']; ?>")
                    $("#fm_menggunakan_infuse_heparine").val("<?= $val['fm_menggunakan_infuse_heparine']; ?>")
                    $("#fm_gaya_berjalan").val("<?= $val['fm_gaya_berjalan']; ?>")
                    $("#fm_status_mental").val("<?= $val['fm_status_mental']; ?>")
                    $("#fm_medikasi").val("<?= $val['fm_medikasi']; ?>")
                    $("#note_subjective").val("<?= $val['note_subjective']; ?>")
                    $("#note_objective").val("<?= $val['note_objective']; ?>")
                    $("#note_obat_confirmed").val("<?= $val['note_obat_confirmed']; ?>")
                    $("#note_lab_confirmed").val("<?= $val['note_lab_confirmed']; ?>")
                    $("#note_rad_confirmed").val("<?= $val['note_rad_confirmed']; ?>")
                    $("#note_phy_confirmed").val("<?= $val['note_phy_confirmed']; ?>")
                    $("#note_proc_confirmed").val("<?= $val['note_proc_confirmed']; ?>")
                    $("#additional_note").val("<?= $val['additional_note']; ?>")
                    $("#final_note").val("<?= $val['final_note']; ?>")
                    $("#create_uid").val("<?= $val['create_uid']; ?>")
                    $("#create_date").val("<?= $val['create_date']; ?>")
                    $("#write_uid").val("<?= $val['write_uid']; ?>")
                    $("#write_date").val("<?= $val['write_date']; ?>")
                    $("#patient_family_name").val("<?= $val['patient_family_name']; ?>")
                    $("#is_applicant_signed").val("<?= $val['is_applicant_signed']; ?>")
                    $("#applicant_sign").val("<?= $val['applicant_sign']; ?>")
                    $("#rtj_inpatient_location").val("<?= $val['rtj_inpatient_location']; ?>")
                    $("#rtj_referenced_dept").val("<?= $val['rtj_referenced_dept']; ?>")
                    $("#rtj_inpatient_standing_order").val("<?= $val['rtj_inpatient_standing_order']; ?>")
                    $("#rtj_is_control").val("<?= $val['rtj_is_control']; ?>")
                    $("#rtj_control_date").val("<?= $val['rtj_control_date']; ?>")
                    $("#rtj_control_reason").val("<?= $val['rtj_control_reason']; ?>")
                    $("#rtj_outpatient_type").val("<?= $val['rtj_outpatient_type']; ?>")
                    $("#rtj_referenced_based_other").val("<?= $val['rtj_referenced_based_other']; ?>")
                    $("#rtj_rujuk_type").val("<?= $val['rtj_rujuk_type']; ?>")
                    $("#pf_ears").val("<?= $val['pf_ears']; ?>")
                    $("#coass_residence_sign").val("<?= $val['coass_residence_sign']; ?>")
                    $("#is_coas_signed").val("<?= $val['is_coas_signed']; ?>")
                    $("#coas_signed_datetime").val("<?= $val['coas_signed_datetime']; ?>")
                    $("#month_count").val("<?= $val['month_count']; ?>")
                    $("#rtj_internal_ref_pysician_id").val("<?= $val['rtj_internal_ref_pysician_id']; ?>")
                    $("#rtj_internal_ref_notes").val("<?= $val['rtj_internal_ref_notes']; ?>")
                    $("#soap_planning").val("<?= $val['soap_planning']; ?>")
                    $("#is_consul_discount").val("<?= $val['is_consul_discount']; ?>")
                    $("#sign_datetime").val("<?= $val['sign_datetime']; ?>")
                    $("#pf_ls_eardrum").val("<?= $val['pf_ls_eardrum']; ?>")
                    $("#pf_ls_ear_desc").val("<?= $val['pf_ls_ear_desc']; ?>")
                    $("#pf_ls_nose_desc").val("<?= $val['pf_ls_nose_desc']; ?>")
                    $("#pf_ls_throat_desc").val("<?= $val['pf_ls_throat_desc']; ?>")
                    $("#clinical_indication").val("<?= $val['clinical_indication']; ?>")
                    $("#target_of_therapy").val("<?= $val['target_of_therapy']; ?>")
                    $("#rtj_out_instruction").val("<?= $val['rtj_out_instruction']; ?>")
                    $("#set_all_dbn").val("<?= $val['set_all_dbn']; ?>")
                    $("#education_material").val("<?= $val['education_material']; ?>")
                    $("#outer_ear").val("<?= $val['outer_ear']; ?>")
                    $("#earlobe").val("<?= $val['earlobe']; ?>")
                    $("#ear_canal").val("<?= $val['ear_canal']; ?>")
                    $("#middle_ear").val("<?= $val['middle_ear']; ?>")
                    $("#tympanic_membrane").val("<?= $val['tympanic_membrane']; ?>")
                    $("#audiometry").val("<?= $val['audiometry']; ?>")
                    $("#outer_cavum_nasi").val("<?= $val['outer_cavum_nasi']; ?>")
                    $("#inner_cavum_nasi").val("<?= $val['inner_cavum_nasi']; ?>")
                    $("#concae").val("<?= $val['concae']; ?>")
                    $("#septum_nasi").val("<?= $val['septum_nasi']; ?>")
                    $("#concae_inferior").val("<?= $val['concae_inferior']; ?>")
                    $("#tonsil").val("<?= $val['tonsil']; ?>")
                    $("#farinx_posterior_region").val("<?= $val['farinx_posterior_region']; ?>")
                    $("#epiglottis").val("<?= $val['epiglottis']; ?>")
                    $("#larinx").val("<?= $val['larinx']; ?>")
                    $("#vocal_cords").val("<?= $val['vocal_cords']; ?>")
                    $("#message_main_attachment_id").val("<?= $val['message_main_attachment_id']; ?>")
                    $("#rtj_inpatient_service_needs").val("<?= $val['rtj_inpatient_service_needs']; ?>")
                    $("#trial118").val("<?= $val['trial118']; ?>")
                    $("input").prop("disabled", true);
                    $("textarea").prop("disabled", true);

                    // const img = new Image();
                    // img.onload = function() {
                    //     context_pf_ls_ear.drawImage(img, 0, 0, canvas_pf_ls_ear.width, canvas_pf_ls_ear.height);
                    // };
                    // img.src = "data:image/png;base64,<?= $val['doctor_name']; ?>";
                    // const img1 = new Image();
                    // img1.onload = function() {
                    //     context1.drawImage(img1, 0, 0, canvas1.width, canvas1.height);
                    // };
                    // img1.src = "data:image/png;base64,<?= $val['paraf_doctor']; ?>";
                } else {
                    $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
                    // $("#pasien_diagnosa_id").val("<?= $val['pasien_diagnosa_id']; ?>")
                    // $("#diagnosa_id").val("<?= $val['diagnosa_id']; ?>")
                    $("#no_registration").val("<?= $visit['no_registration']; ?>")
                    $("#visit_id").val("<?= $visit['visit_id']; ?>")
                    // $("#bill_id").val("<?= $val['bill_id']; ?>")
                    $("#clinic_id").val("<?= $visit['clinic_id']; ?>")
                    $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
                    $("#in_date").val("<?= $visit['in_date']; ?>")
                    $("#exit_date").val("<?= $visit['exit_date']; ?>")
                    $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
                    <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
                    ?>
                    $("#examination_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
                    $("#employee_id").val("<?= $visit['employee_id']; ?>")
                    $("#description").val("<?= $visit['description']; ?>")
                    $("#modified_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
                    $("#modified_by").val("<?= user()->username; ?>")
                    $("#modified_from").val("<?= $visit['clinic_id']; ?>")
                    $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
                    $("#ageyear").val("<?= $visit['ageyear']; ?>")
                    $("#agemonth").val("<?= $visit['agemonth']; ?>")
                    $("#ageday").val("<?= $visit['ageday']; ?>")
                    $("#thename").val("<?= $visit['diantar_oleh']; ?>")
                    $("#theaddress").val("<?= $visit['visitor_address']; ?>")
                    $("#theid").val("<?= $visit['pasien_id']; ?>")
                    $("#isrj").val("<?= $visit['isrj']; ?>")
                    $("#gender").val("<?= $visit['gender']; ?>")
                    $("#doctor").val("<?= $visit['employee_id']; ?>")
                    $("#kal_id").val("<?= $visit['kal_id']; ?>")
                    $("#petugas_id").val("<?= user()->username; ?>")
                    $("#petugas").val("<?= user()->fullname; ?>")
                    $("#account_id").val("<?= $visit['account_id']; ?>")
                }
            <?php
            } else { ?>
                $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
                $("#no_registration").val("<?= $visit['no_registration']; ?>")
                $("#visit_id").val("<?= $visit['visit_id']; ?>")
                $("#clinic_id").val("<?= $visit['clinic_id']; ?>")
                $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
                $("#in_date").val("<?= $visit['in_date']; ?>")
                $("#exit_date").val("<?= $visit['exit_date']; ?>")
                $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
                ?>
                $("#examination_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
                $("#employee_id").val("<?= $visit['employee_id']; ?>")
                $("#description").val("<?= $visit['description']; ?>")
                $("#modified_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
                $("#modified_by").val("<?= user()->username; ?>")
                $("#modified_from").val("<?= $visit['clinic_id']; ?>")
                $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
                $("#ageyear").val("<?= $visit['ageyear']; ?>")
                $("#agemonth").val("<?= $visit['agemonth']; ?>")
                $("#ageday").val("<?= $visit['ageday']; ?>")
                $("#thename").val("<?= $visit['diantar_oleh']; ?>")
                $("#theaddress").val("<?= $visit['visitor_address']; ?>")
                $("#theid").val("<?= $visit['pasien_id']; ?>")
                $("#isrj").val("<?= $visit['isrj']; ?>")
                $("#gender").val("<?= $visit['gender']; ?>")
                $("#doctor").val("<?= $visit['employee_id']; ?>")
                $("#kal_id").val("<?= $visit['kal_id']; ?>")
                $("#petugas_id").val("<?= user()->username; ?>")
                $("#petugas").val("<?= user()->fullname; ?>")
                $("#account_id").val("<?= $visit['account_id']; ?>")
            <?php } ?>
        })
        $("#btnSimpan").on("click", function() {
            saveSignatureData()
            saveSignatureData1()
            console.log($("#TTD").val())
            $("#form").submit()
        })
        $("#btnEdit").on("click", function() {
            $("input").prop("disabled", false);
            $("textarea").prop("disabled", false);

        })
    </script>
</body>



</html>
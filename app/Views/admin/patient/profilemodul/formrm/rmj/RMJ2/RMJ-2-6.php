<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RMJ 2.6 ASSESMEN MEDIS PASIEN SARAF</title>
    <!-- 
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/jquery.mCustomScrollbar.min.css"> -->

    <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/datepicker/date.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>
</head>

<body>
    <form id="form" action="/admin/rekammedis/rmj2_6/ <?= base64_encode(json_encode($visit)); ?>" method="POST">
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

        <div class="container mt-3">
            <br>
            <h5 style="text-align: right;"><b>RMJ.2.6</b></h5>

            <br><br>
            <h6 style="text-align: center;"><b>REKAM MEDIS RAWAT JALAN</b></h6>
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
                                <div class="col-sm-8">
                                    <input type="datetime-local" class="form-control" id="examination_date" name="examination_date">
                                </div>
                                <div class="col-sm-1"></div>
                                <!-- <label class="col-sm-1 col-form-label">Jam :</label>
                                <div class="col-sm-4">
                                    <input type="time" class="form-control" id="" name="">
                                </div> -->
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Riwayat Alergi :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="ana_imun_history" name="ana_imun_history" rows="4" cols="7"></textarea>
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
                                                    <input type="radio" class="form-check-input" name="" id="" value="1">
                                                    <strong><label for="">Anamnesa</label></strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="radio" class="form-check-input" name="" id="" value="2">
                                                    <strong><label for="">Alloanamnesis*</label></strong>
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
                                            <input class="form-control" type="text" name="" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label>Hubungan dengan pasien</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="" id="">
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
                                                <input class="form-control" type="text" name="ana_main_complaint" id="ana_main_complaint">
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
                                                        <label>Alloanamnesis* dengan</label>
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
                                                <label><b>Riwayat Penyakit Dahulu</b></label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="ana_past_desease_history" id="ana_past_desease_history" cols="6" rows="2"></textarea>
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
                                            <input type="text" class="form-control" id="ana_allergy_history_non_drugs" name="ana_allergy_history_non_drugs" style="width: 900px">
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
                                        <input type="text" class="form-control" id="ana_allergy_history_drugs" name="ana_allergy_history_drugs" style="width: 900px">
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
                                        <input type="text" class="form-control" name="pf_vital_sign_bp" id="pf_vital_sign_bp">
                                        <!-- <span class="input-group-text">/</span>
                                        <input type="text" class="form-control" name="" id=""> -->
                                        <span class="input-group-text">mmHg</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">N</span>
                                        <input type="text" class="form-control" id="pf_vital_sign_n" name="pf_vital_sign_n">
                                        <span class="input-group-text">x/menit</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 200px">
                                        <span class="input-group-text">R</span>
                                        <input type="text" class="form-control" id="pf_vital_sign_rr" name="pf_vital_sign_rr">
                                        <span class="input-group-text">x/menit</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3" style="width: 150px">
                                        <span class="input-group-text">S</span>
                                        <input type="text" class="form-control" id="pf_vital_sign_s" name="pf_vital_sign_s">
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
                                            <input type="text" class="form-control" id="pf_cranium" name="pf_cranium" style="width: 900px">
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
                                            <input type="text" class="form-control" id="pf_neck" name="pf_neck" style="width: 900px">
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
                                            <input type="text" class="form-control" id="pf_thorax" name="pf_thorax" style="width: 900px">
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
                                            <input type="text" class="form-control" id="pf_abdomen" name="pf_abdomen" style="width: 900px">
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
                                            <input type="text" class="form-control" id="pf_genitalia" name="pf_genitalia" style="width: 900px">
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
                                            <input type="text" class="form-control" id="pf_upper_extremity" name="pf_upper_extremity" style="width: 850px">
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
                                            <input type="text" class="form-control" id="pf_lower_extremity" name="pf_lower_extremity" style="width: 850px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div><label><b>Pemeriksaan Neurologis :</b></label></div>
                            Kondisi Umum :<input type="text" id="general_condition" name="general_condition">
                            GCS :<input type="text" id="gcs" name="gcs">
                            VAS / NRS :<input type="text" id="vas_nrs" name="vas_nrs">
                            <div class="mb-3">
                                <label>• Kepala </label>
                            </div>
                            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                                <tbody>
                                    <tr>
                                        <td>Pupil</td>
                                        <td>Diameter : <input type="text" id="left_diameter" name="left_diameter"> / <input type="text" id="right_diameter" name="right_diameter"></td>
                                        <td>
                                            <div class="col-md-6">
                                                <input type="radio" class="form-check-input" name="left_isokor_anisokor" id="left_isokor_anisokor" value="1">
                                                <label for="left_isokor_anisokor">Isokor</label>
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
                                        <td><input type="text" class="form-control" id="left_light_reflex" name="left_light_reflex">/<input type="text" class="form-control" id="right_light_reflex" name="right_light_reflex"></td>
                                        <td>
                                            <input type="text" class="form-control" id="" name="left_isokor_anisokor">
                                            <input type="text" class="form-control" id="" name="">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="" name="">
                                            <input type="text" class="form-control" id="" name="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reflek Kornea</td>
                                        <td><input type="text" class="form-control" id="left_cornea" name="left_cornea">/<input type="text" class="form-control" id="right_cornea" name="right_cornea"></td>
                                        <td><input type="text" class="form-control" id="" name=""></td>
                                        <td><input type="text" class="form-control" id="" name=""></td>
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
                                            <td><input type="text" class="form-control" id="stiff_neck" name="stiff_neck"></td>
                                        </tr>
                                        <tr>
                                            <td>Meninggal sign</td>
                                            <td><input type="text" class="form-control" id="meningeal_sign" name="meningeal_sign"></td>
                                        </tr>
                                        <tr>
                                            <td>Brudzinki I-IV</td>
                                            <td><input type="text" class="form-control" id="brudzinki_i_iv" name="brudzinki_i_iv"></td>
                                        </tr>
                                        <tr>
                                            <td>Kernig sign</td>
                                            <td><input type="text" class="form-control" id="kernig_sign" name="kernig_sign"></td>
                                        </tr>
                                        <tr>
                                            <td>Doll’s eye phenomena</td>
                                            <td><input type="text" class="form-control" id="dolls_eye_phenomenon" name="dolls_eye_phenomenon"></td>
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
                                        <input type="text" class="form-control" id="vertebra" name="vertebra" style="width: 850px">
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
                                        <input type="text" class="form-control" id="extremity" name="extremity" style="width: 850px">
                                    </div>
                                </div>
                            </div>


                            <br><br>
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <span>Gerak dan Kekuatan:</span>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="motion_upper_left" name="motion_upper_left" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="motion_upper_right" name="motion_upper_right" style="width: 100%;">
                                </div>
                                <div class="col-2"></div>
                                <div class="col-1">
                                    <input type="text" id="strength_upper_left" name="strength_upper_left" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="strength_upper_right" name="strength_upper_right" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <input type="text" id="motion_lower_left" name="motion_lower_left" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="motion_lower_right" name="motion_lower_right" style="width: 100%;">
                                </div>
                                <div class="col-2"></div>
                                <div class="col-1">
                                    <input type="text" id="strength_lower_left" name="strength_lower_left" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="strength_lower_right" name="strength_lower_right" style="width: 100%;">
                                </div>
                            </div>

                            <div class="row align-items-center mt-3">
                                <div class="col-3">
                                    <span>Reflek Fisiologi:</span>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="physiological_reflex_upper_left" name="physiological_reflex_upper_left" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="physiological_reflex_upper_right" name="physiological_reflex_upper_right" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <input type="text" id="physiological_reflex_lower_left" name="physiological_reflex_lower_left" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="physiological_reflex_lower_right" name="physiological_reflex_lower_right" style="width: 100%;">
                                </div>
                            </div>

                            <div class="row align-items-center mt-3">
                                <div class="col-3">
                                    <span>Reflek patologis :</span>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="pathologycal_reflex_upper_left" name="pathologycal_reflex_upper_left" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="pathologycal_reflex_upper_right" name="pathologycal_reflex_upper_right" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <input type="text" id="pathologycal_reflex_lower_left" name="pathologycal_reflex_lower_left" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="pathologycal_reflex_lower_right" name="pathologycal_reflex_lower_right" style="width: 100%;">
                                </div>
                            </div>

                            <br>
                            <div class="col-md-6">
                                <div class="row text-align">
                                    <div class="col-md-4">
                                        <label for="">Clonus </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="clonus" name="clonus" style="width: 850px">
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
                                        <input type="text" class="form-control" id="sensibility" name="sensibility" style="width: 850px">
                                    </div>
                                </div>
                            </div>

                    <tr>
                        <td>
                            <label><b>Pemeriksaan Penunjang :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="" name="" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label><b>Diagnosis Kerja :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="" name="" rows="4" cols="7"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label><b>Terapi :</b></label>
                            <div class="mb-3">
                                <div>
                                    <textarea class="form-control" id="" name="" rows="4" cols="7"></textarea>
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
                                        <input type="radio" class="form-check-input" name="follow_up_plan" id="follow_up_planrajal" value="1">
                                        <label for="">Rawat Jalan</label>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <div class="row align-items-center">
                                                    <div class="col-md-9">
                                                        <div class="row align-items-center">

                                                            <div class="col-md-6">
                                                                <input type="radio" class="form-check-input" name="follow_up_plan" id="follow_up_planranap" value="2">
                                                                <label for="">Rawat Inap</label>
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
                                                        <input class="form-control" type="text" name="rtj_control" id="rtj_control" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-md-4">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Indikasi</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text" name="rtj_inpatient_indication" id="rtj_inpatient_indication" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label><b>DPJP Rawat Inap :</b></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="rtj_inpatient_dpjp" id="rtj_inpatient_dpjp" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label class="col-3" for="">Pengantar Pasien :</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rtj_referenced" id="rtj_referenced_ya" value="0">
                                        <label class="form-check-label" for="t_03_ya">Ada </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rtj_referenced" id="rtj_referenced_tidak" value="0">
                                        <label class="form-check-label" for="t_03_tidak">Tidak* (Bila tidak, rujuk ke Dinas Sosial) </label>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <div class="mb-2">
                                        <label class="col-2" for="">Rujuk ke : </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rtj_referenced_to" id="rtj_referenced_to1" value="0">
                                            <label class="form-check-label" for="t_04_cm">RS</label>
                                            <input type="text" id="v_60" name="v_60" style="width: 120px">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rtj_referenced_to" id="rtj_referenced_to2" value="1">
                                            <label class="form-check-label" for="t_04_apatis">Dokter Keluarga</label>
                                            <input type="text" id="v_61" name="v_61" style="width: 120px">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rtj_referenced_to" id="rtj_referenced_to3" value="2">
                                            <label class="form-check-label" for="t_04_somno">Puskesmas</label>
                                            <input type="text" id="v_62" name="v_62" style="width: 120px">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rtj_referenced_to" id="rtj_referenced_to4" value="3">
                                            <label class="form-check-label" for="t_04_sopor">Dokter</label>
                                            <input type="text" id="v_63" name="v_63" style="width: 120px">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rtj_referenced_to" id="rtj_referenced_to5" value="4">
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
                                                        <input type="text" class="form-control" id="" name="" style="width: 200px">
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
                                                        <input type="text" class="form-control" id="" name="" style="width: 100px">
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
                                        <input class="form-check-input" type="radio" name="patient_education" id="patient_education1">
                                        <label class="form-check-label" for="t_05_perfusi">Pasien</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="patient_education" id="patient_education2">
                                        <label class="form-check-label" for="t_05_risiko">Keluarga pasien, nama :</label>
                                        <input type="text" id="if_patient_family" name="if_patient_family" style="width: 250px">
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="patient_education" id="patient_education3">
                                        <label class="form-check-label" for="t_05_renal">Tidak dapat memberi edukasi kepada pasien atau keluarga, Karena </label>
                                        <input type="text" id="if_can_not_give_edu" name="if_can_not_give_edu" style="width: 250px">
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="patient_education" id="patient_education4">
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
                        <canvas id="canvas" width="200" height="200" style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="ttd" id="ttd">
                        <br>(<input type="text" name="v_68" id="v_68">)
                    </div>
                </div>


                <div class="col-6">
                    <div style="text-align: center;">Penerima Penjelasan</div>

                    <div class="mb-1" style="text-align: center;">
                        <canvas id="canvas1" width="200" height="200" style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="ttd_1" id="ttd_1">
                        <br>(<input type="text" name="v_69" id="v_69">)
                    </div>
                </div>
            </div>

        </div>

    </form>
    <script>
        var canvas = document.getElementById('canvas');
        const canvasDataInput = document.getElementById('ttd');
        var context = canvas.getContext('2d');
        var drawing = false;

        // Load the background image onto the canvas
        const backgroundImage = new Image();


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
                    $("#general_condition").val("<?= $val['general_condition']; ?>")
                    $("#gcs").val("<?= $val['gcs']; ?>")
                    $("#vas_nrs").val("<?= $val['vas_nrs']; ?>")
                    $("#left_diameter").val("<?= $val['left_diameter']; ?>")
                    $("#left_light_reflex").val("<?= $val['left_light_reflex']; ?>")
                    $("#left_cornea").val("<?= $val['left_cornea']; ?>")
                    $("#left_isokor_anisokor").val("<?= $val['left_isokor_anisokor']; ?>")
                    $("#right_diameter").val("<?= $val['right_diameter']; ?>")
                    $("#right_light_reflex").val("<?= $val['right_light_reflex']; ?>")
                    $("#right_cornea").val("<?= $val['right_cornea']; ?>")
                    $("#right_isokor_anisokor").val("<?= $val['right_isokor_anisokor']; ?>")
                    $("#stiff_neck").val("<?= $val['stiff_neck']; ?>")
                    $("#meningeal_sign").val("<?= $val['meningeal_sign']; ?>")
                    $("#brudzinki_i_iv").val("<?= $val['brudzinki_i_iv']; ?>")
                    $("#kernig_sign").val("<?= $val['kernig_sign']; ?>")
                    $("#dolls_eye_phenomenon").val("<?= $val['dolls_eye_phenomenon']; ?>")
                    $("#vertebra").val("<?= $val['vertebra']; ?>")
                    $("#extremity").val("<?= $val['extremity']; ?>")
                    $("#motion_upper_left").val("<?= $val['motion_upper_left']; ?>")
                    $("#motion_upper_right").val("<?= $val['motion_upper_right']; ?>")
                    $("#motion_lower_left").val("<?= $val['motion_lower_left']; ?>")
                    $("#motion_lower_right").val("<?= $val['motion_lower_right']; ?>")
                    $("#strength_upper_left").val("<?= $val['strength_upper_left']; ?>")
                    $("#strength_upper_right").val("<?= $val['strength_upper_right']; ?>")
                    $("#strength_lower_left").val("<?= $val['strength_lower_left']; ?>")
                    $("#strength_lower_right").val("<?= $val['strength_lower_right']; ?>")
                    $("#physiological_reflex_upper_left").val("<?= $val['physiological_reflex_upper_left']; ?>")
                    $("#physiological_reflex_upper_right").val("<?= $val['physiological_reflex_upper_right']; ?>")
                    $("#physiological_reflex_lower_left").val("<?= $val['physiological_reflex_lower_left']; ?>")
                    $("#physiological_reflex_lower_right").val("<?= $val['physiological_reflex_lower_right']; ?>")
                    $("#pathologycal_reflex_upper_left").val("<?= $val['pathologycal_reflex_upper_left']; ?>")
                    $("#pathologycal_reflex_upper_right").val("<?= $val['pathologycal_reflex_upper_right']; ?>")
                    $("#pathologycal_reflex_lower_left").val("<?= $val['pathologycal_reflex_lower_left']; ?>")
                    $("#pathologycal_reflex_lower_right").val("<?= $val['pathologycal_reflex_lower_right']; ?>")
                    $("#clonus").val("<?= $val['clonus']; ?>")
                    $("#sensibility").val("<?= $val['sensibility']; ?>")
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
                    $("#clinical_indication").val("<?= $val['clinical_indication']; ?>")
                    $("#target_of_therapy").val("<?= $val['target_of_therapy']; ?>")
                    $("#rtj_out_instruction").val("<?= $val['rtj_out_instruction']; ?>")
                    $("#set_all_dbn").val("<?= $val['set_all_dbn']; ?>")
                    $("#education_material").val("<?= $val['education_material']; ?>")
                    $("#message_main_attachment_id").val("<?= $val['message_main_attachment_id']; ?>")
                    $("#rtj_inpatient_service_needs").val("<?= $val['rtj_inpatient_service_needs']; ?>")
                    $("#trial194").val("<?= $val['trial194']; ?>")
                    $("input").prop("disabled", true);
                    $("textarea").prop("disabled", true);

                    const img = new Image();
                    img.onload = function() {
                        context.drawImage(img, 0, 0, canvas.width, canvas.height);
                    };
                    img.src = "data:image/png;base64,<?= $val['clinical_indication']; ?>";
                    const img1 = new Image();
                    img1.onload = function() {
                        context1.drawImage(img1, 0, 0, canvas1.width, canvas1.height);
                    };
                    img1.src = "data:image/png;base64,<?= $val['target_of_therapy']; ?>";
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
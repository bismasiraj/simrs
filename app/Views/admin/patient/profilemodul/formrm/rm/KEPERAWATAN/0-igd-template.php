<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

</head>

<body>
    <div class="container-fluid mt-5">
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post" autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>

            <input type="hidden" name="body_id" id="body_id">
            <input type="hidden" name="org_unit_code" id="org_unit_code">
            <input type="hidden" name="pasien_diagnosa_id" id="pasien_diagnosa_id">
            <input type="hidden" name="diagnosa_id" id="diagnosa_id">
            <input type="hidden" name="visit_id" id="visit_id">
            <input type="hidden" name="bill_id" id="bill_id">
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
            <input type="hidden" name="theid" id="theid">
            <input type="hidden" name="isrj" id="isrj">
            <input type="hidden" name="gender" id="gender">
            <input type="hidden" name="kal_id" id="kal_id">
            <input type="hidden" name="petugas_id" id="petugas_id">
            <input type="hidden" name="petugas" id="petugas">
            <input type="hidden" name="account_id" id="account_id">
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3>RS PKU Muhammadiyah Sampangan</h3>
                    <h3>Surakarta</h3>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $title; ?></h4>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <input type="text" class="form-control" id="no_registration" name="no_registration">
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <input type="text" class="form-control" id="thename" name="thename">
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <select name="gender" id="gender" class="form-control">
                                <option value="1">Laki-Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <input type="text" class="form-control" id="patient_age" name="patient_age">
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <input type="text" class="form-control" id="theaddress" name="theaddress">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <input type="text" class="form-control" id="doctor" name="doctor">
                        </td>
                        <td>
                            <b>Department</b>
                            <input type="text" class="form-control" id="clinic_id" name="clinic_id">
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <input type="text" class="form-control" id="examination_date" name="examination_date">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php $this->renderSection('content'); ?>
            <div class="row">
                <h4 class="text-start">Anamnesa</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <b>Keluhan Utama (Autoanamnesis)</b>
                            <input type="text" class="form-control" id="ana_main_complaint" name="ana_main_complaint">
                        </td>
                        <td>
                            <b>Riwayat Penyakit Sekarang</b>
                            <input type="text" class="form-control" id="ana_auto_current_disease_history" name="ana_auto_current_disease_history">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Riwayat Penyakit Dahulu</b>
                            <input type="text" class="form-control" id="ana_past_disease_history" name="ana_past_disease_history">
                        </td>
                        <td>
                            <b>Riwayat Alergi (Non Obat)</b>
                            <input type="text" class="form-control" id="ana_allergy_history_non_drugs" name="ana_allergy_history_non_drugs">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Riwayat Penyakit Keluarga</b>
                            <input type="text" class="form-control" id="ana_family_disease_history" name="ana_family_disease_history">
                        </td>
                        <td>
                            <b>Riwayat Alergi (Obat)</b>
                            <input type="text" class="form-control" id="ana_drugs_consumed" name="ana_drugs_consumed">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Tekanan Darah</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_bp" name="pf_vital_sign_bp" value="<?= $val['tension_upper']; ?> / <?= $val['tension_below']; ?>">
                                <span class="input-group-text" id="basic-addon2">mmHg</span>
                            </div>
                        </td>
                        <td>
                            <b>Denyut Nadi</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_n" name="pf_vital_sign_n" value="<?= $val['nadi']; ?>">
                                <span class="input-group-text" id="basic-addon2">x/m</span>
                            </div>
                        </td>
                        <td>
                            <b>Suhu Tubuh</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_s" name="pf_vital_sign_s" value="<?= $val['temperature']; ?>">
                                <span class="input-group-text" id="basic-addon2">℃</span>
                            </div>
                        </td>
                        <td>
                            <b>Respiration Rate</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_rr" name="pf_vital_sign_rr" value="<?= $val['respiration']; ?>">
                                <span class="input-group-text" id="basic-addon2">x/m</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Berat Badan</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_weight" name="pf_vital_sign_weight" value="<?= $val['weight']; ?>">
                                <span class="input-group-text" id="basic-addon2">kg</span>
                            </div>
                        </td>
                        <td>
                            <b>Tinggi Badan</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_height" name="pf_vital_sign_height" value="<?= $val['height']; ?>">
                                <span class="input-group-text" id="basic-addon2">cm</span>
                            </div>
                        </td>
                        <td>
                            <b>SpO2</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_spo2" name="pf_vital_sign_spo2" value="<?= $val['nafas']; ?>">
                            </div>
                        </td>
                        <td>
                            <b>BMI</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pf_vital_sign_bmi" name="pf_vital_sign_bmi" value="<?= $val['bmi']; ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>LLA</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['lla']; ?>">
                            </div>
                        </td>
                        <td colspan="2">
                            <b>Penyebab Cidera dan Keracunan</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['penyebab_cidera']; ?>">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Pernafasan</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Airway</b>
                            <input type="text" class="form-control" id="airway" name="airway" value="<?= $respiration['airway'] ?? '' ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Benda Asing</b>
                            <input type="text" class="form-control" id="object_strange" name="object_strange" value="<?= $respiration['object_strange'] ?? '' ?>">
                        </td>
                        <td>
                            <b>ETT</b>
                            <input type="text" class="form-control" id="ett" name="ett" value="<?= $respiration['ett'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Breathing</b>
                            <input type="text" class="form-control" id="breathing" name="breathing" value="<?= $respiration['breathing'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Bunyi Paru</b>
                            <input type="text" class="form-control" id="lung_sound" name="lung_sound" value="<?= $respiration['lung_sound'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Posisi Paru</b>
                            <input type="text" class="form-control" id="lung_position" name="lung_position" value="<?= $respiration['lung_position'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kesulitan Bernafas</b>
                            <input type="text" class="form-control" id="breathing_trouble" name="breathing_trouble" value="<?= $respiration['breathing_trouble'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Penggunaan otot bantu nafas</b>
                            <input type="text" class="form-control" id="breath_muscle" name="breath_muscle" value="<?= $respiration['breath_muscle'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Menggunakan Oksigen</b>
                            <input type="text" class="form-control" id="o2_usage" name="o2_usage" value="<?= $respiration['o2_usage'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Frekuensi Nafas</b>
                            <input type="text" class="form-control" id="respiration_rate" name="respiration_rate" value="<?= $respiration['respiration_rate'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Batuk</b>
                            <input type="text" class="form-control" id="cough" name="cough" value="<?= $respiration['cough'] ?? '' ?>">
                        </td>
                        <td>
                            <b>SpO2</b>
                            <input type="text" class="form-control" id="spo2" name="spo2" value="<?= $respiration['spo2'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Bersihan jalan nafas tidak efektif?</b>
                            <input type="text" class="form-control" id="clean_breathing" name="clean_breathing" value="<?= $respiration['clean_breathing'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Pola nafas efektif</b>
                            <input type="text" class="form-control" id="effective_breathing" name="effective_breathing" value="<?= $respiration['effective_breathing'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Gangguan pertukaran gas</b>
                            <input type="text" class="form-control" id="gas_trouble" name="gas_trouble" value="<?= $respiration['gas_trouble'] ?? '' ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Asesmen Sirkulasi</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Tekanan Darah</b>
                            <input type="text" class="form-control" id="tension_upper" name="tension_upper" value="<?= $circulation['tension_upper'] ?? '' ?> / <?= $circulation['tension_below'] ?? '' ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Gangguan Sirkulasi</b>
                            <input type="text" class="form-control" id="circulation_disorder" name="circulation_disorder" value="<?= $circulation['circulation_disorder'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Pengisian Kapiler</b>
                            <input type="text" class="form-control" id="capillary_filling" name="capillary_filling" value="<?= $circulation['capillary_filling'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Denyut Nadi</b>
                            <input type="text" class="form-control" id="nadi" name="nadi" value="<?= $circulation['nadi'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Irama Jantung</b>
                            <input type="text" class="form-control" id="heart_rhythm" name="heart_rhythm" value="<?= $circulation['heart_rhythm'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Pacemaker</b>
                            <input type="text" class="form-control" id="pacemaker" name="pacemaker" value="<?= $circulation['pacemaker'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Akral</b>
                            <input type="text" class="form-control" id="akral" name="akral" value="<?= $circulation['akral'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Gangguan Perfusi Jaringan</b>
                            <input type="text" class="form-control" id="perfusi_disorder" name="perfusi_disorder" value="<?= $circulation['perfusi_disorder'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Resiko Syok</b>
                            <input type="text" class="form-control" id="shock_risk" name="shock_risk" value="<?= $circulation['shock_risk'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Gangguan penurunan curah jantung</b>
                            <input type="text" class="form-control" id="heart_risk" name="heart_risk" value="<?= $circulation['heart_risk'] ?? '' ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Asesmen Neurosensoris</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Orientasi</b>
                            <input type="text" class="form-control" id="orientasi" name="orientasi" value="<?= $neurosensoris['orientasi'] ?? '' ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Memori</b>
                            <input type="text" class="form-control" id="memory" name="memory" value="<?= $neurosensoris['memory'] ?? '' ?>">
                        </td>
                        <td rowspan="3">
                            <div class="row mb-2">
                                <div class="col">
                                    <b>GCS</b>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <b>E:</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['gcs_e']; ?>">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <b>V:</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['gcs_v']; ?>">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <b>M:</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['gcs_m']; ?>">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <b>Score:</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['gcs']; ?>">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Ukuran Pupil Kiri</b>
                            <input type="text" class="form-control" id="lpupil_diameter" name="lpupil_diameter" value="<?= $neurosensoris['lpupil_diameter'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Ukuran Pupil Kanan</b>
                            <input type="text" class="form-control" id="rpupil_diameter" name="rpupil_diameter" value="<?= $neurosensoris['rpupil_diameter'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Reaksi Cahaya Pupil Kiri</b>
                            <input type="text" class="form-control" id="lpupil_reaction" name="lpupil_reaction" value="<?= $neurosensoris['lpupil_reaction'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Reaksi Cahaya Pupil Kanan</b>
                            <input type="text" class="form-control" id="rpupil_reaction" name="rpupil_reaction" value="<?= $neurosensoris['rpupil_reaction'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanda Perangsang Selaput Otak</b>
                            <input type="text" class="form-control" id="neurosensoris" name="neurosensoris" value="<?= $neurosensoris['neurosensoris'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Resiko Injury</b>
                            <input type="text" class="form-control" id="injury_risk" name="injury_risk" value="<?= $neurosensoris['injury_risk'] ?? '' ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Integumen & Muskulo Skeletal</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Integumen</b>
                            <input type="text" class="form-control" id="integumen" name="integumen" value="<?= $integumen['integumen'] ?? '' ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Turgor</b>
                            <input type="text" class="form-control" id="turgor" name="turgor" value="<?= $integumen['turgor'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Rambut</b>
                            <input type="text" class="form-control" id="hair" name="hair" value="<?= $integumen['hair'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kuku</b>
                            <input type="text" class="form-control" id="nail" name="nail" value="<?= $integumen['nail'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Luka</b>
                            <input type="text" class="form-control" id="wound" name="wound" value="<?= $integumen['wound'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Pendarahan</b>
                            <input type="text" class="form-control" id="bleeding" name="bleeding" value="<?= $integumen['bleeding'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Fraktur</b>
                            <input type="text" class="form-control" id="fracture" name="fracture" value="<?= $integumen['fracture'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Fraktur/Dislokasi</b>
                            <input type="text" class="form-control" id="location" name="location" value="<?= $integumen['location'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Gangguan Integritas Kulit</b>
                            <input type="text" class="form-control" id="skin_disorder" name="skin_disorder" value="<?= $integumen['skin_disorder'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Resiko Infeksi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Gangguan Pemenuhan ADI</b>
                            <input type="text" class="form-control" id="adi_disorder" name="adi_disorder" value="<?= $integumen['adi_disorder'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Gangguan Mobilisasi</b>
                            <input type="text" class="form-control" id="mobilization_disorder" name="mobilization_disorder" value="<?= $integumen['mobilization_disorder'] ?? '' ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <h4><b>Skala Nyeri</b></h4>
                        </td>
                        <td>
                            <h4><b>Resiko Jatuh</b></h4>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2">
                            <textarea type="text" class="form-control" id="skala_nyeri" name="skala_nyeri"><?= $val['skala_nyeri']; ?></textarea>
                            <input type="text" class="form-control" id="alat_ukur_nyeri" name="alat_ukur_nyeri" value="<?= $val['alat_ukur_nyeri']; ?>">
                        </td>
                        <td>
                            <b>Penjelasan</b>
                            <input type="text" class="form-control" id="penjelasan" name="penjelasan" value="<?= $val['penjelasan']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tipe Resiko Jatuh</b>
                            <input type="text" class="form-control" id="tipe_resiko" name="tipe_resiko" value="<?= $val['tipe_resiko']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="8">
                            <div class="row mb-5">
                                <div class="col">
                                    <b>Numeric Rating Scale</b>
                                    <input type="text" class="form-control" id="rating_scale" name="rating_scale" value="<?= $val['rating_scale']; ?>">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <b>Luka Operasi</b>
                                    <input type="text" class="form-control" id="luka_operasi" name="luka_operasi" value="<?= $val['luka_operasi']; ?>">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <b>Deskripsi Nyeri</b>
                                    <input type="text" class="form-control" id="deskripsi_nyeri" name="deskripsi_nyeri" value="<?= $val['deskripsi_nyeri']; ?>">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <b>Hipo/Hipertermi</b>
                                    <input type="text" class="form-control" id="hipertermi" name="hipertermi" value="<?= $val['hipertermi']; ?>">
                                </div>
                            </div>
                        </td>
                        <td>
                            <b>Riwayat Jatuh</b>
                            <input type="text" class="form-control" id="riwayat_jatuh" name="riwayat_jatuh" value="<?= $val['riwayat_jatuh']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Diagnosis Sekunder</b>
                            <input type="text" class="form-control" id="diagnosis_sekunder" name="diagnosis_sekunder" value="<?= $val['diagnosis_sekunder']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Menggunakan Alat-Alat Bantu</b>
                            <input type="text" class="form-control" id="alat_bantu" name="alat_bantu" value="<?= $val['alat_bantu']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Menggunakan infuse/heparine/pengencer darah</b>
                            <input type="text" class="form-control" id="infuse" name="infuse" value="<?= $val['infuse']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Gaya Berjalan</b>
                            <input type="text" class="form-control" id="gaya_berjalan" name="gaya_berjalan" value="<?= $val['gaya_berjalan']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Status Mental</b>
                            <input type="text" class="form-control" id="status_mental" name="status_mental" value="<?= $val['status_mental']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Medikasi</b>
                            <input type="text" class="form-control" id="medikasi" name="medikasi" value="<?= $val['medikasi']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Fall Morse Score</b>
                            <input type="text" class="form-control" id="fall_score" name="fall_score" value="<?= $val['fall_score']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Skrining Gizi</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Pasien Operasi >= 65 tahun?</b>
                            <input type="text" class="form-control" id="pasien_operasi" name="pasien_operasi" value="<?= $val['pasien_operasi']; ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Gangguan Makan</b>
                            <input type="text" class="form-control" id="gangguan_makan" name="gangguan_makan" value="<?= $val['gangguan_makan']; ?>">
                        </td>
                        <td>
                            <b>Masalah yang berhubungan dengan nutrisi</b>
                            <input type="text" class="form-control" id="masalah_nutrisi" name="masalah_nutrisi" value="<?= $val['masalah_nutrisi']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Masalah Makan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['masalah_makan']; ?>">
                        </td>
                        <td>
                            <b>Nutrisi melalui NGT</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['nutrisi_ngt']; ?>">
                        </td>
                        <td>
                            <b>Mukosa Mulut/Lidah</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['mukosa_mulut']; ?>">
                            <b>Fluid Intake</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['fluid_intake']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Penyakit</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['penyakit']; ?>">
                        </td>
                        <td rowspan="2">
                            <b>Gangguan Metabolik</b>
                            <textarea type="text" class="form-control" id="sa" name="sa"><?= $val['gangguan_metabolik']; ?></textarea>
                        </td>
                        <td>
                            <b>Status Gangguan Metabolik</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['status_gangguan']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kategori Usia</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['kategori_usia']; ?>">
                        </td>
                        <td>
                            <b>Resiko Malnutrisi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['resiko_malnutrisi']; ?>">
                            <b>Perlu Konsultasi Gizi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['perlu_konsultasi']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Diagnosis Keperawatan</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nama Diagnosis</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['nama_diagnosis']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">1. Tindakan Kolaborasi</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Tanggal & Jam</b>
                        </td>
                        <td>
                            <b>Tindakan Keperawatan</b>
                        </td>
                        <td>
                            <b>Nama Terang</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="datetime" class="form-control" id="sa" name="sa">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="sa" name="sa">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="sa" name="sa">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">2. Tindakan Mandiri</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Tanggal & Jam</b>
                        </td>
                        <td>
                            <b>Tindakan Keperawatan</b>
                        </td>
                        <td>
                            <b>Nama Terang</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="datetime" class="form-control" id="sa" name="sa">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="sa" name="sa">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="sa" name="sa">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Perawat yang Mengkaji</div>
                    <div class="mb-1">
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: 'a',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<?php $this->renderSection('jsContent'); ?>

</html>
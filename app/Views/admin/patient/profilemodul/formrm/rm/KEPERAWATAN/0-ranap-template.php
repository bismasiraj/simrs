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

    <div class="container mt-5">
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
                <div class="col-md-2" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h2>RS PKU Muhammadiyah Sampangan</h2>
                    <h2>Surakarta</h2>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
                </div>
                <div class="col-md-2" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center"><?= $title; ?></h3>
            </div>
            <div class="row">
                <h4 class="text-start">Informasi Pasien</h4>
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
                    <tr>
                        <td>
                            <b>Kelas</b>
                            <input type="text" class="form-control" id="sa" name="sa">
                        </td>
                        <td>
                            <b>Bangsal/Kamar</b>
                            <input type="text" class="form-control" id="sa" name="sa">
                        </td>
                        <td>
                            <b>Bed</b>
                            <input type="text" class="form-control" id="sa" name="sa">
                        </td>
                    </tr>
                </tbody>
            </table>
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
            <div class="row">
                <h4 class="text-start">Riwayat & Gaya Hidup</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <b>Alkohol</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Merokok</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php $this->renderSection('content1'); ?>
            <div class="row">
                <h4 class="text-start">Skrining Gizi</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Pasien Operasi >= 65 tahun?</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td style="width: 33%;">
                            <b>Gangguan Makan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Masalah yang berhubungan dengan nutrisi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Masalah Makan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Nutrisi melalui NGT</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Mukosa Mulut/Lidah</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                            <b>Fluid Intake</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Penyakit</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td rowspan="2">
                            <b>Gangguan Metabolik</b>
                            <textarea type="text" class="form-control" id="sa" name="sa"></textarea>
                        </td>
                        <td>
                            <b>Status Gangguan Metabolik</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kategori Usia</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Resiko Malnutrisi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                            <b>Perlu Konsultasi Gizi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php $this->renderSection('content2'); ?>
            <div class="row">
                <h4 class="text-start">Aktivitas Dan Latihan</h4>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td style="width: 25%;">
                            <b>Faktor Ketergantungan</b>
                        </td>
                        <td style="width: 25%;">
                            <b>Nilai</b>
                        </td>
                        <td style="width: 25%;">
                            <b>Faktor Ketergantungan</b>
                        </td>
                        <td style="width: 25%;">
                            <b>Nilai</b>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1. Makan</td>
                        <td><?= $adl['feeding']; ?></td>
                        <td>6. BAK</td>
                        <td><?= $adl['bak']; ?></td>
                    </tr>
                    <tr>
                        <td>2. Mandi</td>
                        <td><?= $adl['bathing']; ?></td>
                        <td>7. Penggunaan toilet</td>
                        <td><?= $adl['toileting']; ?></td>
                    </tr>
                    <tr>
                        <td>3. Perawatan diri</td>
                        <td><?= $adl['selfcare']; ?></td>
                        <td>8. Transfer</td>
                        <td><?= $adl['transfering']; ?></td>
                    </tr>
                    <tr>
                        <td>4. Berpakaian</td>
                        <td><?= $adl['dressing']; ?></td>
                        <td>9. Mobilitas</td>
                        <td><?= $adl['mobility']; ?></td>
                    </tr>
                    <tr>
                        <td>5. BAB</td>
                        <td><?= $adl['bab']; ?></td>
                        <td>10. Naik turun tangga</td>
                        <td><?= $adl['stairs']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Total Skor
                                <?= $adl['total_dependency']; ?></b>
                        </td>
                        <td colspan="2">
                            Ketergantungan ringan
                            <?= $adl['status']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>Gangguan pemenuhan kebutuhan aktifitas</b>
                            <input type="text" class="form-control" id="adl_disruption" name="adl_disruption" value="<?= $adl['adl_disruption']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Psikologis Spiritual</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Kondisi Pasien</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td style="width: 33%;">
                            <b>Hubungan dengan keluarga</b>
                            <input type="text" class="form-control" id="familyrelation" name="familyrelation" value="<?= $spiritual['familyrelation'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Permintaan Khusus</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Agama</b>
                            <input type="text" class="form-control" id="kode_agama" name="kode_agama" value="<?= $spiritual['kode_agama'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Hambatan Sosial/Budaya/Ekonomi</b>
                            <input type="text" class="form-control" id="social_barier" name="social_barier" value="<?= $spiritual['social_barier'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Larangan Keyakinan</b>
                            <input type="text" class="form-control" id="religion_ban" name="religion_ban" value="<?= $spiritual['religion_ban'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Mitos Budaya Setempat</b>
                            <input type="text" class="form-control" id="myth" name="myth" value="<?= $spiritual['myth'] ?? '' ?>">
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
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Sosial Ekonomi</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Status Perkawinan</b>
                            <input type="text" class="form-control" id="maritalstatusid" name="maritalstatusid" value="<?= $socec['maritalstatusid'] ?? '' ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Punya Anak</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Jumlah Anak</b>
                            <input type=" text" class="form-control" id="children" name="children" value="<?= $socec['children'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Pendidikan</b>
                            <input type="text" class="form-control" id="education_type_code" name="education_type_code" value="<?= $socec['education_type_code'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Kewarganegaraan</b>
                            <input type="text" class="form-control" id="nation_id" name="nation_id" value="<?= $socec['nation_id'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Pekerjaan</b>
                            <input type="text" class="form-control" id="job_id" name="job_id" value="<?= $socec['job_id'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Aktivitas</b>
                            <input type="text" class="form-control" id="activity" name="activity" value="<?= $socec['activity'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Curiga penganiayaan/penelantaran</b>
                            <input type="text" class="form-control" id="suspicion" name="suspicion" value="<?= $socec['suspicion'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Tinggal Bersama</b>
                            <input type="text" class="form-control" id="livingwith" name="livingwith" value="<?= $socec['livingwith'] ?? '' ?>">
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
                                    <input type="text" class="form-control" id="sa" name="sa" value="">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <b>E:</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <b>V:</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <b>M:</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <b>Score:</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="">
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
                <h4 class="text-start">Pencernaan</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="wasir" name="wasir" <?= ($digestion['wasir'] == "1" ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="wasir">Wasir</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rectal_bleed" name="rectal_bleed" <?= ($digestion['rectal_bleed'] == "1" ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="rectal_bleed">Pendarahan Rectal</label>
                            </div>
                        </td>
                        <td style="width: 33%;">
                            <b>Jenis Diet</b>
                            <input type="text" class="form-control" id="diet_type" name="diet_type" value="<?= $digestion['diet_type'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Feeding Tube</b>
                            <input type="text" class="form-control" id="feeding_tube" name="feeding_tube" value="<?= $digestion['feeding_tube'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Pembatasan Cairan</b>
                            <input type="text" class="form-control" id="fluid_limit" name="fluid_limit" value="<?= $digestion['fluid_limit'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Abdomen</b>
                            <input type="text" class="form-control" id="abdomen" name="abdomen" value="<?= $digestion['abdomen'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Bunyi Usus</b>
                            <input type="text" class="form-control" id="intestinal_sound" name="intestinal_sound" value="<?= $digestion['intestinal_sound'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Terakhir BAB</b>
                            <input type="text" class="form-control" id="bab_when" name="bab_when" value="<?= $digestion['bab_when'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Konsistensi</b>
                            <input type="text" class="form-control" id="bab_freq" name="bab_freq" value="<?= $digestion['bab_freq'] ?? '' ?>">
                            <b>Penggunaan Pencahar</b>
                            <input type="text" class="form-control" id="pencahar" name="pencahar" value="<?= $digestion['pencahar'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Gangguan Pola Eliminasi</b>
                            <input type="text" class="form-control" id="trouble_risk" name="trouble_risk" value="<?= $digestion['trouble_risk'] ?? '' ?>">
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
                <h4 class="text-start">Perkemihan</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>BAK</b>
                            <input type="text" class="form-control" id="bak" name="bak" value="<?= $bladder['bak'] ?? '' ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Menggunakan Kateter Urine</b>
                            <input type="text" class="form-control" id="urine_catheter" name="urine_catheter" value="<?= $bladder['urine_catheter'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Jumlah Urine</b>
                            <input type="text" class="form-control" id="urine_vol" name="urine_vol" value="<?= $bladder['urine_vol'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Masalah Prostat</b>
                            <input type="text" class="form-control" id="prostate" name="prostate" value="<?= $bladder['prostate'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Keluhan Nyeri Pinggang</b>
                            <input type="text" class="form-control" id="back_pain" name="back_pain" value="<?= $bladder['back_pain'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Kelainan</b>
                            <input type="text" class="form-control" id="disorders" name="disorders" value="<?= $bladder['disorders'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Gangguan Pola Eliminasi</b>
                            <input type="text" class="form-control" id="elimination" name="elimination" value="<?= $bladder['elimination'] ?? '' ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Seksual/Reproduksi</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <b>Jenis Kelamin</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Skrining Prostat</b>
                            <input type="text" class="form-control" id="skrining_prostat" name="skrining_prostat" value="<?= $reproduction['skrining_prostat'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Risiko Pendarahan</b>
                            <input type="text" class="form-control" id="bleeding_risk" name="bleeding_risk" value="<?= $reproduction['bleeding_risk'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Gangguan Konsep Diri</b>
                            <input type="text" class="form-control" id="selfdisorder" name="selfdisorder" value="<?= $reproduction['selfdisorder'] ?? '' ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">THT & Mata</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Telinga</b>
                            <input type="text" class="form-control" id="ears" name="ears" value="<?= $hearing['ears'] ?? '' ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Sakit Menelan</b>
                            <input type="text" class="form-control" id="swollen_pain" name="swollen_pain" value="<?= $hearing['swollen_pain'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Gigi</b>
                            <input type="text" class="form-control" id="teeth" name="teeth" value="<?= $hearing['teeth'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Sakit Gigi</b>
                            <input type="text" class="form-control" id="toothache" name="toothache" value="<?= $hearing['toothache'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Gigi Palsu</b>
                            <input type="text" class="form-control" id="denturest" name="denturest" value="<?= $hearing['denturest'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Mata</b>
                            <input type="text" class="form-control" id="eyes" name="eyes" value="<?= $hearing['eyes'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Gangguan Persepsi Sensor</b>
                            <input type="text" class="form-control" id="censory_disorder" name="censory_disorder" value="<?= $hearing['censory_disorder'] ?? '' ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Khusus Anak</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Lama Kehamilan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td style="width: 33%;">
                            <b>Komplikasi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Masalah Neonatus</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Masalah Maternal</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Riwayat Imunisasi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Umur Saat Tengkurap</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Umur Saat Duduk</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Umur Saat Mengoceh</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Umur Saat Berdiri</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Umur Saat Bicara</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Umur Saat Berjalan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>ASI/Formula</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Makanan Tambahan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Pengasuh</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Pembawaan Umum</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tempramen</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Kebiasaan Perilaku Unik</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Risiko terjadi penyakit yang dapat dicegah dengan imunisasi (PD3I)</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Gangguan Tumbuh Kembang</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Tidur Dan Istirahat</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Berapa Jam Tidur Per Hari</b>
                            <input type="text" class="form-control" id="sleep_duration" name="sleep_duration" value="<?= $sleeping['sleep_duration'] ?? '' ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Penggunaan Obat Tidur</b>
                            <input type="text" class="form-control" id="sleeping_pills" name="sleeping_pills" value="<?= $sleeping['sleeping_pills'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Penerangan Lampu</b>
                            <input type="text" class="form-control" id="light" name="light" value="<?= $sleeping['light'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Keadaan Saat Ini</b>
                            <input type="text" class="form-control" id="current_sleeping" name="current_sleeping" value="<?= $sleeping['current_sleeping'] ?? '' ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Dekubitus</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Resiko Dekubitus (Braden Score)</b>
                            <input type="text" class="form-control" id="dekubitus_risk" name="dekubitus_risk" value="<?= $dekubitus['dekubitus_risk'] ?? '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Dekubitus</b>
                            <input type="text" class="form-control" id="dekubitus_type" name="dekubitus_type" value="<?= $dekubitus['dekubitus_type'] ?? '' ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Aktivitas Dan Latihan</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <b>Tingkat Ketergantungan ADL</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                        <td>
                            <b>Gangguan Pemenuhan Kebutuhan Aktifitas</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Diagnosis Keperawatan</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nama Diagnosis</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-auto" align="center">
                    <div>PK/KT (Perawat Primer/Kepala Tim)</div>
                    <div class="mb-3">
                        <div id="qrcode"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Perawat yang Mengkaji</div>
                    <div class="mb-3">
                        <div id="qrcode1"></div>
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
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
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
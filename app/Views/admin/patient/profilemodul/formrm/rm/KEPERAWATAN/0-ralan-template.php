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
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: #FFF;
            opacity: 1;
        }

        .form-control,
        .input-group-text {
            background-color: #fff;
            border: 1px solid #fff;
            font-size: 12px;
        }

        @page {
            size: A4;
        }

        body {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
            font-size: 12px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .3rem;
            font-weight: 500;
            line-height: 1.2;
        }
    </style>
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
                    <h4>RS PKU Muhammadiyah Sampangan</h4>
                    <h4>Surakarta</h4>
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
            <div class="row">
                <h5 class="text-start">Subyektif</h5>
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
                            <input type="text" class="form-control" id="ana_past_disease_history" name="ana_past_disease_history" value="<?= $val['riwayat_dahulu'] ?? ''; ?>">
                        </td>
                        <td>
                            <b>Riwayat Alergi (Non Obat)</b>
                            <input type="text" class="form-control" id="ana_allergy_history_non_drugs" name="ana_allergy_history_non_drugs" value="<?= $val['riwayat_nondrug'] ?? ''; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Riwayat Penyakit Keluarga</b>
                            <input type="text" class="form-control" id="ana_family_disease_history" name="ana_family_disease_history" value="<?= $val['riwayat_keluarga'] ?? ''; ?>">
                        </td>
                        <td>
                            <b>Riwayat Alergi (Obat)</b>
                            <input type="text" class="form-control" id="ana_drugs_consumed" name="ana_drugs_consumed" value="<?= $val['riwayat_drug'] ?? ''; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Riwayat & Gaya Hidup</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <b>Alkohol</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['alkohol']; ?>">
                        </td>
                        <td>
                            <b>Merokok</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['merokok']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php $this->renderSection('content'); ?>
            <div class="row">
                <h5 class="text-start">Psikologis Spiritual</h5>
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
                <h5 class="text-start">Sosial Ekonomi</h5>
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
                            <input type="text" class="form-control" id="children" name="children" value="<?= $socec['children'] ?? '' ?>">
                        </td>
                        <td>
                            <b>Jumlah Anak</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="">
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
                <h5 class="text-start">Skrining Gizi</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Pasien Operasi >= 65 tahun?</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['pasien_operasi']; ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Gangguan Makan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['gangguan_makan']; ?>">
                        </td>
                        <td>
                            <b>Masalah yang berhubungan dengan nutrisi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['masalah_nutrisi']; ?>">
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
                <h5 class="text-start">Khusus Anak</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Lama Kehamilan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['lama_kehamilan']; ?>">
                        </td>
                        <td style="width: 33%;">
                            <b>Komplikasi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['komplikasi']; ?>">
                        </td>
                        <td>
                            <b>Masalah Neonatus</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['masalah_neonatus']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Masalah Maternal</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['masalah_maternal']; ?>">
                        </td>
                        <td>
                            <b>Riwayat Imunisasi</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['riwayat_imunisasi']; ?>">
                        </td>
                        <td>
                            <b>Umur Saat Tengkurap</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['umur_tengkurap']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Umur Saat Duduk</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['umur_duduk']; ?>">
                        </td>
                        <td>
                            <b>Umur Saat Mengoceh</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['umur_mengoceh']; ?>">
                        </td>
                        <td>
                            <b>Umur Saat Berdiri</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['umur_berdiri']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Umur Saat Bicara</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['umur_bicara']; ?>">
                        </td>
                        <td>
                            <b>Umur Saat Berjalan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['umur_berjalan']; ?>">
                        </td>
                        <td>
                            <b>ASI/Formula</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['asi']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Makanan Tambahan</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['makanan_tambahan']; ?>">
                        </td>
                        <td>
                            <b>Pengasuh</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['pengasuh']; ?>">
                        </td>
                        <td>
                            <b>Pembawaan Umum</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['pembawaan_umum']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tempramen</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['tempramen']; ?>">
                        </td>
                        <td>
                            <b>Kebiasaan Perilaku Unik</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['kebiasaan_perilaku']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Risiko terjadi penyakit yang dapat dicegah dengan imunisasi (PD3I)</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['pd3i']; ?>">
                        </td>
                        <td>
                            <b>Gangguan Tumbuh Kembang</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['gangguan_tumbuh']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <b>Skala Nyeri</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['skala_nyeri']; ?>">
                        </td>
                        <td>
                            <b>Resiko Jatuh</b>
                            <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['resiko_jatuh']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row mb-5">
                                <div class="col">
                                    <b>Luka Operasi</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['luka_operasi']; ?>">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <b>Deskripsi Nyeri</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['deskripsi_nyeri']; ?>">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <b>Hipo/Hipertermi</b>
                                    <input type="text" class="form-control" id="sa" name="sa" value="<?= $val['hipertermi']; ?>">
                                </div>
                            </div>
                        </td>
                        <td></td>
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

<script type="text/javascript">
    $("body").find("input, select, textarea").prop("readonly", true)
</script>
<?php $this->renderSection('jsContent'); ?>

</html>
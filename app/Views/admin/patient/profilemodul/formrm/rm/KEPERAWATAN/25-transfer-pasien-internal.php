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
                    <h3>RS PKU Muhammadiyah Sampangan</h3>
                    <h3>Surakarta</h3>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center">Transfer Pasien Internal</h3>
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
                    <tr>
                        <td>
                            <b>Kelas</b>
                            <input type="text" class="form-control" id="" name="">
                        </td>
                        <td>
                            <b>Bangsal/Kamar</b>
                            <input type="text" class="form-control" id="" name="">
                        </td>
                        <td>
                            <b>Bed</b>
                            <input type="text" class="form-control" id="" name="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Derajat Stabilitas</h4>
            </div>
            <table class="table table-bordered">
                <thead style="vertical-align: text-top;">
                    <tr>
                        <td style="width: 5%;">
                            <b>Level</b>
                        </td>
                        <td>
                            <b>Kategori</b>
                        </td>
                        <td style="width: 10%;">
                            <b>Pendamping Internal</b>
                        </td>
                        <td style="width: 25%;">
                            <b>Peralatan</b>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0</td>
                        <td>
                            <p>Pasien yang hanya membutuhkan ruang perawatan biasa</p>
                        </td>
                        <td>
                            <p>Perawat Pra PK/PK 1 PU</p>
                        </td>
                        <td>
                            <p>Status rekam medis, hasil pemeriksaan penunjang, lembar transfer pasien,
                                kursi roda/tempat tidur</p>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>
                            <p>Kondisi pasien yang beresiko mengalami perburukan, pasien yang baru
                                dipindahkan dari HND/ICU, pasien yang akan dirawat di ruang perawatan
                                biasa dengan pengawasan dari tim perawatan khusus</p>
                        </td>
                        <td>
                            <p>perawat PK 1 (1 Orang) Perawat PK 2 (1 Orang)</p>
                        </td>
                        <td>
                            <p>Peralatan level 0 ditambah tabung oksigen, standar infus, suction,
                                pulse oksimetri. Transfer eksternal ditambah tasemergensi</p>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <p>Pasien yang memerlukan observasi ketat atau intervensi khusus misalnya
                                pada pasien yang mengalami kegagalan satu sistem organ, pasien
                                perawatan post operasi</p>
                        </td>
                        <td>
                            <p>Perawat PK 1 (1 Orang) Perawat PK 2 (1 Orang) Dokter Jaga</p>
                        </td>
                        <td>
                            <p>Peralatan level 1 ditambah monitor EKG dan defibrilator</p>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <p>Pasien yang mengalami kegagalan multi organ dan memerlukan bantuan
                                hidup jangka panjang ditambah dengan kebutuhan akan alat bantu nafas</p>
                        </td>
                        <td>
                            <p>Perawat PK 2 (2 Orang) Dokter Jaga</p>
                        </td>
                        <td>
                            <p>Peralatan level 2 ditambah alat bantu nafas</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Informasi Transfer</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Derajat Stabilitas</b>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <b>Asal Pasien</b>
                            <input type="text" class="form-control" name="" id="">
                            <b>Tujuan Pasien</b>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <b>Waktu Berangkat</b>
                            <input type="text" class="form-control" name="" id="">
                            <b>Waktu Tiba</b>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Subjektif (S)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Keluhan Utama (Autoanamnesis)</b>
                            <input type="text" class="form-control" id="anamnesis" name="anamnesis" value="<?= $val['anamnesis']; ?>">
                        </td>
                        <td>
                            <b>Riwayat Penyakit Sekarang</b>
                            <input type="text" class="form-control" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" value="<?= $val['riwayat_penyakit_sekarang']; ?>">
                        </td>
                        <td>
                            <b>Riwayat Penyakit Dahulu</b>
                            <input type="text" class="form-control" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" value="<?= $val['riwayat_penyakit_dahulu']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Riwayat Penyakit Keluarga</b>
                            <input type="text" class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" value="<?= $val['riwayat_penyakit_keluarga']; ?>">
                        </td>
                        <td>
                            <b>Riwayat Alergi (Non Obat)</b>
                            <input type="text" class="form-control" id="riwayat_alergi_nonobat" name="riwayat_alergi_nonobat" value="<?= $val['riwayat_alergi_nonobat']; ?>">
                            <b>Riwayat Alergi (Obat)</b>
                            <input type="text" class="form-control" id="riwayat_alergi_obat" name="riwayat_alergi_obat" value="<?= $val['riwayat_alergi_obat']; ?>">
                        </td>
                        <td>
                            <b>Riwayat Obat Yang Dikonsumsi</b>
                            <input type="text" class="form-control" id="riwayat_obat_dikonsumsi" name="riwayat_obat_dikonsumsi" value="<?= $val['riwayat_obat_dikonsumsi']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Riwayat Kehamilan dan Persalinan</b>
                            <input type="text" class="form-control" id="riwayat_kehamilan" name="riwayat_kehamilan" value="<?= $val['riwayat_kehamilan']; ?>">
                        </td>
                        <td>
                            <b>Riwayat Diet</b>
                            <input type="text" class="form-control" id="riwayat_diet" name="riwayat_diet" value="<?= $val['riwayat_diet']; ?>">
                        </td>
                        <td>
                            <b>Riwayat Imunisasi</b>
                            <input type="text" class="form-control" id="riwayat_imunisasi" name="riwayat_imunisasi" value="<?= $val['riwayat_imunisasi']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Riwayat Kebiasaan (Negatif)</b>
                            <input type="text" class="form-control" id="riwayat_alkohol" name="riwayat_alkohol" value="<?= $val['riwayat_alkohol']; ?>, <?= $val['riwayat_merokok']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Obyektif (O)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td colspan="4"><b>Vital Sign</b></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tekanan Darah</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tensi_atas" name="tensi_atas" value="<?= $val['tensi_atas']; ?> / <?= $val['tensi_bawah']; ?>">
                                <span class="input-group-text" id="basic-addon2">mmHg</span>
                            </div>
                        </td>
                        <td>
                            <b>Denyut Nadi</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nadi" name="nadi" value="<?= $val['nadi']; ?>">
                                <span class="input-group-text" id="basic-addon2">x/m</span>
                            </div>
                        </td>
                        <td>
                            <b>Suhu Tubuh</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="suhu" name="suhu" value="<?= $val['suhu']; ?>">
                                <span class="input-group-text" id="basic-addon2">℃</span>
                            </div>
                        </td>
                        <td>
                            <b>Respiration Rate</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="respiration" name="respiration" value="<?= $val['respiration']; ?>">
                                <span class="input-group-text" id="basic-addon2">x/m</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Berat Badan</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="berat" name="berat" value="<?= $val['berat']; ?>">
                                <span class="input-group-text" id="basic-addon2">kg</span>
                            </div>
                        </td>
                        <td>
                            <b>Tinggi Badan</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tinggi" name="tinggi" value="<?= $val['tinggi']; ?>">
                                <span class="input-group-text" id="basic-addon2">cm</span>
                            </div>
                        </td>
                        <td>
                            <b>SpO2</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="spo2" name="spo2" value="<?= $val['spo2']; ?>">
                            </div>
                        </td>
                        <td>
                            <b>BMI</b>
                            <div class="input-group">
                                <input type="text" class="form-control" id="imt" name="imt" value="<?= $val['imt']; ?>">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b><i>GCS / Tingkat Kesadaran</i></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>GCS E / Respon Membuka Mata :</b>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="gcs_e" name="gcs_e" value="<?= $val['gcs_e']; ?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>GCS V / Respon Verbal Terbaik :</b>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="gcs_v" name="gcs_v" value="<?= $val['gcs_v']; ?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>GCS M / Respon Motorik Terbaik :</b>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="gcs_m" name="gcs_m" value="<?= $val['gcs_m']; ?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>Score GCS : </b>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="gcs" name="gcs" value="<?= $val['gcs']; ?>">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Keadaan Umum</b>
                            <input type="text" class="form-control" id="" name="" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Skala Nyeri</b>
                            <input type="text" class="form-control" id="pain_score" name="pain_score" value="<?= $val['pain_score']; ?>">
                        </td>
                        <td>
                            <b>Resiko Jatuh</b>
                            <input type="text" class="form-control" id="fall_score" name="fall_score" value="<?= $val['fall_score']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <div class="row mb-1">
                            <label for="sa" class="col-sm-auto col-form-label"><b>Temuan Klinis</b></label>
                            <div class="col">
                                <input type="text" class="form-control" id="sa" name="sa" value="">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4 class="text-start">Assessment (A)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <b>Diagnosis (ICD-10)</b>
                            <input type="text" class="form-control" id="icd10" name="icd10" value="<?= $val['icd10']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Permasalahan Medis</b>
                            <input type="text" class="form-control" id="masalah_medis" name="masalah_medis" value="<?= $val['masalah_medis']; ?>">
                        </td>
                        <td>
                            <b>Permasalahan Keperawatan</b>
                            <input type="text" class="form-control" id="masalah_perawat" name="masalah_perawat" value="<?= $val['masalah_perawat']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Penyebab Cidera / Keracunan</b>
                            <input type="text" class="form-control" id="penyebab_cidera" name="penyebab_cidera" value="<?= $val['penyebab_cidera']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Planning (P)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Target / Sasaran Terapi</b>
                            <input type="text" class="form-control" id="sasaran" name="sasaran" value="<?= $val['sasaran']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Pemeriksaan Diagnostik Penunjang</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Laboratorium</b>
                            <div type="text" class="form-control" id="laboratorium" name="laboratorium"><?= $val['laboratorium']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Radiologi</b>
                            <div type="text" class="form-control" id="radiologi" name="radiologi"><?= $val['radiologi']; ?></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Farmakoterapi</b>
                            <div type="text" class="form-control" id="farmakologia" name="farmakologia"><?= $val['farmakologia']; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Procedure</b>
                            <div type="text" class="form-control" id="prosedur" name="prosedur"><?= $val['prosedur']; ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h5 class="text-start">Catatan Procedure</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Standing Order</b>
                            <div type="text" class="form-control" id="standing_order" name="standing_order"><?= $val['standing_order']; ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Status Pasien</h4>
            </div>
            <table class="table table-bordered mb-5">
                <thead>
                    <tr>
                        <td colspan="4" style="text-align: center; vertical-align:middle;">
                            <b>Kondisi Pasien</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <b>Sebelum Transfer</b>
                        </td>
                        <td>
                            <b>Selama Transfer</b>
                        </td>
                        <td>
                            <b>Setelah Transfer</b>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b>Kondisi Umum</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <b>T (Tensi)</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <b>N (Detak Jantung)</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <b>RR (Frekuensi Pernapasan)</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <b>S (Suhu Badan)</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <b>BB (Berat Badan)</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <b>TB (Tinggi Badan)</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <b>SpO2</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Catatan Penting</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="row mb-2">
                <b>Serah Terima Saat Mengantar Pasien</b>
                <div class="col-3" align="center">
                    <div>Petugas Yang Menyerahkan</div>
                    <div class="mb-4">
                        <div id="qrcode"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-3" align="center">
                    <div>Petugas Yang Menerima</div>
                    <div class="mb-4">
                        <div id="qrcode1"></div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <b>Serah Terima Saat Menjemput Pasien</b>
                <div class="col-auto" align="center">
                    <div>Petugas Yang Menyerahkan</div>
                    <div class="mb-1">
                        <div id="qrcode2"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Petugas Yang Menerima</div>
                    <div class="mb-1">
                        <div id="qrcode3"></div>
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
<script>
    var qrcode = new QRCode(document.getElementById("qrcode2"), {
        text: 'a',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode3"), {
        text: 'a',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    $(document).ready(function() {
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
<style>
    @media print {
        @page {
            margin: none;
            scale: 85;
        }

        .container {
            width: 210mm;
            /* Sesuaikan dengan lebar kertas A4 */
        }
    }
</style>
<script type="text/javascript">
    window.print();
</script>

</html>
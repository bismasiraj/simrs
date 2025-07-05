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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>
    <!-- 
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script> -->
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

            <!-- <input type="hidden" name="body_id" id="body_id">
            <input type="hidden" name="org_unit_code" id="org_unit_code">
            <input type="hidden" name="pasien_diagnosa_id" id="pasien_diagnosa_id">
            <input type="hidden" name="diagnosa_id" id="diagnosa_id">
            <input type="hidden" name="visit_id" id="visit_id">
            <input type="hidden" name="bill_id" id="bill_id">
            <input type="hidden" name="class_room_id" id="class_room_id">
            <input type="hidden" name="in_date" id="in_date">
            <input type="hidden" name="exit_date" id="exit_date">
            <input type="hidden" name="keluar_id" id="keluar_id"> -->
            <!-- <input type="hidden" name="examination_date" id="examination_date"> -->
            <!-- <input type="hidden" name="employee_id" id="employee_id">
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
            <input type="hidden" name="account_id" id="account_id"> -->
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p><?= @$kop['contact_address'] ?></p>
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
                        <td class="p-1">
                            <b>Nomor RM</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['visit']['no_registration']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Nama Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['visit']['name_of_pasien']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Jenis Kelamin</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['visit']['name_of_gender']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Tanggal Lahir (Usia)</b>
                            <?php if (!empty($visit['date_of_birth'])) : ?>
                                <p class="m-0 mt-1 p-0"><?= date('d/m/Y', strtotime($visit['date_of_birth'])) . ' (' . @$visit['visit']['age'] . ')'; ?></p>
                            <?php else : ?>
                                <p class="m-0 mt-1 p-0">-</p>
                            <?php endif; ?>
                        </td>
                        <td class="p-1" colspan="2">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['visit']['contact_address']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['visit']['sspractitioner_name']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['visit']['name_of_clinic']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0"> <?= date('d-m-Y H:i', strtotime(@$visit['visit']['visit_datetime'])) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                            <div><?= @$sub['kelas']; ?></div>
                        </td>
                        <td class="p-1">
                            <b>Bangsal/ Kamar</b>
                            <div><?= @$sub['bangsal']; ?></div>
                        </td>
                        <td class="p-1">
                            <b>Bed</b>
                            <div><?= @$sub['bed'] === 0 ? "" : @$sub['bed']; ?></div>
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
                <tbody id="drajat-stabilitas-tabels">
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
                            <div type="text" class="form-control" name=""><?= @$stabil['value_desc']; ?></div>
                        </td>
                        <td>
                            <b>Asal Pasien</b>
                            <div type="text" class="form-control" name=""><?= @$val['clinic_id'] ?></div>
                            <b>Tujuan Pasien</b>
                            <div type="text" class="form-control" name=""><?= @$val['clinc_id_to'] ?></div>
                        </td>
                        <td>
                            <b>Waktu Berangkat</b>
                            <div type="text" class="form-control" name=""><?= date('d-m-Y H:i', strtotime(@$doc1['examination_date'])) ?>
                            </div>
                            <b>Waktu Tiba</b>
                            <div type="text" class="form-control" name=""><?= date('d-m-Y H:i', strtotime(@$doc3['examination_date'])) ?>
                            </div>
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
                            <b>Keluhan Utama</b>
                            <div type="text" class="form-control" id="description" name="description" value=""><?= @$doc['description'] ?></div>
                        </td>
                        <!-- <td>
                            <b>Riwayat Penyakit Sekarang</b>
                            <div type="text" class="form-control" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" value=""><?= @$sub['riwayat_penyakit_sekarang'] ?></div>
                        </td>
                        <td>
                            <b>Riwayat Penyakit Dahulu</b>
                            <div type="text" class="form-control" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" value=""><?= @$sub['riwayat_penyakit_dahulu'] ?></div>
                        </td> -->
                    </tr>
                    <!-- <tr>
                        <td>
                            <b>Riwayat Penyakit Keluarga</b>
                            <div type="text" class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga"><?= @$sub['riwayat_penyakit_keluarga'] ?></div>
                        </td>
                        <td>
                            <b>Riwayat Alergi (Non Obat)</b>
                            <div type="text" class="form-control" id="riwayat_alergi_nonobat" name="riwayat_alergi_nonobat"><?= @$sub['riwayat_alergi_obat'] ?></div>
                            <b>Riwayat Alergi (Obat)</b>
                            <div type="text" class="form-control" id="riwayat_alergi_obat" name="riwayat_alergi_obat"><?= @$sub['riwayat_alergi_obat'] ?></div>
                        </td>
                        <td>
                            <b>Riwayat Obat Yang Dikonsumsi</b>
                            <div type="text" class="form-control" id="riwayat_obat_dikonsumsi" name="riwayat_obat_dikonsumsi"><?= @$sub['riwayat_obat_dikonsumsi'] ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Riwayat Kehamilan dan Persalinan</b>
                            <div type="text" class="form-control" id="riwayat_kehamilan" name="riwayat_kehamilan"><?= @$sub['riwayat_kehamilan'] ?></div>
                        </td>
                        <td>
                            <b>Riwayat Diet</b>
                            <div type="text" class="form-control" id="riwayat_diet" name="riwayat_diet"><?= @$sub['riwayat_diet'] ?></div>
                        </td>
                        <td>
                            <b>Riwayat Imunisasi</b>
                            <div type="text" class="form-control" id="riwayat_imunisasi" name="riwayat_imunisasi"><?= @$sub['riwayat_imunisasi'] ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Riwayat Kebiasaan (Negatif)</b>
                            <div type="text" class="form-control" id="riwayat_alkohol" name="riwayat_alkohol"><?= @$sub['riwayat_alkohol'] ?></div>
                        </td>
                    </tr> -->
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
                                <div type="text" class="form-control" id="tensi_atas" name="tensi_atas" value=""><?= @$doc1['tension_upper'] ?>/<?= @$doc1['tension_below'] ?></div>
                                <span class="input-group-text" id="basic-addon2">mmHg</span>
                            </div>
                        </td>
                        <td>
                            <b>Denyut Nadi</b>
                            <div class="input-group">
                                <div type="text" class="form-control" id="nadi" name="nadi" value=""><?= @$doc1['nadi'] ?></div>
                                <span class="input-group-text" id="basic-addon2">x/m</span>
                            </div>
                        </td>
                        <td>
                            <b>Suhu Tubuh</b>
                            <div class="input-group">
                                <div type="text" class="form-control" id="suhu" name="suhu" value=""><?= @$doc1['temperature'] ?></div>
                                <span class="input-group-text" id="basic-addon2">℃</span>
                            </div>
                        </td>
                        <td>
                            <b>Respiration Rate</b>
                            <div class="input-group">
                                <div type="text" class="form-control" id="respiration" name="respiration"></div>
                                <span class="input-group-text" id="basic-addon2">x/m</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Berat Badan</b>
                            <div class="input-group">
                                <div type="text" class="form-control" id="berat" name="berat"><?= @$doc1['weight'] ?></div>
                                <span class="input-group-text" id="basic-addon2">kg</span>
                            </div>
                        </td>
                        <td>
                            <b>Tinggi Badan</b>
                            <div class="input-group">
                                <div type="text" class="form-control" id="tinggi" name="tinggi" value=""><?= @$doc1['height'] ?></div>
                                <span class="input-group-text" id="basic-addon2">cm</span>
                            </div>
                        </td>
                        <td>
                            <b>SpO2</b>
                            <div class="input-group">
                                <div type="text" class="form-control" id="spo2" name="spo2" value=""><?= @$doc1['saturasi'] ?></div>
                            </div>
                        </td>
                        <td>
                            <b>BMI</b>
                            <div class="input-group">
                                <div type="text" class="form-control" id="imt" name="imt" value=""><?= @$sub['imt'] === null ? "-" : @$sub['imt'] ?></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- <table class="table table-bordered">
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
                                    <div type="text" class="form-control" id="gcs_e" name="gcs_e" value=""><?= @$sub['gcs_e'] === null ? "" : '[' . @$sub['gcs_e'] . ']' . @$sub['gsc_e_desc'] ?></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>GCS V / Respon Verbal Terbaik :</b>
                                </div>
                                <div class="col">
                                    <div type="text" class="form-control" id="gcs_v" name="gcs_v" value=""><?= @$sub['gcs_v'] === null ? "" : '[' . @$sub['gcs_v'] . ']' . @$sub['gsc_v_desc'] ?></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>GCS M / Respon Motorik Terbaik :</b>
                                </div>
                                <div class="col">
                                    <div type="text" class="form-control" id="gcs_m" name="gcs_m" value=""><?= @$sub['gcs_m'] === null ? "" : '[' . @$sub['gcs_m'] . ']' . @$sub['gsc_m_desc'] ?></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>Score GCS : </b>
                                </div>
                                <div class="col">
                                    <div type="text" class="form-control" id="gcs" name="gcs" value=""><?= @$sub['gcs_desc'] ?></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Keadaan Umum</b>
                            <div type="text" class="form-control" name="" value=""><?= @$sub['namadiagnosa'] ?></div>
                        </td>
                    </tr>
                </tbody>
            </table> -->
            <!-- <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Skala Nyeri</b>
                            <div type="text" class="form-control" id="pain_score" name="pain_score" value=""><?= @$sub['pain_score'] === 0 ? "Tidak Ada nyeri" : @$sub['pain_score'] ?></div>
                        </td>
                        <td>
                            <b>Resiko Jatuh</b>
                            <div type="text" class="form-control" id="fall_score" name="fall_score" value=""><?= @$sub['fall_score'] === 0 ? "Tidak Ada resiko Jatuh" : @$sub['fall_score'] ?></div>
                        </td>
                    </tr>
                </tbody>
            </table> -->
            <!-- <table class="table table-bordered">
                <tr>
                    <td>
                        <div class="row mb-1">
                            <label for="sa" class="col-sm-auto col-form-label"><b>Temuan Klinis</b></label>
                            <div class="col">
                                <div type="text" class="form-control" id="sa" name="sa" value=""></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table> -->
            <div class="row">
                <h4 class="text-start">Assessment (A)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <b>Diagnosa Keperawatan</b>
                            <?php if (!is_null($diag)) {
                                foreach ($diag as $keyd => $valued) {
                            ?>
                                    <div type="text" class="form-control" id="icd10" name="icd10" value=""><?= $valued['diag_notes'] ?></div>
                            <?php
                                }
                            } ?>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>
                            <b>Permasalahan Medis</b>
                            <div type="text" class="form-control" id="masalah_medis" name="masalah_medis" value=""><?= @$sub['masalah_medis'] ?></div>
                        </td>
                        <td>
                            <b>Permasalahan Keperawatan</b>
                            <div type="text" class="form-control" id="masalah_perawat" name="masalah_perawat" value=""><?= @$sub['masalah_perawat'] ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Penyebab Cidera / Keracunan</b>
                            <div type="text" class="form-control" id="penyebab_cidera" name="penyebab_cidera" value=""><?= @$sub['penyebab_cidera'] ?></div>
                        </td>
                    </tr> -->
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Planning (P)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Catatan Planning</b>
                            <div type="text" class="form-control" id="instruction" name="instruction" value=""><?= @$doc['instruction'] ?></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="row">
                <h5 class="text-start">Pemeriksaan Diagnostik Penunjang</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Laboratorium</b>
                            <div type="text" class="form-control" id="laboratorium" name="laboratorium"><?= @$sub['laboratorium'] ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Radiologi</b>
                            <div type="text" class="form-control" id="radiologi" name="radiologi"><?= @$sub['radiologi'] ?></div>
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
                            <div type="text" class="form-control" id="farmakologia" name="farmakologia"><?= @$sub['farmakologia'] ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Procedure</b>
                            <div type="text" class="form-control" id="prosedur" name="prosedur"><?= @$sub['prosedur'] ?>
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
                            <div type="text" class="form-control" id="standing_order" name="standing_order"><?= @$sub['standing_order'] ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> -->
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
                            <b>Setelah Transfer</b>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b>Kondisi Umum</b>
                        </td>
                        <td><?= @$doc1['anamnase'] ?></td>
                        <td><?= @$doc3['anamnase'] ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>T (Tensi)</b>
                        </td>
                        <td><?= @$doc1['tension_upper'] ?>/<?= @$doc1['tension_below'] ?></td>
                        <td><?= @$doc3['tension_upper'] ?>/<?= @$doc3['tension_below'] ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>N (Detak Jantung)</b>
                        </td>
                        <td><?= @$doc1['nadi'] ?></td>
                        <td><?= @$doc3['nadi'] ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>RR (Frekuensi Pernapasan)</b>
                        </td>
                        <td><?= @$doc1['nafas'] ?></td>
                        <td><?= @$doc3['nafas'] ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>S (Suhu Badan)</b>
                        </td>
                        <td><?= @$doc1['temperature'] ?></td>
                        <td><?= @$doc3['temperature'] ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>BB (Berat Badan)</b>
                        </td>
                        <td><?= @$doc1['weight'] ?></td>
                        <td><?= @$doc3['weight'] ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>TB (Tinggi Badan)</b>
                        </td>
                        <td><?= @$doc1['height'] ?></td>
                        <td><?= @$doc3['height'] ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>SpO2</b>
                        </td>
                        <td><?= @$doc1['saturasi'] ?></td>
                        <td><?= @$doc3['saturasi'] ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Catatan Penting</b>
                        </td>
                        <td><?= @$doc1['alo_anamnase'] ?></td>
                        <td><?= @$doc3['alo_anamnase'] ?></td>
                    </tr>
                </tbody>
            </table>


            <div class="row mb-2">
                <b>Serah Terima Saat Mengantar Pasien</b>
                <div class="col-3" align="center">
                    <div>Petugas Yang Menyerahkan</div>
                    <div class="mb-4">
                        <div class="pt-2" id="qrcode2"></div>
                    </div>
                    <div id="qrcode2name"></div>
                </div>
                <div class="col"></div>
                <div class="col-3" align="center">
                    <div>Petugas Yang Menerima</div>
                    <div class="mb-4">
                        <div class="pt-2" id="qrcode3"></div>
                        <div id="qrcode3name"></div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <b>Serah Terima Saat Menjemput Pasien</b>
                <div class="col-3" align="center">
                    <div>Petugas Yang Menyerahkan</div>
                    <div class="mb-1">
                        <div class="pt-2" id="qrcode6"></div>
                        <div id="qrcode6name"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-3" align="center">
                    <div>Petugas Yang Menerima</div>
                    <div class="mb-1">
                        <div class="pt-2" id="qrcode7"></div>
                        <div id="qrcode7name"></div>
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
    let val = <?= json_encode($val); ?>;
    let sign = <?= json_encode($sign); ?>;

    sign = JSON.parse(sign)
</script>
<script>
    $.each(sign, function(key, value) {
        if (value.user_type == 1) {
            if (document.getElementById("qrcode" + value.sign_ke)) {
                var qrcode = new QRCode(document.getElementById("qrcode" + value.sign_ke), {
                    text: value.sign_path,
                    width: 150,
                    height: 150,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H // High error correction
                });
                $("#qrcode" + value.sign_ke + "name").html(`(${value.fullname??value.user_id})`)
            }
        }
    })
</script>

<?php

?>

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